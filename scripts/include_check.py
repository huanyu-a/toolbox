import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
DONE = {"ascii","base64","hexconvert","json","md5","random","unixtime","urlcode",
        "guid","uuid","password","ip2long","shaencrypt","htmlescape","utf8","unicode",
        "subnetmask","formatfilter","index","editor"}
files = sorted(f for f in os.listdir(BASE) if f.endswith(".html") and f[:-5] not in DONE)

issues = []
for f in files:
    src = open(os.path.join(BASE, f), encoding="utf-8").read()
    probs = []
    if '{include file="header" /}' not in src:
        probs.append("no header include")
    if '{include file="footer" /}' not in src:
        probs.append("no footer include")
    if '{include file="nav" /}' not in src:
        probs.append("no nav include")
    if '<body>' not in src:
        probs.append("no body")
    if '</html>' not in src:
        probs.append("no html close")
    if 'tool-title' not in src:
        probs.append("no tool-title")
    if probs:
        issues.append((f, probs))
print("pages with include issues:", len(issues))
for f, p in issues:
    print("  ", f, p)
