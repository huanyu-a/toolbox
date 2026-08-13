# -*- coding: utf-8 -*-
"""验证 calc.html"""
import re, subprocess, os, tempfile

src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\calc.html', encoding='utf-8').read()
scripts = re.findall(r'<script>(.*?)</script>', src, re.S)
print('inline scripts:', len(scripts))
ok = True
for i, code in enumerate(scripts):
    p = os.path.join(tempfile.gettempdir(), 'calc_%d.js' % i)
    open(p, 'w', encoding='utf-8').write(code)
    r = subprocess.run(['node', '--check', p], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print('script#%d FAIL: %s' % (i, r.stderr.strip()[:400]))
    os.remove(p)
print('panels:', src.count('class="t-panel'))
print('tab buttons:', src.count('class="t-tab'))
print('u-in inputs:', src.count('class="u-in"'))
print('ALL OK' if ok else 'HAS FAILURES')
