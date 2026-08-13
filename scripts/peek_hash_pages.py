# -*- coding: utf-8 -*-
import re
for name in ['md5', 'shaencrypt', 'allencrypt']:
    src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\%s.html' % name, encoding='utf-8').read()
    m = re.search(r'<h2[^>]*>(.*?)</h2>', src, re.S)
    h2 = re.sub(r'<[^>]+>', '', m.group(1)).strip() if m else ''
    btns = re.findall(r'<button[^>]*>(.*?)</button>', src, re.S)
    btns = [re.sub(r'<[^>]+>', '', b).strip()[:16] for b in btns][:10]
    labels = re.findall(r'<label[^>]*>(.*?)</label>', src, re.S)
    labels = [re.sub(r'<[^>]+>', '', l).strip()[:30] for l in labels][:6]
    ids = re.findall(r'id="([^"]+)"', src)[:12]
    print('=== %s (%s) ===' % (name, h2))
    print('  labels:', labels)
    print('  btns:', btns)
    print('  ids:', ids)
    print()
