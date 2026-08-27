<?php /*a:6:{s:46:"/app/application/index/view/index/encrypt.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title><?php echo htmlentities(app('config')->get('web.encrypt.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title>
    <meta name="applicable-device" content="pc,mobile"/>
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.encrypt.keywords')); ?>"/>
    <meta name="description" content="<?php echo htmlentities(app('config')->get('web.encrypt.description')); ?>"/>
    <meta name="renderer" content="webkit"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon"/>
    <link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/style/tool-theme.css" rel="stylesheet" type="text/css"/>
    <!--[if lt IE 9]>
    <script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo app('config')->get('web.header'); ?><link rel="canonical" href="<?php echo request()->domain(); ?><?php echo htmlentities((isset($current_url) && ($current_url !== '')?$current_url:'/')); ?>" />
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

</head>
<body>
<link href="/static/style/theme-uno.css" rel="stylesheet" type="text/css"/>
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
        <h2 class="tool-title"><span class="t-ico">🔐</span>加密解密</h2>
        <p class="tool-desc">对称加密 / 解密、哈希散列、htpasswd 密码文件生成三合一，支持 AES、DES、RC4、Rabbit、TripleDES、MD5、SHA 系列、SHA3、HMAC，全程浏览器本地运算。</p>
        <ul class="t-tabs">
            <li><button type="button" class="t-tab active" data-panel="dePanel">🔐 对称加密/解密</button></li>
            <li><button type="button" class="t-tab" data-panel="haPanel">🔑 哈希/散列</button></li>
            <li><button type="button" class="t-tab" data-panel="hpPanel">🔒 htpasswd 生成</button></li>
        </ul>
        <!-- 对称加密 / 解密 -->
        <div id="dePanel" class="t-panel active">
            <label class="t-label" for="deInput">输入内容</label>
            <textarea class="t-area" id="deInput" rows="6" placeholder="请输入要加密或解密的内容"></textarea>
            <div class="t-grid" style="margin-top:12px">
                <div class="t-col">
                    <label class="t-label" for="deAlgo">加密算法</label>
                    <select class="t-input" style="width:100%" id="deAlgo">
                        <option value="AES">AES</option>
                        <option value="DES">DES</option>
                        <option value="RC4">RC4</option>
                        <option value="Rabbit">Rabbit</option>
                        <option value="TripleDES">TripleDES</option>
                    </select>
                </div>
                <div class="t-col" style="flex:2">
                    <label class="t-label" for="dePwd">密钥</label>
                    <input class="t-input" style="width:100%" type="text" id="dePwd" placeholder="请输入加密密钥">
                </div>
            </div>
            <div class="tool-actions" style="margin-top:14px">
                <button class="t-btn" type="button" id="deEncrypt">加密</button>
                <button class="t-btn t-btn-ok" type="button" id="deDecrypt">解密</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#deOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="deClear">清空</button>
            </div>
            <div class="t-result" id="deResult"><textarea class="t-area t-area-readonly" id="deOutput" rows="6" readonly></textarea></div>
            <div class="t-error" id="deError"></div>
        </div>
        <!-- 哈希 / 散列 -->
        <div id="haPanel" class="t-panel">
            <label class="t-label" for="haInput">输入内容</label>
            <textarea class="t-area" id="haInput" rows="6" placeholder="请输入要计算哈希的内容"></textarea>
            <div class="t-grid" style="margin-top:12px">
                <div class="t-col">
                    <label class="t-label" for="haAlgo">哈希算法</label>
                    <select class="t-input" style="width:100%" id="haAlgo">
                        <optgroup label="普通哈希">
                            <option value="MD5">MD5</option>
                            <option value="SHA1">SHA1</option>
                            <option value="SHA224">SHA224</option>
                            <option value="SHA256">SHA256</option>
                            <option value="SHA384">SHA384</option>
                            <option value="SHA512">SHA512</option>
                            <option value="RIPEMD160">RIPEMD160</option>
                            <option value="SHA3">SHA3 (256)</option>
                        </optgroup>
                        <optgroup label="HMAC 消息认证码（需密钥）">
                            <option value="HmacMD5">HmacMD5</option>
                            <option value="HmacSHA1">HmacSHA1</option>
                            <option value="HmacSHA224">HmacSHA224</option>
                            <option value="HmacSHA256">HmacSHA256</option>
                            <option value="HmacSHA384">HmacSHA384</option>
                            <option value="HmacSHA512">HmacSHA512</option>
                        </optgroup>
                    </select>
                </div>
                <div class="t-col">
                    <label class="t-label" for="haCase">输出格式</label>
                    <select class="t-input" style="width:100%" id="haCase">
                        <option value="lower">十六进制（小写）</option>
                        <option value="upper">十六进制（大写）</option>
                    </select>
                </div>
            </div>
            <div id="haPwdWrap" class="t-row" style="margin-top:12px;display:none">
                <div class="t-col" style="flex:1">
                    <label class="t-label" for="haPwd">HMAC 密钥</label>
                    <input class="t-input" style="width:100%" type="text" id="haPwd" placeholder="请输入 HMAC 密钥">
                </div>
            </div>
            <div class="tool-actions" style="margin-top:14px">
                <button class="t-btn" type="button" id="haRun">开始加密</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#haOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="haClear">清空</button>
            </div>
            <div class="t-result" id="haResult"><textarea class="t-area t-area-readonly" id="haOutput" rows="4" readonly></textarea></div>
            <div class="t-error" id="haError"></div>
        </div>
        <!-- htpasswd 生成 -->
        <div id="hpPanel" class="t-panel">
            <div class="t-grid">
                <div class="t-col">
                    <label class="t-label" for="hpUser">用户名</label>
                    <input class="t-input" style="width:100%" type="text" id="hpUser" placeholder="请输入用户名">
                </div>
                <div class="t-col">
                    <label class="t-label" for="hpPwd">密码</label>
                    <input class="t-input" style="width:100%" type="text" id="hpPwd" placeholder="请输入密码">
                </div>
            </div>
            <div class="t-grid" style="margin-top:12px">
                <div class="t-col">
                    <label class="t-label" for="hpAlg">加密算法</label>
                    <select class="t-input" style="width:100%" id="hpAlg">
                        <option value="0">plain (Windows &amp; TPF servers)</option>
                        <option value="1">Crypt (all Unix servers)</option>
                        <option selected="selected" value="2">MD5 (Apache servers only)</option>
                        <option value="3">SHA-1 (Netscape-LDIF / Apache servers)</option>
                    </select>
                </div>
            </div>
            <div class="tool-actions" style="margin-top:14px">
                <button class="t-btn" type="button" id="hpGen">点击生成</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#hpResult">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="hpClear">清空</button>
            </div>
            <div class="t-result" id="hpResultWrap"><input class="t-input" style="width:100%" type="text" id="hpResult" readonly placeholder="生成结果将显示在这里…"></div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于加密与哈希</h2>
        <p class="tool-desc">对称加密使用同一密钥加解密，AES 为目前最主流标准，DES/TripleDES 为历史经典算法，RC4 与 Rabbit 为流密码。哈希是单向函数，同一输入永远得到同一输出，但无法反推原文，常用于密码存储与数据校验；MD5 与 SHA1 已被证实存在碰撞风险，安全场景建议使用 SHA256 及以上；HMAC 需额外密钥，用于消息完整性认证。htpasswd 用于生成 Apache HTTP 基本认证的密码文件。本工具基于 CryptoJS 实现，数据不离开浏览器。</p>
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
<script src="/static/script/encrypt/pcjson-aes.js" type="text/javascript"></script>
<script src="/static/script/encrypt/tripledes.js" type="text/javascript"></script>
<script src="/static/script/encrypt/rabbit.js" type="text/javascript"></script>
<script src="/static/script/encrypt/rc4.js" type="text/javascript"></script>
<script src="/static/script/encrypt/pcjson-md5.js" type="text/javascript"></script>
<script src="/static/script/encrypt/pcjson-sha1.js" type="text/javascript"></script>
<script src="/static/script/encrypt/pcjson-sha224.js" type="text/javascript"></script>
<script src="/static/script/encrypt/pcjson-sha256.js" type="text/javascript"></script>
<script src="/static/script/encrypt/pcjson-sha384.js" type="text/javascript"></script>
<script src="/static/script/encrypt/pcjson-sha512.js" type="text/javascript"></script>
<script src="/static/script/encrypt/pcjson-ripemd160.js" type="text/javascript"></script>
<script src="/static/script/encrypt/pcjson-sha3.js" type="text/javascript"></script>
<script src="/static/script/pcjs/htpasswd/htpsha1.js"></script>
<script src="/static/script/pcjs/htpasswd/htpasswd.js"></script>
<script src="/static/script/pcjs/htpasswd/jsnote.js"></script>
<script src="/static/script/pcjs/htpasswd/htpmd5.js"></script>
<script>
/* tab 切换 */
(function () {
    var tabs = document.querySelectorAll('.t-tab');
    var panels = document.querySelectorAll('.t-panel');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            panels.forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
        });
    });
})();
/* 对称加密 / 解密 */
(function () {
    var err = document.getElementById('deError');
    function showErr(m) { err.textContent = m; err.classList.add('show'); }
    function getAlgo() { return document.getElementById('deAlgo').value; }
    function doRun(enc) {
        err.classList.remove('show');
        var content = document.getElementById('deInput').value;
        var pwd = document.getElementById('dePwd').value;
        if (!content) { showErr('请输入内容'); return; }
        if (!pwd) { showErr('请输入密钥'); return; }
        var algo = getAlgo();
        var ret;
        try {
            if (enc) {
                ret = CryptoJS[algo].encrypt(content, pwd).toString();
            } else {
                var dec = CryptoJS[algo].decrypt(content, pwd);
                ret = dec.toString(CryptoJS.enc.Utf8);
                if (!ret) { showErr('解密失败：密钥错误或密文格式不正确'); return; }
            }
        } catch (e) {
            showErr('处理出错：' + e.message);
            return;
        }
        document.getElementById('deOutput').value = ret;
        document.getElementById('deResult').classList.add('show');
    }
    document.getElementById('deEncrypt').addEventListener('click', function () { doRun(true); });
    document.getElementById('deDecrypt').addEventListener('click', function () { doRun(false); });
    document.getElementById('deClear').addEventListener('click', function () {
        document.getElementById('deInput').value = '';
        document.getElementById('dePwd').value = '';
        document.getElementById('deOutput').value = '';
        document.getElementById('deResult').classList.remove('show');
        err.classList.remove('show');
        document.getElementById('deInput').focus();
    });
})();
/* 哈希 / 散列 */
(function () {
    var err = document.getElementById('haError');
    var pwdWrap = document.getElementById('haPwdWrap');
    var algoSel = document.getElementById('haAlgo');
    function showErr(m) { err.textContent = m; err.classList.add('show'); }
    function isHmac() { return algoSel.value.indexOf('Hmac') === 0; }
    algoSel.addEventListener('change', function () {
        pwdWrap.style.display = isHmac() ? '' : 'none';
    });
    document.getElementById('haRun').addEventListener('click', function () {
        err.classList.remove('show');
        var content = document.getElementById('haInput').value;
        if (!content) { showErr('请输入内容'); return; }
        var algo = algoSel.value;
        var pwd = document.getElementById('haPwd').value;
        if (isHmac() && !pwd) { showErr('请输入 HMAC 密钥'); return; }
        var ret;
        try {
            if (isHmac()) {
                ret = CryptoJS[algo](content, pwd).toString();
            } else if (algo === 'SHA3') {
                ret = CryptoJS.SHA3(content, { outputLength: 256 }).toString();
            } else {
                ret = CryptoJS[algo](content).toString();
            }
        } catch (e) {
            showErr('处理出错：' + e.message);
            return;
        }
        if (document.getElementById('haCase').value === 'upper') {
            ret = ret.toUpperCase();
        }
        document.getElementById('haOutput').value = ret;
        document.getElementById('haResult').classList.add('show');
    });
    document.getElementById('haClear').addEventListener('click', function () {
        document.getElementById('haInput').value = '';
        document.getElementById('haPwd').value = '';
        document.getElementById('haOutput').value = '';
        document.getElementById('haResult').classList.remove('show');
        err.classList.remove('show');
        document.getElementById('haInput').focus();
    });
})();
/* htpasswd 生成 */
(function () {
    function getVal(id) { return document.getElementById(id).value; }
    document.getElementById('hpGen').addEventListener('click', function () {
        var u = getVal('hpUser');
        var p = getVal('hpPwd');
        if (!u) { showHpErr('请输入用户名'); return; }
        if (!p) { showHpErr('请输入密码'); return; }
        try {
            document.getElementById('hpResult').value = htpasswd(u, p, +getVal('hpAlg'));
            hideHpErr();
        } catch (e) {
            showHpErr('生成失败：' + e.message);
        }
    });
    document.getElementById('hpClear').addEventListener('click', function () {
        document.getElementById('hpUser').value = '';
        document.getElementById('hpPwd').value = '';
        document.getElementById('hpResult').value = '';
        hideHpErr();
        document.getElementById('hpUser').focus();
    });
    function showHpErr(m) {
        var e = document.getElementById('hpError');
        if (!e) {
            e = document.createElement('div');
            e.className = 't-error';
            e.id = 'hpError';
            document.getElementById('hpPanel').appendChild(e);
        }
        e.textContent = m;
        e.classList.add('show');
    }
    function hideHpErr() {
        var e = document.getElementById('hpError');
        if (e) e.classList.remove('show');
    }
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body>
</html>
