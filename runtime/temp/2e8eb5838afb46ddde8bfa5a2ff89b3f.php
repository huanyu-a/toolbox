<?php /*a:6:{s:52:"/app/application/index/view/index/bootstrapicon.html";i:1787036025;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title><?php echo htmlentities(app('config')->get('web.bootstrapicon.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title>
    <meta name="applicable-device" content="pc,mobile"/>
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.bootstrapicon.keywords')); ?>"/>
    <meta name="description" content="<?php echo htmlentities(app('config')->get('web.bootstrapicon.description')); ?>"/>
    <meta name="renderer" content="webkit"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon"/>
    
    
<link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/style/tool-theme.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">.bs-glyphicons {
        margin: 0 -10px 20px;
        overflow: hidden
    }

    .bs-glyphicons-list {
        padding-left: 0;
        list-style: none
    }

    .bs-glyphicons li {
        float: left;
        width: 25%;
        height: 115px;
        padding: 10px;
        font-size: 10px;
        line-height: 1.4;
        text-align: center;
        background-color: #f9f9f9;
        border: 1px solid #fff
    }

    .bs-glyphicons .glyphicon {
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 24px
    }

    .bs-glyphicons .glyphicon-class {
        display: block;
        text-align: center;
        word-wrap: break-word
    }

    .bs-glyphicons li:hover {
        color: #fff;
        background-color: #0b72b8
    }

    @media (min-width: 768px) {
        .bs-glyphicons {
            margin-right: 0;
            margin-left: 0
        }

        .bs-glyphicons li {
            width: 12.5%;
            font-size: 12px
        }
    }
    </style>
    <!--[if lt IE 9]>
    <script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
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
<body><link href="/static/style/theme-uno.css" rel="stylesheet" type="text/css"/>
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script><div class="container"><div class="tool-wrap"><div class="tool-card"><h2 class="tool-title"><span class="t-ico">🧩</span>Bootstrap字体图标</h2><p class="tool-desc">Bootstrap前端框架Glyphicons字体图标库对照表:Bootstrap前端UI,Glyphicons字体图标调用,Bootstrap按钮字体图标对照表,</p>
                        <div class="panel-heading">
                            <blockquote><p>Bootstrap前端框架Glyphicons字体图标</p>
                                <footer>
                                    Bootstrap前端框架Glyphicons字体图标库对照表:Bootstrap前端UI,Glyphicons字体图标调用,Bootstrap按钮字体图标对照表,包括250多个来自Glyphicon
                                    Halflings的字体图标.项目中引用Bootstrap相关文件后即可直接调用下列图标<code>class="glyphicon
                                    glyphicon-xxxx"</code></footer>
                            </blockquote>
                        </div>
                        <div class="panel-body">
                            <div class="bs-glyphicons">
                                <ul class="bs-glyphicons-list">
                                    <li><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-asterisk</span></li>
                                    <li><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-plus</span></li>
                                    <li><span class="glyphicon glyphicon-euro" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-euro</span></li>
                                    <li><span class="glyphicon glyphicon-eur" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-eur</span></li>
                                    <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-minus</span></li>
                                    <li><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-cloud</span></li>
                                    <li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-envelope</span></li>
                                    <li><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-pencil</span></li>
                                    <li><span class="glyphicon glyphicon-glass" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-glass</span></li>
                                    <li><span class="glyphicon glyphicon-music" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-music</span></li>
                                    <li><span class="glyphicon glyphicon-search" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-search</span></li>
                                    <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-heart</span></li>
                                    <li><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-star</span></li>
                                    <li><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-star-empty</span></li>
                                    <li><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-user</span></li>
                                    <li><span class="glyphicon glyphicon-film" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-film</span></li>
                                    <li><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-th-large</span></li>
                                    <li><span class="glyphicon glyphicon-th" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-th</span></li>
                                    <li><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-th-list</span></li>
                                    <li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-ok</span></li>
                                    <li><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-remove</span></li>
                                    <li><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-zoom-in</span></li>
                                    <li><span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-zoom-out</span></li>
                                    <li><span class="glyphicon glyphicon-off" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-off</span></li>
                                    <li><span class="glyphicon glyphicon-signal" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-signal</span></li>
                                    <li><span class="glyphicon glyphicon-cog" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-cog</span></li>
                                    <li><span class="glyphicon glyphicon-trash" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-trash</span></li>
                                    <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-home</span></li>
                                    <li><span class="glyphicon glyphicon-file" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-file</span></li>
                                    <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-time</span></li>
                                    <li><span class="glyphicon glyphicon-road" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-road</span></li>
                                    <li><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-download-alt</span></li>
                                    <li><span class="glyphicon glyphicon-download" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-download</span></li>
                                    <li><span class="glyphicon glyphicon-upload" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-upload</span></li>
                                    <li><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-inbox</span></li>
                                    <li><span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-play-circle</span></li>
                                    <li><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-repeat</span></li>
                                    <li><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-refresh</span></li>
                                    <li><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-list-alt</span></li>
                                    <li><span class="glyphicon glyphicon-lock" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-lock</span></li>
                                    <li><span class="glyphicon glyphicon-flag" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-flag</span></li>
                                    <li><span class="glyphicon glyphicon-headphones" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-headphones</span></li>
                                    <li><span class="glyphicon glyphicon-volume-off" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-volume-off</span></li>
                                    <li><span class="glyphicon glyphicon-volume-down" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-volume-down</span></li>
                                    <li><span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-volume-up</span></li>
                                    <li><span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-qrcode</span></li>
                                    <li><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-barcode</span></li>
                                    <li><span class="glyphicon glyphicon-tag" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-tag</span></li>
                                    <li><span class="glyphicon glyphicon-tags" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-tags</span></li>
                                    <li><span class="glyphicon glyphicon-book" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-book</span></li>
                                    <li><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-bookmark</span></li>
                                    <li><span class="glyphicon glyphicon-print" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-print</span></li>
                                    <li><span class="glyphicon glyphicon-camera" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-camera</span></li>
                                    <li><span class="glyphicon glyphicon-font" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-font</span></li>
                                    <li><span class="glyphicon glyphicon-bold" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-bold</span></li>
                                    <li><span class="glyphicon glyphicon-italic" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-italic</span></li>
                                    <li><span class="glyphicon glyphicon-text-height" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-text-height</span></li>
                                    <li><span class="glyphicon glyphicon-text-width" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-text-width</span></li>
                                    <li><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-align-left</span></li>
                                    <li><span class="glyphicon glyphicon-align-center" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-align-center</span></li>
                                    <li><span class="glyphicon glyphicon-align-right" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-align-right</span></li>
                                    <li><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-align-justify</span></li>
                                    <li><span class="glyphicon glyphicon-list" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-list</span></li>
                                    <li><span class="glyphicon glyphicon-indent-left" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-indent-left</span></li>
                                    <li><span class="glyphicon glyphicon-indent-right" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-indent-right</span></li>
                                    <li><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-facetime-video</span></li>
                                    <li><span class="glyphicon glyphicon-picture" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-picture</span></li>
                                    <li><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-map-marker</span></li>
                                    <li><span class="glyphicon glyphicon-adjust" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-adjust</span></li>
                                    <li><span class="glyphicon glyphicon-tint" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-tint</span></li>
                                    <li><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-edit</span></li>
                                    <li><span class="glyphicon glyphicon-share" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-share</span></li>
                                    <li><span class="glyphicon glyphicon-check" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-check</span></li>
                                    <li><span class="glyphicon glyphicon-move" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-move</span></li>
                                    <li><span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-step-backward</span></li>
                                    <li><span class="glyphicon glyphicon-fast-backward" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-fast-backward</span></li>
                                    <li><span class="glyphicon glyphicon-backward" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-backward</span></li>
                                    <li><span class="glyphicon glyphicon-play" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-play</span></li>
                                    <li><span class="glyphicon glyphicon-pause" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-pause</span></li>
                                    <li><span class="glyphicon glyphicon-stop" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-stop</span></li>
                                    <li><span class="glyphicon glyphicon-forward" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-forward</span></li>
                                    <li><span class="glyphicon glyphicon-fast-forward" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-fast-forward</span></li>
                                    <li><span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-step-forward</span></li>
                                    <li><span class="glyphicon glyphicon-eject" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-eject</span></li>
                                    <li><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-chevron-left</span></li>
                                    <li><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-chevron-right</span></li>
                                    <li><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-plus-sign</span></li>
                                    <li><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-minus-sign</span></li>
                                    <li><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-remove-sign</span></li>
                                    <li><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-ok-sign</span></li>
                                    <li><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-question-sign</span></li>
                                    <li><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-info-sign</span></li>
                                    <li><span class="glyphicon glyphicon-screenshot" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-screenshot</span></li>
                                    <li><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-remove-circle</span></li>
                                    <li><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-ok-circle</span></li>
                                    <li><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-ban-circle</span></li>
                                    <li><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-arrow-left</span></li>
                                    <li><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-arrow-right</span></li>
                                    <li><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-arrow-up</span></li>
                                    <li><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-arrow-down</span></li>
                                    <li><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-share-alt</span></li>
                                    <li><span class="glyphicon glyphicon-resize-full" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-resize-full</span></li>
                                    <li><span class="glyphicon glyphicon-resize-small" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-resize-small</span></li>
                                    <li><span class="glyphicon glyphicon-exclamation-sign"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-exclamation-sign</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-gift" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-gift</span></li>
                                    <li><span class="glyphicon glyphicon-leaf" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-leaf</span></li>
                                    <li><span class="glyphicon glyphicon-fire" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-fire</span></li>
                                    <li><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-eye-open</span></li>
                                    <li><span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-eye-close</span></li>
                                    <li><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-warning-sign</span></li>
                                    <li><span class="glyphicon glyphicon-plane" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-plane</span></li>
                                    <li><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-calendar</span></li>
                                    <li><span class="glyphicon glyphicon-random" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-random</span></li>
                                    <li><span class="glyphicon glyphicon-comment" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-comment</span></li>
                                    <li><span class="glyphicon glyphicon-magnet" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-magnet</span></li>
                                    <li><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-chevron-up</span></li>
                                    <li><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-chevron-down</span></li>
                                    <li><span class="glyphicon glyphicon-retweet" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-retweet</span></li>
                                    <li><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-shopping-cart</span></li>
                                    <li><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-folder-close</span></li>
                                    <li><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-folder-open</span></li>
                                    <li><span class="glyphicon glyphicon-resize-vertical"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-resize-vertical</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-resize-horizontal"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-resize-horizontal</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-hdd</span></li>
                                    <li><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-bullhorn</span></li>
                                    <li><span class="glyphicon glyphicon-bell" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-bell</span></li>
                                    <li><span class="glyphicon glyphicon-certificate" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-certificate</span></li>
                                    <li><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-thumbs-up</span></li>
                                    <li><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-thumbs-down</span></li>
                                    <li><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-hand-right</span></li>
                                    <li><span class="glyphicon glyphicon-hand-left" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-hand-left</span></li>
                                    <li><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-hand-up</span></li>
                                    <li><span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-hand-down</span></li>
                                    <li><span class="glyphicon glyphicon-circle-arrow-right"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-circle-arrow-right</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-circle-arrow-left"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-circle-arrow-left</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-circle-arrow-up"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-circle-arrow-up</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-circle-arrow-down"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-circle-arrow-down</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-globe" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-globe</span></li>
                                    <li><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-wrench</span></li>
                                    <li><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-tasks</span></li>
                                    <li><span class="glyphicon glyphicon-filter" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-filter</span></li>
                                    <li><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-briefcase</span></li>
                                    <li><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-fullscreen</span></li>
                                    <li><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-dashboard</span></li>
                                    <li><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-paperclip</span></li>
                                    <li><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-heart-empty</span></li>
                                    <li><span class="glyphicon glyphicon-link" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-link</span></li>
                                    <li><span class="glyphicon glyphicon-phone" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-phone</span></li>
                                    <li><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-pushpin</span></li>
                                    <li><span class="glyphicon glyphicon-usd" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-usd</span></li>
                                    <li><span class="glyphicon glyphicon-gbp" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-gbp</span></li>
                                    <li><span class="glyphicon glyphicon-sort" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-sort</span></li>
                                    <li><span class="glyphicon glyphicon-sort-by-alphabet"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-sort-by-alphabet</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-sort-by-alphabet-alt"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-sort-by-alphabet-alt</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-sort-by-order" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-sort-by-order</span></li>
                                    <li><span class="glyphicon glyphicon-sort-by-order-alt"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-sort-by-order-alt</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-sort-by-attributes"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-sort-by-attributes</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-sort-by-attributes-alt"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-sort-by-attributes-alt</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-unchecked</span></li>
                                    <li><span class="glyphicon glyphicon-expand" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-expand</span></li>
                                    <li><span class="glyphicon glyphicon-collapse-down" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-collapse-down</span></li>
                                    <li><span class="glyphicon glyphicon-collapse-up" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-collapse-up</span></li>
                                    <li><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-log-in</span></li>
                                    <li><span class="glyphicon glyphicon-flash" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-flash</span></li>
                                    <li><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-log-out</span></li>
                                    <li><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-new-window</span></li>
                                    <li><span class="glyphicon glyphicon-record" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-record</span></li>
                                    <li><span class="glyphicon glyphicon-save" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-save</span></li>
                                    <li><span class="glyphicon glyphicon-open" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-open</span></li>
                                    <li><span class="glyphicon glyphicon-saved" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-saved</span></li>
                                    <li><span class="glyphicon glyphicon-import" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-import</span></li>
                                    <li><span class="glyphicon glyphicon-export" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-export</span></li>
                                    <li><span class="glyphicon glyphicon-send" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-send</span></li>
                                    <li><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-floppy-disk</span></li>
                                    <li><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-floppy-saved</span></li>
                                    <li><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-floppy-remove</span></li>
                                    <li><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-floppy-save</span></li>
                                    <li><span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-floppy-open</span></li>
                                    <li><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-credit-card</span></li>
                                    <li><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-transfer</span></li>
                                    <li><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-cutlery</span></li>
                                    <li><span class="glyphicon glyphicon-header" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-header</span></li>
                                    <li><span class="glyphicon glyphicon-compressed" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-compressed</span></li>
                                    <li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-earphone</span></li>
                                    <li><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-phone-alt</span></li>
                                    <li><span class="glyphicon glyphicon-tower" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-tower</span></li>
                                    <li><span class="glyphicon glyphicon-stats" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-stats</span></li>
                                    <li><span class="glyphicon glyphicon-sd-video" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-sd-video</span></li>
                                    <li><span class="glyphicon glyphicon-hd-video" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-hd-video</span></li>
                                    <li><span class="glyphicon glyphicon-subtitles" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-subtitles</span></li>
                                    <li><span class="glyphicon glyphicon-sound-stereo" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-sound-stereo</span></li>
                                    <li><span class="glyphicon glyphicon-sound-dolby" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-sound-dolby</span></li>
                                    <li><span class="glyphicon glyphicon-sound-5-1" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-sound-5-1</span></li>
                                    <li><span class="glyphicon glyphicon-sound-6-1" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-sound-6-1</span></li>
                                    <li><span class="glyphicon glyphicon-sound-7-1" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-sound-7-1</span></li>
                                    <li><span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-copyright-mark</span></li>
                                    <li><span class="glyphicon glyphicon-registration-mark"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-registration-mark</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-cloud-download</span></li>
                                    <li><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-cloud-upload</span></li>
                                    <li><span class="glyphicon glyphicon-tree-conifer" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-tree-conifer</span></li>
                                    <li><span class="glyphicon glyphicon-tree-deciduous" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-tree-deciduous</span></li>
                                    <li><span class="glyphicon glyphicon-cd" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-cd</span></li>
                                    <li><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-save-file</span></li>
                                    <li><span class="glyphicon glyphicon-open-file" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-open-file</span></li>
                                    <li><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-level-up</span></li>
                                    <li><span class="glyphicon glyphicon-copy" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-copy</span></li>
                                    <li><span class="glyphicon glyphicon-paste" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-paste</span></li>
                                    <li><span class="glyphicon glyphicon-alert" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-alert</span></li>
                                    <li><span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-equalizer</span></li>
                                    <li><span class="glyphicon glyphicon-king" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-king</span></li>
                                    <li><span class="glyphicon glyphicon-queen" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-queen</span></li>
                                    <li><span class="glyphicon glyphicon-pawn" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-pawn</span></li>
                                    <li><span class="glyphicon glyphicon-bishop" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-bishop</span></li>
                                    <li><span class="glyphicon glyphicon-knight" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-knight</span></li>
                                    <li><span class="glyphicon glyphicon-baby-formula" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-baby-formula</span></li>
                                    <li><span class="glyphicon glyphicon-tent" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-tent</span></li>
                                    <li><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-blackboard</span></li>
                                    <li><span class="glyphicon glyphicon-bed" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-bed</span></li>
                                    <li><span class="glyphicon glyphicon-apple" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-apple</span></li>
                                    <li><span class="glyphicon glyphicon-erase" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-erase</span></li>
                                    <li><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-hourglass</span></li>
                                    <li><span class="glyphicon glyphicon-lamp" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-lamp</span></li>
                                    <li><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-duplicate</span></li>
                                    <li><span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-piggy-bank</span></li>
                                    <li><span class="glyphicon glyphicon-scissors" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-scissors</span></li>
                                    <li><span class="glyphicon glyphicon-bitcoin" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-bitcoin</span></li>
                                    <li><span class="glyphicon glyphicon-btc" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-btc</span></li>
                                    <li><span class="glyphicon glyphicon-xbt" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-xbt</span></li>
                                    <li><span class="glyphicon glyphicon-yen" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-yen</span></li>
                                    <li><span class="glyphicon glyphicon-jpy" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-jpy</span></li>
                                    <li><span class="glyphicon glyphicon-ruble" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-ruble</span></li>
                                    <li><span class="glyphicon glyphicon-rub" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-rub</span></li>
                                    <li><span class="glyphicon glyphicon-scale" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-scale</span></li>
                                    <li><span class="glyphicon glyphicon-ice-lolly" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-ice-lolly</span></li>
                                    <li><span class="glyphicon glyphicon-ice-lolly-tasted"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-ice-lolly-tasted</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-education" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-education</span></li>
                                    <li><span class="glyphicon glyphicon-option-horizontal"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-option-horizontal</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-option-vertical"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-option-vertical</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-menu-hamburger</span></li>
                                    <li><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-modal-window</span></li>
                                    <li><span class="glyphicon glyphicon-oil" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-oil</span></li>
                                    <li><span class="glyphicon glyphicon-grain" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-grain</span></li>
                                    <li><span class="glyphicon glyphicon-sunglasses" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-sunglasses</span></li>
                                    <li><span class="glyphicon glyphicon-text-size" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-text-size</span></li>
                                    <li><span class="glyphicon glyphicon-text-color" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-text-color</span></li>
                                    <li><span class="glyphicon glyphicon-text-background"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-text-background</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-object-align-top"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-object-align-top</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-object-align-bottom</span></li>
                                    <li><span class="glyphicon glyphicon-object-align-horizontal"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-object-align-horizontal</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-object-align-left"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-object-align-left</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-object-align-vertical"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-object-align-vertical</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-object-align-right"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-object-align-right</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-triangle-right</span></li>
                                    <li><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-triangle-left</span></li>
                                    <li><span class="glyphicon glyphicon-triangle-bottom"
                                              aria-hidden="true"></span><span class="glyphicon-class">glyphicon glyphicon-triangle-bottom</span>
                                    </li>
                                    <li><span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-triangle-top</span></li>
                                    <li><span class="glyphicon glyphicon-console" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-console</span></li>
                                    <li><span class="glyphicon glyphicon-superscript" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-superscript</span></li>
                                    <li><span class="glyphicon glyphicon-subscript" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-subscript</span></li>
                                    <li><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-menu-left</span></li>
                                    <li><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-menu-right</span></li>
                                    <li><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-menu-down</span></li>
                                    <li><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span><span
                                            class="glyphicon-class">glyphicon glyphicon-menu-up</span></li>
                                </ul>
                            </div>
                        </div>
                    </div></div></div><script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
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
<script src="/static/script/app.js" type="text/javascript"></script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body>
</html>