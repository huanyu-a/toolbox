# -*- coding: utf-8 -*-
"""检查 ports / editor 页功能完整性"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

for p in ["ports", "editor"]:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    print(f"===== {p}.html ({len(src)}B) =====")
    # 主体结构
    body = re.sub(r"<script.*?</script>", "", src, flags=re.S)
    text = re.sub(r"<[^>]+>", " ", body)
    text = re.sub(r"\s+", " ", text)
    print("  文本:", text[:300])
    # 交互
    print("  含搜索:", 'type="search"' in src or "搜索" in src or "filter" in src.lower())
    print("  含 onclick:", bool(re.search(r"\sonclick=", src)))
    print("  含 addEventListener:", src.count("addEventListener"))
    print("  外部脚本:", re.findall(r'<script[^>]*src="([^"]+)"', src))
    print()
