# -*- coding: utf-8 -*-
import re
src = open('config/web.php', encoding='utf-8').read()
m = re.search(r"'encode'\s*=>\s*array\s*\(", src)
print('encode 块位置:', m.start() if m else 'NOT FOUND')
if m:
    print(src[m.start():m.start()+350])
