/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);
// Copyright (c) Jakub T. Jankiewicz <https://jcubic.pl>
/* global $ rpc code optparse location */
var firebaseConfig = {
    apiKey: "AIzaSyCJhLo__GsvoEcP3Tp8G5jAhMo0OLPuBec",
    authDomain: "jcubic-1500107003772.firebaseapp.com",
    databaseURL: "https://jcubic-1500107003772.firebaseio.com",
    projectId: "jcubic-1500107003772",
    storageBucket: "jcubic-1500107003772.appspot.com",
    messagingSenderId: "1005897028349",
    appId: "1:1005897028349:web:fc2d0f5524864d5d17e494"
};
firebase.initializeApp(firebaseConfig);
var database = firebase.database();
var messages = {
    401: [
        /* TODO: but the site don't use basic auth */
    ],
    500: function() {
        var text_big = [
            '  ___       _                        _   ____                             _____',
            ' |_ _|_ __ | |_ ___ _ __ _ __   __ _| | / ___|  ___ _ ____   _____ _ __  | ____|_ __ _ __ ___  _ __',
            '  | || \'_ \\| __/ _ \\ \'__| \'_ \\ / _` | | \\___ \\ / _ \\ \'__\\ \\ / / _ \\ \'__| |  _| | \'__| \'__/ _ \\| \'__|',
            '  | || | | | ||  __/ |  | | | | (_| | |  ___) |  __/ |   \\ V /  __/ |    | |___| |  | | | (_) | |',
            ' |___|_| |_|\\__\\___|_|  |_| |_|\\__,_|_| |____/ \\___|_|    \\_/ \\___|_|    |_____|_|  |_|  \\___/|_|'
        ];
        var text_smallest = [
            ' ___                        ___',
            '/ __| ___ _ ___ _____ _ _  | __|_ _ _ _',
            '\\__ \\/ -_) \'_\\ V / -_) \'_| | _|| \'_| \'_|',
            '|___/\\___|_|  \\_/\\___|_|   |___|_| |_|',
        ];
        var text_medium = [
            ' ___     _                     _   ___                        ___',
            '|_ _|_ _| |_ ___ _ _ _ _  __ _| | / __| ___ _ ___ _____ _ _  | __|_ _ _ _ ___ _ _',
            ' | || \' \\  _/ -_) \'_| \' \\/ _` | | \\__ \\/ -_) \'_\\ V / -_) \'_| | _|| \'_| \'_/ _ \\ \'_|',
            '|___|_||_\\__\\___|_| |_||_\\__,_|_| |___/\\___|_|  \\_/\\___|_|   |___|_| |_| \\___/_|'
        ];
        var text_smaller = [
            ' ___                        ___',
            '/ __| ___ _ ___ _____ _ _  | __|_ _ _ _ ___ _ _ ',
            '\\__ \\/ -_) \'_\\ V / -_) \'_| | _|| \'_| \'_/ _ \\ \'_|',
            '|___/\\___|_|  \\_/\\___|_|   |___|_| |_| \\___/_|  ',
        ];
        var cols = this.cols();
        return [
            '888888888   .d8888b.   .d8888b.  ',
            '888        d88P  Y88b d88P  Y88b ',
            '888        888    888 888    888 ',
            '8888888b.  888    888 888    888 ',
            '     "Y88b 888    888 888    888 ',
            '       888 888    888 888    888 ',
            'Y88b  d88P Y88b  d88P Y88b  d88P ',
            ' "Y8888P"   "Y8888P"   "Y8888P"',
            ( cols >= 100 ? text_big : cols >= 82 ? text_medium : cols > 48 ? text_smaller : text_smallest).join('\n'),
            '',
        ].join('\n');
    },
    403: function() {
        return [
            '    d8888   .d8888b.   .d8888b.  ',
            '   d8P888  d88P  Y88b d88P  Y88b ',
            '  d8P 888  888    888      .d88P ',
            ' d8P  888  888    888     8888"  ',
            'd88   888  888    888      "Y8b. ',
            '8888888888 888    888 888    888 ',
            '      888  Y88b  d88P Y88b  d88P ',
            '      888   "Y8888P"   "Y8888P"  ',
            '  _____          _     _     _     _            ',
            ' |  ___|__  _ __| |__ (_) __| | __| | ___ _ __  ',
            ' | |_ / _ \\| \'__| \'_ \\| |/ _` |/ _` |/ _ \\ \'_ \\ ',
            ' |  _| (_) | |  | |_) | | (_| | (_| |  __/ | | |',
            ' |_|  \\___/|_|  |_.__/|_|\\__,_|\\__,_|\\___|_| |_|  ',
            '',
            'You are not allowed to access [[b;#fff;]' + location.pathname + '] page on this server'
        ].join('\n');
    },
    404: function() {
        var text_big = [
            ' _   _       _     _____                     _ ',
            '| \\ | | ___ | |_  |  ___|__  _   _ _ __   __| |',
            '|  \\| |/ _ \\| __| | |_ / _ \\| | | | \'_ \\ / _` |',
            '| |\\  | (_) | |_  |  _| (_) | |_| | | | | (_| |',
            '|_| \\_|\\___/ \\__| |_|  \\___/ \\__,_|_| |_|\\__,_|'
        ];
        var text_small = [
            ' _  _     _     ___                 _',
            '| \\| |___| |_  | __|__ _  _ _ _  __| |',
            '| .` / _ \\  _| | _/ _ \\ || | \' \\/ _` |',
            '|_|\\_\\___/\\__| |_|\\___/\\_,_|_||_\\__,_|'
        ];
        return [
            '    d8888   .d8888b.      d8888  ',
            '   d8P888  d88P  Y88b    d8P888  ',
            '  d8P 888  888    888   d8P 888  ',
            ' d8P  888  888    888  d8P  888  ',
            'd88   888  888    888 d88   888  ',
            '8888888888 888    888 8888888888 ',
            '      888  Y88b  d88P       888  ',
            '      888   "Y8888P"        888',
            (this.cols() > 50 ? text_big : text_small).join('\n'),
            '',
            'There are no [[b;#fff;]' + location.pathname + '] page on this server!'
        ].join('\n');
    }
};

rpc({
    url: location.host.match(/^localhost(?::[0-9]+)?/) ? './service.php' : '/service.php',
    error: function(error) {
        try {
            error = JSON.parse(error);
        } catch(e) {}
        var message;
        if (error.error) {
            error = error.error;
            message = error.message + ' in ' + error.file +
                '\n[' + error.at + '] ' + error.line;
        } else {
            message = error.message || error;
        }
        var terminal = $.terminal.active();
        if (terminal) {
            terminal.error(message);
            terminal.resume();
        } else {
            alert(message);
        }
    }
})(function(service) {
        var colors = $.omap({
        blue:  '#55f',
        green: '#4d4',
        grey:  '#999'
    }, function(_, color) {
        return function(str, style) {
            return '[[' + (style||'') + ';' + color + ';]' + str + ']';
        };
    });
    var jargon = [];
    var wiki_stack = [];
    var wiki_dict = {};
    service.jargon_list()(function(err, result) {
        if (!err) {
            jargon = result;
        }
    });
    function ascii_table(array, header) {
        if (!array.length) {
            return '';
        }
        for (var i = array.length - 1; i >= 0; i--) {
            var row = array[i];
            var stacks = [];
            for (var j = 0; j < row.length; j++) {
                var new_lines = row[j].toString().split("\n");
                row[j] = new_lines.shift();
                stacks.push(new_lines);
            }
            var new_rows_count = Math.max.apply(Math, stacks.map(function(column) {
                return column.length;
            }));
            for (var k = new_rows_count - 1; k >= 0; k--) {
                array.splice(i + 1, 0, stacks.map(function(column) {
                    return column[k] || "";
                }));
            }
        }

        var lengths = array[0].map(function(_, i) {
            var col = array.map(function(row) {
                if (row[i] != undefined) {
                    var len = wcwidth(row[i]);
                    if (row[i].match(/\t/g)) {
                        // tab is 4 spaces
                        len += row[i].match(/\t/g).length*3;
                    }
                    return len;
                } else {
                    return 0;
                }
            });
            return Math.max.apply(Math, col);
        });
        // column padding
        array = array.map(function(row) {
            return '| ' + row.map(function(item, i) {
                var size = wcwidth(item);
                if (item.match(/\t/g)) {
                    // tab is 4 spaces
                    size += item.match(/\t/g).length*3;
                }
                if (size < lengths[i]) {
                    item += new Array(lengths[i] - size + 1).join(' ');
                }
                return item;
            }).join(' | ') + ' |';
        });
        var sep = '+' + lengths.map(function(length) {
            return new Array(length + 3).join('-');
        }).join('+') + '+';
        if (header) {
            return sep + '\n' + array[0] + '\n' + sep + '\n' +
                array.slice(1).join('\n') + '\n' + sep;
        } else {
            return sep + '\n' + array.join('\n') + '\n' + sep;
        }
    }
    function wikipedia(text, title) {
        function list(list) {
            if (list.length == 1) {
                return list[0];
            } else if (list.length == 2) {
                return list.join(' and ');
            } else if (list.length > 2) {
                return list.slice(0, list.length-1).join(', ') + ' and ' +
                    list[list.length-1];
            }
        }
        function wiki_list(text) {
            return list(text.split('|').map(function(wiki) {
                if (wiki.match(/^\s*.*\s*=/)) {
                    return '';
                } else {
                    return '[[!bu;#fff;;wiki;]' + wiki + ']';
                }
            }).filter(function(item) {
                return !!item;
            }));
        }
        function word_template(content, color, default_text) {
            var re = /\[\[([^\]]+)\]\]/;
            if (content.match()) {
                return content.split(/(\[\[[^\]]+\]\])/).map(function(text) {
                    var m = text.match(re);
                    if (m) {
                        return '[[!bu;' + color + ';;wiki]' + m[1] + ']';
                    } else {
                        return '[[;' + color + ';]' + text + ']';
                    }
                }).join('');
            } else {
                return '[[;' + color + ';]' + (content || default_text) + ']';
            }
        }
        var templates = {
            'main': function(content) {
                return 'Main Article: ' + wiki_list(content) + '\n';
            },
            dunno: function() {
                return '?';
            },
            yes: function(content) {
                return word_template(content, '#0f0', 'yes');
            },
            no: function(content) {
                return word_template(content, '#f00', 'no');
            },
            partial: function(content) {
                return word_template(content, '#ff0', 'partial');
            },
            'lang-ar': function(content) {
                return '[[bu;#fff;;;Arabic_language]Arabic]: ' + content;
            },
            '(?:IPAc-en|IPA-en)': function(content) {
                if (!content.match(/\|/)) {
                    return 'English pronunciation: /' + content + '/';
                }
                var phonemes = {
                    'tS': 'tʃ', 'dZ': 'dʒ', 'J\\': 'ɟ', 'p\\': 'ɸ',
                    'B': 'β', 'T': 'θ', 'D': 'ð', 'S': 'ʃ', 'Z':
                    'ʒ', 'C': 'ç', 'j\\ (jj)': 'ʝ', 'G': 'ɣ', 'X\\':
                    'ħ', '?\\': 'ʕ', 'h\\': 'ɦ', 'F': 'ɱ', 'J': 'ɲ',
                    'N': 'ŋ', '4 (r)': 'ɾ', 'r (rr)': 'r', 'r\\':
                    'ɹ', 'R': 'ʀ', 'P': 'ʋ', 'H': 'ɥ', 'I': 'ɪ',
                    'E': 'ɛ', '{': 'æ', '2': 'ø', '9': 'œ', '1':
                    'i', '@': 'ə', '6': 'ɐ', '3': 'ɜ', '}': 'ʉ',
                    '8': 'ɵ', '&': 'ɶ', 'M': 'ɯ', '7': 'ɤ', 'V':
                    'ʌ', 'A': 'ɑ', 'U': 'ʊ', 'O': 'ɔ', 'Q': 'ɒ',
                    ',': 'ˌ', "'": 'ˈ', '_': 'ː'
                };
                var keys = {};
                var pron = '/' + content.split('|').map(function(text) {
                    if (!text.match(/^\s*-\s*$|^\s*en-us/)) {
                        var re = /^\s*(us|lang|pron|audio)\s*=?\s*(.*)/i;
                        var m = text.match(re);
                        if (m) {
                            keys[m[1].toLowerCase().trim()] = m[2] || true;
                        } else {
                            Object.keys(phonemes).forEach(function(key) {
                                text = text.replace(key, phonemes[key]);
                            });
                            return text;
                        }
                    }
                }).filter(Boolean).join('') + '/';
                pron = '[[!bu;#fff;;wiki;Help:IPA for English]' + pron + ']';
                if (keys.pron) {
                    pron = 'pronunciation: ' + pron;
                }
                if (keys.lang) {
                    pron = 'English ' + pron;
                }
                if (keys.us) {
                    pron = 'US ' + pron;
                }
                return pron;
            },
            'quote box': function(content) {
                var quote = content.match(/\s*quote\s*=\s*("[^"]+"|[^|]+)/)[1];
                var bold_re = /'''([^']+(?:'[^']+)*)'''/g;
                quote = quote.replace(bold_re, function(_, bold) {
                    return '][[bi;#fff;]' + bold + '][[i;;]';
                }).replace(/''([^']+(?:'[^']+)*)''/g, '$1').
                replace(/\[\[([^\]]+)\]\]/g, function(_, wiki) {
                    wiki = wiki.split('|');
                    if (wiki.length == 1) {
                        return '][[!bui;#fff;;wiki]' + wiki[0] + '][[i;;]';
                    } else {
                        return '][[!bui;#fff;;wiki;' + wiki[0] + ']' +
                            wiki[1] + '][[i;;]';
                    }
                });
                var author = content.match(/\s*source\s*=\s*([^|]+)/)[1].replace(/^(—|-)/, '').trim();
                return '[[i;;]' + quote + ']\n-- ' + author;
            },
            quote: function(content) {
                content = content.replace(/^\s*\|/gm, '').
                split(/|(?![^\]]+\])/);
                var keys = {};
                content = content.map(function(item) {
                    var m = item.match(/\s*(\w+)\s*=\s*(.*)/);
                    if (m) {
                        if (!isNaN(m[1])) {
                            return m[2];
                        } else {
                            keys[m[1].toLowerCase()] = m[2];
                            return '';
                        }
                    } else {
                        return item;
                    }
                }).join('');
                var author = '';
                if (keys.author) {
                    author = keys.author;
                } else if (content.match(/^ /m)) {
                    author = content.match(/^ (.*)/m)[1];
                }
                return '[[i;;]' + content.
                replace(/'''([^']+(?:'[^']+)*)'''/g, function(_, bold) {
                    return '][[bi;#fff;]' + bold + '][[i;;]';
                }).
                replace(/''([^']+(?:'[^']+)*)''/g, '$1').
                replace(/\[\[([^\]]+)\]\]/g, function(_, wiki) {
                    wiki = wiki.split('|');
                    if (wiki.length == 1) {
                        return '][[!bui;#fff;;wiki]' + wiki + '][[i;;]';
                    } else {
                        return '][[!bui;#fff;;wiki;' + wiki[0] + ']' +
                            wiki[1] + '][[i;;]';
                    }
                }) + ']' + (author ? '\n-- ' + author : '');
            },
            'Cat main': function(content) {
                return 'The main article for this [[!bu;#fff;;wiki' +
                    ';Help:category]Category] is [[!bu;#fff;;wiki]' +
                    content + ']\n';
            },
            'see also': function(content) {
                return 'See also ' + wiki_list(content) + '\n';
            },
            tag: function(content) {
                return escape('<'+content+'>...</' + content + '>');
            },
            '(?:official website|official)': function(content) {
                if (!content.match(/^http:/)) {
                    content = 'http://' + content;
                }
                return '[[!;;;;' + content + ']Official Website]';
            },
            'IMDb name': function(content) {
                if (title) {
                    var m = content.match(/id\s*=\s*([^|]+)/);
                    var id;
                    if (m) {
                        id = m[1];
                    } else {
                        id = content;
                    }
                    var url = 'http://www.imdb.com/name/nm' + id;
                    return '[[!;;;;' + url + ']' + title + '] ' +
                        'at the [[Internet Movie Database]]';
                }
            },
            'youtube': function(content) {
                content = content.split('|');
                if (content.length >= 2) {
                    var url = 'https://www.youtube.com/watch?v=' + content[0];
                    return '(YT): [[!;;;;' + url + ']' + content[1] + ']';
                }
            },
            '(?:tlx|tl)': function(content) {
                content = content.split('|');
                var params = '';
                if (content.length > 1) {
                    params = '|' + content.slice(1).join('|');
                }
                return escape('{{') + '[[!bu;#fff;;wiki;Template:' + content[0] +
                    ']' + content[0] + ']' + params + escape('}}');
            },
            '(?:as of|Asof)': function(content) {
                content = content.split('|');
                var months = [
                    'January', 'February', 'March', 'April', 'May',
                    'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ];
                var date = [];
                var keys = {};
                for (var i=0; i<content.length; ++i) {
                    var m = content[i].match(/(\w+)\s*=\s*(\w+)/);
                    if (m) {
                        keys[m[1].toLowerCase()] = m[2];
                    } else {
                        date.push(content[i]);
                    }
                }
                var str = 'As of ';
                if (keys.since) {
                    str = 'Since ';
                }
                if (keys.lc == 'y') {
                    str = str.toLowerCase();
                }
                if (keys.df && keys.df.toLowerCase() == 'us') {
                    return str + (date[1] ? months[date[1]-1]+' ' : '') +
                        (date[2] ? date[2]+', ':'') + date[0];
                } else {
                    return str + (date[2] ? date[2]+' ' : '') +
                        (date[1] ? months[date[1]-1]+' ' : '') + date[0];
                }
            }
        };
        function escape(text) {
            var chars = {
                '{': '&#123;',
                '}': '&#125;',
                '[': '&#91;',
                ']': '&#93;',
                '<': '&#60;',
                '>': '&#62;',
                "'": '&#39;'
            };
            Object.keys(chars).forEach(function(chr) {
                text = text.replace(new RegExp('\\' + chr, 'g'), chars[chr]);
            });
            return text;
        }
        text = $.terminal.amp(text.replace(/&nbsp;/g, ' ')).
        replace(/^\s*;\s*([^:]+):\s*/gm, function(_, header) {
            return '\n' + header + '\n\n';
        }).
        //replace(/(''\[\[[^\]]+\]])(?!'')/, '$1\'\'').
        replace(/^\s*(=+)\s*([^=]+)\s*\1/gm, function(_, _, text) {
            text = text.replace(/''([^']+)''/g, function(_, text) {
                return '][[bi;#fff;]' + text + '][[b;#fff;]';
            });
            return '\n[[b;#fff;]' + text + ']\n';
        }).
        replace(/\[\.\.\.\]/g, '...').
        replace(/<code><pre>(.*?)<\/pre><\/code>/g, function(_, str) {
            return escape(str);
        }).
        replace(/\[\[(?=<nowki\s*\/>)/, function(str) {
            return escape(str);
        }).
            replace(/\|\s*url={{google books[^}]+}}/g, '|url=').
            replace(/{{Cite([^}]+)}}(?![\s\n]*<\/ref>)/gi, function(_, cite) {
                var title = cite.match(/title\s*=\s*([^|]+)/i);
                var url = cite.match(/url\s*=\s*([^|]+)/i);
                if (title) {
                    if (url && url[1].match(/^http/)) {
                        return '[[!;;;;' + url[1].trim() + ']' +
                            title[1].trim() + ']';
                    } else {
                        return title[1].trim();
                    }
                } else {
                    return '';
                }
            }).
            replace(/<nowiki>([\s\S]*?)<\/nowiki>/g, function(_, wiki) {
                return escape(wiki);
            });
        var strip = [
            /<ref[^>]*\/>/g, /<ref[^>]*>[\s\S]*?<\/ref>/g,
            /\[\[(file|image):[^[\]]*(?:\[\[[^[\]]*]][^[\]]*)*]]/gi,
            /<!--[\s\S]*?-->/g, /<gallery>[\s\S]*?<\/galery>/g
        ];
        strip.forEach(function(re) {
            text = text.replace(re, '');
        });
        var re;
        for (var template in templates) {
            re = new RegExp('{{' + template + '\\|?(.*?)}}', 'gi');
            text = text.replace(re, function(_, content) {
                return templates[template](content) || '';
            });
        }
        // strip the rest of the templates
        re = /{{[^{}]*(?:{(?!{)[^{}]*|}(?!})[^{}]*)*}}/g;
        do {
            var cnt=0;
            text = text.replace(re, function (_) {
                cnt++; return '';
            });
        } while (cnt);
        var format_begin_re = /\[\[([!gbiuso]*);([^;]*)(;[^\]]*\])/i;
        function format(style, color) {
            var format_split_re = /(\[\[[!gbiuso]*;[^;]*;[^\]]*\](?:[^\]]*\\\][^\]]*|[^\]]*|[^\[]*\[[^\]]*)\]?)/i;
            return function(_, text) {
                return text.split(format_split_re).map(function(txt) {
                    function replace(_, st, cl, rest) {
                        return '[['+style+st+';'+(color||cl)+rest;
                    }
                    if ($.terminal.is_formatting(txt)) {
                        return txt.replace(format_begin_re, replace);
                    } else {
                        return '[[' + style + ';' + (color||'')+';]' +
                            txt + ']';
                    }
                }).join('');
            };
        }
        text = text.replace(/\[\[([^\]]+)\]\]/g, function(_, gr) {
            if (_.match(format_begin_re)) {
                // empty terminal formatting
                return _;
            }
            if (_.match(/<nowiki[^>]*>/)) {
                return $.terminal.escape_brackets(_);
            }
            gr = gr.replace(/^:(Category)/i, '$1').split('|');
            var result;
            if (gr.length == 1) {
                result = '[[!bu;#fff;;wiki]' + gr[0] + ']';
            } else {
                gr[1] = gr[1].replace(/''([^']+)''/gm, function(_, g) {
                    return '][[!bui;#fff;;wiki;'+gr[0]+']'+g+']'+
                        '[[!bu;#fff;;wiki;' + gr[0] + ']';
                });
                result = '[[!bu;#fff;;wiki;'+gr[0]+']'+gr[1]+']';
            }
            return result;
        }).
        replace(/'''((?:[^']|[^']'[^'])+)'''/g, function(_, g) {
            return '[[b;#fff;]' + g.replace(/'/g, '&#39;') + ']';
        }).
        replace(/'''((?:([^']+|[\s\S]+(?:(?=[^']''[^'])|(?![^']'''[^'])))))'''(?=[^']|$)/g, '[[b;#fff;]$1]').
        replace(/^(\n\s*)*/, '').
        replace(/([^[])\[(\s*(?:http|ftp)[^\[ ]+) ([^\]]+)\]/g,
                function(_, c, url, text) {
            function rep(_, str) {
                return '][[!i;;;;' + url + ']' + str +
                    '][[!;;;;' + url + ']';
            }
            text = text.replace(/'''([^']*(?:'[^']+)*)'''/g,
                                '$1').
            replace(/''([^']*(?:'[^']+)*)''/g,
                    rep);
            return c + '[[!;;;;' + url + ']' + text + ']';
        }).
        replace(/<blockquote>([\s\S]*?)<\/blockquote>/g, format('i')).
        replace(/''([^']+(?:'[^']+)*)''/g, format('i')).
        replace(/{\|.*\n([\s\S]*?)\|}/g, function(_, table) {
            var head_re = /\|\+(.*)\n/;
            var header;
            var m = table.match(head_re);
            if (m) {
                var head = m[1].trim().
                replace(/\[\[([^;]+)(;[^\]]+\][^\]]+\])/g,
                        function(_, style, rest) {
                    return '][[' + style + 'i' +
                        rest + '[[i;;]';
                });
            }
            table = table.replace(/^.*\n/, '').
            replace(head_re, '').split(/\|\-.*\n/);
            if (table.length == 1) {
                header = false;
                table = table[0].replace(/[\n\s]*$/, '').
                split(/\n/).map(function(text) {
                    return [text];
                });
            } else {
                if (table[0].match(/^!|\n!/)) {
                    header = true;
                }
                table = table.map(function(text) {
                    var re = /^[|!]|\n[|!]|\|\|/;
                    if (text.match(re)) {
                        return text.split(re).map(function(item) {
                            return item.replace(/\n/g, '').trim();
                        }).filter(function(item, i) {
                            return i !== 0;
                        });
                    } else {
                        return [];
                    }
                }).filter(function(row) {
                    return row.length;
                });
            }
            var result = '';
            if (head) {
                result = '\n[[i;;]' + head + '\n';
            }
            result += ascii_table(table, header);
            return result;
        }).replace(/#(REDIRECT)/i, '&#35;$1').
        replace(/(^\*.*(\n|$))+/gm, function(list) { // unordered list
            return '\n' + list;
        }).
        replace(/(^#.*(\n|$))+/gm, function(list) { // numbered list
            list = list.split(/^#\s*/m).slice(1);
            return '\n' + list.map(function(line, i) {
                return (list.length > 9 && i < 9 ? ' ' : '') + (i+1) +
                    '. ' + line;
            }).join('') + '\n';
        }).split(/(<pre[^>]*>[\s\S]*?<\/pre>)/).map(function(text, i) {
            var m = text.match(/<pre[^>]*>([\s\S]*?)<\/pre>/);
            var re = /([^\n])\n(?![\n*|+]|\s*[0-9]|:|--|\[\[!bu;#fff;;wiki\]Category)/gi;
            if (m) {
                return m[1];
            } else {
                return text.replace(re, '$1 ').replace(/ +/g, ' ');
            }
        }).join('').
        replace(/<[^>]+>/gm, ''). // strip rest of html tags
        replace(/\n{3,}/g, '\n\n'). // remove larger newline space
        replace(/\*(\S)/g, '* $1'); // Fix lists
        return text;
    }
    function print_error(err) {
        if (err.error) {
            term.error(err.error.message);
            term.error('in ' + err.error.file + ' at line ' +
                                 err.error.at);
            term.error(err.error.line);
        } else {
            term.error(err.message);
        }
    }
    var app = {
        rfc: function(cmd) {
            if (cmd.args[0] == '--help') {
                term.echo('Browser of RFC documents, using less command.\n\n' +
                          'If you execute without arguments you will get index page\n' +
                          'And on that page you can use / followed by text, to search\n' +
                          'links to RFC documents are clickable');
            } else {
                var number = cmd.args.length ? cmd.args[0] : null;
                term.pause();
                service.rfc(number)(function(err, rfc) {
                    if (err) {
                        print_error(err);
                    } else {
                        term.less(rfc.replace(/^[\s\n]+|[\s\n]+$/g, ''));
                    }
                    term.resume();
                });
            }
        },
        rick: function(cmd) {
            term.echo($('<iframe width="560" height="315" src="https://www.you' +
                        'tube.com/embed/dQw4w9WgXcQ?autoplay=1&controls=0&show' +
                        'info=0&loop=1" title="YouTube video player" framebord' +
                        'er="0" allow="accelerometer; autoplay; clipboard-writ' +
                        'e; encrypted-media; gyroscope; picture-in-picture" al' +
                        'lowfullscreen></iframe>'));
            term.echo("You've been Rick Rolled :). If you want to Rick Roll an" +
                      "yone just send them this link https://tinyurl.com/hidde" +
                      "n-command");
        },
        github: function(cmd) {
            // Terminal now have its own command line parser
            var parser = new optparse.OptionParser([
                ['-u', '--username USER', 'owner of the repo'],
                ['-r', '--repo REPO', 'repo to open']
            ]);
            parser.banner = 'usage: github [options]';
            var user, repo, branch = 'master';
            parser.on('username', function(opt, value) {
                user = value;
            });
            parser.on('repo', function(opt, value) {
                repo = value;
            });
            parser.parse(cmd.args);
            var base = 'https://api.github.com/repos';
            var base_content;
            var base_defer;
            function dir(path, callback) {
                var url = base + '/' + user + '/' + repo + '/contents/' + path;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data){
                        callback({
                            dirs: data.filter(function(object) {
                                return object.type == 'dir';
                            }),
                            files: data.filter(function(object) {
                                return object.type == 'file';
                            })
                        });
                    },
                    error: function(data) {
                        term.error('wrong directory').resume();
                    }
                });
            }
            function file(path, callback) {
                var url = 'https://raw.githubusercontent.com/' + user +
                    '/'+ repo + '/master/' + path;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: callback,
                    error: function(data) {
                        term.error('file not found').resume();
                    }
                });
            }
            function list(data) {
                term.echo(data.dirs.map(function(object) {
                    return colors.blue(object.name);
                }).concat(data.files.map(function(object) {
                    return object.name;
                })).join('\n'));
            }
            function show(path, callback) {
                term.pause();
                file(cwd + path, function(contents) {
                    callback(contents);
                    term.resume();
                });
            }
            if (user && repo) {
                var cwd = '/';
                base_defer = $.Deferred();
                dir('', function(data) {
                    base_content = data;
                    base_defer.resolve();
                });
                term.push(function(command) {
                    var cmd = $.terminal.parse_command(command);
                    if (cmd.name == 'cd') {
                        var path = cmd.args[0];
                        if (cmd.args[0] == '..') {
                            path = cwd.replace(/[^\/]+\/$/, '');
                        } else {
                            path = (cwd == '/' ? '' : cwd) + cmd.args[0];
                        }
                        term.pause();
                        base_defer = $.Deferred();
                        dir(path, function(data) {
                            base_content = data;
                            cwd = path;
                            if (!cwd.match(/\/$/)) {
                                cwd += '/';
                            }
                            term.resume();
                            base_defer.resolve();
                        });
                    } else if (cmd.name == 'less') {
                        show(cmd.args[0], term.less.bind(term));
                    } else if (cmd.name == 'cat') {
                        show(cmd.args[0], term.echo);
                    } else if (cmd.name == 'ls') {
                        if (cmd.args == 0) {
                            list(base_content);
                        } else {
                            term.pause();
                            dir(cmd.args[0], function(data) {
                                list(data);
                                term.resume();
                            });
                        }
                    } else if (cmd.name === 'help') {
                        term.echo('available commands: cd, ls, less, cat');
                    } else {
                        term.echo('unknown command ' + cmd.name + ' try [[;#fff;]help]');
                    }
                }, {
                    prompt: function(callback) {
                        var name = colors.green(user + '&#64;' + repo);
                        var path = cwd;
                        if (path != '/') {
                            path = '/' + path.replace(/\/$/, '');
                        }
                        callback(name + colors.grey(':') + colors.blue(path) + '$ ');
                    },
                    name: 'github',
                    completion: function(string, callback) {
                        var command = $.terminal.parse_command(this.get_command());
                        var m = string.match(/(.*)\/([^\/]+)/);
                        if (m) {
                            dir(m[1], function(data) {
                                if (command.name == 'cd') {
                                    callback(data.dirs.map(function(object) {
                                        return m[1] + '/' + object.name + '/';
                                    }));
                                } else {
                                    callback(data.files.map(function(object) {
                                        return m[1] + '/' + object.name + '/';
                                    }).concat(data.dirs.map(function(object) {
                                        return m[1] + '/' + object.name;
                                    })));
                                }
                            });
                        } else {
                            base_defer.then(function() {
                                if (command.name == 'cd') {
                                    callback(base_content.dirs.map(function(object) {
                                        return object.name + '/';
                                    }));
                                } else {
                                    callback(base_content.files.map(function(object) {
                                        return object.name;
                                    }).concat(base_content.dirs.map(function(object) {
                                        return object.name + '/';
                                    })));
                                }
                            });
                        }
                    }
                });
            } else {
                term.echo('Browse github repo using unix commands\n\n' + parser);
            }
        },
        jargon: function(cmd) {
            if (!cmd.args.length) {
                var msg = 'This is the Jargon File, a comprehensiv'+
                    'e compendium of hacker slang illuminating man'+
                    'y aspects of hackish tradition, folklore, and'+
                    ' humor.\n\nusage: jargon [-s] [QUERY]\n\n-s s'+
                    'earch jargon file';
                term.echo(msg, {keepWords: true});
            } else if (cmd.args[0] == '-s') {
                term.pause();
                var search_term = cmd.rest.replace(/^-s/, '').trim();
                if (!search_term.match(/%/)) {
                    search_term = '%' + search_term + '%';
                }
                service.jargon_search(search_term)(function(err, list) {
                    if (err) {
                        print_error(err);
                    } else {
                        term.echo(list.map(function(row) {
                            return '[[!bu;#fff;;jargon]' + row.term + ']';
                        }).join('\n'));
                    }
                    term.resume();
                });
            } else {
                term.pause();
                // NOTE: when paste using mouse middle rpc jargon
                //       function don't return result
                var word = cmd.args.join(' ').replace(/\s+/g, ' ');
                service.jargon(word)(function(err, result) {
                    if (err) {
                        print_error(err);
                    } else {
                        var def = $.map(result, function(entry) {
                            var text = '[[b;#fff;]' + entry.term + ']';
                            if (entry.abbr) {
                                text += ' ('+entry.abbr.join(', ')+')';
                            }
                            var re = new RegExp("((?:https?|ftps?)://\\S+)|" +
                                                "\\.(?!\\s|\\]\\s)\\)?", "g");
                            var def = entry.def.replace(re, function(text, g) {
                                return g ? g : (text == '.)' ? '.) ' : '. ');
                            });
                            re = /\[(?![^;\]]*;[^;\]]*;[^\]]*\])[^\]]+\]/g;
                            def = def.replace(re, function(text) {
                                return text.replace(/\]/g, '\\]');
                            });
                            return text + '\n' + def + '\n';
                        }).join('\n');
                        def = $.terminal.format_split(def).map(function(str) {
                            if ($.terminal.is_formatting(str)) {
                                return str.replace(/^\[\[([bu]{2};)/, '[[!$1');
                            }
                            return str;
                        }).join('');
                        term.echo(def.trim(), {
                            keepWords: true
                        });
                    }
                    term.resume();
                });
            }
        },
        wikipedia: function(cmd) {
            function wiki(callback) {
                var defer = $.Deferred();
                $.ajax({
                    url: url,
                    data: {
                        action: 'query',
                        prop:'revisions',
                        rvprop: 'content',
                        format:'json',
                        titles: wiki_article
                    },
                    dataType: 'jsonp',
                    success: function(data) {
                        var pages = data.query.pages;
                        var article = Object.keys(pages).map(function(key) {
                            var page = pages[key];
                            if (page.revisions) {
                                return page.revisions[0]['*'];
                            } else if (typeof page.missing != 'undefined') {
                                return 'Article Not Found';
                            }
                        }).join('\n');
                        article = wikipedia(article, cmd.rest);
                        if ($.isFunction(callback)) {
                            callback(article);
                        }
                        defer.resolve(article);
                    }
                });
                return defer.promise();
            }
            // -----------------------------------------------------------------
            function getWikiDict(lang) {
                lang = lang.toLowerCase();
                var url = 'https://' + lang + '.wikipedia.org/w/api.php?' + $.param({
                    action: 'query',
                    format: 'json',
                    meta: 'siteinfo',
                    siprop: 'namespaces'
                });
                return $.get('https://jcubic.pl/proxy.php?csurl=' + encodeURIComponent(url))
                    .then(function(data) {
                        var result = {};
                        result[lang] = {};
                        var namespaces = data.query.namespaces;
                        Object.keys(namespaces).forEach(function(key) {
                            var spec = namespaces[key];
                            if (spec.canonical) {
                                result[lang][spec.canonical] = spec['*'];
                            }
                        });
                        return result;
                    });
            }
            // -----------------------------------------------------------------
            function exit() {
                wiki_stack.pop();
                if (!wiki_stack.length) {
                    term.option('convertLinks', true);
                }
            }
            // -----------------------------------------------------------------
            function search() {
                $.ajax({
                    url: url,
                    data: {
                        action: 'opensearch',
                        format: 'json',
                        limit: 100,
                        search: cmd.rest.replace(/^-s\s*/, '')
                    },
                    dataType: 'jsonp',
                    success: function(data) {
                        if (data[1].length && data[2].length) {
                            var text = data[1].map(function(term, i) {
                                return '[[!bu;#fff;;wiki]' + term + ']\n' +
                                    data[2][i];
                            }).join('\n\n');
                            term.less($.terminal.amp(text), {
                                onExit: exit
                            });
                            term.resume();
                        }
                    }
                });
            }
            // -----------------------------------------------------------------
            function cont(wiki_article, dict) {
                var cat = dict ? dict['Category'] : 'Category';
                var re = new RegExp('^' + cat + ':');
                var re_format = new RegExp('[\\n\\s]*(\\[\\[!bu;#fff;;wiki(?:;|\\])' + cat + ')', 'g');
                if (wiki_article.match(re)) {
                    $.ajax({
                        url: url,
                        data: {
                            action: 'query',
                            list: 'categorymembers',
                            rvprop: 'content',
                            format:'json',
                            cmlimit: 500,
                            cmtitle: wiki_article
                        },
                        dataType: 'jsonp',
                        success: function(data) {
                            var members = data.query.categorymembers;
                            var text = members.map(function(member) {
                                return '[[!bu;#fff;;wiki]' + member.title + ']';
                            }).join('\n');
                            console.log({text});
                            wiki(function(article) {
                                text = article.replace(re_format, text + '\n\n$1');
                                term.less(text, {
                                    onExit: exit
                                });
                                term.resume();
                            });
                        }
                    });
                } else {
                    wiki(function(article) {
                        term.less(function(cols, callback) {
                            // quick fix for terminal bug
                            // https://github.com/jcubic/jquery.terminal/issues/455
                            article = $.terminal.format_split(article).map(function(str) {
                                if ($.terminal.is_formatting(str)) {
                                    return str.replace(/(\s+)\]$/, ']$1');
                                }
                                return str;
                            }).join('');
                            article = article.replace(re_format, '\n$1');
                            var lines = $.terminal.split_equal(article,
                                                               cols,
                                                               true);
                            callback(lines);
                        }, {
                            onExit: exit
                        });
                        term.resume();
                    });
                }
            }
            if (cmd.args.length === 0) {
                term.echo('Display contents of wikipedia articles\n' +
                          'usage:\n\twikipedia [-s STRING] [-l lang] {ARTICLE}\n\n' +
                          '-s {SEARCH TERM}\n' +
                          '-l {language of Wikipedia (same as subdomain), default en for English}');
            } else {
                term.pause();
                term.option('convertLinks', false);
                var opt = $.terminal.parse_options(cmd.args, {booleans: ['s']});
                var lang = opt.l || 'en';
                var url = 'https://' + lang + '.wikipedia.org/w/api.php?';
                if (opt._.length === 0) {
                    return;
                }
                var wiki_article = opt._.join(' ');
                wiki_stack.push({lang: lang, wiki_article: wiki_article});
                if (opt.s) {
                    search();
                } else {
                    if (lang === 'en') {
                        cont(wiki_article);
                    } else if (wiki_dict[lang]) {
                        cont(wiki_article, wiki_dict[lang]);
                    } else {
                        getWikiDict(lang).then(function(dict) {
                            $.extend(wiki_dict, dict);
                            cont(wiki_article, wiki_dict[lang]);
                        });
                    }
                }
            }
        },
        record: function(cmd) {
            if (cmd.args[0] == 'start') {
                term.history_state(true);
            } else if (cmd.args[0] == 'stop') {
                term.history_state(false);
            } else {
                term.echo('save commands in url hash so you can rerun them\n\n' +
                          'usage: record [stop|start]');
            }
        },
        snake: function(cmd) {
            games.snake(term);
        },
        tetris: function(cmd) {
            games.tetris(term);
        },
        rouge: function(cmd) {
            rouge(term);
            term.disable().hide();
        },
        matrix: function(cmd) {
            matrix(term);
        }
    };
    var help = 'Stay and play with the terminal. Type [[b;#fff;]help] to get list of commands';
    var hidden_commands = ['rick'];
    var term = $('#term').terminal(function(command) {
        var cmd = $.terminal.parse_command(command);
        if ($.isFunction(app[cmd.name])) {
            app[cmd.name](cmd);
        } else if (cmd.name == 'help') {
            var commands = Object.keys(app).filter(function(name) {
                return hidden_commands.indexOf(name) === -1;
            }).map(function(command) {
                return '[[b;#fff;]' + command + ']';
            });
            commands = commands.slice(0, -1).join(', ') + ' and ' + commands[commands.length-1];
            this.echo('Available commands: ' + commands, { keepWords: true });
        } else if (cmd.name == 'error') {
            this.echo(messages[cmd.args[0]]);
        } else {
            this.error('Command not found');
        }
    }, {
        onPaste: function() {
            //return false;
        },
        execHash: true,
        greetings: false,
        onInit: function() {
            this.echo(messages[code]);
            this.echo('\n' + help + '\n', {keepWords: true});
        },
        completion: function(string, callback) {
            var command = this.get_command();
            var cmd = $.terminal.parse_command(command);
            if (cmd.name == 'jargon') {
                callback(jargon);
            } else {
                callback(Object.keys(app).concat(['help']));
            }
        }
    });
    term.on('click', '.jargon', function() {
        var command = 'jargon "' + $(this).attr('href').replace(/\s+/g, ' ') + '"';
        term.exec(command).then(function() {
            if (term.settings().historyState) {
                term.save_state(command);
            }
        });
        return false;
    }).on('click', '.exec', function() {
        var command = $(this).attr('href');
        term.exec(command).then(function() {
            if (term.settings().historyState) {
                term.save_state(command);
            }
        });
        return false;
    }).on('click', '.wiki', function() {
        var article = $(this).attr('href').replace(/\s/g, ' ').replace(/&amp;/g, '&');
        var prev = wiki_stack[wiki_stack.length - 1];
        var lang = prev && prev.lang || 'en';
        var cmd = $.terminal.split_command('wikipedia -l ' + [lang, article].join(' '));
        app.wikipedia(cmd);
        return false;
    }).on('click', '.rfc', function() {
        var rfc = $(this).attr('href');
        var cmd = $.terminal.split_command('rfc ' + rfc);
        app.rfc(cmd);
        return false;
    });
    // ref: https://css-tricks.com/the-trick-to-viewport-units-on-mobile/
    function vh() {
      var vh = window.innerHeight * 0.01;
      // Then we set the value in the --vh custom property to the root of the document
      document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
    vh();
    $(window).on('resize', $.debounce(250, vh));
});
