# -*- coding: utf-8 -*-
import os, urllib.request, re

for k in ['unixtime', 'hexconvert', 'hexrgb', 'px2rem']:
    p = 'application/index/view/index/%s.html' % k
    if os.path.exists(p):
        os.remove(p)
        print('已删除:', p)

r = urllib.request.urlopen('http://127.0.0.1:18080/convert/', timeout=10)
html = r.read().decode('utf-8', 'ignore')
print('状态: 200, 大小:', len(html))
tabs = re.findall(r'class="t-tab[^"]*" data-panel="(\w+)"', html)
print('tabs:', len(tabs), tabs)
ids = ['utNow', 'utTsInput', 'utDateInput', 'utWorldTable', 'utClockTime', 'hexInput', 'hexInp', 'rgbInp', 'pickColor', 'hueSlider', 'paletteGrid', 'rmContent', 'rmRem']
missing = [i for i in ids if ('id="%s"' % i) not in html]
print('缺失 ID:', missing if missing else '无')
for old in ['unixtime', 'hexconvert', 'hexrgb', 'px2rem']:
    try:
        urllib.request.urlopen('http://127.0.0.1:18080/%s/' % old, timeout=10)
        print('旧页 /%s/: 200' % old)
    except Exception as e:
        print('旧页 /%s/: %s' % (old, getattr(e, 'code', 'ERR')))
