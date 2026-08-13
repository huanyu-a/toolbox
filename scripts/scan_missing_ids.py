# -*- coding: utf-8 -*-
"""静态分析：JS 中 getElementById/$id 引用的 id 是否存在于 HTML"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

issues = []
for f in sorted(os.listdir(BASE)):
    if not f.endswith(".html"):
        continue
    src = open(os.path.join(BASE, f), encoding="utf-8").read()
    html_ids = set(re.findall(r'id="([^"]+)"', src))
    scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    refs = set()
    for code in scripts:
        # getElementById('x') 与 $id('x')
        for m in re.finditer(r"(?:getElementById|\$id)\(\s*['\"]([^'\"]+)['\"]\s*\)", code):
            refs.add(m.group(1))
    # data-copy 引用
    for m in re.finditer(r'data-copy="([#][^"]+)"', src):
        refs.add(m.group(1).lstrip("#"))
    missing = sorted(refs - html_ids)
    if missing:
        issues.append((f, missing))
        print(f"⚠️ {f}: JS 引用但 HTML 不存在的 id: {missing}")
    else:
        print(f"✓ {f}")

print("\n有问题的页面:", len(issues))
