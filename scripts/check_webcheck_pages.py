# -*- coding: utf-8 -*-
"""检查站长检测类页面的结构（服务端/前端分工）"""
import re, os

vdir = r"C:\project\wwwroot\toolbox\application\index\view\index"
for name in ["chaicp", "whois", "ip", "checkurl", "checkweixin", "gzip", "httpheader", "pagecode", "browserinfo", "useragent", "checkkeyword"]:
    p = os.path.join(vdir, name + ".html")
    if not os.path.exists(p):
        print("=" * 15, name, "不存在")
        continue
    src = open(p, encoding="utf-8", errors="ignore").read()
    m = re.search(r"<title>(.*?)</title>", src)
    d = re.search(r'tool-desc">(.*?)</p>', src)
    form = "form" in src.lower()
    ajax = ("$.ajax" in src or "fetch(" in src or "XMLHttpRequest" in src)
    php = ("<?php" in src)
    print("=" * 15, name, os.path.getsize(p), "B")
    print("  title:", m.group(1) if m else "?")
    print("  desc:", (d.group(1)[:80] if d else "?"))
    print("  含 form:", form, "| ajax:", ajax, "| php:", php)
