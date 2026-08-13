# -*- coding: utf-8 -*-
"""验证保留项页面存在 + 删除被合并旧页面"""
import os, re, shutil

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
TOOLS = r"C:\project\wwwroot\toolbox\config\tools.php"

# 读取新导航的保留项
src = open(TOOLS, encoding="utf-8").read()
kept = set(re.findall(r"'url' => '/([^/]+)/'", src))
print("新导航保留项:", len(kept))

# 校验页面存在
missing = [k for k in kept if not os.path.exists(os.path.join(BASE, k + ".html"))]
print("保留项缺失页面:", missing)

# 待删文件 = 目录中所有页面 - 保留项 - index
all_pages = set(f[:-5] for f in os.listdir(BASE) if f.endswith(".html"))
to_delete = sorted(all_pages - kept - {"index"})
print("待删旧页面:", len(to_delete))
print(to_delete)

# 备份到 git 之外的安全位置？项目是 git 仓库，直接删即可（git 可恢复）
backup_dir = r"C:\project\wwwroot\toolbox\.merged_backup"
os.makedirs(backup_dir, exist_ok=True)
moved = 0
for name in to_delete:
    srcf = os.path.join(BASE, name + ".html")
    # 移到备份目录（比直接删除更安全，可回滚）
    dst = os.path.join(backup_dir, name + ".html")
    try:
        shutil.move(srcf, dst)
        moved += 1
    except Exception as e:
        print("移动失败:", name, e)
print("已移入备份:", moved, "->", backup_dir)

# 最终状态
remaining = set(f[:-5] for f in os.listdir(BASE) if f.endswith(".html"))
print("最终页面数(含 index):", len(remaining))
print("导航缺页面:", sorted(kept - remaining))
