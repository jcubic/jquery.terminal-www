// Basic rouge game created using ROT.js
// Copyright (c) Jakub T. Jankiewicz <https://jcubic.pl>
// ref: https://codepen.io/jcubic/pen/oMbgym

if (typeof games === 'undefined') {
  var games = {};
}

games.rogue = (function() {

    function log(str) {
      //console.log(str);
    }

    var term;

    var Game = {
        display: null,
        map: [],
        player: null,
        maxGold: 150,
        maxHealth: 100,
        level: 1,
        init: function() {
            var container = $('.rouge');
            this.display = new ROT.Display();
            var size = this.display.computeSize(container.width(), container.height());
            this.width = size[0];
            this.height = size[1];
            this.display.setOptions({
                width: this.width,
                height: this.height
            });

            this._generateLevel();

            $(this.display.getContainer())
                .appendTo('.rouge');
        },
        destroy: function() {
            $('.rouge').empty();
            this.map = [];
            this.display = this.player = null;
            this.scheduler.clear();
            this.engine.lock();
            this.engine = null;
        }
    };
    // ---------------------------------------------------------------
    Game.drawStats = function() {
        //clear previous text
        var spaces = new Array(this.width).fill(' ').join('');
        this.display.drawText(0, this.height - 1, spaces);

        this.display.drawText(0, this.height - 1,
                              "Gold: " + this.player.getGold() +
                              " Dungeon: " + this.level +
                              " Level: " + this.player.getLevel() +
                              " Exp: " + this.player.getExp() +
                              " Health: " + this.player.getHealth() +
                              " AC: " + this.player.getAC());
    };
    // ---------------------------------------------------------------
    Game.drawTile = function(player, x, y, kill) {
        var enemy = Game.enemyPosition(x, y);
        if (enemy && (kill && (kill.getX() !== x && kill.getY() === y) ||
           !kill)) {
            enemy._draw();
        } else {
            var chr = player.getX() == x &&
                player.getY() === y ? '@' : Game.map[y][x].chr;
            var color;
            if (['+', '/'].includes(chr)) {
                color = '#82290F';
            } else if (['$', '@'].includes(chr)) {
                color = "#ff0";
            } else {
                color = "#fff";
            }
            Game.display.draw(x, y, chr, color);
        }
    };
    // ---------------------------------------------------------------
    Game._generateLevel = function(stairs) {
        log('--------------');
        var map = new ROT.Map.Digger(this.width, this.height - 1);
        var freeCells = [];
        this.map = [];
        var digCallback = function(x, y, value) {
            this.map[y] = this.map[y] || [];

            this.map[y][x] = {
                chr: value ? '#' : '.',
                value: null,
                visited: false
            };
            if (!value) {
                freeCells.push({x,y});
            }
        };
        map.create(digCallback.bind(this));
        var rooms = map.getRooms();
        for (var i=0; i<rooms.length; i++) {
            var room = rooms[i];
            room.getDoors(function(x, y) {
                var rand = Math.round(ROT.RNG.getUniform());
                this.map[y][x] = {chr: rand ? '/' : '+'};
                for (var i = 0; i<freeCells.length; ++i) {
                    var point = freeCells[i];
                    if (point.x === x && point.y === y) {
                        freeCells.splice(i, 1);
                        break;
                    }
                }
            }.bind(this));
        }
        this._generateGold(freeCells);
        this._generatePotions(freeCells);
        this._generateStairs(freeCells, stairs === '>' ? '<' : '>');
        this.enemies = this._createEnemies(freeCells, rand(5, 10));

        this.display.clear();
        if (stairs) {
            var p = this._generateStairs(freeCells, stairs);
            log(freeCells.length);
            this.player._x = p.x;
            this.player._y = p.y;
        } else {
            var lightPasses = function(x, y) {
                if (this.isFreeCell(null, x, y)) {
                    this.map[y][x].visited = true;
                    return true;
                }
                return false;
            }.bind(this);

            this.fov = new ROT.FOV.PreciseShadowcasting(lightPasses);
            this.player = this._createPlayer(freeCells);
        }
        this.drawStats();
        this._runScheduler();
        return freeCells;
    };
    // ---------------------------------------------------------------
    Game._runScheduler = function() {
        if (this.engine) {
            this.engine.lock();
        }
        this.scheduler = new ROT.Scheduler.Simple();
        this.scheduler.add(this.player, true);
        this.enemies.forEach(function(enemy) {
            this.scheduler.add(enemy, true);
        }.bind(this));
        this.engine = new ROT.Engine(this.scheduler);
        this.engine.start();
    }
    // ---------------------------------------------------------------
    function Weapon(min, max) {
        this._min = min;
        this._max = max;
    }
    Weapon.prototype.damage = function() {
        return rand(this._min, this._max);
    }
    // ---------------------------------------------------------------
    Game.debug_map = function() {
        var str = this.map.map(function(row, y) {
            return row.map(function(cell, x) {
                if (x == Game.player.getX() && y == Game.player.getY()) {
                    return '@';
                }
                return cell.chr;
            }).join('');
        }).join('\n')
        log(str);
    };

    // ---------------------------------------------------------------
    function rand(min, max) {
        return ROT.RNG.getUniformInt(min, max);
    }
    function randIndex(array) {
        return rand(0, array.length - 1);
    }
    function randomCell(cells) {
        if (!cells.length) {
            Game.debug_map();
            throw Error('Internal Error, no free cells');
        }
        var index = randIndex(cells);
        var cell = cells.splice(index, 1)[0];
        return cell;
    }
    // ---------------------------------------------------------------
    Game._generateGold = function(freeCells) {
        Game._generateGoodies(freeCells, 5, 10, function() {
            var gold = rand(5, this.maxGold);
            return {chr: "$", value: gold};
        });
    };
    // ---------------------------------------------------------------
    Game._generateGoodies = function(freeCells, min, max, fn) {
       var max = rand(min, max);
        for (var i = 0; i < max; i++) {
            var cell = randomCell(freeCells);
            this.map[cell.y][cell.x] = fn.call(this);
        }
    }
    // ---------------------------------------------------------------
    Game._generatePotions = function(freeCells) {
        Game._generateGoodies(freeCells, 2, 5, function() {
            var healing = rand(10, 20);
            return {chr: "!", value: healing};
        });
    }
    // ---------------------------------------------------------------
    Game._generateStairs = function(freeCells, chr) {
        if (chr === '<' && this.level > 1 || chr === '>') {
            var cell = randomCell(freeCells);
            this.map[cell.y][cell.x] = {chr: chr};
            return cell;
        }
    };
    // ---------------------------------------------------------------
    Game.isFreeCell = function(being, x, y) {
        if (being) {
            if (being.getX() === x && being.getY() === y) {
                return true;
            }
            if (Game.enemyPosition(x, y)) {
                return false;
            }
            if (Game.player.getX() === x && Game.player.getY() === y) {
                return false;
            }
        }
        var row = this.map[y];
        return row && row[x] && ['$', '.', '>', '<', '/', '!'].includes(row[x].chr);
    };

    // ---------------------------------------------------------------
    Game.areNeighbor = function(p1, p2) {
        return p1.getX() + 1 == p2.getX() && p1.getY() === p2.getY() ||
            p1.getX() - 1 == p2.getX() && p1.getY() === p2.getY() ||
            p1.getX() == p2.getX() && p1.getY() - 1 === p2.getY() ||
            p1.getX() == p2.getX() && p1.getY() + 1 === p2.getY() ||
            p1.getX() + 1 == p2.getX() && p1.getY() + 1 === p2.getY() ||
            p1.getX() + 1 == p2.getX() && p1.getY() - 1 === p2.getY() ||
            p1.getX() - 1 == p2.getX() && p1.getY() - 1 === p2.getY() ||
            p1.getX() - 1 == p2.getX() && p1.getY() + 1 === p2.getY();
    };
    // ---------------------------------------------------------------
    Game.enemyPosition = function(x, y) {
        var enemies = this.enemies.filter(function(enemy) {
            return enemy.getX() === x && enemy.getY() === y;
        });
        if (enemies.length) {
            if (enemies.length > 1) {
                log('error', enemies.length);
            }
            return enemies[0];
        }
        return null;
    }
    // ---------------------------------------------------------------
    Game._createPlayer = function(freeCells) {
        var cell = randomCell(freeCells);
        return new Player(cell.x, cell.y, new Weapon(2, 10));
    };
    function enemyWeapon() {
        var min = rand(1, 3);
        var max = rand(min, min + 2);
        return new Weapon(min, max);
    }
    // ---------------------------------------------------------------
    Game._createEnemies = function(freeCells, count) {
        var colors = ['#A83232', '#C49F1D', '#00349A', '#A90D58'];
        var enemies = {
            a: 10,
            L: 30,
            c: 12
        };
        var result = [];
        var keys = Object.keys(enemies);
        for (var i = 0; i < count; ++i) {
            var cell = randomCell(freeCells);
            if (!cell) {
                log("ERROR", {cell, cells: freeCells.slice()});
                continue;
            }
            var color = colors[randIndex(colors)];
            var enemy = keys[randIndex(keys)];
            var strength = enemy.toUpperCase() == enemy ? 2 : 1;
            var inc = rand(1, (1 * Math.ceil(Game.level / 3)));
            var health = enemies[enemy] + (inc * 5);
            function logValue(o) {
                log(o);
                return o;
            }
            var enemy = new Enemy({
                x: cell.x,
                y: cell.y,
                chr: enemy,
                color: color,
                health: health,
                attack: inc,
                ac: inc,
                exp: health * 2 * Game.level,
                // should damage be normal max number instead of random ?
                damage: rand(1, strength + (1 * Math.floor(Game.level / 2))),
                weapon: enemyWeapon()
            });
            log(enemy);
            result.push(enemy);
        }
        return result;
    }
    // ---------------------------------------------------------------
    function Player(x, y, weapon) {
        // levels: 1000 * num
        this._levels = [1, 2, 4, 6, 8, 10, 14, 20, 26, 38,
                            50, 60, 90, 100].map(function(n) {
            return n * 1000;
        })
        this._level = 0;
        this._chr = '@';
        this._exp = 0;
        this._x = x;
        this._y = y;
        this._damage = 1;
        this._health = Game.maxHealth;
        this._attack = 1;
        this._gold = 0;
        this._ac = 15;
        this._weapon = weapon;
        this._draw();
    }
    function Being() { }
    Being.prototype.getExp = function() { return this._exp; };
    Being.prototype.getLevel = function() { return this._level + 1; };
    // ---------------------------------------------------------------
    Being.prototype.getAC = function() { return this._ac; };
    Being.prototype.getX = function() { return this._x; };

    Being.prototype.getY = function() { return this._y; };
    Being.prototype.getHealth = function() { return this._health; };
    Being.prototype.getGold = function() { return this._gold; };
    Being.prototype.hit = function(damage) { this._health -= damage; };
    // ---------------------------------------------------------------
    Being.prototype.attack = function(adversary) {
        if (!Game.areNeighbor(this, adversary)) {
            throw new Error("You can't attach this adversary");
        }
        var attack = rand(1, 20) + this._attack; // is this how d20 works?
        log('attack ', this._chr, attack, attack >= adversary.getAC());
        if (attack >= adversary.getAC()) {
            var damage = this._weapon.damage() + this._damage;
            adversary.hit(damage);
            log('damage:', damage);
            Game.drawStats();
            if (adversary._health <= 0) {
                log('kill', adversary);
                if (adversary instanceof Player)  {
                    Game.engine.lock();
                    alert('Game Over');
                } else {
                    this.gainExp(adversary.getExp());
                    Game.enemies = Game.enemies.filter(function(enemy) {
                        if (enemy === adversary) {
                            Game.drawTile(
                                Game.player,
                                enemy.getX(),
                                enemy.getY(),
                                enemy
                            );
                            Game.scheduler.remove(adversary);
                            return false;
                        }
                        return true;
                    });
                }
            }
        }
    };
    Player.prototype = new Being();
    // ---------------------------------------------------------------
    Player.prototype._draw = function() {
        Game.fov.compute(this._x, this._y, 10, function(x, y, r, v) {
            Game.drawTile(this, x, y);
        }.bind(this));
    };
    // ---------------------------------------------------------------
    Player.prototype.act = function() {
        Game.engine.lock();
        /* wait for user input; do stuff when user hits a key */
        window.addEventListener("keydown", this);
    };
    // ---------------------------------------------------------------
    Player.prototype.gainExp = function(exp) {
        this._exp += exp;
        var limit;
        var max = this._levels.length;
        if (this._level < max) {
            limit = this._levels[this._level];
        } else {
            var above = this._level - max + 1;
            limit = this._levels.slice(-1)[0] + (above * 10000);
        }
        if (this._exp >= limit) {
            this._level++;
            this._damage++;
            if (this._level % 2 === 0) {
                this._ac++; // this should be from Armour
            }
        }
        Game.drawStats();
    }
    // ---------------------------------------------------------------
    Player.prototype.handleEvent = function(e) {
        var keyMap = {};
        keyMap[38] = 0;
        keyMap[33] = 1;
        keyMap[39] = 2;
        keyMap[34] = 3;
        keyMap[40] = 4;
        keyMap[35] = 5;
        keyMap[37] = 6;
        keyMap[36] = 7;

        var code = e.keyCode;
        if (code === 81) { //q
            window.removeEventListener("keydown", this);
            Game.destroy();
            setTimeout(function() {
                term.enable().show();
            }, 0);
        }
        if ([190, 188].includes(code)) {
            var stairs = {
                true: '>',
                false: '<'
            };
            if (['<', '>'].includes(Game.map[this._y][this._x].chr)) {
                if (code === 190) {
                    Game.level++;
                } else {
                    Game.level--;
                }
                Game._generateLevel(stairs[code === 188]);
                this._draw();
                window.removeEventListener("keydown", this);
                Game.engine.unlock();
            }
            return;
        }

        if (!(code in keyMap)) { return; }

        var diff = ROT.DIRS[8][keyMap[code]];
        var newX = this._x + diff[0];
        var newY = this._y + diff[1];

        var node = Game.map[newY][newX];
        var enemy = Game.enemyPosition(newX, newY);
        if (Game.isFreeCell(this, newX, newY) ||
            node.chr == '+' || enemy) {
            if (enemy) {
                this.attack(enemy);
            } else if (node.chr == '+') {
                node.chr = '/';
                this._draw();
            } else {
                this._x = newX;
                this._y = newY;
                this._draw();
                if (['$', '!'].includes(node.chr)) {
                    if (node.chr === '$') {
                        Game.map[newY][newX].chr = '.';
                        this._gold += node.value;
                    } else if (node.chr === '!') {
                        if (this._health < Game.maxHealth) {
                            Game.map[newY][newX].chr = '.';
                            this._health = Math.min(
                                Game.maxHealth,
                                this._health + node.value
                            );
                        }
                    }
                    Game.drawStats();
                }
            }
            window.removeEventListener("keydown", this);
            Game.engine.unlock();
        }
    };
    // ---------------------------------------------------------------
    function Enemy({x, y, chr, color, health, attack, weapon,
                    damage, exp, ac}) {
        this._chr = chr;
        this._color = color;
        this._health = health;
        this._attack = attack;
        this._damage = damage;
        this._exp = exp;
        this._ac = 5 + ac;
        this._x = x;
        this._y = y;
        this._weapon = weapon;
    }
    Enemy.prototype = new Being();
    Enemy.prototype._draw = function() {
        Game.display.draw(this._x, this._y, this._chr, this._color);
    };
    // ---------------------------------------------------------------
    Enemy.prototype.act = function() {
        var x = Game.player.getX();
        var y = Game.player.getY();
        var passableCallback = function(x, y) {
            return Game.isFreeCell(this, x, y);
        }.bind(this);
        var astar = new ROT.Path.AStar(x, y, passableCallback, {
            topology:4
        });

        var path = [];
        var pathCallback = function(x, y) {
            path.push([x, y]);
        }
        astar.compute(this._x, this._y, pathCallback);

        path.shift(); /* remove enemy position */
        if (path.length == 1) {
            this.attack(Game.player);
        } else if (path.length) {

            var newX = path[0][0];
            var newY = path[0][1];

            Game.fov.compute(
                Game.player.getX(),
                Game.player.getY(),
                10,
                function(x, y, r, visibility) {
                    if (this._x === x && this._y === y) {
                        Game.drawTile(Game.player, this._x, this._y, this);
                        this._x = newX;
                        this._y = newY;
                        this._draw();
                    }
                }.bind(this)
            );
        }
    };

    return function(t) {
        term = t;
        Game.init();
        return Game;
    }
})();
