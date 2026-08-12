#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""批量工具页重排转换器（第三批：全部剩余页）v2
策略：保留 head(SEO) + 原交互脚本，丢弃旧骨架，重构为新皮肤 tool-card。
"""
import os, re, html
from concurrent.futures import ThreadPoolExecutor

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
CFG = r"C:\project\wwwroot\toolbox\config"
DONE = {"ascii","base64","hexconvert","json","md5","random","unixtime","urlcode",
        "guid","uuid","password","ip2long","shaencrypt","htmlescape","utf8","unicode",
        "subnetmask","formatfilter","index","editor"}

TAG_RE = re.compile(r"</?\s*([a-zA-Z][a-zA-Z0-9]*)\b[^>]*>", re.S)
COMMENT_RE = re.compile(r"<!--.*?-->", re.S)
CDATA_RE = re.compile(r"<!\[CDATA\[.*?\]\]>", re.S)
RAWTEXT_END = {
    "script": re.compile(r"</script\s*>", re.I),
    "style": re.compile(r"</style\s*>", re.I),
    "textarea": re.compile(r"</textarea\s*>", re.I),
    "pre": re.compile(r"</pre\s*>", re.I),
    "code": re.compile(r"</code\s*>", re.I),
    "xmp": re.compile(r"</xmp\s*>", re.I),
}

def scan_tags(src):
    tags = []
    i, n = 0, len(src)
    while i < n:
        if src[i] != "<":
            i += 1
            continue
        m = COMMENT_RE.match(src, i)
        if m:
            i = m.end(); continue
        m = CDATA_RE.match(src, i)
        if m:
            i = m.end(); continue
        m = TAG_RE.match(src, i)
        if not m:
            i += 1; continue
        tag = m.group(1).lower()
        raw = m.group(0)
        is_close = raw.lstrip().startswith("</")
        tags.append((tag, raw, is_close, i, m.end()))
        if tag in RAWTEXT_END and not is_close:
            j = RAWTEXT_END[tag].search(src, m.end())
            if j:
                tags.append((tag, "</%s>" % tag, True, j.start(), j.end()))
                i = j.end()
                continue
        i = m.end()
    return tags

def find_matching(tags, open_idx):
    tag = tags[open_idx][0]
    depth = 0
    for idx in range(open_idx, len(tags)):
        t, raw, is_close, s, e = tags[idx]
        if t != tag:
            continue
        if not is_close:
            depth += 1
        else:
            depth -= 1
            if depth == 0:
                return idx
    return None

def load_tools():
    src = open(os.path.join(CFG, "tools.php"), encoding="utf-8").read()
    tools = {}
    for m in re.finditer(r"\['url'\s*=>\s*'/([^/]+)/'\s*,\s*'name'\s*=>\s*'([^']+)'", src):
        tools[m.group(1)] = m.group(2)
    return tools

def load_web_desc():
    src = open(os.path.join(CFG, "web.php"), encoding="utf-8").read()
    desc = {}
    for m in re.finditer(r"'([a-z0-9]+)'\s*=>\s*array\s*\(\s*'title'\s*=>\s*'([^']*)'\s*,\s*'keywords'\s*=>\s*'[^']*'\s*,\s*'description'\s*=>\s*'([^']*)'", src, re.S):
        desc[m.group(1)] = m.group(3).strip().replace("\t", " ")
    return desc

def clean_desc(d, maxlen=90):
    d = re.sub(r"\s+", " ", d).strip()
    if len(d) > maxlen:
        cut = d[:maxlen]
        idx = max(cut.rfind("，"), cut.rfind("。"), cut.rfind(","), cut.rfind("."))
        if idx > 20:
            d = cut[:idx+1]
        else:
            d = cut + "…"
    return d

def find_panel(tags, lo, hi):
    """在 tags[lo:hi] 找第一个 class 含 panel（panel 或 panel-*）的 div，返回 (开idx, 闭idx)"""
    for i in range(lo, hi):
        t, raw, is_close, s, e = tags[i]
        if t == "div" and not is_close:
            cls = re.search(r'class="([^"]*)"', raw)
            if cls:
                classes = cls.group(1).split()
                if any(c == "panel" or c.startswith("panel-") for c in classes):
                    c = find_matching(tags, i)
                    if c is not None:
                        return i, c
    return None

def find_nav_ul(tags, lo, hi):
    for i in range(lo, hi):
        t, raw, is_close, s, e = tags[i]
        if t == "ul" and not is_close and "nav-tabs" in raw:
            c = find_matching(tags, i)
            if c is not None:
                return i, c
    return None

def balance_div(inner):
    """修正片段内 div 净深度为 0：尾部多余的 </div> 删掉，缺的补上"""
    t = scan_tags(inner)
    depth = 0
    for tag, raw, is_close, s, e in t:
        if tag == "div":
            depth += -1 if is_close else 1
    if depth == 0:
        return inner
    if depth < 0:
        # 尾部多余的闭合：从末尾逐个删 </div>
        for _ in range(-depth):
            m = list(re.finditer(r'</div>', inner))
            if not m:
                break
            last = m[-1]
            inner = inner[:last.start()] + inner[last.end():]
        return inner
    # 缺闭合：补上
    return inner + "</div>" * depth

def convert_page(key, src, name, desc, emoji):
    body_m = re.search(r"<body>", src)
    if not body_m:
        return False, src, "no <body>"
    body_start = body_m.end()
    # head 包含 <body> 之后紧跟的 {include file="header" /}
    header_inc = '{include file="header" /}'
    head = src[:body_start]
    rest = src[body_start:]
    if rest.startswith(header_inc) or rest.lstrip().startswith(header_inc):
        head += rest[:rest.find(header_inc) + len(header_inc)]
        body = rest[rest.find(header_inc) + len(header_inc):]
    else:
        body = rest

    tail_anchors = ['<script src="/static/script/jquery', '{include file="nav"']
    tail_pos = len(body)
    for a in tail_anchors:
        p = body.find(a)
        if p != -1 and p < tail_pos:
            tail_pos = p
    content = body[:tail_pos]
    tail = body[tail_pos:]

    tags = scan_tags(content)
    if not tags:
        return False, src, "no tags"

    # container
    ci = None
    for i, (t, raw, is_close, s, e) in enumerate(tags):
        if t == "div" and not is_close and 'class="container"' in raw:
            ci = i
            break
    if ci is None:
        return False, src, "no container"
    c_close = find_matching(tags, ci)

    # 已有新皮肤 card（editor 特殊页）：用配平找 tool-card 闭合
    if 'class="tool-card"' in content:
        tc = None
        for i in range(ci + 1, len(tags)):
            t, raw, is_close, s, e = tags[i]
            if t == "div" and not is_close and 'class="tool-card"' in raw:
                tc = (i, find_matching(tags, i))
                break
        if tc:
            inner = content[tags[tc[0]][4]:tags[tc[1]][3]]
            # 清理残留旧描述块/空 group（在 card 之前）
            prefix_end = tags[tc[0]][3]
            new_body = '<div class="container"><div class="tool-wrap">' + inner + '</div></div>'
            return True, head + new_body + tail, ""

    # 找 nav ul
    nav = find_nav_ul(tags, ci + 1, c_close if c_close else len(tags))

    if c_close is None:
        # fallback：container 未闭合（原生 HTML 不完整），用 nav 结束 + panel 内容
        content_lo = tags[nav[1]][4] if nav else tags[ci][4]
        panel = find_panel(tags, ci + 1, len(tags))
        if panel and tags[panel[0]][3] >= content_lo:
            p_open, p_close = panel
            panel_inner = content[tags[p_open][4]:tags[p_close][3]]
            card = ('<div class="tool-card">'
                    '<h2 class="tool-title"><span class="t-ico">%s</span>%s</h2>'
                    '<p class="tool-desc">%s</p>%s</div>'
                    % (emoji, html.escape(name), html.escape(desc), panel_inner))
            new_body = '<div class="container"><div class="tool-wrap">' + card + '</div></div>'
            return True, head + new_body + tail, ""
        return False, src, "container unclosed & no panel"

    # 找 panel
    panel = find_panel(tags, ci + 1, c_close)

    # 内容起点：nav 结束后 或 container 后
    content_lo = tags[nav[1]][4] if nav else tags[ci][4]
    # 内容终点：container 闭合前
    content_hi = tags[c_close][3]

    if panel:
        p_open, p_close = panel
        if tags[p_open][3] >= content_lo:
            panel_inner = content[tags[p_open][4]:tags[p_close][3]]
            # div 平衡修正：原生 HTML 可能不合法（跨 form 闭合等），
            # 修正 panel_inner 内部 div 净深度为 0
            panel_inner = balance_div(panel_inner)
            card = ('<div class="tool-card">'
                    '<h2 class="tool-title"><span class="t-ico">%s</span>%s</h2>'
                    '<p class="tool-desc">%s</p>%s</div>'
                    % (emoji, html.escape(name), html.escape(desc), panel_inner))
            new_body = '<div class="container"><div class="tool-wrap">' + card + '</div></div>'
            return True, head + new_body + tail, ""
        else:
            # panel 在内容区之前（罕见），退回无 panel 处理
            panel = None

    # 无 panel：从内容起点到终点，配平定位内容边界
    inner = content[content_lo:content_hi]
    inner_tags = scan_tags(inner)
    if not inner_tags:
        return False, src, "empty inner tags"

    STRUCT_DIV = ("accordion-group", "row", "col-sm-12", "col-md-12", "panel-body", "panel-default", "panel-heading")

    def is_struct_div(t, raw, is_close):
        if t != "div" or is_close:
            return False
        m = re.search(r'class="([^"]*)"', raw)
        if not m:
            return False
        cls = m.group(1).split()
        return any(c in STRUCT_DIV for c in cls)

    def is_alert_div(t, raw, is_close):
        if t != "div" or is_close:
            return False
        return 'class="alert' in raw or 'alert alert' in raw

    # 找到内容真正起点：跳过开头结构 div 与 alert 块
    start = 0
    i = 0
    while i < len(inner_tags):
        t, raw, is_close, s, e = inner_tags[i]
        if is_alert_div(t, raw, is_close):
            end = find_matching(inner_tags, i)
            if end:
                i = end + 1
                continue
        if is_struct_div(t, raw, is_close):
            # 空结构 div（紧跟闭合）直接跳过
            if i + 1 < len(inner_tags) and inner_tags[i+1][0] == "div" and inner_tags[i+1][2] and is_struct_div(*inner_tags[i+1][:3]) is False and inner_tags[i+1][2]:
                i += 2
                continue
            i += 1
            continue
        start = i
        break

    # 从 start 配平：内容结束 = 深度归零处
    depth = 0
    end = len(inner_tags)
    for i in range(start, len(inner_tags)):
        t, raw, is_close, s, e = inner_tags[i]
        if t != "div":
            continue
        if not is_close:
            depth += 1
        else:
            depth -= 1
            if depth < 0:
                end = i
                break
    if depth > 0:
        # 内容自身未闭合（原生问题），取到尾部
        end = len(inner_tags)

    if start >= end or start >= len(inner_tags):
        return False, src, "empty inner"
    seg = inner[inner_tags[start][3]:inner_tags[end-1][4]]
    seg = re.sub(r'^<div class="row">\s*<div class="col-sm-12">\s*', "", seg)
    seg = seg.strip()
    if not seg:
        return False, src, "empty inner"
    card = ('<div class="tool-card">'
            '<h2 class="tool-title"><span class="t-ico">%s</span>%s</h2>'
            '<p class="tool-desc">%s</p>%s</div>'
            % (emoji, html.escape(name), html.escape(desc), seg))
    new_body = '<div class="container"><div class="tool-wrap">' + card + '</div></div>'
    return True, head + new_body + tail, ""

EMOJI = {}

def pick_emoji(key):
    return EMOJI.get(key, "🔧")

def main():
    global EMOJI
    EMOJI = {
        "md5":"🔐","base64":"🔡","urlcode":"🔗","urlencode":"🔗","urlthunder":"⚡",
        "shaencrypt":"🔒","deencrypt":"🔐","aesencrypt":"🔐","desencrypt":"🔐",
        "rc4encrypt":"🔐","rabbitencrypt":"🐇","tripledes":"🔐","allencrypt":"🔐",
        "morse":"📡","password":"🎲","uuid":"🧬","guid":"🧬","htpasswd":"🔑",
        "barcode":"📊","ip2long":"🌐","img2base64":"🖼️","utf8":"🔤","unicode":"🔣",
        "ascii":"🔠","navtiveunicode":"🔣","keyboardcode":"⌨️","androidkeycode":"🤖",
        "keyboardtest":"⌨️","editor":"✍️","autoformat":"📝","caiji":"📥","jianfan":"📖",
        "pinyin":"🔤","huoxingwen":"👽","txtreplace":"🔁","textdiff":"🔀","txtcount":"🔢",
        "shupai":"📚","textflip":"🔄","quchong":"🧹","wenzitexiao":"💫",
        "zipstringtext":"🗜️","camelcase":"🐫","quanbaojiao":"🔁","hexrgb":"🎨",
        "json":"🪄","json2cs":"🔄","json2excel":"📊","json2get":"🔄","json2go":"🔄",
        "json2java":"🔄","json2xml":"🔄","json2yaml":"🔄","jsonlrview":"🪄",
        "jsonudview":"🪄","jsonzip":"🗜️","excel2json":"📊","formathtml":"🧱",
        "formatcss":"🎨","formatjs":"⚡","endecodejs":"⚡","confundirjs":"🌀",
        "formatsql":"🗄️","formatcsql":"🗄️","formatphp":"🐘","formatxml":"📄",
        "formatcs":"🔷","formatc":"🔷","formatcpp":"🔷","formatjava":"☕",
        "formatpy":"🐍","formatruby":"💎","formatperl":"🐪","formatvbs":"🧩",
        "regex":"🔍","regexcode":"🔍","regexdso":"🔍","regexsucha":"🔍","runjs":"▶️",
        "xpath":"🧭","html2js":"🔄","htmloutjs":"🔄","htmlescape":"🧱",
        "htmlescapechar":"🧱","html2cj":"🔄","html2php":"🔄","html2all":"🔄",
        "htmlfromcsv":"📊","html2ubb":"🔄","htmltable":"🧱","calculator":"🧮",
        "nianlvli":"💹","calcarea":"📐","calcheat":"🔥","calcvolume":"🧊",
        "calcpressure":"🌡️","calcpower":"⚡","calclength":"📏","calctemperature":"🌡️",
        "calctime":"⏱️","calcspeed":"🚀","calcangle":"📐","calcdata":"💾",
        "calcthickness":"📏","calcforce":"⚙️","dns":"🧭","dnsdx":"🧭","dnsedu":"🧭",
        "dnslt":"🧭","dnstt":"🧭","dnsusa":"🧭","dnsyd":"🧭","alldns":"🧭",
        "whois":"🔎","ip":"🌐","ports":"🚪","webstatus":"📡","websocket":"🔌",
        "useragent":"🖥️","contenttype":"📋","requestmethod":"📨","httpheader":"📮",
        "pagecode":"📟","asciicode":"🔠","bootstrapicon":"🧩","browserinfo":"🖥️",
        "checkurl":"🔎","checkkeyword":"🔎","checkweixin":"💬","createmeta":"🧾",
        "chameta":"🧾","chaicp":"🇨🇳","gzip":"🗜️","htaccess2nginx":"🔄",
        "favicon":"⭐","linuxcmd":"🐧","shortcut":"⚡","tuya":"🎨","shizhong":"🕐",
        "worldtime":"🌍","capital":"🏛️","currency":"💱","areacode":"📞",
        "chaodai":"🏯","jieri":"🎉","shaoshuminzu":"👥","tesufuhao":"✨",
        "lishishangdejintian":"📅","rmbdaxie":"💰","px2rem":"📏","tiaoseban":"🎨",
        "refresh":"🔄","sql2java":"🔄","androidmanifest":"🤖","escape":"🔤",
        "enlower":"🔡","htmlescapechar":"🧱","bootstrapicon":"🧩","txtcount":"🔢",
        "wenzitexiao":"💫","shupai":"📚","textflip":"🔄","quchong":"🧹",
        "zipstringtext":"🗜️","camelcase":"🐫","quanbaojiao":"🔁","hexrgb":"🎨",
        "json2yaml":"🔄","json2xml":"🔄","json2go":"🔄","json2java":"🔄",
        "json2cs":"🔄","json2excel":"📊","json2get":"🔄","jsonlrview":"🪄",
        "jsonudview":"🪄","jsonzip":"🗜️","excel2json":"📊","chameta":"🧾",
        "chaicp":"🇨🇳","checkkeyword":"🔎","checkurl":"🔎","checkweixin":"💬",
        "createmeta":"🧾","favicon":"⭐","gzip":"🗜️","htaccess2nginx":"🔄",
        "linuxcmd":"🐧","shortcut":"⚡","tuya":"🎨","shizhong":"🕐",
        "worldtime":"🌍","capital":"🏛️","currency":"💱","areacode":"📞",
        "chaodai":"🏯","jieri":"🎉","shaoshuminzu":"👥","tesufuhao":"✨",
        "lishishangdejintian":"📅","rmbdaxie":"💰","px2rem":"📏","tiaoseban":"🎨",
        "refresh":"🔄","sql2java":"🔄","androidmanifest":"🤖","escape":"🔤",
        "enlower":"🔡",
    }
    tools = load_tools()
    webdesc = load_web_desc()
    todo = sorted(f for f in os.listdir(BASE) if f.endswith(".html") and f[:-5] not in DONE)
    print("TODO:", len(todo))

    results = {}
    def work(f):
        key = f[:-5]
        src = open(os.path.join(BASE, f), encoding="utf-8").read()
        name = tools.get(key, key)
        desc = clean_desc(webdesc.get(key, "")) or ("在线%s工具，支持常见格式，一键转换，全程本地处理。" % name)
        emoji = pick_emoji(key)
        try:
            ok, out, note = convert_page(key, src, name, desc, emoji)
            return f, ok, out, note
        except Exception as ex:
            return f, False, src, "EXC:%s" % ex

    with ThreadPoolExecutor(max_workers=8) as ex:
        for f, ok, out, note in ex.map(work, todo):
            results[f] = (ok, out, note)

    fails = {f: v for f, v in results.items() if not v[0]}
    okc = [f for f, v in results.items() if v[0]]
    print("OK:", len(okc), "FAIL:", len(fails))
    for f, (ok, out, note) in sorted(fails.items()):
        print("  FAIL", f, note)

    for f in okc:
        _, out, _ = results[f]
        open(os.path.join(BASE, f), "w", encoding="utf-8", newline="").write(out)
    print("written:", len(okc))

if __name__ == "__main__":
    main()
