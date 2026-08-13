# -*- coding: utf-8 -*-
"""验证：页面 200 + CSS 可访问 + CSS 包含 tab 样式"""
import urllib.request

# 1. 页面状态
for p in ["json", "html2js", "calc", "dns", "unicode"]:
    try:
        r = urllib.request.urlopen(f"http://127.0.0.1:18080/{p}/", timeout=15)
        body = r.read().decode("utf-8", "ignore")
        print(f"✅ {p}: {r.status} {len(body)//1024}KB")
    except Exception as e:
        print(f"❌ {p}: {e}")

# 2. CSS 可访问且含 tab 样式
try:
    r = urllib.request.urlopen("http://127.0.0.1:18080/static/style/site.min.css", timeout=15)
    css = r.read().decode("utf-8", "ignore")
    print(f"\nCSS: {r.status} {len(css)//1024}KB")
    print("含 .t-tabs flex:", ".t-tabs" in css and "flex-wrap" in css)
    print("含 .t-panel.active:", ".t-panel.active" in css)
    # 检查缓存头
    print("Cache-Control:", r.headers.get("Cache-Control"))
    print("Last-Modified:", r.headers.get("Last-Modified"))
except Exception as e:
    print("CSS 请求失败:", e)
