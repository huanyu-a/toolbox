# -*- coding: utf-8 -*-
"""Index.php：删除 8 个 case（guid/md5/chameta/webstatus 死代码 + gzip/checkkeyword/whois/chaicp 已迁移）"""
path = r"C:\project\wwwroot\toolbox\application\index\controller\Index.php"
lines = open(path, encoding="utf-8").read().splitlines(keepends=True)

# 基于当前行号（1-based）的删除范围：从后往前
# chaicp 343-371, whois 289-342, chameta+webstatus 258-288, checkkeyword 245-257, gzip 227-237, guid+md5 95-117
ranges = [
    (343, 371, "chaicp"),
    (289, 342, "whois"),
    (258, 288, "chameta/webstatus"),
    (245, 257, "checkkeyword"),
    (227, 237, "gzip"),
    (95, 117, "guid/md5"),
]
for start, end, label in ranges:
    # 校验目标行确实包含预期内容
    chunk = "".join(lines[start - 1:end])
    ok = "case '" in chunk and ("break;" in chunk)
    if not ok:
        print("WARN 校验失败:", label, "行", start, "-", end)
        print(chunk[:120])
        continue
    del lines[start - 1:end]
    print("已删除:", label, "行", start, "-", end)

open(path, "w", encoding="utf-8", newline="\n").write("".join(lines))
print("完成。剩余行数:", len(lines))
