# -*- coding: utf-8 -*-
import re
src = open('config/tools.php', encoding='utf-8').read()
lines = src.split('\n')
per = []
cur = None
for ln in lines:
    m = re.search(r"'cat' => '([^']+)'", ln)
    if m:
        cur = m.group(1)
        per.append([cur, 0])
    if re.search(r"'url' =>", ln) and cur:
        per[-1][1] += 1
for name, n in per:
    print(' ', name, n)
print('工具总数:', sum(n for _, n in per))
