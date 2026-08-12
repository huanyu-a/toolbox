import os, re, subprocess, tempfile

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
DONE = {"ascii","base64","hexconvert","json","md5","random","unixtime","urlcode",
        "guid","uuid","password","ip2long","shaencrypt","htmlescape","utf8","unicode",
        "subnetmask","formatfilter","index"}

files = sorted(f for f in os.listdir(BASE) if f.endswith(".html") and f[:-5] not in DONE)
issues = []

for f in files:
    src = open(os.path.join(BASE, f), encoding="utf-8").read()
    probs = []
    # 1. 新皮肤骨架
    if 'class="tool-card"' not in src:
        probs.append("no tool-card")
    if 'class="tool-wrap"' not in src:
        probs.append("no tool-wrap")
    # 2. 旧骨架残留
    if "nav-tabs" in src:
        probs.append("nav-tabs leftover")
    if "accordion" in src:
        probs.append("accordion leftover")
    # 3. 模板 SEO 保留
    if "keywords" not in src or "$Think.config.web" not in src:
        probs.append("SEO missing")
    # 4. tool-title 存在
    if 'tool-title' not in src:
        probs.append("no tool-title")
    # 5. 尾部关键脚本
    if "{include file=\"footer\"" not in src and "{include file=\"footer\"" not in src:
        probs.append("no footer include")
    if 'app.js' not in src:
        probs.append("no app.js")
    # 6. 乱码检测（U+FFFD 替换字符）
    if "\ufffd" in src:
        probs.append("REPLACEMENT CHAR")
    if probs:
        issues.append((f, probs))

print("pages with issues: %d / %d" % (len(issues), len(files)))
for f, p in issues:
    print("  ", f, p)
