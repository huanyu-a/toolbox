# -*- coding: utf-8 -*-
"""修复 html2js.html 中 JS 字符串里的 <?php / <% / %> 字面量（PHP 标签解析冲突）"""
path = r"C:\project\wwwroot\toolbox\application\index\view\index\html2js.html"
src = open(path, encoding="utf-8").read()

# 拆分所有 PHP/JSP 标签字面量，避免编译缓存被 PHP 误解析
replacements = [
    # toJsp / toAsp / toVbnet
    ("return '<%\\n%>';", "return '<' + '%\\n%' + '>';"),
    ("'<%\\n' + out + '\\n%>'", "'<' + '%\\n' + out + '\\n%' + '>'"),
    # toPhp
    ("return '<?php\\n?>';", "return '<' + '?php\\n?' + '>';"),
    ("'<?php\\n' + out + '\\n?>'", "'<' + '?php\\n' + out + '\\n?' + '>'"),
]
for old, new in replacements:
    n = src.count(old)
    if n:
        src = src.replace(old, new)
        print(f"替换 {n} 处: {old[:40]}...")
    else:
        print(f"未命中: {old[:40]}...")

open(path, "w", encoding="utf-8").write(src)
print("\n剩余 <?php 字面量:", src.count("<?php"))
print("剩余 <% 字面量:", src.count("<%"))
print("剩余 %> 字面量:", src.count("%>"))
