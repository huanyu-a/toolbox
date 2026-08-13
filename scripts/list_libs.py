# -*- coding: utf-8 -*-
"""盘点 static/script 下的库文件（重点：json/加密/编码相关）"""
import os

ROOT = r'C:\project\wwwroot\toolbox\public\static\script'

def walk(d, prefix=''):
    out = []
    for f in sorted(os.listdir(d)):
        p = os.path.join(d, f)
        if os.path.isdir(p):
            out.extend(walk(p, prefix + f + '/'))
        else:
            sz = os.path.getsize(p)
            out.append((prefix + f, sz))
    return out

files = walk(ROOT)
print('total files:', len(files))
# 按目录分组展示
from collections import defaultdict
groups = defaultdict(list)
for name, sz in files:
    d = name.rsplit('/', 1)[0] if '/' in name else '(root)'
    groups[d].append((name, sz))

for d in sorted(groups):
    print('\n== %s (%d files) ==' % (d, len(groups[d])))
    for name, sz in groups[d]:
        print('  %-60s %d' % (name, sz))
