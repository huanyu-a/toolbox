# -*- coding: utf-8 -*-
"""渲染验证：首页/详情页/顶栏菜单的分类联动"""
import urllib.request, re, json

# 首页
body = urllib.request.urlopen("http://127.0.0.1:18080/", timeout=15).read().decode("utf-8", "ignore")
cats = re.findall(r'class="home-cat-name">([^<]+)</span>', body)
counts = re.findall(r'class="home-cat-count">(\d+) 个</span>', body)
print("首页分类区块:", list(zip(cats, counts)))
print("首页分类数:", len(cats))

# 顶栏菜单
menu = re.findall(r'data-cat="([^"]+)"', body)
print("顶栏菜单分类:", menu)

# 详情页（含 TOOLS_DATA + 随机推荐）
body2 = urllib.request.urlopen("http://127.0.0.1:18080/urlcode/", timeout=15).read().decode("utf-8", "ignore")
m = re.search(r"window.TOOLS_DATA = (\[.*?\]);", body2, re.S)
tools = json.loads(m.group(1))
print("\n详情页 TOOLS_DATA 分类数:", len(tools))
for c in tools:
    print(f"  {c['cat']}: {len(c['items'])}")
print("详情页随机推荐含新分类:", "常用工具推荐" in body2)
