# -*- coding: utf-8 -*-
"""提取 html2ubb up() 尾部（color/url/img/email 等）"""
src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\html2ubb.html', encoding='utf-8').read()
i = src.find('function up(')
seg = src[i:i+5600]
# 从 color 之后打印
k = seg.find('color=([^')
print(seg[k:k+2000])
