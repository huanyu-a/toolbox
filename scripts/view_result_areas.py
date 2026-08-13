# -*- coding: utf-8 -*-
import re, os
vdir = r"C:\project\wwwroot\toolbox\application\index\view\index"
for name in ["gzip", "checkurl"]:
    src = open(os.path.join(vdir, name + ".html"), encoding="utf-8", errors="ignore").read()
    print("=" * 30, name)
    # 结果区（body 后半部分）
    i = src.find("<body>")
    body = src[i:]
    # 去掉 script
    body_clean = re.sub(r"<script.*?</script>", "", body, flags=re.S)
    print(body_clean[:3000])
