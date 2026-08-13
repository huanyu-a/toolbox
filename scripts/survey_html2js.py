# -*- coding: utf-8 -*-
"""调查 html2js 系列页面的转换算法（从页面内联脚本 + html2js.js）"""
import re, os

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

# 各页面的内联脚本（函数定义）
for name in ['html2js', 'htmloutjs', 'html2cj', 'html2php', 'html2all', 'html2ubb', 'htmltable', 'htmlfromcsv']:
    src = open(os.path.join(BASE, name + '.html'), encoding='utf-8').read()
    defs = re.findall(r'function\s+(\w+)\s*\(', src)
    calls = re.findall(r'onclick="(\w+)\(', src)
    scripts = re.findall(r'src="(/static/script/[\w.\-/]+\.js)"', src)
    inline = re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)
    ilen = max([len(s) for s in inline], default=0)
    print('%-14s defs=%s calls=%s libs=%s inline_max=%d' % (name, defs, calls, [s for s in scripts if 'jquery' not in s and 'bootstrap' not in s and 'app.js' not in s and 'tool.js' not in s and 'hightout' not in s], ilen))

print()
# html2js.js 的函数
src = open(r'C:\project\wwwroot\toolbox\public\static\script\pcjs\html2js.js', encoding='utf-8').read()
defs = re.findall(r'function\s+(\w+)\s*\(', src)
print('html2js.js defs:', defs)
print('size:', len(src))
