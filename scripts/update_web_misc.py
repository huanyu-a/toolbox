# -*- coding: utf-8 -*-
"""web.php：删 camelcase/htmlescape 块，更新 textconvert/encode TDK"""
import re

path = 'config/web.php'
src = open(path, encoding='utf-8').read()
orig_len = len(src)

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

# 删除 camelcase / htmlescape
for key in ['camelcase', 'htmlescape']:
    r = find_block(src, key)
    if r:
        a, b = r
        a2 = a
        while a2 > 0 and src[a2-1] in ' \t\n':
            a2 -= 1
        src = src[:a2] + src[b:]
        print('已删除块:', key)
    else:
        print('!! 未找到块:', key)

# 更新 textconvert 块 TDK
r = find_block(src, 'textconvert')
if r:
    a, b = r
    block = src[a:b]
    block = re.sub(r"'title' => '[^']*'",
        "'title' => '文本转换工具,简繁转换/汉字拼音/火星文/竖排翻转/驼峰下划线/人民币大写-在线工具箱'", block, count=1)
    block = re.sub(r"'keywords' => '[^']*'",
        "'keywords' => '文本转换,简繁转换,繁体字转换,汉字转拼音,火星文转换,文字竖排,文字翻转,文字特效,全角半角转换,英文大小写转换,驼峰下划线转换,人民币大写'", block, count=1)
    block = re.sub(r"'description' => '[^']*'",
        "'description' => '文本转换在线工具合集，提供简体繁体互转、汉字转拼音及读音、火星文转换、文字竖排、文字翻转、彩色文字特效、全角半角互转、英文大小写转换、驼峰与下划线命名互转、人民币大写金额转换等功能，全部在浏览器本地完成。'", block, count=1)
    src = src[:a] + block + src[b:]
    print('已更新 textconvert TDK')

# 更新 encode 块 TDK
r = find_block(src, 'encode')
if r:
    a, b = r
    block = src[a:b]
    block = re.sub(r"'title' => '[^']*'",
        "'title' => '编码转换,Base64/URL/Unicode/ASCII/摩尔斯/HTML转义-在线工具箱'", block, count=1)
    block = re.sub(r"'keywords' => '[^']*'",
        "'keywords' => '编码转换,Base64编码,URL编码,Escape编码,Unicode编码,UTF-8编码,ASCII编码,摩尔斯电码,迅雷链接转换,图片转Base64,HTML转义'", block, count=1)
    block = re.sub(r"'description' => '[^']*'",
        "'description' => '编码转换在线工具合集：Base64、URL、Escape、Unicode、UTF-8、ASCII、摩尔斯电码、迅雷/旋风链接、图片转 Base64、HTML 转义/反转义，全程浏览器本地运算。'", block, count=1)
    src = src[:a] + block + src[b:]
    print('已更新 encode TDK')

open(path, 'w', encoding='utf-8').write(src)
print('web.php: %d -> %d 字节' % (orig_len, len(src)))
bad = re.findall(r'\)\n\s*\'[a-z]', src)
print('可疑缺逗号:', len(bad))
