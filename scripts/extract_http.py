# -*- coding: utf-8 -*-
"""提取 httpheader / requestmethod / webstatus 表格"""
import re, os, html as htmlmod

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

for name in ['httpheader', 'requestmethod', 'webstatus', 'pagecode']:
    src = open(os.path.join(BASE, name + '.html'), encoding='utf-8').read()
    rows = re.findall(r'<tr[^>]*>(.*?)</tr>', src, re.S)
    print('=== %s (%d tr) ===' % (name, len(rows)))
    n = 0
    for r in rows[:8]:
        cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
        cells = [re.sub(r'<[^>]+>', '', c).strip()[:24] for c in cells]
        print('  ', cells)
        n += 1
        if n >= 6: break
    print('   ...')
    for r in rows[-2:]:
        cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
        cells = [re.sub(r'<[^>]+>', '', c).strip()[:24] for c in cells]
        print('  ', cells)
