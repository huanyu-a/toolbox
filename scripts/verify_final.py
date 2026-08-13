# -*- coding: utf-8 -*-
"""精确验证推荐工具数量 + TOOLS_DATA 反查"""
import re, urllib.request, json

body = urllib.request.urlopen("http://127.0.0.1:18080/urlcode/", timeout=15).read().decode("utf-8", "ignore")

m = re.search(r'<ul class="list-inline rand-tools">([\s\S]*?)</ul>', body)
links = re.findall(r'<a href="([^"]+)"[^>]*>([^<]+)</a>', m.group(1))
print("推荐工具数量:", len(links))
print("前 3 个:", [n for _, n in links])

m2 = re.search(r"window.TOOLS_DATA = (\[.*?\]);", body, re.S)
tools = json.loads(m2.group(1))
for cat in tools:
    for it in cat["items"]:
        if it["url"].rstrip("/") == "/urlcode":
            print("反查名称:", it["name"])
