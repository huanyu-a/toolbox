# -*- coding: utf-8 -*-
"""测量合并页大小 + tab 结构"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

# 主要合并页
merges = ["json", "calc", "format", "dns", "html2js", "regex", "keyboardcode",
          "random", "unixtime", "createmeta", "hexrgb", "ip", "pagecode",
          "ascii", "htmlescape", "httpheader", "deencrypt", "allencrypt",
          "uuid", "unicode", "linuxcmd", "subnetmask"]

print("=== 合并页大小与结构 ===")
for p in merges:
    path = os.path.join(BASE, p + ".html")
    if not os.path.exists(path):
        continue
    src = open(path, encoding="utf-8").read()
    tabs = len(re.findall(r'class="t-tab', src))
    panels = len(re.findall(r'class="t-panel', src))
    textareas = len(re.findall(r"<textarea", src))
    inputs = len(re.findall(r"<input", src))
    size_kb = len(src) / 1024
    print(f"  {p:16s} {size_kb:6.1f}KB  tabs={tabs:2d} panels={panels:2d} textarea={textareas:2d} input={inputs:3d}")
