/* ============================================================
   在线工具箱 前端重构 (app.js)
   深色模式 / 首页搜索 / 顶部导航搜索 / 足迹历史
   ============================================================ */
(function (window, document, $) {
    'use strict';

    /* ---------- 深色模式（三态：light / dark / auto） ---------- */
    var THEME_KEY = 'toolbox_theme';
    var mql = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;

    function savedMode() {
        try { return localStorage.getItem(THEME_KEY); } catch (e) { return null; }
    }
    function resolvedTheme() {
        var m = savedMode();
        if (m !== 'light' && m !== 'dark') m = 'auto';
        if (m === 'auto') return (mql && mql.matches) ? 'dark' : 'light';
        return m;
    }
    function applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
        }
        var mode = savedMode() || 'auto';
        var icons = document.querySelectorAll('.theme-toggle-btn .theme-icon');
        icons.forEach(function (icon) {
            var cls = mode === 'auto' ? 'fa-circle-half-stroke'
                    : (theme === 'dark' ? 'fa-sun' : 'fa-moon');
            var i = icon.querySelector('i');
            if (i) { i.className = 'fa-solid ' + cls; }
            else { icon.innerHTML = '<i class="fa-solid ' + cls + '"></i>'; }
            var wrap = icon.closest('button') || icon;
            var label = mode === 'auto' ? '当前：跟随系统'
                      : mode === 'dark' ? '当前：深色模式' : '当前：浅色模式';
            if (wrap.setAttribute) wrap.setAttribute('title', label + '（点击切换）');
        });
        syncSeg(savedMode() || 'auto');
    }

    /* 分段式主题切换器（浅/深/跟随系统）状态同步 */
    function syncSeg(mode) {
        var segEl = document.getElementById('themeSeg');
        if (!segEl) return;
        segEl.querySelectorAll('button').forEach(function (b) {
            b.classList.toggle('on', b.getAttribute('data-mode') === mode);
        });
    }
    function setTheme(mode) {
        try { localStorage.setItem(THEME_KEY, mode); } catch (e) { /* ignore */ }
        applyTheme(resolvedTheme());
    }

    function initTheme() {
        applyTheme(resolvedTheme());
    }

    /* 分段切换器事件 */
    var themeSegEl = document.getElementById('themeSeg');
    if (themeSegEl) {
        themeSegEl.addEventListener('click', function (e) {
            var btn = e.target.closest('button[data-mode]');
            if (btn) setTheme(btn.getAttribute('data-mode'));
        });
    }
    var themeToggles = document.querySelectorAll('.theme-toggle-btn');
    /* FAB 单按钮：三态循环 浅色 -> 深色 -> 跟随系统 */
    themeToggles.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var order = ['light', 'dark', 'auto'];
            var cur = savedMode() || 'auto';
            setTheme(order[(order.indexOf(cur) + 1) % 3]);
        });
    });
    if (mql && mql.addEventListener) {
        mql.addEventListener('change', function () {
            if ((savedMode() || 'auto') === 'auto') applyTheme(resolvedTheme());
        });
    }
    initTheme();

    /* ---------- 导航滚动玻璃态 ---------- */
    (function () {
        var navEl = document.querySelector('.topbar');
        if (!navEl) return;
        var navTick = false;
        var updateNav = function () {
            navEl.classList.toggle('scrolled', (window.pageYOffset || document.documentElement.scrollTop) > 6);
            navTick = false;
        };
        window.addEventListener('scroll', function () {
            if (!navTick) { navTick = true; requestAnimationFrame(updateNav); }
        }, { passive: true });
        updateNav();
    })();

    /* ---------- 滚动入场动画（首页区块渐次浮现） ---------- */
    (function () {
        if (!('IntersectionObserver' in window)) return;
        if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        var targets = document.querySelectorAll(
            '.home-badge,.home-title,.home-sub,.home-search,.home-hot,' +
            '.home-feature,.home-section-title,.home-section-sub,.home-cat-card,.home-step,.home-cta-inner,' +
            '.home-stat,.home-band-txt,.home-band-card,.faq-item'
        );
        targets.forEach(function (el) { el.classList.add('rv'); });
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) {
                    en.target.classList.add('rv-in');
                    io.unobserve(en.target);
                }
            });
        }, { threshold: .12, rootMargin: '0px 0px -40px 0px' });
        targets.forEach(function (el) { io.observe(el); });
    })();

    /* ---------- 数字滚动计数（data-count 元素，进入视口时播放） ---------- */
    (function () {
        if (!('IntersectionObserver' in window)) return;
        var nums = document.querySelectorAll('[data-count]');
        if (!nums.length) return;
        var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var paint = function (el, v) {
            el.textContent = String(v) + (el.getAttribute('data-suffix') || '');
        };
        var run = function (el) {
            var target = parseInt(el.getAttribute('data-count'), 10) || 0;
            if (reduce || target === 0) { paint(el, target); return; }
            var t0 = null, DUR = 1100;
            var step = function (ts) {
                if (!t0) t0 = ts;
                var k = Math.min(1, (ts - t0) / DUR);
                k = 1 - Math.pow(1 - k, 3); // easeOutCubic
                paint(el, Math.round(target * k));
                if (k < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        };
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) { run(en.target); io.unobserve(en.target); }
            });
        }, { threshold: .4 });
        nums.forEach(function (el) { io.observe(el); });
    })();

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

    function toolsLookup() {
        // url 归一化反查表：'/json/' -> {name, desc, cat}
        var map = {};
        TOOLS.forEach(function (cat) {
            (cat.items || []).forEach(function (t) {
                var key = (t.url || '').replace(/^https?:\/\/[^\/]+/i, '').replace(/\/+$/, '') + '/';
                map[key] = { name: t.name, desc: t.desc || '', cat: cat.cat, url: t.url };
            });
        });
        return map;
    }

    function recentList() {
        try {
            var list = JSON.parse(localStorage.getItem('toolbox_history') || '[]');
            return Array.isArray(list) ? list.slice(0, 8) : [];
        } catch (e) { return []; }
    }

    /* ---------- 顶部导航搜索（弹窗，列表式 + 键盘导航） ---------- */
    var topBtn = document.getElementById('topSearchBtn');
    var topInput = document.getElementById('topSearchInput');
    var searchPop = document.getElementById('searchPop');
    var searchMask = document.getElementById('searchMask');
    var searchClose = document.getElementById('searchPopClose');
    var sd = document.getElementById('searchDropdown');
    var sdHits = [];      // 当前渲染结果（扁平，供键盘导航）
    var sdActive = 0;     // 当前高亮下标

    function sdRenderRow(t) {
        return '<a class="sd-row" href="' + t.url + '" data-idx="' + t._i + '">'
            + '<span class="sd-row-main"><span class="sd-row-name">' + t.name + '</span>'
            + '<span class="sd-row-desc">' + t.desc + '</span></span>'
            + '<span class="sd-row-cat">' + t.cat + '</span></a>';
    }

    function sdRefresh() {
        var rows = sd ? sd.querySelectorAll('.sd-row') : [];
        rows.forEach(function (r) {
            r.classList.toggle('active', Number(r.getAttribute('data-idx')) === sdActive);
        });
        var cur = sd ? sd.querySelector('.sd-row.active') : null;
        if (cur && cur.scrollIntoView) cur.scrollIntoView({ block: 'nearest' });
    }

    function sdMove(delta) {
        if (!sdHits.length) return;
        sdActive = (sdActive + delta + sdHits.length) % sdHits.length;
        sdRefresh();
    }

    function renderTopSearch(kw) {
        if (!sd) return;
        kw = (kw || '').trim().toLowerCase();
        sdHits = [];
        var html = '';
        var lookup = toolsLookup();

        if (!kw) {
            // 空关键词：最近使用 + 提示
            var recent = recentList();
            if (recent.length) {
                html += '<div class="sd-list"><div class="sd-list-title"><i class="fa-solid fa-clock-rotate-left"></i> 最近使用</div>';
                recent.forEach(function (item) {
                    var info = lookup[item.url] || {};
                    sdHits.push({ url: item.url, name: item.name, desc: info.desc || '', cat: info.cat || '最近' });
                });
                sdHits.forEach(function (t, i) { t._i = i; html += sdRenderRow(t); });
                html += '</div>';
            }
            html += '<div class="sd-hint">输入关键词搜索全部 ' + TOOLS.reduce(function (n, c) { return n + (c.items || []).length; }, 0) + ' 个工具</div>';
            sd.innerHTML = html;
            sdActive = 0;
            sdRefresh();
            return;
        }

        TOOLS.forEach(function (cat) {
            var hits = (cat.items || []).filter(function (t) {
                var u = (t.url || '').replace(/^https?:\/\/[^\/]+/i, '');
                return t.name.toLowerCase().indexOf(kw) !== -1
                    || u.toLowerCase().indexOf(kw) !== -1
                    || (t.desc || '').toLowerCase().indexOf(kw) !== -1
                    || cat.cat.toLowerCase().indexOf(kw) !== -1;
            });
            hits.slice(0, 6).forEach(function (t) {
                sdHits.push({ url: t.url, name: t.name, desc: t.desc || '', cat: cat.cat });
            });
        });
        // 按分类分组渲染（保持命中顺序）
        var groups = {};
        sdHits.forEach(function (t, i) { t._i = i; (groups[t.cat] = groups[t.cat] || []).push(t); });
        var finalHtml = '';
        Object.keys(groups).forEach(function (catName) {
            finalHtml += '<div class="sd-list"><div class="sd-list-title">' + catName + '</div>';
            groups[catName].forEach(function (t) { finalHtml += sdRenderRow(t); });
            finalHtml += '</div>';
        });
        sd.innerHTML = sdHits.length ? finalHtml : '<div class="sd-empty">未找到匹配的工具，换个关键词试试</div>';
        sdActive = 0;
        sdRefresh();
    }

    function openSearch() {
        if (!searchPop) return;
        searchPop.style.display = 'block';
        if (searchMask) searchMask.style.display = 'block';
        if (topInput) {
            topInput.value = '';
            renderTopSearch('');
            setTimeout(function () { topInput.focus(); }, 30);
        }
    }

    function closeSearch() {
        if (searchPop) searchPop.style.display = 'none';
        if (searchMask) searchMask.style.display = 'none';
    }

    if (topBtn) {
        topBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            openSearch();
        });
    }
    var fabSearchBtn = document.getElementById('fabSearchBtn');
    if (fabSearchBtn) {
        fabSearchBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            openSearch();
        });
    }
    if (searchClose) searchClose.addEventListener('click', closeSearch);
    if (searchMask) searchMask.addEventListener('click', closeSearch);
    if (sd) {
        sd.addEventListener('mouseover', function (e) {
            var row = e.target.closest ? e.target.closest('.sd-row') : null;
            if (!row) return;
            sdActive = Number(row.getAttribute('data-idx')) || 0;
            sdRefresh();
        });
    }
    document.addEventListener('keydown', function (e) {
        var popOpen = searchPop && searchPop.style.display === 'block';
        // 键盘导航：弹窗打开时 ↑↓ 移动高亮、Enter 跳转
        if (popOpen && sdHits.length) {
            if (e.key === 'ArrowDown') { e.preventDefault(); sdMove(1); return; }
            if (e.key === 'ArrowUp') { e.preventDefault(); sdMove(-1); return; }
            if (e.key === 'Enter' && !e.isComposing) {
                var hit = sdHits[sdActive];
                if (hit) { e.preventDefault(); window.location.href = hit.url; return; }
            }
        }
        // 全局快捷键：Ctrl/⌘+K 呼出搜索（首页已有聚焦逻辑，跳过）；'/' 呼出
        if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
            if (document.getElementById('homeSearch')) return; // 首页由页内脚本聚焦 hero 搜索框
            e.preventDefault();
            popOpen ? closeSearch() : openSearch();
            return;
        }
        if (e.key === '/' && !popOpen) {
            var t = e.target;
            var tag = t && t.tagName ? t.tagName.toLowerCase() : '';
            if (tag === 'input' || tag === 'textarea' || tag === 'select' || (t && t.isContentEditable)) return;
            e.preventDefault();
            openSearch();
        }
        if (e.key === 'Escape') {
            closeSearch();
            closeCatNav();
        }
    });
    if (topInput) {
        topInput.addEventListener('input', function () { renderTopSearch(topInput.value); });
        topInput.addEventListener('keydown', function (e) {
            // ↑↓/Enter 由全局键盘导航处理；这里处理 IME 组合态下的 Enter（不跳转）
            if (e.key === 'Enter' && e.isComposing) e.preventDefault();
        });
    }

    /* ---------- 响应式导航：溢出分类自动折叠进“更多” ---------- */
    var moreMenu = document.getElementById('moreMenu');
    var moreList = document.getElementById('moreMenuList');
    var topMenu = document.getElementById('top_menu');
    var moreTimer = null;

    function cloneCatToMore(li) {
        var catName = li.getAttribute('data-cat') || '';
        var isActive = li.className.indexOf('active') !== -1;
        var wrap = document.createElement('div');
        wrap.className = 'more-group' + (isActive ? ' active' : '');
        var title = document.createElement('div');
        title.className = 'more-group-title';
        title.textContent = catName;
        wrap.appendChild(title);
        var items = li.querySelectorAll('.dropdown-menu > li > a');
        items.forEach(function (a) {
            var item = document.createElement('div');
            item.className = 'more-group-item';
            var link = document.createElement('a');
            link.href = a.getAttribute('href');
            link.textContent = a.textContent;
            if (a.style.color) link.style.color = a.style.color;
            if (a.parentNode && a.parentNode.className.indexOf('cur') !== -1) link.className = 'cur';
            item.appendChild(link);
            wrap.appendChild(item);
        });
        moreList.appendChild(wrap);
    }

    function layoutMore() {
        if (!topMenu || !moreMenu) return;
        if (window.innerWidth < 992) {
            moreMenu.style.display = 'none';
            Array.prototype.forEach.call(topMenu.querySelectorAll('li[data-cat]'), function (li) {
                li.style.display = '';
            });
            return;
        }
        // 先恢复所有分类，重新测量
        var cats = Array.prototype.filter.call(topMenu.children, function (li) {
            return li.getAttribute && li.getAttribute('data-cat');
        });
        cats.forEach(function (li) { li.style.display = ''; });
        moreList.innerHTML = '';
        moreMenu.style.display = '';

        var nav = topMenu.closest ? topMenu.closest('.navbar-collapse') : null;
        var rightUl = nav ? nav.querySelector('.navbar-right') : null;
        var avail = (nav ? nav.clientWidth : 0) - (rightUl ? rightUl.offsetWidth : 0) - 80;
        if (avail <= 0) return;

        var total = 0;
        cats.forEach(function (li) { total += li.offsetWidth; });
        var moreW = moreMenu.offsetWidth || 70;

        var hidden = [];
        // 从后往前折叠，直到放得下
        while (total + moreW > avail && cats.length > 1) {
            var last = cats.pop();
            total -= last.offsetWidth;
            last.style.display = 'none';
            hidden.unshift(last);
        }
        moreMenu.style.display = hidden.length ? '' : 'none';
        if (hidden.length) {
            hidden.forEach(function (li) { cloneCatToMore(li); });
        }
    }

    if (moreMenu && topMenu) {
        layoutMore();
        window.addEventListener('resize', function () {
            clearTimeout(moreTimer);
            moreTimer = setTimeout(layoutMore, 150);
        });
        document.addEventListener('click', function () {
            clearTimeout(moreTimer);
            moreTimer = setTimeout(layoutMore, 150);
        });
    }

    /* ---------- 移动端悬浮按钮组：分类面板 / 搜索 / 主题 ---------- */
    var fabCatBtn = document.getElementById('fabCatBtn');
    var fabMask = document.getElementById('fabMask');
    var fabCatIcon = fabCatBtn ? fabCatBtn.querySelector('.fab-ico') : null;

    function openCatNav() {
        if (floatNav) floatNav.classList.add('open');
        if (fabMask) fabMask.style.display = 'block';
        if (fabCatBtn) fabCatBtn.classList.add('active');
        if (fabCatIcon) fabCatIcon.textContent = '✕';
        if (fabCatBtn) fabCatBtn.setAttribute('aria-expanded', 'true');
    }

    function closeCatNav() {
        if (floatNav) floatNav.classList.remove('open');
        if (fabMask) fabMask.style.display = 'none';
        if (fabCatBtn) fabCatBtn.classList.remove('active');
        if (fabCatIcon) fabCatIcon.textContent = '☰';
        if (fabCatBtn) fabCatBtn.setAttribute('aria-expanded', 'false');
    }

    if (fabCatBtn) {
        fabCatBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (window.innerWidth >= 992) return; // 桌面端不显示，兜底忽略
            if (floatNav && floatNav.classList.contains('open')) {
                closeCatNav();
            } else {
                openCatNav();
            }
        });
    }
    if (fabMask) fabMask.addEventListener('click', closeCatNav);
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) closeCatNav();
    });

    /* ---------- 移动端右侧悬浮分类面板（点击展开/收起） ---------- */
    var floatNav = document.getElementById('floatCatNav');
    if (floatNav && TOOLS.length) {
        var isHome = window.location.pathname === '/' || window.location.pathname === '';
        // 当前分类（工具页高亮）
        var currentCat = '';
        var activeLi = topMenu ? topMenu.querySelector('li.active[data-cat]') : null;
        if (activeLi) currentCat = activeLi.getAttribute('data-cat') || '';

        TOOLS.forEach(function (cat, catIdx) {
            var catId = 'cat-' + cat.cat;
            var a = document.createElement('a');
            a.className = 'float-cat-item' + (cat.cat === currentCat ? ' active' : '');
            a.textContent = cat.cat;
            a.href = (isHome ? '#' : '/#') + catId;
            a.setAttribute('data-cat', cat.cat);
            a.addEventListener('click', function (e) {
                closeCatNav(); // 点击分类后收起面板
                if (!isHome) return; // 非首页直接跳转
                e.preventDefault();
                // 首页：找到对应分类卡片并展开手风琴 + 滚动到位
                var card = document.querySelector('.home-cat-card[data-cat="' + cat.cat + '"]');
                if (!card) return;
                // 关闭其他展开的卡片
                document.querySelectorAll('.home-cat-card.open').forEach(function (c) {
                    if (c !== card) c.classList.remove('open');
                });
                // 展开当前卡片
                card.classList.add('open');
                // 高亮当前点击的分类
                floatNav.querySelectorAll('.float-cat-item').forEach(function (item) {
                    item.classList.toggle('active', item === a);
                });
                // 滚动到卡片位置（留 70px 顶栏空间）
                try {
                    card.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } catch (err) {
                    var y = card.getBoundingClientRect().top + (window.pageYOffset || document.documentElement.scrollTop) - 70;
                    window.scrollTo(0, Math.max(0, y));
                }
            });
            floatNav.appendChild(a);
        });

        // 首页：滚动监听高亮当前分类（scrollspy）
        if (isHome && 'IntersectionObserver' in window) {
            var catSections = document.querySelectorAll('.home-cat-card');
            var spyObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    var id = entry.target.getAttribute('id') || '';
                    var name = entry.target.getAttribute('data-cat') || id.replace(/^cat-/, '');
                    floatNav.querySelectorAll('.float-cat-item').forEach(function (item) {
                        item.classList.toggle('active', item.getAttribute('data-cat') === name);
                    });
                });
            }, { rootMargin: '-40% 0px -55% 0px', threshold: 0 });
            catSections.forEach(function (sec) { spyObserver.observe(sec); });
        }
    }

    /* ---------- 足迹历史 ---------- */
    function initHistory() {
        var box = document.getElementById('visit_history');
        if (box) {
            try {
                var list = recentList();
                if (list.length) {
                    var html = '';
                    list.slice(0, 8).forEach(function (item) {
                        html += '<a href="' + item.url + '" style="margin-right:10px;color:' + 'inherit' + '">' + item.name + '</a>';
                    });
                    box.innerHTML = html;
                }
            } catch (e) { /* ignore */ }
        }
        // 首页「最近使用」区块：有足迹才显示
        var recentWrap = document.getElementById('homeRecentWrap');
        var recentListEl = document.getElementById('homeRecentList');
        if (recentWrap && recentListEl) {
            var recents = recentList();
            if (recents.length) {
                var lookup = toolsLookup();
                var chipsHtml = '';
                recents.slice(0, 8).forEach(function (item) {
                    var info = lookup[item.url] || {};
                    chipsHtml += '<a class="home-recent-chip" href="' + item.url + '" title="' + (info.desc || item.name) + '">'
                        + '<span class="home-recent-chip-name">' + item.name + '</span>'
                        + (info.cat ? '<span class="home-recent-chip-cat">' + info.cat + '</span>' : '')
                        + '<i class="fa-solid fa-arrow-right home-recent-chip-go"></i></a>';
                });
                recentListEl.innerHTML = chipsHtml;
                recentWrap.hidden = false;
            }
        }
    }
    initHistory();

    /* ---------- 404 页搜索桥接：hero 搜索框直接驱动搜索弹窗 ---------- */
    (function () {
        var bridge = document.getElementById('e404SearchBridge');
        if (!bridge || !topInput) return;
        var input = document.getElementById('homeSearch');
        if (!input) return;
        input.addEventListener('focus', function () { openSearch(); });
        input.addEventListener('input', function () {
            if (searchPop && searchPop.style.display !== 'block') openSearch();
            topInput.value = input.value;
            renderTopSearch(topInput.value);
        });
    })();

    function recordHistory() {
        try {
            var key = 'toolbox_history';
            var list = JSON.parse(localStorage.getItem(key) || '[]');
            var path = window.location.pathname.replace(/\/+$/, '') + '/';
            // 优先用工具名称（TOOLS_DATA 注册表反查，URL 归一化后比对），找不到再回退页面标题
            var name = '';
            var norm = function (u) {
                return (u || '').replace(/^https?:\/\/[^\/]+/i, '').replace(/\/+$/, '') + '/';
            };
            try {
                var cats = window.TOOLS_DATA || [];
                for (var ci = 0; ci < cats.length; ci++) {
                    var items = cats[ci].items || [];
                    for (var ii = 0; ii < items.length; ii++) {
                        if (norm(items[ii].url) === path) { name = items[ii].name; break; }
                    }
                    if (name) break;
                }
            } catch (e) { /* ignore */ }
            if (!name) name = document.title.replace(/-.*$/, '').trim() || path;
            list = list.filter(function (i) { return i.url !== path; });
            list.unshift({ url: path, name: name });
            list = list.slice(0, 12);
            localStorage.setItem(key, JSON.stringify(list));
        } catch (e) { /* ignore */ }
    }
    if (window.location.pathname !== '/' && window.location.pathname !== '') {
        recordHistory();
    }

    /* ---------- 返回顶部 ---------- */
    var gotop = document.querySelector('.gotop');
    if (gotop) {
        var onScroll = function () {
            var show = (window.pageYOffset || document.documentElement.scrollTop) > 300;
            gotop.style.display = show ? 'block' : 'none';
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
        gotop.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
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

    /* ---------- 顶栏下拉菜单：纯 CSS hover 展开，点击分类名跳转 ---------- */
    var navDropdowns = document.querySelectorAll('.topbar .navbar-nav > li.dropdown');
    var isHome = window.location.pathname === '/' || window.location.pathname === '';
    navDropdowns.forEach(function (li) {
        var toggle = li.querySelector('.dropdown-toggle');
        if (!toggle) return;
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            // 首页：局部展开手风琴，不刷新页面
            if (isHome) {
                var catName = li.getAttribute('data-cat') || '';
                if (!catName) return;
                var card = document.querySelector('.home-cat-card[data-cat="' + catName + '"]');
                if (!card) return;
                document.querySelectorAll('.home-cat-card.open').forEach(function (c) {
                    if (c !== card) c.classList.remove('open');
                });
                card.classList.add('open');
                var y = card.getBoundingClientRect().top + (window.pageYOffset || document.documentElement.scrollTop) - 70;
                window.scrollTo({ top: Math.max(0, y), behavior: 'smooth' });
            } else {
                // 工具页：跳转到首页对应分类
                window.location.href = toggle.getAttribute('href');
            }
        });
    });

})(window, document, window.jQuery);
