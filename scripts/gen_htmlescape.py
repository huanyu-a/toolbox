# -*- coding: utf-8 -*-
"""生成 htmlescape.html：转义工具 + 特殊字符对照表"""
import re, os, html as htmlmod

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

src = open(BASE + r'\htmlescapechar.html', encoding='utf-8').read()
rows = re.findall(r'<tr[^>]*>(.*?)</tr>', src, re.S)
data = []  # (字符, 十进制实体, 命名实体)
for r in rows:
    cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
    cells = [re.sub(r'<[^>]+>', '', c).strip() for c in cells]
    if len(cells) < 6 or cells[0] == '字符':
        continue
    # 左半：字符、十进制、实体名；右半同
    for k in range(2):
        ch = cells[k * 3]
        dec = cells[k * 3 + 1]
        ent = cells[k * 3 + 2]
        if not ch or not dec:
            continue
        # 解一层实体：&amp;#34; -> &#34;（页面源码）
        dec = htmlmod.unescape(dec)
        ent = htmlmod.unescape(ent)
        data.append((ch, dec, ent))
print('rows extracted:', len(data))

# 去重
seen = set()
uniq = []
for d in data:
    if d not in seen:
        seen.add(d)
        uniq.append(d)
data = uniq
print('unique rows:', len(data))

def esc_td(s):
    return htmlmod.escape(s, quote=True)

table_rows = []
for ch, dec, ent in data:
    table_rows.append('<tr><td>%s</td><td>%s</td><td>%s</td></tr>' % (esc_td(ch), esc_td(dec), esc_td(ent)))
table_html = '<table class="table table-bordered table-striped" style="margin:0"><thead><tr><th>字符</th><th>十进制实体</th><th>命名实体</th></tr></thead><tbody>' + ''.join(table_rows) + '</tbody></table>'

html = '''<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.htmlescape.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.htmlescape.keywords}" /><meta name="description" content="{$Think.config.web.htmlescape.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">🏷️</span>HTML 转义 / 特殊字符</h2>
        <p class="tool-desc">将 HTML 代码转义为安全字符串或还原，防止 XSS 注入、方便代码展示，并附常用 HTML 特殊字符转义对照表。</p>
        <ul class="t-tabs" id="heTabs">
            <li><button type="button" class="t-tab active" data-panel="hePanel1">转义工具</button></li>
            <li><button type="button" class="t-tab" data-panel="hePanel2">特殊字符对照表</button></li>
        </ul>
        <div id="hePanel1" class="t-panel active">
            <label class="t-label" for="heInput">输入内容</label>
            <textarea class="t-area" id="heInput" rows="8" placeholder="<div class=\"box\">Hello &amp; Welcome</div>"></textarea>
            <div class="t-options" style="margin-top:10px">
                <label><input type="radio" name="heMode" value="encode" checked> 转义（→ 实体）</label>
                <label><input type="radio" name="heMode" value="decode"> 还原（实体 → 字符）</label>
            </div>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="heRun">转换</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#heOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="heClear">清空</button>
            </div>
            <div class="t-result" id="heResult"><textarea class="t-area t-area-readonly" id="heOutput" rows="8" readonly></textarea></div>
            <div class="t-error" id="heError"></div>
        </div>
        <div id="hePanel2" class="t-panel">
            <div style="overflow-x:auto">''' + table_html + '''</div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于 HTML 转义</h2>
        <p class="tool-desc">HTML 中 &lt;、&gt;、&amp;、引号等字符有特殊含义，在网页中展示代码时必须转义为实体（如 &lt; → &amp;lt;），否则会被浏览器解析为标签，造成样式错乱甚至 XSS 注入风险。</p>
    </div>
</div></div>
{include file="nav" /}
{include file="footer" /}
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/toolbox.js"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script>
(function () {
    var tabs = document.querySelectorAll('#heTabs .t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });
    var err = document.getElementById('heError');
    function escHtml(s) {
        return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }
    document.getElementById('heRun').addEventListener('click', function () {
        err.classList.remove('show');
        var raw = document.getElementById('heInput').value;
        if (!raw) { err.textContent = '请输入内容'; err.classList.add('show'); return; }
        var mode = document.querySelector('input[name="heMode"]:checked').value;
        var out;
        if (mode === 'encode') {
            out = escHtml(raw);
        } else {
            var ta = document.createElement('textarea');
            ta.innerHTML = raw;
            out = ta.value;
        }
        document.getElementById('heOutput').value = out;
        document.getElementById('heResult').classList.add('show');
    });
    document.getElementById('heClear').addEventListener('click', function () {
        document.getElementById('heInput').value = '';
        document.getElementById('heOutput').value = '';
        document.getElementById('heResult').classList.remove('show');
        err.classList.remove('show');
        document.getElementById('heInput').focus();
    });
})();
</script>
</body></html>'''

out = os.path.join(BASE, 'htmlescape.html')
open(out, 'w', encoding='utf-8').write(html)
print('written:', out, len(html))
