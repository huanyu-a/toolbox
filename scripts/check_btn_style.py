# -*- coding: utf-8 -*-
"""验证重构页细节"""
import re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

# 1. t-btn-ok 样式是否存在
css = open(r"C:\project\wwwroot\toolbox\public\static\style\app.css", encoding="utf-8").read()
print("app.css 含 .t-btn:", ".t-btn" in css)
print("app.css 含 .t-btn-ok:", ".t-btn-ok" in css)

# 2. tab 按钮 type 检查
for p in ["json", "html2js", "unicode"]:
    src = open(BASE + "\\" + p + ".html", encoding="utf-8").read()
    tabs = re.findall(r'<button[^>]*class="t-tab[^"]*"[^>]*>', src)
    no_type = [t for t in tabs if 'type="button"' not in t]
    print(f"{p}: {len(tabs)} 个 tab, 缺 type=button 的: {len(no_type)}")

# 3. 重构页大小对比
import os
for p in ["json", "html2js", "unicode"]:
    size = os.path.getsize(BASE + "\\" + p + ".html")
    print(f"{p}: {round(size/1024,1)}KB")
