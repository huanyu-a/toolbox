/* ============================================================
   在线工具箱 后台主题引擎 (theme.js)
   深浅色模式：localStorage 记忆 + 系统偏好跟随
   所有后台页面（含 iframe 内容页）统一引入，同源自动同步
   切换时实时同步到同源 iframe（主框架内容页），无需刷新
   ============================================================ */
(function (window, document) {
    'use strict';

    var KEY = 'favshub_admin_theme';
    var mql = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;
    var _pendingIframes = {};  // iframe src → timeout id，等待加载后补同步

    function current() {
        var t = null;
        try { t = localStorage.getItem(KEY); } catch (e) { /* ignore */ }
        if (t !== 'dark' && t !== 'light') {
            t = (mql && mql.matches) ? 'dark' : 'light';
        }
        return t;
    }

    function setDocTheme(doc, t) {
        if (!doc || !doc.documentElement) return false;
        if (t === 'dark') {
            doc.documentElement.setAttribute('data-theme', 'dark');
        } else {
            doc.documentElement.removeAttribute('data-theme');
        }
        return true;
    }

    /* 实时同步主题到同源 iframe（后台主框架的内容页），切换无需刷新 */
    function syncFrames(t) {
        var frames = document.querySelectorAll('iframe');
        frames.forEach(function (f) {
            try {
                if (setDocTheme(f.contentDocument, t)) {
                    delete _pendingIframes[f.src];
                }
            } catch (e) {
                keepPending(f);
            }
        });
    }

    /* 标记 iframe 待补同步：页面正在加载中 */
    function keepPending(f) {
        var src = f.src || '';
        if (_pendingIframes[src]) clearTimeout(_pendingIframes[src]);
        _pendingIframes[src] = setTimeout(function () {
            delete _pendingIframes[src];
            try { setDocTheme(f.contentDocument, current()); } catch (e) { /* ignore */ }
        }, 600);
    }

    function updateBtns(t) {
        var btns = document.querySelectorAll('.theme-toggle');
        btns.forEach(function (b) {
            var icon = b.querySelector('.theme-toggle-icon');
            if (icon) icon.textContent = t === 'dark' ? '☀️' : '🌙';
            b.title = t === 'dark' ? '切换到浅色模式' : '切换到深色模式';
        });
    }

    function apply(t, save) {
        setDocTheme(document, t);
        if (save) {
            try { localStorage.setItem(KEY, t); } catch (e) { /* ignore */ }
        }
        updateBtns(t);
        syncFrames(t);
    }

    // 立即应用（head 中同步执行，避免闪烁）
    apply(current(), false);

    // iframe 加载完成后补一次当前主题（双保险）
    // 场景：父框架切换了主题但子页面正在加载，等加载完自动跟随
    function watchIframes() {
        var frames = document.querySelectorAll('iframe');
        frames.forEach(function (f) {
            f.addEventListener('load', function () {
                try {
                    // 先立即同步
                    if (setDocTheme(f.contentDocument, current())) {
                        delete _pendingIframes[f.src || ''];
                    }
                } catch (e) {
                    keepPending(f, current());
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', watchIframes);
    } else {
        watchIframes();
    }

    // 跨标签页同步：一个标签页切换，其它同源标签页跟随
    window.addEventListener('storage', function (e) {
        if (e.key === KEY && (e.newValue === 'dark' || e.newValue === 'light')) {
            apply(e.newValue, false);
        }
    });

    window.AdminTheme = {
        current: current,
        apply: apply,
        toggle: function () {
            var next = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            apply(next, true);
            return next;
        }
    };

    // 未手动选择时跟随系统
    if (mql && mql.addEventListener) {
        mql.addEventListener('change', function (e) {
            var saved = null;
            try { saved = localStorage.getItem(KEY); } catch (err) { /* ignore */ }
            if (!saved) apply(e.matches ? 'dark' : 'light', false);
        });
    }
})(window, document);
