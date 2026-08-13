# -*- coding: utf-8 -*-
"""验证 html2js 重构"""
import re, subprocess, os, tempfile

path = r"C:\project\wwwroot\toolbox\application\index\view\index\html2js.html"
src = open(path, encoding="utf-8").read()

print("文件大小:", round(len(src)/1024, 1), "KB")
print("textarea 数:", len(re.findall(r"<textarea", src)))
print("t-tab 数:", len(re.findall(r'class="t-tab', src)))

# id 唯一性
ids = re.findall(r'id="([^"]+)"', src)
dup = {i: ids.count(i) for i in set(ids) if ids.count(i) > 1}
print("重复 id:", dup if dup else "无 ✅")

# 模式完整性
modes = re.findall(r'data-mode="(\w+)"', src)
print("模式:", modes)

# 按钮 id 都在
btns = ["jsToJs","jsToHtml","jsToArray","cjToCsharp","cjToJsp","phpRun",
        "aspRun","aspVbnet","aspPerl","aspSws","ubbToUbb","ubbToHtml","tblRun","csvRun"]
missing = [b for b in btns if f'id="{b}"' not in src]
print("按钮缺失:", missing if missing else "无 ✅")

# 每个按钮都有绑定
unbound = [b for b in btns if src.count(f"'{b}'") < 2 and src.count(f'"{b}"') < 2]
print("未绑定按钮:", unbound if unbound else "无 ✅")

# 转换函数完整
fns = ["jsString","jsArray","jsToHtml","toJsp","toCSharp","toPhp","toAsp",
       "toVbnet","toPerl","toSws","pattern","up","parseCsvLine"]
missing_fns = [f for f in fns if f"function {f}" not in src]
print("缺失函数:", missing_fns if missing_fns else "无 ✅")

# JS 语法
scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
print("内联脚本块:", len(scripts))
for i, code in enumerate(scripts):
    if not code.strip():
        continue
    f = os.path.join(tempfile.gettempdir(), f"h2j_check_{i}.js")
    open(f, "w", encoding="utf-8").write(code)
    r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
    print(f"  script#{i}: {'OK' if r.returncode == 0 else 'FAIL: ' + r.stderr.strip()[:300]}")
    os.remove(f)
