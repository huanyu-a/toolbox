# -*- coding: utf-8 -*-
"""验证 dns.html"""
import re, subprocess, os, tempfile

src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\dns.html', encoding='utf-8').read()
scripts = re.findall(r'<script>(.*?)</script>', src, re.S)
ok = True
for i, code in enumerate(scripts):
    p = os.path.join(tempfile.gettempdir(), 'dns_%d.js' % i)
    open(p, 'w', encoding='utf-8').write(code)
    r = subprocess.run(['node', '--check', p], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print('script#%d FAIL: %s' % (i, r.stderr.strip()[:300]))
    os.remove(p)
print('scripts:', len(scripts), '| panels:', len(re.findall(r'id="panel-', src)), '| tabs:', len(re.findall(r'class="t-tab"', src)))
print('ALL OK' if ok else 'HAS FAILURES')
