/**@license
 * Example plugin using JQuery Terminal Emulator
 *
 * Copyright (C) 2010-2016 Jakub Jankiewicz <http://jcubic.pl/me>
 * Released under the MIT license
 *
 */
(function($) {
    $.extend_if_has = function(desc, source, array) {
        for (var i=array.length;i--;) {
            if (typeof source[array[i]] != 'undefined') {
                desc[array[i]] = source[array[i]];
            }
        }
        return desc;
    };
    var defaults = Object.keys($.terminal.defaults).concat(['greetings']);
    $.fn.dterm = function(interpreter, options) {
        var op = $.extend_if_has({}, options, defaults);
        op.enabled = false;
        var terminal = this.terminal(interpreter, op).css('overflow', 'hidden');
        if (!options.title) {
            options.title = 'JQuery Terminal Emulator';
        }
        if (options.logoutOnClose) {
            options.close = function(e, ui) {
                terminal.logout();
                terminal.clear();
            };
        } else {
            var close = options.close || $.noop;
            options.close = function(e, ui) {
                terminal.disable();
                close();
            };
        }
        var self = this;
        this.dialog($.extend(options, {
            resizeStop: function(e, ui) {
                var content = self.find('.ui-dialog-content');
                terminal.resize(content.width(), content.height());
            },
            open: function(e, ui) {
                terminal.focus();
                terminal.resize();
            },
            show: 'fade',
            closeOnEscape: false
        }));
        self.terminal = terminal;
        return self;
    };
})(jQuery);
