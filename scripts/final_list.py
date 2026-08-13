# -*- coding: utf-8 -*-
"""输出最终分类工具清单"""
import re

src = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
cats = re.findall(r"'cat' => '([^']+)'", src)
items = re.findall(r"\['url' => '(/[^']+)', 'name' => '([^']+)'", src)
total = 0
print("分类数:", len(cats))
# 按分类分组（顺序解析）
cat_blocks = re.findall(r"'cat' => '([^']+)',\s*'items' => \[(.*?)\n        \],", src, re.S)
for cat, body in cat_blocks:
    its = re.findall(r"'url' => '(/[^']+)', 'name' => '([^']+)'", body)
    total += len(its)
    print("\n## %s（%d 个）" % (cat, len(its)))
    for u, n in its:
        print("  %-28s %s" % (u, n))
print("\n总入口:", total)
