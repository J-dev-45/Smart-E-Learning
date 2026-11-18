const CACHE_NAME = 'smart-e-learning-v1';
const PRECACHE_ASSETS = [
    '/',
    '/manifest.json',
    '/images/Components/Logo.png',
    '/images/Components/Favicon.png',
    '/images/Components/favicon-192.png',
    '/images/Components/favicon-512.png',
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(PRECACHE_ASSETS).catch((err) => {
                console.warn('[SW] Pre-caching warning:', err);
            });
        })
    );
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.map((key) => {
                    if (key !== CACHE_NAME) {
                        return caches.delete(key);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    const { request } = event;

    // Only handle GET requests; pass POST/PUT/DELETE/etc. directly to network
    if (request.method !== 'GET') {
        return;
    }

    // Don't intercept Vite HMR / hot-reload / browser-sync / dev server
    const url = new URL(request.url);
    if (
        url.pathname.startsWith('/@vite') ||
        url.pathname.startsWith('/@fs') ||
        url.port === '5173'
    ) {
        return;
    }

    // For HTML page navigation requests: Network First, fallback to cached page or home
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request).catch(async () => {
                const cached = await caches.match(request);
                if (cached) return cached;
                const home = await caches.match('/');
                if (home) return home;
                return new Response('You are offline. Please check your internet connection.', {
                    headers: { 'Content-Type': 'text/plain; charset=utf-8' },
                    status: 503,
                });
            })
        );
        return;
    }

    // For static assets (images, fonts, css, js): Cache First, fallback to network and cache
    if (
        url.pathname.startsWith('/images/') ||
        url.pathname.startsWith('/build/') ||
        url.pathname.endsWith('.png') ||
        url.pathname.endsWith('.jpg') ||
        url.pathname.endsWith('.jpeg') ||
        url.pathname.endsWith('.svg') ||
        url.pathname.endsWith('.css') ||
        url.pathname.endsWith('.js')
    ) {
        event.respondWith(
            caches.match(request).then((cachedResponse) => {
                if (cachedResponse) {
                    return cachedResponse;
                }
                return fetch(request).then((networkResponse) => {
                    if (networkResponse && networkResponse.status === 200) {
                        const responseClone = networkResponse.clone();
                        caches.open(CACHE_NAME).then((cache) => {
                            cache.put(request, responseClone);
                        });
                    }
                    return networkResponse;
                });
            })
        );
        return;
    }

    // Default: network with cache fallback
    event.respondWith(
        fetch(request).catch(() => caches.match(request))
    );
});
