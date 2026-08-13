# -*- coding: utf-8 -*-
"""最终综合验证"""
import os, re, subprocess, tempfile

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
TOOLS = r"C:\project\wwwroot\toolbox\config\tools.php"
backup = r"C:\project\wwwroot\toolbox\.merged_backup"

deleted = set(f[:-5] for f in os.listdir(backup) if f.endswith(".html"))
src = open(TOOLS, encoding="utf-8").read()
kept = set(re.findall(r"'url' => '/([^/]+)/'", src))

# 1. 全页面残留引用
print("=== 1. 残留引用扫描 ===")
residual = {}
for p in sorted(os.listdir(BASE)):
    if not p.endswith(".html"):
        continue
    body = open(os.path.join(BASE, p), encoding="utf-8").read()
    for d in deleted:
        if re.search(r'["\']/' + re.escape(d) + r'/"', body) or re.search(r'href="?/' + re.escape(d) + r'/"?', body):
            residual.setdefault(p, []).append(d)
if residual:
    for p, ds in residual.items():
        print(f"  残留 {p}: {ds}")
else:
    print("  无残留 ✅")

# 2. 大合并页 JS 语法
print("\n=== 2. 关键页 JS 语法 ===")
key_pages = ["json", "calc", "dns", "format", "html2js", "regex", "keyboardcode",
             "random", "unixtime", "createmeta", "hexrgb", "ip", "pagecode",
             "ascii", "htmlescape", "httpheader", "deencrypt", "allencrypt",
             "uuid", "unicode", "capital"]
all_ok = True
for name in key_pages:
    path = os.path.join(BASE, name + ".html")
    if not os.path.exists(path):
        print(f"  ✗ {name}: 页面不存在")
        all_ok = False
        continue
    body = open(path, encoding="utf-8").read()
    scripts = re.findall(r"<script>(.*?)</script>", body, re.S)
    for i, code in enumerate(scripts):
        if len(code) < 30:
            continue
        tf = os.path.join(tempfile.gettempdir(), f"v_{name}_{i}.js")
        open(tf, "w", encoding="utf-8").write(code)
        r = subprocess.run(["node", "--check", tf], capture_output=True, text=True)
        os.remove(tf)
        if r.returncode != 0:
            print(f"  ✗ {name} script#{i}: {r.stderr.strip()[:150]}")
            all_ok = False
    print(f"  ✓ {name} ({len(scripts)} 个内联脚本)")
print("JS 全部通过" if all_ok else "存在 JS 错误!")

# 3. 导航 vs 页面
print("\n=== 3. 导航对照 ===")
pages = set(f[:-5] for f in os.listdir(BASE) if f.endswith(".html"))
print("导航项:", len(kept), "| 页面(含index):", len(pages))
print("导航有但页面无:", sorted(kept - pages))
print("页面有但导航无:", sorted(pages - kept - {"index"}))
