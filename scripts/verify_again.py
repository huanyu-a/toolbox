# -*- coding: utf-8 -*-
"""复核两个疑点"""
import re, urllib.request

body = urllib.request.urlopen("http://127.0.0.1:18080/urlcode/", timeout=15).read().decode("utf-8", "ignore")

# 1. rand-tools 实际渲染
m = re.search(r'<ul class="[^"]*rand-tools[^"]*">([\s\S]{0,200})', body)
print("rand-tools ul:", m.group(0)[:120].replace("\n", " ") if m else "NOT FOUND")
links = re.findall(r'<a href="(/[^"]+/)"[^>]*>([^<]+)</a>', m.group(1) if m else "")
print("推荐工具链接数:", len(links))

# 2. TOOLS_DATA urlcode 名称（JSON 转义斜杠）
m2 = re.search(r'"url":"\\/urlcode\\/","name":"([^"]+)"', body)
print("urlcode 注册表名称:", m2.group(1) if m2 else "未找到")
# 也直接看 TOOLS_DATA 里 urlcode 附近
i = body.find("urlcode")
print("urlcode 附近:", body[i-40:i+80] if i > 0 else "N/A")
