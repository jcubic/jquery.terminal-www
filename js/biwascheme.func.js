var undefined;
if (BiwaScheme !== undefined && jQuery !== undefined) {
    
    (function($) {
        BiwaScheme.define_libfunc('ajax-port', 1, 1, function(args) {
            assert_string(args[0]);
            return new BiwaScheme.Pause(function(pause) {
                new Ajax.Request(args[0], {
                    method: 'get',
                    onSuccess: function(transport){
                        var intp = new BiwaScheme.Interpreter();
                        var port = new BiwaScheme.Port(true, false);
                        port.data = transport.responseText.split("\n");
                        port.line = 0;
                        port.is_eof = function() {
                            return this.line == this.data.length;
                        };
                        port.get_string = function() {
                            return this.data[this.line++];
                        };
                        pause.resume(port);
                    },
                    onFailure: function() {
                        throw new BiwaScheme.Error('ajax transport failure');
                    }
                });
            });
        });

        BiwaScheme.define_libfunc('port-eof?', 1, 1, function(args) {
            assert_port(args[0]);
            return args[0].is_eof();
        });
        
        BiwaScheme.define_scmfunc('read-lines', 1, 1, "\
          (lambda (filename)\
            (let ((port (ajax-port filename)))\
                (let loop ((result '()))\
                     (if (port-eof? port)\
                         result\
                         (loop (append result (list (read-line port))))))))))");

        //(js-call (js-closure (lambda (x) (display (* x x)))) 10)
        BiwaScheme.define_libfunc('foo', 1, 1, function(args) {
            assert_closure(args[0]);
            //var intp = new BiwaScheme.Interpreter();
            return $.extend(function(ar, intp) {
                return intp.invoke_closure(args[0], ar) + 10;
            }, {
                closure_p: true,
                fname: "foo",
                inspect: function() { return "foo"; }
            });
        });                          

        // return all procedures from global environment
        BiwaScheme.define_libfunc('env', 0, 0, function(args) {
            var result = new Array();
            for(fun in window.BiwaScheme.CoreEnv) {
                result[result.length] = fun;
            }
            return result.to_list();
        });

        // return list of object properties like dir from python
        BiwaScheme.define_libfunc('dir', 1, 1, function(args) {
            var result = [];
            var object = args[0];
            for (i in object) {
                result.push(i);
            }
            return result.to_list();
        });

        // check if object is in list
        BiwaScheme.define_libfunc('contains?', 2, 2, function(args) {
            assert_list(args[1]);
            return $.inArray(args[0], args[1].to_array()) != -1;
        });

        // concatenate two or more string
        BiwaScheme.define_libfunc("concat", 1, null, function(args) {
            for (var i=args.length; i--;) {
                assert_string(args[i]);
            }
            return args.length == 1 ? args[0] : args.join('');
        });
        

        //bit functions
        BiwaScheme.define_libfunc('&', 2, 2, function(args) {
            return args[0] & args[1];
        });
        BiwaScheme.define_libfunc('^', 2, 2, function(args) {
            return args[0] ^ args[1];
        });
        BiwaScheme.define_libfunc('|', 2, 2, function(args) {
            return args[0] | args[1];
        });
        BiwaScheme.define_libfunc('~', 1, 1, function(args) {
            return ~args[0];
        });
        BiwaScheme.define_libfunc('>>', 2, 2, function(args) {
            return args[0] >> args[1];
        });
        BiwaScheme.define_libfunc('<<', 2, 2, function(args) {
            return args[0] << args[1];
        });
        // defining scheme functions
        BiwaScheme.define_libfunc('debug', 0, 0, function() {
            BiwaScheme.Debug = BiwaScheme.Debug ? false : true;
            return BiwaScheme.undef;
        });
        BiwaScheme.define_libfunc('trace', 0, 0, function() {
            shell.trace = shell.trace ? false : true;
            return BiwaScheme.undef;
        });
        BiwaScheme.define_libfunc('env', 0, 0, function(args) {
            var result = new Array();
            for(fun in window.BiwaScheme.CoreEnv) {
                result[result.length] = fun;
            }
            return result.to_list();
        });
        
        // overwrite default function read
        BiwaScheme.define_libfunc('read', 0, 0, function() {
            var parser = (new BiwaScheme.Parser(prompt()));
            return parser.getObject();
        });
        BiwaScheme.CoreEnv['nil'] = BiwaScheme.nil;
        BiwaScheme.CoreEnv['PI'] = Math.PI;
        //parse string - result could be pased to eval
        //biwascheme has read-from-string procedure
        BiwaScheme.define_libfunc('parse', 1, 1, function(arg) {
            with(BiwaScheme) {
                var parser = (new BiwaScheme.Parser(arg[0]));
                return parser.getObject();
            }
        });
        BiwaScheme.define_libfunc('contains?', 2, 2, function(args) {
            var array = args[1].to_array();
            for (i=0; i<array.length; ++i) {
                if (args[0] == array[i]) {
                    return true;
                }
            }
            return false;
        });
        BiwaScheme.define_libfunc('gensym', 0, 0, function(args) {
            return BiwaScheme.gensym();
        });
        

        //(define alist (pairlis '(foo bar baz) '(lorem ipsum dolor)))
        BiwaScheme.define_scmfunc('pairlis', 2, 2, 
                                  "(lambda (keys values) \
                 (map cons keys values))");

        // function for curring (name taken from python)
        BiwaScheme.define_scmfunc('partial', 2, null,
                                  "(lambda (fun . partial-args) \
                 (lambda args \
                    (apply fun (append partial-args args))))");

        //tail recursive factorial
        BiwaScheme.define_scmfunc('!', 1, 1, 
                                  "(lambda (n) \
                (let iter ((n n) (result 1)) \
                    (if (= n 0) \
                        result \
                        (iter (- n 1) (* result n)))))");
        
        BiwaScheme.define_scmfunc('**', 1, 1, 
                                  "(lambda (x y) \
                (cond \
                    ((= y 0) 1) \
                    ((< y 0) (** (/ 1 x) (- y))) \
                    ((= y 1) x) \
                    (else \
                        (* x (** x (- y 1))))))");

        BiwaScheme.define_scmfunc('hash->alist', 1, 1, 
                                  "(lambda (hash) \
                (define (element->cons key) \
                    (key . (hashtable-ref hash key #f))) \
                (let iter ((keys (hashtable-keys hash)) (result '())) \
                    (if (null? keys) \
                        (reverse result) \
                    (iter (cdr keys) (cons (element->cons (car keys)) result)))))");

    })(jQuery);
}