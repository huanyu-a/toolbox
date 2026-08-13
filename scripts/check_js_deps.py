# -*- coding: utf-8 -*-
"""检查加密 JS 依赖冲突"""
import os, re

files = [
    r"C:\project\wwwroot\toolbox\public\static\script\pcjs\crypto-js.js",
    r"C:\project\wwwroot\toolbox\public\static\script\pcjs\aes.js",
    r"C:\project\wwwroot\toolbox\public\static\script\pcjs\rabbit.js",
    r"C:\project\wwwroot\toolbox\public\static\script\pcjs\rc4.js",
    r"C:\project\wwwroot\toolbox\public\static\script\pcjs\tripledes.js",
    r"C:\project\wwwroot\toolbox\public\static\script\encrypt\pcjson-md5.js",
    r"C:\project\wwwroot\toolbox\public\static\script\encrypt\pcjson-sha1.js",
    r"C:\project\wwwroot\toolbox\public\static\script\encrypt\pcjson-sha256.js",
    r"C:\project\wwwroot\toolbox\public\static\script\encrypt\pcjson-sha3.js",
    r"C:\project\wwwroot\toolbox\public\static\script\pcjs\htpasswd\htpasswd.js",
    r"C:\project\wwwroot\toolbox\public\static\script\pcjs\htpasswd\htpmd5.js",
    r"C:\project\wwwroot\toolbox\public\static\script\pcjs\htpasswd\htpsha1.js",
    r"C:\project\wwwroot\toolbox\public\static\script\pcjs\htpasswd\jsnote.js",
]

for f in files:
    if not os.path.exists(f):
        print("缺失:", f)
        continue
    src = open(f, encoding="utf-8", errors="ignore").read()
    # 判断是否定义/引用 CryptoJS / $ / window
    defn = re.findall(r"(CryptoJS\s*=|window\.CryptoJS|var CryptoJS)", src)
    jq = "$" in src
    size = len(src)
    print(f"{os.path.basename(f):22s} {size:6d}B  CryptoJS定义: {defn[:3]}  jquery符号: {jq}")
