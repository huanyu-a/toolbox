# -*- coding: utf-8 -*-
"""更新 htaccess2nginx.html 的遗留表单 action + 删除旧模板"""
import os

path = r"C:\project\wwwroot\toolbox\application\index\view\index\htaccess2nginx.html"
src = open(path, encoding="utf-8").read()
old = 'action="/allencrypt/"'
if old in src:
    src = src.replace(old, 'action="/encrypt/"')
    open(path, "w", encoding="utf-8", newline="\n").write(src)
    print("已更新 htaccess2nginx.html → /encrypt/")
else:
    print("htaccess2nginx.html 未找到", old)

# 删除旧模板
for f in ["deencrypt.html", "allencrypt.html", "htpasswd.html"]:
    fp = os.path.join(r"C:\project\wwwroot\toolbox\application\index\view\index", f)
    if os.path.exists(fp):
        os.remove(fp)
        print("已删除:", f)
    else:
        print("不存在:", f)
