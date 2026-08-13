# -*- coding: utf-8 -*-
"""检查线上 webcheck 页面：状态码 tab、查询控件、对照表完整性"""
src = open(r"C:\project\wwwroot\toolbox\.fetch\webcheck_live.html", encoding="utf-8").read()
ok = True
for term in ['data-panel="wcCode"', 'id="wcCodeUrl"', 'id="wcCodeQuery"', 'id="wcCodeError"',
             'id="wcCodeResult"', '1xx 信息响应', '2xx 成功', '3xx 重定向', '4xx 客户端错误',
             '5xx 服务器错误', '查询 HTTP 状态', '复制结果']:
    if term not in src:
        ok = False
        print("MISSING:", term)
# 对照表行数抽查
import re
rows = re.findall(r'<td style="white-space:nowrap;font-weight:600">\d{3}</td>', src)
print("对照表状态码行数:", len(rows))
print("wcCode 相关 id 出现次数:", len(re.findall(r'wcCode\w*', src)))
print("ALL_OK" if ok and len(rows) > 30 else "HAS_FAILURES")
