# -*- coding: utf-8 -*-
"""删旧模板 + 全量验证"""
import os, re, urllib.request, urllib.error

vdir = r"C:\project\wwwroot\toolbox\application\index\view\index"
for f in ["chaicp.html", "whois.html", "checkurl.html", "checkweixin.html", "gzip.html", "checkkeyword.html"]:
    p = os.path.join(vdir, f)
    if os.path.exists(p):
        os.remove(p)
        print("已删除:", f)

def fetch(url, data=None):
    try:
        if data:
            req = urllib.request.Request("http://127.0.0.1:18080" + url, data=urllib.parse.urlencode(data).encode())
            with urllib.request.urlopen(req, timeout=15) as r:
                return r.status, r.read().decode("utf-8", "ignore")
        with urllib.request.urlopen("http://127.0.0.1:18080" + url, timeout=15) as r:
            return r.status, r.read().decode("utf-8", "ignore")
    except urllib.error.HTTPError as e:
        return e.code, ""
    except Exception as e:
        return -1, str(e)[:80]

# 1. /webcheck/ 渲染
st, html = fetch("/webcheck/")
print("\n/webcheck/: %s, 大小 %d" % (st, len(html)))
tabs = re.findall(r'data-panel="([^"]+)"', html)
print("tabs:", tabs)
m = re.search(r"<title>(.*?)</title>", html)
print("title:", m.group(1) if m else "N/A")

# 2. API 冒烟（用真实外部查询可能慢，这里只测参数校验分支）
import json as _json
for t, params in [
    ("chaicp", {"type": "chaicp", "icp": ""}),
    ("whois", {"type": "whois", "whois": "bad_domain_!!"}),
    ("gzip", {"type": "gzip", "q": ""}),
    ("checkkeyword", {"type": "checkkeyword", "txt_url": "", "txt_keyword": ""}),
]:
    st, body = fetch("/api/", params)
    print("api %s: %s %s" % (t, st, body[:120]))

# 3. 旧页 500
for u in ["/chaicp/", "/whois/", "/checkurl/", "/checkweixin/", "/gzip/", "/checkkeyword/"]:
    st, _ = fetch(u)
    print("旧页 %s: %s" % (u, st))

# 4. 全部入口 200
tools = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
items = re.findall(r"'url' => '(/[^']+)'", tools)
print("\n入口数:", len(items))
bad = []
for u in items:
    st, _ = fetch(u)
    if st != 200:
        bad.append((u, st))
print("异常入口:", bad if bad else "无，全部 200")
