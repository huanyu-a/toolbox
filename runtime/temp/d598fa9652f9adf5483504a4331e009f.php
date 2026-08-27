<?php /*a:6:{s:43:"/app/application/index/view/index/json.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.json.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.json.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.json.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css" />
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
        <h2 class="tool-title"><span class="t-ico">🪄</span>JSON 工具箱</h2>
        <p class="tool-desc">格式化、压缩、校验、转义，以及与 GET 参数、XML、YAML、CSV/Excel、C#、Java、Go 的相互转换。输入输出共用同一区域，切换功能时输入内容自动保留，可连续转换。除 YAML 解析与代码生成依赖本地脚本外，其余均为原生实现，数据全程只在浏览器本地处理。</p>
        <ul class="t-tabs">
            <li><button type="button" class="t-tab active" data-mode="fmt">🪄 格式化/压缩/校验</button></li>
            <li><button type="button" class="t-tab" data-mode="esc">🔐 压缩转义</button></li>
            <li><button type="button" class="t-tab" data-mode="get">🔗 JSON ↔ GET</button></li>
            <li><button type="button" class="t-tab" data-mode="xml">📄 JSON ↔ XML</button></li>
            <li><button type="button" class="t-tab" data-mode="yaml">📋 JSON ↔ YAML</button></li>
            <li><button type="button" class="t-tab" data-mode="csv">📊 JSON ↔ CSV</button></li>
            <li><button type="button" class="t-tab" data-mode="cs">🅒 JSON → C#</button></li>
            <li><button type="button" class="t-tab" data-mode="java">☕ JSON → Java</button></li>
            <li><button type="button" class="t-tab" data-mode="go">🐹 JSON → Go</button></li>
        </ul>
        <label class="t-label" for="json-in">输入内容</label>
        <textarea class="t-area" id="json-in" rows="7" placeholder='{"name":"在线工具箱","tools":162}'></textarea>
        <div class="t-options" id="opt-fmt" style="margin-top:12px">
            <label><input type="radio" name="fmtMode" value="format" checked> 格式化</label>
            <label><input type="radio" name="fmtMode" value="compress"> 压缩</label>
            <label><input type="radio" name="fmtMode" value="validate"> 校验</label>
            <label><input type="checkbox" id="fmtSort"> 键名排序</label>
            <label><input type="checkbox" id="fmtEscape"> 转义为字符串</label>
        </div>
        <div class="t-options" id="opt-esc" style="margin-top:12px;display:none">
            <label><input type="radio" name="escMode" value="compress" checked> JSON 压缩</label>
            <label><input type="radio" name="escMode" value="escape"> 转义</label>
            <label><input type="radio" name="escMode" value="unescape"> 反转义</label>
        </div>
        <div class="t-options" id="opt-get" style="margin-top:12px;display:none">
            <label><input type="radio" name="getMode" value="json2get" checked> JSON → GET 参数</label>
            <label><input type="radio" name="getMode" value="get2json"> GET 参数 → JSON</label>
        </div>
        <div class="t-options" id="opt-xml" style="margin-top:12px;display:none">
            <label><input type="radio" name="xmlMode" value="json2xml" checked> JSON → XML</label>
            <label><input type="radio" name="xmlMode" value="xml2json"> XML → JSON</label>
        </div>
        <div class="t-options" id="opt-yaml" style="margin-top:12px;display:none">
            <label><input type="radio" name="yamlMode" value="json2yaml" checked> JSON → YAML</label>
            <label><input type="radio" name="yamlMode" value="yaml2json"> YAML → JSON</label>
        </div>
        <div class="t-options" id="opt-csv" style="margin-top:12px;display:none">
            <label><input type="radio" name="csvMode" value="json2csv" checked> JSON → CSV</label>
            <label><input type="radio" name="csvMode" value="csv2json"> CSV → JSON</label>
        </div>
        <div class="t-options" id="opt-cs" style="margin-top:12px;display:none"></div>
        <div class="t-options" id="opt-java" style="margin-top:12px;display:none">
            <label>类名 <input type="text" class="t-input" id="java-class" value="PcjsonRootBean" style="width:170px"></label>
            <label>包名 <input type="text" class="t-input" id="java-pkg" value="pcjson.com.json2bean" style="width:230px"></label>
        </div>
        <div class="t-options" id="opt-go" style="margin-top:12px;display:none">
            <label>结构体名 <input type="text" class="t-input" id="go-class" value="AutoGenerated" style="width:170px"></label>
            <label><input type="checkbox" id="go-inline" checked> 内联类型定义</label>
        </div>
        <div class="tool-actions">
            <button class="t-btn" type="button" id="runBtn">格式化</button>
            <button class="t-btn t-btn-ghost" type="button" data-copy="#json-out">复制结果</button>
            <button class="t-btn t-btn-ghost" type="button" id="clearBtn">清空</button>
        </div>
        <div class="t-result" id="json-result"><textarea class="t-area t-area-readonly" id="json-out" rows="10" readonly></textarea></div>
        <div class="t-error" id="json-error"></div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于 JSON 工具箱</h2>
        <p class="tool-desc">JSON（JavaScript Object Notation）是一种轻量级数据交换格式，广泛用于前后端通信与配置文件。本页将原独立的 JSON 格式化/校验、压缩转义、JSON 转 GET 参数、JSON↔XML、JSON↔YAML、JSON↔CSV/Excel、JSON 生成 C#/Java 实体类、JSON 生成 Go 结构体等工具合并为一处，便于统一使用。输入区与输出区全局共用：切换功能时输入内容保留，输出与错误自动清空。转换过程全部在浏览器本地完成，不会上传任何数据。</p>
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
<script src="/static/script/pcjs/yaml.js"></script>
<script src="/static/script/pcjs/jscs.js"></script>
<script src="/static/script/pcjs/tool2java.js"></script>
<script src="/static/script/pcjs/json2go.js"></script>
<script src="/static/script/pcjs/gojs.js"></script>
<script>
(function () {
    'use strict';
    function $(id) { return document.getElementById(id); }
    function radio(name) {
        var m = document.querySelector('input[name="' + name + '"]:checked');
        return m ? m.value : '';
    }
    function showResult() { $('json-result').classList.add('show'); }
    function showError(msg) {
        var e = $('json-error');
        e.textContent = msg;
        e.classList.add('show');
    }
    function clearOutput() {
        $('json-out').value = '';
        $('json-result').classList.remove('show');
        $('json-error').classList.remove('show');
    }
    function safeRun(label, fn) {
        clearOutput();
        var raw = $('json-in').value.trim();
        if (!raw) { showError('请输入内容'); return; }
        try {
            $('json-out').value = fn(raw);
            showResult();
        } catch (e) {
            showError(label + '失败：' + ((e && e.message) ? e.message : String(e)));
        }
    }

    /* ===== 模式注册表 ===== */
    var MODES = {
        fmt: {
            btn: '格式化', placeholder: '{"name":"在线工具箱","tools":162}',
            run: function () {
                clearOutput();
                var raw = $('json-in').value.trim();
                if (!raw) { showError('请输入 JSON 内容'); return; }
                var data;
                try { data = JSON.parse(raw); }
                catch (e) { showError('JSON 解析失败：' + e.message); return; }
                if ($('fmtSort').checked) data = sortKeys(data);
                var mode = radio('fmtMode');
                var out;
                if (mode === 'validate') {
                    out = 'JSON 校验通过 ✓';
                } else if (mode === 'compress') {
                    out = JSON.stringify(data);
                } else {
                    out = JSON.stringify(data, null, 4);
                }
                if ($('fmtEscape').checked && mode !== 'validate') out = JSON.stringify(out);
                $('json-out').value = out;
                showResult();
            }
        },
        esc: {
            btn: '处理', placeholder: '{"name":"在线工具箱","tools":162} 或任意文本',
            run: function () {
                safeRun('处理', function (raw) {
                    var mode = radio('escMode');
                    if (mode === 'escape') return JSON.stringify(raw);
                    if (mode === 'unescape') return JSON.parse(raw);
                    return JSON.stringify(JSON.parse(raw));
                });
            }
        },
        get: {
            btn: '转换', placeholder: 'JSON：{"a":1,"b":{"c":2}} 或 GET：a=1&b.c=2',
            run: function () {
                safeRun('转换', function (raw) {
                    if (radio('getMode') === 'get2json') {
                        var params = new URLSearchParams(raw.replace(/^\?/, ''));
                        var obj = {};
                        params.forEach(function (v, k) { obj[k] = v; });
                        return JSON.stringify(obj, null, 2);
                    }
                    var data = JSON.parse(raw);
                    var qs = new URLSearchParams();
                    (function flat(o, prefix) {
                        Object.keys(o).forEach(function (k) {
                            var key = prefix ? prefix + '.' + k : k;
                            var v = o[k];
                            if (v && typeof v === 'object') flat(v, key);
                            else qs.append(key, v == null ? '' : String(v));
                        });
                    })(data, '');
                    return qs.toString();
                });
            }
        },
        xml: {
            btn: '转换', placeholder: 'JSON：{"name":"张三","age":30} 或 XML：<root><name>张三</name></root>',
            run: function () {
                safeRun('转换', function (raw) {
                    if (radio('xmlMode') === 'xml2json') return JSON.stringify(xmlToJson(raw), null, 2);
                    return '<?php echo '<?'; ?>
xml version="1.0" encoding="UTF-8"?>' + jsonToXml(JSON.parse(raw), 'root');
                });
            }
        },
        yaml: {
            btn: '转换', placeholder: 'JSON：{"name":"在线工具箱","tools":162} 或 YAML：name: 在线工具箱\ntools: 162',
            run: function () {
                safeRun('转换', function (raw) {
                    if (radio('yamlMode') === 'yaml2json') return JSON.stringify(YAML.parse(raw), null, 2);
                    return YAML.stringify(JSON.parse(raw));
                });
            }
        },
        csv: {
            btn: '转换', placeholder: 'JSON：[{"name":"张三","age":30},{"name":"李四","age":25}] 或 CSV：name,age\n张三,30',
            run: function () {
                safeRun('转换', function (raw) {
                    if (radio('csvMode') === 'csv2json') {
                        var rows = parseCsv(raw);
                        if (!rows.length) throw new Error('CSV 内容为空');
                        var headers = rows[0];
                        return JSON.stringify(rows.slice(1).map(function (r) {
                            var o = {};
                            headers.forEach(function (h, i) { o[h] = (r[i] == null) ? '' : r[i]; });
                            return o;
                        }), null, 2);
                    }
                    var data = JSON.parse(raw);
                    var arr = Array.isArray(data) ? data : [data];
                    if (!arr.length) throw new Error('JSON 数组为空');
                    var headers2 = [];
                    arr.forEach(function (o) {
                        Object.keys(o).forEach(function (k) { if (headers2.indexOf(k) < 0) headers2.push(k); });
                    });
                    return toCsv([headers2].concat(arr.map(function (o) {
                        return headers2.map(function (h) {
                            var v = o[h];
                            return (v && typeof v === 'object') ? JSON.stringify(v) : v;
                        });
                    })));
                });
            }
        },
        cs: {
            btn: '生成 C# 实体类', placeholder: '{"name":"在线工具箱","tools":162,"sub":{"enabled":true}}',
            run: function () {
                safeRun('生成', function (raw) {
                    JSON2CSharp._allClass = [];
                    return JSON2CSharp.convert(JSON.parse(raw));
                });
            }
        },
        java: {
            btn: '生成 Java 实体类', placeholder: '{"name":"在线工具箱","tools":162,"sub":{"enabled":true}}',
            run: function () {
                safeRun('生成', function (raw) {
                    JSON.parse(raw);
                    var className = $('java-class').value.trim() || 'PcjsonRootBean';
                    var pkg = $('java-pkg').value.trim() || 'pcjson.com.json2bean';
                    var beans = getBeanFieldFromJson(raw, className);
                    var parts = [];
                    for (var k in beans) {
                        var b = beans[k];
                        if (b && typeof b === 'object' && b.name) parts.push(toBeanText(b, pkg));
                    }
                    if (!parts.length) throw new Error('未能生成 Java 实体类，请确认 JSON 为对象或数组');
                    return parts.join('\n\n');
                });
            }
        },
        go: {
            btn: '生成 Go 结构体', placeholder: '{"name":"在线工具箱","tools":162,"sub":{"enabled":true}}',
            run: function () {
                safeRun('生成', function (raw) {
                    var typeName = $('go-class').value.trim() || 'AutoGenerated';
                    var res = jsonToGo(raw, typeName, $('go-inline').checked);
                    if (res && res.error) throw new Error(res.error.message || String(res.error));
                    if (!res || !res.go) throw new Error('未能生成 Go 结构体');
                    return res.go;
                });
            }
        }
    };

    /* ===== Tab 切换 ===== */
    var current = 'fmt';
    var tabs = document.querySelectorAll('.t-tab');
    function switchMode(mode) {
        current = mode;
        tabs.forEach(function (b) { b.classList.toggle('active', b.getAttribute('data-mode') === mode); });
        Object.keys(MODES).forEach(function (m) {
            var opt = $('opt-' + m);
            if (opt) opt.style.display = (m === mode) ? '' : 'none';
        });
        $('runBtn').textContent = MODES[mode].btn;
        $('json-in').placeholder = MODES[mode].placeholder;
        clearOutput();
    }
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () { switchMode(btn.getAttribute('data-mode')); });
    });

    /* ===== 共用按钮 ===== */
    $('runBtn').addEventListener('click', function () { MODES[current].run(); });
    $('clearBtn').addEventListener('click', function () {
        $('json-in').value = '';
        clearOutput();
        $('json-in').focus();
    });

    /* ===== fmt 实时格式化（仅当前模式为 fmt 时生效）===== */
    var fmtTimer = null;
    $('json-in').addEventListener('input', function () {
        if (current !== 'fmt') return;
        clearTimeout(fmtTimer);
        fmtTimer = setTimeout(function () { MODES.fmt.run(); }, 500);
    });

    /* ===== 辅助函数 ===== */
    function sortKeys(obj) {
        if (Array.isArray(obj)) return obj.map(sortKeys);
        if (obj && typeof obj === 'object') {
            var out = {};
            Object.keys(obj).sort().forEach(function (k) { out[k] = sortKeys(obj[k]); });
            return out;
        }
        return obj;
    }
    function xmlEsc(s) {
        return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
    function tagName(k) { return String(k).replace(/[^A-Za-z0-9_.-]/g, '_'); }
    function jsonToXml(data, name) {
        var tag = tagName(name);
        if (data && typeof data === 'object') {
            if (Array.isArray(data)) {
                var arr = '';
                data.forEach(function (item) { arr += jsonToXml(item, name); });
                return arr;
            }
            var inner = '';
            Object.keys(data).forEach(function (k) {
                var v = data[k];
                if (v && typeof v === 'object') inner += jsonToXml(v, k);
                else inner += '<' + tagName(k) + '>' + xmlEsc(v == null ? '' : v) + '</' + tagName(k) + '>';
            });
            return '<' + tag + '>' + inner + '</' + tag + '>';
        }
        return '<' + tag + '>' + xmlEsc(data == null ? '' : data) + '</' + tag + '>';
    }
    function xmlToJson(xmlStr) {
        var doc = new DOMParser().parseFromString(xmlStr, 'application/xml');
        if (doc.getElementsByTagName('parsererror').length) throw new Error('XML 解析失败，请检查 XML 格式');
        function walk(node) {
            var childEls = [], text = '';
            for (var i = 0; i < node.childNodes.length; i++) {
                var n = node.childNodes[i];
                if (n.nodeType === 1) childEls.push(n);
                else if (n.nodeType === 3 && n.nodeValue && n.nodeValue.trim()) text += n.nodeValue;
            }
            var obj = {};
            if (node.attributes) {
                for (var a = 0; a < node.attributes.length; a++) {
                    obj['@' + node.attributes[a].name] = node.attributes[a].value;
                }
            }
            if (!childEls.length) {
                if (Object.keys(obj).length) { if (text) obj['#text'] = text; return obj; }
                return text;
            }
            var groups = {};
            childEls.forEach(function (el) {
                (groups[el.tagName] = groups[el.tagName] || []).push(walk(el));
            });
            Object.keys(groups).forEach(function (tag) {
                obj[tag] = groups[tag].length === 1 ? groups[tag][0] : groups[tag];
            });
            return obj;
        }
        return walk(doc.documentElement);
    }
    function csvCell(v) {
        v = (v == null) ? '' : String(v);
        return /[",\r\n]/.test(v) ? '"' + v.replace(/"/g, '""') + '"' : v;
    }
    function toCsv(rows) {
        return rows.map(function (r) { return r.map(csvCell).join(','); }).join('\r\n');
    }
    function parseCsv(text) {
        text = text.replace(/\r\n/g, '\n').replace(/\r/g, '\n');
        var rows = [], row = [], cell = '', inQ = false;
        for (var i = 0; i < text.length; i++) {
            var ch = text.charAt(i);
            if (inQ) {
                if (ch === '"') {
                    if (text.charAt(i + 1) === '"') { cell += '"'; i++; }
                    else inQ = false;
                } else cell += ch;
            } else if (ch === '"') {
                inQ = true;
            } else if (ch === ',') {
                row.push(cell); cell = '';
            } else if (ch === '\n') {
                row.push(cell); rows.push(row); row = []; cell = '';
            } else cell += ch;
        }
        if (cell !== '' || row.length) { row.push(cell); rows.push(row); }
        return rows;
    }
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
