# -*- coding: utf-8 -*-
"""提取 html2ubb pattern/up 完整算法 + htmltable 页面结构"""
import re, os

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

src = open(os.path.join(BASE, 'html2ubb.html'), encoding='utf-8').read()
i = src.find('function pattern(str)')
j = src.find('</script>', i)
print('=== html2ubb pattern+up ===')
print(src[i:j][:5000])
