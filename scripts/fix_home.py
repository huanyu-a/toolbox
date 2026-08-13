# -*- coding: utf-8 -*-
"""修复首页 md5 链接"""
src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\index.html", encoding="utf-8").read()
new = src.replace('href="/md5/">MD5加密', 'href="/allencrypt/">MD5/SHA加密')
if new != src:
    open(r"C:\project\wwwroot\toolbox\application\index\view\index\index.html", "w", encoding="utf-8").write(new)
    print("已替换")
else:
    print("未找到精确匹配，尝试宽松匹配")
    new2 = src.replace("/md5/", "/allencrypt/")
    open(r"C:\project\wwwroot\toolbox\application\index\view\index\index.html", "w", encoding="utf-8").write(new2)
    print("宽松替换完成")
print("最终 /md5/ 存在:", "/md5/" in new if new != src else "/md5/" in new2)
print("最终 /allencrypt/ 存在:", "/allencrypt/" in (new if new != src else new2))
