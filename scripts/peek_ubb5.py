# -*- coding: utf-8 -*-
"""提取 html2ubb up() 完整"""
src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\html2ubb.html', encoding='utf-8').read()
i = src.find('function up(')
j = src.find('});', i)  # 大致结束
seg = src[i:i+4500]
print(seg)
