# -*- coding: utf-8 -*-
"""验证 textconvert 合并页 + 分类结构"""
import re, json, urllib.request, io

BASE = 'http://127.0.0.1:18080'

def fetch(path):
    try:
        r = urllib.request.urlopen(BASE + path, timeout=10)
        return r.status, r.read().decode('utf-8', 'ignore')
    except Exception as e:
        return 500, str(e)

# 1. 页面渲染
st, html = fetch('/textconvert/')
print('状态:', st, '大小:', len(html))
if st == 200:
    tabs = re.findall(r'class="t-tab[^"]*" data-panel="(\w+)"', html)
    panels = re.findall(r'class="t-panel tc-panel[^"]*" id="(\w+)"', html)
    print('tabs:', len(tabs), tabs)
    print('panels:', len(panels), panels)
    # 关键 ID 存在性
    ids = ['jfInput', 'jfOut', 'pyContent', 'pyResultText', 'hxInput', 'hxOut',
           'srcText', 'tarText', 'flipInput', 'flipResultText', 'fxInput', 'fxCode',
           'qbInput', 'qbOut', 'csInput', 'csResultText', 'rmbDigits', 'rmbOut']
    missing = [i for i in ids if ('id="%s"' % i) not in html]
    print('缺失 ID:', missing if missing else '无')
    # 库加载
    for lib in ['jianfan.js', 'pinyin.js', 'shuformat.js']:
        print('含 %s:' % lib, lib in html)

# 2. 旧页面应 500
for old in ['jianfan', 'pinyin', 'huoxingwen', 'shupai', 'textflip',
            'wenzitexiao', 'quanbaojiao', 'capital', 'rmbdaxie']:
    s2, _ = fetch('/%s/' % old)
    print('旧页 /%s/: %s' % (old, s2))

# 3. 分类结构（解析 tools.php）
src = open('config/tools.php', encoding='utf-8').read()
cats = re.findall(r"'cat' => '([^']+)'", src)
items = re.findall(r"'url' => '(/[^']+/)', 'name' => '([^']+)'", src)
print('\n分类数:', len(cats), cats)
print('工具总数:', len(items))
from collections import Counter
per = Counter()
for u, n in items:
    for c in cats:
        pass
print('文本处理条目:', [n for u, n in items if u.startswith('/txt') or u.startswith('/text') or u.startswith('/quchong') or u.startswith('/zip') or u in ('/textconvert/', '/encrypt/', '/encode/')])
print('括号平衡:', src.count('['), src.count(']'))
