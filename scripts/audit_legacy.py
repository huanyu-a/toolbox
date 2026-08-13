# -*- coding: utf-8 -*-
"""盘点遗留事项现状"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

pages = sorted(f[:-5] for f in os.listdir(BASE) if f.endswith(".html") and f != "index.html")
print("页面总数(不含index):", len(pages))

# 1. 旧骨架页 (col10main / accordion / form-horizontal)
old_skin = []
tooljs = []
hightout = []
onclick = []
for p in pages:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    if "col10main" in src or "accordion" in src:
        old_skin.append(p)
    if 'src="/static/script/tool.js"' in src:
        tooljs.append(p)
    if "hightout.js" in src:
        hightout.append(p)
    if re.search(r"\sonclick=", src):
        onclick.append(p)

print("\n=== 旧骨架页 (col10main/accordion) ===")
print(len(old_skin), old_skin)

print("\n=== 引用 tool.js 的页面 ===")
print(len(tooljs), tooljs)

print("\n=== 引用 hightout.js 的页面 ===")
print(len(hightout), hightout)

print("\n=== 含 onclick= 内联的页面 ===")
print(len(onclick), onclick)

# 2. 大文件
print("\n=== 大文件 (>60KB) ===")
for p in pages:
    size = os.path.getsize(os.path.join(BASE, p + ".html"))
    if size > 60000:
        print(f"  {p}: {size/1024:.0f}KB")

# 3. 新皮肤统计（tool-card 是新的）
new_skin = [p for p in pages if "tool-card" in open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()]
print("\n新皮肤(tool-card)页:", len(new_skin), "/", len(pages))
