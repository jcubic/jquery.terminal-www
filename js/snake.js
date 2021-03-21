// Basic snake game created using modified matrix-snake & ascii-canvas
// Copyright (c) Jakub T. Jankiewicz <https://jcubic.pl>
// ref: https://codepen.io/jcubic/pen/LYbpowr

var snake = (function () {

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
    var db_snake = database.ref('snake');
    // -------------------------------------------------------------------------
    const { Canvas, Item } = canvas;

    const name_size = 8;
    const level_up = 25;
    const WIDTH = 30;
    const HEIGHT = 15;
    const score_size = HEIGHT;
    // -------------------------------------------------------------------------
    // Game Controler
    // -------------------------------------------------------------------------
    class Snake {
        constructor(width, height, { speed = 400, end = () => {}, tick = () => {}} = {}) {
            this._start_speed = speed;
            this._width = width;
            this._height = height;
            this._tick = tick;
            this._end = end;
            this._inc_points = 1;

            this._cb = new SnakeGame.CbObj();
            this._emitter = new Emitter(this._cb);
            this.empty();
            this.reset();
            this._scores = []
            db_snake.once('value').then(snapshot => {
                const data = snapshot.val();
                if (data) {
                    this._scores = Object.values(data);
                    this._sort_scores();
                    this._tick(this.render());
                }
            });
            db_snake.on('child_added', snapshot => {
                this._scores.push(snapshot.val());
                this._sort_scores();
                this._tick(this.render());
            });
        }
        emit(key) {
            this._emitter.emit(key);
        }
        stop() {
            this._stop = true;
        }
        reset() {
            this._level = 1;
            this._points = 0;
            this._speed = this._start_speed;
        }
        delay(time) {
            return new Promise(resolve => {
                setTimeout(resolve, time);
            });
        }
        async start() {
            this.reset();
            const { _width, _height, _cb, eat } = this;
            this._game = SnakeGame.prepare(_width, _height, _cb, eat.bind(this), this._end.bind(this));
            while (true) {
                if (this._stop) {
                    break;
                }
                // bug in matrix snake it throw exception on game over
                try {
                    this._emitter.trigger();
                    this.next();
                    this._tick(this.render());
                    await this.delay(this._speed);
                } catch(e) {
                    // bug in matrix snake it throw exception on game over
                    this._end();
                    this._tick(this.render());
                    this.empty();
                    console.log(e);
                    throw e;
                    break;
                }
            }
        }
        eat() {
            this._points += this._inc_points;
            if (this._points % level_up === 0) {
                ++this._level;
                if (this._speed > 100) {
                    this._speed -= 50;
                } else if (this._speed > 50) {
                    // slow speed inc on higher level/speed
                    this._speed -= 10;
                } else {
                    // more points on higher level/speed
                    this._inc_points++;
                }
            }
        }
        next() {
            this._matrix = this._game.next();
        }
        char(chr) {
            if (chr === 2) {
                return '@';
            }
            if (chr === 1) {
                return '#';
            }
            return ' ';
        }
        empty() {
            this._matrix = [];
            for (let i = 0; i < this._height; ++i) {
                const line = new Array(this._width).fill(0);
                this._matrix.push(line);
            }
        }
        _sort_scores() {
            this._scores.sort((a, b) => b.score - a.score);
            if (this._scores.length > score_size) {
                this._scores = this._scores.slice(0, score_size);
            }
        }
        set score(name = 'Anon') {
            if (!name) {
                return;
            }
            if (name.length > name_size) {
                name = name.substring(0, name_size);
            }
            const score = { name, score: this.points };
            db_snake.push(score);
        }
        get scores() {
            return this._scores;
        }
        get points() {
            return this._points;
        }
        get level() {
            return this._level;
        }
        status() {
            return ' Score: ' + this._points + '; Level: ' + this._level;
        }
        render() {
            return this._matrix.map(row => row.map(this.char).join('')).join('\n');
        }
    }

    // -------------------------------------------------------------------------
    // Emitter is used to delay the keys that change direction
    // so you can execute fast keystrokes and it will move when new state is genrated
    // otherwise it may end the game if you trigger keys before new state is genrated
    class Emitter {
        constructor(cb) {
            this._cb = cb;
            this._keys = [];
            this._last = '';
        }
        append(key) {
            this._keys.push(key);
        }
        emit(key) {
            if (Emitter.opposite[this._last] !== key) {
                this.append(key);
            }
        }
        trigger() {
            if (this._keys.length) {
                const dir = this._keys.shift();
                this._last = dir;
                this._cb.emitDir(dir);
            }
        }
    }
    Emitter.opposite = oposite();

    // -------------------------------------------------------------------------
    function oposite() {
        const result = {
            'up': 'down',
            'left': 'right'
        };

        Object.entries(result).map(([k,v]) => {
            result[v] = k;
        });
        return result;
    }

    // -------------------------------------------------------------------------
    function frame(width, height) {
        const line = '+' + new Array(width).fill('-').join('') + '+';
        const empty = '|' + new Array(width).fill(' ').join('') + '|';
        let output = [line, empty, line];
        output = output.concat(new Array(height).fill(empty));
        output.push(line);
        return output.join('\n');
    }

    // -------------------------------------------------------------------------
    function box(label) {
        const line = '+' + new Array(label.length).fill('-').join('') + '+';
        return [line, '|' + label + '|', line].join('\n');
    }

    // -------------------------------------------------------------------------
    function format_score({name, score}) {
        score = score.toString();
        return ` ${name.padEnd(name_size + 1, ' ')} ${score.padStart(4, ' ')}`;
    }

    // -------------------------------------------------------------------------
    class View {
        constructor(controller, {render = () => {}} = {}) {
            this._canvas = new Canvas(WIDTH + 3 + name_size + 7, HEIGHT + 4);
            this._controller = controller;
            this._render = render;
            const left = new Item(frame(WIDTH, HEIGHT));
            const right = new Item(frame(name_size + 8, HEIGHT), { x: WIDTH + 1 });

            this._status = new Item('', { x: 1, y: 1 });
            this._score = new Item('', { x: WIDTH + 2, y: 3 })
            this._board = new Item(this._controller.render(), { x:1, y: 3 });

            this._canvas.append(left);
            this._canvas.append(right);
            this._canvas.append(new Item('High Score', { x: WIDTH + 3, y: 1 }));
            this._canvas.append(this._status);
            this._canvas.append(this._score);
            this._canvas.append(this._board);

            this.render_score();

            this._over_str = box(' Game Over ');
            const over_lines = this._over_str.split('\n');
            const size = {
                width: over_lines[0].length,
                height: over_lines.length
            };
            const x = Math.round((WIDTH + 1 - size.width) / 2);
            const y = 2 + Math.round((HEIGHT - size.height) / 2)
            this._over_box = new Item('', {x: x, y: y});
            this._canvas.append(this._over_box);

        }
        render_score() {
            this._score.update(this._controller.scores.map(format_score).join('\n'));
        }
        end() {
            this._over_box.update(this._over_str);
        }
        render(str) {
            this._status.update(this._controller.status());
            this.render_score();
            this._board.update(str);
            this._render(this._canvas.toString());
        }
    }

    // -------------------------------------------------------------------------
    // Game Init
    // -------------------------------------------------------------------------
    function init(term) {
        // game controller
        let view;
        const game = new Snake(WIDTH, HEIGHT, {
            end: () => {
                end_game();
                view.end();
            },
            tick: (str) => view.render(str)
        });

        // ASCII view of the game
        view = new View(game, { render });
        // DOM render code
        let width, height, COLS, ROWS;
        const $canvas = document.querySelector('canvas.snake');
        const font = document.querySelector('.font').getBoundingClientRect();
        const ctx = $canvas.getContext('2d');
        reset();

        function reset() {
            width = window.innerWidth;
            height = window.innerHeight;
            COLS = Math.floor((width - 20) / font.width);
            ROWS = Math.floor((height - 20) / font.height);
            $canvas.width = width;
            $canvas.height = height;
            ctx.font = '14px monospace';
            ctx.textBaseline = "hanging";
            clear();
        }
        function clear() {
            ctx.fillStyle = 'black';
            ctx.fillRect(0, 0, width, height);
            ctx.fillStyle = '#cccccc';
        }

        var resizer = new ResizeObserver(entires => {
            reset();
            render(view._canvas.toString());
        });

        function quit() {
            resizer.unobserve($canvas);
            game.stop();
            $canvas.classList.remove('running');
            setTimeout(function() {
                term.enable();
            }, 0);
        }

        resizer.observe($canvas);

        function render(str) {
            clear();
            const text = str.split('\n');
            for (let line = 0; line < text.length; ++line) {
                ctx.fillText(text[line], 10, 10 + (font.height * line));
            }
        }

        var dir_mapping = {
            ArrowUp: 'up',
            ArrowDown: 'down',
            ArrowLeft: 'left',
            ArrowRight: 'right'
        };

        function end_game() {
            const name = prompt('Your Name');
            game.score = name;
        }
        window.addEventListener('keydown', function(e) {
            if (e.key === 'q') {
                quit();
            } else if (dir_mapping[e.key]) {
                game.emit(dir_mapping[e.key]);
            }
        });

        // ---------------------------------------------------------------------
        $canvas.classList.add('running');
        term.disable();
        game.start();
    }

    return init;
})();
