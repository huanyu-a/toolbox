# -*- coding: utf-8 -*-
"""提取 calctemperature 细节"""
import re

src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\calctemperature.html', encoding='utf-8').read()
print('scripts:', re.findall(r'src="/static/script/([\w.\-/]+\.js)"', src))
m = re.search(r'var bs=\[([^\]]+)\]', src)
print('bs:', m.group(1) if m else 'NONE')
units = re.findall(r'<span>([^<]+)</span><span class="mathunit">([^<]*)</span>', src)
print('units:', units)
