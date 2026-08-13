# -*- coding: utf-8 -*-
"""查看 web.php 配置结构（找 deencrypt 相关键）"""
import re

src = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8", errors="ignore").read()
print("文件大小:", len(src))

# 找所有顶层键
for m in re.finditer(r"'(\w+)'\s*=>\s*\[", src):
    pass

# 直接找 deencrypt 出现的上下文
for kw in ["deencrypt", "allencrypt", "htpasswd", "encrypt"]:
    idx = src.find(kw)
    print(f"\n[{kw}] 首次出现 @ {idx}")
    if idx >= 0:
        print(src[max(0, idx-150):idx+250].replace("\n", " "))
