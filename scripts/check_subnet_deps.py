# -*- coding: utf-8 -*-
"""检查 subnetmask.js / jq-public.js 的 jQuery 依赖"""
import re

for fn in [r"C:\project\wwwroot\toolbox\public\static\script\pcjs\subnetmask.js",
           r"C:\project\wwwroot\toolbox\public\static\script\jq-public.js"]:
    src = open(fn, encoding="utf-8").read()
    jq = len(re.findall(r"jQuery|\$\(|\.on\(|\.click\(|\.each\(", src))
    dom = len(re.findall(r"getElementById|document\.", src))
    print("=== %s ===" % fn.split("\\")[-1])
    print("  jQuery 痕迹:", jq, " 原生DOM痕迹:", dom)
    # 头部 300 字符预览
    print("  头部:", src[:200].replace("\n", " "))
    print()

# web.php subnetmask TDK
src = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8").read()
idx = src.find("'subnetmask'")
print("subnetmask TDK:", src[idx:idx + 400] if idx >= 0 else "NOT FOUND")
