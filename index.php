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
        "description" => "formatter to be used with PrismJS that hightlight different progamming languages - [%SIZE]",
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
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <title>jQuery Terminal Emulator Plugin</title>
    <link rel="canonical" href="https://terminal.jcubic.pl"/>
    <meta name="author" content="Jakub T. Jankiewicz - jcubic&#64;jcubic.pl"/>
    <meta name="Description"
      content="jQuery plugin for Web based terminal.
               Automatic JSON-RPC, custom object or a function.
               History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta property="fb:admins" content="100000949516439" />
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml"/>
    <meta name="keywords"
      content="jquery,terminal,interpreter,console,bash,history,authentication,ajax,server,client"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="alternate" type="application/rss+xml"
      title="Comments RSS" href="https://terminal.jcubic.pl/comments-rss.php"/>
    <link rel="stylesheet" href="css/style.css?<?= md5(file_get_contents('css/style.css')) ?>"/>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet" type="text/css"/>
    <link href="css/jquery-ui-1.8.7.custom.css" rel="stylesheet"/>
    <link href="css/jquery.terminal.min.css?<?= md5(file_get_contents('css/jquery.terminal.min.css')) ?>"
      rel="stylesheet"/>
    <!--[if IE]>
      <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--
    <script type="text/javascript" data-cfasync="false"
      src="//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js"
      data-shr-siteid="8e13e9e07257a24dcbaacc192697b025" async="async"></script>
    -->
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="jQuery Terminal Emulator Plugin"/>
    <meta property="og:description"
      content="jQuery plugin for Command Line applications.
               Automatic JSON-RPC, custom object or a function.
               History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta property="og:url" content="https://terminal.jubic.pl/"/>
    <meta property="og:site_name" content="jQuery Terminal Emulator Plugin"/>
    <meta property="og:image" content="https://terminal.jcubic.pl/signature.png"/>

    <meta name="twitter:image" content="https://terminal.jcubic.pl/signature.png"/>
    <meta name="twitter:image:alt" content="Main ASCII Art for jQuery Terminal"/>
    <meta name="twitter:title" content="jQuery Terminal Emulator Plugin"/>
    <meta name="twitter:description"
      content="jQuery plugin for web based Terminal.
               Automatic JSON-RPC, custom object or a function.
               History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@jcubic"/>
    <meta name="twitter:creator" content="@jcubic"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <header id="main" role="presentation" aria-hidden="true">
      <h1>jQuery Terminal Emulator Plugin (Web based terminal)</h1>
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
        <li><a href="#demo">Demo</a></li>
        <li><a href="https://github.com/jcubic/jquery.terminal/wiki/Getting-Started">Getting Started</a></li>
        <li><a href="api_reference.php">API Reference</a></li>
        <li><a href="examples.php">Examples</a></li>
        <li><a href="#download">Download</a></li>
        <li><a href="#comments">Comments</a></li>
        <li><a class="chat" href="#chat">Chat</a></li>
      </ul>
    </nav>
    <a class="github-ribbon" href="https://github.com/jcubic/jquery.terminal"
       style="position: fixed; top: 0; left: 0; z-index:1000">
      <img style="border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png"
           alt="Fork jQuery Terminal Emulator on GitHub"></a>
    <section>
      <article>
        <header id="summary"><h2>Summary</h2></header>
        <p>
          jQuery Terminal Emulator is a plugin for creating command line interpreters in your applications.
          It can automatically call an JSON-RPC service when the user types commands.
          Alternatively, you can provide an object with methods; each method will be invoked on the user's command.
          An object can have nested objects which will create a nested interpreter.
          You can also use a function in which you can parse user commands on your own.
          It's ideal if you want to provide <strong>additional functionality for power users</strong>.
          It can also be used as debugging tool.</p>
        <p>You can use this library to have web based terminal on any website with little
          bit of JavaScript.</p>
      </article>
      <article id="thanks">
        <header><h2>Thanks</h2></header>
        <p>I want to thanks few services that provided free accounts for this Open Source project:</p>
        <ul>
          <li><a href="https://travis-ci.org/">Travis CI</a> &mdash; Continues Integration service that allow to run tests on each commit and pull request.</li>
          <li><a href="https://www.browserstack.com/">BrowserStack</a> &mdash; it's a service that provide automated as well as manual testing using real browsers.</li>
          <li><a href="https://coveralls.io/">Coveralls</a> &mdash; service that track code coverage.</li>
          <li><a href="https://www.keycdn.com">KeyCDN</a> &mdash; it's Content Delivery Network service that provided hosting for <a href="https://cdn.terminal.jcubic.pl/wcwidth.js">wcwidth library</a> that is needed for wider characters support (like Chinese or Japanese)</li>
        </ul>
        <p>Here are status of those services on master branch:</p>
        <ul class="badges">
          <li>
            <span>Travis:</span>
            <a href="https://travis-ci.org/jcubic/jquery.terminal">
              <img src="https://travis-ci.org/jcubic/jquery.terminal.svg?branch=master"/>
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
            <span>Travis:</span>
            <a href="https://travis-ci.org/jcubic/jquery.terminal">
              <img src="https://travis-ci.org/jcubic/jquery.terminal.svg?branch=devel"/>
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
      <article role="presentation" aria-hidden="true">
        <header id="ads"><h2>Advertisement</h2></header>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- black wide -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:728px;height:90px"
             data-ad-client="ca-pub-6153701670678834"
             data-ad-slot="5835458303"></ins>
        <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </article>
      <article>
        <header><h2>Features</h2></header>
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
              if the value is an object, it will create  new interpreter
              and use functions from that object as commands.
              You can use as many nested commands as you like.
              If the value is a string, it will create a JSON-RPC service request.</li>
          <li>Tab completion with TAB key.</li>
          <li>Support for command line history (it use Local Storage if possible or cookies).</li>
          <li>Includes <strong>keyboard</strong> shortcuts from <strong>bash</strong>,
              such as CTRL+A, CTRL+D, and CTRL+E.</li>
          <li><strong>Multiple terminals</strong> on one page
              (every terminal can have adifferent command, its own authentication function,
              and its own command history) - you can swich between them with CTRL+TAB.</li>
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
        <header id="demo"><h2>Demo</h2></header>
        <p>This is a simple demo, using a JavaScript interpreter.
           (If the cursor is not blinking, click on the terminal to activate it.)
          You can type any JavaScript expression, there is debug function <strong><code>dir</code></strong>
          (like in Python).</p>
        <p>You can use jQuery's "$" method to manipulate the page.
           You also have access to this terminal in the "term" variable.
          Try <strong><code>dir(term)</code></strong> or <strong><code>term.signature()</code></strong>.</p>
        <div id="term_demo"></div>
        <p>JavaScript code:</p>
        <pre class="javascript">jQuery(function($, undefined) {
    $('#term_demo').terminal(function(command) {
        if (command !== '') {
            try {
                var result = window.eval(command);
                if (result !== undefined) {
                    this.echo(new String(result));
                }
            } catch(e) {
                this.error(new String(e));
            }
        } else {
           this.echo('');
        }
    }, {
        greetings: 'JavaScript Interpreter',
        name: 'js_demo',
        height: 200,
        prompt: 'js> '
    });
});</pre>
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
        <pre class="wrapper"><code>&lt;script src="https://code.jquery.com/jquery-latest.js"&gt;&lt;/script&gt;<br/>
&lt;script src="js/jquery.terminal-<?= $version ?>.min.js"&gt;&lt;/script&gt;<br/>
&lt;-- With modern browsers, jQuery mousewheel is not actually needed; scrolling will still work --&gt;<br/>
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
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdn.terminal.jcubic.pl/wcwidth.js"&gt;&lt;/script&gt;</code></pre>
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
               licensed with the <a href="http://sam.zoy.org/wtfpl">WTFPL</a></li>
          <li><a href="http://blog.stevenlevithan.com/archives/cross-browser-split">Cross-Browser Split</a>
              under the MIT License Copyright 2007-2012 <a href="http://stevenlevithan.com">Steven Levithan</a></li>
          <li><a href="https://github.com/accursoft/caret">jQuery Caret</a>
              licensed with the three-clause BSD License, Copyright (c) 2009, Gideon Sireling</li>
          <li><a href="https://github.com/alexei/sprintf.js">sprintf.js</a>
              licensed under the three-clause BSD license, Copyright (c) 2007-2013
              <a href="http://alexei.ro/">Alexandru Mărășteanu</a></li>
        </ul>
      </article>
      <article>
        <header id="ads2" role="presentation" aria-hidden="true"><h2>Advertisement</h2></header>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- black wide -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:728px;height:90px"
             data-ad-client="ca-pub-6153701670678834"
             data-ad-slot="5835458303"></ins>
        <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </article>
      <article>
        <header id="comments"><h2>Comments</h2></header>
        <p>You can use the terminal below to leave a comment. Click to activate.
           If you have a question, you can create an
           <a href="https://github.com/jcubic/jquery.terminal/issues/new">issue on github</a>,
           ask on <a href="http://stackoverflow.com/questions/ask">stackoverflow</a>
          (you can use the "jquery-terminal" tag).
          You can also send email with SO question or jump to <a class="chat" href="#chat">the chat</a>.</p>
        <p style="color:#1687E9">If you have a feature request, you can also add a
           <a href="https://github.com/jcubic/jquery.terminal/issues/new">GitHub issue</a>.</p>
        <p>If you've found an issue with this website, you can add issue to the
           <a href="https://github.com/jcubic/jquery.terminal-www">jquery.terminal-www repo</a>.</p>
        <div id="term_comment"></div>
        <div id="share">
            <ul>
              <li>
                <a class="facebook" href="https://www.facebook.com/share.php?u=https://terminal.jcubic.pl&amp;title=jQuery Terminal Emulator Plugin" target="blank">
                  <i class="fa fa-facebook-f"></i>
                </a>
              </li>
              <li>
                <a class="twitter" href="https://twitter.com/intent/tweet?status=Create+your+own+Command+Line+%23app+in+%23JavaScript+using+%23JQuery+plugin+%23CLI+-+https://terminal.jcubic.pl/+via+@jcubic" target="blank">
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
        <ul id="pagination"></ul>
        <div id="user_comments" style="clear:both"></div>
      </article>
    </section>
    <footer>
      <p id="copy">Copyright (c) 2010-<?php  echo date('Y'); ?>
        <a href="https://jcubic.pl/jakub-jankiewicz">Jakub T. Jankiewicz</a>
        Website: <a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>
        <span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span>
        <span>source on <a href="https://github.com/jcubic/jquery.terminal-www">github</a></p>
    </footer>
    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://unpkg.com/js-polyfills/keyboard.js"></script>
    <script src="js/jquery.mousewheel-min.js"></script>
    <script src="js/jquery.terminal.min.js?<?= md5(file_get_contents('js/jquery.terminal.min.js')) ?>"></script>
    <script src="js/code.js"></script>
    <script src="js/dterm.js"></script>
    <script src="js/jquery.twbsPagination.min.js"></script>
    <script src="js/jquery-ui-1.8.7.custom.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>
    <script src="https://unpkg.com/randomcolor/randomColor.js"></script>
    <script src="js/chat.js?<?= md5(file_get_contents('js/chat.js')) ?>"></script>
    <script src="js/sysend.js?<?= md5(file_get_contents('js/sysend.js')) ?>"></script>
    <script src="js/favico.min.js"></script>
    <script>if (window.module) module = window.module;</script>
    <script>

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
         term = $('#term_demo').terminal(function(command, term) {
             if (command !== '') {
                 try {
                     var result = window.eval(command);
                     if (result !== undefined) {
                         term.echo(new String(result));
                     }
                 } catch(e) {
                     term.error(new String(e));
                 }
             } else {
                 term.echo('');
             }
         }, {
             greetings: 'JavaScript Interpreter (term v. ' + $.terminal.version + ')',
             name: 'js_demo',
             height: 200,
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
                                 term.echo("Thanks you for your comment");
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
             height: 100,
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

         $.jrpc("service.php", 'get_comments', [], function(data) {
             if (data.error) {
                 $('#user_comments').append('<p>Error Loading Comments: ' +
                                            data.error.message +
                                            '</p>');
             } else {
                 $.each(data.result, function(i, asoc) {
                     var comments = Object.keys(asoc).map(function(key) {
                         return asoc[key];
                     });
                     add_comment.apply(null, comments);
                 });
                 $comments.removeClass('load');
                 pagination();
             }
         }, function(xhr, status, error) {
             $('#user_comments').removeClass('load').
                                 append('<p>Error Loading Comments</p>');
         });


     });
    </script>
    <? if ($_SERVER["HTTP_HOST"] != "localhost" && !isset($_GET['track'])): ?>
    <!-- Matomo -->
    <script type="text/javascript">
      var _paq = window._paq || [];
      /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//piwik.jcubic.pl/";
        _paq.push(['setTrackerUrl', u+'matomo.php']);
        _paq.push(['setSiteId', '3']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <!-- End Matomo Code -->
    <noscript>
    <!-- Matomo Image Tracker-->
    <img src="https://piwik.jcubic.pl/matomo.php?idsite=3&amp;rec=1" style="border:0" alt="" />
    <!-- End Matomo -->
    </noscript>
    <? endif; ?>
  </body>
</html>
