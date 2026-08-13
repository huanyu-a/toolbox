# -*- coding: utf-8 -*-
"""检查 autoformat/editor/html2js 三个页面的功能定位"""
import re, os

vdir = r"C:\project\wwwroot\toolbox\application\index\view\index"
for name in ["autoformat", "editor", "html2js", "format"]:
    p = os.path.join(vdir, name + ".html")
    src = open(p, encoding="utf-8", errors="ignore").read()
    m = re.search(r"<title>(.*?)</title>", src)
    d = re.search(r'tool-desc">(.*?)</p>', src)
    tabs = re.findall(r'data-panel="([^"]+)"', src)
    scripts = re.findall(r'src="([^"]+\.js)"', src)
    print("=" * 20, name, os.path.getsize(p), "B")
    print("  title:", m.group(1) if m else "?")
    print("  desc:", (d.group(1)[:100] if d else "?"))
    print("  tabs:", tabs[:12])
    print("  ext js:", [s.split("/")[-1] for s in scripts])
