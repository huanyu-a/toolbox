# -*- coding: utf-8 -*-
"""查看 allencrypt.js 中部（MD5/RIPEMD/SHA3 分支）"""
src = open(r'C:\project\wwwroot\toolbox\public\static\script\encrypt\allencrypt.js', encoding='utf-8').read()
for kw in ['case "MD5"', 'case "RIPEMD160"', 'case "SHA3"', 'function sha512']:
    i = src.find(kw)
    if i >= 0:
        print('---', kw, '---')
        print(src[i:i+420])
        print()
