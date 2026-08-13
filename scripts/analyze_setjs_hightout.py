# -*- coding: utf-8 -*-
"""setJS 用法 + hightout.js 调用分析"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

print("=== setJS 用法 ===")
for p in ["barcode", "htpasswd", "shupai", "textdiff"]:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    for m in re.finditer(r"setJS\s*\(([^)]*)\)", src):
        print(f"  {p}: setJS({m.group(1)[:120]})")
    # 看整体脚本区
    scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    for i, s in enumerate(scripts):
        if "setJS" in s:
            print(f"    --- {p} 含 setJS 的脚本块 ---")
            print("    " + s[:400].replace("\n", "\n    "))

print("\n=== hightout.js 页面中直接调用 hightout( ===")
for p in ["browserinfo", "confundirjs", "htaccess2nginx", "huoxingwen", "jianfan", "morse", "refresh", "shortcut", "wenzitexiao", "whois", "xpath"]:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    calls = re.findall(r"\bhightout\s*\(", src)
    print(f"  {p}: hightout 调用 {len(calls)} 次")
