# -*- coding: utf-8 -*-
"""web.php 死块删除：解析顶层块，仅删除不在白名单的块（其余原样保留）"""
import re, os

WEB = r"C:\project\wwwroot\toolbox\config\web.php"
TOOLS = r"C:\project\wwwroot\toolbox\config\tools.php"
VDIR = r"C:\project\wwwroot\toolbox\application\index\view\index"

tools = open(TOOLS, encoding="utf-8").read()
items = [u.strip("/") for u in re.findall(r"'url' => '(/[^']+)'", tools)]
views = set(f[:-5] for f in os.listdir(VDIR) if f.endswith(".html"))
whitelist = set(items) | views | {"index", "header"}
print("白名单(%d):" % len(whitelist))

lines = open(WEB, encoding="utf-8").read().splitlines(keepends=True)
start_idx = end_idx = None
for i, ln in enumerate(lines):
    if "return array" in ln and start_idx is None:
        start_idx = i
    if ln.strip() == ");" and start_idx is not None:
        end_idx = i
        break
print("数组范围: 行 %d ~ %d" % (start_idx, end_idx))

# 解析顶层块（两行 array / 单行 array / 标量多行配置）
blocks = []
i = start_idx + 1
depth = 0
cur_key = None
cur_start = None
while i < end_idx:
    ln = lines[i]
    if cur_key is None:
        m = re.match(r"^[ \t]*'([\w]+)' =>", ln)
        if m:
            cur_key = m.group(1)
            cur_start = i
            rest = ln[m.end():]
            next_is_array = (i + 1 < end_idx) and ("array" in lines[i + 1])
            if "array" in rest or (rest.strip() == "" and next_is_array):
                depth = ln.count("(") - ln.count(")")
            else:
                # 标量配置：跨行直到 ' 闭合 + 逗号（如 header 多行字符串）
                j = i
                while j < end_idx and not re.search(r"'\s*,?\s*$", lines[j]):
                    j += 1
                blocks.append((cur_key, cur_start, j))
                i = j
                cur_key = None
    else:
        depth += ln.count("(") - ln.count(")")
        if depth <= 0 and ln.rstrip().endswith("),"):
            blocks.append((cur_key, cur_start, i))
            cur_key = None
    i += 1

print("解析到块数:", len(blocks))
keys = [k for k, s, e in blocks]
removed = [k for k, s, e in blocks if k not in whitelist]
print("保留:", len(blocks) - len(removed))
print("删除(%d):" % len(removed), sorted(removed))

# 删除式重建
drop = {s for k, s, e in blocks if k not in whitelist}
out = []
for i, ln in enumerate(lines):
    if i in drop:
        out.append("\n")  # 保留空行占位
    else:
        out.append(ln)
open(WEB, "w", encoding="utf-8", newline="\n").write("".join(out))
print("新行数:", len(out))
