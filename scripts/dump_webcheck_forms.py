# -*- coding: utf-8 -*-
"""提取查询型页面的 form action + 输入字段 + 按钮 + 结果区"""
import re, os

vdir = r"C:\project\wwwroot\toolbox\application\index\view\index"
for name in ["chaicp", "whois", "checkurl", "checkweixin", "gzip", "checkkeyword", "pagecode"]:
    p = os.path.join(vdir, name + ".html")
    src = open(p, encoding="utf-8", errors="ignore").read()
    print("=" * 25, name)
    # form 标签
    for fm in re.findall(r"<form[^>]*>", src):
        print("  FORM:", fm[:150])
    # input/textarea 字段
    for inp in re.findall(r"<(input|textarea|button)[^>]*>", src)[:14]:
        s = inp.strip()
        if "hidden" in s or "submit" in s or "button" in s or "text" in s or "url" in s or "name=" in s:
            print("   ", s[:160])
