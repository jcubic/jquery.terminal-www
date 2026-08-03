importScripts('https://cdn.jsdelivr.net/npm/@jcubic/wayne/index.umd.min.js');

const app = new wayne.Wayne();

app.get('https://browser.sentry-cdn.com/*', async (req, res) => {
    console.log('browser.sentry-cdn.com intercepted');
    if (req.url.match(/feedback-modal\.min\.js/)) {
        const _res = await fetch(req.url, { mode: 'cors' });
        const type = _res.headers.get('Content-Type');
        let text = await _res.text();
        text = text.replace('M29,2.26a4.67,4.67,0,0,0-8,0L14.42,13.53A32.21,32.21,0,0,1,32.17,40.19H27.55A27.68,27.68,0,0,0,12.09,17.47L6,28a15.92,15.92,0,0,1,9.23,12.17H4.62A.76.76,0,0,1,4,39.06l2.94-5a10.74,10.74,0,0,0-3.36-1.9l-2.91,5a4.54,4.54,0,0,0,1.69,6.24A4.66,4.66,0,0,0,4.62,44H19.15a19.4,19.4,0,0,0-8-17.31l2.31-4A23.87,23.87,0,0,1,23.76,44H36.07a35.88,35.88,0,0,0-16.41-31.8l4.67-8a.77.77,0,0,1,1.05-.27c.53.29,20.29,34.77,20.66,35.17a.76.76,0,0,1-.68,1.13H40.6q.09,1.91,0,3.81h4.78A4.59,4.59,0,0,0,50,39.43a4.49,4.49,0,0,0-.62-2.28Z', 'M 0.3367955,-0.444405 V 43.665211 H 57.663209 V -0.444405 Z M 3.0411955,2.26 H 54.958804 V 40.960806 H 3.0411955 Z m 4.80417,5.09777 v 4.215035 l 9.9310195,4.894286 -9.9310195,4.60747 v 4.179183 L 23.205539,17.788771 V 15.28785 Z M 28.721906,31.576297 v 4.286739 h 21.432726 v -4.286739 z');
        res.send(text, { type });
    } else {
        return res.fetch(req);
    }
});

wayne.force();
