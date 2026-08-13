# -*- coding: utf-8 -*-
"""生成 jsencrypt.html：JS加密/解密 + JS混合加密 二合一页"""
import re

# 提取 endecodejs 的完整 IIFE
src = open('application/index/view/index/endecodejs.html', encoding='utf-8').read()
jss = re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)
jsE = None
for js in jss:
    js = js.strip()
    if 'getElementById' in js and len(js) > 5000:
        jsE = js
        break
assert jsE, '未找到 endecodejs 内联 JS'

# ID 替换
for old, new in [("'content'", "'jsInput'"), ("'resultBox'", "'jsResultBox'"),
                 ("'resultText'", "'jsResultText'"), ("'err'", "'jsError'")]:
    jsE = jsE.replace(old, new)

# 验证替换
print('jsE IIFE: %d B, 替换后 getElementById 引用: %s' % (len(jsE), re.findall(r"getElementById\('([^']+)'\)", jsE)))

HEAD = u'''<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.jsencrypt.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.jsencrypt.keywords}" /><meta name="description" content="{$Think.config.web.jsencrypt.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">⚡</span>JS 加密混淆</h2>
        <p class="tool-desc">JS 加密/解密与 JS 代码混合加密（混淆）两种工具合集：Packer 式 JS 加密解密、变量名混淆混合加密，全程浏览器本地运算。</p>
        <ul class="t-tabs" id="jsTabs">
            <li><button type="button" class="t-tab active" data-panel="jsE">JS 加密/解密</button></li>
            <li><button type="button" class="t-tab" data-panel="jsC">JS 混合加密</button></li>
        </ul>

        <!-- JS 加密/解密 -->
        <div id="jsE" class="t-panel js-panel active">
            <label class="t-label" for="jsInput">请输入要加密、解密的 Js 代码</label>
            <textarea class="t-area" id="jsInput" rows="12" placeholder="请输入要加密、解密的Js代码"></textarea>
            <div class="tool-actions">
                <button class="t-btn t-btn-ok" type="button" id="btnEncode">JS 加密</button>
                <button class="t-btn" type="button" id="btnDecode">JS 解密</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#jsResultText">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="btnClear">清空</button>
            </div>
            <label class="t-label" for="jsResultText">加解密结果</label>
            <div class="t-result" id="jsResultBox">
                <div id="jsResultText"></div>
            </div>
            <div class="t-error" id="jsError"></div>
        </div>

        <!-- JS 混合加密 -->
        <div id="jsC" class="t-panel js-panel">
            <label class="t-label" for="content">请输入要混淆加密的 Js 代码</label>
            <textarea class="t-area" id="content" rows="12" placeholder="请输入要混淆加密的Js代码"></textarea>
            <div class="tool-actions">
                <button class="t-btn t-btn-ok" type="button" id="BtnCon">JS 代码混合加密</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#result">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="BtnClear">清空</button>
            </div>
            <label class="t-label" for="result">加密结果</label>
            <pre class="t-result" id="result" style="white-space:pre-wrap;word-break:break-all;display:block"></pre>
            <div class="t-error" id="cfError"></div>
        </div>
    </div>
</div></div>
{include file="nav" /}
{include file="footer" /}
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/toolbox.js" type="text/javascript"></script>
<script src="/static/script/jsformat/jsendecode.js" type="text/javascript"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script>
(function () {
    'use strict';
    var tabs = document.querySelectorAll('#jsTabs .t-tab');
    var panels = document.querySelectorAll('.js-panel');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            panels.forEach(function (p) { p.classList.remove('active'); });
            btn.classList.add('active');
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
        });
    });

    /* 混合加密：自写绑定 CLASS_CONFUSION（不依赖 hightout/pcjson_com_msg） */
    var cfError = document.getElementById('cfError');
    function cfShow(m) { cfError.textContent = m; cfError.classList.add('show'); }
    function cfHide() { cfError.classList.remove('show'); }
    document.getElementById('BtnCon').addEventListener('click', function () {
        cfHide();
        var code = document.getElementById('content').value;
        if (code === '') { cfShow('请输入混淆加密内容'); return; }
        try {
            var xx = new CLASS_CONFUSION(code);
            document.getElementById('result').textContent = xx.confusion();
        } catch (e) {
            cfShow('混淆加密失败：' + e.message);
        }
    });
    document.getElementById('BtnClear').addEventListener('click', function () {
        document.getElementById('content').value = '';
        document.getElementById('result').textContent = '';
        cfHide();
        document.getElementById('content').focus();
    });
})();
</script>
<script>
''' + jsE + u'''
</script>
</body></html>
'''

path = 'application/index/view/index/jsencrypt.html'
open(path, 'w', encoding='utf-8').write(HEAD)
print('已生成:', path, len(HEAD), '字节')
