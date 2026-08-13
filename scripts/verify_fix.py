# -*- coding: utf-8 -*-
"""验证 uuid/unicode 修复页 JS 语法 + 关键标识"""
import re, subprocess, os, tempfile

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

for name, kws in [("uuid", ["GUID", "guidRun", "guidOutput", "uuidRun", "t-tab", "t-panel"]),
                  ("unicode", ["Native", "nuInput", "nuDemo", "ucDemo", "t-tab", "t-panel"])]:
    src = open(os.path.join(BASE, name + ".html"), encoding="utf-8").read()
    print(f"=== {name}.html ({len(src)}B) ===")
    for kw in kws:
        print(f"  {'✓' if kw in src else '✗'} {kw}")
    scripts = re.findall(r"<script>(.*?)</script>", src, re.S)
    for i, code in enumerate(scripts):
        p = os.path.join(tempfile.gettempdir(), f"{name}_{i}.js")
        open(p, "w", encoding="utf-8").write(code)
        r = subprocess.run(["node", "--check", p], capture_output=True, text=True)
        print(f"  script#{i}: {'OK' if r.returncode == 0 else 'FAIL: ' + r.stderr.strip()[:200]}")
        os.remove(p)
