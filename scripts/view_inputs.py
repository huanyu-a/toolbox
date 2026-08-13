# -*- coding: utf-8 -*-
import re
src = open(r"C:\project\wwwroot\toolbox\application\index\controller\Index.php", encoding="utf-8").read()
i = src.find("function index")
seg = src[i:i + 24000]
# 打印 input( 出现位置上下文
for m in re.finditer(r"input\('([^']+)'", seg):
    start = max(0, m.start() - 150)
    print("### input:", m.group(1))
    print(seg[start:m.start() + 250].replace("\n", " "))
    print()
