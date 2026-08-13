# -*- coding: utf-8 -*-
import re
src = open(r"C:\project\wwwroot\toolbox\public\static\script\pcjs\subnetmask.js", encoding="utf-8").read()
funcs = re.findall(r"function\s+(\w+)", src)
print("subnetmask.js 函数:", sorted(set(funcs)))

jq = open(r"C:\project\wwwroot\toolbox\public\static\script\pcjs\jq-public.js", encoding="utf-8").read()
sel = re.findall(r'["\'](\.[\w-]+|#[\w-]+)["\']', jq)
print("jq-public 选择器:", sorted(set(sel))[:50])
