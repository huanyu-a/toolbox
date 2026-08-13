# -*- coding: utf-8 -*-
"""验证 unicode 重构"""
import re, subprocess, os, tempfile

path = r"C:\project\wwwroot\toolbox\application\index\view\index\unicode.html"
src = open(path, encoding="utf-8").read()

print("textarea:", len(re.findall(r"<textarea", src)), "| 共享 grid:", "ucInput" in src and "ucOutput" in src)
print("uc bind:", "bind('ucInput', 'ucOutput', 'ucError', 'ucMode')" in src)
print("nu bind:", "bind('ucInput', 'ucOutput', 'nuError', 'nuMode')" in src)
print("所有按钮 id 都在:", all(f'id="{b}"' in src for b in ["ucToCode","ucToText","ucSwap","ucDemo","ucClear","nuToCode","nuToText","nuSwap","nuDemo","nuClear"]))

scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
for i, code in enumerate(scripts):
    if not code.strip():
        continue
    f = os.path.join(tempfile.gettempdir(), f"unicode_{i}.js")
    open(f, "w", encoding="utf-8").write(code)
    r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
    print(f"script#{i}: {'OK' if r.returncode == 0 else 'FAIL: ' + r.stderr.strip()[:200]}")
    os.remove(f)
