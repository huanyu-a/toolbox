# -*- coding: utf-8 -*-
"""验证 texttool 内联 JS 语法（含转义检查）"""
import re, subprocess, tempfile, os

src = open('application/index/view/index/texttool.html', encoding='utf-8').read()
jss = re.findall(r'<script>(.*?)</script>', src, re.S)
print('内联 script 块:', len(jss))
ok = True
for i, js in enumerate(jss):
    if not js.strip():
        continue
    with tempfile.NamedTemporaryFile('w', suffix='.js', delete=False, encoding='utf-8') as f:
        f.write(js)
        tmp = f.name
    r = subprocess.run(['node', '--check', tmp], capture_output=True, text=True)
    os.unlink(tmp)
    if r.returncode != 0:
        ok = False
        print('  JS#%d: FAIL %s' % (i, r.stderr[:300]))
    else:
        print('  JS#%d: OK' % i)

# 检查真实控制字符是否混入 JS
ctrl = [c for c in src if ord(c) < 9 or (13 < ord(c) < 32)]
print('控制字符:', len(ctrl), [hex(ord(c)) for c in ctrl][:10] if ctrl else '无')
