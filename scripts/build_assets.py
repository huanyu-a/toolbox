# -*- coding: utf-8 -*-
"""前端构建：合并 bootstrap/tool/app 三个 CSS 为 site.min.css，并批量替换页面引用"""
import re
import os

ROOT = os.path.join(os.path.dirname(__file__), '..')
STYLE = os.path.join(ROOT, 'public', 'static', 'style')
PAGES = os.path.join(ROOT, 'application', 'index', 'view', 'index')
OUT = 'site.min.css'

def strip_css_comments(css):
    # 保守移除 /* */ 注释（不触碰字符串内容）
    return re.sub(r'/\*.*?\*/', '', css, flags=re.S)

def build():
    parts = []
    for name in ('bootstrap.min.css', 'tool.css', 'app.css'):
        with open(os.path.join(STYLE, name), encoding='utf-8') as f:
            parts.append(strip_css_comments(f.read()))
    out = '\n'.join(parts)
    with open(os.path.join(STYLE, OUT), 'w', encoding='utf-8') as f:
        f.write(out)
    print('%s 生成完成: %.1f KB' % (OUT, len(out.encode('utf-8')) / 1024))

CSS_LINK = re.compile(r'<link[^>]*href="/static/style/(bootstrap\.min\.css|tool\.css|app\.css)"[^>]*>')

def replace_pages():
    ok, err = 0, []
    for name in os.listdir(PAGES):
        if not name.endswith('.html'):
            continue
        path = os.path.join(PAGES, name)
        with open(path, encoding='utf-8') as f:
            c = f.read()
        links = CSS_LINK.findall(c)
        if not links:
            continue
        # 删除 bootstrap/tool 链接
        c = re.sub(r'<link[^>]*href="/static/style/(?:bootstrap\.min\.css|tool\.css)"[^>]*>', '', c)
        # app.css 链接改为 site.min.css（只改第一个 href，保留属性）
        c = c.replace('href="/static/style/app.css"', 'href="/static/style/%s"' % OUT)
        with open(path, 'w', encoding='utf-8') as f:
            f.write(c)
        ok += 1
    print('替换页面: %d' % ok)
    if err:
        print('错误: %s' % err)

if __name__ == '__main__':
    build()
    replace_pages()
