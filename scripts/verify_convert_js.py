# -*- coding: utf-8 -*-
"""验证 convert 页面 JS 语法 + 控制字符"""
import re, subprocess, tempfile, os

src = open('application/index/view/index/convert.html', encoding='utf-8').read()
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
    print('  JS#%d: %s' % (i, 'OK' if r.returncode == 0 else 'FAIL ' + r.stderr[:300]))

ctrl = [c for c in src if ord(c) < 9 or (13 < ord(c) < 32)]
print('控制字符:', len(ctrl), '无' if not ctrl else [hex(ord(c)) for c in ctrl][:10])

# 检查关键转义是否被 Python 吃成真实字符
checks = {
    'utFmt 换行转义': '\\\\nUTC' in src,
    'rem \\s 转义': '\\\\s*([\\\\{\\\\}\\\\:\\\\;\\\\,])' in src,
    'rgb \\d 转义': '^\\\\d+$' in src,
    'rmRound \\\\. 转义': '\\\\.$' in src,
}
for k, v in checks.items():
    print(k, ':', v)
