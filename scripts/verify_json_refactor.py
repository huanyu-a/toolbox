# -*- coding: utf-8 -*-
"""验证 json.html 重构"""
import re, subprocess, os, tempfile

path = r"C:\project\wwwroot\toolbox\application\index\view\index\json.html"
src = open(path, encoding="utf-8").read()

print("文件大小:", len(src), "=", round(len(src)/1024, 1), "KB")
print("textarea 数:", len(re.findall(r"<textarea", src)))
print("t-tab 数:", len(re.findall(r'class="t-tab', src)))
print("选项区 opt-* 数:", len(re.findall(r'id="opt-', src)))
print("输入 id 唯一性: json-in 出现", src.count('id="json-in"'), "次 | json-out 出现", src.count('id="json-out"'), "次")
print("旧每tab独立id残留(fmt-input等):", len(re.findall(r'id="(?:fmt|esc|get|xml|yaml|csv|cs|java|go)-(?:input|output|result|error)"', src)))

# JS 语法
scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
print("内联脚本块:", len(scripts))
for i, code in enumerate(scripts):
    if not code.strip():
        continue
    f = os.path.join(tempfile.gettempdir(), f"json_check_{i}.js")
    open(f, "w", encoding="utf-8").write(code)
    r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
    print(f"  script#{i}: {'OK' if r.returncode == 0 else 'FAIL: ' + r.stderr.strip()[:300]}")
    os.remove(f)

# 功能完整性：9 个模式都在
modes = re.findall(r"data-mode=\"(\w+)\"", src)
print("模式:", modes)
