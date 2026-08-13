# -*- coding: utf-8 -*-
import subprocess, re
out = subprocess.run(['git', 'show', '938e705:config/web.php'], capture_output=True, text=True).stdout
i = out.find('subnetmask')
print(repr(out[i-500:i+200]))
