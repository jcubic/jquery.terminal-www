// Basic tetris game created using tetris-engine & ascii-canvas
// Copyright (c) Jakub T. Jankiewicz <https://jcubic.pl/me>
// Released under MIT license
//
// ref: https://codepen.io/jcubic/pen/eYgdaaB
if (typeof games === 'undefined') {
  var games = {};
}

games.tetris = (function () {

    const { Canvas, Item } = canvas;

    class HighScore {
        constructor(db_name, name_size, update) {
            this._update = update;
            this._name_size = name_size;
            this._db = database.ref(db_name);
            this._scores = [];
            this._bind_events();
        }
        _bind_events() {
            this._db.once('value').then(snapshot => {
                const data = snapshot.val();
                if (data) {
                    this._scores = Object.values(data);
                    this.update();
                }
            });
            this._db.on('child_added', snapshot => {
                this._scores.push(snapshot.val());
                this.update();
            });
        }
        update() {
            this._sort_scores();
            this._update(this.scores);
        }

        _sort_scores() {
            this._scores.sort((a, b) => b.score - a.score);
        }
        get scores() {
            return this._scores.map(({name, score, ...rest}) => {
                name = this._limit_name(name);
                score = this._limit_score(score);
                return {name, score, ...rest};
            });
        }
        _limit_score(score) {
            if (score > 9999999999999) {
                return 'INF+';
            }
            return score;
        }
        _limit_name(name) {
            if (name.length > this._name_size) {
                return name.substring(0, this._name_size);
            }
            return name;
        }
        append(points, name = 'Anon') {
            if (!name) {
                return;
            }
            name = this._limit_name(name);
            const score = { name, score: points };
            this._db.push(score);
        }

    }

    class View {
        constructor(width, height) {
            this._name_size = 8;
            this._score_limit = 11;
            const sidebar_width = this._name_size + 8;
            const canvas_width = width * 2;
            this._canvas = new Canvas(canvas_width + sidebar_width + 3, height + 4);
            this._game_view = new Item('', { x: 1, y: 3 });
            const left = new Item(frame(canvas_width, height));
            const next_frame = new Item(frame(sidebar_width, 6), { x: canvas_width + 1 });
            const next_label = new Item('Next Shape', { x: canvas_width + 3, y: 1 });
            this._next_shape = new Item('', {x: canvas_width + 3, y: 3 });
            const highscore_frame = new Item(frame(sidebar_width, height - 9), { x: canvas_width + 1, y: 9});
            const highscore_label = new Item('Highscore', { x: canvas_width + 3, y: 10 });
            this._over_str = box(' Game Over ');
            this._pause_str = box(' Pause ');
            this._highscore = new Item('', { x: canvas_width + 2, y: 12 });
            this._over_item = new Item('', get_center(canvas_width, height, this._over_str));
            this._pause_item = new Item('', get_center(canvas_width, height, this._pause_str));
            this._status = new Item('', { x: 2, y: 1 });
            this._canvas.append(left);
            this._canvas.append(next_frame);
            this._canvas.append(next_label);
            this._canvas.append(highscore_frame);
            this._canvas.append(highscore_label);
            this._canvas.append(this._status);
            this._canvas.append(this._next_shape);
            this._canvas.append(this._game_view);
            this._canvas.append(this._over_item);
            this._canvas.append(this._pause_item);
            this._canvas.append(this._highscore);
        }
        render(state) {
            this._game_view.update(this.format(state.body, x => x.val));
            this._next_shape.update(this.format(state.nextShape.body));
            this._status.update(this.status(state));
            if (state.gameStatus === 3) {
                this.end();
            }
            return this._canvas.toString();
        }
        set scores(scores) {
            if (scores.length > this._score_limit) {
                scores = scores.slice(0, this._score_limit);
            }
            this._highscore.update(this._format_scores(scores));
        }
        _format_scores(scores) {
            return scores.map(state => format_score(this._name_size, state)).join('\n');
        }
        pause() {
            this._pause_item.update(this._pause_str);
        }
        resume() {
            this._pause_item.update('');
        }
        end() {
            this._over_item.update(this._over_str);
            this._pause_item.update('');
        }
        format(array, fn = (x) => x) {
            if (array) {
                return array.map(line => {
                    return line.map(x => fn(x) === 0 ? '  ' : '[]').join('');
                }).join('\n');
            }
            return '';
        }
        status({ score, level }) {
            return ` Score: ${score}; Level: ${level}`;
        }
    }

    class Tetris {
        constructor({width, height, speed = 800, level_up = 100, render = () => {} } = {}) {

            this._speed = speed;
            this._score = 0;
            this._render = render;
            this._level = 1;
            const max_speed = 150;
            const speed_dec = 50;
            let prev_score;

            this._view = new View(width, height);
            const high_score = new HighScore('tetris', 8, (scores) => this._view.scores = scores);
            this._game = new tetris.Engine(
                width,
                height,
                (state) => {
                    this._score = calculate_score(state);
                    if (prev_score !== this._score) {
                        prev_score = this._score;
                        const next_level = Math.floor(this._score / level_up) + 1;
                        if (this._score > 0 && next_level > this._level) {
                            ++this._level;
                            if (this._speed > max_speed) {
                                this._speed -= speed_dec;
                            }
                        }
                    }
                    if (state.gameStatus === 3) {
                        const name = prompt('What is your name: ');
                        high_score.append(this._score, name);
                        this.end();
                    }
                    this._update(state);
                    this._last_state = state;
                }
            );

            var game_keys = {
                ArrowUp: () => {
                    this._game.rotate();
                },
                ArrowDown: () => {
                    this._game.moveDown();
                },
                ArrowLeft: () => {
                    this._game.moveLeft();
                },
                ArrowRight: () => {
                    this._game.moveRight();
                }
            };
            var key_map = {
                ' ': () => {
                    this._run = !this._run;
                    if (this._run) {
                        this.run();
                    } else {
                        this.stop();
                    }
                },
                'q': () => {

                }
            };


            window.addEventListener('keydown', (e) => {
                if (game_keys[e.key] && this._run) {
                    game_keys[e.key]();
                } else if (key_map[e.key]) {
                    key_map[e.key]();
                }
            });
        }
        _update(state) {
            this._render(this._view.render({...state, score: this._score, level: this._level }));
        }
        _tick() {
            this._game.moveDown();
        }
        end() {
            this._view.end();
            this._run = false;
        }
        stop() {
            this._view.pause();
            this._update(this._last_state);
        }
        start() {
            this._game.start();
            this.run();
        }
        async run() {
            this._view.resume();
            this._run = true;
            while (this._run) {
                this._tick();
                await delay(this._speed);
            }
        }
    }

    function frame(width, height) {
        const line = '+' + new Array(width).fill('-').join('') + '+';
        const empty = '|' + new Array(width).fill(' ').join('') + '|';
        let output = [line, empty, line];
        output = output.concat(new Array(height).fill(empty));
        output.push(line);
        return output.join('\n');
    }

    function box(label) {
        const line = '+' + new Array(label.length).fill('-').join('') + '+';
        return [line, '|' + label + '|', line].join('\n');
    }

    function get_center(width, height, str) {
        const over_lines = str.split('\n');
        const size = {
            width: over_lines[0].length,
            height: over_lines.length
        };
        const x = Math.round((width + 1 - size.width) / 2);
        const y = 2 + Math.round((height - size.height) / 2);
        return { x, y };
    }

    function format_score(name_size, { name, score }) {
        score = score.toString();
        return ` ${name.padEnd(name_size + 1, ' ')} ${score.padStart(4, ' ')}`;
    }

    function delay(time) {
        return new Promise(resolve => {
            setTimeout(resolve, time);
        });
    }

    function calculate_score(state) {
        const {
            countDoubleLinesReduced: double,
            countLinesReduced: total,
            countTrippleLinesReduced: tripple,
            countQuadrupleLinesReduced: quadruple,
            countShapesFalled: shapes
        } = state.statistic;
        const normal = total - (quadruple + tripple + double);
        return shapes + (normal * 5) + (quadruple * 30) + (tripple * 15) + (double * 10);
    }



    return function init(term, { width = 15, height = 25, speed = 800 } = {}) {
        let ROWS, COLS, canvas_width, canvas_height;
        const font = term.geometry().char;
        const canvas = $('canvas.tetris')[0];
        const ctx = canvas.getContext('2d');
        reset();

        const game = new Tetris({ width, height, speed, render });

        const resizer = new ResizeObserver(entires => {
            reset();
        });

        resizer.observe(canvas);

        window.addEventListener('keydown', function(e) {
            if (e.key === 'q') {
                quit();
            }
        });

        canvas.classList.add('running');
        term.disable();
        game.start();

        function render(text) {
            clear();
            const lines = text.split('\n');
            for (let line = 0; line < lines.length; ++line) {
                ctx.fillText(lines[line], 10, 10 + (font.height * line));
            }
        }

        function reset() {
            canvas_width = window.innerWidth;
            canvas_height = window.innerHeight;
            COLS = Math.floor((canvas_width - 20) / font.width);
            ROWS = Math.floor((canvas_height - 20) / font.height);
            canvas.width = canvas_width;
            canvas.height = canvas_height;
            ctx.font = '14px monospace';
            ctx.textBaseline = "hanging";
            clear();
        }

        function clear() {
            ctx.fillStyle = 'black';
            ctx.fillRect(0, 0, canvas_width, canvas_height);
            ctx.fillStyle = '#cccccc';
        }

        function quit() {
            resizer.unobserve(canvas);
            game.end();
            canvas.classList.remove('running');
            setTimeout(function() {
                term.enable();
            }, 0);
        }
    };

})();
