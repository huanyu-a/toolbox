# -*- coding: utf-8 -*-
"""扫描 json 系列 / format 系列的脚本引用与调用函数"""
import os, re

BASE = os.path.join(os.path.dirname(__file__), "..", "application", "index", "view", "index")

def analyze(fname):
    src = open(os.path.join(BASE, fname + ".html"), encoding="utf-8").read()
    scripts = sorted(set(re.findall(r'src="/static/script/([\w.\-/]+\.js)"', src)))
    calls = re.findall(r'on(?:click|keyup|change)="([^"]+)"', src)
    inline = re.findall(r'<script[^>]*>(.*?)</script>', src, re.S)
    inline_short = []
    for code in inline:
        code = code.strip()
        if len(code) > 300:
            code = code[:150] + " ... [%d chars total]" % len(code)
        inline_short.append(code.replace("\n", " ")[:200])
    return scripts, calls, inline_short

print("=" * 80)
print("JSON 系列")
for f in ["json", "jsonlrview", "jsonudview", "jsonzip", "json2get", "json2xml", "json2yaml", "excel2json", "json2excel", "json2cs", "json2java", "json2go", "sql2java"]:
    scripts, calls, inline = analyze(f)
    print("\n--- %s ---" % f)
    print("  scripts:", [s for s in scripts if s not in ('jquery-1.11.3.min.js','bootstrap.min.js','app.js','tool.js','hightout.js')])
    print("  calls:", calls[:6])
    for c in inline[:2]:
        print("  inline:", c[:160])

print("=" * 80)
print("FORMAT 系列（内联逻辑）")
for f in ["formatcs", "formatcsql", "formatjava", "formatperl", "formatpy", "formatruby", "formatvbs"]:
    scripts, calls, inline = analyze(f)
    print("\n--- %s ---" % f)
    print("  scripts:", [s for s in scripts if s not in ('jquery-1.11.3.min.js','bootstrap.min.js','app.js','tool.js','hightout.js')])
    print("  calls:", calls[:4])
    for c in inline[:1]:
        print("  inline:", c[:200])
