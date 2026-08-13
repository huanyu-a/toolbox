# -*- coding: utf-8 -*-
"""首页移除 tool.js"""
import re
path = r"C:\project\wwwroot\toolbox\application\index\view\index\index.html"
src = open(path, encoding="utf-8").read()
new = re.sub(r'<script[^>]*src="/static/script/tool\.js"[^>]*>\s*</script>\s*', "", src)
open(path, "w", encoding="utf-8").write(new)
print("移除后仍含 tool.js:", "tool.js" in new)
