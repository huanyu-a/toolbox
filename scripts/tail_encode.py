# -*- coding: utf-8 -*-
import re
src = open('application/index/view/index/encode.html', encoding='utf-8').read()
tails = re.findall(r'\{include file="[^"]+" /\}', src)
print('TAILS:', tails)
# include 位置
i = src.rfind('{include file="nav" /}')
print('NAV CONTEXT:')
print(src[i-500:i+700])
