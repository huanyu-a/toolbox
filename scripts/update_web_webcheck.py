# -*- coding: utf-8 -*-
"""web.php：删除 pagecode 块，更新 webcheck TDK"""
import re

path = r"C:\project\wwwroot\toolbox\config\web.php"
src = open(path, encoding="utf-8").read()

# 1. 删除 pagecode 块（'pagecode' => ... ), 含尾逗号）
m = re.search(r"  'pagecode' => \n  array \(.*?\n  \),?\n", src, re.S)
if not m:
    raise SystemExit("pagecode block not found")
src = src[:m.start()] + src[m.end():]
print("已删除 pagecode 块")

# 2. 更新 webcheck 块 TDK
old_wc = """  'webcheck' => 
  array (
    'title' => '网站检测工具,ICP备案查询/Whois/死链/微信拦截/Gzip/关键词密度-在线工具箱',
    'keywords' => '网站检测,ICP备案查询,whois查询,域名whois,死链检测,微信域名检测,微信拦截检测,Gzip压缩检测,关键词密度检测',
    'description' => '网站检测工具箱为您提供ICP备案查询,域名Whois信息查询,网站死链检测,微信域名拦截检测,Gzip压缩检测,网页关键词密度检测等站长常用检测工具',
  ),"""
new_wc = """  'webcheck' => 
  array (
    'title' => '网站检测工具,ICP备案查询/Whois/死链/微信拦截/Gzip/关键词密度/HTTP状态码-在线工具箱',
    'keywords' => '网站检测,ICP备案查询,whois查询,域名whois,死链检测,微信域名检测,微信拦截检测,Gzip压缩检测,关键词密度检测,HTTP状态码查询,HTTP状态码对照表',
    'description' => '网站检测工具箱为您提供ICP备案查询,域名Whois信息查询,网站死链检测,微信域名拦截检测,Gzip压缩检测,网页关键词密度检测,HTTP状态码查询与对照表等站长常用检测工具',
  ),"""
if old_wc not in src:
    raise SystemExit("webcheck block not found (format changed)")
src = src.replace(old_wc, new_wc)
print("已更新 webcheck TDK")

open(path, "w", encoding="utf-8").write(src)
print("web.php 大小:", len(src), " pagecode 剩余:", src.count("pagecode"))
