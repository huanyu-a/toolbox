# -*- coding: utf-8 -*-
"""验证 subnetmask.html：JS 语法、模块数、tab 结构、ID"""
import re, os, subprocess, sys

path = r"C:\project\wwwroot\toolbox\application\index\view\index\subnetmask.html"
src = open(path, encoding="utf-8").read()
ok = True

# 1. 头部元素
for need in ["<!DOCTYPE html>", "<head>", "<meta charset=\"utf-8\"",
             "{$Think.config.web.subnetmask.title}", "{include file=\"seo\" /}",
             "{include file=\"header\" /}", 'id="smTabs"', "{include file=\"nav\" /}",
             "{include file=\"footer\" /}"]:
    if need not in src:
        ok = False
        print("MISSING:", need)

# 2. t-mod 模块数
mods = re.findall(r'<div class="t-mod">', src)
print("t-mod 模块数:", len(mods))
if len(mods) != 10:
    ok = False

# 3. tab/panel 匹配
tabs = re.findall(r'data-panel="(sm\w+)"', src)
panels = re.findall(r'<div id="(sm\w+)" class="t-panel sm-panel', src)
print("tabs:", sorted(set(tabs)))
print("panels:", sorted(set(panels)))
if set(tabs) != set(panels):
    ok = False
    print("TAB/PANEL MISMATCH")

# 4. 分组内模块标题核对
titles = re.findall(r't-mod-title">([^<]+)<', src)
print("面板内模块:", titles)

# 5. JS 语法检查（内联 script 块）
blocks = re.findall(r"<script(?![^>]*src=)[^>]*>(.*?)</script>", src, re.S)
tmp = r"C:\project\wwwroot\toolbox\scripts\tmp_sm.js"
for i, b in enumerate(blocks):
    with open(tmp, "w", encoding="utf-8") as f:
        f.write(b)
    r = subprocess.run(["node", "--check", tmp], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print("JS FAIL block %d:" % i)
        print(r.stderr[:800])
    else:
        print("JS OK block %d (%d B)" % (i, len(b)))

# 6. 外部脚本顺序
order = re.findall(r'<script src="([^"]+)"', src)
print("外部脚本:", order)

print("ALL_OK" if ok else "HAS_FAILURES")
sys.exit(0 if ok else 1)
