# -*- coding: utf-8 -*-
"""全站扫描 tab 页：找每 panel 各带整套按钮的重复结构 + 结构异常"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

print("=== 各 tab 页结构 ===")
for f in sorted(os.listdir(BASE)):
    if not f.endswith(".html"):
        continue
    src = open(os.path.join(BASE, f), encoding="utf-8").read()
    tabs = len(re.findall(r'class="t-tab', src))
    panels = re.findall(r'<div[^>]*class="t-panel[^"]*"[^>]*id="([^"]+)"', src)
    if not tabs and not panels:
        continue
    # 每个 panel 内的按钮
    panel_btns = []
    for pid in panels:
        m = re.search(r'<div[^>]*class="t-panel[^"]*"[^>]*id="' + re.escape(pid) + r'"[^>]*>(.*?)(?=<div[^>]*class="t-panel|</div>\s*</div>\s*</div>|$)', src, re.S)
        if m:
            btns = re.findall(r'<button[^>]*id="([^"]+)"', m.group(1))
            panel_btns.append((pid, btns))
    # 判断每 panel 是否都有相同按钮集（重复）
    sets = [set(btns) for _, btns in panel_btns]
    dup = False
    for i in range(len(sets)):
        for j in range(i+1, len(sets)):
            inter = sets[i] & sets[j]
            if len(inter) >= 2 and sets[i] and sets[j]:
                dup = True
                print(f"  ⚠️ {f}: panel {panel_btns[i][0]} 与 {panel_btns[j][0]} 按钮重叠 {len(inter)} 个: {sorted(inter)[:6]}")
    if dup:
        continue
    print(f"  ✓ {f}: tabs={tabs} panels={len(panels)}")
