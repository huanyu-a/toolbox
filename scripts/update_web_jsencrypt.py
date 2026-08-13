# -*- coding: utf-8 -*-
"""web.php：删除 endecodejs/confundirjs 块，插入 jsencrypt 块"""
import re

path = 'config/web.php'
src = open(path, encoding='utf-8').read()
orig_len = len(src)

keys = ['endecodejs', 'confundirjs']

def find_block(src, key):
    m = re.search(r"'%s'\s*=>\s*array\s*\(" % re.escape(key), src)
    if not m:
        return None
    i = src.find('(', m.start())
    depth = 0
    j = i
    while j < len(src):
        if src[j] == '(':
            depth += 1
        elif src[j] == ')':
            depth -= 1
            if depth == 0:
                k = j + 1
                while k < len(src) and src[k] in ' ,':
                    k += 1
                return m.start(), k
        j += 1
    return None

blocks = []
for key in keys:
    r = find_block(src, key)
    if r:
        blocks.append((key, r))
        print('找到块:', key)
    else:
        print('!! 未找到块:', key)

blocks.sort(key=lambda x: x[1][0])
for key, (a, b) in reversed(blocks):
    a2 = a
    while a2 > 0 and src[a2-1] in ' \t\n':
        a2 -= 1
    src = src[:a2] + src[b:]

new_block = '''
    'jsencrypt' => array (
        'title' => 'JS加密解密,JS混合加密混淆-在线工具箱',
        'keywords' => 'JS加密,JS解密,JS在线加解密,JS混淆加密,JS代码混合加密,js混合加密,javascript加密,js加密解密工具',
        'description' => 'JS 加密解密在线工具：提供 Packer 式 JS 代码加密与解密、JS 代码混合加密（变量名混淆）等功能，全部在浏览器本地完成，支持在线加密、在线解密、在线混淆。',
    ),'''

m = re.search(r"'convert'\s*=>\s*array\s*\(", src)
if m:
    r = find_block(src, 'convert')
    if r:
        ins = r[1]
        src = src[:ins] + new_block + src[ins:]
        print('已插入 jsencrypt 块')
else:
    print('!! 未找到 convert 块')

open(path, 'w', encoding='utf-8').write(src)
print('web.php: %d -> %d 字节' % (orig_len, len(src)))
bad = re.findall(r'\)\n\s*\'[a-z]', src)
print('可疑缺逗号:', len(bad))
