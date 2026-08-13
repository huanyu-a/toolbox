# -*- coding: utf-8 -*-
"""查看 keyboardtest.html body"""
src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\keyboardtest.html', encoding='utf-8').read()
i = src.find('<div class="container"')
print(src[i:i+2500] if i > 0 else src[:2000])
