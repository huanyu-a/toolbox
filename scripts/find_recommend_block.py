# -*- coding: utf-8 -*-
"""找详情页的相关推荐区块 + 数 body 直接 div"""
import urllib.request, re

body = urllib.request.urlopen("http://127.0.0.1:18080/urlcode/", timeout=15).read().decode("utf-8", "ignore")
i = body.find("<body>")
seg = body[i:]

# 找推荐/相关关键词
for kw in ["推荐", "相关", "hot", "Hot", "rand", "热门", "大家都在", "更多工具"]:
    for m in re.finditer(kw, seg):
        j = m.start()
        print(f"关键词 [{kw}] @ {j}: ...{seg[max(0,j-80):j+80].replace(chr(10),' ')}...")
        break  # 每词只看第一个

print()
# 用容错方式数 body 直接子元素（简单标签栈解析）
# 先找 body 之后所有顶层标签序列：用 html5lib 风格的正则近似
# 直接数 body 后到 </body> 的顶层 div：维护栈
import re as _re
stack = []
top_divs = []
pos = 0
# 提取所有标签
for m in _re.finditer(r"<(/?)(div|nav|button|script|header|footer|section|main|ul|a|span|p|h\d|form|table|link|meta|title|style)[^>]*>", seg):
    closing, tag = m.group(1), m.group(2)
    if closing:
        if stack and stack[-1] == tag:
            stack.pop()
    else:
        if tag in ("link", "meta", "title", "style", "img", "br", "hr", "input"):
            continue
        if not stack:
            top_divs.append((tag, m.group(0)[:60], m.start()))
        stack.append(tag)

print("顶层元素序列:")
for t in top_divs[:30]:
    print("  ", t)
