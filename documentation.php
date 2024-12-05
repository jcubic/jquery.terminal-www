<?php // -*- mode: web -*-
header("X-Powered-By: ");
require('utils.php');
$version = version();
?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Documentation for jQuery Terminal, Web Based Terminal</title>
    <link rel="canonical" href="https://terminal.jcubic.pl/documentation.php"/>
    <meta name="author" content="Jakub T. Jankiewicz - jcubic&#64;onet.pl"/>
    <meta name="Description" content="This is list of resources about jQuery Termial. API reference, Wiki, Tutorials, and Articles."/>
    <meta name="keywords" content="jquery,terminal,interpreter,console,bash,history,authentication,ajax,server,client"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="alternate" type="application/rss+xml" title="Notification RSS" href="https://terminal.jcubic.pl/notification.rss"/>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans+Mono&display=swap"
          rel="stylesheet" type="text/css" media="print"
          onload="this.media='all'" />
    <link rel="stylesheet" href="css/style.css?<?= md5(file_get_contents('css/style.css')) ?>"/>
    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    <script src="js/code.js"></script>
    <!-- Terminal Files -->
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
        <header id="doc"><h1>Documentation</h1></header>
        <p>Below is the list of resources that you can use to learn about jQuery Terminal</p>
        <ul>
          <li><a href="https://github.com/jcubic/jquery.terminal/wiki/Getting-Started">Getting Started Guide</a></li>
          <li><a href="api_reference.php">API Reference</a></li>
          <li><a href="https://github.com/jcubic/jquery.terminal/wiki/Advanced-jQuery-Terminal-Tutorial">Advanced jQuery Terminal Tutorial</a></li>
        </ul>
        <p>Official Tutorials</p>
        <ul>
          <li><a href="https://itnext.io/how-to-create-interactive-terminal-like-website-888bb0972288">How to create interactive terminal like website in JavaScript?</a> (beginner)</li>
          <li><a href="https://www.freecodecamp.org/news/how-to-create-interactive-terminal-based-portfolio/">How to Create an Interactive Terminal-Based Portfolio Website</a> (intermediate)</li>
        </ul>
        <p>Other Tutorials</p>
        <ul>
          <li><a href="https://www.geeksforgeeks.org/how-to-build-simple-terminal-like-website-using-jquery/">How to Build Simple Terminal like Website using jQuery?</a></li>
          <li><a href="https://www.learnsteps.com/making-a-javascript-terminal-in-browser/">Terminal in browser: Building a Javascript Terminal in your website</a></li>
          <li><a href="https://medium.com/@tristwolff/how-to-create-your-own-custom-ai-chatbot-with-a-text-editor-28-lines-of-javascript-29563510a740">How to create your own custom AI Chatbot with a text editor & 28 lines of Javascript</a></li>
          <li><a href="https://cryptodeeptech.ru/terminal-google-colab/">We create our own terminal in Google Colab for work in GitHub, GDrive, NGrok, etc.</a></li>
        </ul>
        <p>Blog Posts</p>
        <ul>
          <li><a href="https://guido-muehlwitz.de/2011/08/jquery-terminal-emulator/">Article in German</a></li>
          <li><a href="https://sumygg.com/2015/12/10/install-jquery-terminal-emulator-plugin-in-my-blog/">体验JQuery Terminal Emulator插件</a></li>
          <li><a href="https://www.moongift.jp/2016/07/jquery-terminal-emulator-plugin-jquery%E3%82%82%E4%BD%BF%E3%81%88%E3%82%8Bjquery%E8%A3%BD%E3%81%AE%E3%82%BF%E3%83%BC%E3%83%9F%E3%83%8A%E3%83%AB%E3%82%A8%E3%83%9F%E3%83%A5%E3%83%AC%E3%83%BC%E3%82%BF/">JQuery Terminal Emulator Plugin - jQueryも使えるjQuery製のターミナルエミュレータ</a></li>
        </ul>
      </article>
    </section>
    <footer>
      <p id="copy">Copyright (c) 2010-<?php  echo date('Y'); ?> <a href="https://jakub.jankiewicz.org/">Jakub T. Jankiewicz</a> Website: <a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a> <span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span> <span>source on <a href="https://github.com/jcubic/jquery.terminal-www">github</a></p>
    </footer>
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
    <script defer src="https://cloud.umami.is/script.js" data-website-id="55bf99f6-75ef-441d-95b1-27bcc3b7b332"></script>
    <? endif; ?>
  </body>
</html>
