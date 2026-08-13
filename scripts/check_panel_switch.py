# -*- coding: utf-8 -*-
"""验证拼接关系 + 多面板页面的切换机制"""
import re

site = open(r"C:\project\wwwroot\toolbox\public\static\style\site.min.css", encoding="utf-8", errors="ignore").read()
app = open(r"C:\project\wwwroot\toolbox\public\static\style\app.css", encoding="utf-8", errors="ignore").read()

# 1. site.min.css 是否包含 app.css 的头部注释
app_head = app[:50].replace("\n", " ")
print("app.css 头部注释在 site.min.css:", app_head[:30] in site)
i = site.find("前端重构设计系统")
print("site 中 app.css 注释位置:", i, "| site 总长:", len(site))
print()

# 2. 各多面板页面切换 JS 方式
BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
for p in ["calc", "dns", "linuxcmd", "subnetmask"]:
    src = open(BASE + "\\" + p + ".html", encoding="utf-8").read()
    # 找 t-tab 点击处理
    m = re.search(r"t-tab[\s\S]{0,300}?addEventListener\('click'[\s\S]{0,500}?\}", src)
    has_classlist = "classList" in src
    has_style_display = "style.display" in src
    panels = len(re.findall(r'class="t-panel', src))
    print(f"{p}: panels={panels} classList={has_classlist} style.display={has_style_display}")
    if m:
        print("  ", m.group(0)[:220].replace("\n", " "))
