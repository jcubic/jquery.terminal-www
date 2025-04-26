<?php // -*- mode: web -*-
header("X-Powered-By: ");
require('utils.php');
$version = version();
?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Examples for jQuery Terminal, Web Based Terminal</title>
    <link rel="canonical" href="https://terminal.jcubic.pl/examples.php"/>
    <meta name="author" content="Jakub T. Jankiewicz - jcubic&#64;onet.pl"/>
    <meta name="Description" content="This is a bunch of useful things that you can do with jQuery Terminal Emulator plugin. Live demos and source code likewise."/>
    <meta name="keywords" content="jquery,terminal,interpreter,console,bash,history,authentication,ajax,server,client"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="alternate" type="application/rss+xml" title="Notification RSS" href="https://terminal.jcubic.pl/notification.rss"/>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans+Mono&display=swap"
          rel="stylesheet" type="text/css" media="print"
          onload="this.media='all'" />
    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    <script src="js/biwascheme.js"></script>
    <!-- Other files -->
    <link href="css/jquery-ui-1.8.7.custom.css" rel="stylesheet"/>
    <script src="js/jquery-ui-1.8.7.custom.min.js"></script>
    <script src="js/code.js"></script>
    <script src="js/star_wars.js"></script>
    <!-- Terminal Files -->
    <script src="https://cdn.jsdelivr.net/gh/jcubic/static/js/wcwidth.js"></script>
    <script src="js/jquery.terminal.min.js?<?= md5(file_get_contents('js/jquery.terminal.min.js')) ?>"></script>
    <link href="css/jquery.terminal.min.css?<?= md5(file_get_contents('css/jquery.terminal.min.css')) ?>" rel="stylesheet"/>
    <link rel="stylesheet" href="css/style.css?<?= md5(file_get_contents('css/style.css')) ?>"/>
    <script src="js/dterm.js?<?= md5(file_get_contents('js/dterm.js')) ?>"></script>
    <script>var Interpreter = BiwaScheme.Interpreter;</script>
    <script src="js/biwascheme.func.js"></script>
    <script src="js/jqbiwa.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-polyfills/keyboard.js"></script>
    <script>if (window.module) module = window.module;</script>
    <!--[if IE]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Examples for jQuery Terminal plugin"/>
    <meta property="og:description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta property="og:url" content="https://terminal.jcubic.pl/examples.php"/>
    <meta property="og:site_name" content="JQuery Terminal Emulator Plugin"/>
    <meta property="og:image" content="https://terminal.jcubic.pl/signature.png"/>

    <meta name="twitter:image" content="https://terminal.jcubic.pl/signature.png"/>
    <meta name="twitter:image:alt" content="Main ASCII Art for jQuery Terminal"/>
    <meta name="twitter:title" content="Examples for jQuery Terminal plugin"/>
    <meta name="twitter:description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@jcubic"/>
    <meta name="twitter:creator" content="@jcubic"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <header id="main" role="presentation" aria-hidden="true"x><h1>jQuery Terminal Emulator Plugin</h1>
    <a href="/"><pre id="sig">
<div class="big">
      __ _____                     ________                              __
     / // _  /__ __ _____ ___ __ _/__  ___/__ ___ ______ __ __  __ ___  / /
 __ / // // // // // _  // _// // / / // _  // _//     // //  \/ // _ \/ /
/  / // // // // // ___// / / // / / // ___// / / / / // // /\  // // / /__
\___//____ \\___//____//_/ _\_  / /_//____//_/ /_/ /_//_//_/ /_/ \__\_\___/
          \/              /____/                                     <?=$version?>
</div>
<div class="medium">
      __ ____ ________                              __
     / // _  /__  ___/__ ___ ______ __ __  __ ___  / /
 __ / // // /  / // _  // _//     // //  \/ // _ \/ /
/  / // // /  / // ___// / / / / // // /\  // // / /__
\___//____ \ /_//____//_/ /_/ /_//_//_/ /_/ \__\_\___/
          \/                                  <?=$version?>
</div>
<div class="small">
      __ ____ ________
     / // _  /__  ___/__ ___ ______
 __ / // // /  / // _  // _//     /
/  / // // /  / // ___// / / / / /
\___//____ \ /_//____//_/ /_/ /_/
          \/              <?=$version?>

</div>
</pre><img src="signature.png"/><!-- for FB bigger then gihub ribbon --></a>
<pre class="separator">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</pre>
    </header>
    <nav>
      <ul>
        <li><a href="/#demo">Demo</a></li>
        <li><a href="/documentation.php">Documentation</a></li>
        <li><a href="/examples.php">Examples</a></li>
        <li><a href="https://stackoverflow.com/questions/tagged/jquery-terminal">Q&A</a></li>
        <li><a href="/#download">Download</a></li>
        <li><a href="/#comments">Comments</a></li>
        <li><a class="chat" href="https://gitter.im/jcubic/jquery.terminal">Chat</a></li>
        <li><a href="https://github.com/sponsors/jcubic">Donate</a></li>
      </ul>
    </nav>
    <a class="support-ribbon" href="https://support.jcubic.pl/"
       style="position: fixed; top: 0; right: 0; z-index:1000">
      <img style="border: 0;" src="https://terminal.jcubic.pl/support.svg"
           alt="Get Paid Support">
    </a>
    <a href="https://github.com/jcubic/jquery.terminal" class="github-corner" aria-label="View source on GitHub"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#151513; color:#fff; position: fixed; top: 0; border: 0; left: 0; transform: scale(-1, 1);" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style></a>
    <?php include('banner.php'); ?>
    <section>
      <article>
        <header id="examples"><h1>Examples</h1></header>
        <ul>
          <li><a href="#json_rpc_demo">JSON-RPC with Simple authentication</a></li>
          <li><a href="#jwt">JSON-RPC with JWT authentication</a></li>
          <li><a href="#simple_ajax">Simple AJAX example</a></li>
          <li><a href="#autocomplete">Autocomplete</a></li>
          <li><a href="#csrf"><abbr title="Cross-Site Request Forgery">CSRF</abbr></a></li>
          <li><a href="#syntax_highlight">SQL Syntax highlighter</a></li>
          <li><a href="#tilda">Quake like terminal</a></li>
          <li><a href="#dterm">Terminal in jQuery UI Dialog</a></li>
          <li><a href="#multiple-interpreters">Multiple interpreters</a></li>
          <li><a href="#starwars">Star Wars Animation</a></li>
          <li><a href="#ask">Ask before executing a command</a></li>
          <li><a href="#user-typing">Animation that emulate user typing</a></li>
          <li><a href="#progress-bar">Progress bar animation</a></li>
          <li><a href="#spinners">Spinners animation</a></li>
          <li><a href="#less">Less bash command</a></li>
          <li><a href="#pipe">Pipe operator</a></li>
          <li><a href="#bash-history">Bash history commands</a></li>
          <li><a href="#css-cursor">Smooth CSS3 cursor animation</a></li>
          <li><a href="#virtual">Virtual Keyboard with Terminal</a></li>
          <li><a href="#history">History API for commands</a></li>
          <li><a href="#shell">Shell</a></li>
          <li><a href="#different_look">Vintage, OS Like Terminals and 3D effects</a></li>
          <li><a href="#404">404 Error Page</a></li>
          <li><a href="#emoji">Emoji</a></li>
          <li><a href="#questions">Create Settings object from questions (form)</a></li>
          <li><a href="#terminal-widget">Terminal Widget</a></li>
          <li><a href="#reactjs-terminal">ReactJS Terminal</a></li>
          <li><a href="#electron-terminal">Electron Terminal</a></li>
          <li><a href="#parenthesis">Balancing parenthesis</a></li>
          <li><a href="#multiline">Multiline input</a></li>
          <li><a href="#rouge">Rouge like game</a></li>
          <li><a href="#confirm">Browser confirm replacement</a></li>
          <li><a href="#newline">Echo without newline</a></li>
          <li><a href="#ansi">ANSI artwork</a></li>
          <li><a href="#figlet">Figlet ASCII art fonts</a></li>
          <li><a href="#fontawesome">FontAwesome Icons</a></li>
          <li><a href="#mobile">Mobile demos</a></li>
          <li><a href="#codepen">Codepen Demos</a></li>
          <li><a href="#wild">In the wild</a></li>
        </ul>
      </article>
      <article id="json_rpc_demo">
        <header><h2>JSON-RPC with Simple Authentication</h2></header>
        <p>See <a title="JSON-RPC demo" href="rpc-demo.html">demo in action</a>. (If you want to copy code from examples click &ldquo;toogle highlight&rdquo; first)</p>
        <p>Javascript code:</p>
        <pre class="javascript">jQuery(function($) {
    $('#term').terminal("json-rpc-service-demo.php", {
        login: true,
        greetings: "You are authenticated"});
});</pre>
        <p>PHP code (in rpc_demo.php):</p>
        <pre class="php">&lt;?php
require('json_rpc.php');
&nbsp;
class Demo {
  static $login_documentation = "return auth token";
  public function login($user, $passwd) {
    if (strcmp($user, 'demo') == 0 &&
        strcmp($passwd, 'demo') == 0) {
      // If you need to handle more than one user you can
      // create new token and save it in database
      return md5($user . ":" . $passwd);
    } else {
      throw new Exception("Wrong Password");
    }
  }
&nbsp;
  static $ls_documentation = "list directory if token is" .
     " valid";
  public function ls($token, $path) {
    if (strcmp(md5("demo:demo"), $token) == 0) {
      if (preg_match("/\.\./", $path)) {
        throw new Exception("No directory traversal Dude");
      }
      $base = preg_replace("/(.*\/).*/", "$1",
                           $_SERVER["SCRIPT_FILENAME"]);
      $path = $base . ($path[0] != '/' ? "/" : "") . $path;
      $dir = opendir($path);
      while($name = readdir($dir)) {
        $fname = $path."/".$name;
        if (!is_dir($name) && !is_dir($fname)) {
          $list[] = $name;
        }
      }
      closedir($dir);
      return $list;
    } else {
      throw new Exception("Access Denied");
    }
  }
&nbsp;
  static $whoami_documentation = "return user information";
  public function whoami() {
    return array(
        "user-agent" => $_SERVER["HTTP_USER_AGENT"],
        "your ip" => $_SERVER['REMOTE_ADDR'],
        "referer" => $_SERVER["HTTP_REFERER"],
        "request uri" => $_SERVER["REQUEST_URI"]);
  }
}
&nbsp;
handle_json_rpc(new Demo());
?&gt;</pre>
        <p><strong>NOTE:</strong> If you use json_rpc.php file (which handle json-rpc) from the <a href="/#download">package</a> you have always help function which display all methods or documentation strings if you provide them.</p>
        <p>If you want secure login you should generate random token in login JSON-RPC function, and store it in database or session.<br/>For example: md5(time()). You can also use <a href="https://en.wikipedia.org/wiki/Secure_Sockets_Layer">SSL</a> to make it more secured.</p>
        <p>See <a title="JSON-RPC demo" href="rpc-demo.html">demo in action</a>. login is "demo" and password is "demo". Available command are "ls", "whoami", "help" and "help [rpc-method]"</p>
      </article>
      <article id="jwt">
        <header><h2>JSON-RPC with JWT authentication</h2></header>
        <p>See <a title="JWT Auth Demo" href="https://terminal.jcubic.pl/jwt/">demo in action</a>.</p>
        <p>The full code is available on <a href="https://github.com/jcubic/php-terminal-jwt">GitHub</a></p>
        <p>Javascript code:</p>
        <pre class="javascript">function interceptor(req, res) {
    if (res.error && res.error.message === 'Access token expired') {
         // TODO: remove this echo
         this.echo('Token expired: refreshing ...');
         this.pause();
         return new Promise(resolve => {
             $.jrpc('service.php', 'refresh', [], data => {
                 const re = /Refresh token expired/;
                 if (data.error && data.error.message.match(re)) {
                     this.logout();
                     return resolve({...res, error: data.error});
                 }
                 const token = data.result;
                 this.set_token(token);
                 req.params[0] = token;
                 const { method, params } = req;
                 $.jrpc('service.php', method, params, message => {
                     this.resume();
                     resolve(message);
                 });
             });
         });
     }
}
let term;
$(function() {
    term = $('#term').terminal(['service.php', {
        refresh() {
            // this command will manually referesh the token
            // you don't need this command, it's only for demo purpose
            return new Promise(resolve => {
                $.jrpc('service.php', 'refresh', [], (message) => {
                    this.set_token(message.result);
                    resolve();
                });
            });
        }
    }], {
         login: true,
         completion: true,
         describe: false,
         greetings: 'Welcome to JWT demo',
         rpc: interceptor
    });
});</pre>
        <p>see <a href="https://github.com/jcubic/php-terminal-jwt/blob/master/service.php">PHP Code</a></p>
      </article>
      <article id="simple_ajax">
        <header><h2>Simple AJAX example</h2></header>
        <p>If you for some reason don't want to use JSON-RPC you can create interpreter that will echo ajax responses and simple php script.</p>
        <pre class="javascript">$(function() {
    $('body').terminal(function(command, term) {
        term.pause();
        $.post('script.php', {command: command}).then(function(response) {
            term.echo(response).resume();
        });
    }, {
        greetings: 'Simple php example'
    });
});</pre>
        <p>From version 1.0.0 you can simplify that code using:</p>
        <pre class="javascript">$(function() {
    $('body').terminal(function(command, term) {
        return $.post('script.php', {command: command});
    }, {
        greetings: 'Simple php example'
    });
});</pre>
        <p><strong>NOTE:</strong> if you return a promise from interpreter it will call pause, wait for the response, then echo the response when it arrive and call resume.</p>
        <pre class="php">&lt;?php

if (isset($_POST['command'])) {
    echo "you typed '" . $_POST['command'] . "'.";
}</pre>
        <p>You can use different server side language instead of php.</p>
      </article>
      <article id="autocomplete">
        <header><h2>Autocomplete</h2></header>
        <p>Adding autocomplete to terminal is simple use complete option with array or function as in <a href="api_reference.php#completion">api documentation</a> or true value if you use JSON-RPC with <code>system.describe</code> or object as interpreter.</p>
        <p>You can also create custom completion, for instance add, menu with items that you can click on that's added on keypress, From version 0.12.0 of the terminal there are two new api methods <code><a href="api_reference.php#complete">complete</a></code> and <code><a href="api_reference.php#before_cursor">before_cursor</a></code> that simplify the code.</p>
        <p>From version 2.8.0 repo now includes the file that will add <strong>menu autocomplete automatically</strong>.</p>
        <pre class="html">
&lt;script src="https://unpkg.com/jquery.terminal/js/autocomplete_menu.js"&gt;&lt;/script&gt;
        </pre>
        <p>The file will monkey patch the terminal and create new option for terminal. To use menu autocomplete you just need this:</p>
        <pre class="javascript">$('body').terminal(function(command) {
}, {
    autocompleteMenu: true,
    completion: ['foo', 'bar', 'baz']
});</pre>
        <p>The complition options is the same, it can call callback function 2 argument, or return a promise. The value need to be array of strings.</p>
        <p>Below is first, original code that shows example, how to create autocomplete menu.</p>
        <pre class="javascript">var ul;
var cmd;
var empty = {
    options: [],
    args: []
};
var commands = {
    'get-command': {
        options: ['name', 'age', 'description', 'address'],
        args: ['clear']
    },
    'git': {
        args: ['commit', 'push', 'pull'],
        options: ['amend', 'hard', 'version', 'help']
    },
    'get-name': empty,
    'get-age': empty,
    'get-money': empty
};
var ul;
var term = $('body').terminal($.noop, {
    onInit: function(term) {
        var wrapper = term.cmd().find('.cursor').wrap('&lt;span/&gt;').parent()
            .addClass('cmd-wrapper');
        ul = $('&lt;ul&gt;&lt;/ul&gt;').appendTo(wrapper);
        ul.on('click', 'li', function() {
            term.insert($(this).text());
            ul.empty();
        });
    },
    keydown: function(e) {
        var term = this;
        // setTimeout because terminal is adding characters in keypress
        // we use keydown because we need to prevent default action for
        // tab and still execute custom code
        setTimeout(function() {
            ul.empty();
            var command = term.get_command();
            var name = command.match(/^([^\s]*)/)[0];
            if (name) {
                var word = term.before_cursor(true);
                var regex = new RegExp('^' + $.terminal.escape_regex(word));
                var list;
                if (name == word) {
                    list = Object.keys(commands);
                } else if (command.match(/\s/)) {
                    if (commands[name]) {
                        if (word.match(/^--/)) {
                            list = commands[name].options.map(function(option) {
                                return '--' + option;
                            });
                        } else {
                            list = commands[name].args;
                        }
                    }
                }
                if (word.length >= 2 && list) {
                    var matched = [];
                    for (var i=list.length; i--;) {
                        if (regex.test(list[i])) {
                            matched.push(list[i]);
                        }
                    }
                    var insert = false;
                    if (e.which == 9) {
                        insert = term.complete(matched);
                    }
                    if (matched.length && !insert) {
                        ul.hide();
                        for (var i=0; i&lt;matched.length; ++i) {
                            var str = matched[i].replace(regex, '');
                            $('&lt;li&gt;' + str + '&lt;/li&gt;').appendTo(ul);
                        }
                        ul.show();
                    }
                }
            }
        }, 0);
        if (e.which == 9) {
            return false;
        }
    }
});</pre>
        <p>See <a href="https://codepen.io/jcubic/pen/MJyYEx?editors=0110">demo in action</a>.</p>
      </article>
      <article id="csrf">
        <header><h2><abbr title="Cross-Site Request Forgery">CSRF</abbr></h2></header>
        <p>Example that add CSRF Protection to the terminal:</p>
        <pre class="javascript">jQuery(function($) {
    var CSRF_HEADER = "X-CSRF-TOKEN";
    var csrfToken;
    $('&lt;div/&gt;').appendTo('body').terminal("test.php", {
        request: function(jxhr, request) {
            if (csrfToken) {
                jxhr.setRequestHeader(CSRF_HEADER, csrfToken);
            }
        },
        response: function(jxhr, response) {
            if (!response.error) {
                csrfToken = jxhr.getResponseHeader(CSRF_HEADER);
            }
        },
        width: 600,
        height: 480,
    });
});</pre>
        <p>Note that this will break if you Open the app in more than one tab. To fix the issue you can use
          my other library <a href="https://github.com/jcubic/sysend.js">sysend.js</a> and share the token.</p>
        <pre class="javascript">jQuery(function($) {
    var CSRF_HEADER = "X-CSRF-TOKEN";
    var csrfToken;
    sysend.on('csrfToken', function(token) {
        csrfToken = token;
    });
    $('&lt;div/&gt;').appendTo('body').terminal("test.php", {
        request: function(jxhr, request) {
            if (csrfToken) {
                jxhr.setRequestHeader(CSRF_HEADER, csrfToken);
            }
            sysend.broadcast('csrfToken', csrfToken);
        },
        response: function(jxhr, response) {
            if (!response.error) {
                csrfToken = jxhr.getResponseHeader(CSRF_HEADER);
            }
        },
        width: 600,
        height: 480,
    });
});</pre>
      </article>
      <article id="syntax_highlight">
        <header><h2>SQL Syntax highlighter</h2></header>
        <p>Here is example to how to add syntax highlighting for mysql keywords</p>
        <pre class="javascript">// mysql keywords
var uppercase = [
    'ACCESSIBLE', 'ADD', 'ALL', 'ALTER', 'ANALYZE', 'AND', 'AS', 'ASC',
    'ASENSITIVE', 'BEFORE', 'BETWEEN', 'BIGINT', 'BINARY', 'BLOB',
    'BOTH', 'BY', 'CALL', 'CASCADE', 'CASE', 'CHANGE', 'CHAR',
    'CHARACTER', 'CHECK', 'COLLATE', 'COLUMN', 'CONDITION',
    'CONSTRAINT', 'CONTINUE', 'CONVERT', 'CREATE', 'CROSS',
    'CURRENT_DATE', 'CURRENT_TIME', 'CURRENT_TIMESTAMP', 'CURRENT_USER',
    'CURSOR', 'DATABASE', 'DATABASES', 'DAY_HOUR', 'DAY_MICROSECOND',
    'DAY_MINUTE', 'DAY_SECOND', 'DEC', 'DECIMAL', 'DECLARE', 'DEFAULT',
    'DELAYED', 'DELETE', 'DESC', 'DESCRIBE', 'DETERMINISTIC',
    'DISTINCT', 'DISTINCTROW', 'DIV', 'DOUBLE', 'DROP', 'DUAL', 'EACH',
    'ELSE', 'ELSEIF', 'ENCLOSED', 'ESCAPED', 'EXISTS', 'EXIT',
    'EXPLAIN', 'FALSE', 'FETCH', 'FLOAT', 'FLOAT4', 'FLOAT8', 'FOR',
    'FORCE', 'FOREIGN', 'FROM', 'FULLTEXT', 'GRANT', 'GROUP', 'HAVING',
    'HIGH_PRIORITY', 'HOUR_MICROSECOND', 'HOUR_MINUTE', 'HOUR_SECOND',
    'IF', 'IGNORE', 'IN', 'INDEX', 'INFILE', 'INNER', 'INOUT',
    'INSENSITIVE', 'INSERT', 'INT', 'INT1', 'INT2', 'INT3', 'INT4',
    'INT8', 'INTEGER', 'INTERVAL', 'INTO', 'IS', 'ITERATE', 'JOIN',
    'KEY', 'KEYS', 'KILL', 'LEADING', 'LEAVE', 'LEFT', 'LIKE', 'LIMIT',
    'LINEAR', 'LINES', 'LOAD', 'LOCALTIME', 'LOCALTIMESTAMP', 'LOCK',
    'LONG', 'LONGBLOB', 'LONGTEXT', 'LOOP', 'LOW_PRIORITY',
    'MASTER_SSL_VERIFY_SERVER_CERT', 'MATCH', 'MEDIUMBLOB', 'MEDIUMINT',
    'MEDIUMTEXT', 'MIDDLEINT', 'MINUTE_MICROSECOND', 'MINUTE_SECOND',
    'MOD', 'MODIFIES', 'NATURAL', 'NOT', 'NO_WRITE_TO_BINLOG', 'NULL',
    'NUMERIC', 'ON', 'OPTIMIZE', 'OPTION', 'OPTIONALLY', 'OR', 'ORDER',
    'OUT', 'OUTER', 'OUTFILE', 'PRECISION', 'PRIMARY', 'PROCEDURE',
    'PURGE', 'RANGE', 'READ', 'READS', 'READ_WRITE', 'REAL',
    'REFERENCES', 'REGEXP', 'RELEASE', 'RENAME', 'REPEAT', 'REPLACE',
    'REQUIRE', 'RESTRICT', 'RETURN', 'REVOKE', 'RIGHT', 'RLIKE',
    'SCHEMA', 'SCHEMAS', 'SECOND_MICROSECOND', 'SELECT', 'SENSITIVE',
    'SEPARATOR', 'SET', 'SHOW', 'SMALLINT', 'SPATIAL', 'SPECIFIC',
    'SQL', 'SQLEXCEPTION', 'SQLSTATE', 'SQLWARNING', 'SQL_BIG_RESULT',
    'SQL_CALC_FOUND_ROWS', 'SQL_SMALL_RESULT', 'SSL', 'STARTING',
    'STRAIGHT_JOIN', 'TABLE', 'TERMINATED', 'THEN', 'TINYBLOB',
    'TINYINT', 'TINYTEXT', 'TO', 'TRAILING', 'TRIGGER', 'TRUE', 'UNDO',
    'UNION', 'UNIQUE', 'UNLOCK', 'UNSIGNED', 'UPDATE', 'USAGE', 'USE',
    'USING', 'UTC_DATE', 'UTC_TIME', 'UTC_TIMESTAMP', 'VALUES',
    'VARBINARY', 'VARCHAR', 'VARCHARACTER', 'VARYING', 'WHEN', 'WHERE',
    'WHILE', 'WITH', 'WRITE', 'XOR', 'YEAR_MONTH', 'ZEROFILL'];
var keywords = uppercase.concat(uppercase.map(function(keyword) {
    return keyword.toLowerCase();
}));
$.terminal.defaults.formatters.push(function(string) {
    return string.split(/((?:\s|&amp;nbsp;)+)/).map(function(string) {
        if (keywords.indexOf(string) != -1) {
            return '[[b;white;]' + string + ']';
        } else {
            return string;
        }
    }).join('');
});</pre>
        <p>If you want to add formatting for different sql command and not for main interpterer you can use stack of formatters. It require version >=1.0 that introduce extra option for interpreter. The example will work for any number of nested interpreters even you call push new in your mysql command.</p>
        <pre class="javascript">// this regex will allow mixed case like SeLect
var re = new RegExp('^(' + uppercase.join('|') + ')$', 'i');
function mysql_formatter(string) {
    return string.split(/((?:\s|&amp;nbsp;)+)/).map(function(string) {
        if (re.test(string)) {
            return '[[b;white;]' + string + ']';
        } else {
            return string;
        }
    }).join('');
}
var formatters = [$.terminal.defaults.formatters];
$('body').terminal(function(command, term) {
    if (command.match(/^\s*mysql\s*$/)) {
        term.push(function(query) {
            term.echo('executing ' + query, {formatters: false});
        }, {
            prompt: 'mysql&gt; ',
            name: 'mysql',
            // extra property saved in interpreter
            formatters: [mysql_formatter],
            completion: keywords
        });
    }
}, {
    onPush: function(before, after) {
        $.terminal.defaults.formatters = after.formatters || [];
        formatters.push($.terminal.defaults.formatters);
    },
    onPop: function(before, after) {
        formatters.pop();
        if (formatters.length > 0) {
            $.terminal.defaults.formatters = formatters[formatters.length-1];
        }
    }
});</pre>
      </article>
      <article id="tilda">
        <header><h2>Quake like terminal</h2></header>
        <p>See <a href="tilda-demo.html">demo</a>.</p>
        <p>Below is code for small plugin called tilda.</p>
        <pre class="javascript">(function($) {
    $.fn.tilda = function(eval, options) {
        if ($('body').data('tilda')) {
            return $('body').data('tilda').terminal;
        }
        this.addClass('tilda');
        options = options || {};
        eval = eval || function(command, term) {
            term.echo("you don't set eval for tilda");
        };
        var settings = {
            prompt: 'tilda> ',
            name: 'tilda',
            height: 100,
            enabled: false,
            greetings: 'Quake like console',
            keypress: function(e) {
                if (e.which == 96) {
                    return false;
                }
            }
        };
        if (options) {
            $.extend(settings, options);
        }
        this.append('&lt;div class="td"&gt;&lt;/div&gt;');
        var self = this;
        self.terminal = this.find('.td').terminal(eval,
                                               settings);
        var focus = false;
        $(document.documentElement).keypress(function(e) {
            if (e.charCode == 96) {
                self.slideToggle('fast');
                self.terminal.command_line.set('');
                self.terminal.focus(focus = !focus);
            }
        });
        $('body').data('tilda', this);
        this.hide();
        return self;
    };
})(jQuery);</pre>
        <p>See <a href="tilda-demo.html">demo</a>.</p>
      </article>
      <article>
        <header id="dterm"><h2>Terminal in jQuery UI Dialog</h2></header>
        <p>Bellow is small plugin dterm.</p>
        <pre class="javascript">(function($) {
    $.extend_if_has = function(desc, source, array) {
        for (var i=array.length;i--;) {
            if (typeof source[array[i]] != 'undefined') {
                desc[array[i]] = source[array[i]];
            }
        }
        return desc;
    };
    $.fn.dterm = function(interpeter, options) {
        var defaults = Object.keys($.terminal.defaults);
        var op = $.extend_if_has({}, options, defaults);
&nbsp;
        var term = this.append('&lt;div/&gt;').
              terminal(interpeter, op);
        if (!options.title) {
            options.title = 'JQuery Terminal Emulator';
        }
        if (options.logoutOnClose) {
            options.close = function(e, ui) {
                term.logout();
                term.clear();
            };
        } else {
            options.close = function(e, ui) {
                term.focus(false);
            };
        }
        var self = this;
        if (window.IntersectionObserver) {
            var visibility_observer = new IntersectionObserver(function() {
                if (self.is(':visible')) {
                    terminal.enable().resize();
                } else {
                    self.disable();
                }
            }, {
                root: document.body
            });
            visibility_observer.observe(terminal[0]);
        }
        this.dialog($.extend({}, options, {
            resizeStop: function() {
                var content = self.find('.ui-dialog-content');
                terminal.resize(content.width(), content.height());
            },
            open: function(event, ui) {
                if (!window.IntersectionObserver) {
                    setTimeout(function() {
                        terminal.enable().resize();
                    }, 100);
                }
                if (typeof options.open == 'function') {
                    options.open(event, ui);
                }
            },
            show: 'fade',
            closeOnEscape: false
        }));
        self.terminal = terminal;
        return self;
    };
})(jQuery);</pre>
        <p id="biwascheme"><strong>Demo Scheme interpreter inside JQuery UI Dialog.</strong></p>
        <p>Click on button to <button id="open_term">open dialog</button> with scheme interpreter inside UI Dialog.</p>
        <p><strong>Hint:</strong> you can use JQuery from scheme. There is defined $ function and functions for all jquery object methods, they names start with coma and they always return jquery object so you can do chaining.</p>
        <p><strong>NOTE:</strong> you should include jQuery Terminal css file after jQuery UI one otherwise you will have white text in terminal, insided of gray.</p>
        <p>Interpreter allow to use <strong>multiline expressions</strong>. When you type not finished S-Expresion it change the prompt with set_prompt, contatenate current command with previous not finished expression and when you close last parentises end press enter it evaluate whole expression.</p>
        <p>If you want to call:</p>
        <pre class="javascript">$("body").css("background-color", "black");</pre>
        <p>use</p>
        <!-- only for syntax highlight -->
        <pre class="javascript">(.css ($ "body") "background-color" "black")</pre>
        <p>To attach event you can use lambda expressions.</p>
        <pre class="javascript">(.click ($ ".terminal") (lambda () (display "click")))</pre>
        <p>this will attach click event to terminal.</p>
        <div id="dialogterm"></div>
      </article>
      <article id="multiple-interpreters">
        <header><h2>Multiple interpreters</h2></header>
        <p>All interpreters are stored on the stack which which you can manipulate with terminal methods pop an push.</p>
        <p>See <a title="JQuery Terminal Emulator Demo" href="multiple-interpreters-demo.html">demo</a>.</p>
        <p>In belowed code there are defied three commands:</p>
        <ul>
          <li>js - which run javascript interpreter</li>
          <li>mysql - which call json-rpc service to execute mysql commands.</li>
          <li>test - it display "pong" if you type "ping" </li>
        </ul>
        <pre class="javascript">jQuery(function($) {
  $('html').terminal(function(cmd, term) {
    if (cmd == 'help') {
      term.echo("available commands are mysql, js, test");
    } else if (cmd == 'test'){
      term.push(function(cmd, term) {
        if (command == 'help') {
          term.echo('type "ping" it will display "pong"');
        } else if (cmd == 'ping') {
          term.echo('pong');
        } else {
          term.echo('unknown command "' + cmd + '"');
        }
      }, {
        prompt: 'test&gt; ',
        name: 'test'});
    } else if (command == "js") {
      term.push(function(command, term) {
        var result = window.eval(command);
        if (result != undefined) {
          term.echo(String(result));
        }
      }, {
        name: 'js',
        prompt: 'js&gt; '});
      } else if (command == 'mysql') {
        term.push(function(command, term) {
          term.pause();
          //$.jrpc is helper function which
          //creates json-rpc request
          $.jrpc("mysql-rpc-demo.php",
            "query",
            [command],
            function(data) {
              term.resume();
              if (data.error) {
                if (data.error.error && data.error.error.message) {
                  term.error(data.error.error.message); // php error
                } else {
                  term.error(data.error.message); // json rpc error
                }
              } else {
                if (typeof data.result == 'boolean') {
                  term.echo(data.result ?
                            'success' :
                            'fail');
                } else {
                  var len = data.result.length;
                  for(var i=0;i&lt;len; ++i) {
                    term.echo(data.result[i].join(' | '));
                  }
                }
              }
            },
            function(xhr, status, error) {
              term.error('[AJAX] ' + status +
                         ' - Server reponse is: \n' +
                         xhr.responseText);
                         term.resume();
                   }); // rpc call
          }, {
            greetings: "This is example of using mysql"+
              " from terminal\n you are allowed to exe"+
              "cute: select, insert, update and delete"+
              " from/to table:\n   table test(integer_"+
              "value integer, varchar_value varchar(255))",
            prompt: "mysql&gt; "});
          } else {
            term.echo("unknow command " + command);
          }
        }, {
          greetings: "multiple terminals demo use help"+
                " to see available commands"
       });});</pre>
        <p>If you want to display ascii table like real mysql command, take a look at <a href="https://github.com/jcubic/leash/blob/1843d8f4dd9f2e4696f2086184c23624027acb9f/leash-src.js#L511">asci_table function in leash project</a>, it use <a href="https://github.com/timoxley/wcwidth">wcwidth</a> to calcuate the width of the characters but if you don't care about chenese characters you can replace it with <code>string.length</code>.</p>
        <p>PHP code for mysql service: </p>
        <pre class="php">&lt;?php
require('json_rpc.php');
&nbsp;
$conn = mysql_connect('localhost', 'user', 'password');
mysql_select_db('database');
&nbsp;
class MysqlDemo {
  public function query($query) {
    if (preg_match("/create|drop/", $query)) {
      throw new Exception("Sorry you are not allowed to ".
                          "execute '" . $query . "'");
    }
    if (!preg_match("/(select.*from *test|insert *into *".
                    "test.*|delete *from *test|update *t".
                    "est)/", $query)) {
      throw new Exception("Sorry you can't execute '" .
                          $query . "' you are only allow".
                          "ed to select, insert, delete ".
                          "or update 'test' table");
    }
    if ($res = mysql_query($query)) {
      if ($res === true) {
        return true;
      }
      if (mysql_num_rows($res) > 0) {
        while ($row = mysql_fetch_row($res)) {
          $result[] = $row;
        }
        return $result;
      } else {
        return array();
      }
    } else {
      throw new Exception("MySQL Error: ".mysql_error());
    }
  }
}
&nbsp;
handle_json_rpc(new MysqlDemo());
?&gt;</pre>
      <p>See <a title="JQuery Terminal Emulator Demo" href="multiple-interpreters-demo.html">demo</a>.</p>
      </article>
      <article id="starwars">
        <header><h2>Star Wars Animation</h2></header>
        <p>This is Star Wars ASCIIMation created by Simon Jansen <br/><a href="https://www.asciimation.co.nz/">https://www.asciimation.co.nz/</a></p>
        <div id="starwarsterm" style="--rows: 14; --cols: 67"></div>
        <pre class="javascript">$(function() {
    var frames = [];
    var LINES_PER_FRAME = 14;
    var DELAY = 67;
    //star_wars is array of lines from 'js/star_wars.js'
    var lines = star_wars.length;
    for (var i=0; i&lt;lines; i+=LINES_PER_FRAME) {
        frames.push(star_wars.slice(i, i+LINES_PER_FRAME));
    }
    var stop = false;
    //to show greetings after clearing the terminal
    function greetings(term) {
        term.echo('STAR WARS ASCIIMACTION\n'+
                  'Simon Jansen (C) 1997 - 2008\n'+
                  'www.asciimation.co.nz\n\n'+
                  'type "play" to start animation, '+
                  'press CTRL+D to stop');
    }
    function play(term, delay) {
        var i = 0;
        var next_delay;
        if (delay == undefined) {
            delay = DELAY;
        }
        function display() {
            if (i == frames.length) {
                i = 0;
            }
            term.clear();
            if (frames[i][0].match(/[0-9]+/)) {
                next_delay = frames[i][0] * delay;
            } else {
                next_delay = delay;
            }
            term.echo(frames[i++].slice(1).join('\n')+'\n');
            if (!stop) {
                setTimeout(display, next_delay);
            } else {
                term.clear();
                greetings(term);
                i = 0;
            }
        }
        display();
    }

    $('#starwarsterm').terminal(function(command, term){
        if (command == 'play') {
            term.pause();
            stop = false;
            play(term);
        }
    }, {
        width: 500,
        height: 230,
        prompt: 'starwars> ',
        greetings: null,
        onInit: function(term) {
            greetings(term);
        },
        keypress: function(e, term) {
            if (e.which == 100 &amp;&amp; e.ctrlKey) {
                stop = true;
                term.resume();
                return false;
            }
        }
    });
});</pre>
      </article>
      <article id="ask">
        <header><h2>Ask before executing a command</h2></header>
        <p>Someone ask me how to create, command that ask users before executing, and here is the code, it will keep asking until eather yes or no will be entered (or short y/n).</p>
        <pre class="javascript">$('#term').terminal(function(command, term) {
    if (command == 'foo') {
        var history = term.history();
        history.disable();
        term.push(function(command) {
            if (command.match(/^(y|yes)$/i)) {
                term.echo('execute your command here');
                term.pop();
                history.enable();
            } else if (command.match(/^(n|no)$/i)) {
                term.pop();
                history.enable();
            }
        }, {
            prompt: 'Are you sure? '
        });
    }
});</pre>
      </article>
      <article id="user-typing">
        <header><h2>Animation that emulate user typing</h2></header>
        <p><strong>NOTE:</strong> in version 2.24.0 typing animation was added to the library. No animate all you have to do is:</p>
        <pre class="javascript">term.typing('echo', 100, 'Hello', function() {  });
term.typing('prompt', 100, 'name: ', function() {
});
        </pre>
        <p>The function also return a promise so you can use return value instead of a callback function.</p>
        <p>Someone else asked if it's posible to create animation like user typing. Here is the code that emulate user typing on initialization of the terminal and before every ajax call, which can finish after animation.</p>
        <div class="term"></div>
        <pre class="javascript">$(function() {
    var anim = false;
    function typed(finish_typing) {
        return function(term, message, delay, finish) {
            anim = true;
            var prompt = term.get_prompt();
            var c = 0;
            if (message.length > 0) {
                term.set_prompt('');
                var new_prompt = '';
                var interval = setInterval(function() {
                    var chr = $.terminal.substring(message, c, c+1);
                    new_prompt += chr;
                    term.set_prompt(new_prompt);
                    c++;
                    if (c == length(message)) {
                        clearInterval(interval);
                        // execute in next interval
                        setTimeout(function() {
                            // swap command with prompt
                            finish_typing(term, message, prompt);
                            anim = false
                            finish &amp;&amp; finish();
                        }, delay);
                    }
                }, delay);
            }
        };
    }
    function length(string) {
        string = $.terminal.strip(string);
        return $('&lt;span&gt;' + string + '&lt;/span&gt;').text().length;
    }
    var typed_prompt = typed(function(term, message, prompt) {
        term.set_prompt(message + ' ');
    });
    var typed_message = typed(function(term, message, prompt) {
        term.echo(message)
        term.set_prompt(prompt);
    });

    $('body').terminal(function(cmd, term) {
        var finish = false;
        var msg = "Wait I'm executing ajax call";
        term.set_prompt('> ');
        typed_message(term, msg, 200, function() {
            finish = true;
        });
        var args = {command: cmd};
        $.get('commands.php', args, function(result) {
            (function wait() {
                if (finish) {
                    term.echo(result);
                } else {
                    setTimeout(wait, 500);
                }
            })();
        });
    }, {
        name: 'xxx',
        greetings: null,
        width: 500,
        height: 300,
        onInit: function(term) {
            // first question
            var msg = "Wellcome to my terminal";
            typed_message(term, msg, 200, function() {
                typed_prompt(term, "what's your name:", 100);
            });
        },
        keydown: function(e) {
            //disable keyboard when animating
            if (anim) {
                return false;
            }
        }
    });
});</pre>
      </article>
      <article id="progress-bar">
        <header><h2>Progress bar animation</h2></header>
        <p>You can test it by executing command `progress 30`.</p>
        <div class="term"></div>
        <p>Here is the code for progres bar animation:</p>
        <pre class="javascript">jQuery(function($) {
    function progress(percent, width) {
        var size = Math.round(width*percent/100);
        var left = '', taken = '', i;
        for (i=size; i--;) {
            taken += '=';
        }
        if (taken.length > 0) {
            taken = taken.replace(/=$/, '>');
        }
        for (i=width-size; i--;) {
            left += ' ';
        }
        return '[' + taken + left + '] ' + percent + '%';
    }
    var animation = false;
    var timer;
    var prompt;
    var string;
    $('body').terminal(function(command, term) {
        var cmd = $.terminal.parse_command(command);
        if (cmd.name == 'progress') {
            var i = 0, size = cmd.args[0];
            prompt = term.get_prompt();
            string = progress(0, size);
            term.set_prompt(progress);
            animation = true;
            (function loop() {
                string = progress(i++, size);
                term.set_prompt(string);
                if (i &lt; 100) {
                    timer = setTimeout(loop, 100);
                } else {
                    term.echo(progress(i, size) + ' [[b;green;]OK]')
                        .set_prompt(prompt);
                    animation = false
                }
            })();
        }
    }, {
        keydown: function(e, term) {
            if (animation) {
                if (e.which == 68 && e.ctrlKey) { // CTRL+D
                    clearTimeout(timer);
                    animation = false;
                    term.echo(string + ' [[b;red;]FAIL]')
                        .set_prompt(prompt);
                }
                return false;
            }
        }
    });
});</pre>
        <p>Here you can find the same <a href="https://codepen.io/jcubic/pen/XWPNEBM?editors=0010">code refactored a bit with modern JavaScript</a>.</p>
      </article>
      <article id="spinners">
        <header><h2>Spinners animation</h2></header>
        <p>Spinner animations from <a href="https://github.com/sindresorhus/cli-spinners">sindresorhus/cli-spinners</a>.</p>
        <div class="term"></div>
        <pre class="javascript">$(function() {
    var url = 'https://unpkg.com/cli-spinners/spinners.json';
    $.getJSON(url, function(spinners) {
        var animation = false;
        var timer;
        var prompt;
        var spinner;
        var i;
        function start(term, spinner) {
            animation = true;
            i = 0;
            function set() {
                var text = spinner.frames[i++ % spinner.frames.length];
                term.set_prompt(text);
            };
            prompt = term.get_prompt();
            term.find('.cursor').hide();
            set();
            timer = setInterval(set, spinner.interval);
        }
        function stop(term, spinner) {
            setTimeout(function() {
                clearInterval(timer);
                var frame = spinner.frames[i % spinner.frames.length];
                term.set_prompt(prompt).echo(frame);
                animation = false;
                term.find('.cursor').show();
            }, 0);
        }
        $('#spinners .term').terminal({
            spinner: function(name) {
                spinner = spinners[name];
                if (!spinner) {
                    this.error('Spinner not found');
                } else {
                    this.echo('press CTRL+D to stop');
                    start(this, spinner);
                }
            },
            help: function() {
                var text = Object.keys(spinners).join('\t');
                this.echo('Available spinners: ' + text, {
                    keepWords: true
                });
            }
        }, {
            greetings: false,
            onInit: function(term) {
                term.echo('Spinners, type [[b;#fff;]help] to display '+
                          'available spinners or [[b;#fff;]spinner &lt;n'+
                          'ame>] for animation', {
                    keepWords: true
                });
            },
            completion: true,
            keydown: function(e, term) {
                if (animation) {
                    if (e.which == 68 && e.ctrlKey) { // CTRL+D
                        stop(term, spinner);
                    }
                    return false;
                }
            }
        });
    });
});</pre>
      </article>
      <article id="less">
        <header><h2>Less bash command</h2></header>
        <p>Here is implementation of bash less command (not all commands implemented)</p>
        <p>From version 1.16.0 included in the page in less.js file and use less as jQuery plugin on terminal instance.</p>
        <pre class="javascript">$('&lt;SELECTOR&gt;').terminal({
    less: function(url) {
        $.get(url).then(text => {
            this.less(text);
        });
    }
});</pre>
        <p>Here is old example:</p>
        <pre class="javascript">var resize = [];
$('&lt;SELECTOR&gt;').terminal(function(command, term) {
  if (command.match(/ *less +[^ ]+/)) {
    term.pause();
    $.ajax({
      // leading and trailing spaces and keep those inside argument
      url: command.replace(/^\s+|\s+$/g, '').
        replace(/^ */, '').split(/(\s+)/).slice(2).join(''),
      method: 'GET',
      dataType: 'text',
      success: function(source) {
        term.resume();
        var export_data = term.export_view();
        var less = true;
        source = source.replace(/&/g, '&amp;amp;').
          replace(/\[/g, '&amp;#91;').
          replace(/\]/g, '&amp;#93;');
        var cols = term.cols();
        var rows = term.rows();
        resize = [];
        var lines = source.split('\n');
        resize.push(function() {
          if (less) {
            cols = term.cols();
            rows = term.rows();
            print();
          }
        });
        var pos = 0;
        function print() {
          term.clear();
          term.echo(lines.slice(pos, pos+rows-1).join('\n'));
        }
        print();
        term.push($.noop, {
          keydown: function(e) {
            if (term.get_prompt() !== '/') {
              if (e.which == 191) {
                term.set_prompt('/');
              } else if (e.which === 38) { //up
                if (pos > 0) {
                  --pos;
                  print();
                }
              } else if (e.which === 40) { //down
                if (pos &lt; lines.length-1) {
                  ++pos;
                  print();
                }
              } else if (e.which === 34) { // Page up
                pos += rows;
                if (pos > lines.length-1-rows) {
                  pos = lines.length-1-rows;
                }
                print();
              } else if (e.which === 33) { // page down
                pos -= rows;
                if (pos &lt; 0) {
                  pos = 0;
                }
                print();
              } else if (e.which == 81) { //Q
                less = false;
                term.pop().import_view(export_data);
              }
              return false;
            } else {
              if (e.which === 8 &amp;&amp; term.get_command() === '') {
                term.set_prompt(':');
              } else if (e.which == 13) {
                var command = term.get_command();
                // basic search find only first
                // instance and don't mark the result
                if (command.length &gt; 0) {
                  var regex = new RegExp(command);
                  for (var i=0; i&lt;lines.length; ++i) {
                    if (regex.test(lines[i])) {
                      pos = i;
                      print();
                      term.set_command('');
                      break;
                    }
                  }
                  term.set_command('');
                  term.set_prompt(':');
                }
                return false;
              }
            }
          },
          prompt: ':'
        });
      }
    });
  }
}, {
  onResize: function(term) {
    for (var i=resize.length;i--;) {
      resize[i](term);
    }
  }
});</pre>
        <p>Improved less command with syntax highlighting can be found in this <a href="https://codepen.io/jcubic/pen/zEyxjJ?editors=0010">pen</a>.</p>
      </article>
      <article id="pipe">
        <header><h2>Pipe operator</h2></header>
        <p>From version 2.4.0 there is file pipe.js include in npm and unpkg that have pipe operator. ALl you need is to include the file and you can use new <strong>pipe</strong> option to enable pipe.</p>
        <pre class="javascript">var count = 0;
var term = $('body').terminal({
    echo: function(string) {
        return new Promise(function(resolve) {
            term.echo(string);
            setTimeout(resolve, 1000);
        });
    },
    read: function() {
        return term.read('').then(function(string) {
            term.echo('read[' +(++count)+']: ' + string);
        });
    }
}, {
    pipe: true
});</pre>
        <p>Pipe depend on read and echo that can be used as stdin and stdout in real terminal to combine the commands</p>
        <p>You can execute <code><strong>echo foo | read</strong></code> or even <code><strong>echo foo | read | read</strong></code> it will also work if pipe is in string like this <code><strong>echo "pipe |" | read</strong></code> (it will also work if you escape quotes or pipe)</p>
        <p>you can test it on <a href="https://codepen.io/jcubic/pen/vYLvvXx?editors=0010">this pen</a></p>
      </article>
      <article id="bash-history">
        <header><h2>Bash history commands</h2></header>
        <p>If you want to add bash history commands like !!, !$ or !* here is the code:</p>
        <pre class="javascript">$('body').terminal(function(command, term) {
    var cmd = $.terminal.parse_command(command);
    if (command.match(/![*$]|\s*!!(:p)?\s*$|\s*!(.*)/)) {
        var new_command;
        var history = term.history();
        var last = $.terminal.parse_command(history.last());
        var match = command.match(/\s*!(?![!$*])(.*)/);
        if (match) {
            var re = new RegExp($.terminal.escape_regex(match[1]));
            var history_data = history.data();
            for (var i=history_data.length; i--;) {
                if (re.test(history_data[i])) {
                    new_command = history_data[i];
                    break;
                }
            }
            if (!new_command) {
                var msg = $.terminal.defaults.strings.commandNotFound;
                term.error(sprintf(msg, $.terminal.escape_brackets(match[1])));
            }
        } else if (command.match(/![*$]/)) {
            if (last.args.length) {
                var last_arg = last.args[last.args.length-1];
                new_command = command.replace(/!\$/g, last_arg);
            }
            new_command = new_command.replace(/!\*/g, last.rest);
        } else if (command.match(/\s*!!(:p)?/)) {
            new_command = last.command;
        }
        if (new_command) {
            term.echo(new_command);
        }
        if (!command.match(/![*$!]:p/)) {
            if (new_command) {
                term.exec(new_command, true);
            }
        }
    } else if (cmd.name == 'echo') {
        term.echo(cmd.rest);
    }
}, {
    // we need to disable history for bash history commands
    historyFilter: function(command) {
        return !command.match(/![*$]|\s*!!(:p)?\s*$|\s*!(.*)/);
    }
});</pre>
      </article>
      <style type="text/css">
       @-webkit-keyframes terminal-smooth {
           0%, 100% {
               left: 0;
               color: #0c0;
               color: var(--original-color, #aaa);
               background-color: #000;
               background-color: var(--background, #000);
               -webkit-box-shadow: none;
               box-shadow: none;
               border: none;
               padding: 0;
               margin: 0;
           }
           50% {
               left: 0;
               color: #000;
               background: #0c0;
               -webkit-box-shadow: 0 0 5px var(--color, #aaa);
               box-shadow: 0 0 5px var(--color, #aaa);
               border: none;
               padding: 0;
               margin: 0;
               border-bottom: 2px solid transparent;
           }
       }
       @-moz-keyframes terminal-smooth {
           0%, 100% {
               left: 0;
               color: #0c0;
               color: var(--original-color, #aaa);
               background-color: #000;
               background-color: var(--background, #000);
               -moz-box-shadow: none;
               box-shadow: none;
               border: none;
               padding: 0;
               margin: 0;
           }
           50% {
               left: 0;
               color: #000;
               background: #0c0;
               -mox-box-shadow: 0 0 5px var(--color, #aaa);
               box-shadow: 0 0 5px var(--color, #aaa);
               border: none;
               padding: 0;
               margin: 0;
               border-bottom: 2px solid transparent;
           }
       }
       @keyframes terminal-smooth {
           0%, 100% {
               left: 0;
               color: #0c0;
               color: var(--original-color, #aaa);
               background-color: #000;
               background-color: var(--background, #000);
               -webkit-box-shadow: none;
               box-shadow: none;
               border: none;
               padding: 0;
               margin: 0;
           }
           50% {
               left: 0;
               color: #000;
               background: #0c0;
               -webkit-box-shadow: 0 0 5px var(--color, #aaa);
               box-shadow: 0 0 5px var(--color, #aaa);
               border: none;
               padding: 0;
               margin: 0;
               border-bottom: 2px solid transparent;
           }
       }
       #css-cursor .terminal {
           --background: #000;
           --color: #0c0;
           --animation: terminal-smooth;
           text-shadow: 0 0 3px rgba(0,100,0,0.5);
       }
       /* below can be removed in version >= 2.1.0 */
       #css-cursor .cmd .cursor-line {
           overflow: visible;
       }
      </style>
      <article id="css-cursor">
        <header><h2>Smooth CSS3 cursor animation</h2></header>
        <p>From version 0.8 terminal use CSS animation for blinking so you can change it without touching JavaScript code.</p>
        <p>Here is different looking cursor blinking animation that can be use with terminal.</p>
        <div class="term"></div>
        <pre class="css">@-webkit-keyframes terminal-smooth {
    0%, 100% {
        left: 0;
        color: #0c0;
        color: var(--original-color, #aaa);
        background-color: #000;
        background-color: var(--background, #000);
        -webkit-box-shadow: none;
        box-shadow: none;
        border: none;
        padding: 0;
        margin: 0;
    }
    50% {
        left: 0;
        color: #000;
        background: #0c0;
        -webkit-box-shadow: 0 0 5px var(--color, #aaa);
        box-shadow: 0 0 5px var(--color, #aaa);
        border: none;
        padding: 0;
        margin: 0;
        border-bottom: 2px solid transparent;
    }
}
@-moz-keyframes terminal-smooth {
    0%, 100% {
        left: 0;
        color: #0c0;
        color: var(--original-color, #aaa);
        background-color: #000;
        background-color: var(--background, #000);
        -moz-box-shadow: none;
        box-shadow: none;
        border: none;
        padding: 0;
        margin: 0;
    }
    50% {
        left: 0;
        color: #000;
        background: #0c0;
        -mox-box-shadow: 0 0 5px var(--color, #aaa);
        box-shadow: 0 0 5px var(--color, #aaa);
        border: none;
        padding: 0;
        margin: 0;
        border-bottom: 2px solid transparent;
    }
}
@keyframes terminal-smooth {
    0%, 100% {
        left: 0;
        color: #0c0;
        color: var(--original-color, #aaa);
        background-color: #000;
        background-color: var(--background, #000);
        -webkit-box-shadow: none;
        box-shadow: none;
        border: none;
        padding: 0;
        margin: 0;
    }
    50% {
        left: 0;
        color: #000;
        background: #0c0;
        -webkit-box-shadow: 0 0 5px var(--color, #aaa);
        box-shadow: 0 0 5px var(--color, #aaa);
        border: none;
        padding: 0;
        margin: 0;
        border-bottom: 2px solid transparent;
    }
}
#css-cursor .terminal {
    --background: #000;
    --color: #0c0;
    --animation: terminal-smooth;
    text-shadow: 0 0 3px rgba(0,100,0,0.5);
}
/* below can be removed in version >= 2.1.0 */
#css-cursor .cmd .cursor-line {
    overflow: visible;
}</pre>
      </article>
      <article id="virtual">
        <header><h2>Using Virtual Keyboard with Terminal</h2></header>
        <p>There were problems with terminal on touch devices (it now works without problems). I've found a project <a href="https://github.com/Mottie/Keyboard">Keyboard</a> that create virtual keyboard using jQuery UI. I've created a demo of working terminal with keyboard. <strike>The code still need tweeks to work full screen</strike>.</p>
        <p>See <a href="/virtualKeyboard.html" rel="nofollow">demo</a></p>
        <p>Since keyboard is not working on mobile, this demo is left for historical reason and because it's just one example of the use of terminal. Current version works with native keyboard (tested on Android and iPhone) if you find issues on the phone please <a href="https://github.com/jcubic/jquery.terminal/issues/new/choose">add an issue</a>.</p>
      </article>
      <article id="history">
        <header><h2>Using History API for commands</h2></header>
        <p>As a response for this <a href="https://github.com/jcubic/jquery.terminal/issues/148">issue on github</a> I came up with a way to keep every command response in history using HTML5 History API, so you can click back and forward buttons and it will show you previous and next commands.</p>
        <pre class="javascript">$(function() {
    var save_state = [];
    var terminal = $('#term').terminal(function(command, term) {
        var cmd = $.terminal.split_command(command);
        var url;
        if (cmd.name == 'open') {
            term.pause();
            // open html and display it on terminal as it is
            url = cmd.args[0];
            $.get(url, function(result) {
                term.echo(result, {raw:true}).resume();
                save_state.push(term.export_view());
                history.pushState(save_state.length-1, null, url);
            }, 'text');
        } else {
            // store all other commands
            save_state.push(term.export_view());
            url = '/' + cmd.name + '/' + cmd.args.join('/');
            history.pushState(save_state.length-1, null, url);
        }
    });
    save_state.push(terminal.export_view()); // save initial state
    $(window).on('popstate', function(e) {
        if (save_state.length) {
            terminal.import_view(save_state[history.state || 0]);
        }
    });
});</pre>
        <p>Each command after it finish need to call this:
        <pre class="javascript">save_state.push(term.export_view());
history.pushState(save_state.length-1, null, '&lt;NEW URL&gt;');</pre>
        <p>So it keep current view of the terminal (after the command finishes) in <code>save_state</code> array and index in push state (I've try to put whole view in <code>history.state</code> but it didn't work). On back/forward buttons click it will get that value from array and restore the view of the terminal.</p>
        <p>Version 0.9.0 introduced similar API but using url hash. To enable it use <code>historyState</code> option and to execute hash on load use <code>execHash</code> option.</p>
      </article>
      <article id="shell">
        <header><h2>Shell</h2></header>
        <p>You can also check my project <a href="https://leash.jcubic.pl">LEASH - Browser Shell</a> you will have shell without need to install anything on the server (so you don't need root access), it use lot of features of jQuery terminal, like better <a href="#less">less command</a> or python interpreter.</p>
        <p>You can also use <a href="https://github.com/jcubic/leash-cordova">cordova application</a> that use leash to have access to android shell.</p>
        <p>If you want something lightweight you can check <a href="https://github.com/jcubic/jsh.php">jsh.php</a>, it's single file php shell.</p>
      </article>
      <article id="different_look">
        <header><h2>Vintage and OS Fake Terminals</h2></header>
        <ul>
          <li><a href="/commodore64">Commodore64 Demo.</a></li>
          <li><a href="https://codepen.io/jcubic/pen/BwBYOZ">Vintage Fake Terminal</a>.</li>
          <li><a href="https://codepen.io/jcubic/pen/WZvYGj">OSX, Ubuntu and Windows 10 terminals</a>.</li>
          <li><a href="https://github.com/jcubic/fake-linux-terminal">Fake Linux Terminal</a> &mdash; Demo of SVG laptop with terminal inside. The Terminal have fake Linux with fake in browser filesystem, and common commands.</li>
          <li><a href="https://codepen.io/jcubic/pen/jOaoGKJ">Cool multi line prompt</a> - inspired by questionn on Reddit.</li>
          <li><a href="https://codepen.io/jcubic/pen/qPMPOR">Linux like NCurses dialog with cmd plugin and bit of css</a>.</li>
          <li><a href="https://codepen.io/jcubic/pen/dyMVWNX">Terminal with Night Vision Effect</a>.</li>
          <li><a href="https://codepen.io/jcubic/pen/PojPbZz">3D Effect of Terminal that fit into an image of a Laptop</a> - you can use this tool to fit terminal into any image.</li>
        </ul>
        <p>See also this <a href="https://codepen.io/collection/AeGGxz">Vintage Screen Effects Collection</a> on CodePen for inspiration.</p>
      </article>
      <article id="404">
        <header><h2>404 Error Page</h2></header>
        <p>To see 404 page (page not found error) just open any non exisitng page like <a href="/404" rel="nofollow">/404</a>. You will have few commands like:</p>
        <ul>
          <li>wikipedia article reader with search.</li>
          <li>jargon command for jargon file (hacker dictionary), try <strong><a href="/404#[[0,1,&quot;jargon hacker&quot;]]" rel="nofollow">jargon hacker</a></strong>, you can click on underline terms to read description.</li>
          <li>rfc command for reading rfc documents, if you execute without arguments it will show you index page, where you can press <strong>/</strong> to search and then click on the link, try search <strong>http</strong>.</li>
          <li>github command (github repo browser with cd, ls, less cat commands), try
            <strong><a href="/404#[[0,1,&quot;github%20-u%20facebook%20-r%20react&quot;]]">
              github -u facebook -r react
            </a></strong> or jQuery Terminal repo
            <strong><a href="/404#[[0,1,&quot;github%20-u%20jcubic%20-r%20jquery.terminal&quot;]]">
              github -u jcubic -r jquery.terminal
            </a></strong>
          </li>
          <li><strong>jargon</strong> command that shows definitions from hacker dictionary.</li>
          <li>Games: <strong>snake</strong>, <strong>tetris</strong>, <strong>rouge</strong>.</li>
          <li><strong>chunk-norris</strong>, <strong>fact</strong> and <strong>joke</strong> commands.</li>
          <li><strong>chat</strong> command that was onece on main page.</li>
          <li><strong>qr</strong> command that prints QR Code for a given text or URL.</li>
          <li><strong>matrix</strong> command that shows matrix rain animation.</li>
          <li><strong>dmr</strong> command that display ANSI art</li>
          <li><strong>record</strong> command that will save the commands you'll type in hash, so you can share the link to a session (be careful with long sessions, there is limit in URL hash size, depending on browser).</li>
        </ul>
        <!--
        <p>There is also hidden command that you can see with <a href="https://terminal.jcubic.pl/404#[[0,1,%22rick%22]]">this link</a>.</p>
         -->
        <p><strong>NOTE</strong>: if you want to share the link to 404 page with any command (e.g. on Twitter), best way is to use URL shortener like <a href="https://tinyurl.com/">tinyurl.com</a>. Because somtimes the links got broken, brackets in URL can be confusing.</p>
        <p>The error page has also <a href="https://tinyurl.com/terminal-chat">terminal based chat</a>, come and say hi, if you stay a little longer you can find some other people. If you leave the page open you will get notication when someonne will write something (sound and favicon will update). Type <strong>help</strong> to see available commands.</p>
      </article>
      <article id="emoji">
        <header><h2>Emoji</h2></header>
        <p>Inspired by a comment I've created a <a href="https://codepen.io/jcubic/pen/qPVMPg">demo of emoji in terminal</a>. From version 2.1.0 all needed files are included with the package, you need to include emoji.css and emoji.js and use this code that use <a href="https://github.com/iamcal/emoji-data">iamcal/emoji-data</a></p>
        <p>You can type emoji as unicode characters, limited number of ASCII emoticons, or full name of emoji (the one like <strong>:smiley:</strong>)</p>
        <pre class="javascript">
$.get('https://unpkg.com/emoji-datasource').then($.terminal.emoji);</pre>
        <p>If you want to have tab completion with emoji names, simply get names from JSON data and use it in completion, check codepen demo for details.</p>
      </article>
      <article id="questions">
        <header><h2>Create Settings object from questions</h2></header>
        <p>Here is example of list of questions that are ask to the user to fill out. User can confirm
          that the options he set are correct, if not he can correct his options. The code support:</p>
        <ul>
          <li>Boolean options</li>
          <li>String options</li>
          <li>Passwords - masked inputs</li>
        </ul>
        <p>This can be used as equivalent of the normal html form.</p>
        <p>This solution is based on <a href="https://github.com/jcubic/leash/blob/master/leash-src.js">Leash</a>
          (visible when installing the app). And came up from
          <a href="https://github.com/jcubic/jquery.terminal/issues/367">this issue on github</a>.</p>
        <pre class="javascript">var mask = ['root_password', 'password'];
var settings = {};
var questions = [
    {
        name: "root_password",
        text: 'Enter your administration password',
        prompt: "root password: "
    },
    {
        name: "server",
        text: "Type your server name"
    },
    {
        name: "username",
        text: "Your normal username"
    },
    {
        name: "home",
        text: "Home directory"
    },
    {
        name: 'guest',
        text: 'Allow guest sessions (Y)es/(N)o',
        boolean: true
    },
    {
        name: 'sudo',
        text: 'Execute sudo for user accounts (Y)es/(N)o',
        boolean: true
    },
    {
        name: "password"
    }
];
function ask_questions(step) {
    var question = questions[step];
    if (question) {
        if (question.text) {
            term.echo('[[b;#fff;]' + question.text + ']');
        }
        var show_mask = mask.indexOf(question.name) != -1;
        term.push(function(command) {
            if (show_mask) {
                term.set_mask(false);
            }
            if (question.boolean) {
                var value;
                if (command.match(/^Y(es)?/i)) {
                    value = true;
                } else if (command.match(/^N(o)?/i)) {
                    value = false;
                }
                if (typeof value != 'undefined') {
                    settings[question.name] = value;
                    term.pop();
                    ask_questions(step+1);
                }
            } else {
                settings[question.name] = command;
                term.pop();
                ask_questions(step+1);
            }
        }, {
            prompt: question.prompt || question.name + ": "
        });
        // set command and mask need to called after push
        // otherwise they will not work
        if (show_mask) {
            term.set_mask(true);
        }
        if (typeof settings[question.name] != 'undefined') {
            if (typeof settings[question.name] == 'boolean') {
                term.set_command(settings[question.name] ? 'y' : 'n');
            } else {
                term.set_command(settings[question.name]);
            }
        }
    } else {
        finish();
    }
}
function finish() {
    term.echo('Your settings:');
    var str = Object.keys(settings).map(function(key) {
        var value = settings[key];
        if (mask.indexOf(key) != -1) {
           // mask everything except first and last character
            var split = value.match(/^(.)(.*)(.)$/, '*');
            value = split[1] + split[2].replace(/./g, '*') + split[3];
        }
        return '[[b;#fff;]' + key + ']: ' + value;
    }).join('\n');
    term.echo(str);
    term.push(function(command) {
        if (command.match(/^y$/i)) {
            term.echo(JSON.stringify(settings));
            term.pop().history().enable();
        } else if (command.match(/^n$/i)) {
            term.pop();
            ask_questions(0);
        }
    }, {
        prompt: 'Are those correct (y|n): '
    });
}
term.history().disable();
ask_questions(0);
        </pre>
        <p>You can also use new <a href="https://github.com/jcubic/jquery.terminal/wiki/Forms">forms feature</a>.</p>
        <p>You can also buy access to base application for <a href="https://jcubic.gumroad.com/l/vintage-web-terminal-quiz-application">Vintage Quiz Terminal App</a> on Gumroad.</p>
      </article>
      <article id="terminal-widget">
        <header><h2>Terminal Widget</h2></header>
        <p>Inspired by adsense code, I've create small js file that you can include on your page to load jQuery Termianl, so you don't need to include jQuery or any other files, just one js file.</p>
        <pre class="html">
&lt;!DOCTYPE html&gt;
&lt;html&gt;
  &lt;body&gt;
    &lt;script&gt;
      (terminals = window.terminals || []).push([
        'body', function(command, term) {}
      ]);
    &lt;/script&gt;
    &lt;style&gt;
     body {
         min-height: 100vh;
         margin: 0;
     }
    &lt;/style&gt;
    &lt;script src="https://unpkg.com/jquery.terminal@2.1.2/js/
                 terminal.widget.js"&gt;&lt;/script&gt;
  &lt;/body&gt;
&lt;/html&gt;
        </pre>
        <p>The spec for array is the same as arguments to terminal but with selector as first element, so second is function string or object or array, and the third are the options.</p>
      </article>
      <article id="reactjs-terminal">
        <header><h2>ReactJS Terminal</h2></header>
        <p>Here is example us ReactJS Component with two way data binding. It require version 1.11.0 (to be released, right now on devel branch). The change that was required is to allow to call set_command with silient option to not call onCommandChange event that was causing infinite update on render.</p>
        <p>Sorry no color, To add highlighting to jsx I need to update library for sytanx highliting.</p>
        <div class="wrapper"><pre class="blank">
class Terminal extends React.Component {
  componentDidMount() {
    var {interpreter, command, ...options} = this.props;
    this.terminal = $(this.node).terminal(interpreter, options);
  }
  componentWillUnmount() {
    this.terminal.destroy();
  }
  isCommandControlled() {
    return this.props.command != undefined;
  }
  render() {
    if (this.terminal && this.isCommandControlled()) {
      this.terminal.set_command(this.props.command, true);
    }
    return (
      &lt;div ref={(node) =&gt; this.node = node}&gt;&lt;/div&gt;
    );
  }
}

class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {command: ''};
  }
  update(command) {
    this.setState({
      command
    });
  }
  exec() {
    this.terminal.exec(this.state.command);
    this.update('');
  }
  render() {
    let command = this.state.command;
    return (
      &lt;div&gt;
        &lt;Terminal
          interpreter={
             (command, term) =&gt; {
                 term.echo('you typed ' + command);
             }
          }
          height={100}
          command={command}
          onInit={(term) =&gt; {this.terminal = term}}
          onCommandChange={(command) =&gt; this.update(command)}
          greetings="React Terminal"/&gt;
        &lt;input value={command}
               onChange={(event) =&gt; this.update(event.target.value)}
          onKeyDown={(e) =&gt; { if (e.which == 13) { this.exec(); }}}/&gt;
        &lt;div&gt;{command}&lt;/div&gt;
      &lt;/div&gt;
    );
  }
}

ReactDOM.render(
  &lt;App /&gt;,
  document.getElementById('app')
);
        </pre></div>
        <p>You can see the demo on <a href="https://codepen.io/jcubic/pen/xPepee">Codepen</a>.</p>
        <p>There is also <a href="https://github.com/core-process/inline-console">inline-console library</a> with different API.</p>
        <p>There is also a way to render React application inside terminal, see <a href="https://codepen.io/jcubic/pen/ExYRopz?editors=0010">demo</a>.</p>
        <p>And here is demo of <a hre="https://codesandbox.io/s/react-terminal-efdgcd?file=/src/App.tsx">ReactJS application with useImperativeHandler hook</a>.</p>
      </article>
      <article id="electron-terminal">
        <header><h2>Electron Terminal</h2></header>
        <p>
          Here is <a href="https://github.com/jcubic/electron-terminal">repoitory for basic Electron
          Application with jQuery Terminal</a>, for when you want to create native command line
          application or game that will work on Windows, MacOSX or GNU/Linux
        </p>
      </article>
      <article id="parenthesis">
        <header><h2>Balancing parenthesis</h2></header>
        <p>If you type closing parenthesis, it will jump to matched open one.</p>
        <div class="term"></div>
        <pre class="javascript">var position;
var timer;
$('body').terminal($.noop, {
    name: 'parenthesis',
    greetings: "start typing parenthesis",
    keydown: function() {
        if (position) {
            this.set_position(position);
            position = false;
        }
    },
    keypress: function(e) {
        var term = this;
        if (e.key == ')') {
            setTimeout(function() {
                position = term.get_position();
                var command = term.before_cursor();
                var count = 1;
                var close_pos = position - 1;
                var c;
                while (count > 0) {
                    c = command[--close_pos];
                    if (!c) {
                        return;
                    }
                    if (c === '(') {
                        count--;
                    } else if (c == ')') {
                        count++;
                    }
                }
                if (c == '(') {
                    clearTimeout(timer);
                    setTimeout(function() {
                        term.set_position(close_pos);
                        timer = setTimeout(function() {
                            term.set_position(position)
                            position = false;
                        }, 200);
                    }, 0);
                }
            }, 0);
        } else {
            position = false;
        }
    }
});</pre>
        <p>If you want to support case where parenthesis are inside strings (it shouldn't take that one into account) then you
            can use this code (taken from my lisp interpteter lips, link in <a href="#multiline">multiline example</a>)</p>
        <pre class="javascript">
// copy from LIPS source code
var pre_parse_re = /("(?:\\[\S\s]|[^"])*"|\/(?! )[^\/\\]*(?:\\[\S\s][^\/\\]*)*\/[gimy]*(?=\s|\(|\)|$)|;.*)/g;
var tokens_re = /("(?:\\[\S\s]|[^"])*"|\/(?! )[^\/\\]*(?:\\[\S\s][^\/\\]*)*\/[gimy]*(?=\s|\(|\)|$)|\(|\)|'|"(?:\\[\S\s]|[^"])+|(?:\\[\S\s]|[^"])*"|;.*|(?:[-+]?(?:(?:\.[0-9]+|[0-9]+\.[0-9]+)(?:[eE][-+]?[0-9]+)?)|[0-9]+\.)[0-9]|\.|,@|,|`|[^(\s)]+)/gim;
// ----------------------------------------------------------------------
function tokenize(str) {
    var count = 0;
    var offset = 0;
    var tokens = [];
    str.split(pre_parse_re).filter(Boolean).forEach(function(string) {
        if (string.match(pre_parse_re)) {
            if (!string.match(/^;/)) {
                var col = (string.split(/\n/), [""]).pop().length;
                tokens.push({
                    token: string,
                    col,
                    offset: count + offset,
                    line: offset
                });
                count += string.length;
            }
            offset += (string.match("\n") || []).length;
            return;
        }
        string.split('\n').filter(Boolean).forEach(function(line, i) {
            var col = 0;
            line.split(tokens_re).filter(Boolean).forEach(function(token) {
                var line = i + offset;
                var result = {
                    col,
                    line,
                    token,
                    offset: count + line
                };
                col += token.length;
                count += token.length;
                tokens.push(result);
            });
        });
    });
    return tokens;
}
var term = $('body').terminal($.noop, {
    name: 'lips',
    greetings: false,
    // below is the code for parenthesis matching (jumping)
    keydown: function() {
        if (position) {
            term.set_position(position);
            position = false;
        }
    },
    keypress: function(e) {
        var term = this;
        if (e.key == ')') {
            setTimeout(function() {
                position = term.get_position();
                var command = term.before_cursor();
                var len = command.split(/\n/)[0].length;
                var tokens = tokenize(command);
                var count = 1;
                var token;
                var i = tokens.length - 1;
                while (count > 0) {
                    token = tokens[--i];
                    if (!token) {
                        return;
                    }
                    if (token.token === '(') {
                        count--;
                    } else if (token.token == ')') {
                        count++;
                    }
                }
                if (token.token == '(') {
                    clearTimeout(timer);
                    setTimeout(function() {
                        term.set_position(token.offset);
                        timer = setTimeout(function() {
                            term.set_position(position)
                            position = false;
                        }, 200);
                    }, 0);
                }
            }, 0);
        } else {
            position = false;
        }
    }
});
        </pre>
        <p>The code will tokenize strings and it will not split on parenthesis that are inside regular expressions or strings.</p>

      </article>
      <article id="multiline">
        <header><h2>Multiline input</h2></header>
        <p>Here is code that can be use together with parenthesis balancing:</p>
        <div class="term"></div>
        <pre class="javascript">
// balancing function code is different than previous example
// because we are counting whole command
function balance(code) {
    // tokenize from previous example
    var tokens = tokenize(code);
    var count = 0;
    var token;
    var i = tokens.length;
    while ((token = tokens[--i])) {
        if (token.token === '(') {
            count++
        } else if (token.token == ')') {
            count--;
        }
    }
    return count;
}
var term = $('#multiline .term').terminal(function(command) {
    console.log({command});
}, {
    keymap: {
        ENTER: function(e, original) {
            if (balance(this.get_command()) === 0) {
                original();
            } else {
                this.insert('\n');
            }
        }
    }
});</pre>
        <p>My <a href="https://lips.js.org">Scheme based Lisp interpreter</a> also have basic auto indent.</p>
      </article>
      <article id="rouge">
        <header><h2>Rouge like game</h2></header>
        <p>If you want to create game like Rouge (game where characters that are elements of environmet
          are just ASCII characters, more info on <a href="https://en.wikipedia.org/wiki/Roguelike">Wikipedia</a>),
          you can use <a href="https://ondras.github.io/rot.js/hp/">rot.js</a> framework,
          <a href="https://codepen.io/jcubic/pen/oMbgym">here is base</a> that you can be used to create
          real game. It have random generated levels and you collect gold. If you create nice game don't
          forget to share. The game don't renders on terminal but on canvas, but when interacting it look like
          part of the terminal.
        </p>
      </article>
      <article id="confirm">
        <header><h2>Browser confirm replacement</h2></header>
        <p>Here is jQuery plugin that can be used as replacement for native browser function confirm:</p>
        <pre class="javascript">
$.fn.confirm = async function(message) {
    var term = $(this).terminal();
    const response = await new Promise(function(resolve) {
        term.push(function(command) {
            if (command.match(/Y(es)?/i)) {
                resolve(true);
            } else if (command.match(/N(o)?/i)) {
                resolve(false);
            }
        }, {
            prompt: message
        });
    });
    term.pop();
    return response;
};
        </pre>
        <p>It use new async await syntax that will not work in IE, for this browser you can use this code that only use Promises or like in code below using jQuery Deferred:</p>
        <pre class="javascript">
$.fn.confirm = function(message) {
    var term = $(this).terminal();
    var deferred = new $.Deferred();
    term.push(function(command) {
        if (command.match(/^Y(es)?$/i)) {
            deferred.resolve(true);
        } else if (command.match(/^N(o)?$/i)) {
            deferred.resolve(false);
        }
        if (command.match(/^(Y(es)?|N(o)?)$/i)) {
            term.pop();
        }
    }, {
        prompt: message
    });
    return deferred.promise();
};
        </pre>
        <p>To use the plugin you can use this code:</p>
        <pre class="javascript">
term.confirm('Are you sure? Y/N ').then(function(confirm) {
   if (confirm) {
      console.log('User confirm');
   } else {
      console.log("User didn't confirm");
   }
});
        </pre>
      </article>
      <article id="newline">
        <header><h2>Echo without newline</h2></header>
        <p>This was requested few times and I've finally created monkey patch for echo command.</p>
        <p>From version 2.8.0 repo contain file (the file require version 2.8.0 that added new API method <code><strong>echo_command</strong></code>). If you include the file you will have new option in echo <code><strong>newline</strong></code> (default is true).</p>
        <pre class="html">&lt;script src="https://unpkg.com/jquery.terminal/js/echo_newline.js"&gt;&lt;/script&gt;</pre>
        <pre class="javascript">$('body').terminal({
    foo: async function() {
        this.echo('.', {newline: false});
        await sleep(1000);
        this.echo('.', {newline: false});
        await sleep(1000);
        this.echo('.', {newline: false});
    }
});</pre>
        <p>Below is code for original example that was adding echo, it was buggy. The one in repo is much better,
          and it have unit test coverage.</p>
        <p>It will not be added to the library though. It will only work with string prompts,
          functions will require more work.</p>
        <pre class="javascript">var last;
var term = $('body').terminal($.noop, {
    echoCommand: false,
    keymap: {
        'ENTER': function(e, original) {
            var str;
            if (!last) {
                str = this.get_prompt() + this.get_command();
            } else {
                var str = last + prompt + this.get_command();
                last = '';
            }
            this.echo(str);
            original(e);
        }
    },
    prompt: '>>> '
});
var prompt = term.get_prompt();
(function(echo) {
    term.echo = function(arg, options) {
        var settings = $.extend({
            newline: true
        }, options);
        if (!prompt) {
            prompt = this.get_prompt();
        }
        if (settings.newline === false) {
            // this probably can be simplify because terminal handle
            // newlines in prompt
            last += arg;
            arg += this.get_prompt();
            var arr = arg.split('\n');
            var last_line;
            if (arr.length === 1) {
                last_line = arg;
            } else {
                echo(arr.slice(0, -1).join('\n'), options);
                last_line = arr[arr.length - 1];
            }
            this.set_prompt(last_line);
        } else {
            if (prompt) {
                this.set_prompt(prompt);
            }
            if (last) {
                echo(last + arg, options);
            } else {
                echo(arg, options);
            }
            last = '';
            prompt = '';
        }
    };
})(term.echo);
        </pre>
      </article>
      <article id="ansi">
        <header><h2>ANSI artwork</h2></header>
        <p>From version 2.0.0 that fixed unix_formatting you can view <a href="https://en.wikipedia.org/wiki/ANSI_art">ANSI artwork</a> on Terminal.</p>
        <p>First you need to convert the artwork to UTF-8 on Linux you can use <a href="https://unix.stackexchange.com/a/475529/1806">iconv command</a></p>
        <div class="wrapper">
          <pre>
iconv -f CP437 -t UTF-8 < artwork.ans
          </pre>
        </div>
        <p>You can find ANSI artwork in <a href="https://fuel.wtf/packs/fuel27/">Fuel Magazine</a> (files with .ans extension) or in google.</p>
        <p>Here is <a href="https://codepen.io/jcubic/pen/pxdxmN">codepen demo that display few artworks from fuel</a>. It looks best on Linux and Window 10. Windows 7 and lowwer have broken implementation of Unicode so they don't look good. On MacOS it also don't look good (because of how Unicode characters are rendered) but better than on Windows 7.</p>
      </article>
      <article id="figlet">
        <header><h2>Figlet ASCII art fonts</h2></header>
        <p>Figlet is a unix utility, that allows to render text using ASCII art fonts.</p>
        <p>Example:</p>
        <div class="wrapper">
          <pre>
    _______       __     __     ____
   / ____(_)___ _/ /__  / /_   / __ \___  ____ ___  ____
  / /_  / / __ `/ / _ \/ __/  / / / / _ \/ __ `__ \/ __ \
 / __/ / / /_/ / /  __/ /_   / /_/ /  __/ / / / / / /_/ /
/_/   /_/\__, /_/\___/\__/  /_____/\___/_/ /_/ /_/\____/
        /____/
          </pre>
        </div>
        <p>There is also library in JavaScript on npm, that implement same algorithm (and reuse the fonts).
          You can use that library from webpack or from unpgk.com (or different CDN), to render text or
          greetings on the terminal.</p>
        <p>With this you can have greetings similar to default one (but that was created by hand).</p>
        <p>You also don't need to care about escaping special characters.</p>
        <p>To see how it will look like in terminal, see this <a href="https://codepen.io/jcubic/pen/VwvEvmN?editors=0010">Codepen Demo</a>.</p>
      </article>
      <article id="fontawesome">
        <header><h2>FontAwesome Icons</h2></header>
        <p>From version 2.16.0 the library have improvements for handling FontAwesome icons, in output and command line.</p>
        <p>Here is demo of using <a href="https://codepen.io/jcubic/pen/oNjBbxM?editors=0010">FontAwesome icons with jQuery Terminal</a>.</p>
      </article>
      <article id="mobile">
        <header><h2>Mobile demos</h2></header>
        <p>Terminal work out of the box on mobile (latest version tested mostly on Android).</p>
        <p>To use terminal on mobile you just need standard viewport meta tag</p>
        <div class="wrapper">
          <pre>
&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"/&gt;
          </pre>
        </div>
        <p>Demos that can be tested on mobile (default examples that are in git repository on GitHub)</p>
        <ul>
          <li><a title="JQuery Terminal Emulator Demo" href="multiple-interpreters-demo.html">Multiple interpreters</a></li>
          <li><a title="JSON-RPC demo" href="rpc-demo.html">JSON-RPC with authentication</a></li>
        </ul>
        <p><strong>NOTE:</strong> some examples may show old solution to full screen terminal.</p>
        <pre class="javascript">$('body').terminal(function() {
}, {
    onBlur: function() {
        return false;
    }
});
        </pre>
        <p style="color:red">
          If you use onBlur like this, your terminal will not work on mobile.
          This is because on Mobile (require by the platform) keyboard can't be
          in focus when you open any website. To activate the keyboard, you need
          disabled terminal, so you can tap on it to enable and show virtual keyboard.
        </p>
      </article>
      <article id="codepen">
        <header><h2>Codepen demos</h2></header>
        <p>Here is a link to a <a href="https://codepen.io/collection/LPjoaW">list of various codepen demos</a>.</p>
      </article>
      <article id="wild">
        <header><h2>In the wild</h2></header>
        <ul>
          <li>Games
            <ul>
              <li><a href="https://rdebath.github.io/LostKingdom/">LostKingdom</a> &mdash; text based game.</li>
              <li><a href="https://gfc.albertocongiu.com/thelab/">The Lab</a> &mdash; game where you code in javascript.</li>
              <li><a href="https://www.gamecreation.org/game/lunatix">Lunatix</a> &mdash; a unix-inspired educational text-based adventure game.</li>
              <li><a href="https://cmdchallenge.com/">cmdchallenge.com</a> &mdash; game in which you need to enter one liner bash commands.</li>
              <li><a href="https://facundoolano.github.io/advenjure/">advenjure</a> &mdash; Text adventure engine written in Clojure and ClojureScript</li>
              <li><a href="https://thoster.net/adventex/">adventex</a> &mdash; Adventex is a simple interactive fiction (text adventure) game with its own adventure system.</li>
            </ul>
          </li>
          <li>Languages
            <ul>
              <li><a href="https://biwascheme.org">BiwaScheme</a> &mdash; use the same code as in example.</li>
              <!-- <li><a href="http://niutech.github.io/typescript-interpret/">Typescript Interpreter</a>.</li> -->
              <li><a href="https://github.com/glejeune/ews">Elixir Web Shell</a>.</li>
              <li><a href="https://www.npmjs.com/package/lightpost">lightpost</a> &mdash; A lightweight language based on postfix notation.</li>
              <li><a href="https://www.mimuw.edu.pl/~szynwelski/nlambda/console/">intereter for nlambda</a> &mdash; Functional Programming over Infinite Structures. (not working anymore, the script files return 403 error).</li>
              <li><a href="http://mu-script.org/repl/">Mu Script</a> &mdash; interpreter to mu script.</li>
              <li><a href="https://lips.js.org" title="Scheme based lisp in JavaScript">LIPS Scheme</a> &mdash; Powerful Scheme based Lisp in JavaScript.</li>
              <li><a href="https://github.com/albertlatacz/java-repl">Java-repl</a> &mdash; interactive interpreter for the Java language.</li>
              <li><a href="https://codepen.io/jcubic/pen/VGYBVj?editors=1010">PHP Interpreter</a> &mdash; php interpter using <a href="https://asmblah.github.io/uniter/">uniter library</a>.</li>
              <li><a href="http://nhiro.org/learn_language/index.html">Learn Language</a> &mdash; few interpreters for different learning languages by <a href="http://www.nishiohirokazu.org/">Dr. NISHIO Hirokazu</a>.</li>
              <li><a href="https://itnext.io/interactive-r-debugger-repl-for-shiny-apps-87c769be4859">R shell in browser</a> &mdash; article that show how to create Ineractive debugger for Shiny R apps, which is basically R shell</li>
              <li><a href="https://pyodide.org/">pyodide</a> &mdash; a Python distribution for the browser and Node.js based on WebAssembly/Emscripten.</li>
              <li><a href="https://try.javascript.org.pl/">JavaScript REPL</a> &mdash; JavaScript Interpreter with split view and <a href="https://eloquentjavascript.net/">Eloquent JavaScript</a> book.</li>
              <li><a href="https://github.com/stevenknox/AspNetWebCLI">AspNet Web CLI</a> &mdash; Web CLI tool for Asp.Net Core using SignalR.</li>
              <li><a href="https://github.com/georgestagg/webR">WebR</a> &mdash; This project aims to compile the statistical language R into WASM for use in a browser, via Emscripten.</li>
              <li><a href="https://cyclone-scheme.netlify.app/terminal.html">Cyclone</a> &mdash; Scheme->C compiler.</li>
            </ul>
          </li>
          <li>Interpreters, interfaces, Tools, APIs
            <ul>
              <li><a href="https://npmjs.org/package/node-web-repl">node-web-repl</a> &mdash; Add a web-based read/eval/print/loop to your Node.js app.</li>
              <li><a href="https://github.com/bearstech/PloneTerminal">PloneTerminal</a> &mdash; terminal for plone.</li>
              <li><a href="https://www.drupal.org/project/terminal">Drupal Terminal</a> &mdash; terminal for drupal.</li>
              <li><a href="https://github.com/cixtor/phpshellgen">PHP-Shell Generator</a>.</li>
              <li><stike><a href="https://www.docker.io/gettingstarted/">Docker</a> &mdash; Docker.io use terminal in it's interactive tutorial.</stike></li>
              <li><a href="https://apps.splunk.com/app/1607/">Web Terminal for Splunk</a>.</li>
              <li><a href="https://github.com/kaa/manhole">Manhole</a> &mdash; A simple REPL into a running aspnet application.</li>
              <li><a href="https://leash.jcubic.pl">leash</a> &mdash; unix shell from the browser, lot of features of terminal.</li>
              <li><a href="https://github.com/avalanche123/node-console">node-console</a> &mdash; using of socket IO that respond to events.</li>
              <li><a href="https://agnostic.housegordon.org/">AGNOSTIC</a> &mdash; UNIX Shell Javascript Emulation.</li>
              <li><a href="https://www.jimsey.org/sshw/">sshw</a> &mdash; SSH client in a browser, via a JEE webapp.</li>
              <li><a href="https://calc.nutpan.com/">Online calculator</a>.</li>
              <li><a href="https://www.web-console.org/">web-console</a> &mdash; Web Console is a web-based application that allows to execute shell commands on a server directly from a browser (web-based SSH).</li>
              <li><a href="https://samy.pl/keysweeper/">KeySweeper</a> &mdash; use terminal to show live keyboard keystrokes logged.</li>
              <li><a href="https://github.com/AlexNisnevich/ECMAchine">ECMAchine</a> &mdash; Lisp-based in-browser toy operating system.</li>
              <li><a href="https://packagist.org/packages/samdark/yii2-webshell">yii2-webshell</a> &mdash; A web shell that allows to run yii console commands and create your own commands.</li>
              <li><a href="https://themes.gohugo.io/themes/hugo-theme-terminalcv/">terminalCV</a> &mdash; a Hugo Theme.</li>
              <li><a href="http://lib.haxe.org/p/dconsole/">Haxe Interpreter</a> &mdash; The Cross-platform Toolkit</li>
              <li><a href="http://www.crashub.org/1.3/reference.html">CRaSH</a> &mdash; web interface for The Common Reusable SHell (CRaSH).</li>
              <li><a href="https://lifescience.opensource.epam.com/miew/">miew</a> &mdash; 3D Molecule Viewer(it use <a href="https://threejs.org/">three.js</a> and WebGL).</li>
              <li><a href="https://codepen.io/jcubic/pen/dVBaRm">AlaSQL Demo</a> &mdash; my codepen Demo of in Browser SQL interpreter with syntax highlight.</li>
              <li><a href="https://sql.org.pl/">Try SQL Online</a> &mdash; SQL interpreter with a tutorial in Polish.</li>
              <li><a href="https://www.graspjs.com/">graspjs</a> &mdash; graspjs is a grep+sed like tool that use AST instead of regex, it use Terminal to show demo of few commands including grasp.</li>
              <li><a href="https://clcalc.net/">clcalc.net</a> &mdash; Online command-line style calculator.</li>
              <li><a href="https://github.com/deep-compute/funcserver">funcserver</a> &mdash; Simple and opiniated way to build APIs in Python.</li>
              <li><a href="https://github.com/Fluidbyte/PHP-jQuery-Terminal-Emulator">PHP-jQuery-Terminal-Emulator</a> &mdash; Simple Shell.</li>
              <li><a href="https://jcubic.github.io/git/">GIT Web Terminal</a> &mdash; You can use git directly from your browser.</li>
              <li><a href="https://github.com/ChrisCindy/node-web-console">Node-Web-Console</a> &mdash; shell with Node.js as backend.</li>
              <li><a href="https://sr6033.github.io/lterm/">LTerm</a> &mdash; Online bash terminal(emulator) tutorial, source can be found on <a href="https://github.com/sr6033/lterm/">github</a>.</li>
              <li><a href="https://www.chunqiuyiyu.com/ervy/">Ervy</a> &mdash; library that allow to render charts in Terminal, uses jQuery Terminal as interactive demo. The same code can be found at <a href="https://codepen.io/jcubic/pen/gObPBdP?editors=0010">CodePen</a> that fixes text selection.</li>
              <li><a href="https://github.com/tiagolr/dconsole">DConsole</a> &mdash; Haxe game-like console that provides runtime acess to methods, variables and more.</li>
              <li><a href="https://github.com/RobinRadic/laravel-bukkit-console">Laravel Bukkit Console</a> &mdash; Laravel package providing remote access to a Bukkit server console using JS/PHP/Laravel and the SwiftAPI Bukkit plugin.</li>
              <li><a href="https://kibibit.io/command-lime/">Command-Lime</a> &mdash; Show what your CLI application can do using this terminal onboarding mock.</li>
              <li><a href="https://github.com/jcubic/gaiman">Gaiman</a> &mdash; simple programming language that compiles to jQuery Terminal based code. It has <a href="https://gaiman.js.org/">Live playgroud app</a> where you can create terminal with simpler code.</li>
              <li><a href="https://github.com/KennethScott/SpecOps">SpecOps</a> &mdash; SpecOps is a web-based, centralized PowerShell script repository where non-technical users can run scripts via a user-friendly GUI.</li>
              <li><a href="https://sql.org.pl/">SQL</a> &mdash; SQL interpreter.</li>
              <li><a href="http://www.lambdashell.com/">Lambda Shell</a> &mdash; This is a simple AWS lambda function that does a straight exec. You can also read <a href="https://zaccharles.medium.com/looking-at-lambdashell-com-after-3-years-f86b87ba2e47">article about Lambda Shell on Medium</a>.</li>
              <li><a href="https://numbat.dev/">Numbat</a> &mdash; high precision scientific calculator with full support for physical units.</li>
              <li><a href="https://jmurmel.github.io">Murmel</a> &mdash; a lightweight JVM-based interpreter/ compiler for Murmel, a Lisp dialect inspired by a subset of Common Lisp use jQuery Terminal on the <a href="https://jmurmel.github.io/repl/">REPL page</a>.</li>
            </ul>
          </li>
          <li>Libraries that wrap jQuery Terminal
            <ul>
              <li><a href="https://github.com/mattlo/angular-terminal">angular-terminal</a> &mdash; A port of jQuery.terminal into AngularJS.</li>
              <li><a href="https://packagist.org/packages/recca0120/laravel-tracy">laravel-tracy</a> &mdash; A Laravel Package to integrate Nette Tracy Debugger. With <a href="https://cdn.rawgit.com/recca0120/laravel-tracy/master/docs/tracy-exception.html">demo</a>.</li>
              <li><a href="https://github.com/recca0120/laravel-terminal">laravel-terminal</a> &mdash; Lavarel package by the same author.</li>
              <li><a href="https://github.com/bbody/CMD-Resume">CMD-Resume</a> &mdash; Library for terminal based Resumes.</li>
              <li><a href="https://packagist.org/packages/runcmf/runtracy">runtracy</a> &mdash; Slim Framework Debugger</li>
              <li><a href="https://github.com/JamesHovious/jterm">jterm</a> &mdash; Thin wrapper over the jquery.terminal library for use with <a href="https://github.com/gopherjs/gopherjs">gopherjs</a>.</li>
            </ul>
          </li>
          <li id="home_pages">Home Pages (Custom portfolio terminal websites)
            <ul>
              <li><a href="http://dhruvbird.com/">Dhruv Matani</a> &mdash; use tilda for navigation.</li>
              <li><a href="https://huy.im/">Huy Doan</a> &mdash; black/green fullscreen.</li>
              <li><strike><a href="http://www.hacklover.net/">hacklover.net</a> &mdash; use terminal inside draggable window.</strike></li>
              <li><a href="https://demlinks.com/">demlinks.com</a> &mdash; terminal in a popup.</li>
              <li><a href="https://huntergregal.com/">huntergregal.com</a> &mdash; Hunter Gregal's personal website, full screen.</li>
              <li><a href="https://www.spriteking.com/">spriteking.com</a> &mdash; full screen green terminal.</li>
              <li><a href="http://chandrabhavanasi.com/">chandrabhavanasi.com</a> &mdash; full screen terminal with green text.</li>
              <li><a href="http://www.ryanm.ac/">ryanm.ac</a> &mdash; terminal in window with white background (old version without css variables).</li>
              <li><a href="http://oldu.fr/term/">oldu.fr</a> &mdash; green full screen terminal with ASCII art header.</li>
              <li><a href="https://nntoan.com/">nntoan.com</a> &mdash; full screen with green ASCII art.</li>
              <li><a href="https://itridersclub.com/">itridersclub.com</a> &mdash; Full screen terminal with ASCII Art and background.</li>
              <li><a href="https://numeus.xyz/">numeus.xyz</a> &mdash; web3 related website with commands hidden on the server (it have easter egg command writtten in JavaScript, that can't be found in source code). The code was modified from original solution that don't leak information aboutt hidden command.</li>
              <li><a href="https://jarvileh.to/">jarvileh.to</a> &mdash; personal website, ASCII art, glow effect, color, typing animation.</li>
            </ul>
          </li>
          <li id="unusual">Unusual use of terminal
            <ul>
              <li><a href="https://web.archive.org/web/20190311132815/https://duckduckgo.com/tty/">Duck Duck Go</a> &mdash; used terminal as search interface. (Archive)</li>
              <li><a href="https://redditshell.com/">redditshell</a> &mdash; Reddit shell. (<a href="https://github.com/jasonbio/reddit-shell">repo</a>)</li>
              <li><a href="https://wedding.jai.im/">wedding.jai.im</a> &mdash; use terminal to make OSX like terminal as invitation for a wedding.</li>
              <li><a href="https://web.archive.org/web/20150216120633/https://premjith.in/">premjith.in</a> &mdash; Another wedding invitation using Ubuntu command line. (Archive)</li>
              <li><a href="https://www.npmjs.com/package/wedding">weddinng npm package</a> &mdash; this package use node to have few commands and it also have web interface using jQuery Terminal (didn't tested it only check the content using <a href="https://unpkg.com/wedding/">unpkg.com</a>).</li>
              <li><a href="https://projectaon.org/staff/christian/gamebook.js/">gamebook.js</a> &mdash; an <a href="http://en.wikipedia.org/wiki/Interactive_fiction">IF</a>-style gamebook engine create by <a href="http://christianjauv.in/">Christian Jauvin</a>.</li>
              <li><a href="https://heiswayi.github.io/w4y1/">w4y1</a> &mdash; An AI program created by Heiswayi Nrird as a fragment of his memories.</li>
              <li><a href="https://codepen.io/jcubic/pen/qPMPOR">text based dialog</a> &mdash; it look like input dialog for dialog linux command.</li>
              <li><a href="https://trypython.jcubic.pl">Try Python</a> &mdash; try python website using <a href="https://brython.info">Brython</a> and python syntax highlighting while you type using <a href="https://prismjs.com/">prism.js</a></li>
              <li><a href="https://goonhub.com/secret">goonhub.com</a> &mdash; secret terminal with some styling and flicker animation (incorporated in mine <a href="#different_look">vintage terminal demo</a>.</li>
              <li><a href="http://www.masraniglobal.com/terminal/system/desktop.html">masraniglobal</a> &mdash; Jurassic world themed terminal in dialog box.</li>
              <li><a href="https://makker.hu/makkeroni/">Makkeróni</a> &mdash; Sound System Inerface/OS.</li>
              <li><a href="https://voidbbs.com/">VOID BBS</a> &mdash; web interface to BBS system.</li>
              <li><a href="https://edgorman.github.io/">ed&gt;os</a> &mdash; Simple OS like application as home page, where you can open tab with terminal.</li>
              <li><a href="https://fake.terminal.jcubic.pl/">Fake Linux Terminal</a> &mdash; Terminal inside SVG laptop. This is work in progress and attempt to create working Linux system that will work similar to real Linux written in JavaScript. More on <a href="https://github.com/jcubic/fake-linux-terminal">GitHub Repo</a>. <strong>WARNING</strong> The code use latest development version of the library.</li>
              <li><a href="https://foobar.withgoogle.com/">Google Foobar</a> &mdash; invitation only website created for recruitment.</li>
              <li><a href="https://jcubic.gumroad.com/l/vintage-web-terminal-quiz-application">Vintage Quiz Terminal App</a> &mdash; application inspired by <a href="https://web.archive.org/web/20211230002530/https://www.rataalada.com/">Batman Movie Quiz App</a> that allowed to solve Riddler puzzles. The first version was created for NFT project and later refactored as a standalone configurable app that you can buy on Gumroad.</li>
            </ul>
          </li>
          <li>Inside of a biger projects
            <ul>
              <li><a href="http://code.google.com/p/os2online/">os2online</a> &mdash; Web based simulation of OS/2 Warp 3.0 operating system use jquery terminal.</li>
              <li><a href="https://code.google.com/p/orongocms/">OrongoCMS</a>.</li>
              <li><strike><a href="http://realhub.org/dev/apps/default/?node=central">WISDM</a> &mdash; Web-Interactive Scientific Data Manager.</strike></li>
              <li><a href="http://alessandrorosa.altervista.org/circles/">Circles</a> &mdash; ploting app for <a href="https://en.wikipedia.org/wiki/Kleinian_groups">Kleinian groups</a> &mdash; it have terminal as a tool.</li>
              <li><a href="https://worksheets.codalab.org/worksheets">codalab</a> &mdash; use terminal on worksheet page.</li>
              <li><a href="https://pterodactyl.io/">Pterodactyl</a> &mdash; it's the open-source game server management panel built with PHP7, Nodejs, and Go.</li>
              <li><a href="https://www.magnolia-cms.com/">Magnolia</a> &mdash; CMS for integration.</li>
              <li><a href="https://github.com/screeps">screeps</a> &mdash; A standalone server for programming game Screeps use terminal in it's <a href="https://github.com/screeps/launcher">launcher</a>.</li>
              <li><a href="https://esipfed.github.io/Geoweaver/">Geoweaver</a> &mdash; System for working with Long Short Term Memory (LSTM) Recurrent Neural Network (RNN).</li>
              <li><strike><a href="https://aerolab.co/coding-challenge">Aerolab's Coding Challenge</a> &mdash; Interface for programming challange.</strike></li>
            </ul>
          </li>
          <li>Other
            <ul>
              <li><a href="https://codepen.io/TheRealAlan/pen/qNOZPo">Demo using coffescript and animation effects</a></li>
            </ul>
          </li>
        </ul>
      </article>
    </section>
    <footer>
      <p id="copy">Copyright (c) 2010-<?php  echo date('Y'); ?> <a href="https://jakub.jankiewicz.org/">Jakub T. Jankiewicz</a> Website: <a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a> <span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span> <span>source on <a href="https://github.com/jcubic/jquery.terminal-www">github</a></p>
    </footer>
    <script>//<![CDATA[
     function unbalanced_parentheses(text_code) {
         var tokens = (new BiwaScheme.Parser(text_code)).tokens;
         var parentheses = 0;
         var brakets = 0;
         for(var i=0; i<tokens.length; ++i) {
             switch(tokens[i]) {
                 case "[": ++brakets; break;
                 case "]": --brakets; break;
                 case "(": ++parentheses; break;
                 case ")": --parentheses; break;
             }
         }
         return parentheses != 0 || brakets != 0;
     }

     jQuery(function($, undefined) {
         // something is making blur on terminal on click
         $(document).on('click', '.terminal', function(e) {
             e.stopPropagation();
         });
         var trace = false;
         var bscheme = new BiwaScheme.Interpreter(function(e, state) {
             dterm.terminal.error(e.message);
         });
         var trace = false;

         puts = function(string) {
             dterm.terminal.echo(string);
         };
         Console.puts = function(string) {
             term.echo(string);
         };
         BiwaScheme.Port.current_output = new BiwaScheme.Port.CustomOutput(
             Console.puts
         );
         var code_to_evaluate = '';
         var dterm = $('#dialogterm').dterm(function(command, term) {
             code_to_evaluate += ' ' + command;
             if (!unbalanced_parentheses(code_to_evaluate)) {
                 try {
                     if (trace) {
                         var opc = biwascheme.compile(code_to_evaluate);
                         var dump_opc = (new BiwaScheme.Dumper()).dump_opc(opc);
                         term.echo(dump_opc, {raw: true});
                     }
                     bscheme.evaluate(code_to_evaluate, function(result) {
                         if (result !== undefined && result !== BiwaScheme.undef) {
                             if (result instanceof $.fn.init) {
                                 term.echo('=> ' + '#<object $("' + result.selector + '")>');
                             } else if (typeof result == 'boolean') {
                                 term.echo('=> ' + (result ? 'true' : 'false'));
                             } else {
                                 term.echo('=> ' + BiwaScheme.to_write(result));
                             }
                         }
                     });
                 } catch(e) {
                     term.error(e.message);
                     code_to_evaluate = '';
                     throw(e);
                 }
                 term.set_prompt('scheme> ');
                 code_to_evaluate = '';
             } else {
                 term.set_prompt('... ');

             }
         }, {
             greetings: false,
             onInit: function(terminal) {
                 terminal.echo('BiwaScheme Interpreter version ' +
                               BiwaScheme.Version +
                               '\nCopyright (C) 2007-2009 Yutaka HARA and ' +
                               'the BiwaScheme team\n');
             },
             width: 480,
             height: 320,
             exit: false,
             autoOpen: false,
             name: 'biwa',
             prompt: 'scheme> '
         });
         // run trace mode
         BiwaScheme.define_libfunc("trace", 0, 0, function(args) {
             trace = !trace;
             return BiwaScheme.undef;
         });
         // redefine sleep it should pause terminal
         BiwaScheme.define_libfunc("sleep", 1, 1, function(ar){
             var sec = ar[0];
             assert_real(sec);
             dterm.terminal.pause();
             return new BiwaScheme.Pause(function(pause){
                 setTimeout(function(){
                     dterm.terminal.resume();
                     pause.resume(BiwaScheme.nil);
                 }, sec * 1000);
             });
         });
         // clear terminal
         BiwaScheme.define_libfunc('clear', 0, 0, function(args) {
             dterm.terminal.clear();
             return BiwaScheme.undef;
         });
         $('#open_term').click(function() {
             dterm.dialog('open');
         });
         //install library functions
         $.jqbiwa();
         // END BIWASCHEME
         // ------------------------------------------------------------
         // syntax highlight
         $('pre.javascript, pre.php, pre.css, pre.html').each(function() {
             var self=$(this);
             self.syntax(self.attr('class'));
         });
         // balancing parenthesis
         (function() {
             var position;
             var timer;
             $('#parenthesis .term').terminal($.noop, {
                 name: 'parenthesis',
                 greetings: "start typing parenthesis",
                 enabled: false,
                 keydown: function() {
                     if (position) {
                         this.set_position(position);
                         position = false;
                     }
                 },
                 keypress: function(e) {
                     var term = this;
                     if (e.key == ')') {
                         setTimeout(function() {
                             position = term.get_position();
                             var command = term.before_cursor();
                             var count = 1;
                             var close_pos = position - 1;
                             var c;
                             while (count > 0) {
                                 c = command[--close_pos];
                                 if (!c) {
                                     return;
                                 }
                                 if (c === '(') {
                                     count--;
                                 } else if (c == ')') {
                                     count++;
                                 }
                             }
                             if (c == '(') {
                                 clearTimeout(timer);
                                 setTimeout(function() {
                                     term.set_position(close_pos);
                                     timer = setTimeout(function() {
                                         term.set_position(position)
                                         position = false;
                                     }, 200);
                                 }, 0);
                             }
                         }, 0);
                     } else {
                         position = false;
                     }
                 }
             });
         })();
         // ------------------------------------------------------------
         // :: multiline
         // ------------------------------------------------------------
         (function() {
             var tokens_re = /("[^"\\]*(?:\\[\S\s][^"\\]*)*"|\/[^\/\\]*(?:\\[\S\s][^\/\\]*)*\/[gimy]*(?=\s|\(|\)|$)|;.*|\(|\)|'|\.|,@|,|`|[^(\s)]+)/gi;
             function tokenize(str) {
                 var count = 0;
                 return str.split('\n').map(function(line, i) {
                     var col = 0;
                     // correction for newline characters
                     count += i === 0 ? 0 : 1;
                     return line.split(tokens_re).filter(Boolean).map(function(token) {
                         var result = {
                             col,
                             line: i,
                             token,
                             offset: count
                         };
                         col += token.length;
                         count += token.length;
                         return result;
                     });
                 }).reduce(function(arr, tokens) {
                     return arr.concat(tokens);
                 }, []);
             }
             function balance(code) {
                 var tokens = tokenize(code, true);
                 var count = 0;
                 var token;
                 var i = tokens.length;
                 while ((token = tokens[--i])) {
                     if (token.token === '(') {
                         count++
                     } else if (token.token == ')') {
                         count--;
                     }
                 }
                 return count;
             }
             var term = $('#multiline .term').terminal(function(command) {
                 console.log({command});
             }, {
                 greetings: 'Multiline command, try to type unclosed parenthesis and press enter',
                 enabled: false,
                 keymap: {
                     ENTER: function(e, original) {
                         if (balance(this.get_command()) === 0) {
                             original();
                         } else {
                             this.insert('\n');
                         }
                     }
                 }
             });
         })();
         // ------------------------------------------------------------
         (function() {
             function progress(percent, width) {
                 var size = Math.round(width*percent/100);
                 var left = '', taken = '', i;
                 for (i=size; i--;) {
                     taken += '=';
                 }
                 if (taken.length > 0) {
                     taken = taken.replace(/=$/, '>');
                 }
                 for (i=width-size; i--;) {
                     left += ' ';
                 }
                 return '[' + taken + left + '] ' + percent + '%';
             }
             var animation = false;
             var timer;
             var prompt;
             var string;
             $('#progress-bar .term').terminal(function(command, term) {
                 var cmd = $.terminal.parse_command(command);
                 if (cmd.name == 'progress') {
                     var i = 0, size = cmd.args[0];
                     prompt = term.get_prompt();
                     string = progress(0, size);
                     term.set_prompt(progress);
                     animation = true;
                     (function loop() {
                         string = progress(i++, size);
                         term.set_prompt(string);
                         if (i < 100) {
                             timer = setTimeout(loop, 100);
                         } else {
                             term.echo(progress(i, size) + ' [[b;green;]OK]')
                                 .set_prompt(prompt);
                             animation = false;
                         }
                     })();
                 }
             }, {
                 keydown: function(e, term) {
                     if (animation) {
                         if (e.which == 68 && e.ctrlKey) { // CTRL+D
                             clearTimeout(timer);
                             animation = false;
                             term.echo(string + ' [[b;red;]FAIL]')
                                 .set_prompt(prompt);
                         }
                         return false;
                     }
                 },
                 greetings: 'Progress bar demo, type [[b;#fff;]progress <WIDTH>]',
                 enabled: false
             });
         })();
         $.getJSON('https://unpkg.com/cli-spinners/spinners.json', function(spinners) {
             var animation = false;
             var timer;
             var prompt;
             var spinner;
             var i;
             function start(term, spinner) {
                 animation = true;
                 i = 0;
                 function set() {
                     var text = spinner.frames[i++ % spinner.frames.length];
                     term.set_prompt(text);
                 };
                 prompt = term.get_prompt();
                 term.find('.cursor').hide();
                 set();
                 timer = setInterval(set, spinner.interval);
             }
             function stop(term, spinner) {
                 setTimeout(function() {
                     clearInterval(timer);
                     term.set_prompt(prompt).echo(spinner.frames[i % spinner.frames.length]);
                     animation = false;
                     term.find('.cursor').show();
                 }, 0);
             }
             $('#spinners .term').terminal({
                 spinner: function(name) {
                     spinner = spinners[name];
                     if (!spinner) {
                         this.error('Spinner not found');
                     } else {
                         this.echo('press CTRL+D to stop');
                         start(this, spinner);
                     }
                 },
                 help: function() {
                     this.echo('Available spinners: ' + Object.keys(spinners).join('\t'), {keepWords: true});
                 }
             }, {
                 greetings: false,
                 onInit: function(term) {
                     term.echo('Spinners, type [[b;#fff;]help] to display available spinners ' +
                               'or [[b;#fff;]spinner <name>] for animation', {
                         keepWords: true
                     })
                 },
                 enabled: false,
                 completion: true,
                 keydown: function(e, term) {
                     if (animation) {
                         if (e.which == 68 && e.ctrlKey) { // CTRL+D
                             stop(term, spinner);
                         }
                         return false;
                     }
                 }
             });
         });
         (function() {
             var anim = false;
             function typed(finish_typing) {
                 return function(term, message, delay, finish) {
                     anim = true;
                     var prompt = term.get_prompt();
                     var c = 0;
                     if (message.length > 0) {
                         term.set_prompt('');
                         var new_prompt = '';
                         var interval = setInterval(function() {
                             var chr = $.terminal.substring(message, c, c+1);
                             new_prompt += chr;
                             term.set_prompt(new_prompt);
                             c++;
                             if (c == length(message)) {
                                 clearInterval(interval);
                                 // execute in next interval
                                 setTimeout(function() {
                                     // swap command with prompt
                                     finish_typing(term, message, prompt);
                                     anim = false
                                     finish && finish();
                                 }, delay);
                             }
                         }, delay);
                     }
                 };
             }
             function length(string) {
                 string = $.terminal.strip(string);
                 return $('<span>' + string + '</span>').text().length;
             }
             var typed_prompt = typed(function(term, message, prompt) {
                 // swap command with prompt
                 term.set_prompt(message + ' ');
             });
             var typed_message = typed(function(term, message, prompt) {
                 term.echo(message);
                 term.set_prompt(prompt);
             });
             var typed = false;
             var name = false;
             $('#user-typing .term').terminal(function(cmd, term) {
                 if (typed) {
                     term.set_prompt('> ');
                 }
                 typed = false;
                 if (name) {
                     this.echo('welcome [[b;#fff;]' + $.terminal.strip(cmd) + ']');
                     name = false;
                 } else if (cmd.match(/start/)) {
                     typed = true;
                     var msg = "Wellcome to my terminal";
                     typed_message(term, msg, 200, function() {
                         typed_prompt(term, "what's your name:", 100, function() {
                             name = true;
                         });
                     });
                 }
             }, {
                 name: 'xxx',
                 greetings: 'type [[b;#fff;]start] to start the animation',
                 onInit: function(term) {
                 },
                 enabled: false,
                 keydown: function(e) {
                     //disable keyboard when animating
                     if (anim) {
                         return false;
                     }
                 }
             });
         })();
         // ------------------------------------------------------------
         // STARWARS
         // ------------------------------------------------------------
         var frames = [];
         var LINES_PER_FRAME = 14;
         var DELAY = 67;
         var lines = star_wars.length;
         for (var i=0; i<lines; i+=LINES_PER_FRAME) {
             frames.push(star_wars.slice(i, i+LINES_PER_FRAME));
         }
         var stop = false;
         function greetings(term) {
             term.echo('STAR WARS ASCIIMACTION\n'+
                       'Simon Jansen (C) 1997 - 2008\n'+
                       'www.asciimation.co.nz\n\n'+
                       'type "play" to start animation, press CTRL+D to stop');
         }
         function play(term, delay) {
             var i = 0;
             var next_delay;
             if (delay == undefined) {
                 delay = DELAY;
             }
             function display() {
                 if (!stop) {
                     if (i == frames.length) {
                         i = 0;
                     }
                     term.clear();
                     if (frames[i][0].match(/[0-9]+/)) {
                         next_delay = frames[i][0] * delay;
                     } else {
                         next_delay = delay;
                     }
                     term.echo(frames[i++].slice(1).join('\n')+'\n');
                     setTimeout(display, next_delay);
                 } else {
                     i = 0;
                 }
             }
             display();
         }

         $('#starwarsterm').terminal(function(command, term){
             if (command == 'play') {
                 stop = false;
                 play(term);
                 term.cmd().hide();
             }
         }, {
             prompt: 'starwars> ',
             greetings: null,
             enabled: false,
             onInit: function(term) {
                 greetings(term);
             },
             keydown: function(e, term) {
                 if (e.which == 68 && e.ctrlKey) {
                     stop = true;
                     term.resume();
                     term.clear();
                     greetings(term);
                     term.cmd().show();
                     return false;
                 }
             }
         });
         $('#css-cursor .term').terminal($.noop, {
             greetings: 'smooth css blinking cursor animation',
             enabled: false
         });
     });
  //]]></script>
    <!--
    <script defer src="https://api.feedbhack.com/assets/app.js" website-id="670311f2ee359a44f772ffcf"></script>
    -->
    <script src="https://js-de.sentry-cdn.com/c6868ced9c228b7da5e50196c0ab2f14.min.js" crossorigin="anonymous"></script>
    <? if ($_SERVER["HTTP_HOST"] != "localhost" && !isset($_GET['track'])): ?>
    <!-- Start Open Web Analytics Tracker -->
    <script type="text/javascript">
    //<![CDATA[
    var owa_baseUrl = 'https://stats.jcubic.pl/';
    var owa_cmds = owa_cmds || [];
    owa_cmds.push(['setSiteId', '9b6210e220f27093109ddf895e626f1a']);
    owa_cmds.push(['trackPageView']);
    owa_cmds.push(['trackClicks']);
    (function() {
        var _owa = document.createElement('script'); _owa.type = 'text/javascript'; _owa.async = true;
        owa_baseUrl = ('https:' == document.location.protocol ? window.owa_baseSecUrl || owa_baseUrl.replace(/http:/, 'https:') : owa_baseUrl );
        _owa.src = owa_baseUrl + 'modules/base/js/owa.tracker-combined-min.js';
        var _owa_s = document.getElementsByTagName('script')[0]; _owa_s.parentNode.insertBefore(_owa, _owa_s);
    }());
    //]]>
    </script>
    <!-- End Open Web Analytics Code -->
    <script defer src="https://cloud.umami.is/script.js" data-website-id="55bf99f6-75ef-441d-95b1-27bcc3b7b332"></script>
    <? endif; ?>
  </body>
</html>
