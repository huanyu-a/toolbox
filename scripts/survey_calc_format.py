# -*- coding: utf-8 -*-
"""调查 format* / calc* / dns* 页面结构差异"""
import os, re, json

base = os.path.join(os.path.dirname(__file__), "..", "application", "index", "view", "index")

def find_scripts(src):
    return sorted(set(re.findall(r'src="/static/script/([\w.\-/]+\.js)"', src)))

def find_calls(src):
    return re.findall(r'on(?:click|keyup|change)="([^"]+)"', src)

print("=" * 90)
print("FORMAT 系列")
for f in sorted(os.listdir(base)):
    if f.startswith('format') and f.endswith('.html'):
        src = open(os.path.join(base, f), encoding='utf-8').read()
        calls = find_calls(src)
        scripts = [s for s in find_scripts(src) if s not in ('jquery-1.11.3.min.js', 'bootstrap.min.js', 'app.js', 'tool.js', 'hightout.js')]
        m = re.search(r'<h2[^>]*>(.*?)</h2>', src, re.S)
        h2 = re.sub(r'<[^>]+>', '', m.group(1))[:16] if m else ''
        print('%-16s %-16s calls=%s scripts=%s' % (f[:-5], h2, calls, scripts))

print("=" * 90)
print("CALC 系列")
calc_data = {}
for f in sorted(os.listdir(base)):
    if f.startswith('calc') and f.endswith('.html'):
        src = open(os.path.join(base, f), encoding='utf-8').read()
        m = re.search(r'<h2[^>]*>(.*?)</h2>', src, re.S)
        h2 = re.sub(r'<[^>]+>', '', m.group(1))[:16] if m else ''
        # 单位名（label span）
        units = re.findall(r'<span>([^<]+)</span><span class="mathunit">([^<]*)</span>', src)
        bs = re.search(r'var bs=\[([^\]]+)\]', src)
        print('%-16s %-16s units=%d bs=%s' % (f[:-5], h2, len(units), ('YES' if bs else 'NO')))
        if bs and units:
            calc_data[f[:-5]] = {'name': h2, 'units': units, 'bs': bs.group(1)}

json.dump(calc_data, open(os.path.join(os.path.dirname(__file__), 'calc_data.json'), 'w', encoding='utf-8'), ensure_ascii=False, indent=1)
print('calc_data.json saved:', len(calc_data))
