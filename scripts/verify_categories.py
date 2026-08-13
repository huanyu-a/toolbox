# -*- coding: utf-8 -*-
"""验证 tools.php 新分类结构"""
import re

src = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()

# 解析分类
cats = re.findall(r"'cat' => '([^']+)'", src)
print("分类数:", len(cats), cats)

# 解析每个分类下的工具
blocks = re.split(r"\[", src)
# 用更可靠方式：按 'cat' 切分
parts = re.split(r"'cat' => '", src)[1:]
total = 0
for p in parts:
    cat = p.split("'")[0]
    items = re.findall(r"'url' => '([^']+)'", p)
    total += len(items)
    flag = "✅" if len(items) >= 5 else "❌"
    print(f"  {flag} {cat}: {len(items)} 个工具")

print("\n工具总数:", total, "（应为 82）")

# 检查重复 URL
all_urls = re.findall(r"'url' => '([^']+)'", src)
dups = [u for u in set(all_urls) if all_urls.count(u) > 1]
print("URL 重复:", dups if dups else "无")

# 括号平衡
print("括号平衡:", src.count("{") - src.count("}"), src.count("(") - src.count(")"), src.count("[") - src.count("]"))
