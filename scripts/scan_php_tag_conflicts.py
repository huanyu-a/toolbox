# -*- coding: utf-8 -*-
"""全站扫描模板中的 PHP 标签字面量冲突（<?php / <% / %>）"""
import os, re

ROOTS = [
    r"C:\project\wwwroot\toolbox\application\index\view",
]

hits = []
for root in ROOTS:
    for dirpath, _, files in os.walk(root):
        for f in files:
            if not f.endswith(".html"):
                continue
            path = os.path.join(dirpath, f)
            src = open(path, encoding="utf-8").read()
            # 找 <?php / <% / %> 字面量（排除模板注释 {literal} 包裹的）
            for pat in [r"<\?php", r"<%", r"%>"]:
                for m in re.finditer(pat, src):
                    i = m.start()
                    ctx = src[max(0, i-60):i+40].replace("\n", " ")
                    hits.append((path, pat, ctx))

print("命中数:", len(hits))
for path, pat, ctx in hits:
    rel = path.replace(r"C:\project\wwwroot\toolbox\application\index\view\index", "")
    print(f"  [{pat}] {rel}: ...{ctx}...")
