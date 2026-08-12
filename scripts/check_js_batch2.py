import os, re, subprocess, tempfile

base = r"C:\project\wwwroot\toolbox\application\index\view\index"
pages = ["guid.html","uuid.html","password.html","ip2long.html","shaencrypt.html","htmlescape.html","utf8.html","unicode.html"]

def extract_inline_scripts(src):
    """Extract <script> blocks without src attribute."""
    blocks = []
    for m in re.finditer(r'<script(?![^>]*\bsrc=)[^>]*>(.*?)</script>', src, re.S | re.I):
        blocks.append(m.group(1))
    return blocks

for p in pages:
    src = open(os.path.join(base, p), encoding='utf-8').read()
    # Replace ThinkPHP template vars with string literals
    src = re.sub(r'\{\$Think\.config\.web\.[a-z0-9]+\.[a-z]+\}', '"TPL"', src)
    blocks = extract_inline_scripts(src)
    ok = True
    for idx, b in enumerate(blocks):
        with tempfile.NamedTemporaryFile('w', suffix='.js', delete=False, encoding='utf-8') as f:
            f.write(b)
            tmp = f.name
        r = subprocess.run(['node', '--check', tmp], capture_output=True, text=True)
        if r.returncode != 0:
            ok = False
            print("%s block %d: SYNTAX ERROR" % (p, idx))
            print(r.stderr[:1500])
        os.unlink(tmp)
    print("== %s ==" % p, "OK (%d inline script(s))" % len(blocks) if ok else "FAILED")
