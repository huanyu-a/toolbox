# -*- coding: utf-8 -*-
src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\encode.html", encoding="utf-8").read()
i = src.find('id="encHtml"')
print(src[i:i + 2600])
