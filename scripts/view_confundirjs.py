# -*- coding: utf-8 -*-
import re
src = open('application/index/view/index/confundirjs.html', encoding='utf-8').read()
exts = re.findall(r'<script[^>]+src="([^"]+)"', src)
for e in exts:
    print(e)
