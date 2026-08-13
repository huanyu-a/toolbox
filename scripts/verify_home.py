# -*- coding: utf-8 -*-
"""验证线上首页：结构、图标注入、emoji 残留、JS 语法"""
import re, subprocess, sys

src = open(r"C:\project\wwwroot\toolbox\.fetch\home_after.html", encoding="utf-8").read()
ok = True

# 1. 关键结构
for need in ['home.css', 'class="home-eyebrow"', 'WEB TOOLKIT', 'id="homeSearch"',
             'class="home-search-kbd"', 'Ctrl K', 'id="homeCats"', 'id="homeHot"',
             'class="home-section-head"', 'class="home-section-meta"', 'home-cat-ico',
             'data-ico="开发编程"', 'data-ico="生活趣味"', 'id="homeEmpty"']:
    if need not in src:
        ok = False
        print("MISSING:", need)

# 2. 分类计数渲染
m = re.search(r'class="home-section-meta">([^<]*)<', src)
print("section-meta 渲染:", m.group(1) if m else "NOT FOUND")
if m and "个分类" not in m.group(1):
    ok = False
m2 = re.search(r'class="home-eyebrow">WEB TOOLKIT<span class="dot">·</span><span id="homeStat">([^<]*)</span>', src)
print("eyebrow 统计渲染:", m2.group(1) if m2 else "NOT FOUND")

# 3. emoji 残留（首页主体，排除共享 header/footer 的🌙☰🔍）
main = re.search(r'<main class="home-wrap">(.*?)</main>', src, re.S)
if main:
    body = main.group(1)
    emoji = re.findall(r'[\U0001F300-\U0001FAFF\u2600-\u27BF\uFE0F]', body)
    print("首页主体 emoji 残留:", emoji if emoji else "无")
    if emoji:
        ok = False
else:
    print("未找到 main 主体")

# 4. 卡片数与图标
cats = re.findall(r'class="home-cat" id="cat-', src)
print("分类卡片数:", len(cats))
if len(cats) != 6:
    ok = False
svg_ico = re.findall(r'<span class="home-cat-ico" data-ico="([^"]+)"', src)
print("图标位:", len(svg_ico), svg_ico)

# 5. 内联 JS 语法
blocks = re.findall(r"<script(?![^>]*src=)[^>]*>(.*?)</script>", src, re.S)
tmp = r"C:\project\wwwroot\toolbox\scripts\tmp_home.js"
for i, b in enumerate(blocks):
    with open(tmp, "w", encoding="utf-8") as f:
        f.write(b)
    r = subprocess.run(["node", "--check", tmp], capture_output=True, text=True)
    if r.returncode != 0:
        ok = False
        print("JS FAIL block %d:" % i, r.stderr[:500])
    else:
        print("JS OK block %d (%d B)" % (i, len(b)))

# 6. 分类图标 map 中的键是否覆盖全部分类
import json
m3 = re.search(r"var ICONS = (\{.*?\});", src, re.S)
if m3:
    keys = set(re.findall(r"'([^']+)': '<svg", m3.group(1)))
    print("ICONS 键:", sorted(keys))
    if not {"开发编程", "文本处理", "计算换算", "网络运维", "站长辅助", "生活趣味"} <= keys:
        ok = False
        print("ICONS 键不完整")

print("ALL_OK" if ok else "HAS_FAILURES")
sys.exit(0 if ok else 1)
