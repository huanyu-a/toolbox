# -*- coding: utf-8 -*-
import re
for name in ['allencrypt', 'md5', 'shaencrypt', 'aesencrypt', 'desencrypt', 'rc4encrypt', 'rabbitencrypt', 'tripledes']:
    src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\%s.html' % name, encoding='utf-8').read()
    m = re.findall(r'setJS\(\[([^\]]+)\]\)', src)
    libs = re.findall(r'src="(/static/script/[\w.\-/]+\.js)"', src)
    print('%-14s setJS=%s libs=%s' % (name, m, [l for l in libs if 'jquery' not in l and 'bootstrap' not in l and 'app.js' not in l]))
