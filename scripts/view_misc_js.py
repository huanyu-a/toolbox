# -*- coding: utf-8 -*-
import re
for p in ['camelcase', 'htmlescape', 'checkkeyword']:
    src = open('application/index/view/index/%s.html' % p, encoding='utf-8').read()
    print('=====', p, '=====')
    for i, js in enumerate(re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)):
        js = js.strip()
        if js and 'function' in js:
            funcs = re.findall(r'function\s+(\w+)', js)
            ids = re.findall(r'getElementById\(["\']([\w-]+)["\']\)', js)
            print('  JS#%d (%dB) funcs=%s ids=%s' % (i, len(js), funcs[:8], ids))
            if len(js) < 4000:
                print(js[:3500])
    print()
