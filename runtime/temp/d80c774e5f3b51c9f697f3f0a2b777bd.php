<?php /*a:6:{s:48:"/app/application/index/view/index/jsencrypt.html";i:1787024461;s:36:"/app/application/index/view/seo.html";i:1787024468;s:39:"/app/application/index/view/header.html";i:1787218864;s:36:"/app/application/index/view/nav.html";i:1786603123;s:39:"/app/application/index/view/footer.html";i:1787218004;s:37:"/app/application/index/view/link.html";i:1787217514;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title><?php echo htmlentities(app('config')->get('web.jsencrypt.title')); ?>-<?php echo htmlentities(app('config')->get('web.site.name')); ?></title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="<?php echo htmlentities(app('config')->get('web.jsencrypt.keywords')); ?>" /><meta name="description" content="<?php echo htmlentities(app('config')->get('web.jsencrypt.description')); ?>" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>
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
        <h2 class="tool-title"><span class="t-ico">⚡</span>JS 加密混淆</h2>
        <p class="tool-desc">JS 加密/解密与 JS 代码混合加密（混淆）三合一：Packer 式 JS 加密解密、变量名混淆混合加密，全程浏览器本地运算。</p>
        <div class="t-panel active">
            <label class="t-label" for="jsInput">请输入要加密、解密、混淆的 Js 代码</label>
            <textarea class="t-area" id="jsInput" rows="12" placeholder="请输入要加密、解密、混淆的Js代码"></textarea>
            <div class="tool-actions">
                <button class="t-btn t-btn-ok" type="button" id="btnEncode">JS 加密</button>
                <button class="t-btn" type="button" id="btnDecode">JS 解密</button>
                <button class="t-btn" type="button" id="BtnCon">JS 混合加密</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#jsResultText">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="btnClear">清空</button>
            </div>
            <label class="t-label" for="jsResultText">加解密结果</label>
            <div class="t-result" id="jsResultBox">
                <div id="jsResultText"></div>
            </div>
            <div class="t-error" id="jsError"></div>
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
<script src="/static/script/toolbox.js" type="text/javascript"></script>
<script src="/static/script/jsformat/jsendecode.js" type="text/javascript"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script>
(function () {
    var input = document.getElementById('jsInput');
    var resultBox = document.getElementById('jsResultBox');
    var resultText = document.getElementById('jsResultText');
    var err = document.getElementById('jsError');
    function showErr(m) { resultBox.classList.remove('show'); err.textContent = m; err.classList.add('show'); }
    function hideErr() { err.classList.remove('show'); }
    function showResult(v) { hideErr(); resultText.textContent = v; resultBox.classList.add('show'); }

    // 以下 js_beautify 与原 jsformat/jsformat.js 中函数一致（内联，避免外部依赖）
    function js_beautify(js_source_text, indent_size, indent_character, indent_level)
    {

        var input, output, token_text, last_type, last_text, last_word, current_mode, modes, indent_string;
        var whitespace, wordchar, punct, parser_pos, line_starters, in_case;



        var prefix, token_type, do_block_just_closed, var_line, var_line_tainted;



        function trim_output()
        {
            while (output.length && (output[output.length - 1] === ' ' || output[output.length - 1] === indent_string)) {
                output.pop();
            }
        }

        function print_newline(ignore_repeated)
        {
            ignore_repeated = typeof ignore_repeated === 'undefined' ? true: ignore_repeated;
            
            trim_output();

            if (!output.length) {
                return; // no newline on start of file
            }

            if (output[output.length - 1] !== "\n" || !ignore_repeated) {
                output.push("\n");
            }
            for (var i = 0; i < indent_level; i++) {
                output.push(indent_string);
            }
        }



        function print_space()
        {
            var last_output = output.length ? output[output.length - 1] : ' ';
            if (last_output !== ' ' && last_output !== '\n' && last_output !== indent_string) { // prevent occassional duplicate space
                output.push(' ');
            }
        }


        function print_token()
        {
            output.push(token_text);
        }

        function indent()
        {
            indent_level++;
        }


        function unindent()
        {
            if (indent_level) {
                indent_level--;
            }
        }


        function remove_indent()
        {
            if (output.length && output[output.length - 1] === indent_string) {
                output.pop();
            }
        }


        function set_mode(mode)
        {
            modes.push(current_mode);
            current_mode = mode;
        }


        function restore_mode()
        {
            do_block_just_closed = current_mode === 'DO_BLOCK';
            current_mode = modes.pop();
        }


        function in_array(what, arr)
        {
            for (var i = 0; i < arr.length; i++)
            {
                if (arr[i] === what) {
                    return true;
                }
            }
            return false;
        }



        function get_next_token()
        {
            var n_newlines = 0;
            var c = '';

            do {
                if (parser_pos >= input.length) {
                    return ['', 'TK_EOF'];
                }
                c = input.charAt(parser_pos);

                parser_pos += 1;
                if (c === "\n") {
                    n_newlines += 1;
                }
            }
            while (in_array(c, whitespace));

            if (n_newlines > 1) {
                for (var i = 0; i < 2; i++) {
                    print_newline(i === 0);
                }
            }
            var wanted_newline = (n_newlines === 1);


            if (in_array(c, wordchar)) {
                if (parser_pos < input.length) {
                    while (in_array(input.charAt(parser_pos), wordchar)) {
                        c += input.charAt(parser_pos);
                        parser_pos += 1;
                        if (parser_pos === input.length) {
                            break;
                        }
                    }
                }

                // small and surprisingly unugly hack for 1E-10 representation
                if (parser_pos !== input.length && c.match(/^[0-9]+[Ee]$/) && input.charAt(parser_pos) === '-') {
                    parser_pos += 1;

                    var t = get_next_token(parser_pos);
                    c += '-' + t[0];
                    return [c, 'TK_WORD'];
                }

                if (c === 'in') { // hack for 'in' operator
                    return [c, 'TK_OPERATOR'];
                }
                return [c, 'TK_WORD'];
            }
            
            if (c === '(' || c === '[') {
                return [c, 'TK_START_EXPR'];
            }

            if (c === ')' || c === ']') {
                return [c, 'TK_END_EXPR'];
            }

            if (c === '{') {
                return [c, 'TK_START_BLOCK'];
            }

            if (c === '}') {
                return [c, 'TK_END_BLOCK'];
            }

            if (c === ';') {
                return [c, 'TK_END_COMMAND'];
            }

            if (c === '/') {
                var comment = '';
                // peek for comment /* ... */
                if (input.charAt(parser_pos) === '*') {
                    parser_pos += 1;
                    if (parser_pos < input.length) {
                        while (! (input.charAt(parser_pos) === '*' && input.charAt(parser_pos + 1) && input.charAt(parser_pos + 1) === '/') && parser_pos < input.length) {
                            comment += input.charAt(parser_pos);
                            parser_pos += 1;
                            if (parser_pos >= input.length) {
                                break;
                            }
                        }
                    }
                    parser_pos += 2;
                    return ['/*' + comment + '*/', 'TK_BLOCK_COMMENT'];
                }
                // peek for comment // ...
                if (input.charAt(parser_pos) === '/') {
                    comment = c;
                    while (input.charAt(parser_pos) !== "\x0d" && input.charAt(parser_pos) !== "\x0a") {
                        comment += input.charAt(parser_pos);
                        parser_pos += 1;
                        if (parser_pos >= input.length) {
                            break;
                        }
                    }
                    parser_pos += 1;
                    if (wanted_newline) {
                        print_newline();
                    }
                    return [comment, 'TK_COMMENT'];
                }

            }

            if (c === "'" || // string
            c === '"' || // string
            (c === '/' &&
            ((last_type === 'TK_WORD' && last_text === 'return') || (last_type === 'TK_START_EXPR' || last_type === 'TK_END_BLOCK' || last_type === 'TK_OPERATOR' || last_type === 'TK_EOF' || last_type === 'TK_END_COMMAND')))) { // regexp
                var sep = c;
                var esc = false;
                c = '';

                if (parser_pos < input.length) {

                    while (esc || input.charAt(parser_pos) !== sep) {
                        c += input.charAt(parser_pos);
                        if (!esc) {
                            esc = input.charAt(parser_pos) === '\\';
                        } else {
                            esc = false;
                        }
                        parser_pos += 1;
                        if (parser_pos >= input.length) {
                            break;
                        }
                    }

                }

                parser_pos += 1;
                if (last_type === 'TK_END_COMMAND') {
                    print_newline();
                }
                return [sep + c + sep, 'TK_STRING'];
            }

            if (in_array(c, punct)) {
                while (parser_pos < input.length && in_array(c + input.charAt(parser_pos), punct)) {
                    c += input.charAt(parser_pos);
                    parser_pos += 1;
                    if (parser_pos >= input.length) {
                        break;
                    }
                }
                return [c, 'TK_OPERATOR'];
            }

            return [c, 'TK_UNKNOWN'];
        }


        //----------------------------------

        indent_character = indent_character || ' ';
        indent_size = indent_size || 4;

        indent_string = '';
        while (indent_size--) {
            indent_string += indent_character;
        }

        input = js_source_text;

        last_word = ''; // last 'TK_WORD' passed
        last_type = 'TK_START_EXPR'; // last token type
        last_text = ''; // last token text
        output = [];

        do_block_just_closed = false;
        var_line = false;
        var_line_tainted = false;

        whitespace = "\n\r\t ".split('');
        wordchar = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_$'.split('');
        punct = '+ - * / % & ++ -- = += -= *= /= %= == === != !== > < >= <= >> << >>> >>>= >>= <<= && &= | || ! !! , : ? ^ ^= |='.split(' ');

        // words which should always start on new line.
        line_starters = 'continue,try,throw,return,var,if,switch,case,default,for,while,break,function'.split(',');

        // states showing if we are currently in expression (i.e. "if" case) - 'EXPRESSION', or in usual block (like, procedure), 'BLOCK'.
        // some formatting depends on that.
        current_mode = 'BLOCK';
        modes = [current_mode];

        indent_level = indent_level || 0;
        parser_pos = 0; // parser position
        in_case = false; // flag for parser that case/default has been processed, and next colon needs special attention
        while (true) {
            var t = get_next_token(parser_pos);
            token_text = t[0];
            token_type = t[1];
            if (token_type === 'TK_EOF') {
                break;
            }

            switch (token_type) {

            case 'TK_START_EXPR':
                var_line = false;
                set_mode('EXPRESSION');
                if (last_type === 'TK_END_EXPR' || last_type === 'TK_START_EXPR') {
                    // do nothing on (( and )( and ][ and ]( ..
                } else if (last_type !== 'TK_WORD' && last_type !== 'TK_OPERATOR') {
                    print_space();
                } else if (in_array(last_word, line_starters) && last_word !== 'function') {
                    print_space();
                }
                print_token();
                break;

            case 'TK_END_EXPR':
                print_token();
                restore_mode();
                break;

            case 'TK_START_BLOCK':
                
                if (last_word === 'do') {
                    set_mode('DO_BLOCK');
                } else {
                    set_mode('BLOCK');
                }
                if (last_type !== 'TK_OPERATOR' && last_type !== 'TK_START_EXPR') {
                    if (last_type === 'TK_START_BLOCK') {
                        print_newline();
                    } else {
                        print_space();
                    }
                }
                print_token();
                indent();
                break;

            case 'TK_END_BLOCK':
                if (last_type === 'TK_START_BLOCK') {
                    // nothing
                    trim_output();
                    unindent();
                } else {
                    unindent();
                    print_newline();
                }
                print_token();
                restore_mode();
                break;

            case 'TK_WORD':

                if (do_block_just_closed) {
                    print_space();
                    print_token();
                    print_space();
                    break;
                }

                if (token_text === 'case' || token_text === 'default') {
                    if (last_text === ':') {
                        // switch cases following one another
                        remove_indent();
                    } else {
                        // case statement starts in the same line where switch
                        unindent();
                        print_newline();
                        indent();
                    }
                    print_token();
                    in_case = true;
                    break;
                }


                prefix = 'NONE';
                if (last_type === 'TK_END_BLOCK') {
                    if (!in_array(token_text.toLowerCase(), ['else', 'catch', 'finally'])) {
                        prefix = 'NEWLINE';
                    } else {
                        prefix = 'SPACE';
                        print_space();
                    }
                } else if (last_type === 'TK_END_COMMAND' && (current_mode === 'BLOCK' || current_mode === 'DO_BLOCK')) {
                    prefix = 'NEWLINE';
                } else if (last_type === 'TK_END_COMMAND' && current_mode === 'EXPRESSION') {
                    prefix = 'SPACE';
                } else if (last_type === 'TK_WORD') {
                    prefix = 'SPACE';
                } else if (last_type === 'TK_START_BLOCK') {
                    prefix = 'NEWLINE';
                } else if (last_type === 'TK_END_EXPR') {
                    print_space();
                    prefix = 'NEWLINE';
                }

                if (last_type !== 'TK_END_BLOCK' && in_array(token_text.toLowerCase(), ['else', 'catch', 'finally'])) {
                    print_newline();
                } else if (in_array(token_text, line_starters) || prefix === 'NEWLINE') {
                    if (last_text === 'else') {
                        // no need to force newline on else break
                        print_space();
                    } else if ((last_type === 'TK_START_EXPR' || last_text === '=') && token_text === 'function') {
                        // no need to force newline on 'function': (function
                        // DONOTHING
                    } else if (last_type === 'TK_WORD' && (last_text === 'return' || last_text === 'throw')) {
                        // no newline between 'return nnn'
                        print_space();
                    } else if (last_type !== 'TK_END_EXPR') {
                        if ((last_type !== 'TK_START_EXPR' || token_text !== 'var') && last_text !== ':') {
                            // no need to force newline on 'var': for (var x = 0...)
                            if (token_text === 'if' && last_type === 'TK_WORD' && last_word === 'else') {
                                // no newline for } else if {
                                print_space();
                            } else {
                                print_newline();
                            }
                        }
                    } else {
                        if (in_array(token_text, line_starters) && last_text !== ')') {
                            print_newline();
                        }
                    }
                } else if (prefix === 'SPACE') {
                    print_space();
                }
                print_token();
                last_word = token_text;

                if (token_text === 'var') {
                    var_line = true;
                    var_line_tainted = false;
                }

                break;

            case 'TK_END_COMMAND':

                print_token();
                var_line = false;
                break;

            case 'TK_STRING':

                if (last_type === 'TK_START_BLOCK' || last_type === 'TK_END_BLOCK') {
                    print_newline();
                } else if (last_type === 'TK_WORD') {
                    print_space();
                }
                print_token();
                break;

            case 'TK_OPERATOR':

                var start_delim = true;
                var end_delim = true;
                if (var_line && token_text !== ',') {
                    var_line_tainted = true;
                    if (token_text === ':') {
                        var_line = false;
                    }
                }

                if (token_text === ':' && in_case) {
                    print_token(); // colon really asks for separate treatment
                    print_newline();
                    break;
                }

                in_case = false;

                if (token_text === ',') {
                    if (var_line) {
                        if (var_line_tainted) {
                            print_token();
                            print_newline();
                            var_line_tainted = false;
                        } else {
                            print_token();
                            print_space();
                        }
                    } else if (last_type === 'TK_END_BLOCK') {
                        print_token();
                        print_newline();
                    } else {
                        if (current_mode === 'BLOCK') {
                            print_token();
                            print_newline();
                        } else {
                            // EXPR od DO_BLOCK
                            print_token();
                            print_space();
                        }
                    }
                    break;
                } else if (token_text === '--' || token_text === '++') { // unary operators special case
                    if (last_text === ';') {
                        // space for (;; ++i)
                        start_delim = true;
                        end_delim = false;
                    } else {
                        start_delim = false;
                        end_delim = false;
                    }
                } else if (token_text === '!' && last_type === 'TK_START_EXPR') {
                    // special case handling: if (!a)
                    start_delim = false;
                    end_delim = false;
                } else if (last_type === 'TK_OPERATOR') {
                    start_delim = false;
                    end_delim = false;
                } else if (last_type === 'TK_END_EXPR') {
                    start_delim = true;
                    end_delim = true;
                } else if (token_text === '.') {
                    // decimal digits or object.property
                    start_delim = false;
                    end_delim = false;

                } else if (token_text === ':') {
                    // zz: xx
                    // can't differentiate ternary op, so for now it's a ? b: c; without space before colon
                    if (last_text.match(/^\d+$/)) {
                        // a little help for ternary a ? 1 : 0;
                        start_delim = true;
                    } else {
                        start_delim = false;
                    }
                }
                if (start_delim) {
                    print_space();
                }

                print_token();

                if (end_delim) {
                    print_space();
                }
                break;

            case 'TK_BLOCK_COMMENT':

                print_newline();
                print_token();
                print_newline();
                break;

            case 'TK_COMMENT':

                // print_newline();
                print_space();
                print_token();
                print_newline();
                break;

            case 'TK_UNKNOWN':
                print_token();
                break;
            }

            last_type = token_type;
            last_text = token_text;
        }

        return output.join('');

    }

    // 与原 jsformat/jsendecode.js 中 num/encode/decode 逻辑一致
    var a = 62;
    function num(c) {
        return (c < a ? '' : num(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36));
    }
    function encode() {
        var code = input.value;
        code = code.replace(/[\r\n]+/g, '');
        code = code.replace(/'/g, "\\'");
        var tmp = code.match(/\b(\w+)\b/g);
        if (!tmp) tmp = [];
        tmp.sort();
        var dict = [];
        var i, t = '';
        for (i = 0; i < tmp.length; i++) {
            if (tmp[i] != t) dict.push(t = tmp[i]);
        }
        var len = dict.length;
        var ch;
        for (i = 0; i < len; i++) {
            ch = num(i);
            code = code.replace(new RegExp('\\b' + dict[i] + '\\b', 'g'), ch);
            if (ch == dict[i]) dict[i] = '';
        }
        var rt = "eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\\\b'+e(c)+'\\\\b','g'),k[c]);return p}("
            + "'" + code + "'," + a + "," + len + ",'" + dict.join('|') + "'.split('|'),0,{}))";
        showResult(rt);
    }
    function decode() {
        var code = input.value;
        if (code != "" && code.indexOf('eval') > -1) {
            code = code.replace(/^eval/, '');
            showResult(js_beautify(eval(code), 4, " "));
        } else {
            showErr('找不到符合条件的加密内容，无法解密');
        }
    }

    /* JS 混合加密：CLASS_CONFUSION（由外部 jsendecode.js 提供） */
    document.getElementById('BtnCon').addEventListener('click', function () {
        hideErr();
        if (input.value === '') { showErr('请输入混淆加密内容'); return; }
        try {
            var xx = new CLASS_CONFUSION(input.value);
            showResult(xx.confusion());
        } catch (e) {
            showErr('混淆加密失败：' + e.message);
        }
    });

    document.getElementById('btnEncode').addEventListener('click', function () {
        hideErr();
        if (input.value != "") { encode(); } else { showErr('请输入加密内容'); }
    });
    document.getElementById('btnDecode').addEventListener('click', function () {
        hideErr();
        if (input.value != "") { decode(); } else { showErr('请输入解密内容'); }
    });
    document.getElementById('btnClear').addEventListener('click', function () {
        input.value = '';
        resultBox.classList.remove('show');
        hideErr();
        input.focus();
    });
    input.addEventListener('keydown', function (e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            hideErr();
            if (input.value != "") { encode(); } else { showErr('请输入加密内容'); }
        }
    });
})();
</script>
<script src="/static/script/sample-data.js" type="text/javascript"></script>
</body></html>
