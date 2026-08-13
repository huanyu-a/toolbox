# -*- coding: utf-8 -*-
import re, io
src = open('application/index/view/index/camelcase.html', encoding='utf-8').read()
jss = re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)
for i, js in enumerate(jss):
    js = js.strip()
    if 'btnToCamel' in js:
        io.open('scripts/_camel_js.txt', 'w', encoding='utf-8').write(js)
        print('已提取 JS#%d: %d B' % (i, len(js)))
        break
