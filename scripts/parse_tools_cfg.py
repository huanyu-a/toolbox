# -*- coding: utf-8 -*-
"""解析 tools.php 导航"""
import re

src = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
cats = re.findall(r"'cat' => '([^']+)'", src)
items = re.findall(r"'url' => '/([^/]+)/', 'name' => '([^']+)'", src)
print("分类数:", len(cats))
for c in cats:
    print("  CAT:", c)
print("工具数:", len(items))
for u, n in items:
    print("  %-18s %s" % (u, n))
