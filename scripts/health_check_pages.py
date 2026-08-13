# -*- coding: utf-8 -*-
"""批量请求所有合集/tab 页，检查 500"""
import urllib.request, urllib.error

pages = ["json", "calc", "format", "dns", "html2js", "regex", "keyboardcode",
         "random", "unixtime", "createmeta", "hexrgb", "ip", "pagecode",
         "ascii", "htmlescape", "httpheader", "deencrypt", "allencrypt",
         "uuid", "unicode", "linuxcmd", "subnetmask", "ports", "editor"]

base = "http://127.0.0.1:18080"
fails = []
for p in pages:
    try:
        req = urllib.request.Request(base + "/" + p + "/", headers={"User-Agent": "health-check"})
        resp = urllib.request.urlopen(req, timeout=15)
        body = resp.read().decode("utf-8", "ignore")
        status = resp.status
        ok = status == 200
        print(f"{'✅' if ok else '❌'} {p:16s} {status}  {len(body)//1024}KB")
        if not ok:
            fails.append(p)
    except urllib.error.HTTPError as e:
        print(f"❌ {p:16s} {e.code}")
        fails.append(p)
    except Exception as e:
        print(f"❌ {p:16s} {e}")
        fails.append(p)

print("\n失败:", fails if fails else "无 ✅ 全部 200")
