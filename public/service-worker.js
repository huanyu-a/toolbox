/* ============================================================
 * 在线工具箱 Service Worker（离线缓存）
 * 策略：
 *  - /static/ 静态资源：缓存优先（资源引用全部带 ?v= 版本号，URL 变更即天然失效）
 *  - 页面导航：网络优先，离线时回退缓存副本（最多保留 30 页）
 *  - 其余（API/POST/跨域）：直接放行，不缓存
 * 变更本文件逻辑时必须同时提升下方 CACHE 版本号以淘汰旧缓存。
 * ============================================================ */
'use strict';

var STATIC_CACHE = 'tb-static-v1';
var PAGE_CACHE = 'tb-pages-v1';
var PAGE_LIMIT = 30;

self.addEventListener('install', function (e) {
    e.waitUntil(
        caches.open(PAGE_CACHE).then(function (c) {
            return c.addAll(['/']).catch(function () { /* 首页预取失败不阻塞安装 */ });
        }).then(function () { return self.skipWaiting(); })
    );
});

self.addEventListener('activate', function (e) {
    e.waitUntil(
        caches.keys().then(function (keys) {
            return Promise.all(keys.map(function (k) {
                if (k !== STATIC_CACHE && k !== PAGE_CACHE) return caches.delete(k);
            }));
        }).then(function () { return self.clients.claim(); })
    );
});

function trimCache(cacheName, max) {
    caches.open(cacheName).then(function (c) {
        c.keys().then(function (keys) {
            if (keys.length > max) {
                c.delete(keys[0]).then(function () { trimCache(cacheName, max); });
            }
        });
    });
}

self.addEventListener('fetch', function (e) {
    var req = e.request;
    if (req.method !== 'GET') return;
    var url = new URL(req.url);
    if (url.origin !== self.location.origin) return; // 外部 API 不碰

    // 静态资源：缓存优先（?v= 版本号保证 URL 不可变）
    if (url.pathname.indexOf('/static/') === 0) {
        e.respondWith(
            caches.match(req).then(function (hit) {
                if (hit) return hit;
                return fetch(req).then(function (res) {
                    if (res && res.ok) {
                        var copy = res.clone();
                        caches.open(STATIC_CACHE).then(function (c) { c.put(req, copy); });
                    }
                    return res;
                });
            })
        );
        return;
    }

    // 页面导航：网络优先，离线回退缓存
    if (req.mode === 'navigate') {
        e.respondWith(
            fetch(req).then(function (res) {
                if (res && res.ok) {
                    var copy = res.clone();
                    caches.open(PAGE_CACHE).then(function (c) {
                        c.put(req, copy).then(function () { trimCache(PAGE_CACHE, PAGE_LIMIT); });
                    });
                }
                return res;
            }).catch(function () {
                return caches.match(req).then(function (hit) {
                    return hit || caches.match('/');
                });
            })
        );
    }
    // 其余同源 GET（如 manifest.json、favicon）：直接放行走浏览器默认
});
