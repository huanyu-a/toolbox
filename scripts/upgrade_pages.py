# -*- coding: utf-8 -*-
"""批量升级工具页：注入 app.css / app.js，保持页面结构与 URL 不变"""
import io, os, re, glob

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'
APP_CSS_LINK = '<link href="/static/style/app.css" rel="stylesheet" type="text/css"/>'
APP_JS_TAG = '<script src="/static/script/app.js" type="text/javascript"></script>'

changed_css = []
changed_js = []
skipped = []
errors = []

files = glob.glob(os.path.join(BASE, '*.html'))
for fp in sorted(files):
    name = os.path.basename(fp)
    if name == 'index.html':
        continue  # 首页已手工重写
    try:
        with io.open(fp, encoding='utf-8') as f:
            html = f.read()
    except Exception as e:
        errors.append((name, 'read: %s' % e))
        continue

    orig = html

    # 1. 注入 app.css：优先在 tool.css 后，否则在 </head> 前
    if 'app.css' not in html:
        m = re.search(r'(<link[^>]*tool\.css[^>]*/?>)', html, re.I)
        if m:
            html = html.replace(m.group(1), m.group(1) + '\n' + APP_CSS_LINK, 1)
            changed_css.append(name)
        elif '</head>' in html:
            html = html.replace('</head>', APP_CSS_LINK + '\n</head>', 1)
            changed_css.append(name)
        else:
            errors.append((name, 'no head/css anchor'))
    else:
        skipped.append(name + ':css-already')

    # 2. 注入 app.js：在 </body> 前
    if 'app.js' not in html:
        if '</body>' in html:
            html = html.replace('</body>', APP_JS_TAG + '\n</body>', 1)
            changed_js.append(name)
        else:
            # 无 body 结尾的兜底：追加到文件末尾
            html = html.rstrip() + '\n' + APP_JS_TAG + '\n'
            changed_js.append(name + '(append)')

    if html != orig:
        try:
            with io.open(fp, 'w', encoding='utf-8', newline='') as f:
                f.write(html)
        except Exception as e:
            errors.append((name, 'write: %s' % e))

print('注入 app.css 的页面:', len(changed_css))
print('注入 app.js 的页面:', len(changed_js))
print('跳过:', skipped[:10], '...' if len(skipped) > 10 else '')
print('错误:', errors if errors else '无')
