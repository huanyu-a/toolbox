# -*- coding: utf-8 -*-
"""unicode.html 共享输入输出重构"""
import re

path = r"C:\project\wwwroot\toolbox\application\index\view\index\unicode.html"
src = open(path, encoding="utf-8").read()

# 1. 提取共享 grid（ucInput/ucOutput 双栏）
grids = re.findall(r'<div class="t-grid">.*?</div>\s*</div>', src, re.S)
shared_grid = grids[0]  # ucInput/ucOutput 版本
print("提取共享 grid:", len(shared_grid), "chars")

# 2. 删除两个 panel 内的 t-grid（第一个是 ucPanel1 的，第二个是 ucPanel2 的）
for g in grids:
    src = src.replace(g, "", 1)

# 3. 在 tabs </ul> 后插入共享 grid
src = src.replace("</ul>", "</ul>\n" + shared_grid.strip(), 1)

# 4. nu bind 复用 ucInput/ucOutput
src = src.replace("bind('nuInput', 'nuOutput', 'nuError', 'nuMode')",
                  "bind('ucInput', 'ucOutput', 'nuError', 'nuMode')")

open(path, "w", encoding="utf-8").write(src)

# 验证
new = open(path, encoding="utf-8").read()
print("textarea 数:", len(re.findall(r"<textarea", new)))
print("nuInput 残留:", "nuInput" in new)
print("nuOutput 残留:", "nuOutput" in new)
print("共享 grid 位置: 在 tabs 后:", "</ul>\n<div class=\"t-grid\">" in new)
print("nu bind:", "bind('ucInput', 'ucOutput', 'nuError', 'nuMode')" in new)
