# -*- coding: utf-8 -*-
"""为 7 个 agent 工具页内联样式追加深色模式覆盖块"""
import io
import sys

DARK_BLOCK = (
    '[data-theme="dark"] .lt td:first-child{color:#7fd4ae}\n'
    '[data-theme="dark"] .lt td:first-child:hover{background:rgba(127,212,174,.14)!important}\n'
    '[data-theme="dark"] .lt td:first-child.copied{background:rgba(127,212,174,.22)!important}\n'
    '[data-theme="dark"] .lt-copied{color:#a3e7c7;background:rgba(127,212,174,.22)}\n'
    '[data-theme="dark"] .lt tr:nth-child(even) td{background:var(--surface-2,#262f42)}\n'
    '[data-theme="dark"] .hm-note{background:rgba(224,176,96,.12);border-color:rgba(224,176,96,.32);color:#e2b76b}\n'
    '[data-theme="dark"] .hm-tip{background:rgba(124,147,255,.13);border-color:rgba(124,147,255,.32);color:#9db4ff}\n'
    '[data-theme="dark"] .hm-card{background:var(--surface,#1b2230)}\n'
)

files = ['claudecodecmd', 'codexcmd', 'deepseekharnesscmd', 'openclawcmd', 'opencmd', 'picmd', 'hermescmd']

for n in files:
    f = 'application/index/view/index/%s.html' % n
    with io.open(f, encoding='utf-8') as fh:
        c = fh.read()
    if '[data-theme="dark"] .lt td:first-child' in c:
        print(f, 'SKIP (already patched)')
        continue
    assert '</style>' in c, f
    c2 = c.replace('</style>', DARK_BLOCK + '</style>', 1)
    with io.open(f, 'w', encoding='utf-8', newline='') as fh:
        fh.write(c2)
    print(f, 'PATCHED')