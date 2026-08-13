# -*- coding: utf-8 -*-
import subprocess, re, sys

for commit in ['938e705', '527677d', '59ea20d', '2d08bb6', 'd952049', 'HEAD']:
    out = subprocess.run(['git', 'show', commit + ':config/web.php'], capture_output=True, text=True).stdout
    m = re.search(r"'encode'\s*=>\s*array\s*\(", out)
    n = len(re.findall(r"'[a-z][a-z0-9]*'\s*=>\s*array\s*\(", out))
    print('%s: encode=%s 块数=%d' % (commit, bool(m), n))
