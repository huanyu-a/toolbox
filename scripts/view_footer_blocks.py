# -*- coding: utf-8 -*-
"""查看 foot-history 与 foot-nav-wrap 区块内容"""
import urllib.request

body = urllib.request.urlopen("http://127.0.0.1:18080/urlcode/", timeout=15).read().decode("utf-8", "ignore")
i = body.find("<body>")
seg = body[i:]

# 提取 foot-history 区块
j = seg.find('class="container foot-history"')
if j > 0:
    end = seg.find("</div>", j)
    print("=== foot-history (div[6]) ===")
    print(seg[j:end+6][:800])
    print()

# 提取 foot-nav-wrap 区块
k = seg.find('class="container foot-nav-wrap"')
if k > 0:
    # 找其结束（到 copyright 前）
    c = seg.find('class="copyright"', k)
    print("=== foot-nav-wrap (div[7]) ===")
    print(seg[k:c][:1500])
