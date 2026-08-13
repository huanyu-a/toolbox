# -*- coding: utf-8 -*-
import re
web = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8").read()
lines = web.splitlines()
s = next(i for i, l in enumerate(lines) if "return array" in l)
e = next(i for i, l in enumerate(lines) if l.strip() == ");")
depth = 0
cur = None
keys = {}
i = s + 1
while i < e:
    ln = lines[i]
    if cur is None:
        m = re.match(r"^[ \t]*'([\w]+)' =>", ln)
        if m:
            cur = m.group(1)
            rest = ln[m.end():]
            if "array" not in rest and not (rest.strip() == "" and i + 1 < e and "array" in lines[i + 1]):
                keys[cur] = "scalar"
                cur = None
            else:
                depth = ln.count("(") - ln.count(")")
    else:
        depth += ln.count("(") - ln.count(")")
        if depth <= 0 and ln.rstrip().endswith("),"):
            keys[cur] = "array"
            cur = None
    i += 1
print("总块数:", len(keys))
print("标量配置:", {k: v for k, v in sorted(keys.items()) if v == "scalar"})
