# -*- coding: utf-8 -*-
"""查看 unicode / random / unixtime / createmeta 的 tab 面板布局"""
import re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

for p in ["unicode", "random", "unixtime", "createmeta"]:
    src = open(BASE + "\\" + p + ".html", encoding="utf-8").read()
    print(f"========== {p}.html ({round(len(src)/1024,1)}KB) ==========")
    # 找所有 t-panel 及内部 textarea/按钮
    panels = re.findall(r'<div[^>]*class="t-panel[^"]*"[^>]*id="([^"]+)"[^>]*>(.*?)(?=<div[^>]*class="t-panel|</div>\s*</div>\s*</div>\s*</div>|$)', src, re.S)
    for pid, content in panels[:6]:
        tas = re.findall(r'<textarea[^>]*id="([^"]+)"', content)
        btns = re.findall(r'<button[^>]*id="([^"]+)"', content)
        labels = re.findall(r'<label[^>]*>([^<]{0,30})</label>', content)
        print(f"  panel {pid}: textarea={tas} buttons={btns}")
    print()
