# -*- coding: utf-8 -*-
"""验证页面移除 tool.js 的安全性：检查是否依赖 tool.js 专属行为"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
TOOLJS_FNS = ["setJS", "pcjson_com_msg", "pcjson_convert", "copyTxtToClipboard", "tj("]

pages = ["androidmanifest","areacode","barcode","bootstrapicon","browserinfo","caiji","calculator","chaicp","chaodai","checkkeyword","checkurl","checkweixin","confundirjs","contenttype","currency","editor","favicon","gzip","htaccess2nginx","htpasswd","huoxingwen","img2base64","jianfan","jieri","linuxcmd","lishishangdejintian","morse","nianlvli","pinyin","ports","refresh","runjs","shaoshuminzu","shortcut","shupai","subnetmask","tesufuhao","textdiff","tuya","useragent","websocket","wenzitexiao","whois","xpath"]

risky = []
ok = []
for p in pages:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    # 检查是否直接调用 tool.js 函数
    direct = [fn for fn in TOOLJS_FNS if re.search(r"\b" + fn.replace("(", r"\(") + r"\s*\(", src) or (fn == "tj(" and "tj(" in src)]
    # 检查是否有 data-clipboard-target（依赖 tool.js 的 #copyallcode 绑定）
    has_clip = "data-clipboard-target" in src
    # 检查是否有 gotop 元素
    has_gotop = "gotop" in src
    if direct or has_clip:
        risky.append((p, direct, has_clip, has_gotop))
    else:
        ok.append(p)

print("=== 可安全移除 tool.js (无直接调用/无clipboard依赖) ===")
print(len(ok), "页")
print(ok)
print()
print("=== 有风险（需处理）===")
for p, d, c, g in risky:
    print(f"  {p}: direct={d} clipboard={c} gotop={g}")
