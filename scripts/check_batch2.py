import os, re

base = r"C:\project\wwwroot\toolbox\application\index\view\index"
pages = ["guid.html","uuid.html","password.html","ip2long.html","shaencrypt.html","htmlescape.html","utf8.html","unicode.html"]

VOID = {'meta','link','br','hr','img','input','area','base','col','embed','source','track','wbr'}

def strip_cdata(src):
    """Remove <script>...</script> and <style>...</style> blocks entirely."""
    out = []
    i = 0
    while True:
        m = re.search(r'<(script|style)[\s>]', src[i:], re.I)
        if not m:
            out.append(src[i:])
            break
        out.append(src[i:i+m.start()])
        rest = src[i+m.start():]
        cm = re.search(r'</' + m.group(1) + r'\s*>', rest, re.I)
        if not cm:
            break
        i = i + m.start() + cm.end()
    return ''.join(out)

class Checker:
    def __init__(self):
        self.stack = []
        self.errors = []
    def feed(self, s):
        for m in re.finditer(r'<[^>]*>', s):
            tok = m.group(0)
            if tok.startswith('<!--') or tok.startswith('<!') or tok.startswith('<?'):
                continue
            if tok.startswith('</'):
                name = re.split(r'[\s/]', tok[2:].rstrip('>').strip())[0].lower()
                if not name or name in VOID: continue
                if not self.stack:
                    self.errors.append('extra </%s>' % name); continue
                if self.stack[-1] == name:
                    self.stack.pop()
                elif name in self.stack:
                    while self.stack and self.stack[-1] != name:
                        self.errors.append('unclosed <%s> before </%s>' % (self.stack[-1], name))
                        self.stack.pop()
                    self.stack.pop()
                else:
                    self.errors.append('stray </%s>' % name)
            else:
                inner = tok[1:].rstrip('>').strip()
                name = re.split(r'[\s/]', inner)[0].lower()
                if not name or name in VOID: continue
                if inner.endswith('/'): continue
                self.stack.append(name)

for p in pages:
    src = open(os.path.join(base, p), encoding='utf-8').read()
    c = Checker()
    c.feed(strip_cdata(src))
    print("== %s ==" % p)
    print("  errors:", c.errors if c.errors else "none")
    print("  unclosed at EOF:", c.stack if c.stack else "none")
