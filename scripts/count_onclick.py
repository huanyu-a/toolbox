# -*- coding: utf-8 -*-
"""统计 onclick 页面改造规模"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
pages = ["areacode","barcode","calculator","checkkeyword","checkurl","checkweixin","confundirjs","currency","favicon","htaccess2nginx","htpasswd","huoxingwen","img2base64","jianfan","jieri","morse","pinyin","refresh","runjs","shaoshuminzu","shortcut","shupai","subnetmask","textdiff","tuya","websocket","wenzitexiao","xpath"]

total_onclick = 0
detail = []
for p in pages:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    calls = re.findall(r'\sonclick="([^"]+)"', src)
    if calls:
        total_onclick += len(calls)
        detail.append((p, len(calls), calls[:3]))
    # 检查是否有对应的内联函数定义
    inline = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    inline_fns = set()
    for s in inline:
        inline_fns.update(re.findall(r"function\s+(\w+)\s*\(", s))
    defined = True
    for c in calls:
        if "(" in c:
            m = re.match(r"(\w+)\s*\(", c.strip().rstrip(";"))
            if m and m.group(1) not in inline_fns and m.group(1) not in src:
                defined = False
                break

print("onclick 总数:", total_onclick)
for p, n, cs in detail:
    print(f"  {p}: {n} 处 -> {cs}")
