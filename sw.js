importScripts('https://cdn.jsdelivr.net/npm/@jcubic/wayne/index.umd.min.js');

const app = new wayne.Wayne();

app.get('https://browser.sentry-cdn.com/*', async (req, res) => {
    const _res = await fetch(req.url, { mode: 'cors' });
    const type = _res.headers.get('Content-Type');
    let text = await _res.text();
    console.log('browser.sentry-cdn.com intercepted');
    //text = text.replace(/\\n\.widget__actor \{/, '\\n.brand-link { visibility: hidden; }\\n.widget__actor {');
    res.send(text, { type });
});

self.addEventListener('activate', (event) => {
  event.waitUntil(clients.claim());
});
