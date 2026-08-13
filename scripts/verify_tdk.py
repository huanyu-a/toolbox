# -*- coding: utf-8 -*-
import re, urllib.request

web = open(r"C:\project\wwwroot\toolbox\config\web.php", encoding="utf-8").read()
web_keys = set(re.findall(r"^\s*'([\w]+)' =>", web, re.M))
# 只取真正的块（排除字段行干扰：title/keywords/description 行也是这个格式）
# 用更精确方式：解析顶层块
lines = web.splitlines()
start_idx = next(i for i, l in enumerate(lines) if "return array" in l)
end_idx = next(i for i, l in enumerate(lines) if l.strip() == ");")
depth = 0
cur = None
top_keys = set()
for i in range(start_idx + 1, end_idx):
    ln = lines[i]
    if cur is None:
        m = re.match(r"^[ \t]*'([\w]+)' =>", ln)
        if m:
            cur = m.group(1)
            rest = ln[m.end():]
            if "array" not in rest and not (rest.strip() == "" and i + 1 < end_idx and "array" in lines[i + 1]):
                top_keys.add(cur)
                cur = None
            else:
                depth = ln.count("(") - ln.count(")")
    else:
        depth += ln.count("(") - ln.count(")")
        if depth <= 0 and ln.rstrip().endswith("),"):
            top_keys.add(cur)
            cur = None

tools = open(r"C:\project\wwwroot\toolbox\config\tools.php", encoding="utf-8").read()
items = [u.strip("/") for u in re.findall(r"'url' => '(/[^']+)'", tools)]
print("顶层块数:", len(top_keys))
missing = [a for a in items if a not in top_keys]
print("入口但无 TDK 块:", missing)

# 抽查几个页面 title
for u in ["/", "/json/", "/encrypt/", "/encode/", "/textconvert/", "/texttool/", "/convert/", "/jsencrypt/", "/uuid/", "/dns/", "/calc/", "/format/"]:
    try:
        with urllib.request.urlopen("http://127.0.0.1:18080" + u, timeout=8) as r:
            html = r.read().decode("utf-8", "ignore")
            m = re.search(r"<title>(.*?)</title>", html)
            print("%-12s %s  %s" % (u, r.status, (m.group(1)[:60] if m else "NO TITLE")))
    except Exception as e:
        print("%-12s ERR %s" % (u, str(e)[:50]))
