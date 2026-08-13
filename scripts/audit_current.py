# -*- coding: utf-8 -*-
"""复审：当前工具页全景 + 老脚本残留 + 导航配置对照"""
import os, re, json

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
TOOLS_CFG = r"C:\project\wwwroot\toolbox\config\tools.php"

# 1. 页面清单
pages = sorted(f[:-5] for f in os.listdir(BASE) if f.endswith(".html"))
print("页面总数:", len(pages))

# 2. 导航配置里的 URL
cfg_src = open(TOOLS_CFG, encoding="utf-8").read()
cfg_urls = set(re.findall(r"'url'\s*=>\s*'/([^/]+)/'", cfg_src))
print("导航配置工具数:", len(cfg_urls))

# 3. 有页面但不在导航 / 在导航但无页面
only_pages = sorted(set(pages) - cfg_urls - {"index"})
only_cfg = sorted(cfg_urls - set(pages))
print("\n[有页面但不在导航]", len(only_pages))
print(only_pages)
print("\n[导航有但无页面]", len(only_cfg))
print(only_cfg)

# 4. 老脚本残留扫描
print("\n=== 老脚本/旧模式残留 ===")
legacy_patterns = {
    "tool.js": r'src="/static/script/tool\.js"',
    "hightout.js": r'src="/static/script/hightout\.js"',
    "pcjs/": r'src="/static/script/pcjs/',
    "setJS(": r'setJS\(',
    "onclick=": r'\sonclick=',
    "form-horizontal": r'form-horizontal',
    "col10main": r'col10main',
    "form-control": r'form-control',
    "data-clipboard": r'data-clipboard-target',
    "btn btn-": r'class="btn btn-',
}
legacy_hits = {}
for p in pages:
    src = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    for label, pat in legacy_patterns.items():
        if re.search(pat, src):
            legacy_hits.setdefault(label, []).append(p)

for label, hits in legacy_hits.items():
    print(f"{label}: {len(hits)} 页 -> {hits[:60]}")

# 5. 页面大小分布（可能有大文件/坏文件）
print("\n=== 异常大小页面 ===")
for p in pages:
    size = os.path.getsize(os.path.join(BASE, p + ".html"))
    if size < 1500:
        print(f"  [小] {p}: {size}B")
    elif size > 120000:
        print(f"  [大] {p}: {size/1024:.0f}KB")
