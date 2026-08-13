# -*- coding: utf-8 -*-
"""确认 site.min.css 是否含新皮肤/tab 样式 + 全站 CSS 加载统计"""
import os, re

site = open(r"C:\project\wwwroot\toolbox\public\static\style\site.min.css", encoding="utf-8", errors="ignore").read()

for cls in [".t-tabs", ".t-tab", ".t-panel", ".tool-card", ".t-area", ".t-options", ".t-btn", ".t-error", ".tool-title"]:
    print(f"site.min.css 含 {cls}: {cls in site}")

print()
BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
load_app = 0
load_site = 0
no_css = []
for f in sorted(os.listdir(BASE)):
    if not f.endswith(".html"):
        continue
    src = open(os.path.join(BASE, f), encoding="utf-8").read()
    has_app = "app.css" in src
    has_site = "site.min.css" in src
    load_app += has_app
    load_site += has_site
    if not has_app:
        no_css.append(f)

print(f"加载 app.css 的页面: {load_app}")
print(f"加载 site.min.css 的页面: {load_site}")
print(f"未加载 app.css 的页面数: {len(no_css)}")
print("未加载 app.css 的页面:", no_css[:30], "..." if len(no_css) > 30 else "")
