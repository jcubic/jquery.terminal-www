/**@license
 * JQuery Terminal Chat using firebase
 *
 * Copyright (C) 2017 Jakub Jankiewicz <http://jcubic.pl/me>
 * Released under the MIT license
 *
 */
/* global jQuery, firebase, Audio, sysend, Favico, randomColor */

jQuery(function($) {
    // change this if you want to reuse
    var config = {
        apiKey: "AIzaSyBJguGFPPZXozdkPVpBZNbGMVJ_LTOYuQA",
        authDomain: "jcubic-1500107003772.firebaseapp.com",
        databaseURL: "https://jcubic-1500107003772.firebaseio.com",
        projectId: "jcubic-1500107003772"
    };
    var limit = 80;
    firebase.initializeApp(config);
    var database = firebase.database();
    var messages = database.ref('messages');
    var last_messages = messages.limitToLast(limit);
    $.terminal.defaults.formatters.push(function(string) {
        return string.replace(/([^`]|^)`([^`]+)`([^`]|$)/g, '$1[[b;#fff;]$2]$3');
    });
    $.terminal.defaults.formatters.push([/```[^\n`]```/g, '[[b;#fff;]$2]']);
    $.terminal.defaults.formatters.push(function(string) {
        return string.replace(/\b\/me\b/g, username);
    });
    var focus = true;
    $(window).focus(function() {
        focus = true;
    }).blur(function() {
        focus = false;
    });
    var colors = {};
    function color(username) {
        return colors[username] = colors[username] || randomColor({
            luminosity: 'light'
        });
    }
    function html(language, code) {
        try {
            var node = $('<pre>' + code + '</pre>')
                .appendTo('body').hide().snippet(language, {
                    style: '',
                    showNum: false
                });
            var html = $.terminal.escape_brackets(node.html());
            node.closest('.snippet-wrap').remove();
            var re = /<span class="([^"]+)">([^<]*)<\/span>/g;
            return html.replace(re, '[[;;;$1]$2]')
                .replace(/<\/li>/g, '\n')
                .replace(/<\/?[^>]+>/g, '').replace(/\n$/, '');
        } catch (e) {
            return code;
        }
    }
    function format(string, username) {
        var user_color = color(username);
        if (string === '' && username) {
            return '[[;' + user_color + ';]' + $.terminal.escape_brackets(username) + ']>';
        }
        // single line broken code snippet
        string = string.split(/(```[^`\n]+```)/).filter(Boolean).map(function(string) {
            var m = string.match(/```([^`\n]+)```/);
            if (m) {
                return '`' + $.terminal.escape_brackets(m[1]) + '`';
            }
            return string;
        }).join('');
        return string.split(/(```[\s\S]+?```)/).filter(Boolean).map(function(string) {
            var m = string.match(/```(.*?)\n([\s\S]+?)\n```/);
            if (m) {
                string = html(m[1], m[2]);
            } else {
                string = $.terminal.escape_brackets(string);
            }
            if (!username) {
                return string;
            }
            return string.split(/\n/).map(function(line) {
                return '[[;' + user_color + ';]' +
                    $.terminal.escape_brackets(username) + ']> ' + line;
            }).join('\n');
        }).join('');
    }
    // formatter is for when you type command and when you echo, messages are handled in show_message
    // before echo
    $.terminal.defaults.formatters.push(function(string) {
        if (username) {
            return format(string);
        } else {
            return string;
        }
    });
    var username;
    $('.chat').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var terminal = $('.chat.ui-dialog-content');
        if (terminal.length) {
            $('html,body').animate({
                scrollTop: terminal.offset().top - 50
            }, 500);
            return;
        }
        var favicon = new Favico({
            animation: 'none'
        });
        var newItems = false;
        var random_value = Math.random();
        var sound = new Audio('button-9.mp3');
        sound.volume = 0.3;
        var silent = false;
        function logout_other(term) {
            var terminals = $('.chat.ui-dialog-content .terminal');
            terminals.each(function() {
                var other = $(this).terminal();
                if (!other.is(term)) {
                    // exec would execute firebase signOut
                    // we only need echo and pop
                    other.echo(username + '> logout');
                }
                other.echo('You\'ve beed sign out from jQuery Terminal Chat');
                other.pop();
            });
        }
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
        last_messages.on('child_added', function(snapshot) {
            var data = snapshot.val();
            if (data.random != random_value) {
                show_message(data);
            }
        });
        last_messages.once('value', function() {
            term.echo('type [[;#fff;]/help] for help');
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
                'everything else is a message',
                'use &#96;code&#96; or',
                '&#96;&#96;&#96;language',
                'code snippet',
                '&#96;&#96;&#96;',
                'markdown don\'t work, only code snippets',
                ''
            ].join('\n'));
        }
        function init(user, options) {
            if (options.clear) {
                term.clear();
            }
            options = $.extend({clear: false}, options || {});
            username = user.displayName;
            if (!username) {
                term.echo('Coun\'t acquire username, you need to set one');
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
                    } else if (cmd.name == '/logout') {
                        firebase.auth().signOut();
                        last_messages.off();
                        sysend.broadcast('logout');
                        logout_other(term);
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
            logout_other(null);
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
                    init(user, {clear: !login});
                }
            }
        });
        window.favicon = favicon;
        var $win = $(window);
        var height = $win.height();
        var width = $win.width();
        var dterm = $('<div/>').addClass('chat').dterm({
            '/help': function() {
                help();
            },
            '/login': function(type) {
                type = type.toLowerCase();
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
                            //init(user);
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
            greetings: false,
            name: 'chat',
            width: width < 800 ? width - 100 : 800,
            height: height < 600 ? height - 100 : 600,
            outputLimit: limit,
            title: 'jQuery Terminal Chat',
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
            },
            close: function() {
                dterm.dialog("destroy");
                term.destroy().remove();
                logout();
                sysend.off('login', login_handler);
                sysend.off('logout', logout_handler);
            }
        });
        function logout() {
            last_messages.off();
            username = null;
            unsubscribe();
        }
        var term = dterm.terminal;
        term.css('overflow', '');
        term.addClass('sh_sourceCode'); // so snippets work in terminal
        return false;
    });
    if (window.location.hash == '#chat') {
        $('.chat').click();
    }
});
