# -*- coding: utf-8 -*-
"""web.php 白名单重建：仅保留仍在使用（有入口/有视图/特殊配置）的块"""
import re, os

WEB = r"C:\project\wwwroot\toolbox\config\web.php"
TOOLS = r"C:\project\wwwroot\toolbox\config\tools.php"
VDIR = r"C:\project\wwwroot\toolbox\application\index\view\index"

tools = open(TOOLS, encoding="utf-8").read()
items = [u.strip("/") for u in re.findall(r"'url' => '(/[^']+)'", tools)]
views = set(f[:-5] for f in os.listdir(VDIR) if f.endswith(".html"))

# 白名单：入口 act + 视图 act + 特殊配置
whitelist = set(items) | views | {"index", "header"}
print("白名单(%d):" % len(whitelist), sorted(whitelist))

lines = open(WEB, encoding="utf-8").read().splitlines(keepends=True)
# 找 return array ( 和结尾 ); 的位置
start_idx = None
end_idx = None
for i, ln in enumerate(lines):
    if "return array" in ln and start_idx is None:
        start_idx = i
    if ln.strip() == ");" and start_idx is not None:
        end_idx = i
        break
print("数组范围: 行 %d ~ %d" % (start_idx, end_idx))

# 解析顶层块（支持: 两行 array 格式 / 单行 array 格式 / 标量单行配置）
blocks = []  # (key, start_line, end_line)
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
                # array 块（单行 or 两行格式）
                depth = ln.count("(") - ln.count(")")
                if depth <= 0 and ln.rstrip().endswith("),"):
                    blocks.append((cur_key, cur_start, i))
                    cur_key = None
            else:
                # 标量单行配置（如 'header' => '...'）
                blocks.append((cur_key, cur_start, i))
                cur_key = None
    else:
        depth += ln.count("(") - ln.count(")")
        if depth <= 0 and ln.rstrip().endswith("),"):
            blocks.append((cur_key, cur_start, i))
            cur_key = None
    i += 1
print("解析到块数:", len(blocks))

removed = [k for k, s, e in blocks if k not in whitelist]
kept = [k for k, s, e in blocks if k in whitelist]
print("保留:", len(kept), sorted(kept))
print("删除:", len(removed), sorted(removed))

# 重建：头部 + 保留块（块间空行） + 尾部
out = []
for k, s, e in blocks:
    if k in whitelist:
        out.append("".join(lines[s:e + 1]) + "\n")
new_content = "".join(lines[:start_idx + 1]) + "\n" + "\n".join(out) + "".join(lines[end_idx:])
open(WEB, "w", encoding="utf-8", newline="\n").write(new_content)
print("新 web.php 行数:", new_content.count("\n"))
