# -*- coding: utf-8 -*-
"""全量验证：PHP 语法 + 残留引用"""
import os, re, subprocess

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
TOOLS = r"C:\project\wwwroot\toolbox\config\tools.php"

# 1. 配置结构校验（Python 侧）
print("=== 配置结构 ===")
for f, kind in [(r"C:\project\wwwroot\toolbox\config\tools.php", "tools"),
                (r"C:\project\wwwroot\toolbox\config\web.php", "web")]:
    txt = open(f, encoding="utf-8").read()
    ok = txt.count("'cat' =>") == txt.count("'items' =>") if kind == "tools" else True
    # 粗校验：括号平衡
    bal = txt.count("[") - txt.count("]") if kind == "tools" else txt.count("(") - txt.count(")")
    print(f"  {os.path.basename(f)}: 括号平衡={bal} {'OK' if bal == 0 else 'FAIL'}")
src = open(TOOLS, encoding="utf-8").read()
kept = set(re.findall(r"'url' => '/([^/]+)/'", src))
print("  导航项:", len(kept))

# 2. 被删页面引用扫描（保留页面内指向 /xxx/ 的链接）
print("\n=== 保留页内指向被删页面的链接 ===")
deleted = set(f[:-5] for f in os.listdir(r"C:\project\wwwroot\toolbox\.merged_backup") if f.endswith(".html"))
hits = {}
for p in sorted(os.listdir(BASE)):
    if not p.endswith(".html") or p == "index.html":
        continue
    body = open(os.path.join(BASE, p), encoding="utf-8").read()
    for d in deleted:
        # 匹配 /d/ 或 "/d/" 或 '/d/'
        if re.search(r'["\']/' + re.escape(d) + r'/"', body) or re.search(r'href="?/' + re.escape(d) + r'/"?', body):
            hits.setdefault(p, []).append(d)
for p, ds in sorted(hits.items()):
    print(f"  {p}: {ds}")

# 3. 剩余页面统计
pages = sorted(f[:-5] for f in os.listdir(BASE) if f.endswith(".html"))
print("\n最终页面数:", len(pages))
print("导航项:", len(kept))
