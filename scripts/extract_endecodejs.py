# -*- coding: utf-8 -*-
import re
src = open('application/index/view/index/endecodejs.html', encoding='utf-8').read()
jss = re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)
for i, js in enumerate(jss):
    js = js.strip()
    print('JS#%d: %d B, 含 getElementById: %s, 含 function: %s' % (
        i, len(js), js.count('getElementById'), js.count('function')))
    if js:
        print(js[:400])
        print('...')
        print()
