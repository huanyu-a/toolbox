# -*- coding: utf-8 -*-
import re
for p in ['htmlescape', 'checkkeyword']:
    src = open('application/index/view/index/%s.html' % p, encoding='utf-8').read()
    print('=====', p, '=====')
    exts = re.findall(r'<script[^>]+src="([^"]+)"', src)
    print('EXT:', exts)
    # 找所有 script 块（含空的）
    jss = re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)
    for i, js in enumerate(jss):
        js = js.strip()
        if js:
            print('JS#%d (%dB):' % (i, len(js)))
            print(js[:2500])
    print()
