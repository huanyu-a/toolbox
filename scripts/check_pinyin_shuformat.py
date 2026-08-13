# -*- coding: utf-8 -*-
"""查看 toPinyin / shuformat 纯函数接口"""
import re

src2 = open(r"C:\project\wwwroot\toolbox\public\static\script\pcjs\pinyin.js", encoding="utf-8", errors="ignore").read()
i = src2.find("function toPinyin")
print("=== toPinyin ===")
print(src2[i:i+500] if i > 0 else "N/A")

src3 = open(r"C:\project\wwwroot\toolbox\public\static\script\pcjs\shuformat.js", encoding="utf-8", errors="ignore").read()
# 找函数
funcs = re.findall(r"function\s+(\w+)\s*\(", src3)
print("\nshuformat 函数:", funcs)
# 找 onclick 绑定
binds = re.findall(r'getElementById\(\'(\w+)\'\)[^;]{0,60}', src3)
print("DOM 绑定:", binds[:20])
# 找按钮绑定
for m in re.finditer(r"(onclick|addEventListener)[^;]{0,100}", src3):
    print("  ", m.group(0)[:110])
