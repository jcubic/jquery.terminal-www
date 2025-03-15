/**@license
 * JQuery Terminal Chat using firebase
 *
 * Copyright (C) 2017 Jakub Jankiewicz <http://jcubic.pl/me>
 * Released under the MIT license
 *
 */
/* global jQuery, firebase, Audio, sysend, Favico, randomColor, figlet */

function unpollute(cls, thunk) {
    var polluted = {};
    var proto = cls.prototype;
    // save polluted prorotype methods
    Object.getOwnPropertyNames(proto).forEach(name => {
        if (!is_native(proto[name])) {
            polluted[name] = proto[name];
            delete proto[name];
        }
    });
    thunk().then(() => {
        // restore prototype
        Object.keys(polluted).forEach(name => {
            proto[name] = polluted[name];
        });
    });
}
function is_native(fn) {
    return fn.toString().match(/\{\s*\[native code\]\s*\}/);
}

async function getId(FingerprintJS, options) {
    let fp = await FingerprintJS.load(options);
    const result = await fp.get();
    return result.visitorId;
}

function install_sw(username) {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('sw.js', {
            scope: './'
        }).then((registration) => {
            firebase.messaging().useServiceWorker(registration);
        });
    }
}

async function getId(FingerprintJS, options) {
    let fp = await FingerprintJS.load(options);
    const result = await fp.get();
    return result.visitorId;
}

function register_notifications() {
    if (!('serviceWorker' in navigator)) {
        return;
    }
    const messaging = firebase.messaging();
    if (Notification.permission === "granted") {
        messaging.getToken().then(handleTokens);
    } else {
        Notification.requestPermission().then(function() {
            notifications_registered = true;
            return messaging.getToken();
        }).then(handleTokens).catch(() => {/* ignore */});
    }
    function handleTokens(token) {
        messaging.onTokenRefresh(() => {
            messaging.getToken().then(updateToken);
        });
        updateToken(token);
    }
    function updateToken(token) {
        getId(FingerprintJS).then((id) => {
            console.log({id});
            const data = new FormData();
            data.append('id', id);
            data.append('token', token);
            return fetch('register.php', {
                body: data,
                method: 'POST'
            }).then(r => r.text());
        });
    }
}

function send(username, message) {
    const data = new URLSearchParams();
    data.append('username', username);
    data.append('message', message);
    return fetch('new.php', {
        method: 'POST',
        body: data
    }).then(r => r.text());
}

jQuery(function($) {
    var database, last_messages, messages, username;
    window.firebase_chat = function(...args) {
        ready.then(() => init(...args));
    };
    var ready = $.Deferred();
    figlet.defaults({ fontPath: 'https://cdn.jsdelivr.net/npm/figlet/fonts' });
    // figlet.js bug #75
    unpollute(Array, function() {
        figlet.preloadFonts(['Standard', 'Slant'], function() {
            ready.resolve();
        });
        return ready.promise();
    });
    function warn(term, label, message) {
        term.echo(`[[;#000;#FFDD00]${label}]: [[;#FFDD00;]${message}]`);
    }
    function render_text(term, text, font) {
        return figlet.textSync(text, {
            font: font || 'Standard',
            width: !term ? 80 : term.cols(),
            whitespaceBreak: true
        });
    }
    function init(term, ref = 'messages') {
        install_sw();
        database = firebase.database();
        messages = database.ref(ref);
        last_messages = messages.limitToLast(100);
        push_formatter(function(string) {
            return string.replace(/([^`]|^)`([^`]+)`([^`]|$)/g, '$1[[b;#fff;]$2]$3');
        });
        push_formatter([/```[^\n`]```/g, '[[b;#fff;]$2]']);
        push_formatter(function(string) {
            return string.replace(/\b\/me\b/g, username);
        });
        push_formatter(function(string) {
            if (username) {
                return format(string);
            } else {
                return string;
            }
        });
        var state = term.export_view();
        term.clear();
        term.echo(() => render_text(term, 'Terminal Chat', 'Slant'), {
            formatters: false
        });
        term.push({
            '/help': help,
            '/quit': quit,
            '/login': function(type) {
                type = type.toLowerCase();
                warn(term, 'NOTE', 'We request permission for notfication when new message arrive' +
                     '\n      if you use /logout they will be removed.');
                register_notifications();
                if (type.match(/^(twitter|github|facebook)$/)) {
                    term.pause();
                    var provider;
                    if (type == 'twitter') {
                        provider = new firebase.auth.TwitterAuthProvider();
                    } else if (type == 'github') {
                        provider = new firebase.auth.GithubAuthProvider();
                    } else {
                        provider = new firebase.auth.FacebookAuthProvider();
                    }
                    login = true;
                    sysend.broadcast('login');
                    auth.signInWithPopup(provider).then(function(result) {
                        if (result) {
                            var user = result.user;
                            start(user);
                        }
                    }).catch(function(error) {
                        term.error(error.message).resume();
                        term.error('try again');
                    });
                } else {
                    this.error('wrong login type');
                }
            }
        }, {
            onFocus: resetNotifications,
            prompt: '> ',
            name: 'chat',
            onExit: function() {
                pop_formatters();
                term.import_view(state);
            },
            keymap: {
                ENTER: function(e, original) {
                    if (this.level() === 1) {
                        return original();
                    }
                    var command = this.get_command();
                    if (command.match(/^```\w*/)) {
                        if (!command.match(/^```[\s\S]+\n```\s*$/)) {
                            this.insert('\n');
                            return;
                        }
                    }
                    return original();
                }
            }
        });
        var focus = true;
        $(window).off('.chat').on('focus.chat', function() {
            focus = true;
            resetNotifications();
        }).on('blur.chat', function() {
            focus = false;
        });
        var favicon = new Favico({
            animation: 'none'
        });
        var newItems = false;
        var random_value = Math.random();
        var sound = new Audio('/button-9.mp3');
        sound.volume = 0.3;
        var silent = true;
        var new_messages = 0;
        function show_message(data) {
            var message = format(data.message, data.user);
            term.echo(message);
            if (!focus) {
                if (!silent) {
                    sound.play();
                }
                if (!document.hasFocus()) {
                    new_messages += 1;
                    favicon.badge(new_messages);
                }
            }
            term.scroll_to_bottom();
        }
        var newMessages = false;
        last_messages.on('child_added', function(snapshot) {
            if (!newMessages) {
                //return;
            }
            var data = snapshot.val();
            if (data.random != random_value) {
                show_message(data);
            }
        });
        last_messages.once('value', function() {
            term.echo('type [[;#fff;]/help] for help');
            newMessages = true;
        });
        function help() {
            term.echo([
                '',
                '[[b;#fff;]/login \[twitter|github|facebook\]] - to be able to post messages',
                '[[b;#fff;]/help] - this screen',
                '',
                'After Login:',
                '[[b;#fff;]/logout] - logout from the app',
                '[[b;#fff;]/sound true|false] - turn on/off sound notifications',
                '[[b;#fff;]/user <name>] - set new username',
                //'[[b;#fff;]/unregister] - remove push notifications',
                '[[b;#fff;]/quit] - logout and exit from chat',
                'everything else is a message',
                'use &#96;code&#96; or',
                '&#96;&#96;&#96;language',
                'code snippet',
                '&#96;&#96;&#96;',
                'markdown don\'t work, only code snippets',
                ''
            ].join('\n'));
        }
        function quit() {
            while (term.level() > 1) {
                term.pop();
            }
            logout();
            sysend.off('login', login_handler);
            sysend.off('logout', logout_handler);
        }
        function logout() {
            term.pop();
            last_messages.off();
            firebase.messaging().deleteToken();
            username = null;
            unsubscribe();
        }
        function start(user) {
            username = user.displayName;
            if (!username) {
                term.echo('Coudn\'t acquire username, you need to set one');
                term.read('username: ').then(function(user) {
                    username = user;
                });
            } else {
                push();
            }
            function push() {
                term.resume().push(function(message) {
                    var cmd = $.terminal.parse_command(message);
                    if (cmd.name == '/sound') {
                        var flag = message.replace(/^\s*\/sound\s*/, '').toLowerCase();
                        if (flag == 'true') {
                            silent = false;
                        } else if (flag == 'false') {
                            silent = true;
                        } else {
                            term.error('wrong flag, only [[;#fff;]true] or [[;#fff;]false]' +
                                       ' are accepted');
                        }
                    } else if (cmd.name == '/user') {
                        username = cmd.args[0];
                    } else if (cmd.name == '/quit') {
                        term.exec('/logout', true);
                        quit();
                    } else if (cmd.name == '/logout') {
                        firebase.auth().signOut();
                        last_messages.off();
                        sysend.broadcast('logout');
                        username = null;
                    } else if (cmd.name == '/help') {
                        help();
                    } else if (message !== '') {
                        var newMessageRef = messages.push();
                        newMessageRef.setWithPriority({
                            user: username,
                            message: message,
                            random: random_value
                        }, firebase.database.ServerValue.TIMESTAMP);
                        send(username, message);
                    }
                }, {
                    prompt: function(callback) {
                        callback('[[;' + color(username) + ';]' +
                                 username + ']> ');
                    }
                });
            }
        }
        var auth = firebase.auth();
        var login = false;
        function login_handler() {
            login = false;
        }
        function logout_handler() {
            messages.off();
        }
        function resetNotifications() {
            new_messages = 0;
            favicon.reset();
        }
        sysend.on('login', login_handler);
        sysend.on('logout', logout_handler);
        var unsubscribe = auth.onAuthStateChanged(function(user) {
            if (user) {
                if (username != (user.displayName || 'Anonymous')) {
                    start(user);
                }
            }
        });
    }
    var limit = 80;
    var formatter_count = 0;
    function push_formatter(formatter) {
        $.terminal.defaults.formatters.push(formatter);
        formatter_count++;
    }
    function pop_formatters() {
        while (formatter_count--) {
            $.terminal.defaults.formatters.pop();
        }
    }
    var colors = {};
    function color(username) {
        return colors[username] = colors[username] || randomColor({
            luminosity: 'light'
        });
    }
    function format(string, username) {
        var user_color = color(username);
        if (string === '' && username) {
            return '[[;' + user_color + ';]' + $.terminal.escape_brackets(username) + ']>';
        }
        // single line broken code snippet
        string = string.split(/(```[^`\n]+```)/).filter(Boolean).map(function(string) {
            var m = string.match(/```([^`\n]+)\n```/);
            if (m) {
                return '`' + $.terminal.escape_brackets(m[1]) + '`';
            }
            return string;
        }).join('');
        return string.split(/\n?(```[\s\S]+?```)\s*\n?/).filter(Boolean).map(function(string) {
            var m = string.match(/```(.*?)\n([\s\S]+?)\n```/);
            if (m) {
                var lang = m[1];
                string = $.terminal.prism(lang, $.terminal.escape_brackets(m[2]));
            } else {
                string = $.terminal.escape_brackets(string);
            }
            if (!username) {
                return string;
            }
            var prefix = '[[;' + user_color + ';]' +
                $.terminal.escape_brackets(username) + ']> ';
            return string.split(/\n/).map(function(line) {
                return prefix + line;
            }).join('\n');
        }).join('\n');
    }
});
