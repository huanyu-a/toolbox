# -*- coding: utf-8 -*-
"""web.php：删 6 个查询工具块，加 webcheck 块"""
import re

path = r"C:\project\wwwroot\toolbox\config\web.php"
src = open(path, encoding="utf-8").read()

targets = ["chaicp", "whois", "checkurl", "checkweixin", "gzip", "checkkeyword"]
for t in targets:
    # 两行 array 格式:  'xxx' => \n  array ( ... ),\n
    pat = re.compile(r"^  '" + t + r"' => \n  array \(.*?\n  \),\n", re.M | re.S)
    m = pat.search(src)
    if m:
        src = src[:m.start()] + src[m.end():]
        print("已删除块:", t)
    else:
        print("未找到块:", t)

new_block = """  'webcheck' => 
  array (
    'title' => '网站检测工具,ICP备案查询/Whois/死链/微信拦截/Gzip/关键词密度-在线工具箱',
    'keywords' => '网站检测,ICP备案查询,whois查询,域名whois,死链检测,微信域名检测,微信拦截检测,Gzip压缩检测,关键词密度检测',
    'description' => '网站检测工具箱为您提供ICP备案查询,域名Whois信息查询,网站死链检测,微信域名拦截检测,Gzip压缩检测,网页关键词密度检测等站长常用检测工具',
  ),
"""
anchor = "  'ip' =>"
assert anchor in src, "锚点 'ip' 不存在"
src = src.replace(anchor, new_block + anchor, 1)
print("已插入 webcheck 块")

open(path, "w", encoding="utf-8", newline="\n").write(src)

# 校验
src2 = open(path, encoding="utf-8").read()
print("webcheck 块:", "'webcheck' =>" in src2)
print("chaicp 残留:", "'chaicp' =>" in src2)
print("whois 残留:", "'whois' =>" in src2)
print("圆括号平衡:", src2.count("(") == src2.count(")"))
print("花括号平衡:", src2.count("{") == src2.count("}"))
