import os

base = r"C:\project\wwwroot\toolbox\application\index\view\index"
files = sorted(f for f in os.listdir(base) if f.endswith(".html"))
new_skin = 0
old_skin = 0
for f in files:
    src = open(os.path.join(base, f), encoding="utf-8").read()
    if 'class="tool-card"' in src:
        new_skin += 1
    else:
        old_skin += 1
print("total:", len(files))
print("new skin (tool-card):", new_skin)
print("old skin:", old_skin)
print()
print("old skin files:")
for f in files:
    src = open(os.path.join(base, f), encoding="utf-8").read()
    if 'class="tool-card"' not in src:
        print("  ", f)
