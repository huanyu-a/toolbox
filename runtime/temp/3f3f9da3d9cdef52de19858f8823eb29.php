<?php /*a:6:{s:48:"/app/application/index/view/index/useragent.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.useragent.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.useragent.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.useragent.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
<link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script><div class="container"><div class="tool-wrap"><div class="tool-card"><h2 class="tool-title"><span class="t-ico">🖥️</span>常用User-Agent</h2><p class="tool-desc">常见浏览器User-Agent大全为您收集常见常用浏览器User-Agent,提供PC浏览器user-agent,手机浏览器user-agent,360浏览器user-agent,</p><ul class="list-group"><li class="list-group-item list-group-item-info"style="width: 100%">PC端User-Agent</li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">IE 9.0</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0;"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">IE 8.0</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">IE 7.0</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">IE 6.0</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Firefox 4.0.1–MAC</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv,2.0.1) Gecko/20100101 Firefox/4.0.1"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Firefox 4.0.1–Windows</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Mozilla/5.0 (Windows NT 6.1; rv,2.0.1) Gecko/20100101 Firefox/4.0.1"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Opera 11.11–MAC</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; en) Presto/2.8.131 Version/11.11"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Opera 11.11–Windows</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Opera/9.80 (Windows NT 6.1; U; en) Presto/2.8.131 Version/11.11"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Chrome 17.0–MAC</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px"id="Span1">safari 5.1–MAC</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px"id="Span2">safari 5.1–Windows</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Mozilla/5.0 (Windows; U; Windows NT 6.1; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">傲游（Maxthon）</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Maxthon 2.0)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">腾讯TT</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; TencentTraveler 4.0)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">世界之窗（The World）2.x</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">世界之窗（The World）3.x</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; The World)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">搜狗浏览器1.x</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; SE 2.X MetaSr 1.0; SE 2.X MetaSr 1.0; .NET CLR 2.0.50727; SE 2.X MetaSr 1.0)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">360浏览器</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Avant</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Avant Browser)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Green Browser</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)"></div></li></ul><ul class="list-group"><li class="list-group-item list-group-item-info"style="width: 100%">移动设备端User-Agent</li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">safari iOS 4.33–iPhone</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">safari iOS 4.33–iPod Touch</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Mozilla/5.0 (iPod; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">safari iOS 4.33–iPad</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent,Mozilla/5.0 (iPad; U; CPU OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Android N1</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Android QQ浏览器For android</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, MQQBrowser/26 Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; MB200 Build/GRJ22; CyanogenMod-7) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Android Opera Mobile</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Opera/9.80 (Android 2.3.4; Linux; Opera Mobi/build-1107180945; U; en-GB) Presto/2.8.149 Version/11.10"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Android Pad Moto Xoom</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/5.0 (Linux; U; Android 3.0; en-us; Xoom Build/HRI39) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">BlackBerry</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/5.0 (BlackBerry; U; BlackBerry 9800; en) AppleWebKit/534.1+ (KHTML, like Gecko) Version/6.0.0.337 Mobile Safari/534.1+"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">WebOS HP Touchpad</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/5.0 (hp-tablet; Linux; hpwOS/3.0.0; U; en-US) AppleWebKit/534.6 (KHTML, like Gecko) wOSBrowser/233.70 Safari/534.6 TouchPad/1.0"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Nokia N97</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 NokiaN97-1/20.0.019; Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/525 (KHTML, like Gecko) BrowserNG/7.1.18124"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">Windows Phone Mango</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; HTC; Titan)"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">UC无</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, UCWEB7.0.2.37/28/999"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">UC标准</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, NOKIA5700/ UCWEB7.0.2.37/28/999"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">UCOpenwave</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Openwave/ UCWEB7.0.2.37/28/999"></div></li><li class="list-group-item"><div class="input-group"style="width: 100%"><span class="input-group-addon"style="width: 188px">UC Opera</span><input type="text"class="form-control"onmouseover="javascript:this.select();"value="User-Agent, Mozilla/4.0 (compatible; MSIE 6.0; ) Opera/UCWEB7.0.2.37/28/999"></div></li></ul></div></div></div><script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script><script src="/static/script/bootstrap.min.js" type="text/javascript"></script><div class="container foot-history" id="foot-history">
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
<script src="/static/script/app.js" type="text/javascript"></script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>