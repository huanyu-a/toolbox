# -*- coding: utf-8 -*-
"""核对 301 映射覆盖 + 待删文件清单"""
import re, os

INDEX = r"C:\project\wwwroot\toolbox\application\index\controller\Index.php"
BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

src = open(INDEX, encoding="utf-8").read()
m = re.search(r"\$mergeMap = array\((.*?)\);", src, re.S)
map_src = m.group(1)
mapped = set(re.findall(r"'([a-z0-9]+)'\s*=>", map_src))
print("301 映射条数:", len(mapped))

MERGED = {
    "jsonlrview","jsonudview","jsonzip","json2cs","json2java","json2go","sql2java",
    "json2xml","excel2json","json2excel","json2get","json2yaml",
    "guid","enlower",
    "htmloutjs","html2cj","html2php","html2all","html2ubb","htmltable","htmlfromcsv",
    "aesencrypt","desencrypt","tripledes","rc4encrypt","rabbitencrypt",
    "md5","shaencrypt","navtiveunicode","asciicode","htmlescapechar",
    "webstatus","ip2long","requestmethod","tiaoseban",
    "calcarea","calclength","calcvolume","calctemperature","calctime","calcspeed",
    "calcpressure","calcpower","calcangle","calcdata","calcforce","calcheat","calcthickness",
    "dnsdx","dnslt","dnsyd","dnstt","dnsedu","dnsusa","alldns",
    "formatc","formatcpp","formatcs","formatcsql","formatcss","formathtml","formatjava",
    "formatjs","formatperl","formatphp","formatpy","formatruby","formatsql","formatvbs",
    "formatxml","formatfilter",
    "regexcode","regexdso","regexsucha","keyboardtest","androidkeycode",
    "password","worldtime","shizhong","chameta","urlencode",
}
print("被合并项:", len(MERGED))
not_mapped = sorted(MERGED - mapped)
print("未映射(会 404 风险):", not_mapped)

# 待删文件存在性
missing_files = [k for k in MERGED if not os.path.exists(os.path.join(BASE, k + ".html"))]
print("被合并页面文件不存在(已删?):", missing_files)
exist = [k for k in MERGED if os.path.exists(os.path.join(BASE, k + ".html"))]
print("仍存在的被合并文件数:", len(exist))
