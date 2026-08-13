# -*- coding: utf-8 -*-
"""检查文本转换外部 JS 的接口"""
import re

files = ["pcjs/jianfan.js", "pcjs/pinyin.js", "pcjs/shuformat.js", "pcjs/huoxingwen.js"]
for f in files:
    try:
        src = open(r"C:\project\wwwroot\toolbox\public\static\script\\" + f, encoding="utf-8", errors="ignore").read()
    except FileNotFoundError:
        print(f, "缺失")
        continue
    funcs = re.findall(r"function\s+(\w+)\s*\(", src)
    dom = sorted(set(re.findall(r"[#.](\w+)", src)))[:30]
    print(f"== {f} ({len(src)}B)")
    print("   函数:", funcs[:15])
    print("   DOM 引用:", dom)
    # 看前 300 字符了解结构
    print("   开头:", src[:150].replace("\n", " "))
    print()
