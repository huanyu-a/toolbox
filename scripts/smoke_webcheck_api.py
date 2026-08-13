# -*- coding: utf-8 -*-
"""真实功能冒烟：chaicp/whois/gzip/checkkeyword 真实查询"""
import urllib.request, urllib.parse, json

def api(params, timeout=20):
    try:
        req = urllib.request.Request(
            "http://127.0.0.1:18080/api/",
            data=urllib.parse.urlencode(params).encode(),
        )
        with urllib.request.urlopen(req, timeout=timeout) as r:
            return json.loads(r.read().decode("utf-8", "ignore"))
    except Exception as e:
        return {"status": -1, "msg": str(e)[:100]}

tests = [
    ("chaicp", {"type": "chaicp", "icp": "baidu.com"}),
    ("whois", {"type": "whois", "whois": "baidu.com"}),
    ("gzip", {"type": "gzip", "q": "baidu.com"}),
    ("checkkeyword", {"type": "checkkeyword", "txt_url": "http://www.baidu.com", "txt_keyword": "百度"}),
]
for name, params in tests:
    res = api(params)
    if name == "chaicp":
        print(name, "→", "status:", res.get("status"), "| data:", (res.get("data") or {}).get("网站域名") or res.get("msg"))
    elif name == "whois":
        d = res.get("data") or {}
        print(name, "→", "status:", res.get("status"), "| 注册商:", d.get("注册商") or res.get("msg"), "| 字段数:", len(d))
    elif name == "gzip":
        d = res.get("data") or {}
        jc = d.get("jc") or {}
        print(name, "→", "status:", res.get("status"), "| 压缩:", jc.get("ystype") or res.get("msg"))
    else:
        d = res.get("data") or {}
        print(name, "→", "status:", res.get("status"), "| 密度:", d.get("html_mdjgjs"), "| 次数:", d.get("html_gjcsl") or res.get("msg"))
