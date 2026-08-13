# -*- coding: utf-8 -*-
"""检查 web.php 中关键页面的 TDK 配置"""
import re

src = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8").read()
# 提取所有 key => array(title...)
blocks = re.findall(r"'([a-zA-Z0-9]+)'\s*=>\s*array\s*\([^)]*?'title'\s*=>\s*'([^']*)'", src, re.S)
keys = dict(blocks)
print("web.php TDK blocks:", len(keys))

for k in ["calc", "format", "dns", "json", "html2js", "regex", "keyboardcode", "random",
          "unixtime", "createmeta", "hexrgb", "ip", "pagecode", "ascii", "htmlescape",
          "httpheader", "uuid", "unicode", "deencrypt", "allencrypt", "capital"]:
    print("  %-14s %s" % (k, ("✓ " + keys[k][:40]) if k in keys else "✗ 缺失"))

# 被合并页面的 TDK 是否还在（应清理）
merged_keys = ["jsonlrview", "jsonudview", "jsonzip", "json2cs", "json2java", "json2go",
               "sql2java", "json2xml", "excel2json", "json2excel", "json2get", "json2yaml",
               "guid", "enlower", "htmloutjs", "html2cj", "html2php", "html2all", "html2ubb",
               "htmltable", "htmlfromcsv", "aesencrypt", "desencrypt", "tripledes",
               "rc4encrypt", "rabbitencrypt", "md5", "shaencrypt", "navtiveunicode",
               "asciicode", "htmlescapechar", "webstatus", "ip2long", "requestmethod",
               "tiaoseban", "calcarea", "calclength", "calcvolume", "calctemperature",
               "calctime", "calcspeed", "calcpressure", "calcpower", "calcangle", "calcdata",
               "calcforce", "calcheat", "calcthickness", "dnsdx", "dnslt", "dnsyd", "dnstt",
               "dnsedu", "dnsusa", "alldns", "formatc", "formatcpp", "formatcs", "formatcsql",
               "formatcss", "formathtml", "formatjava", "formatjs", "formatperl", "formatphp",
               "formatpy", "formatruby", "formatsql", "formatvbs", "formatxml", "formatfilter",
               "regexcode", "regexdso", "regexsucha", "keyboardtest", "androidkeycode",
               "password", "worldtime", "shizhong", "chameta"]
present = [k for k in merged_keys if k in keys]
print("\n被合并旧页面 TDK 仍在 web.php:", len(present))
print(present)
