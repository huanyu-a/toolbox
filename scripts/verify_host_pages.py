# -*- coding: utf-8 -*-
"""验证承接页是否包含被合并功能的关键标识"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

def scan(name, keywords):
    src = open(os.path.join(BASE, name + ".html"), encoding="utf-8").read()
    print(f"=== {name}.html ({len(src)}B) ===")
    for kw in keywords:
        print(f"  {'✓' if kw in src else '✗'} {kw}")

print("### deencrypt 应含 AES/DES/RC4/Rabbit/TripleDes")
scan("deencrypt", ["AES", "DES", "RC4", "Rabbit", "TripleDes", "t-panel", "t-tab", "加密", "解密"])
print()
print("### allencrypt 应含 MD5/SHA1/SHA256")
scan("allencrypt", ["MD5", "SHA1", "SHA256", "SHA512", "t-panel", "t-tab"])
print()
print("### uuid 应含 GUID")
scan("uuid", ["GUID", "guid", "UUID", "uuid"])
print()
print("### unicode 应含 Native")
scan("unicode", ["Native", "native", "unicode", "Unicode"])
print()
print("### capital vs enlower 差异")
scan("capital", ["大写", "小写", "首都"])
scan("enlower", ["大写", "小写", "首都"])
print()
print("### regex 面板结构")
src = open(os.path.join(BASE, "regex.html"), encoding="utf-8").read()
tabs = re.findall(r'<li[^>]*>\s*<button[^>]*class="t-tab[^"]*"[^>]*>([^<]+)</button>', src)
print("tab 按钮:", tabs)
panels = re.findall(r'id="panel-([^"]+)"', src)
print("面板 id:", panels)
