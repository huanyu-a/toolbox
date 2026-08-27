<?php /*a:6:{s:45:"/app/application/index/view/index/editor.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.editor.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.editor.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.editor.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
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

<link href="/static/vditor/dist/index.css" rel="stylesheet" type="text/css"/>
<link href="/static/script/codemirror/codemirror.css" rel="stylesheet" type="text/css"/>
<style>
/* 编辑器页专用补充样式（基于全站 CSS 变量，自动适配暗色主题） */
.editor-tabs { margin: 0 0 16px; }
#paneTui .vditor { border-radius: 10px; overflow: hidden; }
.html-wrap .CodeMirror { height: 560px; border: 1px solid var(--border); border-radius: 10px; font-size: 13px; line-height: 1.6; background: var(--surface); color: var(--text-1); }
[data-theme="dark"] .CodeMirror-gutters { background: var(--surface-2); border-right-color: var(--border); }
[data-theme="dark"] .CodeMirror-linenumber { color: var(--text-3); }
[data-theme="dark"] .CodeMirror-cursor { border-left-color: var(--brand); }
[data-theme="dark"] .CodeMirror-selected { background: rgba(124, 147, 255, .25); }
.editor-status { display: flex; flex-wrap: wrap; gap: 18px; align-items: center; padding: 12px 16px 0; margin-top: 16px; border-top: 1px solid var(--border); color: var(--text-3); font-size: 12px; }
.editor-status b { color: var(--text-1); font-weight: 600; margin-left: 2px; }
.editor-status-hint { opacity: .75; }
.editor-status-right { margin-left: auto; color: #10b981; }
#toastMsg{position:fixed;left:50%;bottom:32px;transform:translateX(-50%) translateY(16px);background:rgba(17,24,39,.92);color:#fff;font-size:13px;padding:9px 18px;border-radius:999px;opacity:0;pointer-events:none;transition:all .25s;z-index:2000;box-shadow:0 6px 20px rgba(0,0,0,.18)}
#toastMsg.show{opacity:1;transform:translateX(-50%) translateY(0)}
@media (max-width:767px){
#vditor,.html-wrap .CodeMirror{min-height:420px}
.editor-status{gap:10px 16px}
}
</style>
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
    <h2 class="tool-title"><span class="t-ico">📝</span>富文本 · Markdown 在线编辑器</h2>
    <p class="tool-desc">基于 Vditor 引擎，支持所见即所得 / 即时渲染 / 分屏预览三种编辑模式，可视化编辑与 HTML 源码一键切换，实现 Markdown 与 HTML 双向互转，全程本地处理。</p>
    <ul class="t-tabs editor-tabs" id="modeTabs">
      <li><button type="button" class="t-tab active" data-mode="tui">🖊️ 可视化编辑</button></li>
      <li><button type="button" class="t-tab" data-mode="html">🔧 HTML 源码</button></li>
    </ul>
    <div class="t-panel active" id="paneTui"><div id="vditor"></div></div>
    <div class="t-panel" id="paneHtml"><div class="html-wrap"><textarea id="htmlSource" spellcheck="false"></textarea></div></div>
    <div class="tool-actions" style="margin-top:14px">
      <button class="t-btn t-btn-ghost" type="button" id="btnSample">✨ 示例</button>
      <button class="t-btn t-btn-ghost" type="button" id="btnClear">🗑️ 清空</button>
      <button class="t-btn t-btn-ghost" type="button" id="btnCopyHtml">📋 复制 HTML</button>
      <button class="t-btn t-btn-ghost" type="button" id="btnCopyMd">📋 复制 Markdown</button>
      <button class="t-btn t-btn-ghost" type="button" id="btnCopyTxt">📄 复制 TXT</button>
      <button class="t-btn t-btn-ghost" type="button" id="btnDlHtml">⬇️ 下载 .html</button>
      <button class="t-btn t-btn-ghost" type="button" id="btnDlMd">⬇️ 下载 .md</button>
    </div>
    <div class="editor-status">
      <span>字数<b id="stChars">0</b></span>
      <span>字符<b id="stAll">0</b></span>
      <span>段落<b id="stBlocks">0</b></span>
      <span class="editor-status-hint">工具栏可切换 所见即所得 / 即时渲染 / 分屏预览 模式</span>
      <span class="editor-status-right" id="saveTip"></span>
    </div>
  </div>
  <div class="tool-card">
    <h2 class="tool-title">📖 关于 Markdown / HTML 在线编辑器</h2>
    <p class="tool-desc">本工具基于 Vditor 引擎构建，同时支持所见即所得（输出 HTML）、即时渲染（Markdown）与分屏预览三种编辑模式，并提供 HTML 源码视图，可一键切换、实时预览。支持自动保存草稿、代码块语法高亮、复制 HTML/Markdown、下载 .html/.md 文件以及全屏编辑，适用于文章撰写、网站编辑、微信公众号排版、程序员笔记等场景在线使用。</p>
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
<script src="/static/script/codemirror/codemirror.min.js" type="text/javascript"></script>
<script src="/static/script/codemirror/xml.js" type="text/javascript"></script>
<script src="/static/script/codemirror/css.js" type="text/javascript"></script>
<script src="/static/script/codemirror/javascript.js" type="text/javascript"></script>
<script src="/static/script/codemirror/htmlmixed.js" type="text/javascript"></script>
<script src="/static/vditor/dist/index.min.js" type="text/javascript"></script>
<script src="/static/script/filesave.js" type="text/javascript"></script>
<script src="/static/script/editor-app.js" type="text/javascript"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
