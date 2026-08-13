# -*- coding: utf-8 -*-
"""验证 textconvert 内联 JS 语法 + 首页旧链接引用检查"""
import re, subprocess, tempfile, os

src = open('application/index/view/index/textconvert.html', encoding='utf-8').read()

# 1. 提取内联 script（排除 src 引入的）
jss = re.findall(r'<script>(.*?)</script>', src, re.S)
print('内联 script 块:', len(jss))
for i, js in enumerate(jss):
    if not js.strip():
        continue
    with tempfile.NamedTemporaryFile('w', suffix='.js', delete=False, encoding='utf-8') as f:
        f.write(js)
        tmp = f.name
    r = subprocess.run(['node', '--check', tmp], capture_output=True, text=True)
    os.unlink(tmp)
    print('  JS#%d: %s' % (i, 'OK' if r.returncode == 0 else 'FAIL ' + r.stderr[:200]))

# 2. 首页及全站 html 引用检查
old = ['jianfan', 'pinyin', 'huoxingwen', 'shupai', 'textflip',
       'wenzitexiao', 'quanbaojiao', 'capital', 'rmbdaxie']
import os
for root, dirs, files in os.walk('application'):
    for f in files:
        if not f.endswith('.html'):
            continue
        p = os.path.join(root, f)
        s = open(p, encoding='utf-8', errors='ignore').read()
        for k in old:
            for m in re.finditer(r'/(%s)/' % k, s):
                print('引用:', p, '->', k, 'at', m.start())
print('引用检查完成')

# 3. 首页热门区关键词检查
idx = open('application/index/view/index/index.html', encoding='utf-8').read()
for kw in ['简繁', '拼音', '火星文', '竖排', '翻转', '特效', '全角', '大小写', '人民币']:
    print('首页含', kw, ':', kw in idx)
