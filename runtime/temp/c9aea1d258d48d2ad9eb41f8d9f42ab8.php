<?php /*a:6:{s:50:"/app/application/index/view/index/browserinfo.html";i:1787036025;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.browserinfo.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.browserinfo.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.browserinfo.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script><div class="container"><div class="tool-wrap"><div class="tool-card"><h2 class="tool-title"><span class="t-ico">🖥️</span>获取浏览器信息</h2><p class="tool-desc">在线查看获取客户端系统,浏览器信息工具为您提供查看客户端信息,查看浏览器信息,查看浏览类型,查看操作系统,查看浏览器名称,查看浏览器版本信息,显示器高宽度像素,浏览器网络链接状态,</p><table class="table table-hover table-bordered table-striped"><thead><tr><th>名称</th><th>描述</th><th>结果</th></tr></thead><tbody><tr><td>navigator.platform</td><td>客户端系统</td><td style="color: #3ab54a"><script>function detectOS(){var sUserAgent=navigator.userAgent;var isWin=(navigator.platform=="Win32")||(navigator.platform=="Windows");var isMac=(navigator.platform=="Mac68K")||(navigator.platform=="MacPPC")||(navigator.platform=="Macintosh")||(navigator.platform=="MacIntel");if(isMac)return"Mac";var isUnix=(navigator.platform=="X11")&&!isWin&&!isMac;if(isUnix)return"Unix";var isLinux=(String(navigator.platform).indexOf("Linux")>-1);if(isLinux)return"Linux";if(isWin){var isWin2K=sUserAgent.indexOf("Windows NT 5.0")>-1||sUserAgent.indexOf("Windows 2000")>-1;if(isWin2K)return"Win2000";var isWinXP=sUserAgent.indexOf("Windows NT 5.1")>-1||sUserAgent.indexOf("Windows XP")>-1;if(isWinXP)return"WinXP";var isWin2003=sUserAgent.indexOf("Windows NT 5.2")>-1||sUserAgent.indexOf("Windows 2003")>-1;if(isWin2003)return"Win2003";var isWinVista=sUserAgent.indexOf("Windows NT 6.0")>-1||sUserAgent.indexOf("Windows Vista")>-1;if(isWinVista)return"WinVista";var isWin7=sUserAgent.indexOf("Windows NT 6.1")>-1||sUserAgent.indexOf("Windows 7")>-1;if(isWin7)return"Win7"}return"other"}document.write(detectOS())</script></td></tr><tr><td>navigator.appName</td><td>返回浏览器名称</td><td style="color: #3ab54a"><script>document.write(navigator.appName)</script></td></tr><tr><td>navigator.appVersion</td><td>返回浏览器版本信息</td><td style="color: #3ab54a"><script>document.write(navigator.appVersion)</script></td></tr><tr><td>window.screen.height</td><td>显示器高度</td><td style="color: #3ab54a"><script>document.write(window.screen.height)</script>px</td></tr><tr><td>window.screen.width</td><td>显示器宽度</td><td style="color: #3ab54a"><script>document.write(window.screen.width)</script>px</td></tr><tr><td>window.screen.colorDepth</td><td>屏幕设置色彩位数</td><td style="color: #3ab54a"><script>document.write(window.screen.colorDepth)</script></td></tr><tr><td>navigator.appCodeName</td><td>返回浏览器代码名称</td><td style="color: #3ab54a"><script>document.write(navigator.appCodeName)</script></td></tr><tr><td>navigator.vendor</td><td>返回浏览器厂家信息</td><td style="color: #3ab54a"><script>document.write(navigator.vendor)</script></td></tr><tr><td>navigator.userAgent</td><td>返回浏览器及版本信息,包含navigator.appVersion信息</td><td style="color: #3ab54a"><script>document.write(navigator.userAgent)</script></td></tr><tr><td>navigator.onLine</td><td>返回浏览器是否连接到网络</td><td style="color: #3ab54a"><script>document.write(navigator.onLine)</script></td></tr><tr><td>navigator.language</td><td>返回浏览器默认语言</td><td style="color: #3ab54a"><script>document.write(navigator.language)</script></td></tr><tr><td>navigator.product</td><td>返回浏览器产品名称</td><td style="color: #3ab54a"><script>document.write(navigator.product)</script></td></tr><tr><td>navigator.productSub</td><td>返回浏览器产品其他信息</td><td style="color: #3ab54a"><script>document.write(navigator.productSub)</script></td></tr><tr><td>navigator.cookieEnabled</td><td>浏览器是否开启cookie</td><td style="color: #3ab54a"><script>document.write(navigator.cookieEnabled)</script></td></tr><tr><td>navigator.mimeTypes.length</td><td>浏览器的MIME类型数量</td><td style="color: #3ab54a"><script>document.write(navigator.mimeTypes.length);</script></td></tr><tr><td>navigator.mimeTypes</td><td>浏览器MIME支持类型列表</td><td style="color: #3ab54a"><script>for(x in navigator.mimeTypes){document.write("类型: "+navigator.mimeTypes[x].type+"<br/>");document.write("描述: "+navigator.mimeTypes[x].description+"<br/>");document.write("扩展名: "+navigator.mimeTypes[x].suffixes+"<br/>");document.write("附注: "+navigator.mimeTypes[x].enabledPlugin.name+"<br/>");document.write("<br/>")}</script></td></tr><tr><td>navigator.plugins.length</td><td>浏览器安装插件数量</td><td style="color: #3ab54a"><script>document.write(navigator.plugins.length);</script></td></tr><tr><td>navigator.plugins</td><td>浏览器安装插件信息列表</td><td style="color: #3ab54a"><script>for(x in navigator.plugins){document.write("名称："+navigator.plugins[x].name+"<br/> 描述："+navigator.plugins[x].description+"<br/> 文件名称："+navigator.plugins[x].filename+"<br/><br/>")}</script></td></tr></tbody></table></div></div></div><script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script><script src="/static/script/bootstrap.min.js" type="text/javascript"></script><script src="/static/script/pcjs/createmeta.js" type="text/javascript"></script><div class="container foot-history" id="foot-history">
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