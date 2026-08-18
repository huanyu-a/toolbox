/* ============================================================
   在线工具箱 后台管理 JS (admin.js)
   框架菜单 / AJAX 表单 / Toast 提示
   ============================================================ */
(function (window, document) {
    'use strict';

    /* ---------- Toast ---------- */
    var toastWrap = null;
    function toast(msg, type) {
        if (!toastWrap) {
            toastWrap = document.createElement('div');
            toastWrap.className = 'toast-wrap';
            document.body.appendChild(toastWrap);
        }
        var el = document.createElement('div');
        el.className = 'toast' + (type ? ' toast-' + type : '');
        el.textContent = msg;
        toastWrap.appendChild(el);
        requestAnimationFrame(function () { el.classList.add('show'); });
        setTimeout(function () {
            el.classList.remove('show');
            setTimeout(function () { el.remove(); }, 250);
        }, 2200);
    }

    /* ---------- 侧栏菜单 ---------- */
    function initMenu() {
        var groups = document.querySelectorAll('.menu-group');
        groups.forEach(function (g) {
            var head = g.querySelector(':scope > .menu-item');
            if (!head) return;
            head.addEventListener('click', function (e) {
                e.preventDefault();
                var isOpen = g.classList.contains('open');
                groups.forEach(function (o) { o.classList.remove('open'); });
                if (!isOpen) g.classList.add('open');
            });
        });
        // 顶部菜单切换按钮：桌面折叠 / 移动端抽屉
        var toggle = document.getElementById('menuToggle');
        var side = document.getElementById('adminSide');
        if (toggle && side) {
            var SIDE_KEY = 'favshub_admin_side';
            var saved = null;
            try { saved = localStorage.getItem(SIDE_KEY); } catch (e) { /* ignore */ }
            if (saved === '1' && window.innerWidth > 768) {
                document.body.classList.add('side-collapsed');
            }
            toggle.addEventListener('click', function () {
                if (window.innerWidth > 768) {
                    var collapsed = document.body.classList.toggle('side-collapsed');
                    try { localStorage.setItem(SIDE_KEY, collapsed ? '1' : '0'); } catch (e) { /* ignore */ }
                } else {
                    side.classList.toggle('open');
                }
            });
        }
    }

    /* ---------- 主题切换按钮 ---------- */
    function initThemeToggle() {
        var btns = document.querySelectorAll('.theme-toggle');
        btns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var t = window.AdminTheme ? window.AdminTheme.toggle() : 'light';
                var icon = btn.querySelector('.theme-toggle-icon');
                if (icon) icon.textContent = t === 'dark' ? '☀️' : '🌙';
                btn.title = t === 'dark' ? '切换到浅色模式' : '切换到深色模式';
            });
        });
    }

    /* ---------- iframe 内菜单高亮 ---------- */
    function initFrameActive() {
        var frame = document.getElementById('mainFrame');
        if (!frame) return;
        function sync() {
            var path = '';
            try { path = frame.contentWindow.location.pathname; } catch (e) { return; }
            document.querySelectorAll('.admin-side a').forEach(function (a) {
                var href = a.getAttribute('href') || '';
                a.classList.remove('active');
                if (href && path.indexOf(href.replace(/\.html$/, '')) === 0) {
                    a.classList.add('active');
                    var group = a.closest('.menu-group');
                    if (group) group.classList.add('open');
                }
            });
        }
        frame.addEventListener('load', sync);
        sync();
    }

    /* ---------- AJAX 表单 ---------- */
    function initAjaxForms() {
        document.querySelectorAll('form[data-ajax]').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                var btn = form.querySelector('[type="submit"]');
                var oldText = btn ? btn.textContent : '';
                if (btn) { btn.disabled = true; btn.textContent = '提交中…'; }
                var data = new FormData(form);
                fetch(form.getAttribute('action') || location.href, {
                    method: 'POST',
                    body: data,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(function (r) { return r.json(); })
                    .then(function (res) {
                        if (res.code === 0) {
                            toast(res.msg || '操作成功', 'ok');
                            if (form.getAttribute('data-redirect')) {
                                setTimeout(function () { window.location.href = form.getAttribute('data-redirect'); }, 800);
                            } else if (form.getAttribute('data-reload') === '1') {
                                setTimeout(function () { window.location.reload(); }, 800);
                            }
                        } else {
                            toast(res.msg || '操作失败', 'err');
                        }
                    })
                    .catch(function () { toast('网络错误，请重试', 'err'); })
                    .finally(function () {
                        if (btn) { btn.disabled = false; btn.textContent = oldText; }
                    });
            });
        });
    }

    /* ---------- 普通 POST 表单（同步保存） ---------- */
    function initPlainForms() {
        document.querySelectorAll('form[data-confirm]').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                var msg = form.getAttribute('data-confirm');
                if (msg && !window.confirm(msg)) e.preventDefault();
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initMenu();
        initThemeToggle();
        initFrameActive();
        initAjaxForms();
        initPlainForms();
    });

    window.AdminToast = toast;
})(window, document);
