<?php /*a:6:{s:41:"/app/application/index/view/index/ip.html";i:1787131994;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.ip.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.ip.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.ip.description')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.ip.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
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
        <h2 class="tool-title"><span class="t-ico">🌐</span>IP 查询 / 转换</h2>
        <p class="tool-desc">IP 地址归属地查询、本机 IP 信息展示，以及 IPv4 地址与 32 位数字地址互转，全部本地计算、结果可一键复制。</p>
        <ul class="t-tabs" id="ipTabs">
            <li><button type="button" class="t-tab active" data-panel="ipPanel1">归属地查询</button></li>
            <li><button type="button" class="t-tab" data-panel="ipPanel2">IP / 数字互转</button></li>
        </ul>
        <div id="ipPanel1" class="t-panel active">
            <form id="ip" method="post">
            <div class="t-row" style="margin-bottom:12px">
                <div class="t-col" style="flex:1">
                    <input class="t-input" style="width:100%" type="text" id="ip_address" name="ip" placeholder="输入查询的 IP 或域名" value="<?php echo htmlentities((isset($ym['ip']) && ($ym['ip'] !== '')?$ym['ip']:'')); ?>" />
                </div>
                <div class="t-col" style="flex:0 0 auto">
                    <button class="t-btn" type="button" id="ipQueryBtn">查询</button>
                </div>
            </div>
            </form>
            <?php if(isset($ym)): ?>
            <div class="t-result show">
                <p class="t-result-label">IP/域名 [<?php echo htmlentities($ym['ip']); ?>] 的位置信息</p>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr><td class="text-c">IP/域名</td><td class="text-c">获取到的IP地址</td><td class="text-c">数字地址</td><td class="text-c">所处IP段范围</td><td class="text-c">IP的物理位置</td></tr>
                        <tr><td class="text-c"><?php echo htmlentities($ym['ip']); ?></td><td class="text-c"><?php echo htmlentities($ym['domain']); ?></td><td class="text-c"><?php echo htmlentities(ip2long($ym['domain'])); ?></td><td class="text-c"><?php echo htmlentities($ym['fw']); ?></td><td class="text-c"><?php echo htmlentities($ym['city']); ?></td></tr>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="t-error" id="ipErr"></div>
            <?php endif; ?>
            <div class="t-result show" style="margin-top:14px;background:linear-gradient(135deg,#f0f6ff,#eef9f0)">
                <p class="t-result-label">我的当前 IP</p>
                <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap">
                    <span style="font-size:30px;font-weight:700;color:var(--brand,#337ab7);font-family:Consolas,Menlo,monospace" id="myIpText"><?php echo htmlentities($getip); ?></span>
                    <button class="t-copy" type="button" data-copy="#myIpText" style="font-size:13px">复制 IP</button>
                </div>
                <p style="font-size:13px;color:var(--text-2);margin:8px 0 0">归属地：<?php echo htmlentities($city); ?> ｜ 操作系统：<?php echo htmlentities($getBrowserOs['0']); ?> ｜ 浏览器：<?php echo htmlentities($getBrowserOs['1']); ?></p>
            </div>
        </div>
        <div id="ipPanel2" class="t-panel">
            <div class="t-row" style="margin-bottom:12px">
                <div class="t-col" style="flex:1">
                    <label class="t-label" for="ipv4Input">IPv4 地址</label>
                    <input class="t-input" style="width:100%" type="text" id="ipv4Input" placeholder="如 192.168.1.1">
                </div>
                <div class="t-col" style="flex:0 0 auto">
                    <label class="t-label">&nbsp;</label>
                    <button class="t-btn" type="button" id="ipv42long">→ 数字地址</button>
                </div>
            </div>
            <div class="t-result" id="ip2lResult">
                <textarea class="t-area t-area-readonly" id="ip2lOut" rows="2" readonly></textarea>
                <div class="t-options" style="margin-top:8px">
                    <button class="t-copy" type="button" data-copy="#ip2lOut">复制结果</button>
                </div>
            </div>
            <div class="t-row" style="margin-bottom:12px;margin-top:14px">
                <div class="t-col" style="flex:1">
                    <label class="t-label" for="longInput">数字地址（0 ~ 4294967295）</label>
                    <input class="t-input" style="width:100%" type="text" id="longInput" placeholder="如 3232235777">
                </div>
                <div class="t-col" style="flex:0 0 auto">
                    <label class="t-label">&nbsp;</label>
                    <button class="t-btn" type="button" id="long2ipv4">→ IPv4 地址</button>
                </div>
            </div>
            <div class="t-result" id="l2ipResult">
                <textarea class="t-area t-area-readonly" id="l2ipOut" rows="2" readonly></textarea>
                <div class="t-options" style="margin-top:8px">
                    <button class="t-copy" type="button" data-copy="#l2ipOut">复制结果</button>
                </div>
            </div>
            <div class="t-error" id="convErr"></div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于 IP 工具</h2>
        <p class="tool-desc">归属地查询支持 IP 与域名，结果包含数字地址与物理位置。IP/数字互转：IPv4 的每个段为 0~255，数字地址 = a*256³ + b*256² + c*256 + d，完全本地计算。</p>
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
    'use strict';
    var tabs = document.querySelectorAll('#ipTabs .t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });

    // ===== 面板1：IP 归属地查询（原交互：校验后表单提交） =====
    var ipErr = document.getElementById('ipErr');
    function showIpErr(m) { if (ipErr) { ipErr.textContent = m; ipErr.classList.add('show'); } }
    function hideIpErr() { if (ipErr) ipErr.classList.remove('show'); }
    function checkIsIp(s) { return /^(\d{1,3}\.){3}\d{1,3}$/.test(s); }
    function checkIsUrl(s) { return /^[a-zA-Z0-9][-a-zA-Z0-9]*(\.[a-zA-Z0-9][-a-zA-Z0-9]*)+/.test(s); }
    document.getElementById('ipQueryBtn').addEventListener('click', function () {
        hideIpErr();
        var ip = document.getElementById('ip_address').value.trim();
        if (ip.length === 0) { showIpErr('请输入IP地址 或 域名'); return; }
        if (!checkIsIp(ip) && !checkIsUrl(ip)) { showIpErr('输入正确的IP 或 域名'); return; }
        document.getElementById('ip').submit();
    });

    // ===== 面板2：IP / 数字地址互转（ip2long 功能） =====
    var convErr = document.getElementById('convErr');
    function showErr(m) { convErr.textContent = m; convErr.classList.add('show'); }
    document.getElementById('ipv42long').addEventListener('click', function () {
        convErr.classList.remove('show');
        var v = document.getElementById('ipv4Input').value.trim();
        if (!/^(\d{1,3}\.){3}\d{1,3}$/.test(v)) { showErr('请输入合法的 IPv4 地址，如 192.168.1.1'); return; }
        var parts = v.split('.').map(function (p) { return parseInt(p, 10); });
        if (parts.some(function (p) { return p < 0 || p > 255; })) { showErr('IPv4 每段取值必须为 0~255'); return; }
        var long = ((parts[0] * 256 + parts[1]) * 256 + parts[2]) * 256 + parts[3];
        document.getElementById('ip2lOut').value = v + '  →  ' + long;
        document.getElementById('ip2lResult').classList.add('show');
    });
    document.getElementById('long2ipv4').addEventListener('click', function () {
        convErr.classList.remove('show');
        var v = document.getElementById('longInput').value.trim();
        if (!/^\d+$/.test(v)) { showErr('请输入数字地址'); return; }
        var n = parseInt(v, 10);
        if (n < 0 || n > 4294967295) { showErr('数字地址范围：0 ~ 4294967295'); return; }
        var d = n % 256, c = Math.floor(n / 256) % 256, b = Math.floor(n / 65536) % 256, a = Math.floor(n / 16777216);
        document.getElementById('l2ipOut').value = v + '  →  ' + a + '.' + b + '.' + c + '.' + d;
        document.getElementById('l2ipResult').classList.add('show');
    });
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
