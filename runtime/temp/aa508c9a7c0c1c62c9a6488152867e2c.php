<?php /*a:6:{s:51:"/app/application/index/view/index/shaoshuminzu.html";i:1787036025;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.shaoshuminzu.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.shaoshuminzu.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.shaoshuminzu.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script><div class="container"><div class="tool-wrap"><div class="tool-card"><h2 class="tool-title"><span class="t-ico">👥</span>全国少数民族分布查询</h2><p class="tool-desc">中国少数民族地区分布查询工具为您提供全国少数民族分布表,少数民族,民族分布,民族分布查询,少数民族分布,少数民族地区分布,中国少数民族分布图等查询</p><form id="form1" class="form-horizontal" onsubmit="Public.TableSearch($('#table_minzu'), $('#keyword').val());return false;"> <div class="form-group"> <label class="col-sm-2 control-label">关键词：</label> <div class="col-sm-10"> <input class="form-control" type="text" id="keyword" name="keyword" placeholder="输入关键词"> </div> </div>
 	<div class="form-group">
		<div class="col-sm-12 text-center"><button type="button" class="btn btn-success" id="goSearch" onclick="Public.TableSearch($('#table_minzu'), $('#keyword').val())">查询</button> <button type="button" class="btn btn-default" id="btnSample" onclick="$('#keyword').val('苗族');Public.TableSearch($('#table_minzu'),'苗族');">示例</button> <input type="button" onclick="$('#keyword').val('');" value="清空" class="btn btn-default"></div>
	</div>	
</form> <table id="table_minzu" class="table table-bordered table-striped table-hover"> <thead> <tr> <th width="100px"> 民族名称 </th> <th> 主要分布地区 </th> </tr> </thead> <tbody> <tr> <td> 蒙古族 </td> <td> 内蒙古自治区，辽宁省，新疆维吾尔自治区，吉林省，黑龙江省，青海省，河北省，河南省，甘肃省，云南省。 </td> </tr> <tr> <td> 回族 </td> <td> 宁夏回族自治区，甘肃省，河南省，新疆维吾尔自治区，青海省，云南省，河北省，山东省，安徽省，辽宁省，北京市，黑龙江省，天津市，吉林省，陕西省。 </td> </tr> <tr> <td> 藏族 </td> <td> 西藏自治区，四川省，青海省，甘肃省，云南省。 </td> </tr> <tr> <td> 维吾尔族 </td> <td> 新疆维吾尔自治区，湖南省。 </td> </tr> <tr> <td> 苗族 </td> <td> 贵州省，云南省，湖南省，广西壮族自治区，四川省，广东省，湖北省。 </td> </tr> <tr> <td> 彝族 </td> <td> 四川省，云南省，贵州省，广西壮族自治区。 </td> </tr> <tr> <td> 壮族 </td> <td> 广西壮族自治区，云南省，广东省，贵州省。 </td> </tr> <tr> <td> 布依族 </td> <td> 贵州省。 </td> </tr> <tr> <td> 朝鲜族 </td> <td> 吉林省，黑龙江省，辽宁省。 </td> </tr> <tr> <td> 满族 </td> <td> 辽宁省，吉林省，黑龙江省，河北省，北京市，内蒙古自治区。 </td> </tr> <tr> <td> 侗族 </td> <td> 贵州省，湖南省，广西壮族自治区。 </td> </tr> <tr> <td> 瑶族 </td> <td> 广西壮族自治区，湖南省，云南省，广东省，贵州省，四川省。 </td> </tr> <tr> <td> 白族 </td> <td> 云南省，贵州省。 </td> </tr> <tr> <td> 土家族 </td> <td> 湖南省，湖北省，四川省。 </td> </tr> <tr> <td> 哈尼族 </td> <td> 云南省。 </td> </tr> <tr> <td> 哈萨克族 </td> <td> 新疆维吾尔自治区，甘肃省。 </td> </tr> <tr> <td> 傣族 </td> <td> 云南省。 </td> </tr> <tr> <td> 黎族 </td> <td> 海南省。 </td> </tr> <tr> <td> 僳僳族 </td> <td> 云南省，四川省。 </td> </tr> <tr> <td> 佤族 </td> <td> 云南省。 </td> </tr> <tr> <td> 畲族 </td> <td> 福建省，浙江省，江西省，广东省，安徽省。 </td> </tr> <tr> <td> 高山族 </td> <td> 台湾省，福建省。 </td> </tr> <tr> <td> 拉祜族 </td> <td> 云南省。 </td> </tr> <tr> <td> 水族 </td> <td> 贵州省，广西壮族自治区。 </td> </tr> <tr> <td> 东乡族 </td> <td> 甘肃省，新疆维吾尔自治区。 </td> </tr> <tr> <td> 纳西族 </td> <td> 云南省，四川省。 </td> </tr> <tr> <td> 景颇族 </td> <td> 云南省。 </td> </tr> <tr> <td> 柯尔克孜族 </td> <td> 新疆维吾尔自治区，黑龙江省。 </td> </tr> <tr> <td> 土族 </td> <td> 青海省，甘肃省。 </td> </tr> <tr> <td> 达斡尔族 </td> <td> 内蒙古自治区，黑龙江省，新疆维吾尔自治区。 </td> </tr> <tr> <td> 仫佬族 </td> <td> 广西壮族自治区。 </td> </tr> <tr> <td> 羌族 </td> <td> 四川省。 </td> </tr> <tr> <td> 布朗族 </td> <td> 云南省。 </td> </tr> <tr> <td> 撒拉族 </td> <td> 青海省，甘肃省。 </td> </tr> <tr> <td> 毛难族 </td> <td> 广西壮族自治区。 </td> </tr> <tr> <td> 仡佬族 </td> <td> 贵州省，广西壮族自治区，云南省。 </td> </tr> <tr> <td> 锡伯族 </td> <td> 新疆维吾尔自治区，辽宁省，吉林省。 </td> </tr> <tr> <td> 阿昌族 </td> <td> 云南省。 </td> </tr> <tr> <td> 普米族 </td> <td> 云南省。 </td> </tr> <tr> <td> 塔吉克族 </td> <td> 新疆维吾尔自治区。 </td> </tr> <tr> <td> 怒族 </td> <td> 云南省。 </td> </tr> <tr> <td> 乌孜别克族 </td> <td> 新疆维吾尔自治区。 </td> </tr> <tr> <td> 俄罗斯族 </td> <td> 新疆维吾尔自治区。 </td> </tr> <tr> <td> 鄂温克族 </td> <td> 内蒙古自治区，黑龙江省。 </td> </tr> <tr> <td> 德昂族 </td> <td> 云南省。 </td> </tr> <tr> <td> 保安族 </td> <td> 甘肃省。 </td> </tr> <tr> <td> 裕固族 </td> <td> 甘肃省。 </td> </tr> <tr> <td> 京族 </td> <td> 广西壮族自治区。 </td> </tr> <tr> <td> 塔塔尔族 </td> <td> 新疆维吾尔自治区。 </td> </tr> <tr> <td> 独龙族 </td> <td> 云南省。 </td> </tr> <tr> <td> 鄂伦春族 </td> <td> 内蒙古自治区，黑龙江省。 </td> </tr> <tr> <td> 赫哲族 </td> <td> 黑龙江省。 </td> </tr> <tr> <td> 门巴族 </td> <td> 西藏自治区。 </td> </tr> <tr> <td> 珞巴族 </td> <td> 西藏自治区。 </td> </tr> <tr> <td> 基诺族 </td> <td> 云南省。 </td> </tr> </tbody> </table></div></div></div><script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script><script src="/static/script/bootstrap.min.js" type="text/javascript"></script><script type="text/javascript">var Public={};Public.TableSearch=function(table,keyword){if(keyword){keyword=keyword.replace(/\s+/g,'')}if(!keyword){$('tr',table).each(function(){$(this).show()});return}var pattern=new RegExp(keyword),is_show=false,is_td=false,str='';$('tr',table).each(function(){is_show=false,is_td=false;$('td',this).each(function(){is_td=true;str=$(this).text().replace(/\s+/g,'');if(pattern.test(str)){is_show=true}});if(is_td){if(is_show){$(this).show()}else{$(this).hide()}}})}</script><div class="container foot-history" id="foot-history">
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