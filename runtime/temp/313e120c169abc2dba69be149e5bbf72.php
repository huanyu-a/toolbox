<?php /*a:4:{s:41:"/app/application/index/view/index/ip.html";i:1786516005;s:39:"/app/application/index/view/header.html";i:1786518426;s:36:"/app/application/index/view/nav.html";i:1786515843;s:39:"/app/application/index/view/footer.html";i:1786512781;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.ip.title')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.ip.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.ip.description')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.ip.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/bootstrap.min.css" rel="stylesheet" type="text/css" /><link href="/static/style/tool.css" rel="stylesheet" type="text/css" />
<link href="/static/style/app.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><?php echo app('config')->get('web.header'); ?></head><body><nav class="navbar navbar-default navbar-static-top navbar-fixed-top topbar" role="navigation">
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
<div class="container"><div class="row"><div class="col-md-12 col10main"><div class="accordion" id="accordion2"><div class="accordion-group">
<ul class="nav nav-tabs hbflag"><li role="presentation" class="active"><a href="/ip/">IP地址归属地查询</a></li><li role="presentation"><a href="/websocket/">Websocket测试</a></li><li role="presentation"><a href="/browserinfo/">获取浏览器信息</a></li></ul><div class="panel"><form id="ip" class="form-horizontal" method="post"><div class="form-group mt10"><div class="col-sm-6 col-md-offset-3 form-inline"><label>IP/域名查询：</label>  <input type="text" id="ip_address" name="ip" tabindex="1" class="form-control" size="30" placeholder="输入查询的IP 或 域名" value="" /><input type="button" value="查询" id="ut2dt" tabindex="2" class="btn btn-success" onclick="chaip()" /></div></div></form><div class="form-group"><div class="col-md-12"><?php if(isset($ym)): ?><p class="text-l panel-content-text">IP/域名[<?php echo htmlentities($ym['ip']); ?>]的位置信息</p><table class="table table-hover table-bordered table-striped"><tbody> <tr class="bg-ddd">  <td class="text-c">IP/域名</td>  <td class="text-c">获取到的IP地址</td>  <td class="text-c">数字地址</td>    <td class="text-c">所处IP段范围</td>    <td class="text-c">IP的物理位置</td></tr> <tr><td class="text-c"><?php echo htmlentities($ym['ip']); ?></td><td class="text-c"><?php echo htmlentities($ym['domain']); ?></td><td class="text-c"><?php echo htmlentities(ip2long($ym['domain'])); ?></td><td class="text-c"><?php echo htmlentities($ym['fw']); ?></td><td class="text-c f14"><?php echo htmlentities($ym['city']); ?></td></tr></tbody></table>
<?php else: ?><p style="color:red;text-align:center">域名或IP解析失败</p><?php endif; ?>
</div></div><script>function chaip(){var ip=$("input[name='ip']").val();if(ip.length==''){pcjson_com_msg($('#ip_address'),'请输入IP地址 或 域名');return false;}if(!check_is_ip(ip) && !check_is_url(ip)){pcjson_com_msg($('#ip_address'),'输入正确的IP 或 域名');return false;}$("form#ip").submit();}</script><div class="form-group" style="margin-top:50px"><div class="col-sm-12"><div id="randomNumbers" class="alert blue alert-info f14">您的本机IP地址：<label class='label-color'><?php echo htmlentities($getip); ?></label>  &nbsp;&nbsp;来自：<label class='label-color'><?php echo htmlentities($city); ?></label>  &nbsp;&nbsp;操作系统：<label class='label-color'><?php echo htmlentities($getBrowserOs['0']); ?></label>&nbsp;&nbsp;浏览器：<label class='label-color'><?php echo htmlentities($getBrowserOs['1']); ?></label></div></div></div></div></div> <div class="accordion-group"> </div></div></div></div></div><script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script><script src="/static/script/bootstrap.min.js" type="text/javascript"></script><script src="/static/script/tool.js" type="text/javascript"></script><script src="/static/script/func.js" type="text/javascript"></script><div class="container foot-history" id="foot-history">
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
<script src="/static/script/app.js" type="text/javascript"></script>
</body></html>