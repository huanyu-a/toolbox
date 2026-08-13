# -*- coding: utf-8 -*-
"""从 tools.php 删除 pagecode 条目"""
import re

path = r"C:\project\wwwroot\toolbox\config\tools.php"
src = open(path, encoding="utf-8").read()
line = "            ['url' => '/pagecode/', 'name' => 'HTTP \u72b6\u6001\u7801', 'accent' => ''],"
if line not in src:
    # 尝试任意空白前缀匹配
    m = re.search(r"^\s*\['url' => '/pagecode/',[^\n]*\n", src, re.M)
    if not m:
        raise SystemExit("pagecode line not found")
    src = src[:m.start()] + src[m.end():]
else:
    src = src.replace(line + "\n", "")
open(path, "w", encoding="utf-8").write(src)
print("已删除 pagecode 条目，pagecode 剩余出现:", src.count("pagecode"))
