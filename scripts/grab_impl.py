# -*- coding: utf-8 -*-
"""提取 toPinyin/transs/h 关键实现"""
import io

def grab(path, start, end=None, label=''):
    src = open(path, encoding='utf-8').read()
    i = src.find(start)
    if i < 0:
        return '--- %s NOT FOUND ---\n' % start
    j = src.find(end, i) if end else i + 3000
    return '--- %s ---\n%s\n' % (label, src[i:j])

out = io.open('scripts/_impl_dump.txt', 'w', encoding='utf-8')
out.write(grab('public/static/script/pcjs/pinyin.js', 'function toPinyin', 'function transs', 'toPinyin'))
out.write(grab('public/static/script/pcjs/pinyin.js', 'function transs', None, 'transs'))
out.write(grab('public/static/script/pcjs/shuformat.js', 'function h', 'function cbig5', 'h'))
out.write(grab('public/static/script/pcjs/shuformat.js', 'function cbig5', None, 'cbig5'))
out.close()
print('done')
