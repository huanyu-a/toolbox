# -*- coding: utf-8 -*-
"""盘点当前页面：哪些已是 tab 合集、哪些还是单功能"""
import os, re

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

# 计划中的合并目标页
targets = ['json', 'html2js', 'format', 'regex', 'keyboardcode', 'random', 'unixtime',
           'createmeta', 'hexrgb', 'ip', 'pagecode', 'ascii', 'htmlescape', 'httpheader',
           'calc', 'dns', 'urlcode', 'guid', 'unicode', 'capital', 'deencrypt', 'allencrypt', 'md5']

print('%-14s %-8s %-6s %-10s %s' % ('page', 'tabs', 'size', 'status', 'h2'))
for f in sorted(os.listdir(BASE)):
    if not f.endswith('.html'):
        continue
    name = f[:-5]
    src = open(os.path.join(BASE, f), encoding='utf-8').read()
    tabs = src.count('class="t-tab')
    panels = src.count('class="t-panel')
    m = re.search(r'<h2[^>]*>(.*?)</h2>', src, re.S)
    h2 = re.sub(r'<[^>]+>', '', m.group(1)).strip()[:22] if m else ''
    newskin = 'tool-card' in src
    has_old = ('col10main' in src) or ('tool.js' in src and 't-tab' not in src)
    status = 'OLD' if 'col10main' in src else ('NEW' if newskin else '?')
    if name in targets or tabs > 0:
        print('%-14s tabs=%-3d size=%-7d %-8s %s' % (name, tabs, len(src), status, h2))
