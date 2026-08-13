# -*- coding: utf-8 -*-
"""web.php 配置键盘点"""
import re

src = open(r'C:\project\wwwroot\toolbox\config\web.php', encoding='utf-8').read()
keys = re.findall(r"'([a-z0-9]+)'\s*=>\s*\[\s*'title'", src)
print('web.php size:', len(src))
print('TDK blocks:', len(keys))
# 与工具页模板对比：找出有 TDK 但无页面 / 有页面但无 TDK
import os
BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'
pages = set(f[:-5] for f in os.listdir(BASE) if f.endswith('.html'))
key_set = set(keys)
print('pages with template:', len(pages))
print('TDK keys:', len(key_set))
print('模板存在但无TDK:', sorted(pages - key_set))
print('TDK存在但无模板:', sorted(key_set - pages))
