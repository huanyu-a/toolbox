<?php /*a:6:{s:49:"/app/application/index/view/index/httpheader.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.httpheader.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.httpheader.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.httpheader.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script>
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">📮</span>HTTP 请求头大全</h2>
        <p class="tool-desc">HTTP请求头对照表为您提供HTTP请求头,HTTP响应头在编写采集器,API接口,模拟登录http头,远程获取内容等是必须要考虑的内容,并附HTTP请求方法对照表大全。</p>
        <ul class="t-tabs" id="hhTabs">
            <li><button type="button" class="t-tab active" data-panel="hhPanel1">📨 请求头大全</button></li>
            <li><button type="button" class="t-tab" data-panel="hhPanel2">🚀 请求方法大全</button></li>
        </ul>
        <div id="hhPanel1" class="t-panel active">
            <div style="overflow-x:auto">
                <table class="table table-bordered table-striped" style="margin:0">
                    <caption>HTTP Request Header 请求头</caption>
                    <thead><tr><th>Header</th><th>解释</th><th>示例</th></tr></thead>
                    <tbody>
<tr><td style="white-space:nowrap"><b>Accept</b></td><td>指定客户端能够接收的内容类型</td><td>Accept: text/plain, text/html</td></tr>
<tr><td style="white-space:nowrap"><b>Accept-Charset</b></td><td>浏览器可以接受的字符编码集。</td><td>Accept-Charset: iso-8859-5</td></tr>
<tr><td style="white-space:nowrap"><b>Accept-Encoding</b></td><td>指定浏览器可以支持的web服务器返回内容压缩编码类型。</td><td>Accept-Encoding: compress, gzip</td></tr>
<tr><td style="white-space:nowrap"><b>Accept-Language</b></td><td>浏览器可接受的语言</td><td>Accept-Language: en,zh</td></tr>
<tr><td style="white-space:nowrap"><b>Accept-Ranges</b></td><td>可以请求网页实体的一个或者多个子范围字段</td><td>Accept-Ranges: bytes</td></tr>
<tr><td style="white-space:nowrap"><b>Authorization</b></td><td>HTTP授权的授权证书</td><td>Authorization: Bearer &lt;token&gt;</td></tr>
<tr><td style="white-space:nowrap"><b>Cache-Control</b></td><td>指定请求和响应遵循的缓存机制</td><td>Cache-Control: no-cache</td></tr>
<tr><td style="white-space:nowrap"><b>Connection</b></td><td>表示是否需要持久连接。（HTTP 1.1默认进行持久连接）</td><td>Connection: close</td></tr>
<tr><td style="white-space:nowrap"><b>Cookie</b></td><td>HTTP请求发送时，会把保存在该请求域名下的所有cookie值一起发送给web服务器。</td><td>Cookie: $Version=1; Skin=new;</td></tr>
<tr><td style="white-space:nowrap"><b>Content-Length</b></td><td>请求的内容长度</td><td>Content-Length: 348</td></tr>
<tr><td style="white-space:nowrap"><b>Content-Type</b></td><td>请求的与实体对应的MIME信息</td><td>Content-Type: application/x-www-form-urlencoded</td></tr>
<tr><td style="white-space:nowrap"><b>Date</b></td><td>请求发送的日期和时间</td><td>Date: Tue, 15 Nov 2010 08:12:31 GMT</td></tr>
<tr><td style="white-space:nowrap"><b>Expect</b></td><td>请求的特定的服务器行为</td><td>Expect: 100-continue</td></tr>
<tr><td style="white-space:nowrap"><b>From</b></td><td>发出请求的用户的Email</td><td>From: user@jsons.cn</td></tr>
<tr><td style="white-space:nowrap"><b>Host</b></td><td>指定请求的服务器的域名和端口号</td><td>Host: www.jsons.cn</td></tr>
<tr><td style="white-space:nowrap"><b>If-Match</b></td><td>只有请求内容与实体相匹配才有效</td><td>If-Match: “特定值”</td></tr>
<tr><td style="white-space:nowrap"><b>If-Modified-Since</b></td><td>如果请求的部分在指定时间之后被修改则请求成功，未被修改则返回304代码</td><td>If-Modified-Since: Sat, 29 Oct 2010 19:43:31 GMT</td></tr>
<tr><td style="white-space:nowrap"><b>If-None-Match</b></td><td>如果内容未改变返回304代码，参数为服务器先前发送的Etag，与服务器回应的Etag比较判断是否改变</td><td>If-None-Match: “特定值”</td></tr>
<tr><td style="white-space:nowrap"><b>If-Range</b></td><td>如果实体未改变，服务器发送客户端丢失的部分，否则发送整个实体。参数也为Etag</td><td>If-Range: “特定值”</td></tr>
<tr><td style="white-space:nowrap"><b>If-Unmodified-Since</b></td><td>只在实体在指定时间之后未被修改才请求成功</td><td>If-Unmodified-Since: Sat, 29 Oct 2010 19:43:31 GMT</td></tr>
<tr><td style="white-space:nowrap"><b>Max-Forwards</b></td><td>限制信息通过代理和网关传送的时间</td><td>Max-Forwards: 10</td></tr>
<tr><td style="white-space:nowrap"><b>Pragma</b></td><td>用来包含实现特定的指令</td><td>Pragma: no-cache</td></tr>
<tr><td style="white-space:nowrap"><b>Proxy-Authorization</b></td><td>连接到代理的授权证书</td><td>Proxy-Authorization: Bearer &lt;token&gt;</td></tr>
<tr><td style="white-space:nowrap"><b>Range</b></td><td>只请求实体的一部分，指定范围</td><td>Range: bytes=500-999</td></tr>
<tr><td style="white-space:nowrap"><b>Referer</b></td><td>先前网页的地址，当前请求网页紧随其后,即来路</td><td>Referer: http://www.jsons.cn</td></tr>
<tr><td style="white-space:nowrap"><b>TE</b></td><td>客户端愿意接受的传输编码，并通知服务器接受接受尾加头信息</td><td>TE: trailers,deflate;q=0.5</td></tr>
<tr><td style="white-space:nowrap"><b>Upgrade</b></td><td>向服务器指定某种传输协议以便服务器进行转换（如果支持）</td><td>Upgrade: HTTP/2.0, SHTTP/1.3, IRC/6.9, RTA/x11</td></tr>
<tr><td style="white-space:nowrap"><b>User-Agent</b></td><td>User-Agent的内容包含发出请求的用户信息</td><td>User-Agent: Mozilla/5.0 (Linux; X11)</td></tr>
<tr><td style="white-space:nowrap"><b>Via</b></td><td>通知中间网关或代理服务器地址，通信协议</td><td>Via: 1.0 fred, 1.1 nowhere.com (Apache/1.1)</td></tr>
<tr><td style="white-space:nowrap"><b>Warning</b></td><td>关于消息实体的警告信息</td><td>Warn: 199 Miscellaneous warning</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="hhPanel2" class="t-panel">
            <div style="overflow-x:auto">
                <table class="table table-bordered table-striped" style="margin:0">
                    <caption>HTTP Request 请求方法</caption>
                    <thead><tr><th>方法</th><th>说明</th><th>适用场景</th></tr></thead>
                    <tbody>
<tr><td style="white-space:nowrap"><b>GET</b></td><td>请求指定的页面信息，并返回实体主体。</td><td>获取/查询资源，参数拼接在 URL 中，只读操作（浏览、搜索、分页）</td></tr>
<tr><td style="white-space:nowrap"><b>HEAD</b></td><td>类似于 GET 请求，只返回响应头、不返回响应体，用于获取报头</td><td>探测资源是否存在、大小、最后修改时间等元信息</td></tr>
<tr><td style="white-space:nowrap"><b>POST</b></td><td>向指定资源提交数据进行处理请求（例如提交表单或者上传文件）。数据被包含在请求体中。POST请求可能会导致新的资源的建立和/或已有资源的修改。</td><td>提交表单、上传文件、登录、创建新资源</td></tr>
<tr><td style="white-space:nowrap"><b>PUT</b></td><td>从客户端向服务器传送的数据取代指定的文档的内容。</td><td>整体更新/替换资源（幂等），上传文件到指定位置</td></tr>
<tr><td style="white-space:nowrap"><b>DELETE</b></td><td>请求服务器删除指定的页面。</td><td>删除资源（幂等）</td></tr>
<tr><td style="white-space:nowrap"><b>CONNECT</b></td><td>HTTP/1.1协议中预留给能够将连接改为管道方式的代理服务器。</td><td>建立代理隧道（如 HTTPS 经代理转发）</td></tr>
<tr><td style="white-space:nowrap"><b>OPTIONS</b></td><td>允许客户端查看服务器的性能。</td><td>探测服务器支持的请求方法、CORS 预检请求</td></tr>
<tr><td style="white-space:nowrap"><b>TRACE</b></td><td>回显服务器收到的请求，主要用于测试或诊断。</td><td>网络调试、追踪代理链路</td></tr>
<tr><td style="white-space:nowrap"><b>PATCH</b></td><td>实体中包含一个表，表中说明与该URI所表示的原内容的区别。</td><td>对资源做部分修改（局部更新）</td></tr>
<tr><td style="white-space:nowrap"><b>MOVE</b></td><td>请求服务器将指定的页面移至另一个网络地址。</td><td>WebDAV 移动文件/目录</td></tr>
<tr><td style="white-space:nowrap"><b>COPY</b></td><td>请求服务器将指定的页面拷贝至另一个网络地址。</td><td>WebDAV 复制文件/目录</td></tr>
<tr><td style="white-space:nowrap"><b>LINK</b></td><td>请求服务器建立链接关系。</td><td>WebDAV 建立资源链接</td></tr>
<tr><td style="white-space:nowrap"><b>UNLINK</b></td><td>断开链接关系。</td><td>WebDAV 解除资源链接</td></tr>
<tr><td style="white-space:nowrap"><b>WRAPPED</b></td><td>允许客户端发送经过封装的请求。</td><td>封装传输扩展协议</td></tr>
<tr><td style="white-space:nowrap"><b>Extension-method</b></td><td>在不改动协议的前提下，可增加另外的方法。</td><td>自定义扩展方法（如 WebDAV、私有接口）</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div></div>
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
    var tabs = document.querySelectorAll('#hhTabs .t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
