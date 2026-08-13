# -*- coding: utf-8 -*-
"""重建 subnetmask.html：新皮肤 + tab 分组"""
import re

SRC = r"C:\project\wwwroot\toolbox\application\index\view\index\subnetmask.html"
src = open(SRC, encoding="utf-8").read()

# 1. 提取 10 个 t-mod 模块
mods = re.findall(r'(<div class="t-mod">.*?</form>\s*</div>)', src, re.S)
print("提取模块数:", len(mods))
for i, m in enumerate(mods):
    t = re.search(r't-mod-title">([^<]+)<', m)
    print("  %d: %s (%d B)" % (i, t.group(1) if t else "?", len(m)))

# 2. 提取内联 clear 函数 script
clear_script = ""
m = re.search(r'(<script>function nnclear.*?</script>)', src, re.S)
if m:
    clear_script = m.group(1)
    print("内联 clear 脚本:", len(clear_script), "B")

# 3. 分组（按模块序号）
groups = {
    "smNet":  ([0, 2, 5], "🕸️ 网络/IP 计算"),   # 模块1 calNBFL + 模块3 compute + 模块6 calcIpInvert
    "smSub":  ([6], "🧮 子网划分"),               # 模块7 compute2
    "smMask": ([1, 3, 4], "🔄 掩码转换"),          # 模块2 + 模块4 + 模块5
    "smHost": ([7, 9], "📐 主机/地址量"),          # 模块8 + 模块10
    "smHex":  ([8], "🔢 进制转换"),                # 模块9
}

panels_html = ""
tabs_html = ""
first = True
for pid, (idx_list, label) in groups.items():
    body = "\n".join(mods[i] for i in idx_list)
    # 模块间加分隔线样式由 .t-mod + .t-mod 规则处理
    panels_html += '        <div id="%s" class="t-panel sm-panel%s">\n%s\n        </div>\n' % (
        pid, " active" if first else "", body)
    tabs_html += '            <li><button type="button" class="t-tab%s" data-panel="%s">%s</button></li>\n' % (
        " active" if first else "", pid, label)
    first = False

# 4. 提取原 <style> 块
style_block = ""
m = re.search(r'(<style>.*?</style>)', src, re.S)
if m:
    style_block = m.group(1)

# 5. 提取原 tool-title/tool-desc（第一张卡片）
title = re.search(r'<h2 class="tool-title">.*?</h2>', src, re.S).group(0)
desc = re.search(r'<p class="tool-desc">.*?</p>', src, re.S).group(0)

# 6. 提取「介绍」卡片
intro = ""
m = re.search(r'(<div class="tool-card">\s*<h2 class="tool-title">📖.*?</div>\s*</div>)', src, re.S)
if m:
    intro = m.group(1)

head = ('<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" '
        'content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />'
        '<title>{$Think.config.web.subnetmask.title}</title><meta name="applicable-device" content="pc,mobile" />'
        '<meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" />'
        '<meta name="keywords" content="{$Think.config.web.subnetmask.keywords}" />'
        '<meta name="description" content="{$Think.config.web.subnetmask.description}" />'
        '<meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" />'
        '<link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" />'
        '<link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>'
        '<!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>'
        '<script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->'
        '{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}\n')

tail = ('</div></div>\n'
        '{include file="nav" /}\n'
        '{include file="footer" /}\n'
        '<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>\n'
        '<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>\n'
        '<script src="/static/script/pcjs/subnetmask.js" type="text/javascript"></script>\n'
        + (clear_script + "\n" if clear_script else "") +
        '<script src="/static/script/pcjs/jq-public.js" type="text/javascript"></script>\n'
        '<script src="/static/script/app.js" type="text/javascript"></script>\n'
        '<script>\n'
        '(function () {\n'
        '    var tabs = document.querySelectorAll(\'#smTabs .t-tab\');\n'
        '    var panels = document.querySelectorAll(\'.sm-panel\');\n'
        '    tabs.forEach(function (btn) {\n'
        '        btn.addEventListener(\'click\', function () {\n'
        '            tabs.forEach(function (b) { b.classList.remove(\'active\'); });\n'
        '            panels.forEach(function (p) { p.classList.remove(\'active\'); });\n'
        '            document.getElementById(btn.getAttribute(\'data-panel\')).classList.add(\'active\');\n'
        '            btn.classList.add(\'active\');\n'
        '        });\n'
        '    });\n'
        '})();\n'
        '</script>\n'
        '</body></html>\n')

body = ('<div class="container"><div class="tool-wrap">\n'
        '    <div class="tool-card">\n'
        '        ' + title + '\n'
        '        ' + desc + '\n'
        '        <ul class="t-tabs" id="smTabs">\n' + tabs_html + '        </ul>\n\n'
        + panels_html +
        '    </div>\n'
        + (intro + "\n" if intro else "") +
        '</div></div>\n')

out = head + style_block + "\n" + body + tail
open(SRC, "w", encoding="utf-8").write(out)
print("\n重建完成，新大小:", len(out))
