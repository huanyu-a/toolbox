# -*- coding: utf-8 -*-
"""修复 unicode 复制按钮引用"""
path = r"C:\project\wwwroot\toolbox\application\index\view\index\unicode.html"
src = open(path, encoding="utf-8").read()
src = src.replace('data-copy="#nuOutput"', 'data-copy="#ucOutput"')
open(path, "w", encoding="utf-8").write(src)
print("nuOutput 残留:", "nuOutput" in src)
print("nuInput 残留:", "nuInput" in src)
print("textarea 数:", src.count("<textarea"))
