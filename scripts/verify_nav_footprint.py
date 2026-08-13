# -*- coding: utf-8 -*-
"""验证：标题/首页隐藏/足迹名称"""
import re, subprocess, os, tempfile, urllib.request

# 1. app.js 语法
code = open(r"C:\project\wwwroot\toolbox\public\static\script\app.js", encoding="utf-8").read()
f = os.path.join(tempfile.gettempdir(), "app_check.js")
open(f, "w", encoding="utf-8").write(code)
r = subprocess.run(["node", "--check", f], capture_output=True, text=True)
print("app.js 语法:", "OK" if r.returncode == 0 else "FAIL: " + r.stderr.strip()[:300])
os.remove(f)

# 2. 首页渲染（应无随机推荐区块）
body = urllib.request.urlopen("http://127.0.0.1:18080/", timeout=15).read().decode("utf-8", "ignore")
print("\n首页含 常用工具推荐:", "常用工具推荐" in body)
print("首页含 foot-nav-wrap:", "foot-nav-wrap" in body)
print("首页含 您的足迹:", "您的足迹" in body)

# 3. 详情页渲染（应有随机推荐区块 + 新标题）
body2 = urllib.request.urlopen("http://127.0.0.1:18080/urlcode/", timeout=15).read().decode("utf-8", "ignore")
print("\n详情页含 常用工具推荐:", "常用工具推荐" in body2)
print("详情页含 foot-nav-wrap:", "foot-nav-wrap" in body2)
print("详情页随机工具数:", len(re.findall(r'class="rand-tools"', body2)))

# 4. TOOLS_DATA 中 urlcode 的 name
m = re.search(r'"url":"/urlcode/","name":"([^"]+)"', body2)
print("\nurlcode 注册表名称:", m.group(1) if m else "未找到")
