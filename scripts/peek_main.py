# -*- coding: utf-8 -*-
import re
src = open(r"C:\project\wwwroot\toolbox\.fetch\home_final.html", encoding="utf-8").read()
m = re.search(r'<main class="home-wrap">(.*?)</main>', src, re.S)
body = m.group(1)
# 打印 hero 区域开头
print(body[:2800])
print("\n...\n")
# 分类卡片 head 样例
for hm in re.finditer(r'<div class="home-cat" id="cat-([^"]+)".*?</div>\s*<ul class="home-cat-list">', body, re.S):
    print("卡片:", hm.group(1))
