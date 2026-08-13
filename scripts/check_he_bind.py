# -*- coding: utf-8 -*-
src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\encode.html", encoding="utf-8").read()
for token in ["heEncode", "heDecode", "heOut", "heError", "escapeHtml", "unescapeHtml"]:
    print(token, token in src)
