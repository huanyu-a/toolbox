# -*- coding: utf-8 -*-
"""找出 app.css 有但 site.min.css 缺失的所有选择器"""
import re

site = open(r"C:\project\wwwroot\toolbox\public\static\style\site.min.css", encoding="utf-8", errors="ignore").read()
app = open(r"C:\project\wwwroot\toolbox\public\static\style\app.css", encoding="utf-8", errors="ignore").read()

# 提取 app.css 中所有选择器（.tool-card 开头的工具样式）
selectors = set()
for m in re.finditer(r"([.#][a-zA-Z][\w-]*(?:\s*[>+~]\s*[.#][\w-]+|\s+[.#][\w-]+)*)\s*\{", app):
    sel = m.group(1).strip()
    if sel.startswith(".tool-card") or sel.startswith(".t-") or sel.startswith(".tool-"):
        selectors.add(sel)

missing = []
for sel in sorted(selectors):
    # 简化匹配：取第一个类名作为关键片段
    key = sel.split()[0].split(">")[0].split("+")[0].strip(".")
    if key and ("." + key) not in site:
        missing.append(sel)

print("app.css 工具相关选择器总数:", len(selectors))
print("\n缺失的（site.min.css 中无对应类）:")
for sel in missing:
    print("  ", sel)
