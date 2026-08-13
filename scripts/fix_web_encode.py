# -*- coding: utf-8 -*-
"""web.php：补回 encode 块（含 htmlescape 关键词），移除 urlencode 死块"""
import re

path = r"C:\project\wwwroot\toolbox\config\web.php"
src = open(path, encoding="utf-8", errors="ignore").read()

# 1) 移除 urlencode 死块（保留其结尾逗号结构）
pat_url = re.compile(
    r"  'urlencode' => \n  array \(.*?\n  \),\n",
    re.S,
)
m = pat_url.search(src)
if m:
    removed = src[m.start():m.end()]
    src = src[:m.start()] + src[m.end():]
    print("已移除 urlencode 死块, %d 字符" % len(removed))
else:
    print("WARN: 未找到 urlencode 块")

# 2) 插入 encode 块（放在移除点）
new_block = """  'encode' => 
  array (
    'title' => '编码转换工具大全,Base64/URL/Escape/Unicode/UTF-8/ASCII/摩尔斯/HTML转义在线工具-在线工具箱',
    'keywords' => '编码转换,Base64编码,URL编码,URL解码,Escape编码,Unicode转换,UTF-8转换,ASCII转换,摩尔斯电码,HTML转义,html转义字符,迅雷链接加密',
    'description' => '编码转换工具大全提供Base64编码解码,URL编码解码,Escape编码解码,Unicode转换,UTF-8编码转换,ASCII编码转换,摩尔斯电码加密解密,HTML转义字符转换,迅雷快车旋风链接加密解密,图片转Base64等常用编码转换功能',
  ),
"""
anchor = "  'asciicode' =>"
assert anchor in src, "锚点 asciicode 不存在"
src = src.replace(anchor, new_block + anchor, 1)
print("已插入 encode 块（锚点 asciicode）")

open(path, "w", encoding="utf-8", newline="\n").write(src)

# 3) 校验
src2 = open(path, encoding="utf-8", errors="ignore").read()
print("encode 块存在:", "'encode' =>" in src2)
print("urlencode 残留:", "'urlencode' =>" in src2)
# 缺逗号检查：'xxx' => 前一个块必须以 ), 结尾
bad = re.findall(r"\n  '(\w+)' => \n", src2)
print("块数:", len(bad))
# 简易语法冒烟：统计括号平衡
print("圆括号平衡:", src2.count("(") == src2.count(")"))
print("方括号平衡:", src2.count("[") == src2.count("]"))
print("花括号平衡:", src2.count("{") == src2.count("}"))
