<?php
header("X-Powered-By: ");
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <title>jQuery Terminal Emulator Plugin</title>
    <link rel="canonical" href="https://terminal.jcubic.pl"/>
    <meta name="author" content="Jakub Jankiewicz - jcubic&#64;jcubic.pl"/>
    <meta name="Description"
      content="jQuery plugin for Command Line applications.
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
      content="jQuery plugin for Command Line applications.
               Automatic JSON-RPC, custom object or a function.
               History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@jcubic"/>
    <meta name="twitter:creator" content="@jcubic"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <header id="main" role="presentation" aria-hidden="true">
      <h1>jQuery Terminal Emulator Plugin</h1>
    <a href="/"><pre id="sig">
<div class="big">
      __ _____                     ________                              __
     / // _  /__ __ _____ ___ __ _/__  ___/__ ___ ______ __ __  __ ___  / /
 __ / // // // // // _  // _// // / / // _  // _//     // //  \/ // _ \/ /
/  / // // // // // ___// / / // / / // ___// / / / / // // /\  // // / /__
\___//____ \\___//____//_/ _\_  / /_//____//_/ /_/ /_//_//_/ /_/ \__\_\___/
          \/              /____/                                     1.14.0
</div>
<div class="medium">
      __ ____ ________                              __
     / // _  /__  ___/__ ___ ______ __ __  __ ___  / /
 __ / // // /  / // _  // _//     // //  \/ // _ \/ /
/  / // // /  / // ___// / / / / // // /\  // // / /__
\___//____ \ /_//____//_/ /_/ /_//_//_/ /_/ \__\_\___/
          \/                                  1.14.0
</div>
<div class="small">
      __ ____ ________
     / // _  /__  ___/__ ___ ______
 __ / // // /  / // _  // _//     /
/  / // // /  / // ___// / / / / /
\___//____ \ /_//____//_/ /_/ /_/
          \/              1.14.0

</div>
</pre><img src="signature.png"/><!-- for FB bigger then GitHub ribbon --></a>
<pre class="separator"><?php echo str_repeat("-", 196); ?></pre>
    </header>
    <nav>
      <ul>
        <li><a href="#demo">Demo</a></li>
        <li><a href="api_reference.php">API Reference</a></li>
        <li><a href="examples.php">Examples</a></li>
        <li><a href="https://stackoverflow.com/questions/tagged/jquery-terminal">Q&amp;A</a></li>
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
It can also be used as debugging tool.
        </p>
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
          <li>Support for basic text formatting (color, background, underline, bold, italic)
              inside the echo function.</li>
          <li>You can create and overwrite existing keyboard shortcuts.</li>
          <li>Formatters that render emoji or allow the addition of syntax highlighters.</li>
        </ul>
      </article>
      <article>
        <header id="demo"><h2>Demo</h2></header>
        <p>This is a simple demo, using a JavaScript interpreter.
           (If the cursor is not blinking, click on the terminal to activate it.)
           You can type any JavaScript expression, there are two debug function dir (like in Python).</p>
        <p>You can use jQuery's "$" method to manipulate the page.
           You also have access to this terminal in the "term" variable.
           Try "dir(term)" or "term.signature()".</p>
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
        <p>Complete source with examples from <a href="https://github.com/jcubic/jquery.terminal">github</a></p>
        <ul>
          <li><a href="https://github.com/jcubic/jquery.terminal/tarball/master">tar.gz archive</a></li>
          <li><a href="https://github.com/jcubic/jquery.terminal/zipball/master">zip archive</a></li>
        </ul>
        <p>Or just the files:</p>
        <ul>
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/1.14.0/js/jquery.terminal-1.11.4.js"
                 download target="_blank">jquery.terminal-1.14.0.js</a> - unminified version [320KB] [Gzip: 60KB]</li>
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/1.14.0/js/jquery.terminal-1.11.4.min.js"
                 download target="_blank">jquery.terminal-1.14.0.min.js</a> - minified version [92KB] [Gzip: 32KB]</li>
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/1.14.0/js/unix_formatting.js"
                 download target="_blank">unix_formatting.js</a> - ANSI escape codes and overtyping [16KB] [Gzip: 4,0KB]</li>
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/1.14.0/css/jquery.terminal-1.11.4.css"
                 download target="_blank">jquery.terminal-1.14.0.css</a> - stylesheet [20KB] [Gzip: 4,0KB]</li>
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/11.14.0/css/jquery.terminal-1.11.4.min.css"
                 download target="_blank">jquery.terminal-1.14.0.min.css</a> - minified stylesheet [12KB] [Gzip: 4,0KB]</li>
          <li><a href="https://github.com/brandonaaron/jquery-mousewheel">jquery-mousewheel</a> -
                 you may also want the mousewheel plugin if you need to support some old browsers</li>
          <li>Starting in version 1.0.0, if you want to support
              <a href="http://caniuse.com/#feat=keyboardevent-key">browsers (such as old versions of Safari)
                 that don't support the KeyboardEvent property</a>, you'll need to include the
              <a href="https://cdn.rawgit.com/inexorabletash/polyfill/master/keyboard.js">polyfill</a> code.
              You can check browser support on <a href="https://caniuse.com/#feat=keyboardevent-key">can I use</a>.</li>
          <li>If you want to support wider characters, such as Chinese or Japanese,
              you can use <a href="https://github.com/timoxley/wcwidth">wcwidth</a>.</li>
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
&lt;script src="js/jquery.terminal-1.14.0.min.js"&gt;&lt;/script&gt;<br/>
&lt;-- With modern browsers, jQuery mousewheel is not actually needed; scrolling will still work --&gt;<br/>
&lt;script src="js/jquery.mousewheel-min.js"&gt;&lt;/script&gt;<br/>
&lt;link href="css/jquery.terminal-1.14.0.min.css" rel="stylesheet"/&gt;</code></pre>
        <p>You can also grab the files using a CDN (Content Distribution Network):</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/1.14.0/js/jquery.terminal.min.js"&gt;&lt;/script&gt;<br/>
&lt;link&nbsp;href="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/1.14.0/css/jquery.terminal.min.css" rel="stylesheet"/&gt;</code></pre>
        <p>or</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdn.jsdelivr.net/npm/jquery.terminal/js/jquery.terminal.min.js"&gt;&lt;/script&gt;<br/>
&lt;link&nbsp;href="https://cdn.jsdelivr.net/npm/jquery.terminal/css/jquery.terminal.min.css" rel="stylesheet"/&gt;</code></pre>
        <p>And if you want:</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdn.rawgit.com/inexorabletash/polyfill/master/keyboard.js"&gt;&lt;/script&gt;</code></pre>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdn.rawgit.com/jcubic/leash/master/lib/wcwidth.js"&gt;&lt;/script&gt;</code></pre>
        <p>If you always want the latest version, you can grab the files from GitHub using rawgit.com</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdn.rawgit.com/jcubic/jquery.terminal/master/js/jquery.terminal.min.js"&gt;&lt;/script&gt;<br/>
&lt;link&nbsp;href="https://cdn.rawgit.com/jcubic/jquery.terminal/master/css/jquery.terminal.min.css" rel="stylesheet"/&gt;</code></pre>
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
                <a class="googleplus" href="https://plus.google.com/share?url=https://terminal.jcubic.pl/" target="blank">
                  <i class="fa fa-google"></i>       </a>
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
        <a href="https://jcubic.pl/jakub-jankiewicz">Jakub Jankiewicz</a>
        Website: <a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>
        <span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span>
        <span>source on <a href="https://github.com/jcubic/jquery.terminal-www">github</a></p>
    </footer>
    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://rawgit.com/cvan/keyboardevent-key-polyfill/master/index.js"></script>
    <script src="js/jquery.mousewheel-min.js"></script>
    <script src="js/jquery.terminal.min.js?<?= md5(file_get_contents('js/jquery.terminal.min.js')) ?>"></script>
    <script src="js/code.js"></script>
    <script src="js/dterm.js"></script>
    <script src="js/jquery.twbsPagination.min.js"></script>
    <script src="js/jquery-ui-1.8.7.custom.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>
    <script src="https://rawgit.com/davidmerfield/randomColor/master/randomColor.js"></script>
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
         keyboardeventKeyPolyfill.polyfill();
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
         var default_avatar = encodeURIComponent(
             'https://terminal.jcubic.pl/default-avatar.png'
         );
         function add_comment(date, user_name, hash, www, comment) {
             user_name = user_name || 'Anonymous';
             var name;
             if (www && www.match(/^https?:\/\/.*\..*/)) {
                 name =  '<a href="' +www + '" target="_blank" title="'+user_name+'">' + user_name + '</a>';
             } else {
                 name = user_name;
             }
             if (comment == '') {
                 comment = '&nbsp;';
             }
             var img = 'https://www.gravatar.com/avatar/' + hash + '?s=48&d=' +
                       default_avatar;
             comment = comment.split(/(```[\s\S]+```)/).filter(Boolean).map(function(string) {
                 var m = string.match(/```(.*)\n([\s\S]*)```/);
                 if (m) {
                     return '<pre class="' + m[1] + '">' + m[2] + '</pre>';
                 } else {
                     return '<p>' + string.replace(/\n/g, '<br/>') + '</p>';
                 }
             }).join('');
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
                     term.echo('[[;#C6AD00;]&#91;!&#93; email is only for avatar,' +
                               ' I may also send email if you ask question]');
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
                             if (data && data.result) {
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

         $.jrpc("https://terminal.jcubic.pl/service.php", 'get_comments', [], function(data) {
             if (data.error) {
                 $('#user_comments').append('<p>Error Loading Comments: ' +
                                            data.error.message +
                                            '</p>');
             } else {
                 $.each(data.result, function(i, comment) {
                     add_comment.apply(null, comment);
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
    <!-- Piwik -->
    <script type="text/javascript">
     if (location.host == 'terminal.jcubic.pl') {
         var _paq = _paq || [];
         _paq.push(['trackPageView']);
         _paq.push(['enableLinkTracking']);
         (function() {
             var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.jcubic.pl/";
             _paq.push(['setTrackerUrl', u+'piwik.php']);
             _paq.push(['setSiteId', 1]);
             var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
             g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
         })();
     }
    </script>
    <noscript><p><img src="https://piwik.jcubic.pl/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
    <!-- End Piwik Code -->
    <? endif; ?>
  </body>
</html>
