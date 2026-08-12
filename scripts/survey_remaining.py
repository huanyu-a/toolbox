# -*- coding: utf-8 -*-
import os, re

BASE = os.path.join(os.path.dirname(__file__), "..", "application", "index", "view", "index")
DONE = {'ascii','base64','hexconvert','json','md5','random','unixtime','urlcode',
        'guid','uuid','password','ip2long','shaencrypt','htmlescape','utf8','unicode',
        'subnetmask','formatfilter','index','editor','autoformat',
        'urlencode','escape','urlthunder','navtiveunicode'}

rows = []
for f in sorted(os.listdir(BASE)):
    name = f[:-5]
    if not f.endswith('.html') or name in DONE:
        continue
    src = open(os.path.join(BASE, f), encoding='utf-8').read()
    pcjs = sorted(set(re.findall(r'pcjs/([\w.\-]+\.js)', src)))
    other = sorted(set(re.findall(r'src="(/static/script/(?!pcjs/)[\w.\-/]+\.js)"', src)))
    onclick = len(re.findall(r'on(?:click|keyup|change|submit|mouseover|focus|blur)="', src))
    oldcls = len(re.findall(r'(form-horizontal|btn btn-|form-control|col-sm-|accordion|nav-tabs)', src))
    size = len(src)
    rows.append((len(pcjs), size, name, pcjs, other, onclick, oldcls))

rows.sort(key=lambda r: (r[0], r[1]))
for r in rows:
    print('%s %6d pcjs=%s other=%s onclick=%d oldcls=%d' % (r[2], r[1], r[3], r[4], r[5], r[6]))
print('total remaining:', len(rows))
