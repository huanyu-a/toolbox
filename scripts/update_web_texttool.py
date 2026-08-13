# -*- coding: utf-8 -*-
"""web.php：删除 5 个旧文本工具块，插入 texttool 块"""
import re

path = 'config/web.php'
src = open(path, encoding='utf-8').read()
orig_len = len(src)

keys = ['txtcount', 'quchong', 'txtreplace', 'zipstringtext', 'textdiff']

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

# 反向删除：只吃空白，不吃逗号
blocks.sort(key=lambda x: x[1][0])
for key, (a, b) in reversed(blocks):
    a2 = a
    while a2 > 0 and src[a2-1] in ' \t\n':
        a2 -= 1
    src = src[:a2] + src[b:]

# 插入 texttool 块（在 textconvert 块后，其逗号已保留，直接插）
new_block = '''
    'texttool' => array (
        'title' => '文本工具,字数统计/内容去重/文本替换/字符串压缩/文本对比-在线工具箱',
        'keywords' => '文本工具,字数统计,在线字数统计,内容去重,去重复行,文本替换,字符串压缩,去空格,文本对比,文本比较',
        'description' => '文本工具合集，提供在线字数统计（汉字、标点、英文、数字）、按行内容去重、文本批量查找替换、字符串压缩（去空格换行）、文本内容差异对比等功能，全部在浏览器本地完成。',
    ),'''

m = re.search(r"'textconvert'\s*=>\s*array\s*\(", src)
if m:
    r = find_block(src, 'textconvert')
    if r:
        ins = r[1]
        src = src[:ins] + new_block + src[ins:]
        print('已插入 texttool 块')
else:
    print('!! 未找到 textconvert 块')

open(path, 'w', encoding='utf-8').write(src)
print('web.php: %d -> %d 字节' % (orig_len, len(src)))
bad = re.findall(r'\)\n\s*\'[a-z]', src)
print('可疑缺逗号:', len(bad))
