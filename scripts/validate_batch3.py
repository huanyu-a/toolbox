import os, re, sys
from html.parser import HTMLParser

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
DONE = {"ascii","base64","hexconvert","json","md5","random","unixtime","urlcode",
        "guid","uuid","password","ip2long","shaencrypt","htmlescape","utf8","unicode",
        "subnetmask","formatfilter","index"}
VOID = {'meta','link','br','hr','img','input','area','base','col','embed','source','track','wbr'}
RAWTEXT = {'script','style','textarea','pre','code','xmp','title'}

class Checker(HTMLParser):
    def __init__(self):
        super().__init__(convert_charrefs=False)
        self.stack = []
        self.errors = []
        self.raw_depth = 0
    def handle_starttag(self, tag, attrs):
        if tag in RAWTEXT:
            self.raw_depth += 1
        if tag not in VOID and self.raw_depth == 0:
            self.stack.append((tag, self.getpos()))
    def handle_endtag(self, tag):
        if tag in RAWTEXT:
            self.raw_depth -= 1
            return
        if tag in VOID or self.raw_depth > 0:
            return
        if not self.stack:
            self.errors.append("extra </%s> at %s" % (tag, self.getpos())); return
        if self.stack[-1][0] == tag:
            self.stack.pop()
        else:
            names = [t for t,_ in self.stack]
            if tag in names:
                while self.stack and self.stack[-1][0] != tag:
                    self.errors.append("unclosed <%s> opened at %s, closed by </%s>" % (self.stack[-1][0], self.stack[-1][1], tag))
                    self.stack.pop()
                self.stack.pop()
            else:
                self.errors.append("stray </%s> at %s" % (tag, self.getpos()))
    def handle_startendtag(self, tag, attrs):
        pass

files = sorted(f for f in os.listdir(BASE) if f.endswith(".html") and f[:-5] not in DONE)
html_bad = []
for f in files:
    src = open(os.path.join(BASE, f), encoding="utf-8").read()
    c = Checker()
    c.feed(src)
    leftover = [t for t,_ in c.stack]
    if c.errors or leftover:
        html_bad.append((f, c.errors[:6], leftover[:6]))

print("HTML check: %d bad / %d" % (len(html_bad), len(files)))
for f, e, l in html_bad:
    print("  ", f, "| errors:", e, "| unclosed:", l)
