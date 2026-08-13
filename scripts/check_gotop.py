# -*- coding: utf-8 -*-
"""查 gotop / 返回顶部 元素与处理"""
import os, glob

# 1. 静态脚本中 gotop 处理
print("=== 静态脚本含 gotop ===")
for root, dirs, files in os.walk(r"C:\project\wwwroot\toolbox\public\static\script"):
    for f in files:
        if f.endswith(".js"):
            p = os.path.join(root, f)
            try:
                src = open(p, encoding="utf-8", errors="ignore").read()
            except Exception:
                continue
            if "gotop" in src.lower():
                print(" ", f)

# 2. 模板/页面中的返回顶部元素
print("\n=== 页面/模板含 gotop 或返回顶部元素 ===")
hits = []
for p in glob.glob(r"C:\project\wwwroot\toolbox\application\index\view\**\*.html", recursive=True):
    try:
        src = open(p, encoding="utf-8", errors="ignore").read()
    except Exception:
        continue
    for kw in ["gotop", "back-top", "backtop", "返回顶部", "scrollTo"]:
        if kw in src:
            hits.append((os.path.basename(p), kw))
            break
for name, kw in sorted(set(hits)):
    print(" ", name, "->", kw)
