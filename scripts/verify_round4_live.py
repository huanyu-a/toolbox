# -*- coding: utf-8 -*-
import re

def check(name, path, pos_terms, neg_terms):
    src = open(path, encoding="utf-8").read()
    ok = True
    for t in pos_terms:
        if t not in src:
            ok = False
            print("MISS %s: %r" % (name, t))
    for t in neg_terms:
        if t in src:
            ok = False
            print("STILL PRESENT %s: %r" % (name, t))
    print(("PASS %s" % name) if ok else ("FAIL %s" % name))
    return ok

all_ok = True
# texttool: tabs 只剩 3 个，无字数统计/文本替换
src = open(r"C:\project\wwwroot\toolbox\.fetch\texttool_live.html", encoding="utf-8").read()
m = re.search(r'id="ttTabs".*?</ul>', src, re.S)
tabblock = m.group(0) if m else ''
all_ok &= check("texttool tabs", r"C:\project\wwwroot\toolbox\.fetch\texttool_live.html",
                ['data-panel="ttUnique"', 'data-panel="ttZip"', 'data-panel="ttDiff"'],
                ['ttCount', 'ttReplace', '字数统计', '文本替换', 'tcInput', 'rpInput'])
print("texttool tab block:", tabblock.replace('\n', ' ')[:300])
print()

# textconvert: 无简繁，拼音打头
all_ok &= check("textconvert tabs", r"C:\project\wwwroot\toolbox\.fetch\textconvert_live.html",
                ['data-panel="tcPy"', 'data-panel="tcName"'],
                ['tcJf', 'jfInput', '简繁转换', '简体', '繁体'])
src = open(r"C:\project\wwwroot\toolbox\.fetch\textconvert_live.html", encoding="utf-8").read()
m = re.search(r'id="tcTabs".*?</ul>', src, re.S)
print("textconvert tab block:", (m.group(0) if m else '').replace('\n', ' ')[:400])
print()

# jsencrypt: 无 tabs，单面板 + BtnCon
all_ok &= check("jsencrypt merged", r"C:\project\wwwroot\toolbox\.fetch\jsencrypt_live.html",
                ['id="jsInput"', 'id="BtnCon"', 'id="btnEncode"', 'id="btnDecode"', 'data-copy="#jsResultText"'],
                ['jsTabs', 'jsC', 'js-panel', 'id="content"', 'id="result"', 'BtnClear', 'cfError', 'JS 混合加密</button>'])
src = open(r"C:\project\wwwroot\toolbox\.fetch\jsencrypt_live.html", encoding="utf-8").read()
# 确认混合加密按钮文案
print("jsencrypt has 混合加密 button:", 'JS 混合加密' in src)
print()

# random: 新逻辑 + 无旧选择器
all_ok &= check("random logic", r"C:\project\wwwroot\toolbox\.fetch\random_live.html",
                ['hasCrypto', 'shuffleArr', '符号 !@#$%^&*()', 'rnd-panel'],
                ['#rndTabs + * ~', 'Math.random() * (max - min)', '字符不重复时长度不能超过字符集大小'])
print("ALL_OK" if all_ok else "HAS_FAILURES")
