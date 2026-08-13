# -*- coding: utf-8 -*-
import re, subprocess, tempfile, os

src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\webcheck.html", encoding="utf-8").read()
scripts = re.findall(r"<script[^>]*>(.*?)</script>", src, re.S)
print("script 块:", len(scripts))
for i, s in enumerate(scripts):
    s = s.strip()
    if not s:
        continue
    if "{" in s and "}" in s:  # 含模板变量则跳过（TP 语法）
        # 检查是否含 Think 模板变量
        if "{$" in s or "{include" in s or "{:" in s:
            print("  #%d 含模板语法，跳过 node 校验" % i)
            continue
    tmp = os.path.join(r"C:\project\wwwroot\toolbox\scripts", "_tmp_%d.js" % i)
    open(tmp, "w", encoding="utf-8").write(s)
    r = subprocess.run(["node", "--check", tmp], capture_output=True, text=True)
    os.remove(tmp)
    print("  #%d %s" % (i, "OK" if r.returncode == 0 else "FAIL: " + r.stderr[:200]))
