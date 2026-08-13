# -*- coding: utf-8 -*-
"""复验：section-meta 的 em 计数 + ICONS 键解码 + 图标注入脚本行为"""
import re, sys

src = open(r"C:\project\wwwroot\toolbox\.fetch\home_after.html", encoding="utf-8").read()
ok = True

m = re.search(r'class="home-section-meta">(.*?)</span>', src, re.S)
print("section-meta 完整:", m.group(1) if m else "NOT FOUND")
if m and "48" not in m.group(1):
    ok = False

# ICONS 键解码
m3 = re.search(r"var ICONS = (\{.*?\});", src, re.S)
if m3:
    keys = set(re.findall(r"'((?:\\u[0-9a-fA-F]{4})+)': '<svg", m3.group(1)))
    decoded = {k.encode().decode("unicode_escape") for k in keys}
    print("ICONS 键（解码）:", sorted(decoded))
    expect = {"开发编程", "文本处理", "计算换算", "网络运维", "站长辅助", "生活趣味"}
    if not expect <= decoded:
        ok = False
        print("ICONS 键缺失:", expect - decoded)
    extra = decoded - expect
    if extra:
        print("ICONS 多余键:", extra)

# 模拟图标注入：检查 data-ico 与键匹配
icos = re.findall(r'data-ico="([^"]+)"', src)
print("页面 data-ico:", icos)
if set(icos) != expect:
    ok = False
    print("页面分类与图标键不匹配")

print("ALL_OK" if ok else "HAS_FAILURES")
sys.exit(0 if ok else 1)
