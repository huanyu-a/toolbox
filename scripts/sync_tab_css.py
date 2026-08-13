# -*- coding: utf-8 -*-
"""把缺失的 tab 组件样式同步进 site.min.css（全站唯一加载的样式文件）"""
import re

SITE = r"C:\project\wwwroot\toolbox\public\static\style\site.min.css"
site = open(SITE, encoding="utf-8", errors="ignore").read()

# 防止重复追加
if ".tool-card .t-tabs" in site:
    print("site.min.css 已有 tab 样式，跳过")
else:
    tab_css = """

/* ===== 合集页 Tab 组件（工具合并） ===== */
.tool-card .t-tabs { display: flex; flex-wrap: wrap; gap: 8px; margin: 0 0 20px; padding: 0; list-style: none; }
.tool-card .t-tabs li { margin: 0; }
.tool-card .t-tabs li button.t-tab { position: relative; display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; font-size: 13px; line-height: 1.4; color: var(--text-2); background: var(--surface); border: 1px solid var(--border); border-radius: 16px; cursor: pointer; transition: all .18s ease; user-select: none; white-space: nowrap; }
.tool-card .t-tabs li button.t-tab:hover { color: var(--brand); border-color: var(--brand); background: rgba(79, 110, 242, .07); transform: translateY(-1px); }
.tool-card .t-tabs li button.t-tab:active { transform: translateY(0); }
.tool-card .t-tabs li button.t-tab.active { color: #fff; background: linear-gradient(135deg, var(--brand), var(--brand-strong)); border-color: transparent; font-weight: 600; box-shadow: 0 3px 10px rgba(79, 110, 242, .32); }
.tool-card .t-tabs li button.t-tab.active:hover { color: #fff; background: linear-gradient(135deg, var(--brand), var(--brand-strong)); transform: translateY(-1px); }
.tool-card .t-panel { display: none; }
.tool-card .t-panel.active { display: block; }
.tool-card .t-tabs + .t-panel-wrap .t-panel { margin-top: 0; }
.t-panel + .t-panel { border-top: 1px dashed var(--border); margin-top: 18px; padding-top: 18px; }
"""
    open(SITE, "w", encoding="utf-8").write(site.rstrip() + "\n" + tab_css)
    print("已追加 tab 组件样式到 site.min.css")

# 验证
site2 = open(SITE, encoding="utf-8", errors="ignore").read()
for cls in [".t-tabs", ".t-tab", ".t-panel", ".t-panel.active"]:
    print(f"site.min.css 含 {cls}: {cls in site2}")
print("花括号平衡:", site2.count("{") - site2.count("}"))
print("大小:", round(len(site2)/1024, 1), "KB")
