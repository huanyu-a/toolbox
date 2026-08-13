# -*- coding: utf-8 -*-
"""检查 tab JS 切换方式 + site.min.css 尾部 + 缺哪些 tab 相关类"""
import re

site = open(r"C:\project\wwwroot\toolbox\public\static\style\site.min.css", encoding="utf-8", errors="ignore").read()

# 1. 检查 site.min.css 尾部
print("site.min.css 尾部 300 字符:")
print(site[-300:])
print()

# 2. 检查 json.html tab 切换 JS 方式
src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\json.html", encoding="utf-8").read()
m = re.search(r"function switchMode.*?\n    \}", src, re.S)
print("json switchMode 函数:")
print(m.group(0)[:500] if m else "NOT FOUND")
print()

# 3. site.min.css 缺哪些类
for cls in [".t-tabs", ".t-tab", ".t-panel", ".t-panel.active", ".t-error.show", ".t-area-readonly"]:
    print(f"site.min.css 含 {cls}: {cls in site}")

# 4. site.min.css 里 t-area / t-error / t-btn 附近样式（确认格式风格）
i = site.find(".tool-card .t-area")
print("\n.t-area 样式片段:", site[i:i+200] if i > 0 else "N/A")
