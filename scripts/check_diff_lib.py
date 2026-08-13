# -*- coding: utf-8 -*-
import re
for f in ['txtdiffview.js', 'txtdifflib.js', 'textdiff.js']:
    src = open('public/static/script/pcjs/' + f, encoding='utf-8', errors='ignore').read()
    funcs = re.findall(r'function\s+([A-Za-z_$][\w$]*)\s*\(', src)
    ids = re.findall(r'getElementById\(["\']([^"\']+)["\']\)', src)
    jq = re.findall(r'\$\("#([\w-]+)"\)', src)
    print('=====', f, len(src), 'B')
    print('FUNCS:', sorted(set(funcs))[:20])
    print('DOM:', sorted(set(ids)))
    print('JQ:', sorted(set(jq)))
    print()
    # textdiff.js 全文（短）
    if f == 'textdiff.js':
        print(src[:2500])
