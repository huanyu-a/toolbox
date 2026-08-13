# -*- coding: utf-8 -*-
"""验证 unicode 单工具版完整性"""
import re, subprocess, os, tempfile, urllib.request

path = r"C:\project\wwwroot\toolbox\application\index\view\index\unicode.html"
src = open(path, encoding="utf-8").read()

print("=== 结构 ===")
print("textarea:", len(re.findall(r"<textarea", src)), "（应2: ucInput/ucOutput）")
print("tab 残留:", len(re.findall(r"t-tab", src)), "（应0）")
print("radio 组:", sorted(set(re.findall(r'name="(\w+)"', src))))
print("按钮:", sorted(set(re.findall(r'id="(uc\w+|nu\w+)"', src))))
print("错误区:", sorted(set(re.findall(r'id="(\w*Error)"', src))))

# JS 语法
scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
ok = True
for i, code in enumerate(scripts):
    if not code.strip():
        continue
    f = os.path.join(tempfile.gettempdir(), f"uni_single_{i}.js")
    open(f, "w", encoding="utf-8").write(code)
    r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
    print(f"script#{i}: {'OK' if r.returncode == 0 else 'FAIL: ' + r.stderr.strip()[:200]}")
    ok = ok and r.returncode == 0
    os.remove(f)

# 渲染
try:
    body = urllib.request.urlopen("http://127.0.0.1:18080/unicode/", timeout=15).read().decode("utf-8", "ignore")
    print("渲染:", 200, "含标题:", "Unicode" in body[:500])
except Exception as e:
    print("渲染失败:", e)
