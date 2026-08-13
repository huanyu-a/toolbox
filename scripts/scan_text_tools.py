# -*- coding: utf-8 -*-
"""扫描文本转换组页面结构"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
slugs = ["jianfan", "pinyin", "huoxingwen", "shupai", "textflip", "quanbaojiao", "capital", "rmbdaxie", "wenzitexiao", "zipstringtext", "txtreplace", "textdiff", "txtcount", "quchong", "autoformat", "caiji"]

for slug in slugs:
    fp = os.path.join(BASE, slug + ".html")
    if not os.path.exists(fp):
        print(f"{slug}: ❌ 缺失")
        continue
    src = open(fp, encoding="utf-8").read()
    # 提取主体内容（tool-card 内）
    m = re.search(r'<div class="tool-card">(.*?)</div>\s*</div>\s*</div>', src, re.S)
    body = m.group(1) if m else src
    # 文本域和按钮
    areas = re.findall(r'<textarea[^>]*id="([^"]+)"[^>]*>', body)
    btns = re.findall(r'<button[^>]*id="([^"]+)"', body)
    inputs = re.findall(r'<input[^>]*id="([^"]+)"', body)
    # 内联 JS 长度
    js = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    jsl = max((len(x) for x in js), default=0)
    # 外部脚本
    ext = re.findall(r'<script[^>]*src="([^"]+)"', src)
    print(f"{slug:14s} {os.path.getsize(fp):6d}B ta={areas} btn={btns} in={inputs} js={jsl}B ext={[e.split('/')[-1] for e in ext]}")
