// FILE PATH: /resources/js/sw-registry.js


let newWorker;

// Notify user if service worker file has changed.. and need to update
// in your blade file create this snippet for notification for example
//
// <div id="sw-snackbar">A new version of this app is available. Click <a id="reload">here</a> to update.</div>
//
function showUpdateBar() {
    let snackbar = document.getElementById('sw-snackbar');
    snackbar.className = 'show';
}

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js').then(reg => {
            reg.addEventListener('updatefound', () => {
                newWorker = reg.installing;

                newWorker.addEventListener('statechange', () => {
                    switch (newWorker.state) {
                    case 'installed':
                        if (navigator.serviceWorker.controller) {
                          // Show update bar
                          showUpdateBar();
                        }
                        break;
                    }
                });
            });
        }).catch((err) => {
            console.log('ServiceWorker registration failed: ', err);
        });

        let refreshing;
        navigator.serviceWorker.addEventListener('controllerchange', function () {
            if (refreshing) return;
            window.location.reload();
            refreshing = true;
        });
    });
}