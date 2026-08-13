# -*- coding: utf-8 -*-
"""提取 html2ubb up() UBB->HTML 函数"""
import re

src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\html2ubb.html', encoding='utf-8').read()
i = src.find('function up(')
j = src.find('</script>', i)
if i >= 0:
    print(src[i:j][:4000])
else:
    # 找 ubb 还原部分
    for kw in ['\[url=', 'up(str', 'ubb2html', 'toHtml']:
        k = src.find(kw)
        if k >= 0:
            print('found', kw, 'at', k)
            print(src[max(0, k-500):k+1500])
            break
