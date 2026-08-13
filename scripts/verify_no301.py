# -*- coding: utf-8 -*-
"""校验 Index.php 删除 301 后结构完整"""
src = open(r"C:\project\wwwroot\toolbox\application\index\controller\Index.php", encoding="utf-8").read()
print("文件大小:", len(src))
print("花括号平衡:", src.count("{") - src.count("}"))
print("圆括号平衡:", src.count("(") - src.count(")"))
print("方括号平衡:", src.count("[") - src.count("]"))
print("含 301:", "301" in src)
print("含 mergeMap:", "mergeMap" in src)
print("含 redirect 302:", src.count("redirect("))
# 确认 act 流程仍在
print("act 赋值存在:", "$act = input('act', 'index');" in src)
print("data['act'] 存在:", "$data['act'] = $act;" in src)
