# -*- coding: utf-8 -*-
"""检查 index.html / favicon.html 中的 base64 链接"""
import re

for f in ["index.html", "favicon.html"]:
    src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\\" + f, encoding="utf-8").read()
    print("=====", f)
    for m in re.finditer(r'[^"\'<>]*base64[^"\'<>]*', src):
        seg = m.group(0).strip()
        if len(seg) < 150:
            print("   →", seg)
