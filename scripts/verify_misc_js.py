# -*- coding: utf-8 -*-
"""验证 textconvert + encode 的 JS 语法"""
import re, subprocess, tempfile, os

for p in ['application/index/view/index/textconvert.html', 'application/index/view/index/encode.html']:
    src = open(p, encoding='utf-8').read()
    jss = re.findall(r'<script>(.*?)</script>', src, re.S)
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
            print('  %s JS#%d: FAIL %s' % (os.path.basename(p), i, r.stderr[:200]))
    ctrl = [c for c in src if ord(c) < 9 or (13 < ord(c) < 32)]
    print('%s: %d script 块, %s, 控制字符 %d' % (os.path.basename(p), len(jss), 'OK' if ok else 'FAIL', len(ctrl)))
