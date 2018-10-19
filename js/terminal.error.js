/* global $ rpc code optparse location */
var messages = {
    401: [
        /* TODO: but the site don't use basic auth */
    ],
    500: [
        '888888888   .d8888b.   .d8888b.  ',
        '888        d88P  Y88b d88P  Y88b ',
        '888        888    888 888    888 ',
        '8888888b.  888    888 888    888 ',
        '     "Y88b 888    888 888    888 ',
        '       888 888    888 888    888 ',
        'Y88b  d88P Y88b  d88P Y88b  d88P ',
        ' "Y8888P"   "Y8888P"   "Y8888P"',
        '  ___       _                        _   ____                             _____',
        ' |_ _|_ __ | |_ ___ _ __ _ __   __ _| | / ___|  ___ _ ____   _____ _ __  | ____|_ __ _ __ ___  _ __',
        '  | || \'_ \\| __/ _ \\ \'__| \'_ \\ / _` | | \\___ \\ / _ \\ \'__\\ \\ / / _ \\ \'__| |  _| | \'__| \'__/ _ \\| \'__|',
        '  | || | | | ||  __/ |  | | | | (_| | |  ___) |  __/ |   \\ V /  __/ |    | |___| |  | | | (_) | |',
        ' |___|_| |_|\\__\\___|_|  |_| |_|\\__,_|_| |____/ \\___|_|    \\_/ \\___|_|    |_____|_|  |_|  \\___/|_|'
    ],
    403: [
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
        'Your are not allowed to access [[b;#fff;]' + location.pathname + '] page on this server'
    ],
    404: [
        '    d8888   .d8888b.      d8888  ',
        '   d8P888  d88P  Y88b    d8P888  ',
        '  d8P 888  888    888   d8P 888  ',
        ' d8P  888  888    888  d8P  888  ',
        'd88   888  888    888 d88   888  ',
        '8888888888 888    888 8888888888 ',
        '      888  Y88b  d88P       888  ',
        '      888   "Y8888P"        888',
        '  _   _       _     _____                     _ ',
        ' | \\ | | ___ | |_  |  ___|__  _   _ _ __   __| |',
        ' |  \\| |/ _ \\| __| | |_ / _ \\| | | | \'_ \\ / _` |',
        ' | |\\  | (_) | |_  |  _| (_) | |_| | | | | (_| |',
        ' |_| \\_|\\___/ \\__| |_|  \\___/ \\__,_|_| |_|\\__,_|',
        'There are no [[b;#fff;]' + location.pathname + '] page on this server'
    ]
};

rpc({
    url: '/service.php',
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
                    return '[[bu;#fff;;wiki;]' + wiki + ']';
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
                        return '[[bu;' + color + ';;wiki]' + m[1] + ']';
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
                pron = '[[bu;#fff;;wiki;Help:IPA for English]' + pron + ']';
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
                        return '][[bui;#fff;;wiki]' + wiki[0] + '][[i;;]';
                    } else {
                        return '][[bui;#fff;;wiki;' + wiki[0] + ']' +
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
                        return '][[bui;#fff;;wiki]' + wiki + '][[i;;]';
                    } else {
                        return '][[bui;#fff;;wiki;' + wiki[0] + ']' +
                            wiki[1] + '][[i;;]';
                    }
                }) + ']' + (author ? '\n-- ' + author : '');
            },
            'Cat main': function(content) {
                return 'The main article for this [[bu;#fff;;wiki' +
                    ';Help:category]Category] is [[bu;#fff;;wiki]' +
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
            '(?:tlx|tl)': function(content) {
                content = content.split('|');
                var params = '';
                if (content.length > 1) {
                    params = '|' + content.slice(1).join('|');
                }
                return escape('{{') + '[[bu;#fff;;wiki;Template:' + content[0] +
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
        text = text.replace(/&nbsp;/g, ' ').
        replace(/^\s*;\s*([^:]+):\s*/gm, function(_, header) {
            return '\n' + header + '\n\n';
        }).
        replace(/&/g, '&amp;').
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
        replace(/{{Cite([^}]+)}}(?![\s\n]*<\/ref>)/gi,
                function(_, cite) {
            var title = cite.match(/title\s*=\s*([^|]+)/i);
            var url = cite.match(/url\s*=\s*([^|]+)/i);
            if (title) {
                if (url) {
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
                result = '[[bu;#fff;;wiki]' + gr[0] + ']';
            } else {
                gr[1] = gr[1].replace(/''([^']+)''/gm, function(_, g) {
                    return '][[bui;#fff;;wiki;'+gr[0]+']'+g+']'+
                        '[[bu;#fff;;wiki;' + gr[0] + ']';
                });
                result = '[[bu;#fff;;wiki;'+gr[0]+']'+gr[1]+']';
            }
            return result;
        }).replace(/'''([^']+(?:'[^']+)*)'''/g, format('b', '#fff')).
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
            var re = /([^\n])\n(?![\n*|+]|\s*[0-9]|:|--|\[\[bu;#fff;;wiki\]Category)/gi;
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
    function less(text, exit) {
        var export_data = term.export_view();
        var cols, rows;
        var pos = 0;
        //string = $.terminal.escape_brackets(string);
        var original_lines;
        var lines;
        var prompt;
        var left = 0;
        function print() {
            term.clear();
            if (lines.length-pos > rows-1) {
                prompt = ':';
            } else {
                prompt = '[[;;;inverted](END)]';
            }
            term.set_prompt(prompt);
            var to_print = lines.slice(pos, pos+rows-1);
            var format_start_re = /^(\[\[[!gbiuso]*;[^;]*;[^\]]*\])/i;
            to_print = to_print.map(function(line, line_index) {
                if ($.terminal.have_formatting(line)) {
                    var result, start = -1, format, count = 0,
                        formatting = null, in_text = false, beginning = '';
                    for (var i=0, len=line.length; i<len; ++i) {
                        var m = line.substring(i).match(format_start_re);
                        if (m) {
                            formatting = m[1];
                            in_text = false;
                        } else if (formatting && line[i] === ']') {
                            if (in_text) {
                                formatting = null;
                                in_text = false;
                            } else {
                                in_text = true;
                            }
                        }
                        if (count === left && start == -1) {
                            start = i;
                            if (formatting && in_text && line[i] != ']') {
                                beginning = formatting;
                            }
                        } else if (i==len-1) {
                            if (left > count) {
                                result = '';
                            } else {
                                result = beginning + line.substring(start, len);
                                if (formatting && in_text && line[i] != ']') {
                                    result += ']';
                                }
                            }
                        } else if (count === left+cols-1) {
                            result = beginning + line.substring(start, i);
                            if (formatting && in_text) {
                                result += ']';
                            }
                            break;
                        }
                        if (((formatting && in_text) || !formatting) &&
                            line[i] != ']') {
                            // treat entity as one character
                            if (line[i] === '&') {
                                m = line.substring(i).match(/^(&[^;]+;)/);
                                if (!m) {
                                    throw new Error('Unclosed html entity in' +
                                                    ' line ' + (line_index+1) +
                                                    ' at char ' + (i+1));
                                }
                                i+=m[1].length-2; // because continue adds 1 to i
                                continue;
                            } else if (line[i] === ']' && line[i-1] === '\\') {
                                // escape \] counts as one character
                                --count;
                            } else {
                                ++count;
                            }
                        }
                    } // for line
                    return result;
                } else {
                    return line.substring(left, left+cols-1);
                }
            });
            if (to_print.length < rows-1) {
                while (rows-1 > to_print.length) {
                    to_print.push('~');
                }
            }
            term.echo(to_print.join('\n'));
        }
        function quit() {
            term.pop().import_view(export_data);
            //term.off('mousewheel', wheel);
            if ($.isFunction(exit)) {
                exit();
            }
        }
        function refresh_view() {
            cols = term.cols();
            rows = term.rows();
            if ($.isFunction(text)) {
                text(cols, function(new_lines) {
                    original_lines = new_lines;
                    lines = original_lines.slice();
                    print();
                });
            } else {
                original_lines = text.split('\n');
                lines = original_lines.slice();
                print();
            }
        }
        refresh_view();
        var scroll_by = 3;
        //term.on('mousewheel', wheel);
        var in_search = false, last_found, search_string;
        function search(start, reset) {
            var escape = $.terminal.escape_brackets(search_string),
                flag = search_string.toLowerCase() == search_string ? 'i' : '',
                start_re = new RegExp('^(' + escape + ')', flag),
                regex = new RegExp(escape, flag),
                index = -1,
                prev_format = '',
                formatting = false,
                in_text = false;
            lines = original_lines.slice();
            if (reset) {
                index = pos = 0;
            }
            for (var i=0; i<lines.length; ++i) {
                var line = lines[i];
                for (var j=0, jlen=line.length; j<jlen; ++j) {
                    if (line[j] === '[' && line[j+1] === '[') {
                        formatting = true;
                        in_text = false;
                        start = j;
                    } else if (formatting && line[j] === ']') {
                        if (in_text) {
                            formatting = false;
                            in_text = false;
                        } else {
                            in_text = true;
                            prev_format = line.substring(start, j+1);
                        }
                    } else if (formatting && in_text || !formatting) {
                        if (line.substring(j).match(start_re)) {
                            var rep;
                            if (formatting && in_text) {
                                rep = '][[;;;inverted]$1]' +
                                    prev_format;
                            } else {
                                rep = '[[;;;inverted]$1]';
                            }
                            line = line.substring(0, j) +
                                line.substring(j).replace(start_re, rep);
                            j += rep.length-2;
                            if (i > pos && index === -1) {
                                index = pos = i;
                            }
                        }
                    }
                }
                lines[i] = line;
            }
            print();
            term.set_command('');
            term.set_prompt(prompt);
            return index;
        }
        term.push($.noop, {
            resize: refresh_view,
            mousewheel: function(event, delta) {
                if (delta > 0) {
                    pos -= scroll_by;
                    if (pos < 0) {
                        pos = 0;
                    }
                } else {
                    pos += scroll_by;
                    if (pos-1 > lines.length-rows) {
                        pos = lines.length-rows+1;
                    }
                }
                print();
                return false;
            },
            name: 'less',
            keydown: function(e) {
                var command = term.get_command();
                if (term.get_prompt() !== '/') {
                    if (e.which == 191) {
                        term.set_prompt('/');
                    } else if (in_search &&
                               $.inArray(e.which, [78, 80]) != -1) {
                        if (e.which == 78) { // search_string
                            if (last_found != -1) {
                                last_found = search(last_found+1);
                            }
                        } else if (e.which == 80) { // P
                            last_found = search(0, true);
                        }
                    } else if (e.which == 81) { //Q
                        quit();
                    } else if (e.which == 39) { // right
                        left+=Math.round(cols/2);
                        print();
                    } else if (e.which == 37) { // left
                        left-=Math.round(cols/2);
                        if (left < 0) {
                            left = 0;
                        }
                        print();
                    } else {
                        // scroll
                        if (lines.length > rows) {
                            if (e.which === 38) { //up
                                if (pos > 0) {
                                    --pos;
                                    print();
                                }
                            } else if (e.which === 40) { //down
                                if (pos <= lines.length-rows) {
                                    ++pos;
                                    print();
                                }
                            } else if (e.which === 34) {
                                // Page up
                                pos += rows;
                                if (pos > lines.length-rows+1) {
                                    pos = lines.length-rows+1;
                                }
                                print();
                            } else if (e.which === 33) {
                                //Page Down
                                pos -= rows;
                                if (pos < 0) {
                                    pos = 0;
                                }
                                print();
                            }
                        }
                    }
                    if (!e.ctrlKey && !e.alKey) {
                        return false;
                    }
                } else {
                    // search
                    if (e.which === 8 && command === '') {
                        // backspace
                        term.set_prompt(prompt);
                    } else if (e.which == 13) { // enter
                        // basic search find only first
                        if (command.length > 0) {
                            in_search = true;
                            pos = 0;
                            search_string = command;
                            last_found = search(0);
                        }
                        return false;
                    }
                }
            },
            prompt: prompt
        });
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
                        less(rfc.replace(/^[\s\n]+|[\s\n]+$/g, ''));
                    }
                    term.resume();
                });
            }
        },
        github: function(cmd) {
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
                        show(cmd.args[0], less);
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
                    } else {
                        term.echo('unknown command ' + cmd.name);
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
                            return '[[bu;#fff;;jargon]' + row.term + ']';
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
                        term.echo(def.replace(/\n$/, ''), {
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
                        titles: cmd.rest
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
            function exit() {
                wiki_stack.pop();
                if (!wiki_stack.length) {
                    term.option('convertLinks', true);
                }
            }
            if (cmd.args.length === 0) {
                term.echo('Display contents of wikipedia articles\n' +
                          'usage:\n\twikipedia [-s STRING] {ARTICLE}\n\n' +
                          '-s {SEARCH TERM}');
            } else {
                term.pause();
                term.option('convertLinks', false);
                var url = 'https://en.wikipedia.org/w/api.php?';
                wiki_stack.push(cmd.rest.replace(/^-s\s*/, ''));
                if (cmd.rest.match(/^-s\s*/)) {
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
                                    return '[[bu;#fff;;wiki]' + term + ']\n' +
                                        data[2][i];
                                }).join('\n\n');
                                less(text, exit);
                                term.resume();
                            }
                        }
                    });
                } else if (cmd.rest.match(/^Category:/)) {
                    $.ajax({
                        url: url,
                        data: {
                            action: 'query',
                            list: 'categorymembers',
                            rvprop: 'content',
                            format:'json',
                            cmlimit: 500,
                            cmtitle: cmd.rest
                        },
                        dataType: 'jsonp',
                        success: function(data) {
                            var members = data.query.categorymembers;
                            var text = members.map(function(member) {
                                return '[[bu;#fff;;wiki]' + member.title + ']';
                            }).join('\n');
                            var re = /(\[\[bu;#fff;;wiki\]Category)/;
                            wiki(function(article) {
                                text = article.replace(re, text + '\n\n$1');
                                less(text, exit);
                                term.resume();
                            });
                        }
                    });
                } else {
                    wiki(function(article) {
                        less(function(cols, callback) {
                            var lines = $.terminal.split_equal(article,
                                                               cols,
                                                               true);
                            callback(lines);
                        }, exit);
                        term.resume();
                    });
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
        }
    };
    var help = 'type [[b;#fff;]help] to get list of commands';
    var term = $('#term').terminal(function(command) {
        var cmd = $.terminal.parse_command(command);
        if ($.isFunction(app[cmd.name])) {
            app[cmd.name](cmd);
        } else if (cmd.name == 'help') {
            var commands = Object.keys(app).map(function(command) {
                return '[[b;#fff;]' + command + ']';
            });
            commands = commands.slice(0, -1).join(', ') + ' and ' + commands[commands.length-1];
            this.echo('Available commands: ' + commands, {keepWords: true});
        } else if (cmd.name == 'error') {
            this.echo(messages[cmd.args[0]].join('\n'));
        }
    }, {
        onBlur: function() {
            return false;
        },
        execHash: true,
        greetings: messages[code].concat([help]).join('\n') + '\n',
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
        var command = 'jargon ' + $(this).data('text').replace(/\s/g, ' ');
        term.exec(command).then(function() {
            if (term.settings().historyState) {
                term.save_state(command);
            }
        });
    }).on('click', '.exec', function() {
        var command = $(this).data('text');
        term.exec(command).then(function() {
            if (term.settings().historyState) {
                term.save_state(command);
            }
        });
    }).on('click', '.wiki', function() {
        var article = $(this).data('text').replace(/\s/g, ' ');
        var cmd = $.terminal.split_command('wikipedia ' + article);
        wikipedia(cmd);
    }).on('click', '.rfc', function() {
        var rfc = $(this).data('text');
        var cmd = $.terminal.split_command('rfc ' + rfc);
        app.rfc(cmd);
    });
});
