# -*- coding: utf-8 -*-
"""全站扫描：是否还有指向已删工具页面的链接"""
import re, os, glob

tools = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
items = set(re.findall(r"'url' => '(/[^']+)'", tools))
# 已删页面清单（从 git 历史/当前视图目录判断）
vdir = r"C:\project\wwwroot\toolbox\application\index\view\index"
views = set("/" + f[:-5] + "/" for f in os.listdir(vdir) if f.endswith(".html"))

# 扫描所有 html + php 里的 /xxx/ 链接
links = set()
for f in glob.glob(r"C:\project\wwwroot\toolbox\application\**\*.html", recursive=True) + \
         glob.glob(r"C:\project\wwwroot\toolbox\application\**\*.php", recursive=True):
    src = open(f, encoding="utf-8", errors="ignore").read()
    for m in re.findall(r"['\"](/[a-z0-9_]+/?)['\"]", src):
        u = m if m.endswith("/") else m + "/"
        links.add((u, f))

# 找：链接存在但视图不存在（死链）
dead = sorted(set(u for u, f in links if u not in views and u not in items and u != "/"))
print("死链链接（指向不存在页面）:")
for u in dead:
    print("  ", u)
if not dead:
    print("  无")
