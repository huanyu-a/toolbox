# -*- coding: utf-8 -*-
"""提取 asciicode.html 与 htmlescapechar.html 表格数据"""
import re

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

src = open(BASE + r'\asciicode.html', encoding='utf-8').read()
print('asciicode size:', len(src))
# 找 table 行
rows = re.findall(r'<tr[^>]*>(.*?)</tr>', src, re.S)
print('tr count:', len(rows))
for r in rows[:6]:
    cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
    print('  ', [re.sub(r'<[^>]+>', '', c).strip()[:20] for c in cells])
print('...')
for r in rows[-3:]:
    cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
    print('  ', [re.sub(r'<[^>]+>', '', c).strip()[:20] for c in cells])

print()
src2 = open(BASE + r'\htmlescapechar.html', encoding='utf-8').read()
print('htmlescapechar size:', len(src2))
rows2 = re.findall(r'<tr[^>]*>(.*?)</tr>', src2, re.S)
print('tr count:', len(rows2))
for r in rows2[:6]:
    cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
    print('  ', [re.sub(r'<[^>]+>', '', c).strip()[:20] for c in cells])
print('...')
for r in rows2[-3:]:
    cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
    print('  ', [re.sub(r'<[^>]+>', '', c).strip()[:20] for c in cells])
