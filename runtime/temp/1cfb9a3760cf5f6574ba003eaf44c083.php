<?php /*a:4:{s:42:"/app/application/index/view/index/md5.html";i:1786516005;s:39:"/app/application/index/view/header.html";i:1786518426;s:36:"/app/application/index/view/nav.html";i:1786515843;s:39:"/app/application/index/view/footer.html";i:1786512781;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.md5.title')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.md5.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.md5.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/bootstrap.min.css" rel="stylesheet" type="text/css" /><link href="/static/style/tool.css" rel="stylesheet" type="text/css" />
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
<ul class="nav nav-tabs hbflag"><li role="presentation" class="active"><a href="/md5/">MD5加密工具</a></li><li role="presentation"><a href="/urlcode/">URL网址16进制加密</a></li><li role="presentation"><a href="/urlthunder/">迅雷旋风URL加解密</a></li><li role="presentation"><a href="/base64/"> Base64加密/解密</a></li><li role="presentation"><a href="/escape/">Escape加密/解密</a></li></ul><div class="panel"><form id="form1" class="form-horizontal" action="/md5/" method="post"><div class="form-group"><div class="col-sm-12"><textarea class="form-control" id="txt_md5" name="txt_md5" rows="10" placeholder="要加密的字符串"><?php echo htmlentities($txt_md5); ?></textarea></div></div><div class="form-group"><div class="col-sm-12 text-center"><button class="btn btn-success" type="submit">MD5加密</button><span id="copyallcode" class="btn btn-default" data-clipboard-target="#result">复制</span><button type="button" class="btn btn-default" onclick="ClearAll()">清空</button></div></div><?php if($txt_md5!=''): ?><div class="form-group"><div class="col-sm-12 text-left"><pre style="display: block;"><code id="result" class="hljs yaml"><span class="hljs-number">32</span><span class="hljs-string">位大写：</span><strong><span class="hljs-string"><?php echo htmlentities($md532_d); ?></span></strong>
<span class="hljs-number">32</span><span class="hljs-string">位小写：</span><strong><span class="hljs-string"><?php echo htmlentities($md532_x); ?></span></strong>
<span class="hljs-number">16</span><span class="hljs-string">位大写：</span><strong><span class="hljs-string"><?php echo htmlentities($md516_d); ?></span></strong>
<span class="hljs-number">16</span><span class="hljs-string">位小写：</span><strong><span class="hljs-string"><?php echo htmlentities($md516_x); ?></span></strong>
</code></pre></div></div><?php endif; ?></form></div></div><div class="alert alert alert-success alert-dismissible"><h4>MD5加密</h4><p>MD5加密是一种不可逆的加密算法,可根据加密值比较结果是否相等，MD5在线加密工具为您提供MD5在线加密,MD5加密工具,不可逆加密,16位及32位加密工具,实现32位大小写加密和16位大小写加密,可根据不同md5加密需求,选择不同的加密算法，MD5能够生成数据或文件的“数字指纹”，就像每个人都有自己独一无二的指纹一样，MD5生成的这个“数字指纹”也是独一无二的，可以用来验证数据或文件的一致性。本站不会记录您的任何信息,请放心使用。</p></div> <div class="accordion-group"> </div></div></div></div></div><script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script><script src="/static/script/bootstrap.min.js" type="text/javascript"></script><script src="/static/script/tool.js" type="text/javascript"></script><script src="/static/script/hightout.js"></script><script>is_show();</script><div class="container foot-history" id="foot-history">
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