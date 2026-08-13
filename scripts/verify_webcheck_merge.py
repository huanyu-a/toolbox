# -*- coding: utf-8 -*-
"""验证 webcheck.html：JS 语法、面板结构、ID 唯一性"""
import re, os, subprocess, sys

path = r"C:\project\wwwroot\toolbox\application\index\view\index\webcheck.html"
src = open(path, encoding="utf-8").read()
ok = True

# 1. JS 语法
blocks = re.findall(r"<script(?![^>]*src=)[^>]*>(.*?)</script>", src, re.S)
tmp = r"C:\project\wwwroot\toolbox\scripts\tmp_wc.js"
for i, b in enumerate(blocks):
    with open(tmp, "w", encoding="utf-8") as f:
        f.write(b)
    r = subprocess.run(["node", "--check", tmp], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print("JS FAIL block %d:" % i)
        print(r.stderr[:1200])
    else:
        print("JS OK block %d (%d bytes)" % (i, len(b)))

# 2. 关键结构
for need in ['data-panel="wcCode"', 'id="wcCode"', 'id="wcCodeUrl"', 'id="wcCodeQuery"',
             'id="wcCodeError"', 'id="wcCodeResult"', 'id="wcCodeResultBody"',
             'wc-panel', 'class="t-panel wc-panel"']:
    if need not in src:
        ok = False
        print("MISSING:", need)

# 3. tab 面板数量匹配
tabs = re.findall(r'data-panel="(wc\w+)"', src)
panels = re.findall(r'<div id="(wc\w+)" class="t-panel', src)
print("tabs:", sorted(set(tabs)))
print("panels:", sorted(set(panels)))
if set(tabs) != set(panels):
    ok = False
    print("TAB/PANEL MISMATCH")

# 4. ID 唯一性
ids = re.findall(r'id="([^"]+)"', src)
dup = {x for x in ids if ids.count(x) > 1}
if dup:
    ok = False
    print("DUPLICATE IDS:", dup)

# 5. 对照表内容抽查
for term in ['1xx 信息响应', '5xx 服务器错误', '404', '505']:
    if term not in src:
        ok = False
        print("MISSING TABLE TERM:", term)

print("ALL_OK" if ok else "HAS_FAILURES")
sys.exit(0 if ok else 1)
