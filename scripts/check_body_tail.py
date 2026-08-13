# -*- coding: utf-8 -*-
"""检查渲染 HTML 的 body 结尾与 search-pop 闭合"""
import urllib.request

body = urllib.request.urlopen("http://127.0.0.1:18080/urlcode/", timeout=15).read().decode("utf-8", "ignore")
i = body.find("<body>")
seg = body[i:]

print("search-pop 开标签:", seg.count('class="search-pop"'))
print("tool-wrap 出现:", seg.count("tool-wrap"))
print("tool-card 出现:", seg.count("tool-card"))
print("=== body 末尾 1200 字符 ===")
print(seg[-1200:])
