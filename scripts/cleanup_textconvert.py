# -*- coding: utf-8 -*-
"""扫描旧文本转换页面的引用 + 删除旧模板"""
import os, re

old = ['jianfan', 'pinyin', 'huoxingwen', 'shupai', 'textflip',
       'wenzitexiao', 'quanbaojiao', 'capital', 'rmbdaxie']

# 扫描引用（排除 js 库目录）
hits = {}
for root, dirs, files in os.walk('application'):
    for f in files:
        if not f.endswith('.html'):
            continue
        p = os.path.join(root, f)
        src = open(p, encoding='utf-8', errors='ignore').read()
        for key in old:
            if re.search(r'["\']/?' + key + r'/?["\']', src) or re.search(r'/(' + key + r')/', src):
                hits.setdefault(key, []).append(p)

for key in old:
    print(key, ':', hits.get(key, []))

# 删除旧模板
for key in old:
    p = 'application/index/view/index/%s.html' % key
    if os.path.exists(p):
        os.remove(p)
        print('已删除:', p)
