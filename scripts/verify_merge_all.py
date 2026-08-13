# -*- coding: utf-8 -*-
"""全面验证加密解密合并页"""
import re, urllib.request, json, subprocess, os, tempfile

BASE = "http://127.0.0.1:18080"

# 1. 新页面渲染
body = urllib.request.urlopen(BASE + "/encrypt/", timeout=15).read().decode("utf-8", "ignore")
print("=== /encrypt/ 渲染 ===")
print("状态: 200, 大小:", len(body))
print("标题:", re.search(r"<title>([^<]+)</title>", body).group(1))
print("tabs:", len(re.findall(r'class="t-tab', body)), "panels:", len(re.findall(r'class="t-panel', body)))
print("含 对称加密/解密:", "dePanel" in body, "| 哈希:", "haPanel" in body, "| htpasswd:", "hpPanel" in body)

# 2. 三个旧页面应 404
for old in ["deencrypt", "allencrypt", "htpasswd"]:
    try:
        r = urllib.request.urlopen(BASE + "/" + old + "/", timeout=10)
        print(f"旧页面 {old}: {r.status} ❌（应 404）")
    except urllib.error.HTTPError as e:
        print(f"旧页面 {old}: {e.code} ✅")

# 3. 内联 JS 语法
src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\encrypt.html", encoding="utf-8").read()
scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
for i, code in enumerate(scripts):
    if not code.strip():
        continue
    f = os.path.join(tempfile.gettempdir(), f"encrypt_inline_{i}.js")
    open(f, "w", encoding="utf-8").write(code)
    r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
    print(f"内联 script#{i}: {'OK' if r.returncode == 0 else 'FAIL: ' + r.stderr.strip()[:200]}")
    os.remove(f)

# 4. 脚本加载完整
for s in ["pcjson-aes.js", "tripledes.js", "rabbit.js", "rc4.js", "pcjson-md5.js", "pcjson-sha3.js", "htpasswd.js", "htpmd5.js"]:
    print(f"加载 {s}:", "✅" if s in body else "❌")

# 5. TOOLS_DATA 新结构
m = re.search(r"window.TOOLS_DATA = (\[.*?\]);", body, re.S)
tools = json.loads(m.group(1))
enc = None
for cat in tools:
    for it in cat["items"]:
        if it["url"].rstrip("/") == "/encrypt":
            enc = it
print("\nTOOLS_DATA 中 encrypt:", enc)

# 6. 首页热门链接
home = urllib.request.urlopen(BASE + "/", timeout=15).read().decode("utf-8", "ignore")
print("首页热门含 /encrypt/:", 'href="/encrypt/"' in home, "| 残留 allencrypt:", "allencrypt" in home)

# 7. 残留引用扫描
print("\n=== 残留引用 ===")
for root_dir in [r"C:\project\wwwroot\toolbox\application", r"C:\project\wwwroot\toolbox\config"]:
    for dp, dn, fn in os.walk(root_dir):
        dn[:] = [d for d in dn if d not in {".git", "runtime"}]
        for f in fn:
            if not f.endswith((".html", ".php", ".js")):
                continue
            fp = os.path.join(dp, f)
            s = open(fp, encoding="utf-8", errors="ignore").read()
            for kw in ["deencrypt", "allencrypt", "htpasswd"]:
                if kw in s and not f.startswith("encrypt"):
                    print("残留:", fp.replace("C:\\project\\wwwroot\\toolbox\\", ""), "→", kw)
