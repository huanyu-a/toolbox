# -*- coding: utf-8 -*-
"""检查 web.php encrypt 块位置"""
src = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8", errors="ignore").read()
i = src.find("'encrypt' =>")
print("encrypt 位置:", i, "/", len(src))
print("文件尾 400 字符:")
print(src[-400:])
print()
# 括号平衡
print("括号平衡:", src.count("{") - src.count("}"), src.count("(") - src.count(")"), src.count("[") - src.count("]"))
