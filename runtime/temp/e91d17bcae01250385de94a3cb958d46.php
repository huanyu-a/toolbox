<?php /*a:5:{s:44:"/app/application/index/view/index/index.html";i:1786518432;s:39:"/app/application/index/view/header.html";i:1786518426;s:37:"/app/application/index/view/link.html";i:1786512781;s:36:"/app/application/index/view/nav.html";i:1786515843;s:39:"/app/application/index/view/footer.html";i:1786512781;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title><?php echo htmlentities(app('config')->get('web.index.title')); ?></title>
    <meta name="applicable-device" content="pc,mobile"/>
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.index.keywords')); ?>"/>
    <meta name="description" content="<?php echo htmlentities(app('config')->get('web.index.description')); ?>"/>
    <meta name="renderer" content="webkit"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon"/>
    <link href="/static/style/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/style/tool.css" rel="stylesheet" type="text/css"/>
    <link href="/static/style/app.css" rel="stylesheet" type="text/css"/>
    <?php echo app('config')->get('web.header'); ?>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top navbar-fixed-top topbar" role="navigation">
    <div class="jz container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar"><span class="sr-only">在线工具箱</span> <span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="/" title="在线工具箱"><em class="logo_ico glyphicon glyphicon-wrench"></em>在线工具箱</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" role="navigation">
            <ul class="nav navbar-nav" id="top_menu">
                <?php if(is_array($tools) || $tools instanceof \think\Collection || $tools instanceof \think\Paginator): $i = 0; $__LIST__ = $tools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>
                <li class="dropdown<?php if($cat['cat'] == $current_cat): ?> open active<?php endif; ?>">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo htmlentities($cat['cat']); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu ul-list">
                        <?php if(is_array($cat['items']) || $cat['items'] instanceof \think\Collection || $cat['items'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cat['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tool): $mod = ($i % 2 );++$i;?>
                        <li<?php if($tool['url'] == $current_url): ?> class="cur"<?php endif; ?>><a href="<?php echo htmlentities($tool['url']); ?>"<?php if($tool['accent'] != ''): ?> style="color:<?php echo htmlentities($tool['accent']); ?>"<?php endif; ?>><?php echo htmlentities($tool['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-search hidden-xs">
                    <form action="javascript:;" class="navbar-form" role="search" onsubmit="return false;">
                        <div class="input-group">
                            <input type="text" class="form-control top-search" id="topSearchInput" placeholder="搜索工具，如：json、md5、时间戳…" autocomplete="off">
                            <span class="input-group-btn"><button type="button" class="btn btn-default top-search-btn" id="topSearchBtn"><span class="glyphicon glyphicon-search"></span></button></span>
                        </div>
                    </form>
                </li>
                <li class="nav-theme"><a href="javascript:;" id="themeToggle" title="切换深浅色模式" aria-label="切换深浅色模式"><span class="theme-icon">🌙</span></a></li>
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
<div class="search-dropdown hidden-xs" id="searchDropdown" style="display:none;"></div>
<script>window.TOOLS_DATA = <?php echo isset($tools) && $tools ? json_encode($tools) : '[]'; ?>;</script>
<script>var _hmt=_hmt||[];!function(){var e=document.createElement("script");e.src="https://hm.baidu.com/hm.js?3cac3b804824023eab6a7154c37a23c1";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)}()</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script>
<main class="home-wrap">
    <section class="home-hero">
        <div class="container">
            <h1 class="home-title">在线工具箱</h1>
            <p class="home-sub">JSON、加解密、格式化、转换、网络诊断等 <?php echo $homeCount; ?> 个常用工具，免费在线使用</p>
            <div class="home-search">
                <span class="home-search-ico">🔍</span>
                <input type="text" id="homeSearch" class="home-search-input" placeholder="搜索工具，如：json 格式化、md5、时间戳、ip 查询…" autocomplete="off"/>
                <button type="button" class="home-search-clear" id="homeSearchClear" style="display:none;">✕</button>
            </div>
            <div class="home-hot" id="homeHot">
                <span class="home-hot-label">热门：</span>
                <a href="/json/">JSON格式化</a>
                <a href="/md5/">MD5加密</a>
                <a href="/base64/">Base64</a>
                <a href="/unixtime/">时间戳转换</a>
                <a href="/ip/">IP查询</a>
                <a href="/random/">随机数</a>
            </div>
        </div>
    </section>
    <section class="container home-cats" id="homeCats">
        <?php if(is_array($tools) || $tools instanceof \think\Collection || $tools instanceof \think\Paginator): $i = 0; $__LIST__ = $tools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>
        <div class="home-cat" id="cat-<?php echo htmlentities($cat['cat']); ?>" data-cat="<?php echo htmlentities($cat['cat']); ?>">
            <div class="home-cat-head">
                <span class="home-cat-name"><?php echo htmlentities($cat['cat']); ?></span>
                <span class="home-cat-count"><?php echo htmlentities(count($cat['items'])); ?> 个</span>
            </div>
            <ul class="home-cat-list">
                <?php if(is_array($cat['items']) || $cat['items'] instanceof \think\Collection || $cat['items'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cat['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tool): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo htmlentities($tool['url']); ?>"<?php if($tool['accent'] != ''): ?> style="color:<?php echo htmlentities($tool['accent']); ?>"<?php endif; ?>><?php echo htmlentities($tool['name']); ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="home-empty" id="homeEmpty" style="display:none;">未找到匹配的工具，换个关键词试试～</div>
    </section>
</main>
<div class="container" style="margin-top:20px">
    <div class="row">
        <div class="col-sm-12"><p>友情链接：
            <a href="https://hub.openeeds.com/" target="_blank">Docker镜像加速</a> |
            <a href="https://docker.openeeds.com/" target="_blank">国内DockerHub</a> |
            <a href="https://www.cyberguard.best/#/register?code=PxOrTfcH" target="_blank">推荐机场</a> 
        </div>
    </div>
</div>
<div class="container foot-history" id="foot-history">
    <div class="row">
        <div class="col-md-12"><span>您的足迹：</span><span id="visit_history"></span></div>
    </div>
</div>
<div class="container foot-nav-wrap">
    <div class="row">
        <div class="col-md-12 footer-nav">
            <h2>在线工具箱导航</h2>
            <?php if(is_array($tools) || $tools instanceof \think\Collection || $tools instanceof \think\Paginator): $i = 0; $__LIST__ = $tools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>
            <div class="foot-cat">
                <h3><?php echo htmlentities($cat['cat']); ?></h3>
                <ul>
                    <?php if(is_array($cat['items']) || $cat['items'] instanceof \think\Collection || $cat['items'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cat['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tool): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo htmlentities($tool['url']); ?>"<?php if($tool['accent'] != ''): ?> style="color:<?php echo htmlentities($tool['accent']); ?>"<?php endif; ?>><?php echo htmlentities($tool['name']); ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>
<div class="copyright" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12"><span>Copyright ©2024 <a href="/">在线工具箱</a></span><!-- | <span><a
                    href="https://beian.miit.gov.cn/" target="_blank" rel="nofollow">粤ICP备2021140346号</a></span>--></div>
        </div>
    </div>
</div>
<a class="gotop" href="#top" title="返回顶部" style="display: none;"><span class="arrow"></span><span class="arrow lit"></span></a>
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/tool.js" type="text/javascript"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
</body>
</html>