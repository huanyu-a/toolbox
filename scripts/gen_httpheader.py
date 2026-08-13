# -*- coding: utf-8 -*-
"""生成 httpheader.html：请求头大全 + 请求方法大全"""
import re, os, html as htmlmod

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

def extract(name, skip_first=True):
    src = open(os.path.join(BASE, name + '.html'), encoding='utf-8').read()
    rows = re.findall(r'<tr[^>]*>(.*?)</tr>', src, re.S)
    out = []
    for r in rows:
        cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
        cells = [re.sub(r'<[^>]+>', '', c).strip() for c in cells]
        if len(cells) < 2:
            continue
        out.append(cells)
    return out

hdrs = extract('httpheader')
methods = extract('requestmethod')

def esc(s):
    return htmlmod.escape(s, quote=True)

hdr_rows = ''.join('<tr><td style="white-space:nowrap">%s</td><td>%s</td><td><code>%s</code></td></tr>' % (esc(r[0]), esc(r[1]), esc(r[2] if len(r) > 2 else '')) for r in hdrs[1:])
hdr_html = '<table class="table table-bordered table-striped" style="margin:0"><thead><tr><th>Header</th><th>解释</th><th>示例</th></tr></thead><tbody>' + hdr_rows + '</tbody></table>'

mtd_rows = ''.join('<tr><td>%s</td><td style="white-space:nowrap"><b>%s</b></td><td>%s</td></tr>' % (esc(r[0]), esc(r[1]), esc(r[2] if len(r) > 2 else '')) for r in methods[1:])
mtd_html = '<table class="table table-bordered table-striped" style="margin:0"><thead><tr><th>序号</th><th>方法</th><th>描述</th></tr></thead><tbody>' + mtd_rows + '</tbody></table>'

html = '''<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.httpheader.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.httpheader.keywords}" /><meta name="description" content="{$Think.config.web.httpheader.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">📮</span>HTTP 请求头 / 请求方法大全</h2>
        <p class="tool-desc">常用 HTTP 请求头字段解释与示例、HTTP 请求方法对照表，帮助理解与调试网络请求。</p>
        <ul class="t-tabs" id="hhTabs">
            <li><button type="button" class="t-tab active" data-panel="hhPanel1">请求头大全</button></li>
            <li><button type="button" class="t-tab" data-panel="hhPanel2">请求方法大全</button></li>
        </ul>
        <div id="hhPanel1" class="t-panel active">
            <div style="overflow-x:auto">''' + hdr_html + '''</div>
        </div>
        <div id="hhPanel2" class="t-panel">
            <div style="overflow-x:auto">''' + mtd_html + '''</div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于 HTTP 请求头</h2>
        <p class="tool-desc">HTTP 请求头（Request Headers）由客户端发送给服务器，用于告知服务器客户端能力与请求偏好；请求方法（Method）定义了对资源的操作语义。调试接口时合理设置请求头可解决跨域、编码、缓存等常见问题。</p>
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
    var tabs = document.querySelectorAll('#hhTabs .t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });
})();
</script>
</body></html>'''

out = os.path.join(BASE, 'httpheader.html')
open(out, 'w', encoding='utf-8').write(html)
print('written:', out, len(html))
