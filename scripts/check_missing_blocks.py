# -*- coding: utf-8 -*-
import re

web = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8").read()
for key in ["encrypt", "textconvert", "texttool", "convert", "jsencrypt", "encode", "uuid", "json", "barcode"]:
    # 任意缩进匹配
    pat = re.compile(r"^\s*'" + key + r"' =>", re.M)
    m = pat.search(web)
    if m:
        line = web[:m.start()].count("\n") + 1
        print("%-12s 存在 @行%d  缩进=%r" % (key, line, web[m.start():m.start() + 2]))
    else:
        print("%-12s 不存在" % key)
