# -*- coding: utf-8 -*-
"""检查所有工具页面的新皮肤元素完整性：DOCTYPE/head/title/header include/seo include/t-tabs"""
import os, re, json

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

# 从 tools.php 取导航页 + 补充已知页面
php = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
nav = re.findall(r"\['url' => '/([^/]+)/'", php)

pages = {}
for slug in nav:
    fn = os.path.join(BASE, slug + ".html")
    if os.path.exists(fn):
        pages[slug] = open(fn, encoding="utf-8").read()

# 完整性检查项
checks = {
    "doctype": "<!DOCTYPE html>",
    "head": "<head>",
    "charset": 'charset="utf-8"',
    "title_tag": "{$Think.config.web.",
    "viewport": 'name="viewport"',
    "seo_include": '{include file="seo" /}',
    "header_include": '{include file="header" /}',
    "sitecss": "site.min.css",
    "tabs": 'class="t-tabs"',
}

print("%-24s %s" % ("页面", " ".join(k[:4] for k in checks)))
problems = []
for slug, src in sorted(pages.items()):
    missing = [k for k, v in checks.items() if v not in src]
    if missing:
        problems.append((slug, missing))
        print("%-24s 缺: %s" % (slug, ", ".join(missing)))
    else:
        print("%-24s OK" % slug)

print("\n共 %d 页，%d 页缺失元素" % (len(pages), len(problems)))
