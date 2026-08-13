# -*- coding: utf-8 -*-
"""检查 regex 面板 / unicode / deencrypt 结构"""
import re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

print("### regex.html 面板")
src = open(BASE + r"\regex.html", encoding="utf-8").read()
print("t-panel 出现次数:", len(re.findall(r't-panel', src)))
for m in re.finditer(r'<div[^>]*class="t-panel[^"]*"[^>]*>', src):
    print("  ", m.group(0)[:120])
print("id 属性列表:", re.findall(r'id="([^"]+)"', src)[:25])

print("\n### unicode.html")
src = open(BASE + r"\unicode.html", encoding="utf-8").read()
print("len:", len(src))
print("has tab:", "t-tab" in src, "| has panel:", "t-panel" in src)
print("标签:", re.findall(r'<label[^>]*>([^<]*)</label>', src)[:10])
print("按钮:", re.findall(r'<button[^>]*>([^<]*)</button>', src)[:8])

print("\n### deencrypt.html")
src = open(BASE + r"\deencrypt.html", encoding="utf-8").read()
print("len:", len(src))
print("has tab:", "t-tab" in src, "| has panel:", "t-panel" in src)
print("select 选项:", re.findall(r'<option[^>]*>([^<]*)</option>', src)[:12])
print("算法关键词:", [k for k in ["AES","DES","RC4","Rabbit","TripleDes","TripleDES","3DES"] if k in src])
