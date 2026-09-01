/* ============================================================
   tool-upgrade.js — 工具页交互增强层
   1) 移动端点击 Tab 后自动将激活项滚入可视区（横向滑动条）
   2) 全局轻量 toast（依赖 tool-upgrade.css 的 #tb-toast 样式）
   说明：各页 Tab 切换逻辑为页面内联脚本，此处用 document 级事件
   委托在其后触发（冒泡顺序），不做任何切换逻辑，避免冲突。
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

    document.addEventListener('click', function (e) {
        if (!e.target || !e.target.closest) return;
        var tab = e.target.closest('.t-tab');
        if (tab) centerTab(tab, true);
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
