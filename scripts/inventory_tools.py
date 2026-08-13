# -*- coding: utf-8 -*-
"""盘点所有工具页：标题、描述、控件、功能概要"""
import os, re, json

BASE = os.path.join(os.path.dirname(__file__), "..", "application", "index", "view", "index")

def clean(s):
    return re.sub(r'\s+', ' ', s).strip()

rows = []
for f in sorted(os.listdir(BASE)):
    if not f.endswith('.html'):
        continue
    name = f[:-5]
    src = open(os.path.join(BASE, f), encoding='utf-8').read()
    # title
    m = re.search(r'<title>([^<]+)</title>', src)
    title = clean(m.group(1)) if m else ''
    # tool-title (h2)
    m = re.search(r'class="tool-title"[^>]*>(?:\s*<span[^>]*>.*?</span>\s*)?([^<]+)</h2>', src, re.S)
    h2 = clean(m.group(1)) if m else ''
    # desc
    m = re.search(r'class="tool-desc"[^>]*>([^<]+)</p>', src, re.S)
    desc = clean(m.group(1)) if m else ''
    # 旧骨架标题
    if not h2:
        m = re.search(r'<h2[^>]*>([^<]+)</h2>', src)
        h2 = clean(m.group(1)) if m else ''
    # 按钮
    btns = re.findall(r'(?:<button[^>]*>|value=")([^<"]{1,20})</?(?:button|input)?', src)
    # textarea/input ids
    ids = re.findall(r'<(?:textarea|input|select)[^>]*\bid="([^"]+)"', src)
    # 引用脚本
    scripts = sorted(set(re.findall(r'src="(/static/script/[\w.\-/]+\.js)"', src)))
    size = len(src)
    rows.append({
        'name': name, 'title': title, 'h2': h2, 'desc': desc[:120],
        'ids': ids[:12], 'scripts': scripts, 'size': size
    })

out = os.path.join(os.path.dirname(__file__), "tools_inventory.json")
json.dump(rows, open(out, 'w', encoding='utf-8'), ensure_ascii=False, indent=1)
print("total pages:", len(rows))
for r in rows:
    tag = 'NEW' if 'tool-card' in open(os.path.join(BASE, r['name']+'.html'), encoding='utf-8').read() else 'OLD'
    print(f"[{tag}] {r['name']:22s} | {r['h2'][:30]}")
