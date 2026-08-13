# -*- coding: utf-8 -*-
"""分析 subnetmask 与 linuxcmd 结构"""
import re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

print("========== subnetmask.html ==========")
src = open(BASE + r"\subnetmask.html", encoding="utf-8").read()
for m in re.finditer(r"<(h[2-5])[^>]*>([^<]+)</\1>", src):
    print("  标题:", m.group(2))
ids = re.findall(r'id="([^"]+)"', src)
print("  ids:", ids)

print("\n========== linuxcmd.html ==========")
src = open(BASE + r"\linuxcmd.html", encoding="utf-8").read()
print("size:", len(src))
for m in re.finditer(r"<(h[2-5])[^>]*>([^<]+)</\1>", src):
    print("  标题:", m.group(2)[:50])
print("  id 列表(前40):", re.findall(r'id="([^"]+)"', src)[:40])
# 看是否有搜索框
print("  含搜索 input:", 'type="search"' in src or 'placeholder="搜索' in src or 'placeholder="请输入' in src)
# 主体内容类型
print("  含 <table:", src.count("<table"))
print("  含 <pre:", src.count("<pre"))
print("  含命令条目数量(粗略):", src.count("<code") + src.count("command"))
