# -*- coding: utf-8 -*-
"""提取文本转换组内联 JS + 控件清单"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
OUT = r"C:\project\wwwroot\toolbox\scripts\_text_extract"
os.makedirs(OUT, exist_ok=True)
slugs = ["textflip", "quanbaojiao", "capital", "rmbdaxie", "wenzitexiao", "zipstringtext", "huoxingwen"]

for slug in slugs:
    src = open(os.path.join(BASE, slug + ".html"), encoding="utf-8").read()
    js = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    js = [j for j in js if j.strip()]
    jsl = max((len(x) for x in js), default=0)
    # 控件
    ids = re.findall(r'<(?:textarea|input|button)[^>]*id="([^"]+)"', src)
    labels = re.findall(r'<label[^>]*for="([^"]+)"[^>]*>([^<]+)</label>', src)
    radios = re.findall(r'<input[^>]*type="radio"[^>]*name="([^"]+)"[^>]*value="([^"]+)"', src)
    checks = re.findall(r'<input[^>]*type="checkbox"[^>]*id="([^"]+)"', src)
    print(f"{slug}: JS={jsl}B ids={ids}")
    print(f"   labels={labels}")
    print(f"   radios={radios} checks={checks}")
    # 存 JS
    if js:
        open(os.path.join(OUT, slug + ".js"), "w", encoding="utf-8").write(js[-1])
    print()
