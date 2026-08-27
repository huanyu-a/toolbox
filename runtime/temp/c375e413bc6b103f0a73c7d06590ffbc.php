<?php /*a:6:{s:52:"/app/application/index/view/index/claudecodecmd.html";i:1787650467;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.claudecodecmd.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.claudecodecmd.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.claudecodecmd.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
<link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/style/tool-theme.css" rel="stylesheet" type="text/css"/><style>.tool-card .t-tabs{display:flex;flex-wrap:wrap;gap:6px;margin:0 0 18px;padding:0;list-style:none}.tool-card .t-tabs li{margin:0}.tool-card .t-tabs button.t-tab{display:inline-block;padding:7px 14px;font-size:13px;line-height:1.4;color:var(--text-2,#666);background:var(--surface,#fff);border:1px solid var(--border,#ddd);border-radius:8px;cursor:pointer;transition:color .2s,border-color .2s}.tool-card .t-tabs button.t-tab:hover{color:var(--brand,#4f6ef2);border-color:var(--brand,#4f6ef2)}.tool-card .t-tabs button.t-tab.active{color:#fff;background:var(--brand,#4f6ef2);border-color:var(--brand,#4f6ef2);font-weight:600}.t-panel{display:none}.t-panel.active{display:block}.lt-search{margin:0 0 16px}.lt-search input{width:100%;box-sizing:border-box;padding:9px 12px;font-size:14px;color:var(--text-1,#333);border:1px solid var(--border,#ddd);border-radius:8px;outline:none}.lt-search input:focus{border-color:var(--brand,#4f6ef2)}.lt-sub{font-size:14px;font-weight:600;color:var(--text-2,#555);margin:0 0 10px;padding:8px 12px;background:var(--surface,#f6f7fb);border-left:3px solid var(--brand,#4f6ef2);border-radius:4px}.lt{width:100%;border-collapse:collapse;margin:0 0 20px;font-size:13px;line-height:1.6}.lt th,.lt td{border:1px solid var(--border,#e4e4e4);padding:7px 10px;text-align:left;vertical-align:top}.lt th{background:var(--surface,#f4f6fb);font-weight:600;white-space:nowrap;color:var(--text-1,#333)}.lt td:first-child{font-family:Consolas,Monaco,Menlo,monospace;color:#0a6b5a;overflow-wrap:anywhere;cursor:pointer;position:relative}.lt td:first-child:hover{background:#e8f5ee!important}.lt td:first-child.copied{background:#d4edda!important}.lt-copied{position:absolute;right:6px;top:50%;transform:translateY(-50%);font-size:11px;color:#155724;background:#d4edda;border-radius:3px;padding:1px 5px;white-space:nowrap}.lt tr:nth-child(even) td{background:#fafbfe}.lt-empty{display:none;padding:20px;text-align:center;color:var(--text-3,#999);font-size:13px}.hm-note{background:#fef6e7;border:1px solid #f3ddb6;color:#b45309;border-radius:10px;padding:10px 14px;font-size:13px;margin:10px 0}.hm-note b{font-weight:700}.hm-tip{background:#eaf1ff;border:1px solid #bcd0f7;color:#2459c8;border-radius:10px;padding:10px 14px;font-size:13px;margin:10px 0}.hm-card{background:#fff;border:1px solid var(--border,#e3e6ea);border-radius:10px;padding:12px 14px;margin-bottom:10px}.hm-card h3{font-size:14px;margin:0 0 4px}.hm-card .hm-desc{font-size:13px;color:var(--text-2,#666);margin-bottom:8px}</style><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]--><?php echo app('config')->get('web.header'); ?><link rel="canonical" href="<?php echo request()->domain(); ?><?php echo htmlentities((isset($current_url) && ($current_url !== '')?$current_url:'/')); ?>" />
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script><div class="container"><div class="tool-wrap"><div class="tool-card"><h2 class="tool-title"><span class="t-ico">🤖</span>Claude Code 命令速查</h2><p class="tool-desc">Claude Code CLI 命令在线速查：涵盖会话管理、文件操作、Git 集成、MCP 工具调用、配置管理等常用命令，点击命令即可复制。</p>   <div class="lt-search"><input type="search" id="linuxSearch" placeholder="输入命令或说明快速过滤" autocomplete="off" /></div><ul class="t-tabs"><li><button type="button" class="t-tab active" data-panel="p-basic">🚀 基础命令</button></li><li><button type="button" class="t-tab" data-panel="p-file">📁 文件操作</button></li><li><button type="button" class="t-tab" data-panel="p-git">🌿 Git 集成</button></li><li><button type="button" class="t-tab" data-panel="p-mcp">🔌 MCP 工具</button></li><li><button type="button" class="t-tab" data-panel="p-config">⚙️ 配置管理</button></li><li><button type="button" class="t-tab" data-panel="p-trouble">🔧 故障排查</button></li></ul><div class="t-panel-wrap"><div class="lt-empty" id="linuxEmpty">未找到匹配的命令，请尝试其他关键词</div>

<div class="t-panel active" id="p-basic">
<h3 class="lt-sub">会话管理</h3>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>启动交互会话</td><td>claude</td></tr>
<tr><td>单次执行（非交互）</td><td>claude -p "你的提示词"</td></tr>
<tr><td>继续上次会话</td><td>claude -r</td></tr>
<tr><td>指定会话 ID 继续</td><td>claude -r &lt;session_id&gt;</td></tr>
<tr><td>列出历史会话</td><td>claude sessions list</td></tr>
<tr><td>清除当前会话</td><td>claude sessions clear</td></tr>
<tr><td>退出会话</td><td>/exit 或 Ctrl+C</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-file">
<h3 class="lt-sub">文件与代码操作</h3>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>读取文件</td><td>请读取 path/to/file.txt</td></tr>
<tr><td>写入文件</td><td>将以下内容写入 path/to/file.txt: ...</td></tr>
<tr><td>搜索文件</td><td>在当前目录搜索包含 "关键词" 的文件</td></tr>
<tr><td>列出目录</td><td>列出当前目录下的所有文件</td></tr>
<tr><td>编辑代码</td><td>修改 path/to/file.js 第 10-15 行</td></tr>
<tr><td>创建文件</td><td>创建 path/to/newfile.py 并写入内容</td></tr>
<tr><td>删除文件</td><td>删除 path/to/oldfile.txt</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-git">
<h3 class="lt-sub">Git 集成</h3>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>查看状态</td><td>git status</td></tr>
<tr><td>查看差异</td><td>git diff</td></tr>
<tr><td>提交更改</td><td>git commit -m "提交信息"</td></tr>
<tr><td>创建分支</td><td>git checkout -b feature/new-feature</td></tr>
<tr><td>合并分支</td><td>git merge feature/branch-name</td></tr>
<tr><td>推送代码</td><td>git push origin main</td></tr>
<tr><td>拉取更新</td><td>git pull origin main</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-mcp">
<h3 class="lt-sub">MCP 工具调用</h3>
<div class="hm-note">⚠️ MCP (Model Context Protocol) 允许 Claude 调用外部工具和服务</div>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>列出可用工具</td><td>/mcp list</td></tr>
<tr><td>调用工具</td><td>使用 tool_name 工具执行操作</td></tr>
<tr><td>查看工具详情</td><td>/mcp describe tool_name</td></tr>
<tr><td>配置 MCP</td><td>编辑 ~/.claude/claude_desktop_config.json</td></tr>
<tr><td>重启 MCP 服务</td><td>重启 Claude Desktop 应用</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-config">
<h3 class="lt-sub">配置管理</h3>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>查看配置</td><td>claude config list</td></tr>
<tr><td>设置 API Key</td><td>export ANTHROPIC_API_KEY=your_key</td></tr>
<tr><td>设置默认模型</td><td>claude config set model claude-3-5-sonnet</td></tr>
<tr><td>设置温度</td><td>claude config set temperature 0.7</td></tr>
<tr><td>设置最大 token</td><td>claude config set max_tokens 4096</td></tr>
<tr><td>重置配置</td><td>claude config reset</td></tr>
<tr><td>配置文件路径</td><td>~/.claude/config.json</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-trouble">
<h3 class="lt-sub">故障排查</h3>

<div class="hm-card"><h3>① 命令未找到</h3><div class="hm-desc"><b>根因</b>：claude CLI 未安装或不在 PATH 中 · <b>解法</b>：安装或检查环境变量</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>检查安装</td><td>which claude</td></tr><tr><td>重新安装</td><td>npm install -g @anthropic-ai/claude-code</td></tr></tbody></table></div>

<div class="hm-card"><h3>② API Key 无效</h3><div class="hm-desc"><b>根因</b>：API Key 未设置或过期 · <b>解法</b>：检查环境变量或重新设置</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>检查环境变量</td><td>echo $ANTHROPIC_API_KEY</td></tr><tr><td>重新设置</td><td>export ANTHROPIC_API_KEY=your_new_key</td></tr></tbody></table></div>

<div class="hm-card"><h3>③ 网络连接失败</h3><div class="hm-desc"><b>根因</b>：网络问题或代理配置 · <b>解法</b>：检查网络连接和代理设置</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>测试网络</td><td>curl https://api.anthropic.com</td></tr><tr><td>设置代理</td><td>export HTTPS_PROXY=http://proxy:port</td></tr></tbody></table></div>

<div class="hm-card"><h3>④ 权限被拒绝</h3><div class="hm-desc"><b>根因</b>：文件读写权限不足 · <b>解法</b>：使用 sudo 或调整权限</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>检查权限</td><td>ls -la path/to/file</td></tr><tr><td>修改权限</td><td>chmod 644 path/to/file</td></tr></tbody></table></div>

<div class="hm-card"><h3>⑤ 会话卡住无响应</h3><div class="hm-desc"><b>根因</b>：长时间运行或 API 超时 · <b>解法</b>：中断并重启会话</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>中断</td><td>Ctrl+C</td></tr><tr><td>重启</td><td>claude</td></tr></tbody></table></div>
</div>

</div></div></div>
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
<script src="/static/script/app.js" type="text/javascript"></script>
<script>
(function(){'use strict';
var tabs=document.querySelectorAll('.t-tab'),panels=document.querySelectorAll('.t-panel'),box=document.getElementById('linuxSearch'),empty=document.getElementById('linuxEmpty');
function filter(){
  var q=box.value.trim().toLowerCase(),active=document.querySelector('.t-panel.active'),n=0;
  active.querySelectorAll('tbody tr').forEach(function(tr){
    if(tr.querySelector('th')){tr.style.display='';return;}
    var hit=!q||tr.textContent.toLowerCase().indexOf(q)>-1;
    tr.style.display=hit?'':'none';
    if(hit)n++;
  });
  empty.style.display=(q&&n===0)?'block':'none';
}
tabs.forEach(function(b){b.addEventListener('click',function(){
  tabs.forEach(function(x){x.classList.remove('active');});
  panels.forEach(function(p){p.classList.remove('active');});
  b.classList.add('active');
  document.getElementById(b.getAttribute('data-panel')).classList.add('active');
  filter();
});});
box.addEventListener('input',filter);

// ===== 点击命令代码一键复制 =====
function ltFallbackCopy(text) {
    var ta = document.createElement('textarea');
    ta.value = text;
    ta.style.position = 'fixed';
    ta.style.opacity = '0';
    document.body.appendChild(ta);
    ta.select();
    try { document.execCommand('copy'); } catch (e) {}
    document.body.removeChild(ta);
}
function ltCopy(text, td) {
    function ok() {
        td.classList.add('copied');
        var tip = document.createElement('span');
        tip.className = 'lt-copied';
        tip.textContent = '✓ 已复制';
        td.appendChild(tip);
        setTimeout(function () {
            td.classList.remove('copied');
            if (tip.parentNode) tip.parentNode.removeChild(tip);
        }, 1200);
    }
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(ok, function () { ltFallbackCopy(text); ok(); });
    } else {
        ltFallbackCopy(text); ok();
    }
}
document.addEventListener('click', function (e) {
    var n = e.target;
    while (n && n.tagName !== 'TD' && n !== document.body) n = n.parentNode;
    if (!n || n.tagName !== 'TD') return;
    var table = n.closest ? n.closest('table.lt') : null;
    if (!table) return;
    if (n.cellIndex !== 0 && n.cellIndex !== 1) return;
    if (n.querySelector('th')) return;
    var txt = n.textContent.replace(/\s+/g, ' ').trim();
    if (txt) ltCopy(txt, n);
});
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>