# -*- coding: utf-8 -*-
"""查看 webstatus.html body 结构"""
import re

src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\webstatus.html', encoding='utf-8').read()
i = src.find('<div class="container"')
print('container idx:', i)
print(src[i:i+2000] if i > 0 else 'no container')
