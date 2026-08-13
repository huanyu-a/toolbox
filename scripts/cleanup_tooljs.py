# -*- coding: utf-8 -*-
"""批量清理旧交互依赖：
1. 移除 tool.js 引用（29 页直接安全 + 10 页 data-clipboard-target 迁移 + 4 页 setJS 静态化）
2. 移除 hightout.js（保留 whois）
3. checkweixin 简化 pcjson_com_msg
"""
import re, os

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"

SAFE29 = ["androidmanifest","areacode","bootstrapicon","browserinfo","caiji","calculator","chaicp","chaodai","checkkeyword","checkurl","contenttype","currency","editor","favicon","gzip","jieri","linuxcmd","lishishangdejintian","nianlvli","ports","refresh","shaoshuminzu","shortcut","subnetmask","tesufuhao","tuya","useragent","websocket","whois"]

CLIP10 = ["confundirjs","htaccess2nginx","huoxingwen","img2base64","jianfan","morse","pinyin","runjs","wenzitexiao","xpath"]

SETJS4 = {
    "barcode": ['<script src="/static/script/pcjs/barcode.js"></script>'],
    "htpasswd": ['<script src="/static/script/pcjs/htpasswd/htpsha1.js"></script>',
                 '<script src="/static/script/pcjs/htpasswd/htpasswd.js"></script>',
                 '<script src="/static/script/pcjs/htpasswd/jsnote.js"></script>',
                 '<script src="/static/script/pcjs/htpasswd/htpmd5.js"></script>'],
    "shupai": ['<script src="/static/script/pcjs/shuformat.js"></script>'],
    "textdiff": ['<script src="/static/script/pcjs/txtdiffview.js"></script>',
                 '<script src="/static/script/pcjs/txtdifflib.js"></script>',
                 '<script src="/static/script/pcjs/textdiff.js"></script>'],
}

HIGTOUT_REMOVE = ["browserinfo","confundirjs","htaccess2nginx","huoxingwen","jianfan","morse","refresh","shortcut","wenzitexiao","xpath"]

def remove_script(src, script_path):
    """移除指定 src 的 script 标签"""
    pat = re.compile(r'<script[^>]*src="' + re.escape(script_path) + r'"[^>]*>\s*</script>\s*')
    new = pat.sub("", src)
    return new

def remove_inline_setjs(src):
    """移除内联 setJS(...) 调用"""
    return re.sub(r"\s*setJS\(\[[^\]]*\]\);\s*", "\n", src)

report = []

# 1. 移除 tool.js + hightout.js + 迁移 clipboard
for p in SAFE29 + CLIP10 + list(SETJS4.keys()):
    path = os.path.join(BASE, p + ".html")
    src = open(path, encoding="utf-8").read()
    orig = src
    # 迁移 data-clipboard-target -> data-copy
    if "data-clipboard-target" in src:
        src = src.replace("data-clipboard-target=", "data-copy=")
    # 移除 tool.js
    src = remove_script(src, "/static/script/tool.js")
    # 移除 hightout.js
    if p in HIGTOUT_REMOVE:
        src = remove_script(src, "/static/script/hightout.js")
    # setJS 静态化
    if p in SETJS4:
        src = remove_inline_setjs(src)
        tags = "".join(SETJS4[p])
        # 在 </body> 前插入静态脚本
        src = src.replace("</body>", tags + "\n</body>")
    if src != orig:
        open(path, "w", encoding="utf-8").write(src)
        report.append(f"  ✓ {p}: {'clipboard迁移 ' if 'data-clipboard-target' in orig else ''}{'去tool.js ' if 'tool.js' in orig else ''}{'去hightout.js ' if p in HIGTOUT_REMOVE else ''}{'setJS静态化 ' if p in SETJS4 else ''}")
    else:
        report.append(f"  ? {p}: 无变化")

# 2. checkweixin 简化 pcjson_com_msg
path = os.path.join(BASE, "checkweixin.html")
src = open(path, encoding="utf-8").read()
if "pcjson_com_msg" in src:
    src = src.replace(
        "pcjson_com_msg($(\"#txt_url\"), datas.msg)",
        "$(\"#check_result\").html(\"<font color='orange'>\" + datas.msg + \"</font>\")"
    )
    src = remove_script(src, "/static/script/tool.js")
    open(path, "w", encoding="utf-8").write(src)
    report.append("  ✓ checkweixin: pcjson_com_msg 简化为结果区提示 + 去 tool.js")

print("清理报告:")
print("\n".join(report))

# 3. 复核
print("\n=== 复核 ===")
remain_tooljs = []
remain_hightout = []
for p in sorted(f[:-5] for f in os.listdir(BASE) if f.endswith(".html")):
    s = open(os.path.join(BASE, p + ".html"), encoding="utf-8").read()
    if 'src="/static/script/tool.js"' in s:
        remain_tooljs.append(p)
    if "hightout.js" in s:
        remain_hightout.append(p)
print("仍引用 tool.js:", remain_tooljs)
print("仍引用 hightout.js:", remain_hightout)
