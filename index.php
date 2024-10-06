<?php
header("X-Powered-By: ");
require("utils.php");

$version = @file_get_contents('version');

$base = "https://raw.githubusercontent.com/jcubic/jquery.terminal/";
$files = array(
    "js" => array(
        "description" => "unminified version [%SIZE] [Gzip: %GZIP]",
        "fname" => "js/jquery.terminal-$version.js",
    ),
    "js.min" => array(
        "description" => "minified version [%SIZE] [Gzip: %GZIP]",
        "fname" => "js/jquery.terminal-$version.min.js"
    ),
    "css" => array(
        "description" => "stylesheet [%SIZE] [Gzip: %GZIP]",
        "fname" => "css/jquery.terminal-$version.css"
    ),
    "css.min" => array(
        "description" => "minified stylesheet - [%SIZE] [Gzip: %GZIP]",
        "fname" => "css/jquery.terminal-$version.min.css"
    ),
    "prism" => array(
        "description" => "formatter to be used with PrismJS that hightlights different programming languages - [%SIZE]",
        "fname" => "js/prism.js"
    ),
    "less" => array(
        "description" => "very basic reimplementation of less *nix command in jQuery Terminal - [%SIZE] [Gzip: %GZIP]",
        "fname" => "js/less.js"
    ),
    "emoji.js" => array(
        "description" => "formatter that can be used to render Emoji - [%SIZE]",
        "fname" => "js/emoji.js"
    ),
    "emoji.css" => array(
        "description" => "CSS file that need to be used with emoji.js - [%SIZE] [Gzip: %GZIP]",
        "fname" => "css/emoji.css"
    ),
    "dterm" => array(
        "description" => "jQuery UI Dialog - [%SIZE]",
        "fname" => "js/dterm.js"
    ),
    "ascii_table" => array(
        "description" => "helper that create ASCII table like the one in MySQL CLI - [%SIZE]",
        "fname" => "js/ascii_table.js"
    ),
    "pipe" => array(
        "description" => "helper function that wrapps interpreter and create Unix Pipe operator - [%SIZE]",
        "fname" => "js/pipe.js"
    ),
    "unix" => array(
        "description" => "formatter that convert UNIX ANSI escapes to terminal and display them as html - [%SIZE]",
        "fname" => "js/unix_formatting.js"
    ),
    "xml" => array(
        "description" => "simple formatter that allow to use xml like syntax with colors as tags - [%SIZE]",
        "fname" => "js/xml_formatting.js"
    )
);

$size = json_decode(file_get_contents("$version.json"), true);
foreach ($files as $key => &$array) {
    $fname = $array['fname'];
    $normal = $size[$fname]['size'];
    $gzip = $size[$fname]['gzip'];
    $array['description'] = preg_replace("/%SIZE/", $normal, $array['description']);
    $array['description'] = preg_replace("/%GZIP/", $gzip, $array['description']);
}

?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta charset="utf-8" />
    <title>jQuery Terminal: JavaScript Web Based Terminal Emulator</title>
    <link rel="canonical" href="https://terminal.jcubic.pl"/>
    <meta name="author" content="Jakub T. Jankiewicz - jcubic&#64;jcubic.pl"/>
    <meta name="Description" content="JavaScript library with simple API, that allow to create browser based terminal emulators with custom commands."/>
    <meta property="fb:admins" content="100000949516439" />
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml"/>
    <meta name="keywords"
      content="jquery,terminal,interpreter,console,bash,history,authentication,ajax,server,client"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="alternate" type="application/rss+xml"
      title="Comments RSS" href="https://terminal.jcubic.pl/comments-rss.php"/>
    <link rel="stylesheet" href="css/style.css?<?= md5(file_get_contents('css/style.css')) ?>"/>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans+Mono&display=swap"
          rel="stylesheet" type="text/css" media="print"
          onload="this.media='all'" />
    <link href="css/jquery-ui.min.css" rel="stylesheet"/>
    <link href="css/jquery.terminal.min.css?<?= md5(file_get_contents('css/jquery.terminal.min.css')) ?>" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism-coy.css" rel="stylesheet"/>
    <!--[if IE]>
      <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--
    <script type="text/javascript" data-cfasync="false"
      src="//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js"
      data-shr-siteid="8e13e9e07257a24dcbaacc192697b025" async="async"></script>
    -->
    <meta name="impact-site-verification" value="6d706d4b-4c39-4b29-b4dd-a4c064cc1a14" />
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="jQuery Terminal Emulator Plugin"/>
    <meta property="og:description"
      content="JavaScript library with simple API that allow to create browser based terminal emulators with custom commands."/>
    <meta property="og:url" content="https://terminal.jcubic.pl/"/>
    <meta property="og:site_name" content="jQuery Terminal Emulator Plugin"/>
    <meta property="og:image" content="https://terminal.jcubic.pl/signature.png"/>

    <meta name="twitter:image" content="https://terminal.jcubic.pl/signature.png"/>
    <meta name="twitter:image:alt" content="Main ASCII Art for jQuery Terminal"/>
    <meta name="twitter:title" content="jQuery Terminal Emulator Plugin"/>
    <meta name="twitter:description"
      content="JavaScript library with simple API that allow to create browser based terminal emulators."/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@jcubic"/>
    <meta name="twitter:creator" content="@jcubic"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <header id="main" role="presentation" aria-hidden="true">
      <h1>jQuery Terminal: JavaScript Web Based Terminal Emulator</h1>
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
</pre><img src="signature.png"/><!-- for FB bigger then GitHub ribbon --></a>
<pre class="separator"><?php echo str_repeat("-", 196); ?></pre>
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
        <header id="summary"><h2>Summary</h2></header>
        <p>
          jQuery Terminal is Open Source JavaScript library for creating command line interpreters in your applications.</p>
        <p>
          You can use this JavaScript Terminal library to create <strong>interactive web-based terminal</strong> application
          on your website. Where <strong>commands are defined by you</strong>. You can define them on the server or
          in browser's JavaScript.</p>
        <p>
          It can automatically call <a href="https://en.wikipedia.org/wiki/JSON-RPC">JSON-RPC</a> service,
          when the user types commands. Alternatively, you can provide an object with methods; each method will be
          invoked on the user's command (python command can create python interpreter).
          An object can have nested objects which will create a nested interpreter (you can create interactive menu
          of advanture game with this).
        </p>
        <p>
          <strong>You can</strong> also use a function in which you can <strong>parse user commands
            by yourself</strong> (you have full control of what user type into terminal).</p>
        <p>
          It's ideal if you want to provide <strong>additional functionality for power users</strong>.
          It can also be used as <strong>debugging tool</strong> or you can use it to create
          <a href="https://www.freecodecamp.org/news/how-to-create-interactive-terminal-based-portfolio/">cool looking
            interactive portfolio website</a>, that look like
          <a href="https://codepen.io/jcubic/full/WZvYGj">GNU/Linux, MacOSX or Windows WSL terminal</a>.
        </p>
        <p>
          You can use it to very create fast, debugger for your REST API, before you start writing your Front-End code.
          Or you can add eval on Back-End of your application and debug the app while it's running, this in this
          <a href="https://itnext.io/interactive-r-debugger-repl-for-shiny-apps-87c769be4859">R/shiny shell</a>.
        </p>
        <p>
          Your interactive web based terminal application, will work the same as native terminal emulator,
          but the code for commands is provided by you and it will work in a browser and on mobile.
        </p>
      </article>
      <article>
        <header id="survey"><h2>How you can help?</h2></header>
        <p>I've never charged anything for this project, even did a lot of support for free. I'm still willing
          to help even if I offer paid support. Not everyone can afford paying me money. You can help
          by leaving <a href="/#comments">meaningful comment</a> or by
          <a href="https://github.com/jcubic/jquery.terminal/discussions">starting a discussion</a>,
          even negative feedback is valuable. I will know that people like this web based terminal.
          Visitor statistics don't tell everthing.
        </p>
      </article>
      <article id="thanks">
        <header><h2>Thanks</h2></header>
        <p>I want to thanks a few services that provided free accounts for this Open Source project:</p>
        <ul>
          <li><a href="https://www.browserstack.com/">BrowserStack</a> &mdash; it's a service that provide automated as well as manual testing using real browsers.</li>
          <li><a href="https://coveralls.io/">Coveralls</a> &mdash; service that track code coverage.</li>
        </ul>
        <p>Here are statuses of those services on master branch:</p>
        <ul class="badges">
          <li>
            <span>GH Action:</span>
            <a href="https://github.com/jcubic/jquery.terminal/actions/workflows/build.yaml">
              <img src="https://github.com/jcubic/jquery.terminal/actions/workflows/build.yaml/badge.svg?branch=master&event=push"/>
            </a>
          </li>
          <li>
            <span>Coveralls:</span>
            <a href="https://coveralls.io/github/jcubic/jquery.terminal">
              <img src="https://coveralls.io/repos/github/jcubic/jquery.terminal/badge.svg?branch=master"/>
            </a>
          </li>
        </ul>
        <p>And devel branch:</p>
        <ul class="badges">
          <li>
            <span>GH Action:</span>
            <a href="https://github.com/jcubic/jquery.terminal/actions/workflows/build.yaml">
              <img src="https://github.com/jcubic/jquery.terminal/actions/workflows/build.yaml/badge.svg?branch=devel&event=push"/>
            </a>
          </li>
          <li>
            <span>Coveralls:</span>
            <a href="https://coveralls.io/github/jcubic/jquery.terminal">
              <img src="https://coveralls.io/repos/github/jcubic/jquery.terminal/badge.svg?branch=devel"/>
            </a>
          </li>
        </ul>
      </article>
      <article>
        <header><h2>jQuery Terminal Features</h2></header>
        <ul>
          <li>You can create an interpreter for your JSON-RPC service with <strong>one line of code</strong>.</li>
          <li>Support for <strong>authentication</strong>
              (you can provide a function to be called when the user enters a login and password.
              If you use <strong>JSON-RPC</strong>, it can <strong>automatically call a login function</strong>
              on the server and pass a token to all functions.)</li>
          <li>Stack of interpreters - you can create commands that trigger additional interpreters
              (eg. you can use a couple of JSON-RPC services and run them when user types a command).</li>
          <li>Command Tree - you can use nested objects.
              Each command will invoke a function;
              if the value is an object, it will create a new interpreter
              and use functions from that object as commands.
              You can use as many nested commands as you like.
              If the value is a string, it will create a JSON-RPC service request.</li>
          <li>Tab completion with TAB key.</li>
          <li>Support for command line history (it use Local Storage if possible or cookies).</li>
          <li>Includes <strong>keyboard</strong> shortcuts from <strong>bash</strong>,
              such as CTRL+A, CTRL+D, and CTRL+E.</li>
          <li><strong>Multiple terminals</strong> on one page
              (every terminal can have a different command, its own authentication function,
              and its own command history) - you can switch between them with CTRL+TAB.</li>
          <li>It catches all exceptions and displays error messages in the terminal
              (you can see errors in your JavaScript and PHP code in the terminal
              if they are in an interpreter function).</li>
          <li>Support for basic text formatting (color, background, underline,
              bold, italic) inside the echo function.</li>
          <li>You can create and overwrite existing keyboard shortcuts.</li>
          <li>Formatters that can render emoji or allow the addition of syntax highlighters.</li>
          <li>Support for <a href="https://en.wikipedia.org/wiki/ANSI_escape_code">ANSI escape codes</a> (Linux/unix formatting) with additional file. From version 2.0.0 it should show correctly ANSI artwork (but because of Unicode bugs in Operating Systems they work correctly only on Windows 10 and Linux).</li>
        </ul>
      </article>
      <article>
        <header id="demo"><h2>JavaScript Terminal Demo</h2></header>
        <p>This is a simple demo, using a JavaScript interpreter.
           (If the cursor is not blinking, click on the terminal to activate it.)
          You can type any JavaScript expression, there is debug function <strong><code>dir</code></strong>
          (like in Python).</p>
        <p>You can use jQuery's "$" method to manipulate the page.
           You also have access to this terminal in the "term" variable.
          Try <strong><code>dir(term)</code></strong> or <strong><code>demo()</code></strong> for demo typing animation.</p>
        <p><strong>NOTE</strong>: for unknow reason this demo doesn't work on Mobile, but I assure you that the library do works on mobile. Check <a href="https://terminal.jcubic.pl/js.html">full screen version</a>. The issue with the demo is tracked on <a href="https://github.com/jcubic/jquery.terminal/issues/789">GitHub issue</a>.</p>
        <div id="term_demo"></div>
        <p>JavaScript code:</p>
        <pre class="javascript">// ref: https://stackoverflow.com/q/67322922/387194
var __EVAL = (s) => eval(`void (__EVAL = ${__EVAL}); ${s}`);

jQuery(function($, undefined) {
    $('#term_demo').terminal(function(command) {
        if (command !== '') {
            try {
                var result = __EVAL(command);
                if (result !== undefined) {
                    this.echo(new String(result));
                }
            } catch(e) {
                this.error(new String(e));
            }
        }
    }, {
        greetings: 'JavaScript Interpreter',
        name: 'js_demo',
        height: 200,
        prompt: 'js> '
    });
});</pre>
        <p>You can also try <a href="https://try.javascript.org.pl/">JavaScript REPL Online, with Book about JavaScript</a> and <a href="/404" rel="nofollow">Terminal on 404 Error page</a> (with a lot of features like chat and games).</p>
      </article>
      <article>
        <header id="download"><h2>Download</h2></header>
        <p>Complete source with few examples from <a href="https://github.com/jcubic/jquery.terminal">github</a></p>
        <ul>
          <li><a href="https://github.com/jcubic/jquery.terminal/tarball/master">tar.gz archive</a></li>
          <li><a href="https://github.com/jcubic/jquery.terminal/zipball/master">zip archive</a></li>
        </ul>
        <p>Or just the files:</p>
        <ul>
          <?php foreach (array_values($files) as &$array) { ?>
            <li>
              <a href="<?=$base . $version . "/" . $array['fname'] ?>"
                 download target="_blank"><?= basename($array['fname']) ?></a> &mdash; <?= $array['description'] ?>
            </li>
          <?php } ?>
          <li>
            Starting in version 1.0.0, if you want to support
            browsers (such as old versions of Safari) that don't support the <strong>key</strong> KeyboardEvent property,
            you'll need to include the
            <a href="https://raw.githubusercontent.com/inexorabletash/polyfill/master/keyboard.js">polyfill</a> code.
            You can check browser support on <a href="https://caniuse.com/#feat=keyboardevent-key">can I use</a>.
          </li>
          <li>
            If you want to support wider characters, such as Chinese or Japanese,
            you can include <a href="https://github.com/timoxley/wcwidth">wcwidth</a> library and terminal will use it.
          </li>
        </ul>
      </article>
      <article>
        <header id="installation"><h2>Installation</h2></header>
        <p>You can download files locally or use:</p>
        <p>Bower:</p>
        <pre class="wrapper"><code>bower install jquery.terminal</code></pre>
        <p>NPM:</p>
        <pre class="wrapper"><code>npm install --save jquery.terminal</code></pre>
        <p>Then you can include the scripts in your HTML</p>:
        <pre class="wrapper"><code>&lt;script src="https://cdn.jsdelivr.net/npm/jquery"&gt;&lt;/script&gt;<br/>
&lt;script src="js/jquery.terminal-<?= $version ?>.min.js"&gt;&lt;/script&gt;<br/>
&lt;!-- With modern browsers, jQuery mousewheel is not actually needed; scrolling will still work --&gt;<br/>
&lt;script src="js/jquery.mousewheel-min.js"&gt;&lt;/script&gt;<br/>
&lt;link href="css/jquery.terminal-<?= $version ?>.min.css" rel="stylesheet"/&gt;</code></pre>
        <p>You can also grab the files using a CDN (Content Distribution Network):</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/<?= $version ?>/js/jquery.terminal.min.js"&gt;&lt;/script&gt;<br/>
&lt;link&nbsp;href="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/<?= $version ?>/css/jquery.terminal.min.css" rel="stylesheet"/&gt;</code></pre>
        <p>or</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdn.jsdelivr.net/npm/jquery.terminal/js/jquery.terminal.min.js"&gt;&lt;/script&gt;<br/>
&lt;link&nbsp;href="https://cdn.jsdelivr.net/npm/jquery.terminal/css/jquery.terminal.min.css" rel="stylesheet"/&gt;</code></pre>
        <p>And optional but recomended:</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://unpkg.com/js-polyfills/keyboard.js"&gt;&lt;/script&gt;</code></pre>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdn.jsdelivr.net/gh/jcubic/static/js/wcwidth.js"&gt;&lt;/script&gt;</code></pre>
        <p>If you always want the latest version, you can grab the files from <a href="https://unpkg.com">unpkg</a> without specifying version number</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://unpkg.com/jquery.terminal/js/jquery.terminal.js"&gt;&lt;/script&gt;<br/>
&lt;link&nbsp;href="https://unpkg.com/jquery.terminal/css/jquery.terminal.css" rel="stylesheet"/&gt;</code></pre>
      </article>
      <article>
        <header id="license"><h2>License</h2></header>
        <p>The jQuery Terminal Emulator plugin is released under the
           <a href="https://opensource.org/licenses/MIT">MIT</a> license.</p>
        <p>It contains:</p>
        <ul>
          <li><a href="https://sites.google.com/site/daveschindler/jquery-html5-storage-plugin">Storage plugin</a>
              Distributed under the MIT License, Copyright (c) 2010 Dave Schindler</li>
          <li><a href="http://jquery.offput.ca/every/">jQuery Timers</a>
               released with the <a href="http://sam.zoy.org/wtfpl">WTFPL</a></li>
          <li><a href="http://blog.stevenlevithan.com/archives/cross-browser-split">Cross-Browser Split</a>
              under the MIT License Copyright 2007-2012 <a href="http://stevenlevithan.com">Steven Levithan</a></li>
          <li><a href="https://github.com/accursoft/caret">jQuery Caret</a>
              released with the three-clause BSD License, Copyright (c) 2009, Gideon Sireling</li>
          <li><a href="https://github.com/alexei/sprintf.js">sprintf.js</a>
              released under the three-clause BSD license, Copyright (c) 2007-2013
              <a href="http://alexei.ro/">Alexandru Mărășteanu</a></li>
          <li><a href="https://github.com/netzkolchose/node-ansiparser">node-ansiparser</a> (unix_formatting) released under MIT license, Copyright (c) 2014 Joerg Breitbart</li>
        </ul>
      </article>
      <article>
        <header id="comments"><h2>Comments</h2></header>
        <p>You can use the terminal below to leave a comment. Click to activate.
           If you have a question, you can create an
           <a href="https://github.com/jcubic/jquery.terminal/issues/new">issue on github</a>,
           ask on <a href="http://stackoverflow.com/questions/ask">stackoverflow</a>
          (you can use the "jquery-terminal" tag).
          You can also send email with SO question or jump to
           <a class="chat" href="https://gitter.im/jcubic/jquery.terminal">the chat</a>.</p>
        <p style="color:#1687E9">If you have a feature request, you can also add a
           <a href="https://github.com/jcubic/jquery.terminal/issues/new">GitHub issue</a>.</p>
        <p>If you've found an issue with this website, you can add issue to the
           <a href="https://github.com/jcubic/jquery.terminal-www">jquery.terminal-www repo</a>.</p>
        <p>If you'll ask question in Comments, you can subscribe to <a href="https://terminal.jcubic.pl/comments-rss.php">comments RSS</a> to see reply, when it's added.</p>
        <div id="term_comment"></div>
        <div id="share">
            <ul>
              <li>
                <a class="facebook" href="https://www.facebook.com/share.php?u=https://terminal.jcubic.pl&amp;title=jQuery Terminal Emulator Plugin" target="blank">
                  <i class="fa fa-facebook-f"></i>
                </a>
              </li>
              <li>
                <a class="twitter" href="https://twitter.com/intent/tweet?text=Create+your+own+Command+Line+%23app+in+%23JavaScript+using+%23JQuery+plugin+%23CLI+-+https://terminal.jcubic.pl/+via+@jcubic" target="blank">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li>
                <a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://terminal.jcubic.pl&amp;title=jQuery+Terminal+Emulator" target="blank">
                  <i class="fa fa-linkedin"></i>
                </a>
              </li>
              <li>
                <a class="pinterest" href="https://pl.pinterest.com/pin/create/bookmarklet/?media=https%3A%2F%2Fterminal.jcubic.pl%2fsignature.png&amp;url=https%3A%2F%2Fterminal.jcubic.pl&amp;is_video=false&amp;description=jQuery%20Terminal%20Emulator%20Plugin" target="blank">
                  <i class="fa fa-pinterest"></i>
                </a>
              </li>
            </ul>
            <!--
            <div id="wrapper">
              <div class="shareaholic-canvas" data-app="share_buttons" data-app-id="26217557"></div>
            </div>
             -->
          </div>
          <p id="comment_count"></p>
          <ul id="pagination"></ul>
          <div id="user_comments" style="clear:both"></div>
      </article>
    </section>
    <footer>
      <p id="copy">Copyright (c) 2010-<?php  echo date('Y'); ?>
        <a href="https://jakub.jankiewicz.org/">Jakub T. Jankiewicz</a>
        Website: <a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>
        <span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span>
        <span>source on <a href="https://github.com/jcubic/jquery.terminal-www">github</a></p>
    </footer>
    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/browser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-polyfills/keyboard.js"></script>
    <script src="js/jquery.mousewheel-min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/jcubic/static/js/wcwidth.js"></script>
    <script src="js/jquery.terminal.min.js?<?= md5(file_get_contents('js/jquery.terminal.min.js')) ?>"></script>
    <script src="js/code.js"></script>
    <script src="js/dterm.js"></script>
    <script src="js/jquery.twbsPagination.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.terminal/js/prism.js"></script>
    <script>if (window.module) module = window.module;</script>
    <script>
     //$.terminal.prism_formatters.prompt = true;
     function indent(string) {
         var prompt = term.get_prompt();
         if (typeof prompt !== 'string') {
             return string;
         }
         var lines = string.split('\n');
         var first = lines.shift();
         var ident = Array.from({length: prompt.length}).fill(' ').join('');
         return first + '\n' + lines.map(function(line) {
             return ident + line;
         }).join('\n');
     }
     function demo() {
         term.exec([
             '2 + 2',
indent(`function factorial(n) {
    return Array.from({length: n}, (_, i) => {
        return BigInt(i + 1);
    }).reduce((acc, i) => acc * i, 1n);
}`),
             'factorial(1000)',
             indent(`$(".terminal").css({
    "--color": "black",
    "--background": "white",
    "--animation": "terminal-bar"
})`),
             'term.signature()',
             '$(".terminal").css({"--color": "", "--background": ""})',
             '$(".terminal").css("--animation", "")'
         ], {typing: true, delay: 50});
     }
     // ref: https://stackoverflow.com/q/67322922/387194
     var __EVAL = (s) => eval(`void (__EVAL = ${__EVAL}); ${s}`);
     jQuery(function($, undefined) {
         // something is making blur on terminal on click
         $(document).on('click', '.terminal', function(e) {
             e.stopPropagation();
         });
         $.fn.onRender = function(callback, options) {
             if (arguments[0] == 'cancel') {
                 return this.each(function() {
                     var self = $(this);
                     var render = self.data('render');
                     if (render) {
                         render.observer.disconnect();
                         self.removeData('render');
                     }
                 });
             } else {
                 var settings = $.extend({
                     node: 'body',
                     oneTime: true,
                     observer: {childList: true, subtree: true}
                 }, options);
                 return this.each(function() {
                     var node = $(this);
                     var render = node.data('render');
                     if (!render) {
                         render = {
                             callbacks: $.Callbacks(),
                             observer: new MutationObserver(function(mutations) {
                                 if ($(settings.node).length) {
                                     render.callbacks.fire(node[0]);
                                     node.onRender('cancel');
                                 }
                             })
                         };
                         render.observer.observe(node[0], settings.observer);
                         node.data('render', render);
                     }
                     render.callbacks.add(callback);
                 });
             }
         };
         $('body').onRender(function() {
             $('#shr-admin-badge').remove();
         }, {node: '#shr-admin-badge'});
         $('a[rel=email]').each(function() {
             var self = $(this);
             self.attr('href', 'mailto:' + self.text().replace('&#64;', '@'));
         });
         $('.donate').mouseover(function() {
             $(this).stop().animate({'margin-right': -30}, 300);
         }).mouseout(function() {
             $(this).stop().animate({'margin-right': -256});
         });
         // global to access from js terminal
         function js_formatter(string, options) {
             return $.terminal.prism("javascript", string, options);
         }
         // hack that should be fixed by https://github.com/jcubic/jquery.terminal/issues/552
         // it work because terminal is never resized. It will break (highlight comments
         // if you type into both terminals, click js terminal and make window very narrow,
         // then it will apply javascript formatting to comments), but it work most of the time.
         function onFocus() {
             var defaults = $.terminal.defaults;
             if (this.settings().name === 'js_demo') {
                 if (defaults.formatters.indexOf(js_formatter) === -1) {
                     defaults.formatters.unshift(js_formatter);
                 }
             } else {
                 var pos = defaults.formatters.indexOf(js_formatter);
                 if (pos !== -1) {
                     defaults.formatters.splice(pos, 1);
                 }
             }
         }
         term = $('#term_demo').terminal(function(command, term) {
             if (command !== '') {
                 try {
                     var result = __EVAL(command);
                     if (result !== undefined) {
                         if (result instanceof $.fn.init) {
                             this.echo('#<jQuery>', {formatters: false});
                         } else {
                             this.echo(new String(result), {formatters: false});
                         }
                     }
                 } catch(e) {
                     term.error(new String(e));
                 }
             }
         }, {
             greetings: 'JavaScript Interpreter (term v. ' + $.terminal.version + ')',
             name: 'js_demo',
             onFocus: onFocus,
             height: 300,
             enabled: false,
             prompt: 'js> '
         });
         // ----------------------------------------------------------------
         // COMMENTS
         function now() {
             var d = new Date();
             return d.getDate() + '-' + (d.getMonth()+1) + '-' + d.getFullYear();
         }
         var default_avatar_url = 'https://terminal.jcubic.pl/default-avatar.png';
         var default_avatar = encodeURIComponent(default_avatar_url);
         function add_comment(date, user_name, hash, www, comment) {
             user_name = user_name || 'Anonymous';
             var name;
             if (www && www.match(/^https?:\/\/.*\..*/)) {
                 name =  '<a href="' +www + '" target="_blank" title="'+user_name+'" ' +
                         'rel="noopener noreferrer nofollow">' + user_name + '</a>';
             } else {
                 name = user_name;
             }
             if (comment == '') {
                 comment = '&nbsp;';
             }
             var img;
             if (hash) {
                 img = 'https://www.gravatar.com/avatar/' + hash + '?s=48&d=' +
                       default_avatar;
             } else {
                 img = default_avatar_url;
             }
             if ($.terminal.have_formatting(comment)) {
                 comment = $.terminal.format(comment);
             } else {
                 comment = comment.split(/(```[\s\S]+```)/).filter(Boolean).map(function(string) {
                     var m = string.match(/```(.*)\n([\s\S]*)```/);
                     if (m) {
                         return '<pre class="' + m[1] + '">' + m[2] + '</pre>';
                     } else {
                     return '<p>' + string.replace(/\n/g, '<br/>') + '</p>';
                     }
                 }).join('');
             }
             var $div = $('<div class="comment"><img data-image="' + img +
                          '"/><ul><li title="' + user_name + '">' + name + '</li><li>' +
                          date + '</li>' +'</ul><div>' + comment + '</div></div>');
             $div.prependTo($comments).hide();
             $div.find('pre').each(function() {
                 var pre = $(this);
                 var lang = pre.attr('class');
                 if (lang) {
                     pre.snippet(lang, {
                         showNum: false,
                         style: ''
                     });
                 }
             });
         }
         var process = 1;
         var prompts = ['name', 'email', 'www', 'comment'];
         var comment = [];
         var $comments = $('#user_comments');
         var $comment_count = $('#comment_count');
         var count = 1;
         $('#term_comment').terminal(function(command, term) {
             var idx = count++ % 4;
             if (idx < 3) {
                 if (prompts[idx] == 'email') {
                     term.echo('[[;#C6AD00;]&#91;!&#93; email is only for avatars see ]' +
                               '[[!;;;;https://github.com/jcubic/jquery.terminal-www/blob/master/service.php#L133]' +
                               'service.php#L133]');
                 }
                 comment.push(command); //push the same function with diffrent prompt
                 term.push(arguments.callee, {prompt: prompts[idx] + ': '});
             } else {
                 var comment_string = '';
                 term.echo("[[;#0a0;;]enter your comment and put single period '.' at the end.]");
                 comment.push(command);
                 term.push(function(command, term) {
                     if (command == '.') {
                         comment.push($.trim(comment_string));
                         count++;
                         term.pop().pop().pop();
                         term.pause();
                         $.jrpc("service.php", 'add_comment', comment, function(data) {
                             term.resume().clear();
                             if (data && typeof data.result === 'string') {
                                 comment[1] = data.result;
                                 add_comment.apply(null, [now()].concat(comment));
                                 term.echo("Thank you for your comment. It's pending admin moderation.");
                                 pagination(true);
                             } else if (data.error) {
                                 term.error("[RPC] " + data.error.message);
                             } else {
                                 term.echo("Sorry but something wicked happen on the server");
                             }
                             comment = [];
                         }, function(xhr, status, error) {
                             term.resume();
                             term.error('[AJAX] Response: ' +
                                        status + '\n' +
                                        xhr.responseText);
                             comment = [];
                         });
                     } else {
                         term.set_prompt('...');
                         comment_string += command + '\n';
                     }
                 }, {prompt: '...'}); // last interpreter
             }
         }, {
             greetings: false,
             onFocus: onFocus,
             history: false,
             prompt: prompts[0] + ': ',
             enabled: false
         });
         // fetch comments
         $('#user_comments').addClass('load');

         // ------------------------------------------------------------
         $('pre.javascript').syntax('javascript');

         $(document).on('click', 'nav li a', function() {
             var href = $(this).attr('href');
             if (href[0] == '#') {
                 $('html,body').animate({
                     scrollTop: $(href).offset().top - 50
                 }, 500);
             }
         });

         function pagination(destroy) {
             var $pagination = $('#pagination');
             var $children = $comments.children();
             var perPage = 10;
             var length = $children.length;

             if (destroy) {
                 $pagination.twbsPagination('destroy');
             }

             $pagination.twbsPagination({
                 totalPages:  Math.ceil(length / perPage),
                 visiblePages: 5,
                 prevText: '<',
                 cssStyle: '',
                 nextText: '>',
                 onPageClick: function(event, page) {
                     var start = (page-1) * perPage;
                     var end = page * perPage;
                     $children.hide().slice(start, end).show();
                     show_images();
                 }
             });
             show_images();
         }

         function show_images() {
             $('.comment img:visible').each(function() {
                 var img = $(this);
                 img.attr('src', img.data('image'));
             });
         }

         function abbr_number(number) {
             return Intl.NumberFormat('en-US', {
                 notation: "compact",
                 maximumFractionDigits: 1
             }).format(number);
         }

         function render_count(len) {
             $comment_count.html('Number of comments: <abbr title="' +
                                 len + '">' + abbr_number(len) + '</abbr>');
         }

         $.jrpc("service.php", 'get_comments', [], function(data) {
             if (data.error) {
                 $('#user_comments').append('<p>Error Loading Comments: ' +
                                            data.error.message +
                                            '</p>');
             } else {
                 $comments.css('visibility', 'hidden');
                 render_count(data.result.length);
                 $.each(data.result, function(i, asoc) {
                     var comments = Object.keys(asoc).map(function(key) {
                         return asoc[key];
                     });
                     add_comment.apply(null, comments);
                 });
                 $comments.css('visibility', '').removeClass('load');
                 pagination();
             }
         }, function(xhr, status, error) {
             $('#user_comments').removeClass('load').
                                 append('<p>Error Loading Comments</p>');
         });


     });
    </script>
    <script defer src="https://api.feedbhack.com/assets/app.js" website-id="670311f2ee359a44f772ffcf"></script>
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
    <? endif; ?>
  </body>
</html>
