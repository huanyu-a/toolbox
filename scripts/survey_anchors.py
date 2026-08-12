import os, re

base = r"C:\project\wwwroot\toolbox\application\index\view\index"
done = {"ascii","base64","hexconvert","json","md5","random","unixtime","urlcode",
        "guid","uuid","password","ip2long","shaencrypt","htmlescape","utf8","unicode",
        "subnetmask","formatfilter","index"}
todo = sorted(f for f in os.listdir(base) if f.endswith(".html") and f[:-5] not in done)

jq_anchor = re.compile(r'<script src="/static/script/jquery-1\.11\.3\.min\.js"')
panel_open = re.compile(r'<div class="panel[^"]*">')
accord_start = re.compile(r'<div class="container"><div class="row"><div class="col-md-12 col10main"><div class="accordion" id="accordion2"><div class="accordion-group">')
accord_start2 = re.compile(r'<div class="container">\s*<div class="row">\s*<div class="col-md-12(?: col10main)?">\s*<div class="accordion" id="accordion2">\s*<div class="accordion-group">')
nav_tabs = re.compile(r'<ul class="nav nav-tabs hbflag">')
alert = re.compile(r'<div class="alert[^"]*">')
desc_block = re.compile(r'<div class="in collapse bs-docs-demoexample">')

missing = []
for f in todo:
    src = open(os.path.join(base, f), encoding="utf-8").read()
    probs = []
    if not jq_anchor.search(src): probs.append("no-jquery-anchor")
    if not accord_start.search(src) and not accord_start2.search(src): probs.append("no-accordion-start")
    if not nav_tabs.search(src): probs.append("no-nav-tabs")
    if not panel_open.search(src): probs.append("no-panel")
    if not alert.search(src) and not desc_block.search(src): probs.append("no-desc")
    if probs:
        missing.append((f, probs))

for f, p in missing:
    print(f, p)
print("TOTAL with issues:", len(missing), "/", len(todo))
