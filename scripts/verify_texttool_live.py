# -*- coding: utf-8 -*-
import urllib.request, re
r = urllib.request.urlopen('http://127.0.0.1:18080/texttool/', timeout=10)
html = r.read().decode('utf-8', 'ignore')
print('状态: 200, 大小:', len(html))
tabs = re.findall(r'class="t-tab[^"]*" data-panel="(\w+)"', html)
print('tabs:', len(tabs), tabs)
ids = ['tcInput', 'uqInput', 'rpInput', 'zpInput', 'tdBase', 'tdNew', 'tdOutput']
missing = [i for i in ids if ('id="%s"' % i) not in html]
print('缺失 ID:', missing if missing else '无')
for lib in ['txtdifflib.js', 'txtdiffview.js']:
    print('含 %s:' % lib, lib in html)
for old in ['txtcount', 'quchong', 'txtreplace', 'zipstringtext', 'textdiff']:
    try:
        urllib.request.urlopen('http://127.0.0.1:18080/%s/' % old, timeout=10)
        print('旧页 /%s/: 200' % old)
    except Exception as e:
        print('旧页 /%s/: %s' % (old, getattr(e, 'code', 'ERR')))
