<?php
header("X-Powered-By: ");
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <title>JQuery Terminal Emulator Plugin</title>
    <link rel="canonical" href="http://terminal.jcubic.pl"/>
    <meta name="author" content="Jakub Jankiewicz - jcubic&#64;jcubic.pl"/>
    <meta name="Description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta property="fb:admins" content="100000949516439" />
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml"/>
    <meta name="keywords" content="jquery,terminal,interpreter,console,bash,history,authentication,ajax,server,client"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="alternate" type="application/rss+xml" title="Comments RSS" href="http://terminal.jcubic.pl/comments-rss.php"/>
    <link rel="stylesheet" href="css/style.css?<?= md5(file_get_contents('css/style.php')) ?>"/>
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet" type="text/css"/>
    <link href="css/jquery-ui-1.8.7.custom.css" rel="stylesheet"/>
    <link href="css/jquery.terminal.min.css?<?= md5(file_get_contents('css/jquery.terminal.min.css')) ?>" rel="stylesheet"/>
    <!--[if IE]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" data-cfasync="false" src="//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js" data-shr-siteid="8e13e9e07257a24dcbaacc192697b025" async="async"></script>

    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="JQuery Terminal Emulator Plugin"/>
    <meta property="og:description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta property="og:url" content="http://terminal.jubic.pl/"/>
    <meta property="og:site_name" content="JQuery Terminal Emulator Plugin"/>
    <meta property="og:image" content="http://terminal.jcubic.pl/signature.png"/>

    <meta name="twitter:image" content="http://terminal.jcubic.pl/signature.png"/>
    <meta name="twitter:image:alt" content="Main ASCII Art for jQuery Terminal"/>
    <meta name="twitter:title" content="JQuery Terminal Emulator Plugin"/>
    <meta name="twitter:description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@jcubic"/>
    <meta name="twitter:creator" content="@jcubic"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <header id="main" role="presentation" aria-hidden="true"><h1>JQuery Terminal Emulator Plugin</h1>
    <a href="/"><pre id="sig">
<div class="big">
      __ _____                     ________                              __
     / // _  /__ __ _____ ___ __ _/__  ___/__ ___ ______ __ __  __ ___  / /
 __ / // // // // // _  // _// // / / // _  // _//     // //  \/ // _ \/ /
/  / // // // // // ___// / / // / / // ___// / / / / // // /\  // // / /__
\___//____ \\___//____//_/ _\_  / /_//____//_/ /_/ /_//_//_/ /_/ \__\_\___/
          \/              /____/                                     1.9.0
</div>
<div class="medium">
      __ ____ ________                              __
     / // _  /__  ___/__ ___ ______ __ __  __ ___  / /
 __ / // // /  / // _  // _//     // //  \/ // _ \/ /
/  / // // /  / // ___// / / / / // // /\  // // / /__
\___//____ \ /_//____//_/ /_/ /_//_//_/ /_/ \__\_\___/
          \/                                  1.9.0
</div>
<div class="small">
      __ ____ ________
     / // _  /__  ___/__ ___ ______
 __ / // // /  / // _  // _//     /
/  / // // /  / // ___// / / / / /
\___//____ \ /_//____//_/ /_/ /_/
          \/              1.9.0

</div>
</pre><img src="signature.png"/><!-- for FB bigger then gihub ribbon --></a>
<pre class="separator">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</pre>
    </header>
    <nav>
      <ul>
        <li><a href="#demo">Demo</a></li>
        <li><a href="api_reference.php">API Reference</a></li>
        <li><a href="examples.php">Examples</a></li>
        <li><a href="http://stackoverflow.com/questions/tagged/jquery-terminal">Q&amp;A</a></li>
        <li><a href="#download">Download</a></li>
        <li><a href="#comments">Comments</a></li>
        <li><a id="chat" href="#chat">Chat</a></li>
      </ul>
    </nav>
    <a class="github-ribbon" href="https://github.com/jcubic/jquery.terminal" style="position: fixed; top: 0; left: 0; z-index:1000"><img style="border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork JQuery Terminal Emulator on GitHub"></a>
    <section>
      <article>
        <header id="summary"><h2>Summary</h2></header>
        <p>JQuery Terminal Emulator is a plugin for creating command line interpreters in your applications. It can automatically call JSON-RPC service when user type commands or you can provide an object with methods, each method will be invoke on user command. Object can have nested objects which will create nested interpreter. You can also use a function in which you can parse user command by your own. It&prime;s ideal if you want to provide <strong>additional functionality for power users</strong>. It can also be used as debuging tool.</p>
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
          <li>You can create interpreter for your JSON-RPC service with <strong>one line of code</strong>.</li>
          <li>Support for <strong>authentication</strong> (you can provide function when user enter login and password or if you use <strong>JSON-RPC</strong> it can <strong>automatically call login function</strong> on the server and pass token to all functions)</li>
          <li>Stack of interpreters - you can create commands that trigger additional interpreters (eg. you can use couple of JSON-RPC service and run them when user type command)</li>
          <li>Command Tree - you can use nested objects each command will invoke a function if the value is an object it will create new interpreter and use function from that object as commands. You can use as much nested commands as you like. if the value is a string it will create JSON-RPC service.</li>
          <li>Tab completion with TAB key.</li>
          <li>Support for command line history (it use Local Storage if posible or cookies)</li>
          <li>Include <strong>keyboard</strong> shortcut from <strong>bash</strong> like CTRL+A, CTRL+D, CTRL+E etc.</li>
          <li><strong>Multiple terminals</strong> on one page (every terminal can have different command, it&prime;s own authentication function and it&prime;s own command history) - you can swich between them with CTRL+TAB</li>
          <li>It catch all exceptions and display error messages in terminal (you can see errors in your javascript and php code in terminal if they are in interpreter function)</li>
          <li>Support for basic text formating (color, background, underline, bold, italic) inside echo function</li>
          <li>You can create and overwrite existing keyboard shortcuts</li>
        </ul>
      </article>
      <article>
        <header id="demo"><h2>Demo</h2></header>
        <p>This is simple demo using javascript interpreter. (If cursor is not blinking - click on terminal to activate it) You can type any javascript expression, there are two debug function dir (like in python).</p>
        <p>You can use JQuery &lsquo;$&rsquo; function to manipulate the page. You also have access to this terminal in &lsquo;term&rsquo; variable. Try &lsquo;dir(term)&rsquo; or &lsquo;term.signature()&rsquo;.</p>
        <div id="term_demo"></div>
        <p>Javascript code:</p>
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
        greetings: 'Javascript Interpreter',
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
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/1.9.0/js/jquery.terminal-1.9.0.js" download target="_blank">jquery.terminal-1.9.0.js</a> - unminified version [304KB] [Gzip: 60KB]</li>
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/1.9.0/js/jquery.terminal-1.9.0.min.js" download target="_blank">jquery.terminal-1.9.0.min.js</a> - minified version [88KB] [Gzip: 32KB]</li>
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/1.9.0/js/unix_formatting.js" download target="_blank">unix_formatting.js</a> - ANSI escape codes and overtyping [16KB] [Gzip: 4,0KB]</li>
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/1.9.0/css/jquery.terminal-1.9.0.css" download target="_blank">jquery.terminal-1.9.0.css</a> - stylesheet [20KB] [Gzip: 4,0KB]</li>
          <li><a href="https://raw.githubusercontent.com/jcubic/jquery.terminal/1.9.0/css/jquery.terminal-1.9.0.min.css" download target="_blank">jquery.terminal-1.9.0.min.css</a> - minified stylesheet [12KB] [Gzip: 4,0KB]</li>
          <li><a href="https://github.com/brandonaaron/jquery-mousewheel">jquery-mousewheel</a> - you may also want mousewheel plugin</li>
          <li>From version 1.0.0, If you want to support <a href="http://caniuse.com/#feat=keyboardevent-key">browsers that don't support key event property</a>, like Safari, then you'll need to include <a href="https://github.com/cvan/keyboardevent-key-polyfill/">the polyfill</a>.</li>
        </ul>
      </article>
      <article>
        <header id="installation"><h2>Installation</h2></header>
        <p>You can dowload files locally or use:</p>
        <p>Bower:</p>
        <pre class="wrapper"><code>bower install jquery.terminal</code></pre>
        <p>NPM:</p>
        <pre class="wrapper"><code>npm install --save jquery.terminal</code></pre>
        <p>then you can include the scripts in your html</p>
        <pre class="wrapper"><code>&lt;script src="js/jquery.terminal-1.9.0.min.js"&gt;&lt;/script&gt;<br/>
&lt;script src="js/jquery.mousewheel-min.js"&gt;&lt;/script&gt;<br/>
&lt;link href="css/jquery.terminal-1.9.0.min.css" rel="stylesheet"/&gt;</code></pre>
        <p>You can also grab the files using CDN:</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/1.9.0/js/jquery.terminal.min.js"&gt;&lt;/script&gt;<br/>
&lt;link&nbsp;href="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/1.9.0/css/jquery.terminal.min.css" rel="stylesheet"/&gt;</code></pre>
        <p>or</p>
        <pre class="wrapper"><code>&lt;script&nbsp;src="https://cdn.jsdelivr.net/npm/jquery.terminal@1.9.0/js/jquery.terminal.min.js"&gt;&lt;/script&gt;<br/>
&lt;link&nbsp;href="https://cdn.jsdelivr.net/npm/jquery.terminal@1.9.0/css/jquery.terminal.min.css" rel="stylesheet"/&gt;</code></pre>
      </article>
      <article>
        <header id="license"><h2>License</h2></header>
        <p>JQuery Terminal Emulator plugin is released under <a href="https://opensource.org/licenses/MIT">MIT</a> license.</p>
        <p>It contains:</p>
        <ul>
          <li><a href="https://sites.google.com/site/daveschindler/jquery-html5-storage-plugin">Storage plugin</a> Distributed under the MIT License &mdash; (c) 2010 Dave Schindler</li>
          <li><a href="http://jquery.offput.ca/every/">jQuery Timers</a> licenced with the <a href="http://sam.zoy.org/wtfpl">WTFPL</a></li>
          <li><a href="http://blog.stevenlevithan.com/archives/cross-browser-split">Cross-Browser Split</a> under the MIT License Copyright 2007-2012 <a href="http://stevenlevithan.com">Steven Levithan</a></li>
          <li><a href="https://github.com/accursoft/caret">jQuery Caret</a> licensed with 3 clause BSD License, Copyright (c) 2009, Gideon Sireling</li>
          <li><a href="https://github.com/alexei/sprintf.js">sprintf.js</a> licensed under 3 clause BSD license, Copyright (c) 2007-2013 <a href="http://alexei.ro/">Alexandru Mărășteanu</a></li>
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
        <p>Use terminal to leave a comment. Click to active. If you have a question you can create an <a href="https://github.com/jcubic/jquery.terminal/issues/new">issue on github</a>, ask on <a href="http://stackoverflow.com/questions/ask">stackoverflow</a> (you can use jquery-terminal tag) or send email to <a rel="email">jcubic&#64;jcubic.pl</a>. You can also send email with SO question or jump to <a href="https://gitter.im/jcubic/jquery.terminal">the chat</a>.</p>
        <p style="color:#1687E9">If you have feature request you can also <a href="https://github.com/jcubic/jquery.terminal/issues/new">add GitHub issue</a>.</p>
        <p>If you've found an issue with website you can add issue to <a href="https://github.com/jcubic/jquery.terminal-www">jquery.terminal-www repo</a>.</p>
        <div id="term_comment"></div>
        <div id="share">
          <div id="wrapper">
            <div class="shareaholic-canvas" data-app="share_buttons" data-app-id="26217557"></div>
          </div>
        </div>
        <ul id="pagination"></ul>
        <div id="user_comments" style="clear:both"></div>
      </article>
    </section>
    <footer>
      <p id="copy">Copyright (c) 2010-<?php  echo date('Y'); ?> <a href="http://jcubic.pl/jakub-jankiewicz">Jakub Jankiewicz</a> Website: <a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a> <span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span> <span>source on <a href="https://github.com/jcubic/jquery.terminal-www">github</a></p>
    </footer>
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://rawgit.com/cvan/keyboardevent-key-polyfill/master/index.js"></script>
    <script src="js/jquery.mousewheel-min.js"></script>
    <script src="../js/jquery.terminal-src.js?<?= md5(file_get_contents('js/jquery.terminal.min.js')) ?>"></script>
    <script src="js/code.js"></script>
    <script src="js/dterm.js"></script>
    <script src="js/jquery.twbsPagination.min.js"></script>
    <script src="js/jquery-ui-1.8.7.custom.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>
    <script src="js/chat.js?<?= md5(file_get_contents('js/chat.js')) ?>"></script>
    <script src="js/sysend.js?<?= md5(file_get_contents('js/sysend.js')) ?>"></script>
    <script src="js/favico.min.js"></script>
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
             greetings: 'Javascript Interpreter (term v. ' + $.terminal.version + ')',
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
             'http://terminal.jcubic.pl/avatars/default.png'
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
             var $div = $('<div class="comment"><img src="' + img +
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
                 }
             });
         }

         $.jrpc("http://terminal.jcubic.pl/service.php", 'get_comments', [], function(data) {
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
    <noscript><p><img src="http://piwik.jcubic.pl/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
    <!-- End Piwik Code -->
    <? endif; ?>
  </body>
</html>
