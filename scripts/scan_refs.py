# -*- coding: utf-8 -*-
"""检查 deencrypt/allencrypt/htpasswd 在项目中的引用"""
import os, re

ROOTS = [
    r"C:\project\wwwroot\toolbox\application",
    r"C:\project\wwwroot\toolbox\public",
    r"C:\project\wwwroot\toolbox\config",
]
SKIP = {".git", "runtime", "node_modules", ".fetch"}

hits = {}
for root in ROOTS:
    for dirpath, dirnames, filenames in os.walk(root):
        dirnames[:] = [d for d in dirnames if d not in SKIP]
        for fn in filenames:
            if not fn.endswith((".html", ".js", ".php")):
                continue
            fp = os.path.join(dirpath, fn)
            try:
                src = open(fp, encoding="utf-8", errors="ignore").read()
            except Exception:
                continue
            for kw in ["deencrypt", "allencrypt", "htpasswd"]:
                if kw in src:
                    hits.setdefault(kw, []).append(fp.replace("C:\\project\\wwwroot\\toolbox\\", ""))

for kw, files in sorted(hits.items()):
    print(f"== {kw} ==")
    for f in sorted(set(files)):
        print("   ", f)
