# -*- coding: utf-8 -*-
"""检查各合并页的 tab 面板结构，找出可共享输入输出的页面"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

pages = ["html2js", "ascii", "htmlescape", "unicode", "random", "unixtime",
         "createmeta", "ip", "hexrgb", "keyboardcode", "regex", "uuid"]

for p in pages:
    path = os.path.join(BASE, p + ".html")
    if not os.path.exists(path):
        continue
    src = open(path, encoding="utf-8").read()
    tabs = re.findall(r'data-panel="([^"]+)"', src)
    textareas = len(re.findall(r"<textarea", src))
    # 每个 panel 是否都有自己的 textarea
    panel_ids = re.findall(r'class="t-panel[^"]*" id="([^"]+)"', src)
    # panel 内 textarea id
    panel_tas = re.findall(r'id="([a-z0-9-]+)"[^>]*class="t-area[^"]*"[^>]*>', src)
    # 简单判定：textarea 数 > tab 数说明每 tab 有独立框
    print(f"{p:14s} tabs={len(tabs):2d} textarea={textareas:2d} panels={len(panel_ids)} panel_tas={len(panel_tas)}")
