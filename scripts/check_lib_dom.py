# -*- coding: utf-8 -*-
"""检查旧库的 DOM 依赖与关键函数实现"""
import re, io

files = {
    'pcjs/jianfan.js': 'public/static/script/pcjs/jianfan.js',
    'pcjs/pinyin.js': 'public/static/script/pcjs/pinyin.js',
    'tools-lib.js': 'public/static/script/tools-lib.js',
    'pcjs/shuformat.js': 'public/static/script/pcjs/shuformat.js',
    'pcjs/wenzitexiao.js': 'public/static/script/pcjs/wenzitexiao.js',
}
out = io.open('scripts/_lib_dump.txt', 'w', encoding='utf-8')
for name, path in files.items():
    try:
        src = open(path, encoding='utf-8').read()
    except Exception as e:
        out.write('===== %s ERROR %s =====\n' % (name, e))
        continue
    out.write('===== %s (%d B) =====\n' % (name, len(src)))
    # 全局函数名
    funcs = re.findall(r'function\s+([A-Za-z_$][\w$]*)\s*\(', src)
    out.write('FUNCS: %s\n' % sorted(set(funcs)))
    # getElementById 依赖
    ids = re.findall(r'getElementById\(["\']([^"\']+)["\']\)', src)
    out.write('DOM IDS: %s\n' % sorted(set(ids)))
    # jQuery 选择器依赖
    jq = re.findall(r'\$\("#([\w-]+)"\)', src)
    out.write('JQ IDS: %s\n' % sorted(set(jq)))
    out.write('\n')
out.close()
print('done')
