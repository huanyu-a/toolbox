# -*- coding: utf-8 -*-
import re
for f in ['jsformat/jsformat.js', 'jsformat/formatjs.js', 'jsformat/jsendecode.js']:
    src = open('public/static/script/' + f, encoding='utf-8', errors='ignore').read()
    funcs = re.findall(r'function\s+([A-Za-z_$][\w$]*)\s*\(', src)
    ids = re.findall(r'getElementById\(["\']([^"\']+)["\']\)', src)
    jq = re.findall(r'\$\("#([\w-]+)"\)', src)
    print('=====', f, len(src), 'B')
    print('FUNCS:', sorted(set(funcs))[:25])
    print('DOM:', sorted(set(ids)))
    print('JQ:', sorted(set(jq)))
    print()
    # jsendecode.js 完整（短的话）
    if f == 'jsformat/jsendecode.js':
        print(src[:3000])
