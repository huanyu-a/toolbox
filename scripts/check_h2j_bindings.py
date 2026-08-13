# -*- coding: utf-8 -*-
"""精确复查 html2js 按钮绑定"""
src = open(r"C:\project\wwwroot\toolbox\application\index\view\index\html2js.html", encoding="utf-8").read()
js = src[src.find("(function ()"):]
btns = ["jsToJs","jsToHtml","jsToArray","cjToCsharp","cjToJsp","phpRun",
        "aspRun","aspVbnet","aspPerl","aspSws","ubbToUbb","ubbToHtml","tblRun","csvRun"]
unbound = [b for b in btns if ("$id('" + b + "')") not in js]
print("未绑定按钮:", unbound if unbound else "全部绑定 OK ✅")
