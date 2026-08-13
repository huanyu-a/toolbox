# -*- coding: utf-8 -*-
"""修正验证：跳过 JSON-LD + TOOLS_DATA 转义匹配"""
import re, subprocess, os, tempfile, urllib.request

body = urllib.request.urlopen("http://127.0.0.1:18080/encode/", timeout=20).read().decode("utf-8", "ignore")
scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", body, re.S)
ok = True
for i, code in enumerate(scripts):
    if not code.strip() or code.strip().startswith("{"):
        continue  # 跳过空块和 JSON-LD
    f = os.path.join(tempfile.gettempdir(), f"enc2_{i}.js")
    open(f, "w", encoding="utf-8").write(code)
    r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print(f"script#{i} FAIL: {r.stderr.strip()[:300]}")
    os.remove(f)
print("JS 语法:", "全部通过" if ok else "有失败")

m = re.search(r'"url":"\\/encode\\/","name":"([^"]+)"', body)
print("TOOLS_DATA encode:", m.group(1) if m else "未找到")

# 分类结构
tp = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
parts = re.split(r"'cat' => '", tp)[1:]
total = 0
for p in parts:
    cat = p.split("'")[0]
    n = len(re.findall(r"'url' => '([^']+)'", p))
    total += n
    flag = "✅" if n >= 5 else "❌"
    print(f"{cat}: {n} {flag}")
print("总数:", total, "| 括号:", tp.count("[") - tp.count("]"), tp.count("(") - tp.count(")"))
