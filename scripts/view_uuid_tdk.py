# -*- coding: utf-8 -*-
import re
src = open(r'C:\project\wwwroot\toolbox\config\web.php', encoding='utf-8').read()
idx = src.find("'uuid'")
print('uuid at', idx)
print(src[idx:idx + 700] if idx >= 0 else 'NOT FOUND')
