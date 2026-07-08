
    <footer>
      <p id="copy">Copyright (c) 2010-<?php  echo date('Y'); ?>
        <a href="https://jakub.jankiewicz.org/">Jakub T. Jankiewicz</a>
        Website: <a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>
        <span>source on <a href="https://github.com/jcubic/jquery.terminal-www">GitHub</a></p>
    </footer>
    <?php
    $localhost = preg_match("/^localhost(:[0-9]+)?/", $_SERVER["HTTP_HOST"]);
    ?>
    <script>
     if ('serviceWorker' in navigator) {
         navigator.serviceWorker.register('sw.js', { scope: '/' })
                  .then(function(reg) {
                      navigator.serviceWorker.ready.then(() => {
                          const worker = navigator.serviceWorker.controller;
                          if (worker.state === 'activated') {
                              init_sentry();
                          } else {
                              worker.addEventListener('statechange', () => {
                                  if (worker.state === 'activated') {
                                      init_sentry();
                                  }
                              });
                          }
                      });
                  }).catch(function(error) {
                      console.log('Registration failed with ' + error);
                  });
     } else {
         init_sentry();
     }
     function init_sentry() {
         const script = document.createElement('script');
         script.crossorigin='anonymous';
         script.src = 'https://browser.sentry-cdn.com/10.59.0/bundle.tracing.replay.feedback.logs.metrics.min.js';
         console.log('script injected');
         document.body.appendChild(script);
         // protect from inifite loop when script doesn't load
         let tries = 10;
         (function loop() {
             if (typeof Sentry === 'undefined') {
                 if (tries --> 0) {
                     setTimeout(loop, 100);
                 }
             } else {
                 done();
             }
         })();
         function done() {
             console.log('init Sentry');
             Sentry.init({
                 colorScheme: 'dark',
                 dsn: 'https://c6868ced9c228b7da5e50196c0ab2f14@o4508899181723648.ingest.de.sentry.io/4508899184607312',
                 integrations: [
<?php if (!$localhost): ?>                 Sentry.replayIntegration({ maskAllText: false, blockAllMedia: false }),
<?php endif; ?>
                     Sentry.feedbackIntegration()
                 ]
             });
         }
     }
    </script>
    <?php if (!($localhost || isset($_GET['track']))): ?>
    <script defer src="https://umami.jcubic.pl/script.js"
            data-website-id="bb1c5851-93fe-4fce-8209-944c25b8f7be"></script>
    <?php endif; ?>

