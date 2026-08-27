<?php /*a:6:{s:46:"/app/application/index/view/index/html2js.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.html2js.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.html2js.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.html2js.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script><div class="container"><div class="tool-wrap"><div class="tool-card"><h2 class="tool-title"><span class="t-ico">🔄</span>Html转JS/多语言代码</h2><p class="tool-desc">Html转JS字符串、JS数组、JS还原，Html转C#/JSP/PHP/ASP/VB.NET/Perl代码，HTML与UBB互转，HTML表格生成器，Excel/CSV转HTML表格。输入输出共用同一区域，切换功能时输入内容自动保留，全部本地转换，不上传任何数据。</p>
<ul class="t-tabs"><li><button type="button" class="t-tab active" data-mode="js">💻 HTML↔JS</button></li><li><button type="button" class="t-tab" data-mode="cj">🔤 HTML↔C#/JSP</button></li><li><button type="button" class="t-tab" data-mode="php">🐘 HTML↔PHP</button></li><li><button type="button" class="t-tab" data-mode="asp">📜 HTML↔ASP/Perl</button></li><li><button type="button" class="t-tab" data-mode="ubb">🔁 HTML↔UBB</button></li><li><button type="button" class="t-tab" data-mode="table">📋 表格生成器</button></li><li><button type="button" class="t-tab" data-mode="csv">📊 CSV转表格</button></li></ul>
<label class="t-label" for="h2j-in">待转换内容</label>
<textarea class="t-area" id="h2j-in" rows="8" placeholder="粘贴 HTML / JS 代码，如：&lt;div class=&quot;box&quot;&gt;你好&lt;/div&gt;"></textarea>
<div class="t-options" style="margin-top:12px;display:none" id="opt-table-params">
<div class="t-row">
<div class="t-flex1"><label class="t-label" for="tblRows">行数</label><input type="number" class="t-input" id="tblRows" value="5" min="1" max="50" /></div>
<div class="t-flex1"><label class="t-label" for="tblCols">列数</label><input type="number" class="t-input" id="tblCols" value="5" min="1" max="20" /></div>
<div class="t-flex1"><label class="t-label" for="tblStyle">样式</label><select class="t-input" id="tblStyle"><option value="plain">普通表格</option><option value="striped">斑马纹</option><option value="bordered">全边框</option><option value="hover">悬停高亮</option></select></div>
</div>
<div class="t-row">
<div class="t-flex1"><label class="t-label" for="tblHead">表头内容（逗号分隔，可选）</label><input type="text" class="t-input" id="tblHead" placeholder="如：姓名,年龄,城市" /></div>
<div class="t-flex1"><label class="t-label" for="tblCaption">表格标题（可选）</label><input type="text" class="t-input" id="tblCaption" placeholder="如：员工列表" /></div>
</div>
</div>
<div class="t-options" style="margin-top:12px;display:none" id="opt-csv-params">
<div class="t-row">
<div class="t-flex1"><label class="t-label" for="csvSep">分隔符</label><select class="t-input" id="csvSep"><option value=",">逗号 ,</option><option value="&#9;">Tab 制表符</option><option value="|">竖线 |</option><option value=";">分号 ;</option></select></div>
<div class="t-flex1"><label class="t-label" style="padding-top:18px"><input type="checkbox" id="csvHead" checked /> 首行为表头</label></div>
</div>
</div>
<div class="tool-actions" id="opt-js">
<button type="button" class="t-btn t-btn-ok" id="jsToJs">Html转为JS</button><button type="button" class="t-btn t-btn-ok" id="jsToHtml">JS转为Html</button><button type="button" class="t-btn t-btn-ok" id="jsToArray">Html转为JS数组</button>
</div>
<div class="tool-actions" id="opt-cj" style="display:none">
<button type="button" class="t-btn t-btn-ok" id="cjToCsharp">Html转为C#代码</button><button type="button" class="t-btn t-btn-ok" id="cjToJsp">Html转为JSP代码</button>
</div>
<div class="tool-actions" id="opt-php" style="display:none">
<button type="button" class="t-btn t-btn-ok" id="phpRun">Html转PHP代码</button>
</div>
<div class="tool-actions" id="opt-asp" style="display:none">
<button type="button" class="t-btn t-btn-ok" id="aspRun">Html转ASP</button><button type="button" class="t-btn t-btn-ok" id="aspVbnet">Html转VB.NET</button><button type="button" class="t-btn t-btn-ok" id="aspPerl">Html转Perl</button><button type="button" class="t-btn t-btn-ok" id="aspSws">Html转Sws</button>
</div>
<div class="tool-actions" id="opt-ubb" style="display:none">
<button type="button" class="t-btn" id="ubbToUbb">Html转UBB</button><button type="button" class="t-btn t-btn-ok" id="ubbToHtml">UBB转Html</button>
</div>
<div class="tool-actions" id="opt-table" style="display:none">
<button type="button" class="t-btn" id="tblRun">生成表格</button>
</div>
<div class="tool-actions" id="opt-csv" style="display:none">
<button type="button" class="t-btn" id="csvRun">转换 HTML 表格</button>
</div>
<div class="tool-actions">
<button type="button" class="t-btn t-btn-ghost" data-copy="#h2j-out">复制结果</button>
<button type="button" class="t-btn t-btn-ghost" id="h2jClear">清空</button>
</div>
<div class="t-result" id="h2j-result"><pre><code id="h2j-out"></code></pre></div>
<div class="t-error" id="h2j-error"></div>
</div>
<div class="tool-card">
<h2 class="tool-title">📖 关于本页</h2>
<p class="tool-desc">本页面将 8 个 HTML 转换工具合并为一处，共 7 大转换功能，全部在浏览器本地完成，不会上传您的代码：</p>
<ul>
<li><strong>HTML↔JS</strong>：HTML 拼接为 JS 字符串（var sd='...'）、JS 代码还原为 HTML、HTML 转为 JS 数组格式。</li>
<li><strong>HTML↔C#/JSP</strong>：HTML 转为 C# StringBuilder 拼接代码，或 JSP 的 out.println 输出语句，自动处理引号与反斜杠转义。</li>
<li><strong>HTML↔PHP</strong>：HTML 转为 PHP echo 输出语句（&lt;?php ... ?&gt;）。</li>
<li><strong>HTML↔ASP/Perl</strong>：HTML 转为 ASP（Response.Write）、VB.NET、Perl（print）、Sws（STRING）输出语句。</li>
<li><strong>HTML↔UBB</strong>：HTML 与 UBB 标签互相转换，支持 b/i/u/url/img/quote/color/size 等常用标签。</li>
<li><strong>HTML 表格生成器</strong>：按行数、列数、样式、表头与标题快速生成 table 代码。</li>
<li><strong>Excel/CSV→HTML 表格</strong>：粘贴 CSV/TSV 数据（支持引号包裹与转义），一键生成 &lt;table&gt; 代码。</li>
</ul>
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
<script src="/static/script/toolbox.js" type="text/javascript"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script type="text/javascript">
(function () {
    'use strict';
    function $id(id) { return document.getElementById(id); }
    function escapeHtml(s) { return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;'); }
    function showErr(msg) { var e = $id('h2j-error'); e.textContent = msg; e.classList.add('show'); }
    function clearOut() {
        $id('h2j-out').textContent = '';
        $id('h2j-result').classList.remove('show');
        $id('h2j-error').classList.remove('show');
    }
    function showResult(text) { clearOut(); $id('h2j-out').textContent = text; $id('h2j-result').classList.add('show'); }
    function needInput(msg) {
        var input = $id('h2j-in');
        if (input.style.display === 'none') return false;
        if (!input.value.trim()) { showErr(msg); return true; }
        return false;
    }

    /* ===== 模式注册表 ===== */
    var MODES = {
        js:     { placeholder: '粘贴 HTML / JS 代码，如：<div class="box">你好</div>', showInput: true },
        cj:     { placeholder: '请输入要转换的 HTML 代码', showInput: true },
        php:    { placeholder: '请输入要转换的 HTML 代码', showInput: true },
        asp:    { placeholder: '请输入要转换的 HTML 代码', showInput: true },
        ubb:    { placeholder: '粘贴 HTML 或 UBB 代码，如：[url=http://www.example.com]链接[/url] 或 <a href="http://www.example.com">链接</a>', showInput: true },
        table:  { placeholder: '', showInput: false },
        csv:    { placeholder: '年份,供应商,型号,说明,价格\n2017,Ford,E350,"ac, abs, moon",5000.00', showInput: true }
    };
    var current = 'js';
    var tabs = document.querySelectorAll('.t-tab');
    function switchMode(mode) {
        current = mode;
        tabs.forEach(function (b) { b.classList.toggle('active', b.getAttribute('data-mode') === mode); });
        Object.keys(MODES).forEach(function (m) {
            var opt = $id('opt-' + m);
            if (opt) opt.style.display = (m === mode) ? '' : 'none';
            var params = $id('opt-' + m + '-params');
            if (params) params.style.display = (m === mode) ? '' : 'none';
        });
        $id('h2j-in').style.display = MODES[mode].showInput ? '' : 'none';
        $id('h2j-in').placeholder = MODES[mode].placeholder;
        clearOut();
    }
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () { switchMode(btn.getAttribute('data-mode')); });
    });
    $id('h2jClear').addEventListener('click', function () {
        $id('h2j-in').value = '';
        clearOut();
        $id('h2j-in').focus();
    });

    /* ============ HTML↔JS ============ */
    function jsString(input) {
        return "var sd='" + input.replace(/\\/g, '\\\\').replace(/'/g, "\\'").replace(/"/g, '\\"').split('\n').join("';\nsd+='") + "';";
    }
    function jsArray(input) {
        return "['" + input.replace(/\\/g, '\\\\').replace(/'/g, "\\'").replace(/"/g, '\\"').split('\n').join("','") + "']";
    }
    function jsToHtml(input) {
        return input
            .replace(/var sd='/g, '')
            .replace(/sd\+='/g, '')
            .replace(/';$/m, '')
            .replace(/\\'/g, "'")
            .replace(/\\"/g, '"')
            .replace(/\\\\/g, '\\');
    }
    $id('jsToJs').addEventListener('click', function () { if (needInput('请输入要转换的 HTML 代码')) return; showResult(jsString($id('h2j-in').value)); });
    $id('jsToHtml').addEventListener('click', function () { if (needInput('请输入要还原的 JS 代码')) return; showResult(jsToHtml($id('h2j-in').value)); });
    $id('jsToArray').addEventListener('click', function () { if (needInput('请输入要转换的 HTML 代码')) return; showResult(jsArray($id('h2j-in').value)); });

    /* ============ HTML↔C#/JSP ============ */
    function toJsp(s) {
        if (s === '') return '<' + '%\n%' + '>';
        var out = 'out.println("';
        for (var c = 0; c < s.length; c++) {
            if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
                out += '");';
                if (c !== s.length - 1) out += '\nout.println("';
                c++;
            } else if (s.charAt(c) === '"') {
                out += '\\"';
            } else if (s.charAt(c) === '\\') {
                out += '\\\\';
            } else {
                out += s.charAt(c);
                if (c === s.length - 1) out += '");';
            }
        }
        return '<' + '%\n' + out + '\n%' + '>';
    }
    function toCSharp(s) {
        var body = s
            .replace(/\\/g, '\\\\')
            .replace(/\//g, '\\/')
            .replace(/'/g, "\\'")
            .replace(/"/g, '\\"')
            .split('\n')
            .join('");\nsb.AppendFormat("');
        return 'StringBuilder sb = new StringBuilder();\nsb.AppendFormat("' + body + '");';
    }
    $id('cjToCsharp').addEventListener('click', function () { if (needInput('请输入要转换的HTML代码')) return; showResult(toCSharp($id('h2j-in').value)); });
    $id('cjToJsp').addEventListener('click', function () { if (needInput('请输入要转换的HTML代码')) return; showResult(toJsp($id('h2j-in').value)); });

    /* ============ HTML↔PHP ============ */
    function toPhp(s) {
        if (s === '') return '<' + '?php\n?' + '>';
        var out = 'echo "';
        for (var c = 0; c < s.length; c++) {
            if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
                out += '\\n";';
                if (c !== s.length - 1) out += '\necho "';
                c++;
            } else if (s.charAt(c) === '"') {
                out += '\\"';
            } else if (s.charAt(c) === '\\') {
                out += '\\\\';
            } else {
                out += s.charAt(c);
                if (c === s.length - 1) out += '\\n";';
            }
        }
        return '<' + '?php\n' + out + '\n?' + '>';
    }
    $id('phpRun').addEventListener('click', function () { if (needInput('请输入要转换的HTML代码')) return; showResult(toPhp($id('h2j-in').value)); });

    /* ============ HTML↔ASP/Perl ============ */
    function toAsp(s) {
        if (s === '') return '<' + '%\n%' + '>';
        var out = 'Response.Write "';
        for (var c = 0; c < s.length; c++) {
            if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
                out += '"';
                if (c !== s.length - 1) out += '\nResponse.Write "';
                c++;
            } else if (s.charAt(c) === '"') {
                out += '""';
            } else if (s.charAt(c) === '\\') {
                out += '\\\\';
            } else {
                out += s.charAt(c);
                if (c === s.length - 1) out += '"';
            }
        }
        return '<' + '%\n' + out + '\n%' + '>';
    }
    function toVbnet(s) {
        if (s === '') return '<' + '%\n%' + '>';
        var out = 'Response.Write ("';
        for (var c = 0; c < s.length; c++) {
            if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
                out += '");';
                if (c !== s.length - 1) out += '\nResponse.Write ("';
                c++;
            } else if (s.charAt(c) === '"') {
                out += '""';
            } else if (s.charAt(c) === '\\') {
                out += '\\\\';
            } else {
                out += s.charAt(c);
                if (c === s.length - 1) out += '");';
            }
        }
        return '<' + '%\n' + out + '\n%' + '>';
    }
    function toPerl(s) {
        if (s === '') return 'hello world!';
        var out = 'print "';
        for (var c = 0; c < s.length; c++) {
            if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
                out += '\\n";';
                if (c !== s.length - 1) out += '\nprint "';
                c++;
            } else if (s.charAt(c) === '"') {
                out += '\\"';
            } else if (s.charAt(c) === '\\') {
                out += '\\\\';
            } else {
                out += s.charAt(c);
                if (c === s.length - 1) out += '\\n";';
            }
        }
        return out;
    }
    function toSws(s) {
        if (s === '') return '';
        var out = 'STRING "';
        for (var c = 0; c < s.length; c++) {
            if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
                out += '"';
                if (c !== s.length - 1) out += '\nSTRING "';
                c++;
            } else if (s.charAt(c) === '"') {
                out += '\\"';
            } else if (s.charAt(c) === '\\') {
                out += '\\\\';
            } else {
                out += s.charAt(c);
                if (c === s.length - 1) out += '"';
            }
        }
        return out;
    }
    $id('aspRun').addEventListener('click', function () { if (needInput('请输入要转换的HTML代码')) return; showResult(toAsp($id('h2j-in').value)); });
    $id('aspVbnet').addEventListener('click', function () { if (needInput('请输入要转换的HTML代码')) return; showResult(toVbnet($id('h2j-in').value)); });
    $id('aspPerl').addEventListener('click', function () { if (needInput('请输入要转换的HTML代码')) return; showResult(toPerl($id('h2j-in').value)); });
    $id('aspSws').addEventListener('click', function () { if (needInput('请输入要转换的HTML代码')) return; showResult(toSws($id('h2j-in').value)); });

    /* ============ HTML↔UBB ============ */
    function phpcode(s) { return '<pre>' + s + '</pre>'; }
    function smilepath(n) { return '[s:' + n + ']'; }
    function pattern(str) {
        str = str.replace(/<br[^>]*>/ig, '\n');
        str = str.replace(/<p[^>\/]*\/>/ig, '\n');
        str = str.replace(/\son[\w]{3,16}\s?=\s*([\'"]).+?\1/ig, '');
        str = str.replace(/<hr[^>]*>/ig, '[hr]');
        str = str.replace(/<(sub|sup|u|strike|b|i|pre)>/ig, '[$1]');
        str = str.replace(/<\/(sub|sup|u|strike|b|i|pre)>/ig, '[/$1]');
        str = str.replace(/<(\/)?strong>/ig, '[$1b]');
        str = str.replace(/<(\/)?em>/ig, '[$1i]');
        str = str.replace(/<(\/)?blockquote([^>]*)>/ig, '[$1blockquote]');
        str = str.replace(/<img[^>]*smile="(\d+)"[^>]*>/ig, '[s:$1]');
        str = str.replace(/<img[^>]*src=[\'"\s]*([^\s\'"]+)[^>]*>/ig, '[img]$1[/img]');
        str = str.replace(/<a[^>]*href=[\'"\s]*([^\s\'"]*)[^>]*>(.+?)<\/a>/ig, '[url=$1]$2[/url]');
        str = str.replace(/<[^>]*?>/ig, '');
        str = str.replace(/&amp;/ig, '&');
        str = str.replace(/&lt;/ig, '<');
        str = str.replace(/&gt;/ig, '>');
        return str;
    }
    function up(str) {
        str = str.replace(/</ig, '&lt;');
        str = str.replace(/>/ig, '&gt;');
        str = str.replace(/\n/ig, '<br />');
        str = str.replace(/\[code\](.+?)\[\/code\]/ig, function ($1, $2) { return phpcode($2); });
        str = str.replace(/\[hr\]/ig, '<hr />');
        str = str.replace(/\[\/(size|color|font|backcolor)\]/ig, '</font>');
        str = str.replace(/\[(sub|sup|u|i|strike|b|blockquote|li)\]/ig, '<$1>');
        str = str.replace(/\[\/(sub|sup|u|i|strike|b|blockquote|li)\]/ig, '</$1>');
        str = str.replace(/\[\/align\]/ig, '</p>');
        str = str.replace(/\[(\/)?h([1-6])\]/ig, '<$1h$2>');
        str = str.replace(/\[align=(left|center|right|justify)\]/ig, '<p align="$1">');
        str = str.replace(/\[size=(\d+?)\]/ig, '<font size="$1">');
        str = str.replace(/\[color=([^\[\<]+?)\]/ig, '<font color="$1">');
        str = str.replace(/\[backcolor=([^\[\<]+?)\]/ig, '<font style="background-color:$1">');
        str = str.replace(/\[font=([^\[\<]+?)\]/ig, '<font face="$1">');
        str = str.replace(/\[list=(a|A|1)\](.+?)\[\/list\]/ig, '<ol type="$1">$2</ol>');
        str = str.replace(/\[(\/)?list\]/ig, '<$1ul>');
        str = str.replace(/\[s:(\d+)\]/ig, function ($1, $2) { return smilepath($2); });
        str = str.replace(/\[img\]([^\[]*)\[\/img\]/ig, '<img src="$1" border="0" />');
        str = str.replace(/\[url=([^\]]+)\]([^\[]+)\[\/url\]/ig, '<a href="$1">$2</a>');
        str = str.replace(/\[url\]([^\[]+)\[\/url\]/ig, '<a href="$1">$1</a>');
        return str;
    }
    $id('ubbToUbb').addEventListener('click', function () { if (needInput('请输入要转换的 HTML 代码')) return; showResult(pattern($id('h2j-in').value)); });
    $id('ubbToHtml').addEventListener('click', function () { if (needInput('请输入要转换的 UBB 代码')) return; showResult(up($id('h2j-in').value)); });

    /* ============ HTML 表格生成器 ============ */
    $id('tblRun').addEventListener('click', function () {
        clearOut();
        var rows = parseInt($id('tblRows').value, 10) || 5;
        var cols = parseInt($id('tblCols').value, 10) || 5;
        var style = $id('tblStyle').value;
        var head = $id('tblHead').value.split(',').map(function (s) { return s.trim(); });
        var caption = $id('tblCaption').value;
        var cls = style === 'striped' ? ' class="striped"' : style === 'bordered' ? ' class="bordered"' : style === 'hover' ? ' class="hover"' : '';
        var html = '<table' + cls + '>\n';
        if (caption) html += '  <caption>' + escapeHtml(caption) + '</caption>\n';
        if (head.length > 0 && head[0]) {
            html += '  <thead>\n    <tr>\n';
            for (var h = 0; h < cols; h++) html += '      <th>' + escapeHtml(head[h] || '列' + (h + 1)) + '</th>\n';
            html += '    </tr>\n  </thead>\n';
        }
        html += '  <tbody>\n';
        for (var r = 0; r < rows; r++) {
            html += '    <tr>\n';
            for (var c = 0; c < cols; c++) html += '      <td>行' + (r + 1) + '列' + (c + 1) + '</td>\n';
            html += '    </tr>\n';
        }
        html += '  </tbody>\n</table>';
        showResult(html);
    });

    /* ============ Excel/CSV→HTML 表格 ============ */
    function parseCsvLine(line, sep) {
        var cells = [], cur = '', inQ = false;
        for (var i = 0; i < line.length; i++) {
            var ch = line.charAt(i);
            if (inQ) {
                if (ch === '"') {
                    if (line.charAt(i + 1) === '"') { cur += '"'; i++; }
                    else inQ = false;
                } else cur += ch;
            } else {
                if (ch === '"') inQ = true;
                else if (ch === sep) { cells.push(cur); cur = ''; }
                else cur += ch;
            }
        }
        cells.push(cur);
        return cells.map(function (x) { return x.trim(); });
    }
    $id('csvRun').addEventListener('click', function () {
        clearOut();
        var raw = $id('h2j-in').value;
        if (!raw.trim()) { showErr('请输入 CSV / TSV 数据'); return; }
        var sep = $id('csvSep').value;
        if (sep === '&#9;') sep = '\t';
        var hasHead = $id('csvHead').checked;
        var lines = raw.replace(/\r\n/g, '\n').replace(/\r/g, '\n').split('\n').filter(function (l) { return l.trim() !== ''; });
        var rows = lines.map(function (l) { return parseCsvLine(l, sep); });
        var html = '<table>\n';
        var start = 0;
        if (hasHead && rows.length > 0) {
            html += '  <thead>\n    <tr>\n';
            rows[0].forEach(function (c) { html += '      <th>' + escapeHtml(c) + '</th>\n'; });
            html += '    </tr>\n  </thead>\n';
            start = 1;
        }
        html += '  <tbody>\n';
        for (var i = start; i < rows.length; i++) {
            html += '    <tr>\n';
            rows[i].forEach(function (c) { html += '      <td>' + escapeHtml(c) + '</td>\n'; });
            html += '    </tr>\n';
        }
        html += '  </tbody>\n</table>';
        showResult(html);
    });
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
