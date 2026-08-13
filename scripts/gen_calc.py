# -*- coding: utf-8 -*-
"""生成 calc.html：13 类单位换算合一页（tab 结构，新皮肤+原生JS）
数据源：12 个 calc* 页面的 units+bs（温度用标准公式，数据大小用 1024 进制）
"""
import json, os

BASE = os.path.join(os.path.dirname(__file__), "..", "application", "index", "view", "index")
OUT = os.path.join(BASE, "calc.html")
calc_data = json.load(open(os.path.join(os.path.dirname(__file__), "calc_data.json"), encoding="utf-8"))

def parse_bs(s):
    return [float(x.strip()) for x in s.split(",")]

# 分类定义：(key, 显示名, 图标)
CATS = [
    ("calclength", "长度", "📏"),
    ("calcarea", "面积", "📐"),
    ("calcvolume", "体积", "🧊"),
    ("calctemperature", "温度", "🌡️"),
    ("calctime", "时间", "⏱️"),
    ("calcspeed", "速度", "🚀"),
    ("calcpressure", "压力", "🌡️"),
    ("calcpower", "功率", "⚡"),
    ("calcangle", "角度", "📐"),
    ("calcforce", "力", "⚙️"),
    ("calcheat", "热量", "🔥"),
    ("calcthickness", "密度", "📏"),
    ("calcdata", "数据大小", "💾"),
]

def build_units(key):
    """返回 [(中文名, 单位符号)] 列表"""
    if key == "calcdata":
        return [("比特", "bit"), ("字节", "Bytes"), ("千字节", "KB"), ("兆字节", "MB"), ("千兆字节", "GB"), ("太字节", "TB")]
    if key == "calctemperature":
        return [("摄氏度", "C"), ("华氏度", "F"), ("开氏度", "K"), ("兰氏度", "Ra"), ("列氏度", "Re")]
    d = calc_data[key]
    units = d["units"]
    if key == "calcpressure":
        units = units[:12]
    return units

def build_bs(key):
    if key == "calcdata":
        return [1.0 / (8 * 1024 ** 4), 1.0 / (1024 ** 4), 1.0 / (1024 ** 3), 1.0 / (1024 ** 2), 1.0 / 1024, 1.0]  # 以 TB 为基准
    if key == "calctemperature":
        return None
    d = calc_data[key]
    bs = parse_bs(d["bs"])
    if key == "calcpressure":
        bs = bs[:12]
    return bs

panels = []
tabs_html = []
for idx, (key, name, ico) in enumerate(CATS):
    units = build_units(key)
    bs = build_bs(key)
    active = " active" if idx == 0 else ""
    tabs_html.append('<li><button type="button" class="t-tab%s" data-panel="panel-%s">%s %s</button></li>' % (active, key, ico, name))
    # 单位网格
    grid = []
    for i, (cn, sym) in enumerate(units):
        sym_html = (' <em class="u-sym">(%s)</em>' % sym) if sym else ""
        grid.append(
            '<div class="u-item"><label class="u-name">%s%s</label>'
            '<input type="text" class="u-in" data-unit="%d" inputmode="decimal" placeholder="输入数值" /></div>' % (cn, sym_html, i)
        )
    panels.append(
        '<div class="t-panel%s" id="panel-%s">\n'
        '  <div class="u-grid">%s</div>\n'
        '  <div class="tool-actions" style="margin-top:14px"><button class="t-btn t-btn-ghost" type="button" data-reset="panel-%s">全部重置</button></div>\n'
        '</div>' % (active, key, "\n".join(grid), key)
    )

# 换算逻辑（按分类）
converters = {}
converters["calcdata"] = """function convert(v, from, to) { return v * RATIOS[from] / RATIOS[to]; }"""
converters["calctemperature"] = """function toC(v, from) { return from === 0 ? v : from === 1 ? (v - 32) * 5 / 9 : from === 2 ? v - 273.15 : from === 3 ? (v - 491.67) * 5 / 9 : v * 5 / 4; }
function fromC(c, to) { return to === 0 ? c : to === 1 ? c * 9 / 5 + 32 : to === 2 ? c + 273.15 : to === 3 ? (c + 273.15) * 9 / 5 : c * 4 / 5; }"""

js_tables = []
for key, name, ico in CATS:
    units = build_units(key)
    bs = build_bs(key)
    if key == "calcdata":
        # 以 TB 为 1：bit=1/(8*1024^4) ... TB=1
        ratios = [1.0 / (8 * 1024 ** 4), 1.0 / (1024 ** 4), 1.0 / (1024 ** 3), 1.0 / (1024 ** 2), 1.0 / 1024, 1.0]
        js_tables.append('  "%s": { "bs": [%s], "temp": false },' % (key, ",".join(repr(x) for x in ratios)))
    elif key == "calctemperature":
        js_tables.append('  "%s": { "bs": null, "temp": true },' % key)
    else:
        js_tables.append('  "%s": { "bs": [%s], "temp": false },' % (key, ",".join(repr(x) for x in bs)))

html = """<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.calc.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.calc.keywords}" /><meta name="description" content="{$Think.config.web.calc.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css" /><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">📐</span>单位换算器</h2>
        <p class="tool-desc">长度、面积、体积、温度、时间、速度、压力、功率、角度、力、热量、密度、数据大小等常用单位在线互转，在任意输入框输入数值即可同步换算全部单位。</p>
        <ul class="t-tabs">__TABS__</ul>
        <div class="t-panel-wrap">__PANELS__</div>
    </div>
</div></div>
<style>
.u-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 10px; }
.u-item { background: var(--surface-2, #f7f8fa); border: 1px solid var(--border, #e5e7eb); border-radius: 8px; padding: 10px 12px; }
.u-name { display: block; font-size: 13px; color: var(--text-2, #555); margin-bottom: 6px; font-weight: 600; }
.u-name .u-sym { font-style: normal; color: var(--text-3, #999); font-weight: 400; }
.u-in { width: 100%; box-sizing: border-box; border: 1px solid var(--border, #e5e7eb); border-radius: 6px; padding: 7px 10px; font-size: 14px; background: #fff; color: var(--text, #222); outline: none; }
.u-in:focus { border-color: var(--brand, #4f6ef2); box-shadow: 0 0 0 3px rgba(79,110,242,.12); }
</style>
{include file="nav" /}
{include file="footer" /}
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/toolbox.js"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script>
(function () {
    'use strict';
    var DATA = {
__DATA__
    };
    var tabs = document.querySelectorAll('.t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.t-panel').forEach(function (p) { p.classList.remove('active'); });
            btn.classList.add('active');
            document.getElementById(btn.getAttribute('data-panel')).classList.add('active');
        });
    });
    document.querySelectorAll('.t-panel').forEach(function (panel) {
        var key = panel.id.replace('panel-', '');
        var cfg = DATA[key];
        var inputs = panel.querySelectorAll('.u-in');
        inputs.forEach(function (inp) {
            inp.addEventListener('input', function () {
                var v = parseFloat(inp.value);
                if (isNaN(v) || !isFinite(v)) { return; }
                var from = parseInt(inp.getAttribute('data-unit'), 10);
                inputs.forEach(function (other) {
                    var to = parseInt(other.getAttribute('data-unit'), 10);
                    var out;
                    if (cfg.temp) {
                        var c = toC(v, from);
                        out = fromC(c, to);
                    } else {
                        out = v * cfg.bs[from] / cfg.bs[to];
                    }
                    other.value = (Math.round(out * 1e10) / 1e10).toString();
                });
            });
        });
    });
    document.querySelectorAll('[data-reset]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var panel = document.getElementById(btn.getAttribute('data-reset'));
            panel.querySelectorAll('.u-in').forEach(function (i) { i.value = ''; });
        });
    });
    function toC(v, from) { return from === 0 ? v : from === 1 ? (v - 32) * 5 / 9 : from === 2 ? v - 273.15 : from === 3 ? (v - 491.67) * 5 / 9 : v * 5 / 4; }
    function fromC(c, to) { return to === 0 ? c : to === 1 ? c * 9 / 5 + 32 : to === 2 ? c + 273.15 : to === 3 ? (c + 273.15) * 9 / 5 : c * 4 / 5; }
})();
</script>
</body></html>
"""
html = html.replace("__TABS__", "\n".join(tabs_html)).replace("__PANELS__", "\n".join(panels)).replace("__DATA__", "\n".join(js_tables))

open(OUT, "w", encoding="utf-8").write(html)
print("written:", OUT, len(html), "bytes")
