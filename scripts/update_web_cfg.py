# -*- coding: utf-8 -*-
"""更新 web.php：删除 deencrypt/allencrypt/htpasswd 块，新增 encrypt 块"""
import re

path = r"C:\project\wwwroot\toolbox\config\web.php"
src = open(path, encoding="utf-8", errors="ignore").read()

def extract_block(src, key):
    start = src.find("'%s' =>" % key)
    if start < 0:
        return None
    arr = src.find("array (", start)
    if arr < 0:
        return None
    depth = 0
    i = arr + len("array (")
    while i < len(src):
        c = src[i]
        if c == "(":
            depth += 1
        elif c == ")":
            if depth == 0:
                j = src.find("),", i)
                if j < 0:
                    j = i + 1
                return src[start:j + 2]
            depth -= 1
        i += 1
    return None

new_block = """'encrypt' => 
  array (
    'title' => '加密解密工具大全,对称加密/哈希/htpasswd在线工具-在线工具箱',
    'keywords' => '加密解密,对称加密,AES,DES,RC4,Rabbit,TripleDES,MD5,SHA,哈希,散列,htpasswd',
    'description' => '在线加密解密工具大全,提供AES、DES、RC4、Rabbit、TripleDES对称加密解密,MD5、SHA1、SHA224、SHA256、SHA384、SHA512、RIPEMD160、SHA3哈希加密,HMAC消息认证码,htpasswd密码文件生成,全程浏览器本地运算,数据不离开浏览器',
  ),
"""

# 删除三个旧块
for key in ["deencrypt", "allencrypt", "htpasswd"]:
    block = extract_block(src, key)
    if block:
        src = src.replace(block, "", 1)
        print("已删除 %s 块 (%d 字符)" % (key, len(block)))
    else:
        print("未找到 %s 块" % key)

# 在 web 数组开头附近插入 encrypt 块（放在 'title' => '在线工具箱' 之后的第一个工具块前）
# 简单策略：在第一个 "'json' =>" 前插入（保持字母序不强制，放在数组开头更安全）
anchor = "return ["
if anchor in src:
    src = src.replace(anchor, anchor + "\n" + new_block, 1)
    print("已在数组开头插入 encrypt 块")
else:
    # 兜底：在文件尾部 return 前插入
    last = src.rfind(");")
    src = src[:last] + new_block + "\n" + src[last:]
    print("已在文件尾部插入 encrypt 块")

open(path, "w", encoding="utf-8", newline="\n").write(src)
print("web.php 更新完成, 大小:", len(src))
