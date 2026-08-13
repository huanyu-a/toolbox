# -*- coding: utf-8 -*-
"""提取 keyboardtest.html 的 style / layout / script"""
import re

src = open(r'C:\project\wwwroot\toolbox\application\index\view\index\keyboardtest.html', encoding='utf-8').read()

# style
styles = re.findall(r'<style[^>]*>(.*?)</style>', src, re.S)
print('styles:', len(styles))
for s in styles:
    print(s[:800])
    print('---')

# layout div
i = src.find('id="anjian_test"')
j = src.find('anjian_test"', i + 10)  # 找结束（粗略）
# 找 anjian_test 外层 div 结束：匹配到 </div></div> 附近，先取足够长
i0 = src.find('<div id="anjian_test">')
seg = src[i0:i0+300]
print('anjian_test starts:', seg[:200])

# scripts
scripts = re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)
print('scripts:', len(scripts))
for s in scripts:
    if 'anjian' in s or 'key' in s.lower() or 'btn' in s:
        print('KEY SCRIPT:', s[:1500])
        print('---')
