# -*- coding: utf-8 -*-
"""列出当前 tools.php 全部入口 + web.php 块清单，交叉核对死配置"""
import re

tools = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
web = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8").read()

items = re.findall(r"'url' => '(/[^']+)'", tools)
web_blocks = re.findall(r"^  '(\w+)' =>", web, re.M)

print("tools.php 入口数:", len(items))
print("web.php 块数:", len(web_blocks))

# 死配置：web 有块但 tools 无入口（已删除页面的残留）
tool_urls = set(items)
dead = [b for b in web_blocks if "/" + b + "/" not in tool_urls and b != "index"]
print("\nweb 有块但 tools 无入口（疑似死配置）:", dead)

# 反查：tools 有入口但 web 无块（缺 TDK）
missing = [u.strip("/") for u in items if u.strip("/") not in web_blocks]
print("\ntools 有入口但 web 无块（缺 TDK）:", missing)
