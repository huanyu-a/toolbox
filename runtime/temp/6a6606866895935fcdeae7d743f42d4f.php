<?php /*a:6:{s:48:"/app/application/index/view/index/hermescmd.html";i:1787133352;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.hermescmd.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.hermescmd.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.hermescmd.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T510L8HTF9"></script><script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-T510L8HTF9")</script><div class="container"><div class="tool-wrap"><div class="tool-card"><h2 class="tool-title"><span class="t-ico">🦐</span>Hermes 网关与进程管理命令速查</h2><p class="tool-desc">本机 Hermes（默认 + dingtalk2）网关 / Dashboard / Cron / 故障排查 / 自启管理命令，点击命令即可复制，Hermes Agent v0.20.0 实测。</p>   <div class="lt-search"><input type="search" id="linuxSearch" placeholder="输入命令或说明快速过滤" autocomplete="off" /></div><ul class="t-tabs"><li><button type="button" class="t-tab active" data-panel="p-gw">🌐 默认网关</button></li><li><button type="button" class="t-tab" data-panel="p-gw2">🔗 dingtalk2 网关</button></li><li><button type="button" class="t-tab" data-panel="p-dashboard">📊 Dashboard</button></li><li><button type="button" class="t-tab" data-panel="p-cron">⏰ Cron 定时任务</button></li><li><button type="button" class="t-tab" data-panel="p-clean">🧹 进程清理</button></li><li><button type="button" class="t-tab" data-panel="p-boot">🚫 开机自启</button></li><li><button type="button" class="t-tab" data-panel="p-trouble">🔧 故障排查</button></li></ul><div class="t-panel-wrap"><div class="lt-empty" id="linuxEmpty">未找到匹配的命令，请尝试其他关键词</div>

<div class="t-panel active" id="p-gw">
<h3 class="lt-sub">网关管理 · 默认网关（Hermes_Gateway_default）</h3>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>启动</td><td>hermes gateway start</td></tr>
<tr><td>停止</td><td>hermes gateway stop</td></tr>
<tr><td>重启</td><td>hermes gateway restart</td></tr>
<tr><td>状态</td><td>hermes gateway status</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-gw2">
<h3 class="lt-sub">网关管理 · dingtalk2 网关（Hermes_Gateway_dingtalk2）</h3>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>启动</td><td>hermes -p dingtalk2 gateway start</td></tr>
<tr><td>停止</td><td>hermes -p dingtalk2 gateway stop</td></tr>
<tr><td>重启</td><td>hermes -p dingtalk2 gateway restart</td></tr>
<tr><td>状态</td><td>hermes -p dingtalk2 gateway status</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-dashboard">
<h3 class="lt-sub">Dashboard 管理（端口 9119）</h3>
<div class="hm-note">⚠️ Dashboard 是 Web 服务进程，没有 start/stop 命令，只能结束进程。通常需要 <b>/F 强杀</b>（优雅停止常被系统拒绝）</div>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>查找 PID</td><td>netstat -ano | findstr :9119</td></tr>
<tr><td>关闭</td><td>taskkill /PID &lt;PID&gt; /F</td></tr>
<tr><td>确认</td><td>netstat -ano | findstr :9119</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-cron">
<h3 class="lt-sub">Cron 定时任务管理</h3>
<div class="hm-note">⚠️ 任务模型必须<b>显式指定</b>（--model + --provider）。全局模型配置一变，未 pin 模型的任务会被 drift guard 跳过（"Skipped to prevent unintended spend"），见故障排查</div>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>列出任务</td><td>hermes cron list</td></tr>
<tr><td>含已禁用</td><td>hermes cron list --all</td></tr>
<tr><td>创建任务</td><td>hermes cron create "50 19 * * *" "任务提示词" --name "任务名" --model sensenova-6.8-flash-lite --provider daili</td></tr>
<tr><td>改模型</td><td>hermes cron edit &lt;job_id&gt; --model sensenova-6.8-flash-lite --provider daili</td></tr>
<tr><td>手动触发</td><td>hermes cron run &lt;job_id&gt;</td></tr>
<tr><td>执行历史</td><td>hermes cron runs &lt;job_id&gt; --limit 10</td></tr>
<tr><td>暂停</td><td>hermes cron pause &lt;job_id&gt;</td></tr>
<tr><td>恢复</td><td>hermes cron resume &lt;job_id&gt;</td></tr>
<tr><td>删除任务</td><td>hermes cron remove &lt;job_id&gt;</td></tr>
<tr><td>调度器状态</td><td>hermes cron status</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-clean">
<h3 class="lt-sub">一键清理所有 Hermes 进程</h3>
<div class="hm-desc" style="font-size:13px;color:var(--text-2);margin-bottom:12px">含网关 + Dashboard 全部结束（PowerShell 执行）</div>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>全杀</td><td>Get-CimInstance Win32_Process | Where-Object { $_.CommandLine -match 'hermes_cli\.main' } | ForEach-Object { Stop-Process -Id $_.ProcessId -Force }</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-boot">
<h3 class="lt-sub">防止开机自启</h3>
<div class="hm-note">⚠️ Dashboard 开机自启是 Startup 文件夹里的 <b>Hermes_Dashboard.vbs</b>，删除或移走该文件即可</div>
<table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr>
<tr><td>删除 dingtalk2 任务</td><td>schtasks /Delete /TN "Hermes_Gateway_dingtalk2" /F</td></tr>
<tr><td>删除默认任务</td><td>schtasks /Delete /TN "Hermes_Gateway_default" /F</td></tr>
<tr><td>仅禁用（可恢复）</td><td>schtasks /Change /TN "Hermes_Gateway_dingtalk2" /Disable</td></tr>
</tbody></table>
</div>

<div class="t-panel" id="p-trouble">
<h3 class="lt-sub">故障排查速查</h3>

<div class="hm-card"><h3>① 'hermes' 不是内部或外部命令</h3><div class="hm-desc"><b>根因</b>：PATH 未生效或用了旧终端 · <b>解法</b>：新开终端；仍不行用完整路径</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>完整路径</td><td>"C:\Users\WIN11\AppData\Local\hermes\hermes-agent\venv\Scripts\hermes.exe" gateway status</td></tr></tbody></table></div>

<div class="hm-card"><h3>② HTTP 503: No available channel for model</h3><div class="hm-desc"><b>根因</b>：nexus 网关模型名不匹配——0731 系列必须带 <code>-chat</code> 后缀（如 <code>deepseek-v4-flash-0731-chat</code>）· <b>解法</b>：先用 curl 验证，再改任务模型</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>改模型</td><td>hermes cron edit &lt;job_id&gt; --model deepseek-v4-flash-0731-chat --provider daili</td></tr></tbody></table></div>

<div class="hm-card"><h3>③ Skipped to prevent unintended spend (drift guard)</h3><div class="hm-desc"><b>根因</b>：cron 任务模型未 pin，全局模型配置变更后任务被跳过 · <b>解法</b>：显式指定模型与 provider</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>pin 模型</td><td>hermes cron edit &lt;job_id&gt; --model sensenova-6.8-flash-lite --provider daili</td></tr></tbody></table></div>

<div class="hm-card"><h3>④ 停止 dashboard 报"拒绝访问"</h3><div class="hm-desc"><b>根因</b>：dashboard 进程不允许优雅停止 · <b>解法</b>：加 /F 强杀</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>强杀</td><td>taskkill /PID &lt;PID&gt; /F</td></tr></tbody></table></div>

<div class="hm-card"><h3>⑤ 网关 stop 后又自动复活</h3><div class="hm-desc"><b>根因</b>：计划任务 / 开机自启脚本残留 · <b>解法</b>：删计划任务 + Startup 里的 Hermes VBS</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>删 dingtalk2</td><td>schtasks /Delete /TN "Hermes_Gateway_dingtalk2" /F</td></tr><tr><td>删默认</td><td>schtasks /Delete /TN "Hermes_Gateway_default" /F</td></tr></tbody></table></div>

<div class="hm-card"><h3>⑥ 端口 9119 被占用 / dashboard 起不来</h3><div class="hm-desc"><b>根因</b>：已有 dashboard 实例在跑 · <b>解法</b>：找到 PID 结束即可</div><table class="lt"><tbody><tr><th>操作</th><th>命令</th></tr><tr><td>找 PID</td><td>netstat -ano | findstr :9119</td></tr><tr><td>结束</td><td>taskkill /PID &lt;PID&gt; /F</td></tr></tbody></table></div>
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