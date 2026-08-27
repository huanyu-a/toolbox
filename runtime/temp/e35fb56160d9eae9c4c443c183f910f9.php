<?php /*a:6:{s:46:"/app/application/index/view/index/chaodai.html";i:1787036025;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.chaodai.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.chaodai.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.chaodai.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script><div class="container"><div class="tool-wrap"><div class="tool-card"><h2 class="tool-title"><span class="t-ico">🏯</span>中国历史朝代时间查询表</h2><p class="tool-desc">中国历史朝代都城在线查询工具:中国历史朝代时间查询表,中国历史朝代历经时间,中国历代朝代所处的起始与结束时间,都城所在位置,以及都城现今对应地名查询工具等</p><table cellspacing="1" cellpadding="5" width="100%" border="0" class="table table-bordered table-striped"> <tbody> <tr> <td align="middle" colspan="2"> 朝 代 </td> <td align="middle"> 起 讫 </td> <td align="middle"> 都 城 </td> <td align="middle"> 今 地 </td> </tr> <tr> <td align="middle" colspan="2"> 夏 </td> <td align="middle"> 约前2146-1675年 </td> <td align="middle"> 安邑 </td> <td align="middle"> 山西夏县 </td> </tr> <tr> <td align="middle" colspan="2"> 商<font color="#ff0000">①</font> </td> <td align="middle"> 约前1675-1029年 </td> <td align="middle"> 亳 </td> <td align="middle"> 河南商丘 </td> </tr> <tr> <td align="middle" rowspan="2"> 周 </td> <td align="middle"> 西周 </td> <td align="middle"> 约前1029-771年<font color="#ff0000">②</font> </td> <td align="middle"> 镐京 </td> <td align="middle"> 陕西西安 </td> </tr> <tr> <td align="middle"> 东周 </td> <td align="middle"> 前770-256年 </td> <td align="middle"> 洛邑 </td> <td align="middle"> 河南洛阳 </td> </tr> <tr> <td align="middle" colspan="2"> 秦 </td> <td align="middle"> 前221-207年 </td> <td align="middle"> 咸阳 </td> <td align="middle"> 陕西咸阳 </td> </tr> <tr> <td align="middle" rowspan="2"> 汉 </td> <td align="middle"> 西汉<font color="#ff0000">③</font> </td> <td align="middle"> 前206—公元25 </td> <td align="middle"> 长安 </td> <td align="middle"> 陕西西安 </td> </tr> <tr> <td align="middle"> 东汉 </td> <td align="middle"> 25—220 </td> <td align="middle"> 洛阳 </td> <td align="middle"> 河南洛阳 </td> </tr> <tr> <td align="middle" rowspan="3"> 三国 </td> <td align="middle"> 魏 </td> <td align="middle"> 220-265 </td> <td align="middle"> 洛阳 </td> <td align="middle"> 河南洛阳 </td> </tr> <tr> <td align="middle"> 蜀 </td> <td align="middle"> 221-263 </td> <td align="middle"> 成都 </td> <td align="middle"> 四川成都 </td> </tr> <tr> <td align="middle"> 吴 </td> <td align="middle"> 222-280 </td> <td align="middle"> 建业 </td> <td align="middle"> 江苏南京 </td> </tr> <tr> <td align="middle" colspan="2"> 西晋 </td> <td align="middle"> 265-317 </td> <td align="middle"> 洛阳 </td> <td align="middle"> 河南洛阳 </td> </tr> <tr> <td align="middle" rowspan="2"> 东晋<br> 十六国 </td> <td align="middle"> 东晋 </td> <td align="middle"> 317-420 </td> <td align="middle"> 建康 </td> <td align="middle"> 江苏南京 </td> </tr> <tr> <td align="middle"> 十六国<font color="#ff0000">④</font> </td> <td align="middle"> 304-439 </td> <td align="middle"> — </td> <td align="middle"> — </td> </tr> <tr> <td align="middle" rowspan="4"> 南朝 </td> <td align="middle"> 宋 </td> <td align="middle"> 420-479 </td> <td align="middle"> 建康 </td> <td align="middle"> 江苏南京 </td> </tr> <tr> <td align="middle"> 齐 </td> <td align="middle"> 479-502 </td> <td align="middle"> 建康 </td> <td align="middle"> 江苏南京 </td> </tr> <tr> <td align="middle"> 梁 </td> <td align="middle"> 502-557 </td> <td align="middle"> 建康 </td> <td align="middle"> 江苏南京 </td> </tr> <tr> <td align="middle"> 陈 </td> <td align="middle"> 557-589 </td> <td align="middle"> 建康 </td> <td align="middle"> 江苏南京 </td> </tr> <tr> <td align="middle" rowspan="6"> 北朝 </td> <td align="middle" rowspan="2"> 北魏 </td> <td align="middle" rowspan="2"> 386-534 </td> <td align="middle"> 平城 </td> <td align="middle"> 山西大同 </td> </tr> <tr> <td align="middle"> 洛阳 </td> <td align="middle"> 河南洛阳 </td> </tr> <tr> <td align="middle"> 东魏 </td> <td align="middle"> 534-550 </td> <td align="middle"> 邺 </td> <td align="middle"> 河北临漳 </td> </tr> <tr> <td align="middle"> 北齐 </td> <td align="middle"> 550-577 </td> <td align="middle"> 邺 </td> <td align="middle"> 河北临漳 </td> </tr> <tr> <td align="middle"> 西魏 </td> <td align="middle"> 535-557 </td> <td align="middle"> 长安 </td> <td align="middle"> 陕西西安 </td> </tr> <tr> <td align="middle"> 北周 </td> <td align="middle"> 557-581 </td> <td align="middle"> 长安 </td> <td align="middle"> 陕西西安 </td> </tr> <tr> <td align="middle" colspan="2"> 隋 </td> <td align="middle"> 581-618 </td> <td align="middle"> 大兴 </td> <td align="middle"> 陕西西安 </td> </tr> <tr> <td align="middle" colspan="2"> 唐 </td> <td align="middle"> 618-907 </td> <td align="middle"> 长安 </td> <td align="middle"> 陕西西安 </td> </tr> <tr> <td align="middle" rowspan="6"> 五代<br> 十国 </td> <td align="middle"> 后梁 </td> <td align="middle"> 907-923 </td> <td align="middle"> 汴 </td> <td align="middle"> 河南开封 </td> </tr> <tr> <td align="middle"> 后唐 </td> <td align="middle"> 923-936 </td> <td align="middle"> 洛阳 </td> <td align="middle"> 河南洛阳 </td> </tr> <tr> <td align="middle"> 后晋 </td> <td align="middle"> 936-946 </td> <td align="middle"> 汴 </td> <td align="middle"> 河南开封 </td> </tr> <tr> <td align="middle"> 后汉 </td> <td align="middle"> 947-950 </td> <td align="middle"> 汴 </td> <td align="middle"> 河南开封 </td> </tr> <tr> <td align="middle"> 后周 </td> <td align="middle"> 951-960 </td> <td align="middle"> 汴 </td> <td align="middle"> 河南开封 </td> </tr> <tr> <td align="middle"> 十国<font color="#ff0000">⑤</font> </td> <td align="middle"> 902-979 </td> <td align="middle"> — </td> <td align="middle"> — </td> </tr> <tr> <td align="middle" rowspan="2"> 宋 </td> <td align="middle"> 北宋 </td> <td align="middle"> 960-1127 </td> <td align="middle"> 开封 </td> <td align="middle"> 河南开封 </td> </tr> <tr> <td align="middle"> 南宋 </td> <td align="middle"> 1127-1279 </td> <td align="middle"> 临安 </td> <td align="middle"> 浙江临安 </td> </tr> <tr> <td align="middle" colspan="2"> 辽 </td> <td align="middle"> 907-1125 </td> <td align="middle"> 皇都 <br> (上京) </td> <td align="middle"> 辽宁<br> 巴林右旗 </td> </tr> <tr> <td align="middle" colspan="2"> 西夏 </td> <td align="middle"> 1038-1227 </td> <td align="middle"> 兴庆府 </td> <td align="middle"> 宁夏银川 </td> </tr> <tr> <td align="middle" colspan="2" rowspan="3"> 金 </td> <td align="middle" rowspan="3"> 1115-1234 </td> <td align="middle"> 会宁 </td> <td align="middle"> 阿城(黑龙江) </td> </tr> <tr> <td align="middle"> 中都 </td> <td align="middle"> 北京 </td> </tr> <tr> <td align="middle"> 开封 </td> <td align="middle"> 河南开封 </td> </tr> <tr> <td align="middle" colspan="2"> 元 </td> <td align="middle"> 1206-1368 </td> <td align="middle"> 大都 </td> <td align="middle"> 北京 </td> </tr> <tr> <td align="middle" colspan="2"> 明 </td> <td align="middle"> 1368-1644 </td> <td align="middle"> 北京 </td> <td align="middle"> 北京 </td> </tr> <tr> <td align="middle" colspan="2"> 清 </td> <td align="middle"> 1616-1911 </td> <td align="middle"> 北京 </td> <td align="middle"> 北京 </td> </tr> <tr> <td align="middle" colspan="2"> 中华民国 </td> <td align="middle"> 1912-1949 </td> <td align="middle"> 南京 </td> <td align="middle"> 江苏南京 </td> </tr> <tr> <td align="middle" colspan="5"> 中华人民共和国1949年10月1日成立，首都北京。 </td> </tr> </tbody> </table></div></div></div><script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script><script src="/static/script/bootstrap.min.js" type="text/javascript"></script><div class="container foot-history" id="foot-history">
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