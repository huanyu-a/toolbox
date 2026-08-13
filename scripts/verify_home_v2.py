# -*- coding: utf-8 -*-
"""验证首页 v2：磁贴结构、图标注入规则覆盖、emoji、JS 语法"""
import re, subprocess, sys

src = open(r"C:\project\wwwroot\toolbox\.fetch\home_v2.html", encoding="utf-8").read()
ok = True

# 1. 结构完整性
tiles = re.findall(r'<li>\s*<a href="(/[^"]+)"[^>]*>\s*<span class="tile-ico"', src)
print("磁贴数:", len(tiles))
if len(tiles) != 48:
    ok = False
    print("磁贴数 != 48")

tile_names = re.findall(r'<span class="tile-name">([^<]+)</span>', src)
print("tile-name 数:", len(tile_names))
if len(tile_names) != 48:
    ok = False

# 2. 搜索依赖类名
for need in ['id="homeSearch"', 'id="homeCats"', 'id="homeEmpty"', 'id="homeSearchClear"',
             'class="home-cat"', 'class="home-cat-list"', 'data-cat=']:
    if need not in src:
        ok = False
        print("缺失搜索依赖:", need)

# 3. 分类块
cats = re.findall(r'<div class="home-cat" id="cat-', src)
print("分类块数:", len(cats))
if len(cats) != 6:
    ok = False

# 4. emoji 残留（首页主体 home-wrap 内）
m = re.search(r'<main class="home-wrap">(.*?)</main>', src, re.S)
body = m.group(1) if m else ""
emoji = re.findall(r'[\U0001F000-\U0001FAFF\u2600-\u27BF\uFE0F]', body)
print("主体 emoji 残留:", emoji if emoji else "无")
if emoji:
    ok = False

# 5. 图标规则覆盖：提取模板中 TOOL_RULES 的 URL 正则
rules = re.findall(r"re: /([^/]+)/", src)
print("图标规则:", rules)
# 从渲染 HTML 拿全部 URL，逐一检查至少被一条规则命中
urls = re.findall(r'<a href="(/[^"]+)"', body)
uncovered = []
for u in urls:
    if not any(re.search(r, u) for r in rules):
        uncovered.append(u)
print("未被图标规则覆盖的 URL:", uncovered if uncovered else "无")
if uncovered:
    ok = False

# 6. 内联 JS 语法
blocks = re.findall(r"<script(?![^>]*src=)[^>]*>(.*?)</script>", src, re.S)
tmp = r"C:\project\wwwroot\toolbox\scripts\tmp_homev2.js"
for i, b in enumerate(blocks):
    if "schema.org" in b[:200]:
        continue
    with open(tmp, "w", encoding="utf-8") as f:
        f.write(b)
    r = subprocess.run(["node", "--check", tmp], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print("JS FAIL block %d:" % i, r.stderr[:400])
    else:
        print("JS OK block %d (%d B)" % (i, len(b)))

print("ALL_OK" if ok else "HAS_FAILURES")
sys.exit(0 if ok else 1)
