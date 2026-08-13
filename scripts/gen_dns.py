# -*- coding: utf-8 -*-
"""生成 dns.html：8 个 DNS 表格合一页（tab 结构）"""
import os, re

BASE = os.path.join(os.path.dirname(__file__), "..", "application", "index", "view", "index")
OUT = os.path.join(BASE, "dns.html")

# (文件名, tab名, 图标)
CATS = [
    ("dns", "公共DNS", "🌐"),
    ("alldns", "各地区", "🗺️"),
    ("dnsdx", "电信DNS", "📡"),
    ("dnslt", "联通DNS", "📡"),
    ("dnsyd", "移动DNS", "📡"),
    ("dnstt", "铁通DNS", "📡"),
    ("dnsedu", "教育网", "🎓"),
    ("dnsusa", "美国DNS", "🇺🇸"),
]

def extract_table(fname):
    src = open(os.path.join(BASE, fname + ".html"), encoding="utf-8").read()
    m = re.search(r'(<table.*?</table>)', src, re.S)
    if not m:
        return "<p>（无数据）</p>"
    return m.group(1)

tabs_html = []
panels_html = []
for i, (fname, name, ico) in enumerate(CATS):
    active = " active" if i == 0 else ""
    tabs_html.append('<li><button type="button" class="t-tab%s" data-panel="panel-%s">%s %s</button></li>' % (active, fname, ico, name))
    table = extract_table(fname)
    panels_html.append('<div class="t-panel%s" id="panel-%s"><div class="table-responsive">%s</div></div>' % (active, fname, table))

html = """<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.dns.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.dns.keywords}" /><meta name="description" content="{$Think.config.web.dns.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css" /><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">🧭</span>公共 DNS 大全</h2>
        <p class="tool-desc">公共 DNS、电信 / 联通 / 移动 / 铁通 / 教育网及美国等各地区 DNS 服务器地址汇总，点击上方分类切换查看。</p>
        <ul class="t-tabs">__TABS__</ul>
        <div class="t-panel-wrap">__PANELS__</div>
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
    'use strict';
    var tabs = document.querySelectorAll('.t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.t-panel').forEach(function (p) { p.classList.remove('active'); });
            btn.classList.add('active');
            document.getElementById(btn.getAttribute('data-panel')).classList.add('active');
        });
    });
})();
</script>
</body></html>
"""
html = html.replace("__TABS__", "\n".join(tabs_html)).replace("__PANELS__", "\n".join(panels_html))
open(OUT, "w", encoding="utf-8").write(html)
print("written:", OUT, len(html), "bytes")
print("tables:", src_count if False else sum(1 for _ in []))
for fname, _, _ in CATS:
    t = extract_table(fname)
    print("  %-10s table rows=%d" % (fname, t.count("<tr")))
