<?php
require('utils.php');
?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Page Not Found</title>
    <meta name="description" content="jQuery Terminal: Page Not Found"/>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <!--[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/optparse/lib/optparse.js"></script>
    <script>
    var global = window;
    var exports = false;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/rot-js@0.6.5/lib/rot.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/jcubic/static/js/wcwidth.js"></script>
    <link rel="stylesheet" href="https://terminal.jcubic.pl/css/jquery.terminal.min.css"/>
    <script src="https://terminal.jcubic.pl/js/jquery.terminal.min.js"></script>
    <script>var code = 404</script>
    <script src="https://terminal.jcubic.pl/js/json-rpc.js"></script>
    <script src="https://terminal.jcubic.pl/js/rouge.js?<?= hashfile('js/rouge.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/gh/jcubic/matrix-snake@5d07f71be754626026fd88c27da17c27c91ef56f/dist/matrix-snake.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/jcubic/ascii-canvas@5aa9c44e4b1416741e82866ca29846a96207f00e/dist/umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/jcubic/static/js/tetris-engine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/randomcolor/randomColor.js"></script>
    <script src="https://terminal.jcubic.pl/js/sysend.js?<?= md5(file_get_contents('js/sysend.js')) ?>"></script>
    <script src="https://www.gstatic.com/firebasejs/7.8.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.8.1/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.8.1/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.8.1/firebase-auth.js"></script>
    <script src="https://terminal.jcubic.pl/js/terminal.error.js?<?= hashfile('js/terminal.error.js') ?>"></script>
    <script src="https://terminal.jcubic.pl/js/favico.min.js"></script>
    <script src="https://terminal.jcubic.pl/js/snake.js?<?= hashfile('js/snake.js') ?>"></script>
    <script src="https://terminal.jcubic.pl/js/tetris.js?<?= hashfile('js/snake.js') ?>"></script>
    <script src="https://terminal.jcubic.pl/js/matrix.js?<?= hashfile('js/matrix.js') ?>"></script>
    <script src="https://terminal.jcubic.pl/js/less.js?<?= hashfile('js/rouge.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/figlet/lib/figlet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3.x.x/dist/fp.umd.min.js"></script>
    <script src="https://terminal.jcubic.pl/js/chat.js?<?= hashfile('js/chat.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/gh/jcubic/static/js/qrcode.js"></script>
    <script src="https://terminal.jcubic.pl/js/unix_formatting.js?<?= hashfile('js/unix_formatting.js') ?>""></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/terminal-prism/css/prism.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/jquery.terminal/js/prism.js"></script>
    <link rel="stylesheet" href="https://terminal.jcubic.pl/css/error.css?<?= hashfile('css/error.css') ?>""/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="jQuery Terminal Page Not Found"/>
    <meta property="og:description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta property="og:url" content="https://terminal.jcubic.pl<?=$_SERVER['REQUEST_URI']?>"/>
    <meta property="og:site_name" content="JQuery Terminal Emulator Plugin"/>
    <meta property="og:image" content="https://terminal.jcubic.pl/icon_big.png"/>

    <meta name="twitter:image" content="https://terminal.jcubic.pl/icon_big.png"/>
    <meta name="twitter:image:alt" content="Stylized Terminal Prompt '>_'"/>
    <meta name="twitter:title" content="jQuery Terminal Page Not Found"/>
    <meta name="twitter:description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@jcubic"/>
    <meta name="twitter:creator" content="@jcubic"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, interactive-widget=resizes-content" />
</head>
<body>
  <div id="term"></div>
  <div class="rouge"></div>
  <canvas class="snake"></canvas>
  <canvas class="tetris"></canvas>
  <canvas class="matrix"></canvas>
  <div class="off-site">
    <span class="font">m</span>
  </div>
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
