<?php /*a:6:{s:47:"/app/application/index/view/index/webcheck.html";i:1787134470;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.webcheck.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.webcheck.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.webcheck.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
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
        <h2 class="tool-title"><span class="t-ico">🔎</span>网站检测</h2>
        <p class="tool-desc">网站检测工具箱：ICP 备案查询、域名 Whois 信息、微信域名检测、Gzip 压缩检测、关键词密度检测、HTTP 状态码查询与对照表，输入网址一键检测。</p>
        <ul class="t-tabs" id="wcTabs">
            <li><button type="button" class="t-tab active" data-panel="wcIcp">ICP备案</button></li>
            <li><button type="button" class="t-tab" data-panel="wcWhois">Whois</button></li>
            <li><button type="button" class="t-tab" data-panel="wcWx">微信检测</button></li>
            <li><button type="button" class="t-tab" data-panel="wcGzip">Gzip检测</button></li>
            <li><button type="button" class="t-tab" data-panel="wcKw">关键词密度</button></li>
        </ul>

        <!-- ICP 备案 -->
        <div id="wcIcp" class="t-panel wc-panel active">
            <label class="t-label" for="wcIcpInput">输入域名</label>
            <div class="t-row">
                <input class="t-input t-flex1" id="wcIcpInput" placeholder="如：baidu.com" />
                <button class="t-btn t-btn-ok" type="button" id="wcIcpBtn">查询ICP备案</button>
            </div>
            <div class="t-result" id="wcIcpResult" style="display:none"></div>
        </div>

        <!-- Whois -->
        <div id="wcWhois" class="t-panel wc-panel">
            <label class="t-label" for="wcWhoisInput">输入域名或 IP</label>
            <div class="t-row">
                <input class="t-input t-flex1" id="wcWhoisInput" placeholder="如：baidu.com 或 1.2.3.4" />
                <button class="t-btn t-btn-ok" type="button" id="wcWhoisBtn">查询 Whois</button>
            </div>
            <div class="t-result" id="wcWhoisResult" style="display:none"></div>
            <div class="t-result" id="wcWhoisRaw" style="display:none;margin-top:10px"></div>
        </div>

        <!-- 微信检测 -->
        <div id="wcWx" class="t-panel wc-panel">
            <label class="t-label" for="wcWxInput">输入要检测的网址</label>
            <div class="t-row">
                <input class="t-input t-flex1" id="wcWxInput" placeholder="如：example.com" />
                <button class="t-btn t-btn-ok" type="button" id="wcWxBtn">微信域名检测</button>
            </div>
            <div class="t-result" id="wcWxResult" style="display:none"></div>
        </div>

        <!-- Gzip 检测 -->
        <div id="wcGzip" class="t-panel wc-panel">
            <label class="t-label" for="wcGzipInput">输入要检测的网址</label>
            <div class="t-row">
                <input class="t-input t-flex1" id="wcGzipInput" placeholder="如：example.com" />
                <button class="t-btn t-btn-ok" type="button" id="wcGzipBtn">Gzip 压缩检测</button>
            </div>
            <div class="t-result" id="wcGzipResult" style="display:none"></div>
        </div>

        <!-- 关键词密度 -->
        <div id="wcKw" class="t-panel wc-panel">
            <label class="t-label" for="wcKwUrl">网页地址</label>
            <div class="t-row">
                <input class="t-input t-flex1" id="wcKwUrl" placeholder="如：http://example.com/page.html" />
            </div>
            <label class="t-label" for="wcKwWord">检测关键词</label>
            <div class="t-row">
                <input class="t-input t-flex1" id="wcKwWord" placeholder="输入要统计的关键词" />
                <button class="t-btn t-btn-ok" type="button" id="wcKwBtn">检测关键词密度</button>
            </div>
            <div class="t-result" id="wcKwResult" style="display:none"></div>
        </div>
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
    var tabs = document.querySelectorAll('#wcTabs .t-tab');
    var panels = document.querySelectorAll('.wc-panel');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            panels.forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });

    function esc(s) {
        var d = document.createElement('div');
        d.textContent = (s === null || s === undefined) ? '' : String(s);
        return d.innerHTML;
    }
    function api(params, cb) {
        $.post('/doapi/', params, function (res) { cb(res); }).fail(function () { cb({ status: 0, msg: '请求失败，请稍后重试' }); });
    }
    function showBox(id, html) {
        var box = document.getElementById(id);
        box.innerHTML = html;
        box.style.display = 'block';
    }
    function kvTable(obj) {
        var h = '<table class="table table-bordered table-striped" style="margin-top:10px">';
        for (var k in obj) {
            if (obj.hasOwnProperty(k)) {
                h += '<tr><td style="width:140px;font-weight:600">' + esc(k) + '</td><td>' + esc(Array.isArray(obj[k]) ? obj[k].join(', ') : obj[k]) + '</td></tr>';
            }
        }
        return h + '</table>';
    }
    function errHtml(msg) {
        return '<div class="t-error show">' + esc(msg) + '</div>';
    }
    function loading() {
        return '<div class="t-note">正在检测，请稍候…</div>';
    }

    // ICP 备案
    document.getElementById('wcIcpBtn').addEventListener('click', function () {
        var v = document.getElementById('wcIcpInput').value.trim();
        if (!v) { showBox('wcIcpResult', errHtml('请输入域名')); return; }
        showBox('wcIcpResult', loading());
        api({ type: 'chaicp', icp: v }, function (res) {
            if (res.status === 1 && res.data) {
                showBox('wcIcpResult', kvTable(res.data));
            } else {
                showBox('wcIcpResult', errHtml(res.msg || '未查询到备案信息'));
            }
        });
    });

    // Whois
    document.getElementById('wcWhoisBtn').addEventListener('click', function () {
        var v = document.getElementById('wcWhoisInput').value.trim();
        if (!v) { showBox('wcWhoisResult', errHtml('请输入域名或 IP')); return; }
        showBox('wcWhoisResult', loading());
        document.getElementById('wcWhoisRaw').style.display = 'none';
        api({ type: 'whois', whois: v }, function (res) {
            if (res.status === 1) {
                if (res.data && Object.keys(res.data).length) {
                    showBox('wcWhoisResult', kvTable(res.data));
                } else {
                    showBox('wcWhoisResult', errHtml('未提取到关键信息，请查看下方原始数据'));
                }
                if (res.raw) {
                    var pre = document.createElement('pre');
                    pre.style.cssText = 'max-height:260px;overflow:auto;background:#f7f7f7;padding:10px;font-size:12px;white-space:pre-wrap;word-break:break-all';
                    pre.textContent = res.raw;
                    var rawBox = document.getElementById('wcWhoisRaw');
                    rawBox.innerHTML = '<div style="font-weight:600;margin-top:6px">原始 Whois 数据</div>';
                    rawBox.appendChild(pre);
                    rawBox.style.display = 'block';
                }
            } else {
                showBox('wcWhoisResult', errHtml(res.msg || '查询失败'));
            }
        });
    });

    // 微信检测
    document.getElementById('wcWxBtn').addEventListener('click', function () {
        var v = document.getElementById('wcWxInput').value.trim();
        if (!v) { showBox('wcWxResult', errHtml('请输入要检测的网址')); return; }
        showBox('wcWxResult', loading());
        api({ type: 'checkweixin', txt_url: v }, function (res) {
            if (res.status === 1) {
                var ok = res.code === 0;
                showBox('wcWxResult', '<div class="t-result-label" style="color:' + (ok ? 'green' : 'red') + ';font-size:16px;font-weight:600">' + (ok ? '✅ ' : '⛔ ') + esc(res.msg) + '</div>');
            } else {
                showBox('wcWxResult', errHtml(res.msg || '检测失败'));
            }
        });
    });

    // Gzip 检测
    document.getElementById('wcGzipBtn').addEventListener('click', function () {
        var v = document.getElementById('wcGzipInput').value.trim();
        if (!v) { showBox('wcGzipResult', errHtml('请输入要检测的网址')); return; }
        showBox('wcGzipResult', loading());
        api({ type: 'gzip', q: v }, function (res) {
            if (res.status === 1 && res.data) {
                var h = '';
                var jc = res.data.jc || {};
                var head = res.data.head || {};
                h += '<table class="table table-bordered table-striped" style="margin-top:10px">';
                h += '<tr><td style="width:140px;font-weight:600">是否压缩</td><td><strong style="color:' + (jc.ystype === 'gzip' ? 'green' : 'red') + '">' + (jc.ystype === 'gzip' ? '是' : '否') + '</strong></td></tr>';
                h += '<tr><td style="font-weight:600">压缩类型</td><td>' + esc(jc.ystype || '-') + '</td></tr>';
                h += '<tr><td style="font-weight:600">原始文件大小</td><td>' + esc(jc.ysize || '-') + '</td></tr>';
                h += '<tr><td style="font-weight:600">压缩后文件大小</td><td>' + esc(jc.yssize || '-') + '</td></tr>';
                h += '<tr><td style="font-weight:600">压缩率（估计值）</td><td>' + esc(jc.ysl || '-') + ' %</td></tr>';
                h += '</table>';
                if (Object.keys(head).length) {
                    h += '<div style="font-weight:600;margin-top:12px">Header 信息</div><table class="table table-bordered table-striped" style="margin-top:6px">';
                    for (var k in head) {
                        if (head.hasOwnProperty(k)) {
                            h += '<tr><td style="width:140px;font-weight:600">' + esc(k) + '</td><td style="word-break:break-all">' + esc(head[k]) + '</td></tr>';
                        }
                    }
                    h += '</table>';
                }
                showBox('wcGzipResult', h);
            } else {
                showBox('wcGzipResult', errHtml(res.msg || '检测失败，请检查网址'));
            }
        });
    });

    // 关键词密度
    document.getElementById('wcKwBtn').addEventListener('click', function () {
        var u = document.getElementById('wcKwUrl').value.trim();
        var w = document.getElementById('wcKwWord').value.trim();
        if (!u || !w) { showBox('wcKwResult', errHtml('请填写网页地址和关键词')); return; }
        showBox('wcKwResult', loading());
        api({ type: 'checkkeyword', txt_url: u, txt_keyword: w }, function (res) {
            if (res.status === 1) {
                var d = res.data || {};
                var h = '<table class="table table-bordered table-striped" style="margin-top:10px">';
                h += '<tr><td style="width:140px;font-weight:600">页面总字符数</td><td>' + esc(d.html_strlen) + ' 个</td></tr>';
                h += '<tr><td style="font-weight:600">关键词字符数</td><td>' + esc(d.html_gjccd) + ' 个</td></tr>';
                h += '<tr><td style="font-weight:600">关键词出现次数</td><td>' + esc(d.html_gjcsl) + ' 次</td></tr>';
                h += '<tr><td style="font-weight:600">关键词总字符数</td><td>' + esc(d.html_gjczcd) + ' 个</td></tr>';
                h += '<tr><td style="font-weight:600">关键词密度</td><td><strong style="color:#1677ff">' + esc(d.html_mdjgjs) + ' %</strong></td></tr>';
                h += '</table>';
                showBox('wcKwResult', h);
            } else {
                showBox('wcKwResult', errHtml(res.msg || '检测失败'));
            }
        });
    });
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
