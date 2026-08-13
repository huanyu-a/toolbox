# -*- coding: utf-8 -*-
"""删除旧模板 + 验证本批改动"""
import os, re, urllib.request

base = r"C:\project\wwwroot\toolbox\application\index\view\index"
for f in ["camelcase.html", "htmlescape.html"]:
    p = os.path.join(base, f)
    if os.path.exists(p):
        os.remove(p)
        print("已删除:", f)
    else:
        print("不存在(跳过):", f)

def fetch(url):
    try:
        with urllib.request.urlopen("http://127.0.0.1:18080" + url, timeout=10) as r:
            return r.status, r.read().decode("utf-8", "ignore")
    except urllib.error.HTTPError as e:
        return e.code, ""

# encode 页
st, html = fetch("/encode/")
print("\n/encode/: %s, 大小 %d" % (st, len(html)))
tabs = re.findall(r'data-panel="([^"]+)"', html)
print("tabs:", len(tabs), tabs[:14])
m = re.search(r"<title>(.*?)</title>", html)
print("title:", m.group(1) if m else "N/A")

# textconvert 页
st, html = fetch("/textconvert/")
print("\n/textconvert/: %s, 大小 %d" % (st, len(html)))
tabs = re.findall(r'data-panel="([^"]+)"', html)
print("tabs:", len(tabs), tabs)
for panel in ["tcCamel"]:
    print("含 %s:" % panel, ('id="%s"' % panel) in html)

# 旧页 500
for u in ["/camelcase/", "/htmlescape/"]:
    st, _ = fetch(u)
    print("旧页 %s: %s" % (u, st))
