# -*- coding: utf-8 -*-
"""验证子智能体改造成果：linuxcmd + subnetmask + ports"""
import os, re, subprocess, tempfile

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

def check_js(name):
    src = open(os.path.join(BASE, name + ".html"), encoding="utf-8").read()
    scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    ok = True
    for i, code in enumerate(scripts):
        if not code.strip():
            continue
        f = os.path.join(tempfile.gettempdir(), f"v_{name}_{i}.js")
        open(f, "w", encoding="utf-8").write(code)
        r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
        if r.returncode != 0:
            ok = False
            print(f"  ✗ {name} script#{i}: {r.stderr.strip()[:150]}")
        os.remove(f)
    return ok

print("========== linuxcmd.html ==========")
src = open(BASE + r"\linuxcmd.html", encoding="utf-8").read()
print("体积:", len(src), "B")
print("t-tab 数:", len(re.findall(r'class="t-tab', src)), "| t-panel 数:", len(re.findall(r'class="t-panel', src)))
print("table 数:", src.count("<table"), "| tr 数:", src.count("<tr"))
print("搜索框:", "linuxSearch" in src, "| 过滤逻辑:", "indexOf(kw)" in src or "toLowerCase" in src)
print("旧 accordion 残留:", src.count("accordion"))
print("JS:", "OK" if check_js("linuxcmd") else "FAIL")

print("\n========== subnetmask.html ==========")
src = open(BASE + r"\subnetmask.html", encoding="utf-8").read()
print("体积:", len(src), "B")
print("tool-card 数:", src.count("tool-card"), "| col10main 残留:", src.count("col10main"), "| accordion 残留:", src.count("accordion"))
print("form 数:", src.count("<form"), "| button 数:", len(re.findall(r"<(?:button|input)[^>]*type=\"(?:button|submit)\"", src)))
print("onclick 数:", len(re.findall(r"\sonclick=", src)))
print("死链 hbflag 残留:", src.count("hbflag"))
print("JS:", "OK" if check_js("subnetmask") else "FAIL")

print("\n========== ports.html（此前已增强）==========")
src = open(BASE + r"\ports.html", encoding="utf-8").read()
print("搜索框:", "portSearch" in src, "| tr 数:", src.count("<tr"))
print("JS:", "OK" if check_js("ports") else "FAIL")

print("\n========== 全站 tool.js 残留复核 ==========")
hits = []
for f in os.listdir(BASE):
    if f.endswith(".html"):
        s = open(os.path.join(BASE, f), encoding="utf-8").read()
        if "tool.js" in s:
            hits.append(f)
print("仍引用 tool.js 的页面:", hits if hits else "无 ✅")
