# -*- coding: utf-8 -*-
import re
src = open(r'C:\project\wwwroot\toolbox\config\web.php', encoding='utf-8').read()
for k in ['texttool', 'textconvert', 'jsencrypt']:
    idx = src.find("'" + k + "'")
    print('=== %s at %d ===' % (k, idx))
    if idx >= 0:
        print(src[idx:idx + 600])
    print()
