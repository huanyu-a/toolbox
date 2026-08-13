# -*- coding: utf-8 -*-
"""检测关键页面的合并状态"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

def check(name):
    src = open(os.path.join(BASE, name + ".html"), encoding="utf-8").read()
    tabs = len(re.findall(r'class="t-tab', src))
    panels = len(re.findall(r'class="t-panel', src))
    h2 = re.sub(r"<[^>]+>", "", (re.search(r'<h2[^>]*>(.*?)</h2>', src, re.S) or re.search(r"<h2[^>]*>([^<]+)</h2>", src)).group(1)).strip()[:24] if re.search(r"<h2[^>]*>", src) else ""
    old_skin = "tool-card" not in src
    return f"{name:16s} tabs={tabs:2d} panels={panels:2d} old_skin={old_skin} | {h2}"

# 关键合并目标页
targets = ["json", "calc", "format", "dns", "html2js", "regex", "keyboardcode", "random",
           "unixtime", "createmeta", "hexrgb", "ip", "pagecode", "ascii", "htmlescape",
           "httpheader", "deencrypt", "allencrypt", "uuid", "unicode", "capital", "enlower",
           "guid", "md5", "urlcode", "urlencode", "base64", "escape"]
print("=== 关键页状态 ===")
for t in targets:
    print(check(t))
