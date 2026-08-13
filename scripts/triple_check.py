# -*- coding: utf-8 -*-
"""三向核对：tools.php 入口 vs web.php 块 vs 视图文件"""
import re, os

tools = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
web = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8").read()
vdir = r"C:\project\wwwroot\toolbox\application\index\view\index"

items = re.findall(r"'url' => '(/[^']+)'", tools)
web_keys = set(re.findall(r"^\s*'(\w+)' =>", web, re.M))
views = set(f[:-5] for f in os.listdir(vdir) if f.endswith(".html"))

print("== tools 入口但视图不存在（死链入口）==")
for u in items:
    act = u.strip("/")
    if act not in views:
        print(" ", u, "| web块:", act in web_keys)

print("\n== web 块但视图不存在且 tools 无入口（死配置，可清）==")
for k in sorted(web_keys - set(u.strip("/") for u in items)):
    if k not in views and k != "header":
        print(" ", k)

print("\n== 视图存在但 tools 无入口（孤儿页面，不进导航）==")
for v in sorted(views - set(u.strip("/") for u in items)):
    print(" ", v, "| web块:", v in web_keys)
