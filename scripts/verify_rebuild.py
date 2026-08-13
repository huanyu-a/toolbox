# -*- coding: utf-8 -*-
import re, urllib.request, urllib.error

src = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8").read()
print("行数:", src.count("\n"))
print("圆括号平衡:", src.count("(") == src.count(")"))
print("方括号平衡:", src.count("[") == src.count("]"))
print("花括号平衡:", src.count("{") == src.count("}"))
print("header 保留:", "'header' =>" in src)
print("encode 块:", "'encode' =>" in src)
print("md5 已删:", "'md5' =>" not in src)
print("formatcss 已删:", "'formatcss' =>" not in src)

# 全入口 HTTP 冒烟
tools = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
items = re.findall(r"'url' => '(/[^']+)'", tools)
print("\n入口数:", len(items))
bad = []
for u in items:
    try:
        with urllib.request.urlopen("http://127.0.0.1:18080" + u, timeout=8) as r:
            if r.status != 200:
                bad.append((u, r.status))
    except urllib.error.HTTPError as e:
        bad.append((u, e.code))
    except Exception as e:
        bad.append((u, str(e)[:40]))
print("异常:", bad if bad else "无，全部 200")
