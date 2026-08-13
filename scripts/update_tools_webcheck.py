# -*- coding: utf-8 -*-
"""tools.php：删 6 个查询工具入口，加 webcheck"""
import re

path = r"C:\project\wwwroot\toolbox\config\tools.php"
src = open(path, encoding="utf-8").read()

targets = ["chaicp", "whois", "checkurl", "checkweixin", "gzip", "checkkeyword"]
removed = 0
for t in targets:
    # 匹配 ['url' => '/xxx/', ...] 整条
    pat = re.compile(r"\s*\['url' => '/" + t + r"/'[^\]]*\]")
    m = pat.search(src)
    if m:
        src = src[:m.start()] + src[m.end():]
        removed += 1
        print("已删除:", t)
    else:
        print("未找到:", t)

# 插入 webcheck（放在 chaicp 原位置附近：找一个现有锚点，如 'ip' 入口前）
anchor = "['url' => '/ip/'"
assert anchor in src, "锚点 /ip/ 不存在"
new_item = "            ['url' => '/webcheck/', 'name' => '网站检测', 'accent' => ''],\n"
src = src.replace(anchor, new_item + anchor, 1)
print("已插入 /webcheck/")

open(path, "w", encoding="utf-8", newline="\n").write(src)
print("完成，共删除", removed, "个入口")
