# -*- coding: utf-8 -*-
"""扫描文本工具组页面结构"""
import os, re, io

pages = ['txtcount', 'quchong', 'txtreplace', 'zipstringtext', 'textdiff']
BASE = 'application/index/view/index'
out = io.open('scripts/_tool_dump.txt', 'w', encoding='utf-8')
for p in pages:
    path = os.path.join(BASE, p + '.html')
    src = open(path, encoding='utf-8').read()
    out.write('===== %s (%d B) =====\n' % (p, len(src)))
    exts = re.findall(r'<script[^>]+src="([^"]+)"', src)
    out.write('EXT: %s\n' % exts)
    m = re.search(r'<body>(.*)</body>', src, re.S)
    if m:
        body = m.group(1)
        body = re.sub(r'<script[^>]+src="[^"]+"[^>]*>\s*</script>', '', body)
        out.write('BODY:\n%s\n' % body)
    for i, js in enumerate(re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)):
        js = js.strip()
        if js:
            out.write('--- JS#%d (%d B) ---\n%s\n' % (i, len(js), js))
    out.write('\n')
out.close()
print('done')
