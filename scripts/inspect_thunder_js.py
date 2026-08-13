# -*- coding: utf-8 -*-
"""查看 urlthunder 内联 JS 的函数定义与事件绑定"""
import re

src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\urlthunder.html", encoding="utf-8").read()
blocks = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
js = blocks[-1]

# 找函数定义
funcs = re.findall(r"function\s+(\w+)\s*\(", js)
print("函数:", funcs)

# 找 addEventListener / onclick / DOMContentLoaded
binds = re.findall(r"(getElementById\('[^']+'\)\.(?:addEventListener|onclick)|window\.onload|DOMContentLoaded)[^\n]{0,80}", js)
print("\n绑定方式:")
for b in binds[:20]:
    print("  ", b)

# 找表变量名
for v in ["URLTHUNDER_UNICODE_CHR", "URLTHUNDER_ANSI_CHR"]:
    print(f"\n{v} 长度:", len(re.search(v + r"\s*=\s*'([^']*)'", js).group(1)) if re.search(v + r"\s*=\s*'([^']*)'", js) else "N/A")

# 打印 JS 尾部 2500 字符（函数+绑定部分）
print("\n=== JS 尾部 ===")
print(js[-2500:])
