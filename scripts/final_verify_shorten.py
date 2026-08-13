# -*- coding: utf-8 -*-
"""最终验证：3 个重构页 + app.js"""
import re, subprocess, os, tempfile

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

print("=" * 60)
print("最终验证：重构页结构完整性")
print("=" * 60)

checks = {
    "json": {
        "modes": ["fmt","esc","get","xml","yaml","csv","cs","java","go"],
        "ids": ["json-in","json-out","runBtn","clearBtn","json-error"],
        "fns": ["sortKeys","jsonToXml","xmlToJson","parseCsv","toCsv","JSON2CSharp","getBeanFieldFromJson","jsonToGo"],
    },
    "html2js": {
        "modes": ["js","cj","php","asp","ubb","table","csv"],
        "ids": ["h2j-in","h2j-out","h2j-result","h2j-error","h2jClear"],
        "fns": ["jsString","jsArray","jsToHtml","toJsp","toCSharp","toPhp","toAsp","toVbnet","toPerl","toSws","pattern","up"],
    },
    "unicode": {
        "modes": ["ucPanel1","ucPanel2"],
        "ids": ["ucInput","ucOutput","ucError","nuError"],
        "fns": ["bind"],
    },
}

all_ok = True
for page, spec in checks.items():
    src = open(os.path.join(BASE, page + ".html"), encoding="utf-8").read()
    problems = []
    for m in spec["modes"]:
        if m not in src:
            problems.append(f"缺模式 {m}")
    for i in spec["ids"]:
        if f'id="{i}"' not in src:
            problems.append(f"缺 id {i}")
    for f in spec["fns"]:
        if f not in src:
            problems.append(f"缺函数 {f}")
    # JS 语法
    scripts = re.findall(r"<script(?![^>]*src)[^>]*>(.*?)</script>", src, re.S)
    for i, code in enumerate(scripts):
        if not code.strip():
            continue
        tmp = os.path.join(tempfile.gettempdir(), f"fv_{page}_{i}.js")
        open(tmp, "w", encoding="utf-8").write(code)
        r = subprocess.run(["node", "--check", tmp], capture_output=True, text=True)
        if r.returncode != 0:
            problems.append(f"JS script#{i} 语法错误: {r.stderr.strip()[:150]}")
        os.remove(tmp)
    status = "✅ OK" if not problems else "❌ " + "; ".join(problems)
    if problems:
        all_ok = False
    print(f"  {page}: {status}")

# 尺寸对比
print("\n=== 尺寸变化（字符数）===")
for page in ["json", "html2js", "unicode"]:
    src = open(os.path.join(BASE, page + ".html"), encoding="utf-8").read()
    ta = len(re.findall(r"<textarea", src))
    print(f"  {page}: {len(src)} chars, textarea={ta}")

print("\n=== 结论 ===")
print("全部通过 ✅" if all_ok else "存在问题 ⚠️")
