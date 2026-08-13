# -*- coding: utf-8 -*-
"""生成 textconvert.html：9 个文本转换工具合一页"""
import io

HEAD = u'''<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.textconvert.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.textconvert.keywords}" /><meta name="description" content="{$Think.config.web.textconvert.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">🔤</span>文本转换</h2>
        <p class="tool-desc">简繁转换、汉字拼音、火星文、文字竖排、文字翻转、文字特效、全角半角、英文大小写、人民币大写九种文本转换工具合集，全程浏览器本地运算。</p>
        <ul class="t-tabs" id="tcTabs">
            <li><button type="button" class="t-tab active" data-panel="tcJf">简繁转换</button></li>
            <li><button type="button" class="t-tab" data-panel="tcPy">汉字拼音</button></li>
            <li><button type="button" class="t-tab" data-panel="tcHx">火星文</button></li>
            <li><button type="button" class="t-tab" data-panel="tcSp">文字竖排</button></li>
            <li><button type="button" class="t-tab" data-panel="tcFlip">文字翻转</button></li>
            <li><button type="button" class="t-tab" data-panel="tcFx">文字特效</button></li>
            <li><button type="button" class="t-tab" data-panel="tcQb">全角半角</button></li>
            <li><button type="button" class="t-tab" data-panel="tcCase">英文大小写</button></li>
            <li><button type="button" class="t-tab" data-panel="tcRmb">人民币大写</button></li>
        </ul>

        <!-- 简繁转换 -->
        <div id="tcJf" class="t-panel tc-panel active">
            <label class="t-label" for="jfInput">输入文字</label>
            <textarea class="t-area" id="jfInput" rows="8" placeholder="请输入要转换的文字"></textarea>
            <div class="tool-actions">
                <button class="t-btn t-btn-ok" type="button" id="jfSimple">转为简体</button>
                <button class="t-btn" type="button" id="jfTrad">转为繁体</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#jfOut">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="jfClear">清空</button>
            </div>
            <label class="t-label" for="jfOut">转换结果</label>
            <textarea class="t-area t-area-readonly" id="jfOut" rows="8" readonly placeholder="结果将显示在这里…"></textarea>
            <div class="t-error" id="jfError"></div>
        </div>

        <!-- 汉字拼音 -->
        <div id="tcPy" class="t-panel tc-panel">
            <label class="t-label" for="pyContent">输入汉字</label>
            <textarea class="t-area" id="pyContent" rows="6" placeholder="请输入要转换的汉字"></textarea>
            <div class="t-options" style="margin-top:12px">
                <span style="font-weight:600">输出模式：</span>
                <select id="pyMode" style="padding:4px 8px;border:1px solid #d8d8d8;border-radius:6px;background:#fff">
                    <option value="5">对照（拼音在汉字上）</option>
                    <option value="4">对照（拼音在汉字下）</option>
                    <option value="3">对照（拼音在汉字前）</option>
                    <option value="2">对照（拼音在汉字后）</option>
                    <option value="1" selected>普通转换</option>
                </select>
                <label><input type="checkbox" id="pySym"> 保留标点符号</label>
                <label><input type="checkbox" id="pySym1" checked> 保留字母</label>
                <label><input type="checkbox" id="pySym2" checked> 空格隔开</label>
            </div>
            <div class="tool-actions" style="margin-top:12px">
                <button class="t-btn t-btn-ok" type="button" id="pyBtn">转换为拼音</button>
                <button class="t-btn" type="button" id="pySound">转换为读音</button>
                <button class="t-btn t-btn-ghost" type="button" id="pyClear">清空</button>
            </div>
            <label class="t-label" for="pyResult">转换结果</label>
            <div class="t-result" id="pyResultWrap">
                <button class="t-copy" type="button" data-copy="#pyResultText">复制</button>
                <div id="pyResultText"></div>
            </div>
            <div class="t-error" id="pyError"></div>
        </div>

        <!-- 火星文 -->
        <div id="tcHx" class="t-panel tc-panel">
            <label class="t-label" for="hxInput">输入文字</label>
            <textarea class="t-area" id="hxInput" rows="8" placeholder="请输入要转换的文字"></textarea>
            <div class="tool-actions">
                <button class="t-btn t-btn-ok" type="button" id="hxEncode">转换为火星文</button>
                <button class="t-btn" type="button" id="hxDecode">转换为简体字</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#hxOut">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="hxClear">清空</button>
            </div>
            <label class="t-label" for="hxOut">转换结果</label>
            <textarea class="t-area t-area-readonly" id="hxOut" rows="8" readonly placeholder="结果将显示在这里…"></textarea>
            <div class="t-error" id="hxError"></div>
        </div>

        <!-- 文字竖排 -->
        <div id="tcSp" class="t-panel tc-panel">
            <label class="t-label" for="srcText">输入要格式化的文本</label>
            <textarea class="t-area" id="srcText" rows="6" placeholder="请输入要格式化的文本"></textarea>
            <div class="t-options" style="margin-top:12px">
                分隔字符：<input type="text" id="iS" value="|" size="3" style="padding:4px 8px;border:1px solid #d8d8d8;border-radius:6px;background:#fff;text-align:center">
                页宽：<input type="text" id="iW" value="24" size="3" style="padding:4px 8px;border:1px solid #d8d8d8;border-radius:6px;background:#fff;text-align:center">
                页高：<input type="text" id="iH" value="19" size="3" style="padding:4px 8px;border:1px solid #d8d8d8;border-radius:6px;background:#fff;text-align:center">
                <label><input type="checkbox" onclick="cbig5();"> 转为繁体</label>
            </div>
            <div class="tool-actions" style="margin-top:12px">
                <button class="t-btn t-btn-ok" type="button" onclick="h();">格式化（竖向排列）</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#tarText">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" onclick="Empty();">清空</button>
            </div>
            <label class="t-label" for="tarText">输出排版结果</label>
            <textarea class="t-area t-area-readonly" id="tarText" rows="10" readonly placeholder="输出排版结果"></textarea>
            <div class="t-error" id="spError"></div>
        </div>

        <!-- 文字翻转 -->
        <div id="tcFlip" class="t-panel tc-panel">
            <label class="t-label" for="flipInput">输入文字</label>
            <textarea class="t-area" id="flipInput" rows="8" placeholder="请输入要翻转的内容"></textarea>
            <div class="tool-actions">
                <button class="t-btn t-btn-ok" type="button" id="flipBtn">翻转文字</button>
                <button class="t-btn t-btn-ghost" type="button" id="flipClear">清空</button>
            </div>
            <label class="t-label" for="flipOut">翻转结果</label>
            <div class="t-result" id="flipResult">
                <button class="t-copy" type="button" data-copy="#flipResultText">复制</button>
                <div id="flipResultText"></div>
            </div>
            <div class="t-error" id="flipError"></div>
        </div>

        <!-- 文字特效 -->
        <div id="tcFx" class="t-panel tc-panel">
            <label class="t-label" for="fxInput">输入要制作特效的汉字</label>
            <textarea class="t-area" id="fxInput" rows="6" placeholder="请输入要制作特效的汉字"></textarea>
            <div class="t-options" style="margin-top:12px">
                <span style="font-weight:600">区分方式：</span>
                <select id="fxMode" style="padding:4px 8px;border:1px solid #d8d8d8;border-radius:6px;background:#fff">
                    <option value="">区分字母</option>
                    <option value=" ">区分单词</option>
                </select>
            </div>
            <div class="tool-actions" style="margin-top:12px">
                <button class="t-btn t-btn-ok" type="button" id="fxBtn">生成特效</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#fxCode">复制代码</button>
                <button class="t-btn t-btn-ghost" type="button" id="fxClear">清空</button>
            </div>
            <div class="t-result" id="fxColor" style="min-height:44px;align-items:center;justify-content:center"></div>
            <label class="t-label" for="fxCode" style="margin-top:12px">特效 HTML 代码</label>
            <pre class="t-area t-area-readonly" id="fxCode" style="white-space:pre-wrap;word-break:break-all"></pre>
            <div class="t-error" id="fxError"></div>
        </div>

        <!-- 全角半角 -->
        <div id="tcQb" class="t-panel tc-panel">
            <label class="t-label" for="qbInput">输入文本</label>
            <textarea class="t-area" id="qbInput" rows="8" placeholder="请输入要转换的文本"></textarea>
            <div class="tool-actions">
                <button class="t-btn t-btn-ok" type="button" id="qbHalf">全角转半角</button>
                <button class="t-btn" type="button" id="qbFull">半角转全角</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#qbOut">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="qbClear">清空</button>
            </div>
            <label class="t-label" for="qbOut">转换结果</label>
            <pre class="t-result" id="qbOut"></pre>
            <div class="t-error" id="qbError"></div>
        </div>

        <!-- 英文大小写 -->
        <div id="tcCase" class="t-panel tc-panel">
            <label class="t-label" for="csInput">请输入要转换的英文文本</label>
            <textarea class="t-area" id="csInput" rows="6" placeholder="请输入要转换的英文文本，例如：hello world"></textarea>
            <div class="t-options" style="margin-top:14px">
                <label><input type="radio" name="csMode" value="upper" checked> 全部大写</label>
                <label><input type="radio" name="csMode" value="lower"> 全部小写</label>
                <label><input type="radio" name="csMode" value="sentence"> 句子首字母大写</label>
                <label><input type="radio" name="csMode" value="title"> 单词首字母大写</label>
            </div>
            <div class="tool-actions">
                <button class="t-btn t-btn-ok" type="button" id="csBtn">开始转换</button>
                <button class="t-btn t-btn-ghost" type="button" id="csClear">清空</button>
            </div>
            <label class="t-label" for="csOut">转换结果</label>
            <div class="t-result" id="csResult">
                <button class="t-copy" type="button" data-copy="#csResultText">复制</button>
                <div id="csResultText"></div>
            </div>
            <div class="t-error" id="csError"></div>
        </div>

        <!-- 人民币大写 -->
        <div id="tcRmb" class="t-panel tc-panel">
            <label class="t-label" for="rmbDigits">请输入小写金额</label>
            <input class="t-area" type="text" id="rmbDigits" placeholder="例如：123456.78" style="height:auto;padding:12px 14px">
            <div class="tool-actions">
                <button class="t-btn t-btn-ok" type="button" id="rmbBtn">转换为大写</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#rmbOut">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="rmbClear">清空</button>
            </div>
            <label class="t-label" for="rmbOut">大写金额</label>
            <textarea class="t-area t-area-readonly" id="rmbOut" rows="3" readonly placeholder="结果将显示在这里…"></textarea>
            <div class="t-error" id="rmbError"></div>
        </div>
    </div>
</div></div>
{include file="nav" /}
{include file="footer" /}
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/pcjs/jianfan.js" type="text/javascript"></script>
<script src="/static/script/pcjs/pinyin.js" type="text/javascript"></script>
<script src="/static/script/pcjs/shuformat.js" type="text/javascript"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script>
(function () {
    var tabs = document.querySelectorAll('#tcTabs .t-tab');
    var panels = document.querySelectorAll('.tc-panel');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            panels.forEach(function (p) { p.classList.remove('active'); });
            btn.classList.add('active');
            document.getElementById(btn.getAttribute('data-panel')).classList.add('active');
        });
    });
})();
(function () {
    function showErr(el, m) { el.textContent = m; el.classList.add('show'); }
    function hideErr(el) { el.classList.remove('show'); }

    /* 简繁转换：jianfan.js 纯函数 simplized/traditionalized */
    var jfInput = document.getElementById('jfInput'), jfOut = document.getElementById('jfOut'), jfError = document.getElementById('jfError');
    function jfRun(fn) {
        hideErr(jfError);
        var v = jfInput.value;
        if (!v) { showErr(jfError, '请输入要转换的文字'); return; }
        jfOut.value = fn(v);
    }
    document.getElementById('jfSimple').addEventListener('click', function () { jfRun(simplized); });
    document.getElementById('jfTrad').addEventListener('click', function () { jfRun(traditionalized); });
    document.getElementById('jfClear').addEventListener('click', function () { jfInput.value = ''; jfOut.value = ''; hideErr(jfError); jfInput.focus(); });

    /* 汉字拼音：pinyin.js 的 toPinyin + pydic（读音） */
    var pyContent = document.getElementById('pyContent'), pyResult = document.getElementById('pyResultText'), pyError = document.getElementById('pyError');
    document.getElementById('pyBtn').addEventListener('click', function () {
        hideErr(pyError);
        var v = pyContent.value;
        if (!v) { showErr(pyError, '请先输入要转换的内容'); return; }
        var dz = document.getElementById('pyMode').value;
        var sym = document.getElementById('pySym').checked;
        var sym1 = document.getElementById('pySym1').checked;
        var sym2 = document.getElementById('pySym2').checked;
        pyResult.innerHTML = toPinyin({ str: v, dz: dz, sym: sym, sym1: sym1, sym2: sym2 }) || '';
    });
    document.getElementById('pySound').addEventListener('click', function () {
        hideErr(pyError);
        var con = pyContent.value;
        if (!con) { showErr(pyError, '请先输入要转换的内容'); return; }
        var hidesel = document.getElementById('pyMode').value;
        var str = '', s;
        for (var i = 0; i < con.length; i++) {
            if (pydic.indexOf(con.charAt(i)) != -1 && con.charCodeAt(i) > 200) {
                str += '<em>';
                str += (parseInt(hidesel) == 1 || parseInt(hidesel) == 3 || parseInt(hidesel) == 5) ? '<i>' : con[i];
                str += (parseInt(hidesel) == 4) ? '<br><i>' : '';
                str += (parseInt(hidesel) == 2) ? '<i>' : '';
                s = 1;
                while (pydic.charAt(pydic.indexOf(con.charAt(i)) + s) != ',') {
                    str += pydic.charAt(pydic.indexOf(con.charAt(i)) + s);
                    s++;
                }
                str += (parseInt(hidesel) == 3) ? '</i>' + con[i] : '';
                str += (parseInt(hidesel) == 5) ? '</i><br>' + con[i] : '';
                str += (parseInt(hidesel) == 1 || parseInt(hidesel) == 2 || parseInt(hidesel) == 4) ? '</i>' : '';
                str += '</em> ';
            } else {
                var br = (parseInt(hidesel) == 4 || parseInt(hidesel) == 5) ? '<br>' : '';
                if (document.getElementById('pySym').checked) str += '<em>' + br + con.charAt(i) + '</em> ';
            }
        }
        pyResult.innerHTML = str;
    });
    document.getElementById('pyClear').addEventListener('click', function () { pyContent.value = ''; pyResult.innerHTML = ''; hideErr(pyError); pyContent.focus(); });

    /* 火星文：jianfan.js 的 qqlized/simplized */
    var hxInput = document.getElementById('hxInput'), hxOut = document.getElementById('hxOut'), hxError = document.getElementById('hxError');
    function hxRun(fn) {
        hideErr(hxError);
        var v = hxInput.value;
        if (!v) { showErr(hxError, '请输入要转换的文字'); return; }
        hxOut.value = fn(v);
    }
    document.getElementById('hxEncode').addEventListener('click', function () { hxRun(qqlized); });
    document.getElementById('hxDecode').addEventListener('click', function () { hxRun(simplized); });
    document.getElementById('hxClear').addEventListener('click', function () { hxInput.value = ''; hxOut.value = ''; hideErr(hxError); hxInput.focus(); });

    /* 文字翻转 */
    var flipInput = document.getElementById('flipInput'), flipResult = document.getElementById('flipResult'), flipResultText = document.getElementById('flipResultText'), flipError = document.getElementById('flipError');
    var flipTable = {
        a: '\u0250', b: 'q', c: '\u0254', d: 'p', e: '\u01DD', f: '\u025F', g: '\u0183', h: '\u0265', i: '\u0131',
        j: '\u027E', k: '\u029E', m: '\u026F', n: 'u', r: '\u0279', t: '\u0287', v: '\u028C', w: '\u028D', y: '\u028E',
        '.': '\u02D9', '[': ']', '(': ')', '{': '}', '?': '\u00BF', '!': '\u00A1', "'": ',', '<': '>', '_': '\u203E',
        '\u203F': '\u2040', '\u2045': '\u2046', '\u2234': '\u2235', '\\r': '\\n'
    };
    Object.keys(flipTable).forEach(function (k) { flipTable[flipTable[k]] = k; });
    document.getElementById('flipBtn').addEventListener('click', function () {
        hideErr(flipError);
        var v = flipInput.value;
        if (!v) { showErr(flipError, '请输入要翻转的内容'); return; }
        var chars = [];
        for (var i = v.length - 1; i >= 0; i--) { var c = v.charAt(i); chars.push(flipTable[c] || c); }
        flipResultText.textContent = chars.join('');
        flipResult.classList.add('show');
    });
    document.getElementById('flipClear').addEventListener('click', function () {
        flipInput.value = ''; flipResultText.textContent = ''; flipResult.classList.remove('show'); hideErr(flipError); flipInput.focus();
    });

    /* 文字特效 */
    var fxInput = document.getElementById('fxInput'), fxColor = document.getElementById('fxColor'), fxCode = document.getElementById('fxCode'), fxError = document.getElementById('fxError');
    document.getElementById('fxBtn').addEventListener('click', function () {
        hideErr(fxError);
        var words = fxInput.value;
        if (!words) { showErr(fxError, '请输入要制作特效的汉字'); return; }
        var sep = document.getElementById('fxMode').value;
        var arr = words.split(sep);
        var cs = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];
        var code = '';
        for (var t = 0; t < arr.length; t++) {
            if (arr[t] == ' ') { code += ' '; }
            if (arr[t] != ' ') {
                var c1 = Math.round(Math.random() * 15), c2 = Math.round(Math.random() * 15), c3 = Math.round(Math.random() * 15);
                var c4 = Math.round(Math.random() * 15), c5 = Math.round(Math.random() * 15), c6 = Math.round(Math.random() * 15);
                var size = 1 + Math.round(Math.random() * 6);
                code += '<font color="#' + cs[c1] + cs[c2] + cs[c3] + cs[c4] + cs[c5] + cs[c6] + '" size="' + size + '">' + arr[t] + '</font>';
            }
        }
        fxColor.innerHTML = code;
        fxCode.textContent = code;
    });
    document.getElementById('fxClear').addEventListener('click', function () {
        fxInput.value = ''; fxColor.innerHTML = ''; fxCode.textContent = ''; hideErr(fxError); fxInput.focus();
    });

    /* 全角半角 */
    var qbInput = document.getElementById('qbInput'), qbOut = document.getElementById('qbOut'), qbError = document.getElementById('qbError');
    function qbFull(s) {
        var tmp = '';
        for (var i = 0; i < s.length; i++) {
            var c = s.charCodeAt(i);
            if (c === 32) tmp += String.fromCharCode(12288);
            else if (c < 127) tmp += String.fromCharCode(c + 65248);
            else tmp += s.charAt(i);
        }
        return tmp;
    }
    function qbHalf(s) {
        var tmp = '';
        for (var i = 0; i < s.length; i++) {
            var c = s.charCodeAt(i);
            if (c > 65280 && c < 65375) tmp += String.fromCharCode(c - 65248);
            else if (c === 12288) tmp += ' ';
            else tmp += s.charAt(i);
        }
        return tmp;
    }
    function qbRun(fn) {
        hideErr(qbError);
        var v = qbInput.value;
        if (!v) { showErr(qbError, '请输入要转换的字符'); return; }
        qbOut.textContent = fn(v);
    }
    document.getElementById('qbHalf').addEventListener('click', function () { qbRun(qbHalf); });
    document.getElementById('qbFull').addEventListener('click', function () { qbRun(qbFull); });
    document.getElementById('qbClear').addEventListener('click', function () { qbInput.value = ''; qbOut.textContent = ''; hideErr(qbError); qbInput.focus(); });

    /* 英文大小写 */
    var csInput = document.getElementById('csInput'), csResult = document.getElementById('csResult'), csResultText = document.getElementById('csResultText'), csError = document.getElementById('csError');
    function csSentence(s) { return s.replace(/(^|[.!?。！？\\n])(\\s*)([a-z])/g, function (m, p1, p2, p3) { return p1 + p2 + p3.toUpperCase(); }); }
    function csTitle(s) { return s.replace(/(^|[^a-zA-Z])([a-z])/g, function (m, p1, p2) { return p1 + p2.toUpperCase(); }); }
    document.getElementById('csBtn').addEventListener('click', function () {
        hideErr(csError);
        var v = csInput.value;
        if (!v) { showErr(csError, '请输入要转换的英文文本'); return; }
        var mode = document.querySelector('input[name="csMode"]:checked');
        mode = mode ? mode.value : 'upper';
        var out = mode === 'upper' ? v.toUpperCase() : mode === 'lower' ? v.toLowerCase() : mode === 'sentence' ? csSentence(v) : csTitle(v);
        csResultText.textContent = out;
        csResult.classList.add('show');
    });
    document.getElementById('csClear').addEventListener('click', function () {
        csInput.value = ''; csResultText.textContent = ''; csResult.classList.remove('show'); hideErr(csError); csInput.focus();
    });

    /* 人民币大写 */
    var rmbDigits = document.getElementById('rmbDigits'), rmbOut = document.getElementById('rmbOut'), rmbError = document.getElementById('rmbError');
    function rmbConvert(currencyDigits) {
        var MAXIMUM_NUMBER = 99999999999.99;
        var CN_ZERO = '\u96f6', CN_ONE = '\u58f9', CN_TWO = '\u8d30', CN_THREE = '\u53c1', CN_FOUR = '\u8086';
        var CN_FIVE = '\u4f0d', CN_SIX = '\u9646', CN_SEVEN = '\u67d2', CN_EIGHT = '\u634c', CN_NINE = '\u7396';
        var CN_TEN = '\u62fe', CN_HUNDRED = '\u4f70', CN_THOUSAND = '\u4edf', CN_TEN_THOUSAND = '\u4e07', CN_HUNDRED_MILLION = '\u4ebf';
        var CN_DOLLAR = '\u5143', CN_TEN_CENT = '\u89d2', CN_CENT = '\u5206', CN_INTEGER = '\u6574';
        var integral, decimal, outputCharacters, parts;
        var digits, radices, bigRadices, decimals;
        var zeroCount, i, p, d, quotient, modulus;
        currencyDigits = currencyDigits.toString();
        if (currencyDigits == '') { showErr(rmbError, '\u8bf7\u8f93\u5165\u5c0f\u5199\u91d1\u989d\uff01'); return ''; }
        if (currencyDigits.match(/[^,.\d]/) != null) { showErr(rmbError, '\u5c0f\u5199\u91d1\u989d\u542b\u6709\u65e0\u6548\u5b57\u7b26\uff01'); return ''; }
        if (currencyDigits.match(/^((\d{1,3}(,\d{3})*(.((\d{3},)*\d{1,3}))?)|(\d+(.\d+)?))$/) == null) { showErr(rmbError, '\u5c0f\u5199\u91d1\u989d\u7684\u683c\u5f0f\u4e0d\u6b63\u786e\uff01'); return ''; }
        currencyDigits = currencyDigits.replace(/,/g, '');
        currencyDigits = currencyDigits.replace(/^0+/, '');
        if (Number(currencyDigits) > MAXIMUM_NUMBER) { showErr(rmbError, '\u91d1\u989d\u8fc7\u5927\uff0c\u5e94\u5c0f\u4e8e1000\u4ebf\u5143\uff01'); return ''; }
        parts = currencyDigits.split('.');
        if (parts.length > 1) { integral = parts[0]; decimal = parts[1].slice(0, 2); }
        else { integral = parts[0]; decimal = ''; }
        digits = [CN_ZERO, CN_ONE, CN_TWO, CN_THREE, CN_FOUR, CN_FIVE, CN_SIX, CN_SEVEN, CN_EIGHT, CN_NINE];
        radices = ['', CN_TEN, CN_HUNDRED, CN_THOUSAND];
        bigRadices = ['', CN_TEN_THOUSAND, CN_HUNDRED_MILLION];
        decimals = [CN_TEN_CENT, CN_CENT];
        outputCharacters = '';
        if (Number(integral) > 0) {
            zeroCount = 0;
            for (i = 0; i < integral.length; i++) {
                p = integral.length - i - 1;
                d = integral.charAt(i);
                quotient = p / 4;
                modulus = p % 4;
                if (d == '0') { zeroCount++; }
                else {
                    if (zeroCount > 0) { outputCharacters += digits[0]; }
                    zeroCount = 0;
                    outputCharacters += digits[Number(d)] + radices[modulus];
                }
                if (modulus == 0 && zeroCount < 4) {
                    outputCharacters += bigRadices[quotient];
                    zeroCount = 0;
                }
            }
            outputCharacters += CN_DOLLAR;
        }
        if (decimal != '') {
            for (i = 0; i < decimal.length; i++) {
                d = decimal.charAt(i);
                if (d != '0') { outputCharacters += digits[Number(d)] + decimals[i]; }
            }
        }
        if (outputCharacters == '') { outputCharacters = CN_ZERO + CN_DOLLAR; }
        if (decimal == '') { outputCharacters += CN_INTEGER; }
        return outputCharacters;
    }
    function rmbDo() {
        var r = rmbConvert(rmbDigits.value);
        rmbOut.value = r;
        if (r) hideErr(rmbError);
    }
    document.getElementById('rmbBtn').addEventListener('click', rmbDo);
    rmbDigits.addEventListener('keydown', function (e) { if (e.key === 'Enter') { e.preventDefault(); rmbDo(); } });
    document.getElementById('rmbClear').addEventListener('click', function () {
        rmbDigits.value = ''; rmbOut.value = ''; hideErr(rmbError); rmbDigits.focus();
    });
})();
</script>
</body></html>
'''

path = 'application/index/view/index/textconvert.html'
open(path, 'w', encoding='utf-8').write(HEAD)
print('已生成:', path, len(HEAD), '字节')
