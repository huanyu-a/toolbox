# -*- coding: utf-8 -*-
"""分析 tool.js API 与页面使用方式"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

# 1. tool.js 定义的公共函数
src = open(r"C:\project\wwwroot\toolbox\public\static\script\tool.js", encoding="utf-8").read()
print("tool.js size:", len(src))
# 提取函数定义（function xxx( 或 xxx = function(）
defs = re.findall(r"function\s+(\w+)\s*\(", src)
defs += re.findall(r"(\w+)\s*=\s*function\s*\(", src)
defs += re.findall(r"(\w+)\s*:\s*function\s*\(", src)
uniq = sorted(set(defs))
print("函数定义数:", len(uniq))
print(uniq)

# 2. 44 个引用 tool.js 的页面中，内联 JS 调用哪些全局函数
pages = ["androidmanifest","areacode","barcode","bootstrapicon","browserinfo","caiji","calculator","chaicp","chaodai","checkkeyword","checkurl","checkweixin","confundirjs","contenttype","currency","editor","favicon","gzip","htaccess2nginx","htpasswd","huoxingwen","img2base64","jianfan","jieri","linuxcmd","lishishangdejintian","morse","nianlvli","pinyin","ports","refresh","runjs","shaoshuminzu","shortcut","shupai","subnetmask","tesufuhao","textdiff","tuya","useragent","websocket","wenzitexiao","whois","xpath"]

used = {}
for p in pages:
    s = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    inline = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", s, re.S)
    for code in inline:
        for fn in uniq:
            if re.search(r"\b" + fn + r"\s*\(", code):
                used.setdefault(fn, []).append(p)

print("\n=== 页面内联 JS 实际调用的 tool.js 函数 ===")
for fn, ps in sorted(used.items(), key=lambda x: -len(x[1])):
    print(f"  {fn}: {len(ps)} 页 -> {ps[:12]}")
