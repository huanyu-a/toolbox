# -*- coding: utf-8 -*-
"""检查 tab 相关样式加载与覆盖情况"""
import re

# 1. 检查页面 CSS 加载顺序
src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\json.html", encoding="utf-8").read()
links = re.findall(r'<link[^>]*href="([^"]+\.css[^"]*)"', src)
print("json.html CSS 加载顺序:", links)

# 2. site.min.css 里是否有影响 ul/li 宽度的规则
site = open(r"C:\project\wwwroot\toolbox\public\static\style\site.min.css", encoding="utf-8", errors="ignore").read()
print("\nsite.min.css 大小:", len(site))
for pat in [r"ul[^{]*\{[^}]*\}", r"li[^{]*\{[^}]*\}", r"\.t-tab[^{]*\{[^}]*\}", r"\.nav[^{]*\{[^}]*\}"]:
    ms = re.findall(pat, site)
    for m in ms[:5]:
        print(f"  [{pat}] {m[:150]}")
    if ms:
        print("  ---")

# 3. app.css 是否在 site.min.css 之后（决定优先级）
import os
app_path = r"C:\project\wwwroot\toolbox\public\static\style\app.css"
print("\napp.css 存在:", os.path.exists(app_path))
