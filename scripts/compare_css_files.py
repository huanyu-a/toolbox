# -*- coding: utf-8 -*-
"""对比 site.min.css 与 app.css：判断关系 + 找构建源"""
import os, re, hashlib

SITE = r"C:\project\wwwroot\toolbox\public\static\style\site.min.css"
APP = r"C:\project\wwwroot\toolbox\public\static\style\app.css"

site = open(SITE, encoding="utf-8", errors="ignore").read()
app = open(APP, encoding="utf-8", errors="ignore").read()

print("site.min.css:", round(len(site)/1024, 1), "KB | app.css:", round(len(app)/1024, 1), "KB")

# site.min.css 中的 tool-card 样式 vs app.css 中的
def extract(css, cls):
    ms = re.findall(re.escape(cls) + r"[^{]*\{[^}]*\}", css)
    return ms

for cls in [".tool-card", ".tool-title", ".t-area", ".t-btn", ".t-options"]:
    s = extract(site, cls)[:1]
    a = extract(app, cls)[:1]
    same = s and a and s[0] == a[0]
    print(f"\n{cls}: site={len(extract(site, cls))} app={len(extract(app, cls))} 一致={same}")
    if s and a and not same:
        print("  site:", s[0][:120])
        print("  app :", a[0][:120])

# 找构建工具
print("\n=== 构建相关文件 ===")
for root, dirs, files in os.walk(r"C:\project\wwwroot\toolbox"):
    if "vendor" in root or "runtime" in root or ".git" in root or "node_modules" in root:
        continue
    for f in files:
        if f.lower() in ("package.json", "gulpfile.js", "gulpfile.babel.js", "webpack.config.js", "gruntfile.js", "composer.json") or f.endswith(".less") or f.endswith(".scss") or f.endswith(".sass"):
            print(" ", os.path.join(root, f))

# site.min.css 头部注释
print("\nsite.min.css 头部:", site[:200].replace("\n", " "))
print("app.css 头部:", app[:200].replace("\n", " "))
