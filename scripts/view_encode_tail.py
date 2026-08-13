# -*- coding: utf-8 -*-
src = open('application/index/view/index/encode.html', encoding='utf-8').read()
i = src.find('id="encImg"')
# 找 encImg 面板的闭合：面板是 <div id="encImg" ...> ... </div>，之后是 </div>(tool-card) </div>(tool-wrap) </div>(container)
# 找 encImg 之后的 include nav
k = src.find('{include file="nav"', i)
print('nav include 位置:', k)
print(repr(src[k-300:k+50]))
