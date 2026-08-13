# -*- coding: utf-8 -*-
src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\encode.html", encoding="utf-8").read()
ids = ["heInput", "heMode", "heBtn", "heResult", "heClear"]
for i in ids:
    print(i, ('id="%s"' % i) in src)
