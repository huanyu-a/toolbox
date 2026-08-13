# -*- coding: utf-8 -*-
"""web.php：删除 9 个编码工具 TDK 块，新增 encode 块"""
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

new_block = """'encode' => 
  array (
    'title' => '编码转换工具大全,Base64/URL/Escape/Unicode/UTF-8/ASCII/摩尔斯在线工具-在线工具箱',
    'keywords' => '编码转换,Base64编码,URL编码,Escape编码,Unicode转换,UTF-8转换,ASCII转换,摩尔斯电码,迅雷链接,旋风链接,图片转Base64',
    'description' => '在线编码转换工具大全,提供Base64编码解码、URL编码解码、Escape加密解密、Unicode转换、UTF-8转换、ASCII转换、摩尔斯电码加密解密、迅雷/快车/旋风链接生成、图片转Base64编码,全程浏览器本地运算,数据不离开浏览器',
  ),
"""

for key in ["base64", "escape", "urlcode", "morse", "utf8", "unicode", "ascii", "urlthunder", "img2base64"]:
    block = extract_block(src, key)
    if block:
        src = src.replace(block, "", 1)
        print("已删除 %s 块" % key)
    else:
        print("未找到 %s 块" % key)

# 插入：放在数组开头 return [ 之后
anchor = "return ["
src = src.replace(anchor, anchor + "\n" + new_block, 1)
print("已插入 encode 块")

open(path, "w", encoding="utf-8", newline="\n").write(src)
print("web.php 大小:", len(src))
