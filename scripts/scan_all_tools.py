# -*- coding: utf-8 -*-
"""全局扫描所有工具页：结构类型 + JS 依赖 + 交互模式"""
import os, re, json

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
SCPT = r"C:\project\wwwroot\toolbox\public\static\script"

# 读 tools.php 拿 URL→name 映射
tp = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
urls = re.findall(r"'url' => '/([^/]+)/'", tp)

def load_js(name):
    # 尝试多个位置
    for root, _, files in os.walk(SCPT):
        if name in files:
            try:
                return open(os.path.join(root, name), encoding="utf-8", errors="ignore").read()
            except Exception:
                return ""
    return ""

rows = []
for slug in urls:
    fp = os.path.join(BASE, slug + ".html")
    if not os.path.exists(fp):
        rows.append({"slug": slug, "missing": True})
        continue
    src = open(fp, encoding="utf-8", errors="ignore").read()
    # 统计
    textarea = len(re.findall(r"<textarea", src))
    inputs = len(re.findall(r"<input", src))
    buttons = len(re.findall(r"<button", src))
    selects = len(re.findall(r"<select", src))
    tabs = len(re.findall(r"class=\"t-tab", src))
    old_form = "form-horizontal" in src or "MainHead" in src or "col-sm-" in src
    new_skin = "tool-card" in src
    # 内联 JS
    inline_js = len(re.findall(r"<script(?![^>]*src)[^>]*>", src))
    # 外部脚本
    ext_scripts = re.findall(r'<script[^>]*src="([^"]+)"', src)
    rows.append({
        "slug": slug, "size": os.path.getsize(fp), "ta": textarea, "in": inputs,
        "btn": buttons, "sel": selects, "tabs": tabs, "old": old_form and not new_skin,
        "inline": inline_js, "ext": ext_scripts,
    })

# 输出
for r in rows:
    if r.get("missing"):
        print(f"{r['slug']:22s} ❌ 模板缺失")
        continue
    print(f"{r['slug']:22s} {r['size']:6d}B ta={r['ta']} in={r['in']} btn={r['btn']} sel={r['sel']} tabs={r['tabs']} old={'Y' if r['old'] else '-'} ext={len(r['ext'])}")
