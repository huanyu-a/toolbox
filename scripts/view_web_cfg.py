# -*- coding: utf-8 -*-
"""查看 web.php 中 deencrypt/allencrypt/htpasswd 配置块"""
import re

src = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8", errors="ignore").read()

for key in ["deencrypt", "allencrypt", "htpasswd"]:
    m = re.search(r"'%s'\s*=>\s*\[(.*?)\]\s*," % key, src, re.S)
    print("=== %s ===" % key)
    print(m.group(0)[:500] if m else "NOT FOUND")
    print()
