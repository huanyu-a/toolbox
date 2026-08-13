# -*- coding: utf-8 -*-
"""检查候选页 tab/textarea 分布，判断共享输入输出可行性"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

pages = ["ascii", "htmlescape", "unicode", "regex", "random", "unixtime",
         "createmeta", "ip", "uuid", "keyboardcode", "hexrgb", "pagecode"]

for p in pages:
    path = os.path.join(BASE, p + ".html")
    src = open(path, encoding="utf-8").read()
    tabs = re.findall(r'data-panel="([^"]+)"', src) or re.findall(r'data-mode="([^"]+)"', src)
    textareas = re.findall(r'<textarea[^>]*id="([^"]+)"', src)
    # 面板结构
    panels = re.findall(r'class="t-panel[^"]*" id="([^"]+)"', src)
    # 每个 panel 的内容快照（输入/输出/按钮的 id）
    print(f"===== {p} ({round(len(src)/1024,1)}KB) tabs={len(tabs)} panels={len(panels)} textarea={len(textareas)} =====")
    print("  tabs:", tabs)
    print("  textareas:", textareas)
    # 按钮数量
    btns = re.findall(r'<button[^>]*id="([^"]+)"', src)
    print("  按钮:", btns[:14])
    print()
