# -*- coding: utf-8 -*-
"""检查 morseen.js 和 img2base64.js 的 DOM 依赖与全局函数"""
import re

for f in ["pcjs/morseen.js", "pcjs/img2base64.js"]:
    src = open(r"C:\project\wwwroot\toolbox\public\static\script\\" + f, encoding="utf-8", errors="ignore").read()
    print("=====", f, "=====")
    # 全局函数定义
    funcs = re.findall(r"function\s+(\w+)\s*\(", src)
    print("函数:", funcs)
    # DOM 引用
    ids = sorted(set(re.findall(r"getElementById\('([^']+)'\)", src)))
    print("DOM ID:", ids)
    # onclick 引用
    print("length:", len(src))
    print()
