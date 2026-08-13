# -*- coding: utf-8 -*-
"""批量导出文本转换组页面的 body + 内联 JS + 外部脚本引用"""
import os, re, io, sys

BASE = 'application/index/view/index'
pages = ['jianfan', 'pinyin', 'huoxingwen', 'shupai', 'textflip',
         'wenzitexiao', 'quanbaojiao', 'capital', 'rmbdaxie', 'zipstringtext']

out = io.open('scripts/_text_dump.txt', 'w', encoding='utf-8')
for p in pages:
    path = os.path.join(BASE, p + '.html')
    if not os.path.exists(path):
        out.write('===== %s: MISSING =====\n' % p)
        continue
    src = open(path, encoding='utf-8').read()
    out.write('===== %s (%d B) =====\n' % (p, len(src)))
    # 外部脚本
    exts = re.findall(r'<script[^>]+src="([^"]+)"', src)
    out.write('EXT: %s\n' % exts)
    # body 内容（去掉 include）
    m = re.search(r'<body>(.*)</body>', src, re.S)
    if m:
        body = m.group(1)
        # 去掉 script src 标签
        body = re.sub(r'<script[^>]+src="[^"]+"[^>]*>\s*</script>', '', body)
        out.write('BODY:\n%s\n' % body)
    # 内联 JS
    for i, js in enumerate(re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)):
        js = js.strip()
        if js:
            out.write('--- JS#%d (%d B) ---\n%s\n' % (i, len(js), js))
    out.write('\n')
out.close()
print('done')
