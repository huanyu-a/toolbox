# -*- coding: utf-8 -*-
"""查看 wenzitexiao / huoxingwen 完整结构"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
for slug in ["wenzitexiao", "huoxingwen"]:
    src = open(os.path.join(BASE, slug + ".html"), encoding="utf-8").read()
    print("=" * 50)
    print(slug, os.path.getsize(os.path.join(BASE, slug + ".html")), "B")
    # 外部脚本
    ext = re.findall(r'<script[^>]*src="([^"]+)"', src)
    print("外部:", [e.split("/")[-1] for e in ext])
    # 主体（tool-card 内）
    m = re.search(r'<div class="tool-card">(.*?)\{include file="nav"', src, re.S)
    if m:
        print("主体:")
        print(m.group(1)[:1800])
    else:
        print("无 tool-card，全文:")
        print(src[src.find("<body>"):src.find("</body>")][:1800])
