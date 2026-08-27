<?php /*a:6:{s:44:"/app/application/index/view/index/index.html";i:1787218453;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title><?php echo htmlentities(app('config')->get('web.site.name')); ?>-<?php echo htmlentities(app('config')->get('web.index.title')); ?></title>
    <meta name="applicable-device" content="pc,mobile"/>
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.index.keywords')); ?>"/>
    <meta name="description" content="<?php echo htmlentities(app('config')->get('web.index.description')); ?>"/>
    <meta name="renderer" content="webkit"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon"/>
    <link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/style/theme-uno.css" rel="stylesheet" type="text/css"/>
    <link href="/static/style/home.css" rel="stylesheet" type="text/css"/>
    <?php echo app('config')->get('web.header'); ?>
<link rel="canonical" href="<?php echo request()->domain(); ?><?php echo htmlentities((isset($current_url) && ($current_url !== '')?$current_url:'/')); ?>" />
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
</head>
<body>
<link href="/static/style/theme-uno.css" rel="stylesheet" type="text/css"/>
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
<main class="home-wrap">
    <!-- ============ Hero ============ -->
    <section class="home-hero">
        <div class="home-hero-mesh" aria-hidden="true"></div>
        <div class="home-hero-inner">
            <span class="home-badge">🆓 完全免费 · 本地运算 · 无需注册</span>
            <h1 class="home-title"><strong><?php echo $homeCount; ?></strong> 款工具，<span class="home-title-accent">打开即用</span></h1>
            <p class="home-sub">JSON 格式化、编码转换、加解密、网络诊断等常用工具，浏览器本地运算，数据不离开你的设备</p>
            <div class="home-search" id="homeSearchWrap">
                <span class="home-search-ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.6-3.6"/></svg></span>
                <input type="text" id="homeSearch" class="home-search-input" placeholder="搜索工具，如：json、md5、时间戳、IP…" autocomplete="off" aria-label="搜索工具"/>
                <kbd class="home-search-kbd">Ctrl K</kbd>
                <button type="button" class="home-search-clear" id="homeSearchClear" style="display:none;" aria-label="清空搜索"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg></button>
                <div class="home-search-dropdown" id="homeSearchDropdown" style="display:none;"></div>
            </div>
            <div class="home-hot">
                <span class="home-hot-label">热门 🔥</span>
                <a href="/json/">JSON 格式化</a>
                <a href="/encrypt/">加密解密</a>
                <a href="/encode/">编码转换</a>
                <a href="/ip/">IP 查询</a>
                <a href="/regex/">正则测试</a>
                <a href="/calculator/">计算器</a>
                <a href="/uuid/">UUID 生成</a>
            </div>
        </div>
    </section>

    <!-- ============ 特性条 ============ -->
    <section class="home-features">
        <div class="home-features-inner">
            <div class="home-feature">
                <span class="home-feature-ico">🔒</span>
                <div><span class="home-feature-h">本地运算</span><span class="home-feature-d">数据不离开设备</span></div>
            </div>
            <div class="home-feature">
                <span class="home-feature-ico">⚡</span>
                <div><span class="home-feature-h">打开即用</span><span class="home-feature-d">无需安装注册</span></div>
            </div>
            <div class="home-feature">
                <span class="home-feature-ico">🆓</span>
                <div><span class="home-feature-h">完全免费</span><span class="home-feature-d">所有功能免费</span></div>
            </div>
            <div class="home-feature">
                <span class="home-feature-ico">📦</span>
                <div><span class="home-feature-h"><?php echo htmlentities(count($tools)); ?> 大分类</span><span class="home-feature-d"><?php echo $homeCount; ?> 款工具全覆盖</span></div>
            </div>
        </div>
    </section>

    <!-- ============ 分类概览 ============ -->
    <section class="home-showcase">
        <div class="home-showcase-inner">
            <h2 class="home-section-title">覆盖你的日常工作</h2>
            <p class="home-section-sub"><?php echo htmlentities(count($tools)); ?> 大分类，<?php echo $homeCount; ?> 款工具，从开发到运维一站配齐</p>
            <div class="home-cat-cards">
                <?php if(is_array($tools) || $tools instanceof \think\Collection || $tools instanceof \think\Paginator): $i = 0; $__LIST__ = $tools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>
                <div class="home-cat-card" id="cat-<?php echo htmlentities($cat['cat']); ?>" data-cat="<?php echo htmlentities($cat['cat']); ?>" style="--cat-c:var(--tb-c<?php echo htmlentities($key+1); ?>);--cat-bg:var(--tb-c<?php echo htmlentities($key+1); ?>-bg)">
                    <div class="home-cat-card-head">
                        <span class="home-cat-card-ico" aria-hidden="true"><?php if($key == 0): ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 4 4 12l4 8M16 4l4 8-4 8"/></svg><?php elseif($key == 1): ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h10M4 18h7"/></svg><?php elseif($key == 2): ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 7h6M9 11h2M13 11h2M9 15h2M13 15h2"/></svg><?php elseif($key == 3): ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></svg><?php elseif($key == 4): ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18v3h3l6.3-6.3a4 4 0 0 0 5.4-5.4l-2.1 2.1-2.4-2.4z"/></svg><?php elseif($key == 5): ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2 5 5 2-5 2-2 5-2-5-5-2 5-2z"/></svg><?php else: ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="8" width="16" height="12" rx="2"/><path d="M9 8V5a3 3 0 0 1 6 0v3M9 13h.01M15 13h.01"/></svg><?php endif; ?></span>
                        <h3 class="home-cat-card-title"><?php echo htmlentities($cat['cat']); ?></h3>
                        <span class="home-cat-card-count"><?php echo htmlentities(count($cat['items'])); ?> 个工具</span>
                        <span class="home-cat-card-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
                    </div>
                    <div class="home-cat-card-tags">
                        <?php if(is_array($cat['items']) || $cat['items'] instanceof \think\Collection || $cat['items'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($cat['items']) ? array_slice($cat['items'],0,4, true) : $cat['items']->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tool): $mod = ($i % 2 );++$i;?>
                        <span class="home-cat-tag"><?php echo htmlentities($tool['name']); ?></span>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="home-cat-card-body">
                        <?php if(is_array($cat['items']) || $cat['items'] instanceof \think\Collection || $cat['items'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cat['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tool): $mod = ($i % 2 );++$i;?>
                        <a href="<?php echo htmlentities($tool['url']); ?>" class="home-cat-tool">
                            <span class="home-cat-tool-name"><?php echo htmlentities($tool['name']); ?></span>
                            <span class="home-cat-tool-desc"><?php if($tool['desc']): ?><?php echo htmlentities($tool['desc']); else: ?><?php echo htmlentities($tool['url']); ?><?php endif; ?></span>
                        </a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </section>

    <!-- ============ 三步使用指南 ============ -->
    <section class="home-steps">
        <div class="home-steps-inner">
            <h2 class="home-section-title">打开网页，马上就能用</h2>
            <p class="home-section-sub">无需安装、无需注册，三步完成所有操作</p>
            <div class="home-steps-grid">
                <div class="home-step">
                    <span class="home-step-ico">🔍</span>
                    <span class="home-step-num">1</span>
                    <h3 class="home-step-h">选择工具</h3>
                    <p class="home-step-p">从顶部分类菜单或搜索框找到你需要的工具</p>
                </div>
                <div class="home-step">
                    <span class="home-step-ico">⌨️</span>
                    <span class="home-step-num">2</span>
                    <h3 class="home-step-h">输入数据</h3>
                    <p class="home-step-p">粘贴文本、上传文件或填写参数，浏览器本地处理</p>
                </div>
                <div class="home-step">
                    <span class="home-step-ico">📋</span>
                    <span class="home-step-num">3</span>
                    <h3 class="home-step-h">复制结果</h3>
                    <p class="home-step-p">一键复制处理后的结果，即用即走</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ CTA ============ -->
    <section class="home-cta">
        <div class="home-cta-inner">
            <h2 class="home-cta-title">准备好了吗？</h2>
            <p class="home-cta-sub">从顶部分类菜单开始，或直接搜索你需要的工具</p>
            <a href="/json/" class="home-cta-btn">立即体验 →</a>
        </div>
    </section>
</main>
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
<script type="text/javascript">
// 首页搜索（下拉浮窗式）
(function(){
    var search = document.getElementById('homeSearch');
    var dropdown = document.getElementById('homeSearchDropdown');
    var clear = document.getElementById('homeSearchClear');
    var wrap = document.getElementById('homeSearchWrap');
    if (!search || !dropdown) return;
    // 工具数据
    var allTools = [
        <?php if(is_array($tools) || $tools instanceof \think\Collection || $tools instanceof \think\Paginator): $i = 0; $__LIST__ = $tools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;if(is_array($cat['items']) || $cat['items'] instanceof \think\Collection || $cat['items'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cat['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tool): $mod = ($i % 2 );++$i;?>
        { name: "<?php echo htmlentities($tool['name']); ?>", url: "<?php echo htmlentities($tool['url']); ?>", cat: "<?php echo htmlentities($cat['cat']); ?>", desc: "<?php if($tool['desc']): ?><?php echo htmlentities($tool['desc']); else: ?><?php echo htmlentities($tool['url']); ?><?php endif; ?>" },
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    ];
    function renderResults(kw) {
        kw = kw.trim().toLowerCase();
        if (!kw) { dropdown.style.display = 'none'; return; }
        var hits = allTools.filter(function(t) {
            return t.name.toLowerCase().indexOf(kw) !== -1 ||
                   t.desc.toLowerCase().indexOf(kw) !== -1 ||
                   t.cat.toLowerCase().indexOf(kw) !== -1 ||
                   t.url.toLowerCase().indexOf(kw) !== -1;
        }).slice(0, 8);
        if (!hits.length) {
            dropdown.innerHTML = '<div class="home-search-empty">没有找到匹配的工具，换个关键词试试</div>';
        } else {
            dropdown.innerHTML = hits.map(function(t) {
                return '<a href="' + t.url + '" class="home-search-item">' +
                    '<span class="home-search-item-name">' + t.name + '</span>' +
                    '<span class="home-search-item-cat">' + t.cat + '</span>' +
                    '<span class="home-search-item-desc">' + t.desc + '</span></a>';
            }).join('');
        }
        dropdown.style.display = 'block';
    }
    search.addEventListener('input', function() {
        var kw = search.value;
        if (clear) clear.style.display = kw ? 'flex' : 'none';
        renderResults(kw);
    });
    if (clear) {
        clear.addEventListener('click', function() {
            search.value = '';
            clear.style.display = 'none';
            dropdown.style.display = 'none';
            search.focus();
        });
    }
    document.addEventListener('click', function(e) {
        if (wrap && !wrap.contains(e.target)) dropdown.style.display = 'none';
    });
    document.addEventListener('keydown', function(e) {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            search.focus();
        }
        if (e.key === 'Escape') { dropdown.style.display = 'none'; }
    });
})();

// 分类卡片手风琴展开/折叠
(function(){
    var cards = document.querySelectorAll('.home-cat-card');
    if (!cards.length) return;
    cards.forEach(function(card){
        card.addEventListener('click', function(e){
            // 点击工具链接时不折叠
            if (e.target.closest('.home-cat-tool')) return;
            e.preventDefault();
            var wasOpen = card.classList.contains('open');
            // 先关闭其他卡片
        cards.forEach(function(c){ c.classList.remove('open'); });
            if (!wasOpen) card.classList.add('open');
        });
    });

    // URL hash 自动展开对应分类（工具页面包屑跳转 #cat-分类名）
    function openByHash() {
        var hash = window.location.hash;
        if (!hash || hash.indexOf('cat-') !== 1) return;
        var catName = decodeURIComponent(hash.slice(5));
        var card = document.querySelector('.home-cat-card[data-cat="' + catName + '"]');
        if (!card) return;
        cards.forEach(function(c){ c.classList.remove('open'); });
        card.classList.add('open');
        setTimeout(function(){
            var y = card.getBoundingClientRect().top + (window.pageYOffset || document.documentElement.scrollTop) - 70;
            window.scrollTo({ top: Math.max(0, y), behavior: 'smooth' });
        }, 200);
    }
    window.addEventListener('hashchange', openByHash);
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', openByHash);
    } else {
        openByHash(); // 页面加载时也检查
    }
})();
</script>
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
</body>
</html>
