# -*- coding: utf-8 -*-
"""提取文本转换组页面的 tool-card 主体 + 内联 JS"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
slugs = ["textflip", "quanbaojiao", "capital", "rmbdaxie", "wenzitexiao", "zipstringtext"]

for slug in slugs:
    src = open(os.path.join(BASE, slug + ".html"), encoding="utf-8").read()
    m = re.search(r'<div class="tool-card">(.*?)\{include file="nav"', src, re.S)
    body = m.group(1).strip() if m else "NO-CARD"
    js = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    jsl = max((len(x) for x in js), default=0)
    print(f"\n{'='*60}\n{slug} (card={len(body)}B js={jsl}B)")
    print(body[:1500])
