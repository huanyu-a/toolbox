# -*- coding: utf-8 -*-
import re
path = r"C:\project\wwwroot\toolbox\config\tools.php"
src = open(path, encoding="utf-8").read()

# 找出所有连续逗号
for m in re.finditer(r",{2,}", src):
    ctx = src[max(0, m.start() - 60):m.end() + 20].replace("\n", "\\n")
    print("连续逗号:", ctx)

# 修复：把 "],,," 系列和 ",,," 压缩
src2 = re.sub(r"\],{2,}", "],", src)
src2 = re.sub(r",{2,}", ",", src2)
open(path, "w", encoding="utf-8", newline="\n").write(src2)
print("\n修复完成，剩余连续逗号:", len(re.findall(r",{2,}", src2)))
