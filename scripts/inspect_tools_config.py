# -*- coding: utf-8 -*-
"""检查工具注册表字段"""
import re

src = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8", errors="ignore").read()
print("文件大小:", len(src))

# 字段统计
fields = set(re.findall(r"'(\w+)'\s*=>", src))
print("配置字段:", sorted(fields))

# 看第一个工具条目完整内容
m = re.search(r"return\s*\[", src)
seg = src[m.start():m.start()+1200]
print("\n注册表开头:")
print(seg[:1200])
