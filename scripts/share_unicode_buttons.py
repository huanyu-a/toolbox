# -*- coding: utf-8 -*-
"""unicode.html：按钮共享化——两个 tab 共用一套按钮，只切换 radio 选项"""
import re

path = r"C:\project\wwwroot\toolbox\application\index\view\index\unicode.html"
src = open(path, encoding="utf-8").read()

# 1. 提取两套按钮组 HTML（第一个 uc 按钮组保留为共享按钮组）
btn_blocks = re.findall(r'<div class="tool-actions">.*?</div>\s*(?=<div class="t-error"|</div>)', src, re.S)
print("按钮组块数:", len(btn_blocks))
shared_btns = btn_blocks[0] if btn_blocks else None

# 2. 两个 panel 都删除按钮组
for b in btn_blocks:
    src = src.replace(b, "", 1)

# 3. 把共享按钮组放在两个 panel 之后（t-error 之前整体结构：panel1 选项 + panel2 选项 + 共享按钮 + 错误）
# 但需要两个错误区分别在 panel 里。更简单：共享按钮组插入到 ucPanel1 的 t-options 之后？不行，panel2 也要。
# 方案：把按钮组放到两个 panel 之后、tool-card 结束前；两个错误区保留在各自 panel。
# 提取两个错误区
err_blocks = re.findall(r'<div class="t-error"[^>]*id="[^"]+"[^>]*></div>', src)
print("错误区:", err_blocks)

# 共享按钮组插入在第二个 panel 结束 </div> 之前的位置 —— 定位 ucPanel2 的结尾
# 结构: ...<div id="ucPanel2" class="t-panel">...</div> 然后 </div>(tool-card)
# 我们在 ucPanel2 的 </div> 后、tool-card 结束前插入共享按钮组
marker = '<div class="t-error" id="nuError" role="alert"></div>\n        </div>'
if marker in src and shared_btns:
    src = src.replace(marker, '<div class="t-error" id="nuError" role="alert"></div>\n        </div>\n' + shared_btns.strip())

open(path, "w", encoding="utf-8").write(src)

# 验证
new = open(path, encoding="utf-8").read()
print("\n=== 验证 ===")
print("ucToCode 出现:", new.count('id="ucToCode"'))
print("nuToCode 出现:", new.count('id="nuToCode"'))
print("按钮组总数(应1):", len(re.findall(r'id="(?:uc|nu)(?:ToCode|ToText|Swap|Demo|Clear)"', new)))
