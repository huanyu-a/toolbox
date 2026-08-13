import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
pages = ["json2xml.html", "json2get.html", "json2yaml.html", "json2go.html", "json2java.html", "json2cs.html", "sql2java.html", "excel2json.html", "json2excel.html", "jsonzip.html", "jsonudview.html", "jsonlrview.html"]

out = []
for p in pages:
    path = os.path.join(BASE, p)
    if not os.path.exists(path):
        out.append("=== %s MISSING ===" % p)
        continue
    src = open(path, encoding="utf-8", errors="ignore").read()
    setjs = re.findall(r'setJS\(\[(.*?)\]\)', src, re.S)
    calls = re.findall(r'onclick="([^"]+)"', src)[:8]
    refs = re.findall(r'src="(/static/script/[^"]+)"', src)
    out.append("=== %s (%dB) ===" % (p, len(src)))
    if setjs:
        out.append("  setJS: %s" % setjs[0][:400])
    if calls:
        out.append("  calls: %s" % calls)
    if refs:
        out.append("  refs: %s" % refs[:8])
    defs = re.findall(r'function\s+([A-Za-z_$][\w$]*)\s*\(', src)
    if defs:
        out.append("  defs: %s" % defs[:15])

open(r"C:\project\wwwroot\toolbox\scripts\json_pages_survey.txt", "w", encoding="utf-8").write("\n".join(out))
print("written", len(out), "lines")
