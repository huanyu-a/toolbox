# -*- coding: utf-8 -*-
import re, os

vdir = r"C:\project\wwwroot\toolbox\application\index\view\index"
for name in ["chaicp", "whois", "checkweixin", "gzip", "checkkeyword"]:
    p = os.path.join(vdir, name + ".html")
    src = open(p, encoding="utf-8", errors="ignore").read()
    scripts = re.findall(r"<script[^>]*>(.*?)</script>", src, re.S)
    print("=" * 25, name, "| script 块:", len(scripts))
    for s in scripts:
        s = s.strip()
        if len(s) > 30 and ("post" in s or "get" in s or "ajax" in s or "url" in s or "type" in s):
            print(s[:1800])
            print("---")
