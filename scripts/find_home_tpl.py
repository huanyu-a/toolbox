# -*- coding: utf-8 -*-
"""找首页模板 + TOOLS_DATA 输出位置"""
import glob, os

nav_inc = 'include file="nav"'
for p in glob.glob(r"C:\project\wwwroot\toolbox\application\index\view\**\*.html", recursive=True):
    src = open(p, encoding="utf-8", errors="ignore").read()
    if nav_inc in src and "tool-wrap" in src and ("home-cat" in src or "homeCount" in src or "tool-grid" in src):
        print("首页候选:", p.replace("C:\\project\\wwwroot\\toolbox\\", ""), os.path.getsize(p))

print()
for p in glob.glob(r"C:\project\wwwroot\toolbox\application\index\view\**\*.html", recursive=True):
    src = open(p, encoding="utf-8", errors="ignore").read()
    if "TOOLS_DATA" in src:
        print("含 TOOLS_DATA:", p.replace("C:\\project\\wwwroot\\toolbox\\", ""))
        break
