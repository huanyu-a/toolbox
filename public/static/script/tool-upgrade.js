/* ============================================================
   tool-upgrade.js — 工具页交互增强层
   1) 移动端点击 Tab 后自动将激活项滚入可视区（横向滑动条）
   2) 全局轻量 toast（依赖 tool-upgrade.css 的 #tb-toast 样式）
   3) Tab 锚点直达：/convert/#cvHex 这类 #锚点（取 data-panel 或
      data-mode）自动激活对应子工具，点击 Tab 时同步锚点，供搜索
      结果/分享链接直达。激活一律模拟 click，切换逻辑仍归页面内联
      脚本，此处不做任何类切换，避免冲突。
   ============================================================ */
(function () {
    'use strict';

    var mqMobile = window.matchMedia('(max-width: 767px)');

    /* ---------- 激活 Tab 滚入可视区 ---------- */
    function centerTab(tab, smooth) {
        if (!tab || !mqMobile.matches) return;
        var wrap = tab.closest('.t-tabs');
        if (!wrap || wrap.scrollWidth <= wrap.clientWidth + 4) return;
        tab.scrollIntoView({
            behavior: smooth ? 'smooth' : 'auto',
            inline: 'center',
            block: 'nearest'
        });
    }

    /* ---------- Tab 锚点直达 ---------- */
    function tabKey(tab) {
        return tab.getAttribute('data-panel') || tab.getAttribute('data-mode');
    }
    function findTabByKey(key) {
        if (!key) return null;
        var tabs = document.querySelectorAll('.t-tabs .t-tab');
        for (var i = 0; i < tabs.length; i++) {
            if (tabKey(tabs[i]) === key) return tabs[i];
        }
        return null;
    }
    function syncHash(tab) {
        var key = tabKey(tab);
        if (key && window.history && history.replaceState) {
            history.replaceState(null, '', '#' + key);
        }
    }
    function activateFromHash() {
        var tab = findTabByKey((window.location.hash || '').replace(/^#/, ''));
        // 已处于激活态则不重复触发，避免打断页面自身的延迟初始化
        if (tab && !tab.classList.contains('active')) tab.click();
    }
    /* 内联脚本在 DOMContentLoaded 前绑定；定时器回调确保在其后（含页面自己的 DCL 监听）执行 */
    function scheduleActivate() { setTimeout(activateFromHash, 0); }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', scheduleActivate);
    } else {
        scheduleActivate();
    }
    window.addEventListener('hashchange', scheduleActivate);

    document.addEventListener('click', function (e) {
        if (!e.target || !e.target.closest) return;
        var tab = e.target.closest('.t-tab');
        if (tab) { centerTab(tab, true); syncHash(tab); }
    });

    /* 初始定位：页面内联脚本已在 DOMContentLoaded 前绑定，此处延后对齐 */
    window.addEventListener('load', function () {
        var active = document.querySelector('.t-tabs .t-tab.active');
        centerTab(active, false);
    });

    /* ---------- 轻量 toast ---------- */
    var toastEl = null;
    var toastTimer = null;

    function ensureToast() {
        if (toastEl && document.body.contains(toastEl)) return toastEl;
        toastEl = document.createElement('div');
        toastEl.id = 'tb-toast';
        toastEl.setAttribute('role', 'status');
        toastEl.setAttribute('aria-live', 'polite');
        document.body.appendChild(toastEl);
        return toastEl;
    }

    /**
     * window.tbToast('已复制') — 1.8s 自动消失
     */
    window.tbToast = function (msg) {
        if (!msg) return;
        var el = ensureToast();
        el.textContent = String(msg);
        el.classList.add('show');
        if (toastTimer) clearTimeout(toastTimer);
        toastTimer = setTimeout(function () {
            el.classList.remove('show');
        }, 1800);
    };
})();
