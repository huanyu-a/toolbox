# -*- coding: utf-8 -*-
import re
src = open('application/index/view/index/checkkeyword.html', encoding='utf-8').read()
m = re.search(r'<body>(.*)</body>', src, re.S)
body = m.group(1)
body2 = re.sub(r'<script[^>]+src="[^"]+"[^>]*>\s*</script>', '', body)
print(body2[:4000])
print('--- 内联 JS 全量 ---')
for i, js in enumerate(re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)):
    js = js.strip()
    if js:
        print('JS#%d (%dB):' % (i, len(js)))
        print(js[:5000])
