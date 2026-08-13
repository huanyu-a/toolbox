# -*- coding: utf-8 -*-
"""验证 unicode 按钮共享化"""
import re, subprocess, os, tempfile

path = r"C:\project\wwwroot\toolbox\application\index\view\index\unicode.html"
src = open(path, encoding="utf-8").read()

print("textarea:", len(re.findall(r"<textarea", src)), "（应为2）")
print("按钮组: ucToCode 出现", src.count('id="ucToCode"'), "| nuToCode 出现", src.count('id="nuToCode"'), "（应 1/0）")
print("radio 组: ucMode", src.count('name="ucMode"'), "| nuMode", src.count('name="nuMode"'), "（应各1）")
print("错误区: ucError", src.count('id="ucError"'), "| nuError", src.count('id="nuError"'), "（应各1）")
print("nu 按钮残留:", bool(re.search(r'id="nu(ToCode|ToText|Swap|Demo|Clear)"', src)))
print("currentMode 动态:", "currentMode === 'uc' ? 'ucError' : 'nuError'" in src)
print("动态 mode 查询:", "currentMode + 'Mode'" in src)

scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
for i, code in enumerate(scripts):
    if not code.strip():
        continue
    f = os.path.join(tempfile.gettempdir(), f"uni_{i}.js")
    open(f, "w", encoding="utf-8").write(code)
    r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
    print(f"script#{i}: {'OK' if r.returncode == 0 else 'FAIL: ' + r.stderr.strip()[:300]}")
    os.remove(f)
