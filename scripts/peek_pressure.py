# -*- coding: utf-8 -*-
"""检查 calcpressure 单位与 bs 对应"""
import re

src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\calcpressure.html', encoding='utf-8').read()
units = re.findall(r'<span>([^<]+)</span><span class="mathunit">([^<]*)</span>', src)
m = re.search(r'var bs=\[([^\]]+)\]', src)
bs = m.group(1).split(',') if m else []
print('units count:', len(units))
print('bs count:', len(bs))
for i, (u, uu) in enumerate(units):
    b = bs[i] if i < len(bs) else '?'
    print('%2d %-10s %-12s bs=%s' % (i, u, uu, b))
if len(bs) > len(units):
    print('extra bs:', bs[len(units):])
