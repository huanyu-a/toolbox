/* ============================================================
   在线工具箱 后台主题引擎 (theme.js)
   深浅色模式：localStorage 记忆 + 系统偏好跟随
   所有后台页面（含 iframe 内容页）统一引入，同源自动同步
   ============================================================ */
(function (window, document) {
    'use strict';

    var KEY = 'favshub_admin_theme';
    var mql = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;

    function current() {
        var t = null;
        try { t = localStorage.getItem(KEY); } catch (e) { /* ignore */ }
        if (t !== 'dark' && t !== 'light') {
            t = (mql && mql.matches) ? 'dark' : 'light';
        }
        return t;
    }

    function apply(t, save) {
        if (t === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
        }
        if (save) {
            try { localStorage.setItem(KEY, t); } catch (e) { /* ignore */ }
        }
        // 通知同页面的主题切换按钮
        var btns = document.querySelectorAll('.theme-toggle');
        btns.forEach(function (b) {
            var icon = b.querySelector('.theme-toggle-icon');
            if (icon) icon.textContent = t === 'dark' ? '☀️' : '🌙';
            b.title = t === 'dark' ? '切换到浅色模式' : '切换到深色模式';
        });
    }

    // 立即应用（head 中同步执行，避免闪烁）
    apply(current(), false);

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
