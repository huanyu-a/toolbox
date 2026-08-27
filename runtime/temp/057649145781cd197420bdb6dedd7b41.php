<?php /*a:6:{s:43:"/app/application/index/view/index/calc.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.calc.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.calc.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.calc.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css" />
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
        <h2 class="tool-title"><span class="t-ico">📐</span>单位换算器</h2>
        <p class="tool-desc">长度、面积、体积、温度、时间、速度、压力、功率、角度、力、热量、密度、数据大小等常用单位在线互转，在任意输入框输入数值即可同步换算全部单位。</p>
        <ul class="t-tabs"><li><button type="button" class="t-tab active" data-panel="panel-calclength">📏 长度</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcarea">📐 面积</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcvolume">🧊 体积</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calctemperature">🌡️ 温度</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calctime">⏱️ 时间</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcspeed">🚀 速度</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcpressure">🌡️ 压力</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcpower">⚡ 功率</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcangle">📐 角度</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcforce">⚙️ 力</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcheat">🔥 热量</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcthickness">📏 密度</button></li>
<li><button type="button" class="t-tab" data-panel="panel-calcdata">💾 数据大小</button></li></ul>
        <div class="t-panel-wrap"><div class="t-panel active" id="panel-calclength">
  <div class="u-grid"><div class="u-item"><label class="u-name">公里 <em class="u-sym">(（km）)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">米 <em class="u-sym">(（m）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">分米 <em class="u-sym">(（dm）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">厘米 <em class="u-sym">(（cm）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">毫米 <em class="u-sym">(（mm）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">丝 <em class="u-sym">(（dmm）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">微米 <em class="u-sym">(（um）)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">里 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="7" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">丈 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="8" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">尺 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="9" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">寸 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="10" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">分 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="11" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">厘 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="12" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">海里 <em class="u-sym">(（nmi）)</em></label><input type="text" class="u-in" data-unit="13" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英寻 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="14" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英里 <em class="u-sym">(（mi）)</em></label><input type="text" class="u-in" data-unit="15" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">弗隆 <em class="u-sym">(（fur）)</em></label><input type="text" class="u-in" data-unit="16" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">码 <em class="u-sym">(（yd）)</em></label><input type="text" class="u-in" data-unit="17" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英尺 <em class="u-sym">(（ft）)</em></label><input type="text" class="u-in" data-unit="18" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英寸 <em class="u-sym">(（in）)</em></label><input type="text" class="u-in" data-unit="19" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">纳米 <em class="u-sym">(（nm）)</em></label><input type="text" class="u-in" data-unit="20" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calclength">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcarea">
  <div class="u-grid"><div class="u-item"><label class="u-name">平方公里 <em class="u-sym">((km²))</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">公顷 <em class="u-sym">(（ha）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">市亩</label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">平方米 <em class="u-sym">(（m²）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">平方分米 <em class="u-sym">(（dm²）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">平方厘米 <em class="u-sym">(（cm²）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">平方毫米 <em class="u-sym">(（mm²）)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">平方英里 <em class="u-sym">(（sqmi）)</em></label><input type="text" class="u-in" data-unit="7" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英亩</label><input type="text" class="u-in" data-unit="8" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">平方竿 <em class="u-sym">(（sq rd²）)</em></label><input type="text" class="u-in" data-unit="9" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">平方码 <em class="u-sym">(（sq yd²）)</em></label><input type="text" class="u-in" data-unit="10" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">平方英尺 <em class="u-sym">(（sq ft²）)</em></label><input type="text" class="u-in" data-unit="11" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">平方英寸 <em class="u-sym">(（sq in²）)</em></label><input type="text" class="u-in" data-unit="12" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcarea">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcvolume">
  <div class="u-grid"><div class="u-item"><label class="u-name">立方米 <em class="u-sym">(（m³）)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">公石 <em class="u-sym">(（hl）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">十升 <em class="u-sym">(（dal）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">立方分米 <em class="u-sym">(（(dm³)=升(l)）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">分升 <em class="u-sym">(（dl）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">厘升 <em class="u-sym">(（cl）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">立方厘米 <em class="u-sym">(（(cm³)=毫升(ml)）)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">立方毫米 <em class="u-sym">(（mm³）)</em></label><input type="text" class="u-in" data-unit="7" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">桶 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="8" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">蒲式耳 <em class="u-sym">(（bu）)</em></label><input type="text" class="u-in" data-unit="9" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">配克 <em class="u-sym">(（pk）)</em></label><input type="text" class="u-in" data-unit="10" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">夸脱 <em class="u-sym">(（qt）)</em></label><input type="text" class="u-in" data-unit="11" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">品脱 <em class="u-sym">(（pt）)</em></label><input type="text" class="u-in" data-unit="12" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">桶 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="13" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">蒲式耳 <em class="u-sym">(（bu）)</em></label><input type="text" class="u-in" data-unit="14" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">加仑 <em class="u-sym">(（bal）)</em></label><input type="text" class="u-in" data-unit="15" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">品脱 <em class="u-sym">(（pt）)</em></label><input type="text" class="u-in" data-unit="16" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">液量盎司 <em class="u-sym">(（fl oz）)</em></label><input type="text" class="u-in" data-unit="17" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">汤勺 <em class="u-sym">(（Table spoon）)</em></label><input type="text" class="u-in" data-unit="18" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">调羹 <em class="u-sym">(（Tea spoon）)</em></label><input type="text" class="u-in" data-unit="19" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">汤勺 <em class="u-sym">(（Tbs）)</em></label><input type="text" class="u-in" data-unit="20" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">调羹 <em class="u-sym">(（tsp）)</em></label><input type="text" class="u-in" data-unit="21" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">杯 <em class="u-sym">(（fl oz）)</em></label><input type="text" class="u-in" data-unit="22" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">桶 <em class="u-sym">(（42gal）)</em></label><input type="text" class="u-in" data-unit="23" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">加仑 <em class="u-sym">(（gal）)</em></label><input type="text" class="u-in" data-unit="24" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">夸脱 <em class="u-sym">(（qt）)</em></label><input type="text" class="u-in" data-unit="25" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">品脱 <em class="u-sym">(（pt）)</em></label><input type="text" class="u-in" data-unit="26" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">及耳 <em class="u-sym">(（gi）)</em></label><input type="text" class="u-in" data-unit="27" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">液量盎司 <em class="u-sym">(（oz）)</em></label><input type="text" class="u-in" data-unit="28" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">液量打兰 <em class="u-sym">(（fl dr）)</em></label><input type="text" class="u-in" data-unit="29" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">量滴 <em class="u-sym">(（min）)</em></label><input type="text" class="u-in" data-unit="30" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">亩英尺 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="31" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">立方码 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="32" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">立方英尺 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="33" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">立方英寸 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="34" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcvolume">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calctemperature">
  <div class="u-grid"><div class="u-item"><label class="u-name">摄氏度 <em class="u-sym">(C)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">华氏度 <em class="u-sym">(F)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">开氏度 <em class="u-sym">(K)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">兰氏度 <em class="u-sym">(Ra)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">列氏度 <em class="u-sym">(Re)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calctemperature">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calctime">
  <div class="u-grid"><div class="u-item"><label class="u-name">天 <em class="u-sym">(（d）)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">时 <em class="u-sym">(（h）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">周 <em class="u-sym">(（week）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">分 <em class="u-sym">(（min）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">秒 <em class="u-sym">(（s）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">毫秒 <em class="u-sym">(（ms）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">年 <em class="u-sym">(（yr）)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calctime">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcspeed">
  <div class="u-grid"><div class="u-item"><label class="u-name">米/秒 <em class="u-sym">(（m/s）)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千米/时 <em class="u-sym">(（km/h）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英寸/秒 <em class="u-sym">(（in/s）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千米/秒 <em class="u-sym">(（km/s）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">光速 <em class="u-sym">(（c）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">马赫 <em class="u-sym">(（mach）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英里/时 <em class="u-sym">(（mile/h）)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcspeed">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcpressure">
  <div class="u-grid"><div class="u-item"><label class="u-name">巴 <em class="u-sym">(（bar）)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千帕 <em class="u-sym">(（kPa）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">百帕 <em class="u-sym">(（hPa）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">毫巴 <em class="u-sym">(（mbar）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">帕斯卡 <em class="u-sym">(（Pa = N/㎡）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">标准大气压 <em class="u-sym">(（atm）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">毫米汞柱(托) <em class="u-sym">(（mm Hg=Torr）)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">磅力/英尺㎡ <em class="u-sym">(（lbf/ft㎡）)</em></label><input type="text" class="u-in" data-unit="7" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">磅力/英寸㎡ <em class="u-sym">(（lbf/in㎡ = PSI）)</em></label><input type="text" class="u-in" data-unit="8" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英吋汞柱 <em class="u-sym">(（in Hg）)</em></label><input type="text" class="u-in" data-unit="9" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">公斤力/厘米㎡ <em class="u-sym">(（kgf/㎡）)</em></label><input type="text" class="u-in" data-unit="10" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">公斤力/米㎡ <em class="u-sym">(（kgf/c㎡）)</em></label><input type="text" class="u-in" data-unit="11" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcpressure">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcpower">
  <div class="u-grid"><div class="u-item"><label class="u-name">米制马力 <em class="u-sym">(（ps）)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千卡/秒 <em class="u-sym">(（kcal/s）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千瓦 <em class="u-sym">(（kW）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英制马力 <em class="u-sym">(（hp）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英尺·磅/秒 <em class="u-sym">(（ft·lb/s）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">焦耳/秒 <em class="u-sym">(（J/s）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英热单位/秒 <em class="u-sym">(（Btu/s）)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">公斤·米/秒/秒 <em class="u-sym">(（kg·m/s）)</em></label><input type="text" class="u-in" data-unit="7" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">牛顿·米/秒 <em class="u-sym">(（N·m/s）)</em></label><input type="text" class="u-in" data-unit="8" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcpower">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcangle">
  <div class="u-grid"><div class="u-item"><label class="u-name">圆周 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">度 <em class="u-sym">(（°）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">秒 <em class="u-sym">(（"）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">弧度 <em class="u-sym">(（rad）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">直角 <em class="u-sym">( )</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">分 <em class="u-sym">(（ ′）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">毫弧度 <em class="u-sym">(（mrad）)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">百分度 <em class="u-sym">(（gon）)</em></label><input type="text" class="u-in" data-unit="7" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcangle">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcforce">
  <div class="u-grid"><div class="u-item"><label class="u-name">千克力 <em class="u-sym">(（kgf）)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">牛 <em class="u-sym">(（N）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千牛 <em class="u-sym">(（kN）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">克力 <em class="u-sym">(（gf）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">磅力 <em class="u-sym">(（lbf）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千磅力 <em class="u-sym">(（kip）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">公吨力 <em class="u-sym">(（tf）)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcforce">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcheat">
  <div class="u-grid"><div class="u-item"><label class="u-name">卡 <em class="u-sym">(（cal）)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千卡 <em class="u-sym">(（kcal）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千瓦·时 <em class="u-sym">(（kW·h）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英制马力·时 <em class="u-sym">(（hp·h）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">米制马力·时 <em class="u-sym">(（ps·h）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">公斤·米 <em class="u-sym">(（kg·m）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英热单位 <em class="u-sym">(btu)</em></label><input type="text" class="u-in" data-unit="6" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">英尺·磅 <em class="u-sym">(ft·lb)</em></label><input type="text" class="u-in" data-unit="7" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcheat">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcthickness">
  <div class="u-grid"><div class="u-item"><label class="u-name">克/立方厘米 <em class="u-sym">(（g/cm³）)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千克/立方厘米 <em class="u-sym">(（kg/cm³）)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千克/立方分米 <em class="u-sym">(（kg/dm³）)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">克/立方米 <em class="u-sym">(（g/m³）)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">克/立方分米 <em class="u-sym">(（g/dm³）)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千克/立方米 <em class="u-sym">(（kg/m³）)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcthickness">全部重置</button></div>
</div>
<div class="t-panel" id="panel-calcdata">
  <div class="u-grid"><div class="u-item"><label class="u-name">比特 <em class="u-sym">(bit)</em></label><input type="text" class="u-in" data-unit="0" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">字节 <em class="u-sym">(Bytes)</em></label><input type="text" class="u-in" data-unit="1" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千字节 <em class="u-sym">(KB)</em></label><input type="text" class="u-in" data-unit="2" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">兆字节 <em class="u-sym">(MB)</em></label><input type="text" class="u-in" data-unit="3" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">千兆字节 <em class="u-sym">(GB)</em></label><input type="text" class="u-in" data-unit="4" inputmode="decimal" placeholder="输入数值" /></div>
<div class="u-item"><label class="u-name">太字节 <em class="u-sym">(TB)</em></label><input type="text" class="u-in" data-unit="5" inputmode="decimal" placeholder="输入数值" /></div></div>
  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-calcdata">全部重置</button></div>
</div></div>
    </div>
</div></div>
<style>
.u-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 10px; }
.u-item { background: var(--surface-2, #f7f8fa); border: 1px solid var(--border, #e5e7eb); border-radius: 8px; padding: 10px 12px; }
.u-name { display: block; font-size: 13px; color: var(--text-2, #555); margin-bottom: 6px; font-weight: 600; }
.u-name .u-sym { font-style: normal; color: var(--text-3, #999); font-weight: 400; }
.u-in { width: 100%; box-sizing: border-box; border: 1px solid var(--border, #e5e7eb); border-radius: 6px; padding: 7px 10px; font-size: 14px; background: #fff; color: var(--text, #222); outline: none; }
.u-in:focus { border-color: var(--brand, #4f6ef2); box-shadow: 0 0 0 3px rgba(79,110,242,.12); }
</style>
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
    var DATA = {
  "calclength": { "bs": [0.001,1.0,10.0,100.0,1000.0,10000.0,1000000.0,0.002,0.3,3.0,30.0,300.0,3000.0,0.00054,0.5468066,0.0006214,0.004971,1.0936133,3.2808399,39.3700787,1000000000.0], "temp": false },
  "calcarea": { "bs": [1e-06,0.0001,0.0015,1.0,100.0,10000.0,1000000.0,3.861e-07,0.0002471,0.0395369,1.19599,9.0,900.0], "temp": false },
  "calcvolume": { "bs": [1.0,10.0,100.0,1000.0,10000.0,100000.0,1000000.0,1000000000.0,8.6484898,28.3775933,113.510373,908.0829843,1816.1659685,6.1102569,27.496156,219.9692483,1759.7539864,35195.0797279,66666.6666667,200000.0,67628.0454037,202884.1362111,4226.7528377,6.2898108,264.1720524,1056.6882094,2113.3764189,8453.5056755,33814.0227018,270512.1816147,2077533554.801234,0.0008107,1.3079506,35.3146667,61023.7440947], "temp": false },
  "calctemperature": { "bs": null, "temp": true },
  "calctime": { "bs": [1.0,24.0,0.1428571,1440.0000288,86400.0,86400000.0,0.0027397], "temp": false },
  "calcspeed": { "bs": [1.0,3.6,39.370079,0.001,3.3356e-09,0.0029386,2.236936], "temp": false },
  "calcpressure": { "bs": [1.0,100.0,1000.0,1000.0,100000.0,0.9869233,750.0616827,2088.5435121,14.5037744,29.5299875,1.0197162,10197.1621298], "temp": false },
  "calcpower": { "bs": [1.0,0.1757842,0.7354987,0.9863201,542.4760385,735.49875,0.6971183,75.0,735.49875], "temp": false },
  "calcangle": { "bs": [1.0,360.0,1296000.0,6.2831855,4.0,21600.0,6283.18548,399.99996], "temp": false },
  "calcforce": { "bs": [1.0,9.80665,0.0098067,999.9999971,2.2046226,0.0022046,0.001], "temp": false },
  "calcheat": { "bs": [1.0,0.001,1.1627e-06,1.5593e-06,1.5809e-06,0.4269569,0.0039674,3.0874843], "temp": false },
  "calcthickness": { "bs": [1.0,0.001,1.0,1000000.0,1000.0,1000.0], "temp": false },
  "calcdata": { "bs": [1.1368683772161603e-13,9.094947017729282e-13,9.313225746154785e-10,9.5367431640625e-07,0.0009765625,1.0], "temp": false },
    };
    var tabs = document.querySelectorAll('.t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.t-panel').forEach(function (p) { p.classList.remove('active'); });
            btn.classList.add('active');
            document.getElementById(btn.getAttribute('data-panel')).classList.add('active');
        });
    });
    document.querySelectorAll('.t-panel').forEach(function (panel) {
        var key = panel.id.replace('panel-', '');
        var cfg = DATA[key];
        var inputs = panel.querySelectorAll('.u-in');
        inputs.forEach(function (inp) {
            inp.addEventListener('input', function () {
                var v = parseFloat(inp.value);
                if (isNaN(v) || !isFinite(v)) { return; }
                var from = parseInt(inp.getAttribute('data-unit'), 10);
                inputs.forEach(function (other) {
                    var to = parseInt(other.getAttribute('data-unit'), 10);
                    var out;
                    if (cfg.temp) {
                        var c = toC(v, from);
                        out = fromC(c, to);
                    } else {
                        out = v * cfg.bs[from] / cfg.bs[to];
                    }
                    other.value = (Math.round(out * 1e10) / 1e10).toString();
                });
            });
        });
    });
    document.querySelectorAll('[data-reset]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var panel = document.getElementById(btn.getAttribute('data-reset'));
            panel.querySelectorAll('.u-in').forEach(function (i) { i.value = ''; });
        });
    });
    function toC(v, from) { return from === 0 ? v : from === 1 ? (v - 32) * 5 / 9 : from === 2 ? v - 273.15 : from === 3 ? (v - 491.67) * 5 / 9 : v * 5 / 4; }
    function fromC(c, to) { return to === 0 ? c : to === 1 ? c * 9 / 5 + 32 : to === 2 ? c + 273.15 : to === 3 ? (c + 273.15) * 9 / 5 : c * 4 / 5; }
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
