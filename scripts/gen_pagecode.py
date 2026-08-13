# -*- coding: utf-8 -*-
"""生成 pagecode.html：状态码对照表 + webstatus 查询"""
import re, os, html as htmlmod

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

src = open(os.path.join(BASE, 'pagecode.html'), encoding='utf-8').read()
rows = re.findall(r'<tr[^>]*>(.*?)</tr>', src, re.S)
data = []
for r in rows:
    cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
    cells = [re.sub(r'<[^>]+>', '', c).strip() for c in cells]
    if len(cells) >= 2 and cells[0].isdigit():
        data.append((int(cells[0]), cells[1]))
print('status rows:', len(data))

def esc(s):
    return htmlmod.escape(s, quote=True)

# 按状态码分类分组显示
groups = {'1xx': [], '2xx': [], '3xx': [], '4xx': [], '5xx': []}
for code, desc in data:
    g = str(code)[0] + 'xx'
    if g in groups:
        groups[g].append((code, desc))

def table_for(items):
    rows_html = ''.join('<tr><td style="white-space:nowrap;font-weight:600">%d</td><td>%s</td></tr>' % (c, esc(d)) for c, d in items)
    return '<table class="table table-bordered table-striped" style="margin:0 0 16px"><thead><tr><th style="width:110px">HTTP 状态码</th><th>含义</th></tr></thead><tbody>' + rows_html + '</tbody></table>'

panels = []
for gname, label in [('1xx', '1xx 信息响应'), ('2xx', '2xx 成功'), ('3xx', '3xx 重定向'), ('4xx', '4xx 客户端错误'), ('5xx', '5xx 服务器错误')]:
    if groups[gname]:
        panels.append('<h3 class="t-label" style="margin-top:18px">%s</h3>' % label + table_for(groups[gname]))

html = '''<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.pagecode.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.pagecode.keywords}" /><meta name="description" content="{$Think.config.web.pagecode.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">📟</span>HTTP 状态码 / 网页状态查询</h2>
        <p class="tool-desc">HTTP 状态码对照表（1xx~5xx），并支持输入网址实时查询服务器返回的状态码、IP 与响应头信息。</p>
        <ul class="t-tabs" id="pcTabs">
            <li><button type="button" class="t-tab active" data-panel="pcPanel1">状态码对照表</button></li>
            <li><button type="button" class="t-tab" data-panel="pcPanel2">网页状态查询</button></li>
        </ul>
        <div id="pcPanel1" class="t-panel active">
            <div style="overflow-x:auto">''' + ''.join(panels) + '''</div>
        </div>
        <div id="pcPanel2" class="t-panel">
            <form id="form1" method="post">
                <div class="t-row" style="margin-bottom:12px">
                    <div class="t-col" style="flex:1">
                        <input class="t-input" style="width:100%" type="text" name="url" id="url" value="{$url}" placeholder="输入网址，如：http://example.com">
                    </div>
                    <div class="t-col" style="flex:0 0 auto">
                        <button class="t-btn" type="submit" id="get_remote">查询 HTTP 状态</button>
                    </div>
                </div>
            </form>
            {if $ip}
            <div class="t-result show">
                <p class="t-result-label">页面 <b style="color:var(--brand)">{$url}</b> 检测结果</p>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr><td style="width:150px">服务器 IP</td><td><a href="/ip/{$ip}.html" target="_blank">{$ip}</a></td></tr>
                        <tr><td style="width:150px">返回状态码</td><td>{$code}</td></tr>
                        <tr><td style="width:150px">网页返回 HEAD 信息</td><td style="word-break:break-all">{:$head}</td></tr>
                    </tbody>
                </table>
            </div>
            {/if}
            <div class="t-error" id="pcErr"></div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于 HTTP 状态码</h2>
        <p class="tool-desc">HTTP 状态码由三位数字组成：1xx 为信息响应，2xx 表示成功，3xx 表示重定向，4xx 表示客户端错误，5xx 表示服务器错误。常见如 200 成功、301 永久跳转、404 页面不存在、500 服务器内部错误。</p>
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
    var tabs = document.querySelectorAll('#pcTabs .t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });
    var err = document.getElementById('pcErr');
    document.getElementById('form1').addEventListener('submit', function () {
        var u = document.getElementById('url').value.trim();
        if (!u) { err.textContent = '请输入网址'; err.classList.add('show'); return false; }
        return true;
    });
})();
</script>
</body></html>'''

out = os.path.join(BASE, 'pagecode.html')
open(out, 'w', encoding='utf-8').write(html)
print('written:', out, len(html))
