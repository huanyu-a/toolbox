# -*- coding: utf-8 -*-
"""提取 html2ubb up() 剩余部分"""
src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\html2ubb.html', encoding='utf-8').read()
i = src.find('function up(')
j = src.find('function needInput', i)
print(src[i:j][3500:5500])
