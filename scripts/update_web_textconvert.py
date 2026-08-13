# -*- coding: utf-8 -*-
"""web.php：删除 9 个旧文本转换块，插入 textconvert 块（修正版：不误吃前块逗号）"""
import re

path = 'config/web.php'
src = open(path, encoding='utf-8').read()
orig_len = len(src)

keys = ['jianfan', 'pinyin', 'huoxingwen', 'shupai', 'textflip',
        'wenzitexiao', 'quanbaojiao', 'capital', 'rmbdaxie']

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

# 反向删除：只吃空白，不吃逗号（保留前块结尾逗号）
blocks.sort(key=lambda x: x[1][0])
for key, (a, b) in reversed(blocks):
    a2 = a
    while a2 > 0 and src[a2-1] in ' \t\n':
        a2 -= 1
    src = src[:a2] + src[b:]

print('删除后大小:', len(src))

# 插入 textconvert 块（在 encrypt 块后，前面补逗号）
new_block = '''
    'textconvert' => array (
        'title' => '文本转换工具,简繁转换/汉字拼音/火星文/竖排翻转/人民币大写-在线工具箱',
        'keywords' => '文本转换,简繁转换,繁体字转换,汉字转拼音,火星文转换,文字竖排,文字翻转,文字特效,全角半角转换,英文大小写转换,人民币大写',
        'description' => '文本转换在线工具合集，提供简体繁体互转、汉字转拼音及读音、火星文转换、文字竖排、文字翻转、彩色文字特效、全角半角互转、英文大小写转换、人民币大写金额转换等功能，全部在浏览器本地完成。',
    ),'''

m = re.search(r"'encrypt'\s*=>\s*array\s*\(", src)
if m:
    r = find_block(src, 'encrypt')
    if r:
        ins = r[1]
        src = src[:ins] + ',' + new_block + src[ins:]
        print('已插入 textconvert 块')
else:
    print('!! 未找到 encrypt 块')

open(path, 'w', encoding='utf-8').write(src)
print('web.php: %d -> %d 字节' % (orig_len, len(src)))

# 语法自检：所有块结束 ')' 后紧跟 "'" 的位置（缺逗号）
bad = re.findall(r'\)\n\s*\'[a-z]', src)
print('可疑缺逗号位置:', len(bad))
for b in bad[:5]:
    print('  ->', b[:40])
