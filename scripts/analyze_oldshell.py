# -*- coding: utf-8 -*-
"""分析 4 个旧骨架页结构"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

for p in ["editor", "ports", "subnetmask", "linuxcmd"]:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    print(f"===== {p}.html ({len(src)}B) =====")
    # 头部结构
    head = src[:1200]
    print(head)
    print("...")
    # 脚本引用
    scripts = re.findall(r'<script[^>]*src="([^"]+)"', src)
    print("外部脚本:", scripts)
    # 内联脚本数量
    inline = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    print("内联脚本块:", len(inline), "各块长度:", [len(x) for x in inline])
    # 关键函数
    fns = set()
    for s in inline:
        fns.update(re.findall(r"function\s+(\w+)\s*\(", s))
    print("内联函数:", sorted(fns)[:30])
    print()
