import os, re

base = r"C:\project\wwwroot\toolbox\application\index\view\index"
done = {"ascii","base64","hexconvert","json","md5","random","unixtime","urlcode",
        "guid","uuid","password","ip2long","shaencrypt","htmlescape","utf8","unicode",
        "subnetmask","formatfilter","index"}
files = sorted(f for f in os.listdir(base) if f.endswith(".html"))
todo = [f for f in files if f[:-5] not in done]

stats = {}
for f in todo:
    src = open(os.path.join(base, f), encoding="utf-8").read()
    key = []
    key.append("nav-tabs" if "nav nav-tabs hbflag" in src else "no-tabs")
    m = re.search(r'<div class="(panel[^"]*)">', src)
    key.append("panel:" + m.group(1) if m else "no-panel")
    key.append("alert" if 'class="alert' in src else "no-alert")
    m2 = re.search(r'<form[^>]*class="([^"]*)"', src)
    key.append("form:" + (m2.group(1) if m2 else "none"))
    key.append("setJS" if "setJS(" in src else "nosetJS")
    key.append("hightout" if "hightout.js" in src else "nohightout")
    stats.setdefault(" | ".join(key), []).append(f)

for k, v in sorted(stats.items(), key=lambda x: -len(x[1])):
    print("%4d  %s" % (len(v), k))
    print("       e.g.", ", ".join(v[:6]))
print("\nTOTAL todo:", len(todo))
