import os, re, subprocess, tempfile

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
DONE = {"ascii","base64","hexconvert","json","md5","random","unixtime","urlcode",
        "guid","uuid","password","ip2long","shaencrypt","htmlescape","utf8","unicode",
        "subnetmask","formatfilter","index","editor"}

def extract_inline_scripts(src):
    blocks = []
    for m in re.finditer(r'<script(?![^>]*\bsrc=)[^>]*>(.*?)</script>', src, re.S | re.I):
        blocks.append(m.group(1))
    return blocks

files = sorted(f for f in os.listdir(BASE) if f.endswith(".html") and f[:-5] not in DONE)
bad = 0
for f in files:
    src = open(os.path.join(BASE, f), encoding="utf-8").read()
    src = re.sub(r'\{\$Think\.config\.web\.[a-z0-9]+\.[a-z]+\}', '"TPL"', src)
    src = re.sub(r'\{include file="[^"]*" /\}', '""', src)
    src = re.sub(r'\{:date\([^)]*\)\}', '"TPL"', src)
    src = re.sub(r'\{foreach[^}]*\}', '', src)
    src = re.sub(r'\{/foreach\}', '', src)
    src = re.sub(r'\{if[^}]*\}', '', src)
    src = re.sub(r'\{/if\}', '', src)
    src = re.sub(r'\{\$[a-zA-Z_][a-zA-Z0-9_.]*\}', '"TPL"', src)
    blocks = extract_inline_scripts(src)
    for idx, b in enumerate(blocks):
        with tempfile.NamedTemporaryFile("w", suffix=".js", delete=False, encoding="utf-8") as fh:
            fh.write(b)
            tmp = fh.name
        r = subprocess.run(["node", "--check", tmp], capture_output=True, text=True)
        if r.returncode != 0:
            bad += 1
            print("JS ERROR:", f, "block", idx)
            print(r.stderr[:400])
        os.unlink(tmp)
print("JS check done. errors:", bad, "/ pages:", len(files))
