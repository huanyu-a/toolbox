# -*- coding: utf-8 -*-
"""解析普通工具页渲染后 body 直接子元素，找 div[7]"""
import urllib.request
from html.parser import HTMLParser
import sys

url = sys.argv[1] if len(sys.argv) > 1 else "http://127.0.0.1:18080/urlcode/"
body_html = urllib.request.urlopen(url, timeout=15).read().decode("utf-8", "ignore")
i = body_html.find("<body>")
body_html = body_html[i + 6:]

class TopLevelParser(HTMLParser):
    def __init__(self):
        super().__init__()
        self.depth = 0
        self.top = []
        self.cur_top = None
        self.parts = []
    def handle_starttag(self, tag, attrs):
        d = dict(attrs)
        if self.depth == 0:
            self.top.append([tag, d])
            self.cur_top = len(self.top) - 1
            self.parts.append("")
        self.depth += 1
    def handle_endtag(self, tag):
        self.depth -= 1
        if self.depth == 0:
            self.cur_top = None
    def handle_data(self, data):
        if self.cur_top is not None and self.cur_top < len(self.parts):
            self.parts[self.cur_top] += data

p = TopLevelParser()
p.feed(body_html)

print(f"页面: {url}")
print("body 直接子元素数:", len(p.top))
for idx, (tag, attrs) in enumerate(p.top, 1):
    cls = attrs.get("class", "")
    sid = attrs.get("id", "")
    content = p.parts[idx-1].strip()[:80].replace("\n", " ")
    print(f"  [{idx}] <{tag} class='{cls}' id='{sid}'>  text: {content!r}")
