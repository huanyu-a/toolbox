# -*- coding: utf-8 -*-
import re
src = open('public/static/script/jsformat/jsendecode.js', encoding='utf-8', errors='ignore').read()
i = src.find('$("#BtnAddEval")')
print('--- 绑定块 ---')
print(src[i:i+2200])
print()
# 是否定义 pcjson_com_msg / ClearAll
print('定义 pcjson_com_msg:', 'function pcjson_com_msg' in src)
print('定义 ClearAll:', 'function ClearAll' in src)
# result 写入方式
for m in re.finditer(r'\$\("#result"\)[^;]*;', src):
    print('result 操作:', m.group(0)[:80])
