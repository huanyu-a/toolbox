# -*- coding: utf-8 -*-
import subprocess, re

out = subprocess.run(['git', 'show', '938e705:config/web.php'], capture_output=True, text=True).stdout
for m in re.finditer(r"encode", out):
    i = m.start()
    print(repr(out[i-60:i+80]))
    print()
