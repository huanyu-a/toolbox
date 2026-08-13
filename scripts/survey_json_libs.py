import os, re

BASE = r"C:\project\wwwroot\toolbox\public\static\script\pcjs"
files = ["json2go.js", "gofmt.js", "gojs.js", "tool2java.js", "excel2json.js", "json2excel.js", "sql2java.js", "yaml.js", "json2yaml.js"]
for f in files:
    p = os.path.join(BASE, f)
    if not os.path.exists(p):
        print("=== %s MISSING ===" % f)
        continue
    size = os.path.getsize(p)
    src = open(p, encoding="utf-8", errors="ignore").read()
    # function signatures
    sigs = re.findall(r'function\s+([A-Za-z_$][\w$]*)\s*\(([^)]*)\)', src)
    print("=== %s (%dB) ===" % (f, size))
    for name, args in sigs[:20]:
        print("  fn %s(%s)" % (name, args.strip()[:60]))
