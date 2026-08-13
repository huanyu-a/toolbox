# -*- coding: utf-8 -*-
"""web.php：删除 4 个旧数值转换块，插入 convert 块"""
import re

path = 'config/web.php'
src = open(path, encoding='utf-8').read()
orig_len = len(src)

keys = ['unixtime', 'hexconvert', 'hexrgb', 'px2rem']

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
    'convert' => array (
        'title' => '数值转换,时间戳/进制/颜色/rem转换-在线工具箱',
        'keywords' => '数值转换,时间戳转换,Unix时间戳,世界时间,在线时钟,进制转换,二进制,八进制,十六进制,颜色转换,HEX,RGB,调色板,rem转换,px转换',
        'description' => '数值与单位转换工具合集：Unix 时间戳与日期互转、世界主要城市实时时间、在线时钟、二进制/八进制/十进制/十六进制互转、HEX 与 RGB 颜色互转及调色板、rem/px 转换，全部在浏览器本地完成。',
    ),'''

m = re.search(r"'texttool'\s*=>\s*array\s*\(", src)
if m:
    r = find_block(src, 'texttool')
    if r:
        ins = r[1]
        src = src[:ins] + new_block + src[ins:]
        print('已插入 convert 块')
else:
    print('!! 未找到 texttool 块')

open(path, 'w', encoding='utf-8').write(src)
print('web.php: %d -> %d 字节' % (orig_len, len(src)))
bad = re.findall(r'\)\n\s*\'[a-z]', src)
print('可疑缺逗号:', len(bad))
