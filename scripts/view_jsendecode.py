# -*- coding: utf-8 -*-
import re
src = open('public/static/script/jsformat/jsendecode.js', encoding='utf-8', errors='ignore').read()
# 找 function encode / decode / doConfusion
for name in ['function encode', 'function decode', 'function doConfusion', 'function num']:
    i = src.find(name)
    if i >= 0:
        print('=====', name, '=====')
        print(src[i:i+1800])
        print()
# pcjson_com_msg 引用
for m in re.finditer(r'pcjson_com_msg[^;]*;', src):
    print('pcjson 调用:', m.group(0)[:100])
