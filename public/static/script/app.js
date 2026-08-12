/* ============================================================
   在线工具箱 前端重构 (app.js)
   深色模式 / 首页搜索 / 顶部导航搜索 / 足迹历史
   ============================================================ */
(function (window, document, $) {
    'use strict';

    /* ---------- 深色模式 ---------- */
    var THEME_KEY = 'toolbox_theme';
    var mql = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;

    function applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
        }
        var icon = document.querySelector('#themeToggle .theme-icon');
        if (icon) {
            icon.textContent = theme === 'dark' ? '☀️' : '🌙';
        }
        try { localStorage.setItem(THEME_KEY, theme); } catch (e) { /* ignore */ }
    }

    function initTheme() {
        var saved = null;
        try { saved = localStorage.getItem(THEME_KEY); } catch (e) { /* ignore */ }
        var theme = saved || (mql && mql.matches ? 'dark' : 'light');
        applyTheme(theme);
    }

    var themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            var cur = document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
            applyTheme(cur === 'dark' ? 'light' : 'dark');
        });
    }
    if (mql && mql.addEventListener) {
        mql.addEventListener('change', function (e) {
            var saved = null;
            try { saved = localStorage.getItem(THEME_KEY); } catch (err) { /* ignore */ }
            if (!saved) applyTheme(e.matches ? 'dark' : 'light');
        });
    }
    initTheme();

    /* ---------- 工具数据（注册表注入，供搜索使用） ---------- */
    var TOOLS = [];
    if (window.TOOLS_DATA && window.TOOLS_DATA.length) {
        TOOLS = window.TOOLS_DATA;
    }

    /* ---------- 首页搜索过滤 ---------- */
    var homeSearch = document.getElementById('homeSearch');
    var homeCats = document.getElementById('homeCats');
    var homeEmpty = document.getElementById('homeEmpty');
    var homeClear = document.getElementById('homeSearchClear');

    if (homeSearch && homeCats) {
        homeSearch.addEventListener('input', function () {
            var kw = homeSearch.value.trim().toLowerCase();
            var catCards = homeCats.querySelectorAll('.home-cat');
            var visible = 0;

            if (homeClear) homeClear.style.display = kw ? 'block' : 'none';

            catCards.forEach(function (card) {
                var links = card.querySelectorAll('.home-cat-list a');
                var catVisible = false;
                var catName = (card.getAttribute('data-cat') || '').toLowerCase();
                var catMatch = !kw || catName.indexOf(kw) !== -1;

                links.forEach(function (a) {
                    var name = a.textContent.trim().toLowerCase();
                    var href = a.getAttribute('href') || '';
                    var hit = !kw || name.indexOf(kw) !== -1 || href.indexOf(kw) !== -1;
                    a.style.display = hit ? '' : 'none';
                    if (hit) catVisible = true;
                });

                card.style.display = (catVisible || catMatch) ? '' : 'none';
                if (catVisible || catMatch) visible++;
            });

            if (homeEmpty) homeEmpty.style.display = visible ? 'none' : 'block';
        });

        if (homeClear) {
            homeClear.addEventListener('click', function () {
                homeSearch.value = '';
                homeSearch.dispatchEvent(new Event('input'));
                homeSearch.focus();
            });
        }
    }

    /* ---------- 顶部导航搜索 ---------- */
    var topInput = document.getElementById('topSearchInput');
    var topBtn = document.getElementById('topSearchBtn');
    var sd = document.getElementById('searchDropdown');

    function renderTopSearch(kw) {
        if (!sd) return;
        kw = (kw || '').trim().toLowerCase();
        if (!kw || !TOOLS.length) {
            sd.style.display = 'none';
            return;
        }
        var groups = [];
        TOOLS.forEach(function (cat) {
            var hits = cat.items.filter(function (t) {
                return t.name.toLowerCase().indexOf(kw) !== -1 || t.url.toLowerCase().indexOf(kw) !== -1;
            });
            if (hits.length) {
                groups.push({ cat: cat.cat, items: hits.slice(0, 8) });
            }
        });
        if (!groups.length) {
            sd.innerHTML = '<div class="container"><div class="sd-empty">未找到匹配的工具：' + (kw ? kw : '') + '</div></div>';
            sd.style.display = 'block';
            return;
        }
        var html = '<div class="container">';
        groups.forEach(function (g) {
            html += '<div class="sd-group"><div class="sd-title">' + g.cat + '</div>';
            g.items.forEach(function (t) {
                html += '<span class="sd-item"><a href="' + t.url + '">' + t.name + '</a></span>';
            });
            html += '</div>';
        });
        html += '</div>';
        sd.innerHTML = html;
        sd.style.display = 'block';
    }

    if (topInput) {
        topInput.addEventListener('input', function () { renderTopSearch(topInput.value); });
        topInput.addEventListener('focus', function () { renderTopSearch(topInput.value); });
        if (topBtn) {
            topBtn.addEventListener('click', function () {
                var kw = topInput.value.trim();
                if (kw && TOOLS.length) {
                    var hit = TOOLS.reduce(function (acc, cat) { return acc.concat(cat.items); }, [])
                        .filter(function (t) { return t.name.indexOf(kw) !== -1 || t.url.indexOf(kw) !== -1; })[0];
                    if (hit) window.location.href = hit.url;
                    else renderTopSearch(kw);
                }
            });
        }
        document.addEventListener('click', function (e) {
            if (sd && !sd.contains(e.target) && e.target !== topInput && !topInput.contains(e.target)) {
                sd.style.display = 'none';
            }
        });
    }

    /* ---------- 足迹历史 ---------- */
    function initHistory() {
        var box = document.getElementById('visit_history');
        if (!box) return;
        try {
            var key = 'toolbox_history';
            var list = JSON.parse(localStorage.getItem(key) || '[]');
            if (!list.length) return;
            var html = '';
            list.slice(0, 8).forEach(function (item) {
                html += '<a href="' + item.url + '" style="margin-right:10px;color:' + 'inherit' + '">' + item.name + '</a>';
            });
            box.innerHTML = html;
        } catch (e) { /* ignore */ }
    }
    initHistory();

    function recordHistory() {
        try {
            var key = 'toolbox_history';
            var list = JSON.parse(localStorage.getItem(key) || '[]');
            var path = window.location.pathname.replace(/\/+$/, '') + '/';
            var name = document.title.replace(/-.*$/, '').trim() || path;
            list = list.filter(function (i) { return i.url !== path; });
            list.unshift({ url: path, name: name });
            list = list.slice(0, 12);
            localStorage.setItem(key, JSON.stringify(list));
        } catch (e) { /* ignore */ }
    }
    if (window.location.pathname !== '/' && window.location.pathname !== '') {
        recordHistory();
    }

    /* ---------- 工具栏页内增强：复制按钮 ---------- */
    document.addEventListener('click', function (e) {
        var btn = e.target.closest ? e.target.closest('[data-copy]') : null;
        if (!btn) return;
        var target = document.querySelector(btn.getAttribute('data-copy'));
        if (!target) return;
        var text = target.value !== undefined ? target.value : target.textContent;
        var done = function () {
            var old = btn.textContent;
            btn.textContent = '✓ 已复制';
            setTimeout(function () { btn.textContent = old; }, 1500);
        };
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(done, function () { fallbackCopy(text, done); });
        } else {
            fallbackCopy(text, done);
        }
    });

    function fallbackCopy(text, done) {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        try { document.execCommand('copy'); done(); } catch (e) { /* ignore */ }
        document.body.removeChild(ta);
    }

})(window, document, window.jQuery);
