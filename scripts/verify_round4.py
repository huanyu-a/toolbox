# -*- coding: utf-8 -*-
"""提取 4 个修改页面的内联 <script> 块，写入临时 js 文件供 node --check 校验"""
import re, os, subprocess, sys

base = r"C:\project\wwwroot\toolbox\application\index\view\index"
pages = ["texttool.html", "textconvert.html", "jsencrypt.html", "random.html"]
tmpdir = r"C:\project\wwwroot\toolbox\scripts\tmp_js"
os.makedirs(tmpdir, exist_ok=True)

all_ok = True
for page in pages:
    src = open(os.path.join(base, page), encoding="utf-8").read()
    blocks = re.findall(r"<script(?![^>]*src=)[^>]*>(.*?)</script>", src, re.S)
    for i, b in enumerate(blocks):
        fn = os.path.join(tmpdir, page.replace(".html", "") + "_%d.js" % i)
        with open(fn, "w", encoding="utf-8") as f:
            f.write(b)
        r = subprocess.run(["node", "--check", fn], capture_output=True, text=True)
        if r.returncode != 0:
            all_ok = False
            print("FAIL %s block %d" % (page, i))
            print(r.stderr[:1500])
        else:
            print("OK %s block %d (%d bytes)" % (page, i, len(b)))
    # 残留引用检查
    for bad in ["ttCount", "ttReplace", "tcInput", "tcZh", "rpInput", "rpFrom",
                "tcJf", "jfInput", "jfSimple", "jfTrad", "jsC", "jsTabs",
                "BtnClear", "cfError", "id=\"content\"", "id=\"result\"",
                "#rndTabs + * ~"]:
        if bad in src:
            all_ok = False
            print("LEFTOVER %s: contains %r" % (page, bad))
    print("--- %s done ---" % page)

print("ALL_OK" if all_ok else "HAS_FAILURES")
sys.exit(0 if all_ok else 1)
