# -*- coding: utf-8 -*-
import re
src = open(r"C:\project\wwwroot\toolbox\application\index\controller\Index.php", encoding="utf-8").read()
print("行数:", src.count("\n"))
print("圆括号平衡:", src.count("(") == src.count(")"))
print("花括号平衡:", src.count("{") == src.count("}"))
print("方括号平衡:", src.count("[") == src.count("]"))
# switch case 清单
i = src.find("switch ($act)")
seg = src[i:src.find("public function api", i)]
cases = re.findall(r"case '([\w]+)':", seg)
print("index() switch cases:", cases)
i2 = src.find("switch (input('type'))")
seg2 = src[i2:]
cases2 = re.findall(r"case '([\w]+)':", seg2)
print("api() switch cases:", cases2)
# 确认 8 个已删 case 无残留
for dead in ["case 'guid'", "case 'md5'", "case 'chameta'", "case 'webstatus'", "case 'chaicp'", "case 'whois'", "case 'gzip'", "case 'checkkeyword'"]:
    print(dead, "在 index() 残留:", dead in seg)
