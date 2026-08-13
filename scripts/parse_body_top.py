# -*- coding: utf-8 -*-
"""解析渲染后页面，找 body 直接子元素及 div[7] 内容"""
import urllib.request
from html.parser import HTMLParser

body_html = urllib.request.urlopen("http://127.0.0.1:18080/json/", timeout=15).read().decode("utf-8", "ignore")
i = body_html.find("<body>")
body_html = body_html[i + 6:]

class TopLevelParser(HTMLParser):
    def __init__(self):
        super().__init__()
        self.depth = 0
        self.top = []          # (tag, attrs_dict, content_start)
        self.stack = []
        self.cur_top = None    # index into top
        self.parts = []        # 各顶层元素的内容片段
    def handle_starttag(self, tag, attrs):
        d = dict(attrs)
        if self.depth == 0:
            self.top.append([tag, d])
            self.cur_top = len(self.top) - 1
            self.parts.append("")
        self.depth += 1
    def handle_startendtag(self, tag, attrs):
        pass
    def handle_endtag(self, tag):
        self.depth -= 1
        if self.depth == 0:
            self.cur_top = None
    def handle_data(self, data):
        if self.cur_top is not None and self.cur_top < len(self.parts):
            self.parts[self.cur_top] += data

p = TopLevelParser()
p.feed(body_html)

print("body 直接子元素数:", len(p.top))
for idx, (tag, attrs) in enumerate(p.top, 1):
    cls = attrs.get("class", "")
    sid = attrs.get("id", "")
    content = p.parts[idx-1].strip()[:60].replace("\n", " ")
    print(f"  [{idx}] <{tag} class='{cls}' id='{sid}'>  text: {content!r}")
