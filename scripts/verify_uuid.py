# -*- coding: utf-8 -*-
"""验证 uuid.html：JS 语法 + 无残留引用"""
import re, os, subprocess, sys

path = r"C:\project\wwwroot\toolbox\application\index\view\index\uuid.html"
src = open(path, encoding="utf-8").read()

ok = True

# 1. 提取内联 script 并 node --check
blocks = re.findall(r"<script(?![^>]*src=)[^>]*>(.*?)</script>", src, re.S)
tmp = r"C:\project\wwwroot\toolbox\scripts\tmp_uuid.js"
os.makedirs(os.path.dirname(tmp), exist_ok=True)
for i, b in enumerate(blocks):
    with open(tmp, "w", encoding="utf-8") as f:
        f.write(b)
    r = subprocess.run(["node", "--check", tmp], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print("JS FAIL block %d" % i)
        print(r.stderr[:1200])
    else:
        print("JS OK block %d (%d bytes)" % (i, len(b)))

# 2. 残留检查
for bad in ["uuidPanel1", "uuidPanel2", "guidPanel", "guidNum", "guidCase", "guidFmt",
            "guidRun", "guidClear", "guidOutput", "guidError", "guidResult",
            "data-panel", "t-tab"]:
    if bad in src:
        ok = False
        print("LEFTOVER: %r" % bad)

# 3. 期望项
for need in ["uuidPanel", "uuidNum", "uuidCase", "uuidFmt", "brace", "urn", "uuidRun", "uuidOutput"]:
    if need not in src:
        ok = False
        print("MISSING: %r" % need)

print("ALL_OK" if ok else "HAS_FAILURES")
sys.exit(0 if ok else 1)
