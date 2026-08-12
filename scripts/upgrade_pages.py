# -*- coding: utf-8 -*-
"""批量升级工具页：注入 site.min.css / app.js / seo include，保持页面结构与 URL 不变

用途：新增工具页面后运行本脚本，自动补齐公共资源引用。
要求页面 head 含 </head>，主体含 </body>。
"""
import io, os, re, glob

BASE = os.path.join(os.path.dirname(__file__), '..', 'application', 'index', 'view', 'index')
CSS_LINK = '<link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/>'
JS_TAG = '<script src="/static/script/app.js" type="text/javascript"></script>'
SEO_INCLUDE = '{include file="seo" /}'

changed_css = []
changed_js = []
changed_seo = []
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

    # 1. 注入 site.min.css（若无任何样式引用则插到 </head> 前）
    if 'site.min.css' not in html:
        if '</head>' in html:
            html = html.replace('</head>', CSS_LINK + '\n</head>', 1)
            changed_css.append(name)
        else:
            errors.append((name, 'no head anchor'))
    else:
        skipped.append(name + ':css-already')

    # 2. 注入 app.js（在 </body> 前）
    if 'app.js' not in html:
        if '</body>' in html:
            html = html.replace('</body>', JS_TAG + '\n</body>', 1)
            changed_js.append(name)
        else:
            html = html.rstrip() + '\n' + JS_TAG + '\n'
            changed_js.append(name + '(append)')

    # 3. 注入 seo include（在 </head> 前）
    if SEO_INCLUDE not in html:
        if '</head>' in html:
            html = html.replace('</head>', SEO_INCLUDE + '</head>', 1)
            changed_seo.append(name)

    if html != orig:
        try:
            with io.open(fp, 'w', encoding='utf-8', newline='') as f:
                f.write(html)
        except Exception as e:
            errors.append((name, 'write: %s' % e))

print('注入 site.min.css 的页面:', len(changed_css))
print('注入 app.js 的页面:', len(changed_js))
print('注入 seo include 的页面:', len(changed_seo))
print('跳过:', skipped[:10], '...' if len(skipped) > 10 else '')
print('错误:', errors if errors else '无')
