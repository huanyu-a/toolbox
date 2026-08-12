# -*- coding: utf-8 -*-
"""从 nav.html 提取工具注册表，生成 config/tools.php"""
import re, json, collections, io

SRC = r'C:\project\wwwroot\toolbox\application\index\view\nav.html'
DST = r'C:\project\wwwroot\toolbox\config\tools.php'

with io.open(SRC, encoding='utf-8') as f:
    html = f.read()

# 每个分类块: <ul class="list-inline list-inline-bg"> ... </ul>
uls = re.findall(r'<ul class="list-inline list-inline-bg">(.*?)</ul>', html, re.S)
cats = []
for ul in uls:
    m = re.search(r'<h3><span>(.*?)</span></h3>', ul, re.S)
    if not m:
        continue
    cat = m.group(1).strip()
    items = []
    for li in re.findall(r'<li>(.*?)</li>', ul, re.S):
        am = re.search(r'<a href="(/[^"]*/)"([^>]*)>(.*?)</a>', li, re.S)
        if am:
            url = am.group(1).strip()
            attrs = am.group(2) or ''
            name = re.sub(r'<[^>]+>', '', am.group(3)).strip()
            # 提取强调色
            cm = re.search(r'color:\s*([#\w]+)', attrs)
            accent = cm.group(1) if cm else ''
            items.append({'url': url, 'name': name, 'accent': accent})
    cats.append({'cat': cat, 'items': items})

total = sum(len(c['items']) for c in cats)
print("分类数:", len(cats), "工具数:", total)
for c in cats:
    print(" -", c['cat'], len(c['items']))

seen = collections.Counter()
for c in cats:
    for it in c['items']:
        seen[it['url']] += 1
dups = {k: v for k, v in seen.items() if v > 1}
print("重复URL:", dups)

# 生成 PHP 数组
def php_str(s):
    return "'" + s.replace("\\", "\\\\").replace("'", "\\'") + "'"

lines = []
lines.append("<?php")
lines.append("// 工具注册表（由 nav.html 提取生成，勿手改结构）")
lines.append("// 结构: [ ['cat'=>分类名, 'items'=>[['url'=>..., 'name'=>..., 'accent'=>...], ...]], ... ]")
lines.append("return [")
for c in cats:
    lines.append("    [")
    lines.append("        'cat' => " + php_str(c['cat']) + ",")
    lines.append("        'items' => [")
    for it in c['items']:
        lines.append("            ['url' => " + php_str(it['url']) + ", 'name' => " + php_str(it['name']) + ", 'accent' => " + php_str(it['accent']) + "],")
    lines.append("        ],")
    lines.append("    ],")
lines.append("];")
lines.append("")

with io.open(DST, 'w', encoding='utf-8', newline='\n') as f:
    f.write("\n".join(lines))

# 也生成 json 备用
with io.open(r'C:\project\wwwroot\toolbox\runtime\tools_parsed.json', 'w', encoding='utf-8') as f:
    json.dump(cats, f, ensure_ascii=False, indent=1)

print("已生成", DST)
