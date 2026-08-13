# -*- coding: utf-8 -*-
import re
src = open(r"C:\project\wwwroot\toolbox\application\index\controller\Index.php", encoding="utf-8").read()
# 提取 switch 内各 case 的代码量
i = src.find("switch ($act)")
seg = src[i:src.find("public function api", i)]
cases = re.findall(r"case '([\w]+)':(.*?)(?=case '|\n\s*})", seg, re.S)
for name, body in cases:
    print("%-12s %4d 字符" % (name, len(body.strip())))
print("switch 总长:", len(seg))
