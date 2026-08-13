# -*- coding: utf-8 -*-
import re
src = open('config/web.php', encoding='utf-8').read()
keys = re.findall(r"'([a-z][a-z0-9]*)'\s*=>\s*array\s*\(", src)
print('块数量:', len(keys))
print(keys)
