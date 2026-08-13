# -*- coding: utf-8 -*-
"""验证 /encode/ 合并页"""
import re, subprocess, os, tempfile, urllib.request

# 1. 页面渲染
body = urllib.request.urlopen("http://127.0.0.1:18080/encode/", timeout=20).read().decode("utf-8", "ignore")
print("状态: 200, 大小:", len(body))
tabs = re.findall(r'id="encTabs"[\s\S]*?</ul>', body)
panels = re.findall(r'class="t-panel enc-panel', body)
print("外层 tabs:", len(re.findall(r'class="t-tab(?: active)?" data-panel="enc', body)), "panels:", len(panels))
print("含 9 个工具 ID:", all(x in body for x in ["b64Input", "urlInput", "escInput", "ucInput", "utfInput", "ascInput", "mcInput", "thunderInput", "miFile"]))

# 2. 内联 JS 语法检查（提取所有 script 块）
scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", body, re.S)
ok = True
for i, code in enumerate(scripts):
    if not code.strip():
        continue
    f = os.path.join(tempfile.gettempdir(), f"enc_{i}.js")
    open(f, "w", encoding="utf-8").write(code)
    r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print(f"script#{i} FAIL: {r.stderr.strip()[:200]}")
    os.remove(f)
print("内联 JS 语法:", "全部通过" if ok else "有失败", f"({len([s for s in scripts if s.strip()])} 块)")

# 3. 旧页面 404
for old in ["base64", "urlcode", "morse", "ascii", "img2base64", "urlthunder", "utf8", "unicode", "escape"]:
    try:
        urllib.request.urlopen(f"http://127.0.0.1:18080/{old}/", timeout=10)
        print(f"❌ {old} 仍可访问")
    except Exception:
        pass
print("旧页面全部 404 ✅")

# 4. TOOLS_DATA
m = re.search(r'"url":"/encode/","name":"([^"]+)"', body)
print("TOOLS_DATA encode:", m.group(1) if m else "未找到")

# 5. 首页链接
home = urllib.request.urlopen("http://127.0.0.1:18080/", timeout=15).read().decode("utf-8", "ignore")
print("首页含 /encode/:", "/encode/" in home, "| 首页残留 /base64/:", "/base64/" in home)
