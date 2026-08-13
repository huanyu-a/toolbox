# -*- coding: utf-8 -*-
"""对比原版 json.html 与新版：检查功能是否遗漏（尤其 sql2java）"""
import re, subprocess

r = subprocess.run(["git", "show", "HEAD:application/index/view/index/json.html"],
                   capture_output=True, text=True, encoding="utf-8")
old = r.stdout
new = open(r"C:\project\wwwroot\toolbox\application\index\view\index\json.html", encoding="utf-8").read()

print("原版大小:", len(old), "| 新版大小:", len(new))

# 原版 tab 标题
tabs = re.findall(r'<button[^>]*class="t-tab[^"]*"[^>]*>([^<]{0,50})</button>', old)
print("\n原版 tabs:")
for t in tabs:
    print("  ", t)

print("\nSQL 功能检查:")
print("  原版含 sql2java 逻辑:", "sql2java" in old or "SQL" in old)
print("  新版含 SQL:", "SQL" in old and "SQL" in new)

# 提取原版所有按钮 id 与新版对比
old_btns = set(re.findall(r'id="([a-zA-Z0-9-]+)"', old))
new_btns = set(re.findall(r'id="([a-zA-Z0-9-]+)"', new))
missing = old_btns - new_btns
print("\n原版有但新版缺的 id:")
print(sorted(missing))
