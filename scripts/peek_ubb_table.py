# -*- coding: utf-8 -*-
"""提取 html2ubb 内联脚本 + htmltable.js + csv2table.js"""
import re, os

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'
UB = r'C:\project\wwwroot\toolbox\public\static\script'

src = open(os.path.join(BASE, 'html2ubb.html'), encoding='utf-8').read()
scripts = re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)
for s in scripts:
    if 'pattern' in s or 'function' in s:
        print('=== html2ubb inline ===')
        print(s[:4000])
        break

print()
print('=== htmltable.js ===')
print(open(os.path.join(UB, 'pcjs', 'htmltable.js'), encoding='utf-8').read()[:1500])

print()
print('=== csv2table.js ===')
print(open(os.path.join(UB, 'pcjs', 'csv2table.js'), encoding='utf-8').read()[:1500])
