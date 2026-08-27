<?php /*a:6:{s:49:"/app/application/index/view/index/autoformat.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.autoformat.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.autoformat.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.autoformat.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
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
<style>
/* 本页专用：一行多列紧凑布局（仅作用于 #autoformatCard，不影响其他工具页） */
#autoformatCard .af-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
#autoformatCard .af-grid-3 { display: flex; align-items: flex-end; gap: 12px; flex-wrap: wrap; }
#autoformatCard .af-grid-3 .t-col { flex: 0 1 320px; min-width: 0; }
#autoformatCard .af-grid-3 .t-col-end { flex: 0 0 auto; }
#autoformatCard .af-grid .t-label, #autoformatCard .af-grid-3 .t-label { margin-bottom: 6px; }
/* 修复溢出：全局 textarea/input 无 box-sizing，width:100%+padding 会撑出容器 */
#autoformatCard .t-area, #autoformatCard .t-input { box-sizing: border-box; max-width: 100%; }
#autoformatCard .af-grid .t-input, #autoformatCard .af-grid-3 .t-input { width: 100%; }
#autoformatCard .af-options { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; margin: 0; }
#autoformatCard .t-options { margin-bottom: 10px; }
@media (max-width: 991px) { #autoformatCard .af-grid { grid-template-columns: repeat(2, 1fr); } }
/* 手机端：保持两列 + 缩小间距/字号/控件，整体更紧凑 */
@media (max-width: 767px) {
    #autoformatCard .af-grid { grid-template-columns: repeat(2, 1fr); gap: 8px 10px; }
    #autoformatCard .af-grid .t-label, #autoformatCard .af-grid-3 .t-label { margin-bottom: 4px; font-size: 12px; }
    #autoformatCard .af-options { gap: 8px; }
    #autoformatCard .t-options { gap: 4px 10px; font-size: 12px; margin-bottom: 8px; }
    #autoformatCard .t-area { height: 84px; min-height: 84px; }
    #autoformatCard .af-grid-3 { gap: 8px; align-items: stretch; }
    #autoformatCard .af-grid-3 .t-col { flex: 1 1 calc(50% - 4px); }
    #autoformatCard .af-grid-3 .t-col-end { flex: 1 1 100%; }
    #autoformatCard .af-grid-3 .t-col-end .t-btn { width: 100%; }
    #autoformatCard .tool-actions { gap: 8px; margin-top: 10px; }
    #autoformatCard .tool-actions .t-btn { flex: 1 1 calc(50% - 4px); padding: 9px 8px; font-size: 13px; }
}
</style></head><body><link href="/static/style/theme-uno.css" rel="stylesheet" type="text/css"/>
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
    <div class="tool-card" id="autoformatCard">
        <h2 class="tool-title"><span class="t-ico">📝</span>文章自动排版</h2>
        <p class="tool-desc">在线自动排版工具为您提供文章一键排版、文章自动排版编辑器，可用于小说、论文排版，支持段前缩进、段间空行、标点转换、简繁转换、行号、查找替换、错别字检查与配置记忆。</p>
        <label class="t-label" for="srcText">待排版文本</label>
        <textarea class="t-area" id="srcText" name="srcText" rows="10" placeholder="请输入要排版的文本内容（支持直接粘贴网页内容，排版时自动清理HTML标签）"></textarea>
        <div class="t-options">
            <span class="t-opt">当前字符数：<b id="charCount">0</b></span>
            <span class="t-opt">汉字数：<b id="hanCount">0</b></span>
            <span class="t-opt">行数：<b id="lineCount">0</b></span>
            <span class="t-opt">快捷键：Ctrl+Enter 一键排版 / Shift+Enter 清空</span>
        </div>
        <div class="af-grid">
            <div class="t-col">
                <label class="t-label" for="indentType">段前缩进类型</label>
                <select class="t-input" id="indentType"><option value="0" selected>全角空格（中文习惯）</option><option value="1">半角空格</option><option value="2">Tab 制表符</option></select>
            </div>
            <div class="t-col">
                <label class="t-label" for="indentCount">缩进数量</label>
                <input class="t-input" type="number" id="indentCount" value="2" min="0" max="16" />
            </div>
            <div class="t-col">
                <label class="t-label" for="paraGap">段间空行</label>
                <input class="t-input" type="number" id="paraGap" value="1" min="0" max="10" />
            </div>
            <div class="t-col">
                <label class="t-label" for="punctMode">标点转换</label>
                <select class="t-input" id="punctMode"><option value="0" selected>保持不变</option><option value="1">英文→中文</option><option value="2">中文→英文</option></select>
            </div>
            <div class="t-col">
                <label class="t-label" for="zhMode">简繁转换</label>
                <select class="t-input" id="zhMode"><option value="0" selected>保持不变</option><option value="1">繁体→简体</option><option value="2">简体→繁体</option></select>
            </div>
            <div class="t-col">
                <label class="t-label" for="lineSep">行号分隔符</label>
                <input class="t-input" type="text" id="lineSep" value=": " />
            </div>
            <div class="t-col">
                <label class="t-label" for="signText">尾部签名</label>
                <input class="t-input" type="text" id="signText" placeholder="如：本文由XXX整理发布" />
            </div>
            <div class="t-col">
                <label class="t-label">其他选项</label>
                <div class="af-options">
                    <label class="t-check"><input type="checkbox" id="lineNo" /> 添加行号</label>
                    <label class="t-check"><input type="checkbox" id="signBr" checked /> 签名前加空行</label>
                </div>
            </div>
        </div>
        <div class="af-grid-3">
            <div class="t-col">
                <label class="t-label" for="findStr">查找内容</label>
                <input class="t-input" type="text" id="findStr" placeholder="查找内容" />
            </div>
            <div class="t-col">
                <label class="t-label" for="toStr">替换为</label>
                <input class="t-input" type="text" id="toStr" placeholder="替换为" />
            </div>
            <div class="t-col t-col-end">
                <label class="t-label">&nbsp;</label>
                <button class="t-btn t-btn-ok" type="button" id="btnReplace">全部替换</button>
            </div>
        </div>
        <div class="tool-actions">
            <button class="t-btn" type="button" id="btnFormat">一键排版</button>
            <button class="t-btn t-btn-ghost" type="button" id="btnClearHtml">清除HTML标签</button>
            <button class="t-btn t-btn-ghost" type="button" id="btnPunctCn">英文标点转中文</button>
            <button class="t-btn t-btn-ghost" type="button" id="btnJf">简→繁</button>
            <button class="t-btn t-btn-ghost" type="button" id="btnCheck">检查错别字</button>
            <button class="t-btn t-btn-ghost" type="button" id="btnCount">统计字数</button>
            <button class="t-btn t-btn-ghost" type="button" id="btnCopy">复制</button>
            <button class="t-btn t-btn-ghost" type="button" id="btnClear">清空</button>
        </div>
        <div class="tool-actions">
            <button class="t-btn t-btn-ghost" type="button" id="saveCfg">保存排版配置</button>
            <button class="t-btn t-btn-ghost" type="button" id="delCfg">恢复默认配置</button>
        </div>
        <div class="t-error" id="tMsg"></div>
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
<script>
/* autoformat.js 依赖垫片：pcjson_com_msg / copyTxtToClipboard（原 tool.js 提供） */
(function () {
    var tMsg = document.getElementById('tMsg');
    var timer = null;
    function showMsg(msg) {
        if (!tMsg) return;
        tMsg.textContent = msg;
        tMsg.classList.add('show');
        if (timer) clearTimeout(timer);
        timer = setTimeout(function () { tMsg.classList.remove('show'); }, 4000);
    }
    window.pcjson_com_msg = function (target, msg) {
        showMsg(msg);
        if (target && target.length && target[0] && target[0].focus) target[0].focus();
    };
    window.copyTxtToClipboard = function (id, selector) {
        var el = document.querySelector(id);
        var text = el ? (el.value != null ? el.value : el.textContent) : '';
        if (!text) { showMsg('复制失败，请手动复制'); return false; }
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(function () { showMsg('已复制'); }, function () { showMsg('复制失败，请手动复制'); });
        } else {
            var ta = document.createElement('textarea');
            ta.value = text;
            ta.style.position = 'fixed';
            ta.style.opacity = '0';
            document.body.appendChild(ta);
            ta.select();
            try { document.execCommand('copy'); showMsg('已复制'); } catch (e) { showMsg('复制失败，请手动复制'); }
            document.body.removeChild(ta);
        }
        return true;
    };
})();
</script>
<script src="/static/script/pcjs/autoformat.js"></script>
<script src="/static/script/toolbox.js"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
