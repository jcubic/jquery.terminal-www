/*!
 * jqbiwa - JQuery wrapper for biwascheme
 * Copyright (C) 2010 Jakub Jankiewicz <http://jcubic.pl> 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!BiwaScheme) {
    throw "BiwaScheme is not defiend";
}
if (!jQuery) {
    throw "jQuery is not defined";
}

(function($, undefined) {
    //redifine $ to use JQuery insted of Prototype
    $.jqbiwa = function() {
        BiwaScheme.define_libfunc('$', 1, 1, function(args) {
            return $(args[0]);
        });
        
        //create functions for all JQuery methods
        for (var i in jQuery.fn.init.prototype) {
            (function () {
                var fun = i;
                // create closure with "i" variable (without it "i" in functions 
                // inside BiwaScheme.define_libfunc call has always the last
                // property of jQuery object)
                if (fun == 'each') {
                    BiwaScheme.define_libfunc(".each", 2, 2, function(args) {
                        assert_closure(args[1]);
                        var intp = new BiwaScheme.Interpreter();
                        return $(args[0]).each(function(idx, elem) {
                            intp.invoke_closure(args[1], [$(elem)]);
                        });
                    });
                } else if (typeof $.fn.init.prototype[fun] == 'function') {
                    //methods that must invoke closure passed as second argument
                    if ($.inArray(fun, ["click", "blur", "change", "dblclick",
                                        "focus", "focusin", "focusout",
                                        "hover", "keydown", "keypress",
                                        "keyup", "load", "mousedown", 
                                        "mouseenter", "mouseleave",
                                        "mouseout", "mouseup","ready",
                                        "resize", "scroll", "select", 
                                        "submit", "unload"]) != -1) {
                        BiwaScheme.define_libfunc("." + fun, 2, 2, function(args) {
                            assert_closure(args[1]);
                            var intp = new BiwaScheme.Interpreter();
                            return $(args[0])[fun].apply(args[0], [function() {
                                intp.invoke_closure(args[1]);
                            }]);
                        });
                    } else {
                        // normal function
                        BiwaScheme.define_libfunc("." + fun, 1, null, function(args) {
                            return args[0][fun].apply(args[0], args.splice(1));
                        });
                    }
                } else {
                    // function that return variable (field) from jQuery object
                    BiwaScheme.define_libfunc("." + fun, 1, 1, function(args) {
                        return args[0][fun];
                    });
                }
            })();
        }
        //JQuery Utilities
        BiwaScheme.define_libfunc("$.browser.opera", 0, 0, function(args) {
            return $.browser.opera || false;
        });
        BiwaScheme.define_libfunc("$.browser.webkit", 0, 0, function(args) {
            return $.browser.webkit || false;
        });
        BiwaScheme.define_libfunc("$.browser.msie", 0, 0, function(args) {
            return $.browser.msie || false;
        });
        BiwaScheme.define_libfunc("$.browser.mozilla", 0, 0, function(args) {
            return $.browser.mozilla || false;
        });
        BiwaScheme.define_libfunc("$.each", 2, 2, function(args) {
            assert_closure(args[1]);
            assert_list(args[0]);
            var intp = new BiwaScheme.Interpreter();
            $.each(args[0].to_array(), function(idx, item) {
                intp.invoke_closure(args[1], [idx, item]);
            });
            return BiwaScheme.undef;
        });
        BiwaScheme.define_libfunc("$.map", 2, 2, function(args) {
            assert_closure(args[1]);
            assert_list(args[0]);
            var intp = new BiwaScheme.Interpreter();
            return $.map(args[0].to_array(), function(item, idx) {
                return intp.invoke_closure(args[1], [item, idx]);
            }).to_list();
        });
    };

})(jQuery);