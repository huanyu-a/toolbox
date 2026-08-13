# -*- coding: utf-8 -*-
"""查看 web.php 中指定 key 的 TDK 块"""
import re

path = r"C:\project\wwwroot\toolbox\config\web.php"
src = open(path, encoding="utf-8").read()

keys = ['texttool', 'textconvert', 'jsencrypt', 'random', 'encrypt', 'encode']
for k in keys:
    m = re.search(r"'%s' => \n  array \(\n(.*?)\n  \),?" % k, src, re.S)
    if m:
        print("=== %s ===" % k)
        print(m.group(0)[:900])
        print()
    else:
        print("=== %s === NOT FOUND" % k)
