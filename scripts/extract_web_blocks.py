# -*- coding: utf-8 -*-
"""提取 web.php 中 deencrypt/allencrypt/htpasswd 完整块"""
import re

src = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8", errors="ignore").read()

# 用引号配对法提取块：从 "'key' =>" 开始，到匹配的 '),' 结束（顶层 array 用 ), 结尾）
def extract_block(src, key):
    start = src.find("'%s' =>" % key)
    if start < 0:
        return None
    # 找到 array ( 开始
    arr = src.find("array (", start)
    if arr < 0:
        return None
    # 从 arr 找匹配括号
    depth = 0
    i = arr + len("array (")
    while i < len(src):
        c = src[i]
        if c == "(":
            depth += 1
        elif c == ")":
            if depth == 0:
                # 块结束于这里，包含结尾的 ), 
                j = src.find("),", i)
                if j < 0:
                    j = i + 1
                return src[start:j+2]
            depth -= 1
        i += 1
    return None

for key in ["deencrypt", "allencrypt", "htpasswd"]:
    block = extract_block(src, key)
    print("=== %s ===" % key)
    print(block[:600] if block else "NOT FOUND")
    print("长度:", len(block) if block else 0)
    print()
