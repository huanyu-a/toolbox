<?php /*a:6:{s:45:"/app/application/index/view/index/random.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.random.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.random.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.random.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css" />
    <link href="/static/style/tool-theme.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><?php echo app('config')->get('web.header'); ?><link rel="canonical" href="<?php echo request()->domain(); ?><?php echo htmlentities((isset($current_url) && ($current_url !== '')?$current_url:'/')); ?>" />
<meta name="robots" content="index,follow" />
<meta property="og:type" content="website" />
<meta property="og:locale" content="zh_CN" />
<meta property="og:site_name" content="<?php echo htmlentities(app('config')->get('web.site.name')); ?>" />
<meta property="og:title" content="<?php echo htmlentities((isset($page_title) && ($page_title !== '')?$page_title:'')); ?>" />
<meta property="og:description" content="<?php echo htmlentities((isset($page_desc) && ($page_desc !== '')?$page_desc:'')); ?>" />
<meta property="og:url" content="<?php echo request()->domain(); ?><?php echo htmlentities((isset($current_url) && ($current_url !== '')?$current_url:'/')); ?>" />
<meta property="og:image" content="<?php echo request()->domain(); ?>/favicon.ico" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo htmlentities((isset($page_title) && ($page_title !== '')?$page_title:'')); ?>" />
<meta name="twitter:description" content="<?php echo htmlentities((isset($page_desc) && ($page_desc !== '')?$page_desc:'')); ?>" />
<?php if(isset($jsonld) && $jsonld != ''): ?><script type="application/ld+json"><?php echo $jsonld; ?></script><?php endif; ?>
</head><body><link href="/static/style/theme-uno.css" rel="stylesheet" type="text/css"/>
<link href="/static/style/topbar.css" rel="stylesheet" type="text/css"/>
<nav class="navbar navbar-default navbar-static-top navbar-fixed-top topbar" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar"><span class="sr-only"><?php echo htmlentities(app('config')->get('web.site.name')); ?></span> <span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="/" title="<?php echo htmlentities(app('config')->get('web.site.name')); ?>"><em class="logo_ico glyphicon glyphicon-wrench"></em><?php echo htmlentities(app('config')->get('web.site.name')); ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" role="navigation">
            <ul class="nav navbar-nav" id="top_menu">
                <?php if(is_array($tools) || $tools instanceof \think\Collection || $tools instanceof \think\Paginator): $i = 0; $__LIST__ = $tools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>
                <li class="dropdown<?php if($cat['cat'] == $current_cat): ?> active<?php endif; if(count($cat['items']) > 6): ?> multi-col<?php endif; ?>" data-cat="<?php echo htmlentities($cat['cat']); ?>" style="--cat-c:var(--tb-c<?php echo htmlentities($key+1); ?>);--cat-bg:var(--tb-c<?php echo htmlentities($key+1); ?>-bg)">
                    <a href="/#cat-<?php echo htmlentities($cat['cat']); ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><?php echo htmlentities($cat['cat']); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu ul-list">
                        <li class="dropdown-header-cat"><span class="dropdown-header-dot" style="background:var(--cat-c)"></span><?php echo htmlentities($cat['cat']); ?><span class="dropdown-header-count"><?php echo htmlentities(count($cat['items'])); ?> 个工具</span></li>
                        <?php if(is_array($cat['items']) || $cat['items'] instanceof \think\Collection || $cat['items'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cat['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tool): $mod = ($i % 2 );++$i;?>
                        <li<?php if($tool['url'] == $current_url): ?> class="cur"<?php endif; ?>><a href="<?php echo htmlentities($tool['url']); ?>"<?php if($tool['accent'] != ''): ?> style="color:<?php echo htmlentities($tool['accent']); ?>"<?php endif; ?>><span class="dropdown-tool-dot" style="background:var(--cat-c)"></span><?php echo htmlentities($tool['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="dropdown more-menu" id="moreMenu" style="display:none;">
                    <a href="javascript:;" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">更多<span class="caret"></span></a>
                    <ul class="dropdown-menu ul-list more-list" id="moreMenuList"></ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-search">
                    <button type="button" class="nav-search-btn" id="topSearchBtn" title="搜索工具" aria-label="搜索工具"><span class="glyphicon glyphicon-search"></span></button>
                </li>
                <li class="nav-theme"><a href="javascript:;" id="themeToggle" class="theme-toggle-btn" title="切换深浅色模式" aria-label="切换深浅色模式"><span class="theme-icon">🌙</span></a></li>
            </ul>
        </div>
    </div>
</nav>
<?php if($current_tool_name != ''): ?>
<div class="crumb-bar">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">首页</a></li>
            <li><?php if($current_cat != ''): ?><a href="/#cat-<?php echo htmlentities($current_cat); ?>"><?php echo htmlentities($current_cat); ?></a><?php else: ?>工具<?php endif; ?></li>
            <li class="active"><?php echo htmlentities($current_tool_name); ?></li>
        </ol>
    </div>
</div>
<?php endif; ?>
<div class="search-pop-mask" id="searchMask" style="display:none;"></div>
<nav class="float-cat-nav" id="floatCatNav" aria-label="分类导航"></nav>
<!-- 移动端悬浮按钮组：分类（右下角，点击展开右侧面板）、搜索/主题（右上角） -->
<div class="fab-mask" id="fabMask" style="display:none;"></div>
<button type="button" class="fab fab-cat" id="fabCatBtn" title="分类导航" aria-label="分类导航" aria-expanded="false"><span class="fab-ico">☰</span></button>
<button type="button" class="fab fab-search" id="fabSearchBtn" title="搜索工具" aria-label="搜索工具"><span class="fab-ico">🔍</span></button>
<button type="button" class="fab fab-theme theme-toggle-btn" id="fabThemeBtn" title="切换深浅色模式" aria-label="切换深浅色模式"><span class="theme-icon">🌙</span></button>
<div class="search-pop" id="searchPop" style="display:none;">
    <div class="container">
        <div class="search-pop-head">
            <input type="text" class="form-control search-pop-input" id="topSearchInput" placeholder="搜索工具，如：json、md5、时间戳…" autocomplete="off">
            <button type="button" class="search-pop-close" id="searchPopClose" aria-label="关闭搜索"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        <div class="search-pop-body" id="searchDropdown"></div>
    </div>
</div>
<script>window.TOOLS_DATA = <?php echo isset($tools) && $tools ? json_encode($tools) : '[]'; ?>;</script>
<?php echo tongji_config_code(); ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script>
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">🎲</span>随机数 / 随机密码生成器</h2>
        <p class="tool-desc">生成指定范围的随机数、随机字符串或高强度随机密码，支持字符集、长度与数量自定义，全程本地生成。</p>
        <ul class="t-tabs" id="rndTabs">
            <li><button type="button" class="t-tab active" data-panel="rndPanel1">随机数 / 字符串</button></li>
            <li><button type="button" class="t-tab" data-panel="rndPanel2">随机密码</button></li>
        </ul>
        <div id="rndPanel1" class="t-panel rnd-panel active">
            <div class="t-row" style="margin-bottom:14px">
                <div class="t-col" style="flex:1;min-width:120px">
                    <label class="t-label" for="rndMin">最小值</label>
                    <input class="t-input" style="width:100%" type="number" id="rndMin" value="1">
                </div>
                <div class="t-col" style="flex:1;min-width:120px">
                    <label class="t-label" for="rndMax">最大值</label>
                    <input class="t-input" style="width:100%" type="number" id="rndMax" value="100">
                </div>
                <div class="t-col" style="flex:1;min-width:120px">
                    <label class="t-label" for="rndCount">生成数量</label>
                    <input class="t-input" style="width:100%" type="number" id="rndCount" value="10" min="1" max="1000">
                </div>
                <div class="t-col" style="flex:1;min-width:120px">
                    <label class="t-label" for="rndType">类型</label>
                    <select class="t-input" style="width:100%" id="rndType">
                        <option value="int">整数</option>
                        <option value="float">小数（2位）</option>
                        <option value="str">随机字符串</option>
                    </select>
                </div>
            </div>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="rndRun">生成</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#rndOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="rndClear">清空</button>
            </div>
            <div class="t-result" id="rndResult"><textarea class="t-area t-area-readonly" id="rndOutput" rows="8" readonly></textarea></div>
            <div class="t-error" id="rndError"></div>
        </div>
        <div id="rndPanel2" class="t-panel rnd-panel">
            <div class="t-options">
                <label><input type="checkbox" id="pwNum" checked> 数字 0-9</label>
                <label><input type="checkbox" id="pwLow" checked> 小写字母 a-z</label>
                <label><input type="checkbox" id="pwUp" checked> 大写字母 A-Z</label>
                <label><input type="checkbox" id="pwPunct" checked> 符号 !@#$%^&*()</label>
            </div>
            <div class="t-row" style="margin-bottom:14px">
                <div class="t-col" style="flex:1;min-width:120px">
                    <label class="t-label" for="pwLen">密码长度</label>
                    <input class="t-input" style="width:100%" type="number" id="pwLen" value="12" min="4" max="64">
                </div>
                <div class="t-col" style="flex:1;min-width:120px">
                    <label class="t-label" for="pwQty">生成数量</label>
                    <input class="t-input" style="width:100%" type="number" id="pwQty" value="5" min="1" max="100">
                </div>
                <div class="t-col" style="flex:1;min-width:120px">
                    <label class="t-label" style="height:32px">&nbsp;</label>
                    <label class="t-label" style="display:inline-flex;align-items:center;gap:6px;font-weight:400"><input type="checkbox" id="pwUnique"> 字符不重复</label>
                </div>
            </div>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="pwRun">生成密码</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#pwOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="pwClear">清空</button>
            </div>
            <div class="t-result" id="pwResult"><textarea class="t-area t-area-readonly" id="pwOutput" rows="8" readonly></textarea></div>
            <div class="t-error" id="pwError"></div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 使用说明</h2>
        <p class="tool-desc">随机数：在最小值和最大值之间生成随机整数（含两端）、两位小数或字母数字随机串。随机密码：按勾选的字符集生成高强度密码，保证每种字符集至少出现一次，支持「字符不重复」与批量生成。本工具优先使用浏览器密码学级随机源（crypto.getRandomValues），不支持时自动降级到 Math.random。</p>
    </div>
</div></div>
<div class="container foot-history" id="foot-history">
    <div class="row">
        <div class="col-md-12"><span>您的足迹：</span><span id="visit_history"></span></div>
    </div>
</div>
<?php if($act != 'index'): ?>
<div class="container foot-nav-wrap">
    <div class="row">
        <div class="col-md-12 footer-nav">
            <h2>常用工具推荐</h2>
            <div class="list-inline-bg">
                <ul class="list-inline rand-tools">
                    <?php if(is_array($randTools) || $randTools instanceof \think\Collection || $randTools instanceof \think\Paginator): $i = 0; $__LIST__ = $randTools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tool): $mod = ($i % 2 );++$i;?>
                    <li><span></span><a href="<?php echo htmlentities($tool['url']); ?>"<?php if($tool['accent'] != ''): ?> style="color:<?php echo htmlentities($tool['accent']); ?>"<?php endif; ?>><?php echo htmlentities($tool['name']); ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="copyright" id="footer">
    <div class="container">
        <?php if($act == 'index'): ?>
        <div class="friend-link-row">
    友情链接：
    <a href="https://hub.openeeds.com/" target="_blank" rel="nofollow noopener">Docker镜像加速</a>
    <span class="fl-sep">|</span>
    <a href="https://docker.openeeds.com/" target="_blank" rel="nofollow noopener">国内DockerHub</a>
    <span class="fl-sep">|</span>
    <a href="https://www.cyberguard.best/#/register?code=PxOrTfcH" target="_blank" rel="nofollow noopener">推荐机场</a>
</div>

        <?php endif; ?>
        <div class="row">
            <div class="col-sm-12"><span>Copyright ©2024-<?php echo htmlentities(date('Y',!is_numeric(date('Y-m-d g:i a',time()))? strtotime(date('Y-m-d g:i a',time())) : date('Y-m-d g:i a',time()))); ?> <a href="/"><?php echo htmlentities(app('config')->get('web.site.name')); ?></a></span><!-- | <span><a
                    href="https://beian.miit.gov.cn/" target="_blank" rel="nofollow">粤ICP备2021140346号</a></span>--></div>
        </div>
    </div>
</div>
<a class="gotop" href="#top" title="返回顶部" style="display: none;"><span class="arrow"></span><span class="arrow lit"></span></a>
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/toolbox.js"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script>
(function () {
    // Tab 切换（与其他聚合页一致）
    var tabs = document.querySelectorAll('#rndTabs .t-tab');
    var panels = document.querySelectorAll('.rnd-panel');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            panels.forEach(function (p) { p.classList.remove('active'); });
            btn.classList.add('active');
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
        });
    });

    /* ---- 随机源（两个面板共用）：优先 crypto.getRandomValues，不支持时降级 Math.random ---- */
    var hasCrypto = !!(window.crypto && window.crypto.getRandomValues);
    function csUint32() {
        if (hasCrypto) {
            var arr = new Uint32Array(1);
            window.crypto.getRandomValues(arr);
            return arr[0];
        }
        return Math.floor(Math.random() * 0x100000000);
    }
    // [min, max] 闭区间均匀整数（拒绝采样消除取模偏差）
    function randInt(min, max) {
        if (max <= min) return min;
        var range = max - min + 1;
        if (hasCrypto) {
            var limit = Math.floor(0x100000000 / range) * range;
            var x;
            do { x = csUint32(); } while (x >= limit);
            return min + (x % range);
        }
        return min + Math.floor(Math.random() * range);
    }
    // [min, max) 均匀小数
    function randFloat(min, max) {
        return min + (csUint32() / 0x100000000) * (max - min);
    }
    // 从字符池随机取 len 个字符
    function randStr(len, pool) {
        var out = '';
        for (var i = 0; i < len; i++) out += pool.charAt(randInt(0, pool.length - 1));
        return out;
    }
    // Fisher-Yates 洗牌
    function shuffleArr(a) {
        for (var i = a.length - 1; i > 0; i--) {
            var j = randInt(0, i);
            var t = a[i]; a[i] = a[j]; a[j] = t;
        }
        return a;
    }

    /* ---- 面板1：随机数 / 字符串 ---- */
    var err1 = document.getElementById('rndError');
    function showErr1(m) { err1.textContent = m; err1.classList.add('show'); }
    document.getElementById('rndRun').addEventListener('click', function () {
        err1.classList.remove('show');
        var min = parseFloat(document.getElementById('rndMin').value);
        var max = parseFloat(document.getElementById('rndMax').value);
        var count = parseInt(document.getElementById('rndCount').value, 10);
        var type = document.getElementById('rndType').value;
        if (isNaN(min) || isNaN(max)) { showErr1('请填写有效的数值范围'); return; }
        if (min > max) { showErr1('最小值不能大于最大值'); return; }
        if (isNaN(count) || count < 1) count = 1;
        if (count > 1000) count = 1000;
        var list = [];
        for (var i = 0; i < count; i++) {
            if (type === 'int') list.push(randInt(Math.ceil(min), Math.floor(max)));
            else if (type === 'float') list.push(randFloat(min, max).toFixed(2));
            else list.push(randStr(randInt(6, 16), 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'));
        }
        document.getElementById('rndOutput').value = list.join('\n');
        document.getElementById('rndResult').classList.add('show');
    });
    document.getElementById('rndClear').addEventListener('click', function () {
        document.getElementById('rndOutput').value = '';
        document.getElementById('rndResult').classList.remove('show');
        err1.classList.remove('show');
    });
    /* ---- 面板2：随机密码 ---- */
    var err2 = document.getElementById('pwError');
    function showErr2(m) { err2.textContent = m; err2.classList.add('show'); }
    document.getElementById('pwRun').addEventListener('click', function () {
        err2.classList.remove('show');
        var sets = [];
        if (document.getElementById('pwNum').checked) sets.push('0123456789');
        if (document.getElementById('pwLow').checked) sets.push('abcdefghijklmnopqrstuvwxyz');
        if (document.getElementById('pwUp').checked) sets.push('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        if (document.getElementById('pwPunct').checked) sets.push('!@#$%^&*()-_=+[]{}|;:,.<>?');
        if (!sets.length) { showErr2('请至少勾选一种字符集'); return; }
        var len = parseInt(document.getElementById('pwLen').value, 10);
        var qty = parseInt(document.getElementById('pwQty').value, 10);
        var unique = document.getElementById('pwUnique').checked;
        if (isNaN(len) || len < 4) len = 12;
        if (len > 64) len = 64;
        if (isNaN(qty) || qty < 1) qty = 1;
        if (qty > 100) qty = 100;
        if (unique && len > sets.join('').length) { showErr2('字符不重复时长度不能超过字符集大小'); return; }
        var all = sets.join('');
        var out = [];
        for (var i = 0; i < qty; i++) {
            // 先保证每种勾选的字符集至少出现一次，再填充剩余长度并洗牌
            var pw = [];
            for (var s = 0; s < sets.length; s++) {
                pw.push(sets[s].charAt(randInt(0, sets[s].length - 1)));
            }
            if (unique) {
                var pool = all.split('');
                for (var p = 0; p < pw.length; p++) {
                    var ri = pool.indexOf(pw[p]);
                    if (ri >= 0) pool.splice(ri, 1);
                }
                while (pw.length < len) {
                    var ri2 = randInt(0, pool.length - 1);
                    pw.push(pool[ri2]);
                    pool.splice(ri2, 1);
                }
            } else {
                while (pw.length < len) pw.push(all.charAt(randInt(0, all.length - 1)));
            }
            out.push(shuffleArr(pw).join(''));
        }
        document.getElementById('pwOutput').value = out.join('\n');
        document.getElementById('pwResult').classList.add('show');
    });
    document.getElementById('pwClear').addEventListener('click', function () {
        document.getElementById('pwOutput').value = '';
        document.getElementById('pwResult').classList.remove('show');
        err2.classList.remove('show');
    });
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
