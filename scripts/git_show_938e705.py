# -*- coding: utf-8 -*-
import subprocess
out = subprocess.run(['git', 'show', '938e705', '--', 'config/web.php'], capture_output=True, text=True).stdout
print(out[:6000])
