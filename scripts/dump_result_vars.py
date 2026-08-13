# -*- coding: utf-8 -*-
"""提取旧页面结果渲染部分（变量引用）"""
import re, os

vdir = r"C:\project\wwwroot\toolbox\application\index\view\index"
for name in ["gzip", "checkkeyword", "whois", "chaicp"]:
    src = open(os.path.join(vdir, name + ".html"), encoding="utf-8", errors="ignore").read()
    print("=" * 30, name)
    # 找出模板变量引用
    vars_ = sorted(set(re.findall(r"\{\$?([a-zA-Z_][\w\.]*)\}?", src)))
    print("  模板变量:", [v for v in vars_ if not v.startswith("Think")][:20])
    # 结果区域片段
    for key in ["gzip", "html_", "whois", "icp", "domain"]:
        i = src.find(key)
        if i > 0:
            print("  ...", src[max(0, i - 120):i + 200].replace("\n", " ")[:320])
            break
