const CACHE_NAME = 'bauntungpos-cache-v11';
const ASSETS = [
  '/login',
  '/pos',
  '/manifest.json',
  '/favicon.ico',
];

// Install Event
self.addEventListener('install', (e) => {
  e.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(ASSETS);
    }).then(() => self.skipWaiting())
  );
});

// Activate Event
self.addEventListener('activate', (e) => {
  e.waitUntil(
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

// Fetch Event (Network falling back to Cache)
self.addEventListener('fetch', (e) => {
  // Only handle GET requests
  if (e.request.method !== 'GET') return;

  e.respondWith(
    fetch(e.request)
      .then((res) => {
        const url = new URL(e.request.url);
        // Caching compiled vite assets dynamically
        if (res.status === 200 && (url.pathname.startsWith('/build/') || url.pathname.includes('/fonts/'))) {
          const resClone = res.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(e.request, resClone);
          });
        }
        return res;
      })
      .catch(() => {
        return caches.match(e.request).then((cachedRes) => {
          if (cachedRes) {
            return cachedRes;
          }
          // Fallback to login screen if HTML request fails
          if (e.request.headers.get('accept') && e.request.headers.get('accept').includes('text/html')) {
            return caches.match('/login');
          }
        });
      })
  );
});
