<?php /*a:6:{s:45:"/app/application/index/view/index/format.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.format.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.format.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.format.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
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
        <h2 class="tool-title"><span class="t-ico">🧹</span>代码格式化工具</h2>
        <p class="tool-desc">一站式代码格式化与美化，支持 C/C++/C#/Java/PHP/Python/Ruby/Perl/VBScript/SQL/XML/CSS/JS/HTML 共 14 种语言；JS/CSS/HTML 支持压缩输出。选择语言后粘贴代码，点击「格式化」即可排版。</p>
        <label class="t-label">语言
            <select id="t-lang">
                <option value="js" selected>JS</option>
                <option value="html">HTML</option>
                <option value="css">CSS</option>
                <option value="c">C</option>
                <option value="cpp">C++</option>
                <option value="cs">C#</option>
                <option value="java">Java</option>
                <option value="php">PHP</option>
                <option value="py">Python</option>
                <option value="ruby">Ruby</option>
                <option value="perl">Perl</option>
                <option value="vbs">VBScript</option>
                <option value="sql">SQL</option>
                <option value="xml">XML</option>
            </select>
        </label>
        <textarea class="t-area" id="content" rows="14" spellcheck="false" placeholder="请输入要格式化的JS代码"></textarea>
        <div class="t-options">
            <label class="t-opt">缩进
                <select id="tabsize">
                    <option value="1">Tab 制表符</option>
                    <option value="2">2 个空格</option>
                    <option value="4" selected>4 个空格</option>
                    <option value="8">8 个空格</option>
                </select>
            </label>
            <label class="t-opt" id="opt-brace" style="display:none">括号风格
                <select id="brace-style">
                    <option value="collapse" selected>控制语句括号同行</option>
                    <option value="expand">开始括号单独一行</option>
                    <option value="end-expand">结束括号单独一行</option>
                </select>
            </label>
            <span class="t-opt-group" id="opt-css">
                <label><input type="checkbox" id="delnotes">删除注释</label>
                <label><input type="checkbox" id="tolower" checked>属性转小写</label>
                <label><input type="checkbox" id="chk">横向排列</label>
                <label><input type="checkbox" id="opt-css-pack">压缩输出</label>
            </span>
            <span class="t-opt-group" id="opt-js">
                <label><input type="checkbox" id="opt-js-pack">压缩输出</label>
                <label><input type="checkbox" id="opt-js-obf">加密混淆压缩</label>
            </span>
            <span class="t-opt-group" id="opt-html">
                <label><input type="checkbox" id="opt-html-pack">压缩输出</label>
            </span>
        </div>
        <div class="tool-actions">
            <button type="button" class="t-btn" id="btn-format">格式化</button>
            <button type="button" class="t-copy" id="btn-copy">复制</button>
            <button type="button" class="t-btn t-btn-ghost" id="btn-clear">清空</button>
        </div>
        <div class="t-note">提示：原「代码过滤/筛选」功能已合并至 HTML 格式化。</div>
        <pre class="t-result" id="t-result"><code id="result"></code></pre>
        <div class="t-error" id="t-error"></div>
    </div>
</div></div>
<style>
.t-label { display: flex; align-items: center; gap: 8px; margin: 0 0 10px; font-size: 14px; color: var(--text-2, #555); font-weight: 600; }
.t-label select { border: 1px solid var(--border, #e5e7eb); border-radius: 6px; padding: 6px 8px; font-size: 14px; background: #fff; color: var(--text, #222); outline: none; }
.t-area { width: 100%; box-sizing: border-box; min-height: 240px; border: 1px solid var(--border, #e5e7eb); border-radius: 8px; padding: 10px 12px; font: 13px/1.6 Consolas, Monaco, "Courier New", monospace; background: #fff; color: var(--text, #222); outline: none; resize: vertical; }
.t-area:focus { border-color: var(--brand, #4f6ef2); box-shadow: 0 0 0 3px rgba(79, 110, 242, .12); }
.t-options { display: flex; flex-wrap: wrap; gap: 10px 18px; align-items: center; margin: 12px 0 0; font-size: 13px; color: var(--text-2, #555); }
.t-opt { display: inline-flex; align-items: center; gap: 6px; }
.t-opt select { border: 1px solid var(--border, #e5e7eb); border-radius: 6px; padding: 5px 6px; font-size: 13px; background: #fff; color: var(--text, #222); outline: none; }
.t-opt-group { display: none; gap: 12px; align-items: center; flex-wrap: wrap; }
.t-opt-group label { display: inline-flex; gap: 4px; align-items: center; cursor: pointer; }
.tool-actions { display: flex; gap: 10px; margin: 14px 0 0; flex-wrap: wrap; }
.t-btn { background: var(--brand, #4f6ef2); color: #fff; border: 0; border-radius: 8px; padding: 9px 24px; font-size: 14px; cursor: pointer; }
.t-btn:hover { opacity: .9; }
.t-btn-ghost { background: transparent; color: var(--text-2, #555); border: 1px solid var(--border, #e5e7eb); }
.t-btn-ghost:hover { border-color: var(--brand, #4f6ef2); color: var(--brand, #4f6ef2); }
.t-copy { background: #fff; color: var(--text-2, #555); border: 1px solid var(--border, #e5e7eb); border-radius: 8px; padding: 9px 20px; font-size: 14px; cursor: pointer; }
.t-copy:hover { border-color: var(--brand, #4f6ef2); color: var(--brand, #4f6ef2); }
.t-result { display: none; margin: 14px 0 0; background: var(--surface-2, #f7f8fa); border: 1px solid var(--border, #e5e7eb); border-radius: 8px; padding: 12px; max-height: 520px; overflow: auto; }
.t-result code { font: 13px/1.6 Consolas, Monaco, "Courier New", monospace; color: var(--text, #222); white-space: pre-wrap; word-break: break-all; }
.t-error { display: none; margin: 12px 0 0; padding: 10px 12px; border-radius: 8px; background: #fef2f2; color: #c0392b; border: 1px solid #f5c6c6; font-size: 13px; }
.t-note { margin: 10px 0 0; font-size: 12px; color: var(--text-3, #999); }
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
<script src="/static/script/pcformat.js" type="text/javascript"></script>
<script src="/static/script/cssformat.js" type="text/javascript"></script>
<script src="/static/script/json/xmlformat.js" type="text/javascript"></script>
<script src="/static/script/vbsformat.js" type="text/javascript"></script>
<script src="/static/script/jsformat/common.js" type="text/javascript"></script>
<script src="/static/script/jsformat/jsformat.js" type="text/javascript"></script>
<script src="/static/script/jsformat/jsformat2.js" type="text/javascript"></script>
<script src="/static/script/jsformat/htmlformat.js" type="text/javascript"></script>
<script src="/static/script/jsformat/formatjs.js" type="text/javascript"></script>
<script src="/static/script/codemirror/beautify.js" type="text/javascript"></script>
<script src="/static/script/codemirror/beautify-css.js" type="text/javascript"></script>
<script src="/static/script/codemirror/beautify-html.js" type="text/javascript"></script>
<script>
(function () {
    'use strict';

    var LANG = {
        c: 'C', cpp: 'C++', cs: 'C#', java: 'Java', php: 'PHP', py: 'Python',
        ruby: 'Ruby', perl: 'Perl', vbs: 'VBScript', sql: 'SQL', xml: 'XML',
        css: 'CSS', js: 'JS', html: 'HTML'
    };
    var BRACE_LANGS = { cs: 1, java: 1, js: 1 };

    var el = {
        lang: document.getElementById('t-lang'),
        content: document.getElementById('content'),
        tabsize: document.getElementById('tabsize'),
        brace: document.getElementById('brace-style'),
        result: document.getElementById('result'),
        pre: document.getElementById('t-result'),
        error: document.getElementById('t-error'),
        copy: document.getElementById('btn-copy')
    };

    // pcformat.js 的 C/C++/PHP 格式化管道（cleanCStyle）最终调用 finishTabifier(out)，
    // 覆写它以 textContent 输出纯文本结果，避免 innerHTML 注入用户代码。
    window.finishTabifier = function (code) {
        setOutput(code == null ? '' : String(code));
    };

    function setOutput(text) {
        el.result.textContent = text;
        el.pre.style.display = 'block';
        el.error.style.display = 'none';
        el.error.textContent = '';
    }

    function setError(msg) {
        el.result.textContent = '';
        el.pre.style.display = 'none';
        el.error.textContent = msg;
        el.error.style.display = 'block';
    }

    function langLabel() {
        return LANG[el.lang.value] || el.lang.value;
    }

    function indentOptions() {
        var n = parseInt(el.tabsize.value, 10) || 4;
        var ch = (n === 1) ? '\t' : ' ';
        return {
            indent_size: n,
            indent_char: ch,
            indent_character: ch,
            indent_with_tabs: (n === 1),
            preserve_newlines: true,
            max_preserve_newlines: 2,
            brace_style: el.brace ? el.brace.value : 'collapse',
            wrap_line_length: 0,
            keep_array_indentation: false
        };
    }

    function syncOptions() {
        var v = el.lang.value;
        document.getElementById('opt-css').style.display = (v === 'css') ? 'inline-flex' : 'none';
        document.getElementById('opt-js').style.display = (v === 'js') ? 'inline-flex' : 'none';
        document.getElementById('opt-html').style.display = (v === 'html') ? 'inline-flex' : 'none';
        document.getElementById('opt-brace').style.display = BRACE_LANGS[v] ? 'inline-flex' : 'none';
        el.content.placeholder = '请输入要格式化的' + langLabel() + '代码';
        el.error.style.display = 'none';
    }

    function formatNow() {
        var v = el.lang.value;
        var code = el.content.value;
        if (!code || !code.replace(/\s+/g, '')) {
            setError('请输入要格式化的' + langLabel() + '代码');
            return;
        }
        try {
            switch (v) {
                case 'c':
                case 'cpp':
                case 'php':
                    window.cleanCStyle(code);
                    break;
                case 'css':
                    setOutput(cssRun(code));
                    break;
                case 'js':
                    jsRun(code);
                    break;
                case 'html':
                    htmlRun(code);
                    break;
                case 'sql':
                    setOutput($.format(code, { method: 'sql' }));
                    break;
                case 'xml':
                    setOutput($.format(code, { method: 'xml' }));
                    break;
                case 'vbs':
                    setOutput(window.beautifier.beautify(code));
                    break;
                default:
                    setOutput(window.js_beautify(code, indentOptions()));
            }
        } catch (e) {
            setError('格式化失败：' + (e && e.message ? e.message : e));
        }
    }

    function cssRun(code) {
        var pack = document.getElementById('opt-css-pack').checked;
        return pack ? window.cssChanger.pack(code) : window.cssChanger.format(code);
    }

    function jsRun(code) {
        var pack = document.getElementById('opt-js-pack').checked;
        if (pack) {
            var obf = document.getElementById('opt-js-obf').checked ? 1 : 0;
            if (typeof window.pack_js !== 'function') {
                setError('JS 压缩引擎未加载');
                return;
            }
            var r = window.pack_js(obf);
            if (typeof r === 'string' && r) setOutput(r);
            return; // 引擎已自行写入 #result 时无需二次处理
        }
        setOutput(window.js_beautify(code, indentOptions()));
    }

    function htmlRun(code) {
        var pack = document.getElementById('opt-html-pack').checked;
        if (pack) {
            if (typeof window.HTMLcompressor !== 'function') {
                setError('HTML 压缩引擎未加载');
                return;
            }
            var r = window.HTMLcompressor();
            if (typeof r === 'string' && r) setOutput(r);
            return; // 引擎已自行写入 #result 时无需二次处理
        }
        setOutput(window.html_beautify(code, indentOptions()));
    }

    function legacyCopy(txt) {
        var ta = document.createElement('textarea');
        ta.value = txt;
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        try { document.execCommand('copy'); } catch (e) { /* ignore */ }
        document.body.removeChild(ta);
    }

    function copyResult() {
        var txt = el.result.textContent || el.content.value;
        if (!txt) {
            setError('暂无可复制的内容，请先格式化');
            return;
        }
        var done = function () {
            el.copy.textContent = '已复制';
            setTimeout(function () { el.copy.textContent = '复制'; }, 1200);
        };
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(txt).then(done, function () { legacyCopy(txt); done(); });
        } else {
            legacyCopy(txt);
            done();
        }
    }

    function clearAll() {
        el.content.value = '';
        el.result.textContent = '';
        el.pre.style.display = 'none';
        el.error.style.display = 'none';
        el.content.focus();
    }

    el.lang.addEventListener('change', syncOptions);
    document.getElementById('btn-format').addEventListener('click', formatNow);
    document.getElementById('btn-copy').addEventListener('click', copyResult);
    document.getElementById('btn-clear').addEventListener('click', clearAll);
    document.addEventListener('keydown', function (e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') formatNow();
    });

    syncOptions();
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
