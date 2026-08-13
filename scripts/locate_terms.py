# -*- coding: utf-8 -*-
import re

def show_context(path, terms, ctx=60):
    src = open(path, encoding="utf-8").read()
    for t in terms:
        for m in re.finditer(re.escape(t), src):
            s = max(0, m.start() - ctx)
            e = min(len(src), m.end() + ctx)
            print("  ...%s..." % src[s:e].replace('\n', '\\n'))
        print("---")

print("== texttool: 字数统计 / 文本替换 出现位置 ==")
show_context(r"C:\project\wwwroot\toolbox\.fetch\texttool_live.html", ["字数统计", "文本替换"])

print("== textconvert: 简繁 / 简体 / 繁体 出现位置 ==")
show_context(r"C:\project\wwwroot\toolbox\.fetch\textconvert_live.html", ["简繁", "简体", "繁体"])

print("== random: 字符不重复时长度 出现位置 ==")
show_context(r"C:\project\wwwroot\toolbox\.fetch\random_live.html", ["字符不重复时长度"])
