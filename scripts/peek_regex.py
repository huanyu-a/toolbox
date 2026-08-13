# -*- coding: utf-8 -*-
"""提取 regexdso（常用正则）与 regexsucha（语法速查）表格"""
import re, os

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

for name in ['regexdso', 'regexsucha']:
    src = open(os.path.join(BASE, name + '.html'), encoding='utf-8').read()
    print('=== %s (%d) ===' % (name, len(src)))
    rows = re.findall(r'<tr[^>]*>(.*?)</tr>', src, re.S)
    print('tr:', len(rows))
    for r in rows[:8]:
        cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
        cells = [re.sub(r'<[^>]+>', '', c).strip()[:26] for c in cells]
        print('  ', cells)
    print('  ...')
    for r in rows[-3:]:
        cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
        cells = [re.sub(r'<[^>]+>', '', c).strip()[:26] for c in cells]
        print('  ', cells)
