# -*- coding: utf-8 -*-
import re
src = open(r"C:\project\wwwroot\toolbox\application\index\controller\Index.php", encoding="utf-8").read()
i = src.find("switch ($act)")
seg = src[i:src.find("public function api", i)]
for name in ["gzip", "checkkeyword", "whois", "chaicp"]:
    m = re.search(r"case '" + name + "':(.*?)(?=case '|\n\s*})", seg, re.S)
    print("=" * 30, name)
    print(m.group(1).strip() if m else "?")
    print()
