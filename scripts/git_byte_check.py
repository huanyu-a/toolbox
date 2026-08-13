# -*- coding: utf-8 -*-
import subprocess

for commit in ['938e705', '527677d', 'HEAD']:
    b = subprocess.run(['git', 'show', commit + ':config/web.php'], capture_output=True).stdout
    keys = [b"'encode' =>", b"'urlencode' =>", b"'ascii' =>", b"'base64' =>", b"'textconvert' =>"]
    hits = {k.decode('utf-8'): (k in b) for k in keys}
    print(commit, hits)
