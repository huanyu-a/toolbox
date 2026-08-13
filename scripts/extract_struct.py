# -*- coding: utf-8 -*-
"""提取 subnetmask / linuxcmd 完整结构供子智能体任务"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

print("========== subnetmask.html ==========")
src = open(BASE + r"\subnetmask.html", encoding="utf-8").read()
# 外部脚本
print("外部脚本:", re.findall(r'<script[^>]*src="([^"]+)"', src))
# 表单结构
print("form 数:", src.count("<form"))
print("input 数:", src.count("<input"))
print("select 数:", src.count("<select"))
print("按钮:", re.findall(r'<(?:input|button)[^>]*value="([^"]*)"', src))
# 主体内容（去标签预览）
body = re.sub(r"<script.*?</script>", "", src, flags=re.S)
body = re.sub(r"<style.*?</style>", "", body, flags=re.S)
text = re.sub(r"<[^>]+>", "|", body)
text = re.sub(r"\|+", " | ", text)
print("\n文本轮廓(前2500):")
print(text[:2500])

print("\n========== linuxcmd.html ==========")
src = open(BASE + r"\linuxcmd.html", encoding="utf-8").read()
# 27 张表的结构：找 table 前的标题
tables = re.findall(r"<(h[2-6])[^>]*>([^<]+)</\1>", src)
print("标题数:", len(tables))
for h, t in tables:
    print(" ", h, t[:60])
# 表格行数估计
print("table 数:", src.count("<table"))
print("tr 数:", src.count("<tr"))
# 搜索现有交互
print("含 onclick:", re.search(r"\sonclick=", src) is not None)
scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
print("内联脚本块:", len(scripts), [len(s) for s in scripts])
for s in scripts:
    print("  内容:", s[:500])
