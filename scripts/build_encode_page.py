# -*- coding: utf-8 -*-
"""生成 /encode/ 合并页：9 个编码工具合 1"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

def inline_js(slug):
    src = open(os.path.join(BASE, slug + ".html"), encoding="utf-8").read()
    blocks = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    return blocks[-1].strip() if blocks else ""

def extract_ascii_panel2():
    src = open(os.path.join(BASE, "ascii.html"), encoding="utf-8").read()
    m = re.search(r'<div id="ascPanel2" class="t-panel">(.*?)</div>\s*</div>', src, re.S)
    return m.group(1).strip() if m else ""

js_b64 = inline_js("base64")
js_url = inline_js("urlcode")
js_esc = inline_js("escape")
js_uni = inline_js("unicode")
js_utf = inline_js("utf8")
js_thunder = inline_js("urlthunder")
asc_panel2 = extract_ascii_panel2()

# ascii JS 改造：tab 切换限定作用域到 ascPanelWrap
js_asc_raw = inline_js("ascii")
js_asc = js_asc_raw.replace(
    "document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });",
    "document.getElementById('ascPanelWrap').querySelectorAll('.t-panel').forEach(function (p) { p.classList.remove('active'); });"
)

# 摩尔斯 JS（自写，不依赖 morseen.js / pcjson_com_msg）
js_morse = r"""(function () {
    var input = document.getElementById('mcInput');
    var result = document.getElementById('mcResult');
    var error = document.getElementById('mcError');
    function showErr(m) { error.textContent = m; error.classList.add('show'); }
    function hideErr() { error.classList.remove('show'); }
    function decToHex(str) { var res = []; for (var i = 0; i < str.length; i++) res[i] = ('00' + str.charCodeAt(i).toString(16)).slice(-4); return '\\u' + res.join('\\u'); }
    function hexToDec(str) { str = str.replace(/\\/g, '%'); return unescape(str); }
    var ss = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_@';
    function v10toX(n, m) { m = String(m).replace(/ /gi, ''); if (m == '') return ''; if (parseInt(m) != m) return false; var t = '', a = ss.substr(0, n); while (m != 0) { var b = m % n; t = a.charAt(b) + t; m = (m - b) / n; } return t; }
    function vXto10(n, m) { m = String(m).replace(/ /gi, ''); if (m == '') return ''; var a = ss.substr(0, n); if (m.replace(new RegExp('[' + a + ']', 'gi'), '') != '') return false; var t = 0, c = 1; for (var x = m.length - 1; x > -1; x--) { t += c * (a.indexOf(m.charAt(x))); c *= n; } return t; }
    function vXtoY(n, m, y) { var a = vXto10(n * 1, m); if (a == '' || a === false) return false; a = v10toX(y, a); return a; }
    morjs.modes.custom = { charSpacer: '', letterSpacer: ' ', longString: '-', shortString: '.', wordSpacer: ' ' };
    var options = { mode: 'custom' };
    var morse_char_re = /[a-zA-Z0-9.:,;?='\/!_\"()$&@]/;
    function encode() {
        hideErr();
        var v = input.value;
        if (!v.trim()) { showErr('请输入要加密的字符串'); return; }
        var matchs = v.match(/[\u0000-\uffff]/g);
        var out = '';
        if (matchs != null) {
            for (var i = 0; i < matchs.length; i++) {
                var match = matchs[i];
                if (match.trim() != '') {
                    if (morse_char_re.test(match)) {
                        out = out + morjs.encode(match, options) + morjs.modes.custom.letterSpacer;
                    } else {
                        var unicode = decToHex(match);
                        if (unicode && unicode.substring(0, 2) == '\\u') {
                            unicode = unicode.substring(2);
                            var hx = vXtoY(16, unicode, 2);
                            if (hx === false) { showErr('编码失败：无法转换该字符'); return; }
                            hx = hx.replace(/1/g, morjs.modes.custom.longString);
                            hx = hx.replace(/0/g, morjs.modes.custom.shortString);
                            out = out + hx + morjs.modes.custom.letterSpacer;
                        }
                    }
                }
            }
        }
        if (out.length > 0 && out.substring(out.length - 1) === morjs.modes.custom.letterSpacer) {
            out = out.substring(0, out.length - 1);
        }
        result.textContent = out;
    }
    function decode() {
        hideErr();
        var v = input.value;
        if (!v.trim()) { showErr('请输入要解密的摩尔斯码'); return; }
        var out = '';
        var arr = v.split(morjs.modes.custom.letterSpacer);
        var re_1 = new RegExp('\\' + morjs.modes.custom.longString, 'g');
        var re_0 = new RegExp('\\' + morjs.modes.custom.shortString, 'g');
        for (var i = 0; i < arr.length; i++) {
            var item = arr[i];
            if (item != null && item.length >= 1) {
                if (item.length <= 5) {
                    out = out + morjs.decode(item, options) + ' ';
                } else {
                    item = item.replace(re_1, '1');
                    item = item.replace(re_0, '0');
                    var hx = vXtoY(2, item, 16);
                    if (hx === false || hx === '') {
                        out = '输入的摩尔斯码不符合要求！';
                    } else {
                        out = out + hexToDec('\\u' + hx) + ' ';
                    }
                }
            }
        }
        result.textContent = out;
    }
    document.getElementById('mcEncode').addEventListener('click', encode);
    document.getElementById('mcDecode').addEventListener('click', decode);
    document.getElementById('mcClear').addEventListener('click', function () { input.value = ''; result.textContent = ''; hideErr(); input.focus(); });
    input.addEventListener('keydown', function (e) { if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') encode(); });
})();"""

# 图片 Base64 JS（重写，原生 FileReader，无全局依赖）
js_img = r"""(function () {
    var fileInput = document.getElementById('miFile');
    var result = document.getElementById('miResult');
    var imgArea = document.getElementById('miImgArea');
    var error = document.getElementById('miError');
    var fileName = document.getElementById('miFileName');
    function showErr(m) { error.textContent = m; error.classList.add('show'); }
    function hideErr() { error.classList.remove('show'); }
    fileInput.addEventListener('change', function () {
        hideErr();
        var f = this.files[0];
        if (!f) return;
        if (!/image\/\w+/.test(f.type)) { showErr('请确保文件为图片类型'); return; }
        fileName.textContent = f.name;
        var reader = new FileReader();
        reader.onload = function (e) {
            result.value = e.target.result;
            imgArea.innerHTML = '<img src="' + e.target.result + '" alt="图片Base64编码" style="margin:auto;max-width:99%;max-height:1000px;"/>';
        };
        reader.readAsDataURL(f);
    });
    function toImg(tagOnly) {
        hideErr();
        var v = result.value.trim();
        if (!v) { showErr('请输入 Base64 编码'); return; }
        if (v.indexOf('base64') < 0) { showErr('请输入正确的 Base64 图片编码（包含 data:image/...;base64,）'); return; }
        if (v.indexOf('<img') < 0) {
            result.value = '<img src="' + v + '" alt="图片Base64编码" style="margin:auto;max-width:99%;max-height:1000px;" />';
        }
        imgArea.innerHTML = result.value;
    }
    document.getElementById('miToImg').addEventListener('click', function () { toImg(false); });
    document.getElementById('miImgTag').addEventListener('click', function () { toImg(true); });
    document.getElementById('miClear').addEventListener('click', function () {
        result.value = ''; imgArea.innerHTML = ''; fileName.textContent = ''; fileInput.value = '';
        hideErr(); result.focus();
    });
})();"""

# 外层 tab JS
js_tabs = r"""(function () {
    var tabs = document.querySelectorAll('#encTabs .t-tab');
    var panels = document.querySelectorAll('.enc-panel');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            panels.forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });
})();"""

HTML = """<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.encode.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.encode.keywords}" /><meta name="description" content="{$Think.config.web.encode.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">🔡</span>编码转换</h2>
        <p class="tool-desc">Base64、URL、Escape、Unicode、UTF-8、ASCII、摩尔斯电码、迅雷/旋风链接、图片转 Base64 九种编码转换工具合集，全程浏览器本地运算。</p>
        <ul class="t-tabs" id="encTabs">
            <li><button type="button" class="t-tab active" data-panel="encB64">Base64</button></li>
            <li><button type="button" class="t-tab" data-panel="encUrl">URL</button></li>
            <li><button type="button" class="t-tab" data-panel="encEsc">Escape</button></li>
            <li><button type="button" class="t-tab" data-panel="encUni">Unicode</button></li>
            <li><button type="button" class="t-tab" data-panel="encUtf">UTF-8</button></li>
            <li><button type="button" class="t-tab" data-panel="encAsc">ASCII</button></li>
            <li><button type="button" class="t-tab" data-panel="encMorse">摩尔斯</button></li>
            <li><button type="button" class="t-tab" data-panel="encThunder">迅雷/旋风</button></li>
            <li><button type="button" class="t-tab" data-panel="encImg">图片Base64</button></li>
        </ul>

        <!-- Base64 -->
        <div id="encB64" class="t-panel enc-panel active">
            <div class="t-grid">
                <div class="t-col">
                    <label class="t-label" for="b64Input">明文 / 密文</label>
                    <textarea class="t-area" id="b64Input" rows="8" placeholder="输入要编码或解码的内容…"></textarea>
                </div>
                <div class="t-col">
                    <label class="t-label" for="b64Output">结果</label>
                    <textarea class="t-area t-area-readonly" id="b64Output" rows="8" readonly placeholder="结果将显示在这里…"></textarea>
                </div>
            </div>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="b64Encode">编码 →</button>
                <button class="t-btn t-btn-ok" type="button" id="b64Decode">解码 ←</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#b64Output">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="b64Swap">⇄ 交换</button>
                <button class="t-btn t-btn-ghost" type="button" id="b64Clear">清空</button>
            </div>
            <div class="t-error" id="b64Error"></div>
        </div>

        <!-- URL -->
        <div id="encUrl" class="t-panel enc-panel">
            <div class="t-grid">
                <div class="t-col">
                    <label class="t-label" for="urlInput">原始内容</label>
                    <textarea class="t-area" id="urlInput" rows="7" placeholder="输入要编码或解码的内容…"></textarea>
                </div>
                <div class="t-col">
                    <label class="t-label" for="urlOutput">结果</label>
                    <textarea class="t-area t-area-readonly" id="urlOutput" rows="7" readonly placeholder="结果将显示在这里…"></textarea>
                </div>
            </div>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="urlEncode">编码 →</button>
                <button class="t-btn t-btn-ok" type="button" id="urlDecode">解码 ←</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#urlOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="urlClear">清空</button>
            </div>
            <div class="t-error" id="urlError"></div>
        </div>

        <!-- Escape -->
        <div id="encEsc" class="t-panel enc-panel">
            <label class="t-label" for="escInput">请输入要转换的字符串</label>
            <textarea class="t-area" id="escInput" rows="8" spellcheck="false" placeholder="请输入要Escape加密、解密的字符串"></textarea>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="escEncode">Escape 加密</button>
                <button class="t-btn t-btn-ok" type="button" id="escDecode">Escape 解密</button>
                <button class="t-btn t-btn-ghost" type="button" id="escDemo">示例</button>
                <button class="t-btn t-btn-ghost" type="button" id="escClear">清空</button>
            </div>
            <div class="t-result" id="escResult">
                <button class="t-copy" type="button" data-copy="#escResultText">复制</button>
                <div id="escResultText"></div>
            </div>
            <div class="t-error" id="escError" role="alert"></div>
        </div>

        <!-- Unicode -->
        <div id="encUni" class="t-panel enc-panel">
            <div class="t-grid">
                <div class="t-col">
                    <label class="t-label" for="ucInput">原文</label>
                    <textarea class="t-area" id="ucInput" rows="8" placeholder="请输入要转换的文本…"></textarea>
                </div>
                <div class="t-col">
                    <label class="t-label" for="ucOutput">结果</label>
                    <textarea class="t-area t-area-readonly" id="ucOutput" rows="8" readonly placeholder="结果将显示在这里…"></textarea>
                </div>
            </div>
            <div class="t-options" style="margin-top:12px">
                <span style="font-weight:600">转换格式：</span>
                <label><input type="radio" name="ucMode" value="u" checked> \\uXXXX</label>
                <label><input type="radio" name="ucMode" value="xh"> &#xXXXX;（十六进制）</label>
                <label><input type="radio" name="ucMode" value="d"> &#XXXX;（十进制）</label>
            </div>
            <div class="tool-actions" style="margin-top:12px">
                <button class="t-btn" type="button" id="ucToCode">中文 → 编码</button>
                <button class="t-btn t-btn-ok" type="button" id="ucToText">编码 → 中文</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#ucOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="ucSwap">⇄ 交换</button>
                <button class="t-btn t-btn-ghost" type="button" id="ucDemo">示例</button>
                <button class="t-btn t-btn-ghost" type="button" id="ucClear">清空</button>
            </div>
            <div class="t-error" id="ucError"></div>
        </div>

        <!-- UTF-8 -->
        <div id="encUtf" class="t-panel enc-panel">
            <div class="t-grid">
                <div class="t-col">
                    <label class="t-label" for="utfInput">原文（中文 / 字符串）</label>
                    <textarea class="t-area" id="utfInput" rows="8" placeholder="请输入要转换的字符，例如：中文"></textarea>
                    <div class="tool-actions">
                        <button class="t-btn" type="button" id="utfToCode">中文转 UTF-8 →</button>
                    </div>
                </div>
                <div class="t-col">
                    <label class="t-label" for="utfOutput">UTF-8 编码（十六进制字节）</label>
                    <textarea class="t-area" id="utfOutput" rows="8" placeholder="例如：E4 B8 AD 或 %E4%B8%AD"></textarea>
                    <div class="tool-actions">
                        <button class="t-btn t-btn-ok" type="button" id="utfToText">UTF-8 转中文 ←</button>
                    </div>
                </div>
            </div>
            <div class="t-options" style="margin-top:16px">
                <label><input type="radio" name="utfFmt" value="hex" checked> 十六进制（E4 B8 AD）</label>
                <label><input type="radio" name="utfFmt" value="pct"> URL 编码（%E4%B8%AD）</label>
                <label><input type="radio" name="utfFmt" value="esc"> \\x 转义（\\xE4\\xB8\\xAD）</label>
            </div>
            <div class="tool-actions">
                <button class="t-btn t-btn-ghost" type="button" data-copy="#utfOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="utfSwap">⇄ 交换</button>
                <button class="t-btn t-btn-ghost" type="button" id="utfClear">清空</button>
            </div>
            <div class="t-error" id="utfError"></div>
        </div>

        <!-- ASCII -->
        <div id="encAsc" class="t-panel enc-panel">
            <ul class="t-tabs" id="ascTabs">
                <li><button type="button" class="t-tab active" data-panel="ascPanel1">ASCII 转换</button></li>
                <li><button type="button" class="t-tab" data-panel="ascPanel2">ASCII 对照表</button></li>
            </ul>
            <div id="ascPanelWrap">
                <div id="ascPanel1" class="t-panel active">
                    <label class="t-label" for="ascInput">输入文本</label>
                    <textarea class="t-area" id="ascInput" rows="6" placeholder="输入要转换的字符或文本"></textarea>
                    <div class="t-options" style="margin-top:10px">
                        <label><input type="radio" name="ascMode" value="dec" checked> 转十进制</label>
                        <label><input type="radio" name="ascMode" value="hex"> 转十六进制</label>
                        <label><input type="radio" name="ascMode" value="revert"> 编码还原</label>
                        <label><input type="checkbox" id="ascSpace"> 编码间加空格</label>
                    </div>
                    <div class="tool-actions">
                        <button class="t-btn" type="button" id="ascRun">转换</button>
                        <button class="t-btn t-btn-ghost" type="button" data-copy="#ascOutput">复制结果</button>
                        <button class="t-btn t-btn-ghost" type="button" id="ascClear">清空</button>
                    </div>
                    <div class="t-result" id="ascResult"><textarea class="t-area t-area-readonly" id="ascOutput" rows="6" readonly></textarea></div>
                    <div class="t-error" id="ascError"></div>
                </div>
                <div id="ascPanel2" class="t-panel">
                    __ASC_PANEL2__
                </div>
            </div>
        </div>

        <!-- 摩尔斯 -->
        <div id="encMorse" class="t-panel enc-panel">
            <label class="t-label" for="mcInput">输入内容</label>
            <textarea class="t-area" id="mcInput" rows="6" placeholder="请输入要加密、解密的内容，例如：今天见"></textarea>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="mcEncode">摩尔斯加密</button>
                <button class="t-btn t-btn-ok" type="button" id="mcDecode">摩尔斯解密</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#mcResult">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="mcClear">清空</button>
            </div>
            <div class="t-result" id="mcResultBox"><pre class="t-pre" id="mcResult" style="white-space:pre-wrap;word-break:break-all;margin:0"></pre></div>
            <div class="t-error" id="mcError"></div>
        </div>

        <!-- 迅雷/旋风 -->
        <div id="encThunder" class="t-panel enc-panel">
            <label class="t-label" for="thunderInput">下载地址</label>
            <div class="t-row">
                <input class="t-input t-flex1" id="thunderInput" type="text" spellcheck="false" autocomplete="off" autocapitalize="off" placeholder="请输入地址，例如：http://zxgj.16400.cn" />
            </div>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="thunderEncrypt">加密 URL</button>
                <button class="t-btn t-btn-ok" type="button" id="thunderDecrypt">解密 URL</button>
                <button class="t-btn t-btn-ghost" type="button" id="thunderDemo">示例</button>
                <button class="t-btn t-btn-ghost" type="button" id="thunderClear">清空</button>
            </div>
            <div class="t-result" id="thunderSrcBox">
                <button class="t-copy" type="button" data-copy="#thunderSrcText">复制</button>
                <div id="thunderSrcText"></div>
            </div>
            <div id="thunderEncWrap" style="display:none;margin-top:14px">
                <div class="t-row" style="margin-bottom:10px">
                    <span class="t-result-label">迅雷</span>
                    <input class="t-input t-flex1" id="thunderXun" type="text" readonly value="" />
                    <button class="t-btn t-btn-sm" type="button" data-copy="#thunderXun">复制</button>
                </div>
                <div class="t-row" style="margin-bottom:10px">
                    <span class="t-result-label">快车</span>
                    <input class="t-input t-flex1" id="thunderKuai" type="text" readonly value="" />
                    <button class="t-btn t-btn-sm" type="button" data-copy="#thunderKuai">复制</button>
                </div>
                <div class="t-row">
                    <span class="t-result-label">旋风</span>
                    <input class="t-input t-flex1" id="thunderXuan" type="text" readonly value="" />
                    <button class="t-btn t-btn-sm" type="button" data-copy="#thunderXuan">复制</button>
                </div>
            </div>
            <div class="t-error" id="thunderError" role="alert"></div>
        </div>

        <!-- 图片 Base64 -->
        <div id="encImg" class="t-panel enc-panel">
            <div class="t-options" style="margin-bottom:12px">
                <span style="font-weight:600">选择图片：</span>
                <input type="file" accept="image/*" id="miFile" style="display:inline-block" />
                <span id="miFileName" style="margin-left:8px;color:var(--text-2);font-size:13px"></span>
            </div>
            <label class="t-label" for="miResult">Base64 编码</label>
            <textarea class="t-area" id="miResult" rows="8" placeholder="点击选择图片后自动生成 Base64 编码；也可在此粘贴 Base64 编码（含 data:image/...;base64,）后点击还原图片"></textarea>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="miToImg">Base64 转图片</button>
                <button class="t-btn t-btn-ghost" type="button" id="miImgTag">追加 img 标签</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#miResult">复制</button>
                <button class="t-btn t-btn-ghost" type="button" id="miClear">清空</button>
            </div>
            <div id="miImgArea" style="margin-top:10px"></div>
            <div class="t-error" id="miError"></div>
        </div>
    </div>
</div></div>
{include file="nav" /}
{include file="footer" /}
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/toolbox.js"></script>
<script src="/static/script/pcjs/morsejs.js" type="text/javascript"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script>
__JS_TABS__
</script>
<script>
__JS_B64__
</script>
<script>
__JS_URL__
</script>
<script>
__JS_ESC__
</script>
<script>
__JS_UNI__
</script>
<script>
__JS_UTF__
</script>
<script>
__JS_ASC__
</script>
<script>
__JS_MORSE__
</script>
<script>
__JS_THUNDER__
</script>
<script>
__JS_IMG__
</script>
</body></html>"""

HTML = HTML.replace("__ASC_PANEL2__", asc_panel2)
HTML = HTML.replace("__JS_TABS__", js_tabs)
HTML = HTML.replace("__JS_B64__", js_b64)
HTML = HTML.replace("__JS_URL__", js_url)
HTML = HTML.replace("__JS_ESC__", js_esc)
HTML = HTML.replace("__JS_UNI__", js_uni)
HTML = HTML.replace("__JS_UTF__", js_utf)
HTML = HTML.replace("__JS_ASC__", js_asc)
HTML = HTML.replace("__JS_MORSE__", js_morse)
HTML = HTML.replace("__JS_THUNDER__", js_thunder)
HTML = HTML.replace("__JS_IMG__", js_img)

out = os.path.join(BASE, "encode.html")
open(out, "w", encoding="utf-8", newline="\n").write(HTML)
print("已生成:", out, len(HTML), "字节")
