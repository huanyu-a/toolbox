# -*- coding: utf-8 -*-
"""web.php 结构检查：块定义是否成对、缺逗号可疑点"""
import re

path = r"C:\project\wwwroot\toolbox\config\web.php"
src = open(path, encoding="utf-8").read()

# 顶层块：'key' => \n  array ( ... ),
blocks = re.findall(r"  '([^']+)' => \n  array \(", src)
print("顶层块数量:", len(blocks))

# 检查 'key' => 后是否跟 array (
pairs = re.findall(r"  '([^']+)' => \n  array \(", src)
print("格式良好的块数:", len(pairs))

# 检查是否有 'key' => 后面没跟 array（缺逗号/格式错）
bad = re.findall(r"  '([^']+)' => \n  (?!array \()", src)
print("可疑格式错误:", bad)

# 括号平衡
print("左括号:", src.count("("), "右括号:", src.count(")"))
print("左花括号:", src.count("{"), "右花括号:", src.count("}"))
