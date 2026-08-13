# -*- coding: utf-8 -*-
"""验证 jsencrypt 页面"""
import re, subprocess, tempfile, os

src = open('application/index/view/index/jsencrypt.html', encoding='utf-8').read()
# 检查 script 块数量
blocks = re.findall(r'<script>(.*?)</script>', src, re.S)
print('内联 script 块:', len(blocks))
for i, js in enumerate(blocks):
    if not js.strip():
        continue
    with tempfile.NamedTemporaryFile('w', suffix='.js', delete=False, encoding='utf-8') as f:
        f.write(js)
        tmp = f.name
    r = subprocess.run(['node', '--check', tmp], capture_output=True, text=True)
    os.unlink(tmp)
    print('  JS#%d (%dB): %s' % (i, len(js), 'OK' if r.returncode == 0 else 'FAIL ' + r.stderr[:200]))
ctrl = [c for c in src if ord(c) < 9 or (13 < ord(c) < 32)]
print('控制字符:', len(ctrl), '无' if not ctrl else [hex(ord(c)) for c in ctrl][:10])
print('含 jsInput:', 'id="jsInput"' in src)
print('含 content/result/BtnCon:', all(x in src for x in ['id="content"', 'id="result"', 'id="BtnCon"']))
