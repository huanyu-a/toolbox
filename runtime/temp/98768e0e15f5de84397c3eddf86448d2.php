<?php /*a:6:{s:49:"/app/application/index/view/index/calculator.html";i:1787036025;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.calculator.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.calculator.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.calculator.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
<link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/style/tool-theme.css" rel="stylesheet" type="text/css"/><link href="/static/style/subnetmask.css" rel="stylesheet" /><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><?php echo app('config')->get('web.header'); ?><link rel="canonical" href="<?php echo request()->domain(); ?><?php echo htmlentities((isset($current_url) && ($current_url !== '')?$current_url:'/')); ?>" />
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script><div class="container"><div class="tool-wrap"><div class="tool-card"><h2 class="tool-title"><span class="t-ico">🧮</span>在线科学计算器</h2><p class="tool-desc">在线科学计算器工具为您提供计算器在线计算,计算器在线使用,科学计算器,在线计算器,计算器使用,计算器在线计算使用,计算器使用方法,科学计算器在线计算,科学计算器使用方法,</p><div class="col-sm-12"> <div class="CalculatorWrap YaHei"> <form name="calc"> <div class="CalculTable" border="0"> <div class="ShowAreaWrap"><input isnum="true" class="ShowArea" value="0" name="display"></div> <ul class="heachackWrap ptb10 clearfix"> <li class="pr15"><input type="radio" class="mr10 HdisaBtn" onclick="inputChangCarry(16)" name="carry" checked="checked">十六进制</li> <li class="pr15"><input type="radio" class="mr10 HdisaBtn" onclick="inputChangCarry(10)" name="carry">十进制</li> <li class="pr15"><input type="radio" class="mr10 HdisaBtn" onclick="inputChangCarry(8)" name="carry">八进制</li> <li class="pr15"><input type="radio" class="mr10 HdisaBtn" onclick="inputChangCarry(2)" name="carry">二进制</li> <li class="pr15"><input type="radio" class="mr10 HdisaBtn" value="d" onclick="inputChangAngle('d')" name="angle">角度制</li> <li><input type="radio" class="mr10 HdisaBtn" value="r" onclick="inputChangAngle('r')" name="angle" checked="checked">弧度制</li> </ul> <ul class="heachackWrap mb20 clearfix"> <li class="pr15"><input type="checkbox" class="mr10" onclick="inputshift()" name="shiftf">上档功能</li> <li class="pr15"><input type="checkbox" class="mr10" onclick="inputshift()" name="hypf">双曲函数</li> <li><input class="HTxt01 mr10" readonly="" name="bracket"></li> <li><input class="HTxt01 mr10" readonly="" name="memory" value="M"></li> <li><input class="HTxt01 mr10" readonly="" name="operator"></li> <li class="fr"><input type="button" class="Hcolor01" value="退格" onclick="backspace()"></li> <li class="fr"><input type="button" class="Hcolor01 mr10" value="清屏" onclick="document.calc.display.value = 0 "></li> <li class="fr"><input type="button" class="Hcolor01 mr10" value="全清" onclick="clearall()"></li> </ul> <div class="CentChackBox clearfix"> <ul class="CentChackLeft fl"> <li> <input type="button" class="Lcolor02" value="PI" onclick="inputfunction('pi', 'pi')" name="pi" disabled="disabled"> <input type="button" class="Lcolor02" value="E" onclick="inputfunction('e', 'e')" name="e" disabled="disabled"> <input type="button" class="Lcolor01" value="d.ms" onclick="inputfunction('dms', 'deg')" name="bt" disabled="disabled"> </li> <li> <input type="button" class="Lcolor01" value="(" onclick="addbracket()"> <input type="button" class="Lcolor01" value=")" onclick="disbracket()"> <input type="button" class="Lcolor01" value="ln" onclick="inputfunction('ln', 'exp')" name="ln"> </li> <li> <input type="button" class="Lcolor01" value="sin" onclick="inputtrig('sin', 'arcsin', 'hypsin', 'ahypsin')" name="sin" disabled="disabled"> <input type="button" class="Lcolor01" value="x^y" onclick="operation('^', 7)"> <input type="button" class="Lcolor01" value="log" onclick="inputfunction('log', 'expdec')" name="log"> </li> <li> <input type="button" class="Lcolor01" value="cos" onclick="inputtrig('cos', 'arccos', 'hypcos', 'ahypcos')" name="cos" disabled="disabled"> <input type="button" class="Lcolor01" value="x^3" onclick="inputfunction('cube', 'cubt')" name="cube"> <input type="button" class="Lcolor01" value="n!" onclick="inputfunction('!', '!')"> </li> <li> <input type="button" class="Lcolor01" value="tan" onclick="inputtrig('tan', 'arctan', 'hyptan', 'ahyptan')" name="tan" disabled="disabled"> <input type="button" class="Lcolor01" value="x^2" onclick="inputfunction('sqr', 'sqrt')" name="sqr"> <input type="button" class="Lcolor01" value="1/x" onclick="inputfunction('recip', 'recip')"> </li> </ul> <div class="CentChackSide fl"> <input type="button" class="Hcolor01" value="储存" onclick="putmemory()"> <input type="button" class="Hcolor01" value="取存" onclick="getmemory()"> <input type="button" class="Hcolor01" value="累存" onclick="addmemory()"> <input type="button" class="Hcolor01" value="积存" onclick="multimemory()"> <input type="button" class="Hcolor01" value="清存" onclick="clearmemory()"> </div> <ul class="CentChackRight fl"> <li> <input type="button" class="Rcolor01" value="7" onclick="inputkey('7')" name="k7"> <input type="button" class="Rcolor01" value="8" onclick="inputkey('8')" name="k8"> <input type="button" class="Rcolor01" value="9" onclick="inputkey('9')" name="k9"> <input type="button" value="/" class="Rcolor02" onclick="operation('/', 6)"> <input type="button" value="取余" class="Rcolor02" onclick="operation('%', 6)"> <input type="button" value="与" class="Rcolor02" onclick="operation('&amp;', 3)"> </li> <li> <input type="button" class="Rcolor01" value="4" onclick="inputkey('4')" name="k4"> <input type="button" class="Rcolor01" value="5" onclick="inputkey('5')" name="k5"> <input type="button" class="Rcolor01" value="6" onclick="inputkey('6')" name="k6"> <input type="button" value="*" class="Rcolor02" onclick="operation('*', 6)"> <input type="button" value="取整" class="Rcolor02" onclick="inputfunction('floor', 'deci')" name="floor"> <input type="button" value="或" class="Rcolor02" onclick="operation('|', 1)"> </li> <li> <input type="button" class="Rcolor01" value="&#12288;1&#12288;" onclick="inputkey('1')"> <input type="button" class="Rcolor01" value="2" onclick="inputkey('2')" name="k2"> <input type="button" class="Rcolor01" value="3" onclick="inputkey('3')" name="k3"> <input type="button" value="-" class="Rcolor02" onclick="operation('-', 5)"> <input type="button" value="左移" class="Rcolor02" onclick="operation('&lt;', 4)"> <input type="button" value="非" class="Rcolor02" onclick="inputfunction('~', '~')"> </li> <li> <input type="button" value="0" class="Rcolor01" onclick="inputkey('0')"> <input type="button" value="+/-" class="Rcolor01" onclick="changeSign()"> <input type="button" value="." class="Rcolor01" onclick="inputkey('.')" name="kp" disabled="disabled"> <input type="button" class="Rcolor02" value="+" onclick="operation('+', 5)"> <input type="button" class="Rcolor02" value="＝" onclick="result()"> <input type="button" class="Rcolor02" value="异或" onclick="operation('x', 2)"> </li> <li> <input type="button" class="Rcolor01" value="A" onclick="inputkey('a')" name="ka"> <input type="button" class="Rcolor01" value="B" onclick="inputkey('b')" name="kb"> <input type="button" class="Rcolor01" value="C" onclick="inputkey('c')" name="kc"> <input type="button" class="Rcolor01" value="D" onclick="inputkey('d')" name="kd"> <input type="button" class="Rcolor01" value="E" onclick="inputkey('e')" name="ke"> <input type="button" class="Rcolor01" value="F" onclick="inputkey('f')" name="kf"> </li> </ul> </div> </div> </form> </div>			</div></div></div></div><script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script><script src="/static/script/bootstrap.min.js" type="text/javascript"></script><script src="/static/script/pcjs/calculator.js" type="text/javascript"></script><div class="container foot-history" id="foot-history">
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