# -*- coding: utf-8 -*-
"""确认 linuxcmd tabs 明细 + autoformat tool.js 残留"""
import re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

print("=== linuxcmd t-tab 明细 ===")
src = open(BASE + r"\linuxcmd.html", encoding="utf-8").read()
tabs = re.findall(r'<button[^>]*class="t-tab[^"]*"[^>]*>([^<]*)</button>', src)
print(len(tabs), "个 tab:")
for t in tabs:
    print("  ", t)
panels = re.findall(r'<div[^>]*class="t-panel[^"]*"[^>]*id="([^"]+)"', src)
print("panels:", panels)

print("\n=== autoformat.html tool.js 引用上下文 ===")
src = open(BASE + r"\autoformat.html", encoding="utf-8").read()
for m in re.finditer(r'tool\.js', src):
    i = m.start()
    print("  ..." + src[max(0,i-120):i+60].replace("\n", " ") + "...")
# 是否调用 tool.js 函数
for fn in ["setJS", "pcjson_com_msg", "pcjson_convert", "copyTxtToClipboard", "tj("]:
    if fn in src:
        print("  调用:", fn)
print("data-clipboard-target:", "data-clipboard-target" in src)
