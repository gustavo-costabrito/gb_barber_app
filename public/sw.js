const CACHE_NAME = "app-cache-v0";

const FILES_TO_CACHE = [
    "/",
    "/assets/css/style.css",
    "/assets/js/script.js"
];

self.addEventListener('install', event => {
    console.log("[ServiceWorker] Instalando...");

    event.waitUntill(
        caches.open(CACHE_NAME).then(cache => {
            console.log("[ServiceWorker] Adicionando arquivos ao cache...");
            return cache.addAll(FILES_TO_CACHE);
        })
    );

    self.skiptWaiting();
});

self.addEventListener("activate", event => {
    console.log("[ServvideWorker] Ativando e limpando caches antigos...");

    event.waitUntill(
        caches.keys().then(keys => {
            return Promise.all(
                keys.filter(key => key !== CACHE_NAME).map(key => caches.delete(key))
            );
        })
    );

    self.clients.claim();
});

self.addEventListener("fetch", event => {
    if(event.request.url.includes(".css") || event.request.url.includes(".js")){
        event.respondWith(
            fetch(event.request).then(response => {
                return caches.open(CACHE_NAME).then(cache => {
                    cache.put(event.request, response.clone());
                    return response;
                });
            }).catch(() => {
                return caches.match(event.request);
            })
        )
    } else {
        event.respondWith(
            caches.match(event.request).then(response => {
                return response || fetch(event.request);
            })
        )
    }
});
