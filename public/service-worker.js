const VERSION = "v0.0.1";
const CACHE_NAME = `nosaz-app-cache-${VERSION}`;
const OFFLINE_URL = "/offline";
const ASSET_MANIFEST_URL = "/build/manifest.json";

async function cacheAssets() {
    const cache = await caches.open(CACHE_NAME);
    const response = await fetch(ASSET_MANIFEST_URL);
    const assets = await response.json();

    await cache.addAll([
        OFFLINE_URL,
        "/build/" + assets["resources/css/app.css"]["file"],
        "/build/" + assets["resources/fonts/IRANSansX-Regular.woff2"]["file"],
        "/build/" + assets["resources/fonts/IRANSansX-Bold.woff2"]["file"],
    ]);
}

// Cache the offline page during installation
self.addEventListener("install", (event) => {
    /**
     * Since the name of assets are random, a helper function gets the name of required files
     * from build forlder using the generated manifest by vite package.
     */
    event.waitUntil(cacheAssets());
    /**
     * By default, a new Service Worker will install but won’t take control
     * until all tabs using the old version are closed.
     * To activate the new version immediately, use self.skipWaiting()
     */
    self.skipWaiting();
});

// Intercept network requests
self.addEventListener("fetch", (event) => {
    event.respondWith(
        fetch(event.request).catch(() => {
            return caches.match(event.request).then((response) => {
                return response || caches.match(OFFLINE_URL);
            });
        })
    );
});

/**
 * To avoid storing outdated caches and to ensure a smooth update process,
 * delete old caches during the activate event.
 */
self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
    self.clients.claim(); // Take control of all pages immediately
});
