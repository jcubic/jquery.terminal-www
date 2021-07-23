// Matrix effect on a Canvas
// Copyright (c) Jakub T. Jankiewicz <https://jcubic.pl>
// ref: https://codepen.io/jcubic/pen/rNeNwgB

var matrix = (function() {

    var katagana = gen_unicode(0x30A1, 0x30F6);
    var hiragana = gen_unicode(0x3041, 0x3096);

    // ---------------------------------------------------------------
    class Matrix {
      constructor(canvas, { font_size = 14, width, height } = {}) {
        this._canvas = canvas;
        this._ctx = canvas.getContext('2d');
        this._font_size = font_size;
        this._drops = [];
        this._chars = katagana.concat(hiragana);
        this.resize(width, height);
      }
      random_char() {
        return rnd(this._chars);
      }
      render_char(char, x, y) {
        this._ctx.fillText(char, x, y);
      }
      start() {
        let frames = 0;
        this._run = true;
        const self = this;
        (function loop() {
          if (frames++ % 2 === 0) {
            self.render(); // slower render
          }
          if (self._run) {
            requestAnimationFrame(loop);
          }
        })()
      }
      stop() {
        this._run = false;
      }
      reset() {
        for (let x = 0; x < this._columns; x++) {
          this._drops[x] = 255;
        }
      }
      resize(width, height) {
        this._width = width;
        this._height = height;
        // ref: https://blog.codepen.io/2013/07/29/full-screen-canvas/
        this._canvas.width = width;
        setTimeout(() => {
          this._canvas.height = height;
          this.reset();
        }, 0);
        this._columns = Math.round(width / this._font_size);
      }
      clear() {
        this._ctx.fillStyle = 'rgba(0, 0,0,0.05)';
        this._ctx.fillRect(0, 0, this._width, this._height);
        this._ctx.fillStyle = '#0F0';
        this._ctx.font = this._font_size + "px monospace";
      }
      render() {
        this.clear();
        for (let col = 0; col < this._drops.length; col++) {
          const char = this.random_char();
          const x = col * this._font_size;
          const y = this._drops[col] * this._font_size;
          this.render_char(char, x, y);
          if (y > this._height && Math.random() > .975) {
            this._drops[col] = 0;
          }
          this._drops[col]++;
        }
      }
    }

    // ---------------------------------------------------------------
    // :: Init code
    // ---------------------------------------------------------------
    return function(canvas) {

        const matrix = new Matrix(canvas, {
            font_size: 14,
            width: width(),
            height: height()
        });
        
        window.addEventListener('resize', e => {
            matrix.resize(width(), height());
        });

        return new Promise(function(resolve) {
            window.addEventListener('keydown', function(e) {
                if (e.key === 'q') {
                    matrix.stop();
                    canvas.classList.remove('running');
                    setTimeout(resolve, 0);
                }
            });
        
            canvas.classList.add('running');
            matrix.start();
        });
    };

    // ---------------------------------------------------------------
    // :: Utils
    // ---------------------------------------------------------------
    function gen_unicode(start, end) {
      var chars = [];
      for (var i = start; i <= end; ++i) {
        chars.push(String.fromCharCode(i));
      }
      return chars;
    }

    // ---------------------------------------------------------------
    function rnd(array) {
      return array[Math.floor(Math.random() * array.length)]
    }

    // ---------------------------------------------------------------
    function width() {
      // why -1 ?
      // without this there is horizontal scrollbar
      // I have no idea what is causing this
      return window.innerWidth - 1;
    }

    // ---------------------------------------------------------------
    function height() {
      return window.innerHeight;
    }

})();
