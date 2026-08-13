# -*- coding: utf-8 -*-
"""验证线上渲染：webcheck 无死链残留；subnetmask 新皮肤 tab 完整"""
import re

ok = True

# webcheck
wc = open(r"C:\project\wwwroot\toolbox\.fetch\webcheck_live2.html", encoding="utf-8").read()
for bad in ["wcLinks", "死链", "check_url", "get_data"]:
    if bad in wc:
        ok = False
        print("webcheck 残留:", bad)
wc_tabs = re.findall(r'data-panel="(wc\w+)"', wc)
print("webcheck tabs:", sorted(set(wc_tabs)))
for need in ["wcIcp", "wcWhois", "wcWx", "wcGzip", "wcKw", "wcCode"]:
    if need not in wc:
        ok = False
        print("webcheck 缺失:", need)

# subnetmask
sm = open(r"C:\project\wwwroot\toolbox\.fetch\subnetmask_live.html", encoding="utf-8").read()
sm_tabs = re.findall(r'data-panel="(sm\w+)"', sm)
sm_panels = re.findall(r'<div id="(sm\w+)" class="t-panel sm-panel', sm)
print("subnetmask tabs:", sorted(set(sm_tabs)))
print("subnetmask panels:", sorted(set(sm_panels)))
if set(sm_tabs) != set(sm_panels):
    ok = False
    print("subnetmask tab/panel 不匹配")
# 面板内模块数
mods = re.findall(r't-mod-title">([^<]+)<', sm)
print("subnetmask 模块数:", len(mods))
# ID 重复检查
ids = re.findall(r'id="([^"]+)"', sm)
dup = {x for x in ids if ids.count(x) > 1}
if dup:
    print("subnetmask 重复 ID:", dup)
# 关键依赖
for need in ["pcjs/subnetmask.js", "pcjs/jq-public.js", "jquery-1.11.3.min.js",
             "子网掩码计算器介绍", "smTabs"]:
    if need not in sm:
        ok = False
        print("subnetmask 缺失:", need)
# 计算函数 onclick 引用
for fn in ["calNBFL", "compute2", "calcNWmaskForm2", "computeINV1", "computeSNMA",
           "calcIpInvert", "calcNeeded", "compute3", "calcAmount", "listsubnets"]:
    if fn not in sm:
        ok = False
        print("subnetmask 缺失函数引用:", fn)

print("ALL_OK" if ok else "HAS_FAILURES")
