# -*- coding: utf-8 -*-
"""验证分类结构 + /encode/ 功能冒烟"""
import re, urllib.request

# 1. 分类结构
tp = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
parts = re.split(r"'cat' => '", tp)[1:]
total = 0
for p in parts:
    cat = p.split("'")[0]
    n = len(re.findall(r"'url' => '([^']+)'", p))
    total += n
    flag = "✅" if n >= 5 else "❌"
    print(f"{cat}: {n} {flag}")
print("总数:", total, "| 括号:", tp.count("[") - tp.count("]"), tp.count("(") - tp.count(")"))

# 2. 渲染验证
body = urllib.request.urlopen("http://127.0.0.1:18080/encode/", timeout=20).read().decode("utf-8", "ignore")
print("\n/encode/ 渲染 200:", len(body), "字节")
print("首页分类:", re.findall(r'class="home-cat-name">([^<]+)</span>', urllib.request.urlopen("http://127.0.0.1:18080/", timeout=15).read().decode("utf-8", "ignore")))
