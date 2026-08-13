# -*- coding: utf-8 -*-
"""提取 unicode.html 面板结构"""
import re

src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\unicode.html", encoding="utf-8").read()

# 提取 t-grid 块（含输入输出的双栏）
grids = re.findall(r'<div class="t-grid">.*?</div>\s*</div>', src, re.S)
print("t-grid 块数:", len(grids))
for i, g in enumerate(grids):
    print(f"--- grid#{i} ({len(g)} chars) ---")
    print(g[:600])
    print()

# 提取 tab 列表
m = re.search(r'<ul class="t-tabs">.*?</ul>', src, re.S)
print("=== tabs ===")
print(m.group(0) if m else "NOT FOUND")

# panel 边界
for pm in re.finditer(r'<div id="(ucPanel\d|nuPanel\d)" class="t-panel"[^>]*>', src):
    print("panel start:", pm.group(1))
