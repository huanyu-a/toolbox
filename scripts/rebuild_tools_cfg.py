# -*- coding: utf-8 -*-
"""重建 tools.php 导航：删除被合并项，按新分类重排"""
import re, json

SRC = r"C:\project\wwwroot\toolbox\config\tools.php"
src = open(SRC, encoding="utf-8").read()

# 解析现有导航
cats = re.findall(r"'cat' => '([^']+)'", src)
items = re.findall(r"'url' => '/([^/]+)/', 'name' => '([^']+)', 'accent' => '([^']*)'", src)
print("原导航:", len(items), "项,", len(cats), "类")

# 被合并删除的项
MERGED = {
    "jsonlrview","jsonudview","jsonzip","json2cs","json2java","json2go","sql2java",
    "json2xml","excel2json","json2excel","json2get","json2yaml",
    "guid","enlower",
    "htmloutjs","html2cj","html2php","html2all","html2ubb","htmltable","htmlfromcsv",
    "aesencrypt","desencrypt","tripledes","rc4encrypt","rabbitencrypt",
    "md5","shaencrypt","navtiveunicode","asciicode","htmlescapechar",
    "webstatus","ip2long","requestmethod","tiaoseban",
    "calcarea","calclength","calcvolume","calctemperature","calctime","calcspeed",
    "calcpressure","calcpower","calcangle","calcdata","calcforce","calcheat","calcthickness",
    "dnsdx","dnslt","dnsyd","dnstt","dnsedu","dnsusa","alldns",
    "formatc","formatcpp","formatcs","formatcsql","formatcss","formathtml","formatjava",
    "formatjs","formatperl","formatphp","formatpy","formatruby","formatsql","formatvbs",
    "formatxml","formatfilter",
    "regexcode","regexdso","regexsucha","keyboardtest","androidkeycode",
    "password","worldtime","shizhong","chameta",
    "urlencode",
}

# 名称修正
RENAME = {"capital": "英文大小写转换"}

# 新分类顺序与成员（url -> name）
NEW_CATS = [
    ("JSON工具", [
        ("json", "JSON 工具箱"),
    ]),
    ("格式化转换", [
        ("format", "代码格式化"),
        ("html2js", "HTML 转 JS"),
        ("htmlescape", "HTML 转义"),
        ("regex", "正则表达式"),
        ("endecodejs", "JS 加密/解密"),
        ("confundirjs", "JS 混合加密"),
        ("runjs", "在线运行 JS/HTML"),
        ("xpath", "XPath 工具"),
    ]),
    ("加解密编码", [
        ("deencrypt", "对称加密/解密"),
        ("allencrypt", "散列/哈希加密"),
        ("base64", "Base64 编码"),
        ("escape", "Escape 编码"),
        ("urlcode", "URL 编码"),
        ("urlthunder", "迅雷/旋风链接"),
        ("morse", "摩尔斯电码"),
        ("utf8", "UTF-8 转换"),
        ("unicode", "Unicode 转换"),
        ("ascii", "ASCII 转换"),
        ("htpasswd", "htpasswd 生成"),
        ("barcode", "条形码生成"),
        ("uuid", "UUID/GUID 生成"),
    ]),
    ("文本处理", [
        ("editor", "在线编辑器"),
        ("autoformat", "文章排版"),
        ("caiji", "文章采集"),
        ("jianfan", "简繁转换"),
        ("pinyin", "汉字转拼音"),
        ("huoxingwen", "火星文转换"),
        ("txtreplace", "文本替换"),
        ("textdiff", "文本对比"),
        ("txtcount", "字数统计"),
        ("shupai", "文字竖排"),
        ("textflip", "文字翻转"),
        ("quchong", "内容去重"),
        ("wenzitexiao", "文字特效"),
        ("zipstringtext", "字符串压缩"),
        ("camelcase", "驼峰/下划线"),
        ("quanbaojiao", "全角半角"),
        ("capital", "英文大小写"),
        ("rmbdaxie", "人民币大写"),
        ("keyboardcode", "按键码/键盘测试"),
    ]),
    ("数字计算", [
        ("calculator", "科学计算器"),
        ("calc", "单位换算"),
        ("nianlvli", "利率计算器"),
        ("subnetmask", "子网掩码计算"),
        ("random", "随机数/密码"),
        ("unixtime", "时间戳转换"),
        ("hexconvert", "进制转换"),
        ("hexrgb", "颜色转换"),
    ]),
    ("网络工具", [
        ("ip", "IP 查询"),
        ("dns", "DNS 大全"),
        ("websocket", "WebSocket 测试"),
        ("browserinfo", "浏览器信息"),
        ("checkweixin", "微信域名检测"),
    ]),
    ("站长工具", [
        ("createmeta", "Meta 标签"),
        ("pagecode", "HTTP 状态码"),
        ("htaccess2nginx", "htaccess 转 nginx"),
        ("shortcut", "桌面快捷方式"),
        ("px2rem", "rem/px 转换"),
        ("favicon", "ico 图标制作"),
        ("refresh", "定时刷新"),
        ("gzip", "Gzip 检测"),
        ("checkurl", "死链检测"),
        ("whois", "Whois 查询"),
        ("chaicp", "ICP 备案查询"),
        ("checkkeyword", "关键词密度"),
    ]),
    ("其他工具", [
        ("tuya", "在线涂鸦"),
        ("img2base64", "图片转 Base64"),
        ("currency", "世界货币查询"),
        ("areacode", "区号时差查询"),
        ("jieri", "世界节日查询"),
        ("chaodai", "历史朝代查询"),
        ("shaoshuminzu", "少数民族分布"),
        ("tesufuhao", "特殊符号大全"),
        ("lishishangdejintian", "历史上的今天"),
    ]),
    ("对照列表", [
        ("useragent", "User-Agent 大全"),
        ("contenttype", "Content-Type 对照表"),
        ("httpheader", "HTTP 请求头"),
        ("ports", "常见端口大全"),
        ("bootstrapicon", "Bootstrap 图标"),
        ("androidmanifest", "Android 权限大全"),
        ("linuxcmd", "Linux 命令大全"),
    ]),
]

# 保留项集合
keep = set()
for cat, lst in NEW_CATS:
    for u, n in lst:
        keep.add(u)

# 校验：是否有保留项漏了（应该 81 + calc + format = 83）
all_items = [u for u, n, a in items]
missing = [u for u in keep if u not in all_items and u not in ("calc", "format")]
print("保留项中新页面(不在旧导航):", [u for u in keep if u not in all_items])
print("保留项缺失(不在 keep):", [u for u in all_items if u not in MERGED and u not in keep])

# 生成 PHP
lines = ["<?php", "// 工具注册表（由 nav.html 提取生成，勿手改结构）",
         "// 结构: [ ['cat'=>分类名, 'items'=>[['url'=>..., 'name'=>..., 'accent'=>...], ...]], ... ]",
         "return ["]
for cat, lst in NEW_CATS:
    lines.append("    [")
    lines.append("        'cat' => '%s'," % cat)
    lines.append("        'items' => [")
    for u, n in lst:
        lines.append("            ['url' => '/%s/', 'name' => '%s', 'accent' => '']," % (u, n))
    lines.append("        ],")
    lines.append("    ],")
lines.append("];")
out = "\n".join(lines) + "\n"
open(SRC, "w", encoding="utf-8").write(out)
print("已写入新导航, 共", sum(len(lst) for _, lst in NEW_CATS), "项,", len(NEW_CATS), "类")
