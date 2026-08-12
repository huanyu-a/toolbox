# -*- coding: utf-8 -*-
"""批量向工具页 head 注入 SEO 模板（seo.html include）"""
import re
import os

BASE = os.path.join(os.path.dirname(__file__), '..', 'application', 'index', 'view', 'index')
INCLUDE = '{include file="seo" /}'
ANCHOR = '</head>'

def inject(path):
    with open(path, encoding='utf-8') as f:
        c = f.read()
    if INCLUDE in c:
        return False
    if ANCHOR not in c:
        return None
    c = c.replace(ANCHOR, INCLUDE + ANCHOR)
    with open(path, 'w', encoding='utf-8') as f:
        f.write(c)
    return True

ok, skip, err = 0, 0, []
for name in os.listdir(BASE):
    if not name.endswith('.html'):
        continue
    path = os.path.join(BASE, name)
    try:
        r = inject(path)
        if r is True:
            ok += 1
        elif r is False:
            skip += 1
        else:
            err.append(name)
    except Exception as e:
        err.append('%s: %s' % (name, e))

print('注入 seo include: %d' % ok)
print('已存在跳过: %d' % skip)
print('错误: %s' % (err or '无'))
