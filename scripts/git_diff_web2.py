# -*- coding: utf-8 -*-
import subprocess

out = subprocess.run(['git', 'show', '938e705', '--', 'config/web.php'], capture_output=True)
text = out.stdout.decode('utf-8', errors='replace')
lines = text.splitlines()
print('\n'.join(lines[130:260]))
