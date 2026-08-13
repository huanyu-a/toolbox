# -*- coding: utf-8 -*-
"""验证清理结果"""
import os, re, subprocess, tempfile

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

print("=== 1. setJS 静态化页面脚本标签 ===")
for p in ["barcode", "htpasswd", "shupai", "textdiff"]:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    scripts = re.findall(r'<script[^>]*src="([^"]+)"', src)
    print(f"  {p}: 外部脚本 {len(scripts)} 个")
    for s in scripts:
        if "pcjs" in s:
            print(f"      {s}")
    # 检查是否残留 setJS 调用
    if "setJS" in src:
        print(f"    ⚠ {p} 仍含 setJS!")

print("\n=== 2. clipboard 迁移页面 data-copy ===")
for p in ["confundirjs","htaccess2nginx","huoxingwen","img2base64","jianfan","morse","pinyin","runjs","wenzitexiao","xpath","htpasswd","shupai"]:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    old = "data-clipboard-target" in src
    new = "data-copy=" in src
    print(f"  {p}: 旧={old} 新={new} {'⚠' if old else ''}")

print("\n=== 3. 内联 JS 语法抽查（关键清理页）===")
for p in ["barcode","htpasswd","shupai","textdiff","checkweixin","confundirjs","morse","whois","xpath"]:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    ok = True
    for i, code in enumerate(scripts):
        if not code.strip():
            continue
        f = os.path.join(tempfile.gettempdir(), f"chk_{p}_{i}.js")
        open(f, "w", encoding="utf-8").write(code)
        r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
        if r.returncode != 0:
            ok = False
            print(f"  ✗ {p} script#{i}: {r.stderr.strip()[:120]}")
        os.remove(f)
    if ok:
        print(f"  ✓ {p}")
