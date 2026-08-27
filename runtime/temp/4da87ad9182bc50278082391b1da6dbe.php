<?php /*a:6:{s:49:"/app/application/index/view/index/createmeta.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.createmeta.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.createmeta.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.createmeta.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
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
        <h2 class="tool-title"><span class="t-ico">🧾</span>Meta 标签生成 / 分析</h2>
        <p class="tool-desc">可视化生成网页 Meta 标签代码，或粘贴已有 HTML 片段分析其 title / description / keywords 是否规范、给出优化建议。</p>
        <ul class="t-tabs" id="cmTabs">
            <li><button type="button" class="t-tab active" data-panel="cmPanel1">Meta 生成器</button></li>
            <li><button type="button" class="t-tab" data-panel="cmPanel2">Meta 分析</button></li>
        </ul>
        <div id="cmPanel1" class="t-panel active">
            <div class="t-grid">
                <div class="t-col">
                    <label class="t-label" for="cmTitle">Title（网页标题）</label>
                    <input class="t-input" style="width:100%" type="text" id="cmTitle" placeholder="例如：在线工具箱">
                </div>
                <div class="t-col">
                    <label class="t-label" for="cmKeyword">Keywords（网页关键字）</label>
                    <input class="t-input" style="width:100%" type="text" id="cmKeyword" placeholder="例如：json格式化,在线工具,工具箱">
                </div>
            </div>
            <label class="t-label" for="cmDesc" style="margin-top:12px">Description（网页描述）</label>
            <textarea class="t-area" id="cmDesc" rows="3" placeholder="例如：在线工具箱为您提供 JSON 格式化、加密解密、代码格式化等在线工具"></textarea>
            <div class="t-grid" style="margin-top:12px">
                <div class="t-col">
                    <label class="t-label" for="cmAuthor">Author（作者，选填）</label>
                    <input class="t-input" style="width:100%" type="text" id="cmAuthor" placeholder="站长">
                </div>
                <div class="t-col">
                    <label class="t-label" for="cmCopyright">Copyright（版权，选填）</label>
                    <input class="t-input" style="width:100%" type="text" id="cmCopyright" placeholder="在线工具箱">
                </div>
            </div>
            <div class="t-options" style="margin-top:12px">
                <label>编码：
                    <select class="t-input" id="cmCharset">
                        <option value="utf-8">UTF-8</option><option value="gbk">GBK</option><option value="GB2312">GB2312</option>
                    </select>
                </label>
                <label>viewport：
                    <select class="t-input" id="cmViewport">
                        <option value="2">PC 和手机端自适应</option><option value="1">适应手机端</option><option value="">适应 PC 端</option>
                    </select>
                </label>
                <label>Robots：
                    <select class="t-input" id="cmRobots">
                        <option value="">默认</option><option value="all">All</option><option value="none">None</option><option value="index,follow">Index, Follow</option><option value="noindex,nofollow">No Index, No Follow</option>
                    </select>
                </label>
            </div>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="cmRun">生成 Meta</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#cmOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="cmClear">清空</button>
            </div>
            <div class="t-result" id="cmResult"><textarea class="t-area t-area-readonly" id="cmOutput" rows="10" readonly></textarea></div>
            <div class="t-error" id="cmError"></div>
        </div>
        <div id="cmPanel2" class="t-panel">
            <label class="t-label" for="cmHtmlIn">粘贴 HTML 头部代码或完整页面源码</label>
            <textarea class="t-area" id="cmHtmlIn" rows="10" placeholder="<html>...<head><title>...</title>...</head>..."></textarea>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="cmAnalyze">开始分析</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#cmAnaResult">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="cmAnaClear">清空</button>
            </div>
            <div class="t-result" id="cmAnaResult"></div>
            <div class="t-error" id="cmAnaError"></div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于 Meta 标签</h2>
        <p class="tool-desc">title 建议不超过 30 个汉字（约 60 字节），description 建议 50~160 字符，keywords 建议 3~8 个关键词。缺失或超长的 Meta 信息会影响搜索引擎收录与点击率。</p>
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
    'use strict';
    var tabs = document.querySelectorAll('#cmTabs .t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });
    function esc(s) { return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;'); }
    // 面板1：Meta 生成器
    var err1 = document.getElementById('cmError');
    document.getElementById('cmRun').addEventListener('click', function () {
        err1.classList.remove('show');
        var title = document.getElementById('cmTitle').value.trim();
        var kw = document.getElementById('cmKeyword').value.trim();
        var desc = document.getElementById('cmDesc').value.trim();
        if (!title && !kw && !desc) { err1.textContent = '请至少填写标题、关键词或描述之一'; err1.classList.add('show'); return; }
        var charset = document.getElementById('cmCharset').value;
        var vp = document.getElementById('cmViewport').value;
        var robots = document.getElementById('cmRobots').value;
        var author = document.getElementById('cmAuthor').value.trim();
        var copyright = document.getElementById('cmCopyright').value.trim();
        var lines = [];
        lines.push('<title>' + esc(title) + '</title>');
        lines.push('<meta charset="' + charset + '" />');
        if (vp === '2') lines.push('<meta name="viewport" content="width=device-width, initial-scale=1.0" />');
        else if (vp === '1') lines.push('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />');
        if (kw) lines.push('<meta name="keywords" content="' + esc(kw) + '" />');
        if (desc) lines.push('<meta name="description" content="' + esc(desc) + '" />');
        if (robots) lines.push('<meta name="robots" content="' + esc(robots) + '" />');
        if (author) lines.push('<meta name="author" content="' + esc(author) + '" />');
        if (copyright) lines.push('<meta name="copyright" content="' + esc(copyright) + '" />');
        document.getElementById('cmOutput').value = lines.join('\n');
        document.getElementById('cmResult').classList.add('show');
    });
    document.getElementById('cmClear').addEventListener('click', function () {
        ['cmTitle', 'cmKeyword', 'cmDesc', 'cmAuthor', 'cmCopyright'].forEach(function (id) { document.getElementById(id).value = ''; });
        document.getElementById('cmOutput').value = '';
        document.getElementById('cmResult').classList.remove('show');
        err1.classList.remove('show');
    });
    // 面板2：Meta 分析（缺失检测 + 长度建议）
    var anaErr = document.getElementById('cmAnaError');
    document.getElementById('cmAnalyze').addEventListener('click', function () {
        anaErr.classList.remove('show');
        var html = document.getElementById('cmHtmlIn').value;
        if (!html.trim()) { anaErr.textContent = '请粘贴 HTML 代码'; anaErr.classList.add('show'); return; }
        var mTitle = html.match(/<title[^>]*>([\s\S]*?)<\/title>/i);
        var mDesc = html.match(/<meta[^>]*name=["']description["'][^>]*content=["']([^"']*)["']/i) || html.match(/<meta[^>]*content=["']([^"']*)["'][^>]*name=["']description["']/i);
        var mKw = html.match(/<meta[^>]*name=["']keywords["'][^>]*content=["']([^"']*)["']/i) || html.match(/<meta[^>]*content=["']([^"']*)["'][^>]*name=["']keywords["']/i);
        var rows = [];
        function addRow(name, val, status, note) {
            rows.push('<tr><td style="white-space:nowrap;font-weight:600">' + name + '</td><td>' + (val ? esc(val) : '<span style="color:#e74c3c">缺失</span>') + '</td><td>' + status + '</td><td>' + note + '</td></tr>');
        }
        var t = mTitle ? mTitle[1].trim() : '';
        if (t) { var tl = t.length; addRow('Title', t, tl <= 30 ? '<span style="color:#27ae60">正常</span>' : '<span style="color:#e67e22">偏长</span>', '当前 ' + tl + ' 字，建议 ≤ 30 字'); }
        else addRow('Title', '', '<span style="color:#e74c3c">缺失</span>', '搜索引擎会取页面正文作为标题');
        var d = mDesc ? mDesc[1].trim() : '';
        if (d) { var dl = d.length; addRow('Description', d, (dl >= 50 && dl <= 160) ? '<span style="color:#27ae60">正常</span>' : '<span style="color:#e67e22">建议调整</span>', '当前 ' + dl + ' 字符，建议 50~160'); }
        else addRow('Description', '', '<span style="color:#e74c3c">缺失</span>', '建议填写 50~160 字符的描述');
        var k = mKw ? mKw[1].trim() : '';
        if (k) { var kn = k.split(/[,，]/).filter(Boolean).length; addRow('Keywords', k, (kn >= 3 && kn <= 8) ? '<span style="color:#27ae60">正常</span>' : '<span style="color:#e67e22">建议调整</span>', '当前 ' + kn + ' 个关键词，建议 3~8 个'); }
        else addRow('Keywords', '', '<span style="color:#e74c3c">缺失</span>', 'Keywords 已不是主要排名因素，但建议保留');
        var html5 = /<meta[^>]*charset=/i.test(html);
        addRow('Charset 声明', html5 ? '已声明' : '未声明', html5 ? '<span style="color:#27ae60">正常</span>' : '<span style="color:#e67e22">建议补充</span>', '建议在 head 中声明 <meta charset>');
        document.getElementById('cmAnaResult').innerHTML = '<table class="table table-bordered table-striped" style="margin:0"><thead><tr><th>项目</th><th>内容</th><th>状态</th><th>建议</th></tr></thead><tbody>' + rows.join('') + '</tbody></table>';
        document.getElementById('cmAnaResult').classList.add('show');
    });
    document.getElementById('cmAnaClear').addEventListener('click', function () {
        document.getElementById('cmHtmlIn').value = '';
        document.getElementById('cmAnaResult').innerHTML = '';
        document.getElementById('cmAnaResult').classList.remove('show');
        anaErr.classList.remove('show');
    });
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
