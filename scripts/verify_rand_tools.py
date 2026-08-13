# -*- coding: utf-8 -*-
"""验证随机推荐区块渲染"""
import urllib.request, re

# 1. PHP 括号平衡
src = open(r"C:\project\wwwroot\toolbox\application\index\controller\Index.php", encoding="utf-8").read()
print("Index.php 括号平衡:", src.count("{") - src.count("}"), src.count("(") - src.count(")"), src.count("[") - src.count("]"))
print("含 randTools:", "randTools" in src)

# 2. 渲染验证
for url in ["http://127.0.0.1:18080/urlcode/", "http://127.0.0.1:18080/json/"]:
    body = urllib.request.urlopen(url, timeout=15).read().decode("utf-8", "ignore")
    # 找随机推荐区块
    i = body.find("随机推荐")
    if i < 0:
        print(f"❌ {url}: 未找到随机推荐标题")
        continue
    # 提取该区块的 li 数
    seg = body[i:i+8000]
    links = re.findall(r'<a href="(/[^"]+/)"[^>]*>([^<]+)</a>', seg)
    print(f"\n✅ {url}")
    print(f"  标题: 随机推荐工具")
    print(f"  链接数: {len(links)}")
    names = [n for _, n in links]
    print(f"  前 5 个: {names[:5]}")
    # 重复检查
    urls_only = [u for u, _ in links]
    print(f"  URL 重复: {len(urls_only) != len(set(urls_only))}")
