# -*- coding: utf-8 -*-
"""修复保留页中的旧链接 + 检查首页引用"""
import os, re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
backup = r"C:\project\wwwroot\toolbox\.merged_backup"
deleted = set(f[:-5] for f in os.listdir(backup) if f.endswith(".html"))

# 修复映射：被删 URL -> 新 URL
FIX = {}
for d in deleted:
    FIX[d] = d  # 占位，下面特殊处理

FIX.update({
    "md5": "allencrypt", "shaencrypt": "allencrypt",
    "guid": "uuid", "navtiveunicode": "unicode",
    "calcarea": "calc", "calclength": "calc", "calcvolume": "calc",
    "calctemperature": "calc", "calctime": "calc", "calcspeed": "calc",
    "calcpressure": "calc", "calcpower": "calc", "calcangle": "calc",
    "calcdata": "calc", "calcforce": "calc", "calcheat": "calc", "calcthickness": "calc",
    "aesencrypt": "deencrypt", "desencrypt": "deencrypt", "tripledes": "deencrypt",
    "rc4encrypt": "deencrypt", "rabbitencrypt": "deencrypt",
    "jsonlrview": "json", "jsonudview": "json", "jsonzip": "json", "json2get": "json",
    "json2xml": "json", "json2yaml": "json", "excel2json": "json", "json2excel": "json",
    "json2cs": "json", "json2java": "json", "json2go": "json", "sql2java": "json",
    "htmloutjs": "html2js", "html2cj": "html2js", "html2php": "html2js",
    "html2all": "html2js", "html2ubb": "html2js", "htmltable": "html2js", "htmlfromcsv": "html2js",
    "enlower": "capital",
    "asciicode": "ascii", "htmlescapechar": "htmlescape", "webstatus": "pagecode",
    "ip2long": "ip", "requestmethod": "httpheader", "tiaoseban": "hexrgb",
    "dnsdx": "dns", "dnslt": "dns", "dnsyd": "dns", "dnstt": "dns", "dnsedu": "dns",
    "dnsusa": "dns", "alldns": "dns",
    "formatc": "format", "formatcpp": "format", "formatcs": "format", "formatcsql": "format",
    "formatcss": "format", "formathtml": "format", "formatjava": "format", "formatjs": "format",
    "formatperl": "format", "formatphp": "format", "formatpy": "format", "formatruby": "format",
    "formatsql": "format", "formatvbs": "format", "formatxml": "format", "formatfilter": "format",
    "regexcode": "regex", "regexdso": "regex", "regexsucha": "regex",
    "keyboardtest": "keyboardcode", "androidkeycode": "keyboardcode",
    "password": "random", "worldtime": "unixtime", "shizhong": "unixtime", "chameta": "createmeta",
    "urlencode": "urlcode",
})

def fix_links(fname):
    path = os.path.join(BASE, fname)
    src = open(path, encoding="utf-8").read()
    orig = src
    for old, new in FIX.items():
        # 替换 /old/ 形式（链接、表单 action、JS 跳转）
        src = re.sub(r'(["\'])/' + re.escape(old) + r'/(["\'])', r'\1/' + new + r'/\2', src)
        src = re.sub(r'(href=["\']?)/' + re.escape(old) + r'/(["\']?)', r'\1/' + new + r'/\2', src)
    if src != orig:
        open(path, "w", encoding="utf-8").write(src)
        print(f"  修复 {fname}: {orig.count('href') - src.count('href')} 链接")
        return True
    return False

print("=== 修复保留页旧链接 ===")
fixed = []
for f in sorted(os.listdir(BASE)):
    if f.endswith(".html") and f != "index.html":
        if fix_links(f):
            fixed.append(f)
print("修复页面:", fixed)

# 首页检查
print("\n=== 首页 index.html 引用被删页面 ===")
idx = open(os.path.join(BASE, "index.html"), encoding="utf-8").read()
for d in sorted(deleted):
    if re.search(r'["\']/' + re.escape(d) + r'/"', idx) or re.search(r'href="?/' + re.escape(d) + r'/"?', idx):
        print("  首页引用被删页:", d)
print("首页检查完成")
