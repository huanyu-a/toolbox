# -*- coding: utf-8 -*-
"""验证 format.html（子代理产出）"""
import re, subprocess, os, tempfile

src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\format.html', encoding='utf-8').read()
print('size:', len(src))
scripts = re.findall(r'<script>(.*?)</script>', src, re.S)
print('inline scripts:', len(scripts))
ok = True
for i, code in enumerate(scripts):
    p = os.path.join(tempfile.gettempdir(), 'fmt_%d.js' % i)
    open(p, 'w', encoding='utf-8').write(code)
    r = subprocess.run(['node', '--check', p], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print('script#%d FAIL: %s' % (i, r.stderr.strip()[:300]))
    os.remove(p)
refs = re.findall(r'src="/static/([\w.\-/]+\.js)"', src)
print('refs:', refs)
# 违禁检查
for pat in ['tool.js', 'hightout.js', 'setJS(', 'onclick=', 'data-clipboard-target', 'form-horizontal', 'form-control', 'btn btn-', 'col10main']:
    hits = src.count(pat)
    if hits:
        print('FORBIDDEN %r x%d' % (pat, hits))
print('ALL OK' if ok else 'HAS FAILURES')
