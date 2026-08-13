# -*- coding: utf-8 -*-
"""统计各页面 JS 加载情况"""
import glob, os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view"
stats = {"app.js": [], "tool.js": [], "both": [], "none": []}
for p in glob.glob(BASE + r"\**\*.html", recursive=True):
    src = open(p, encoding="utf-8", errors="ignore").read()
    has_app = "app.js" in src
    has_tool = "tool.js" in src
    name = p.replace(BASE + "\\", "")
    if has_app and has_tool:
        stats["both"].append(name)
    elif has_app:
        stats["app.js"].append(name)
    elif has_tool:
        stats["tool.js"].append(name)
    else:
        stats["none"].append(name)

for k, v in stats.items():
    print(f"{k}: {len(v)}")
    if k in ("tool.js", "both", "none") and v:
        print("   ", v[:20])

# tool.js 在页面中的加载顺序（relative to app.js）
for p in glob.glob(BASE + r"\**\*.html", recursive=True):
    src = open(p, encoding="utf-8", errors="ignore").read()
    if "tool.js" in src and "app.js" in src:
        print("\n示例 both:", p.split("\\")[-1])
        i1, i2 = src.find("tool.js"), src.find("app.js")
        print("  tool.js @", i1, "app.js @", i2)
        break
