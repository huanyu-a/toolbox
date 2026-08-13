# -*- coding: utf-8 -*-
"""确认 web.php 残留 + 分类计数"""
import re

src = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8", errors="ignore").read()
for m in re.finditer(r"htpasswd", src):
    print("web.php htpasswd 上下文:", src[max(0, m.start()-40):m.start()+30].replace("\n", " "))

# 分类计数
t = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
parts = re.split(r"'cat' => '", t)[1:]
total = 0
for p in parts:
    cat = p.split("'")[0]
    n = len(re.findall(r"'url' => '([^']+)'", p))
    total += n
    print(f"{cat}: {n}")
print("总数:", total, "| 括号平衡:", t.count("[") - t.count("]"))
