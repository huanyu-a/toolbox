# -*- coding: utf-8 -*-
import re
src = open(r"C:\project\wwwroot\toolbox\application\index\controller\Index.php", encoding="utf-8").read()
i = src.find("function index")
seg = src[i:i + 6000]
# 找 input( 调用与分支
for m in re.finditer(r"input\('([^']+)'", seg):
    print("input:", m.group(1))
print("----- 前 3500 字符 -----")
print(seg[:3500])
