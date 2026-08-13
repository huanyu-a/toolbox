# -*- coding: utf-8 -*-
import re
src = open(r"C:\project\wwwroot\toolbox\application\index\controller\Index.php", encoding="utf-8").read()
i = src.find("function api")
print(src[i:i + 3500])
