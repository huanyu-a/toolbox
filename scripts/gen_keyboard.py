# -*- coding: utf-8 -*-
"""生成 keyboardcode.html：KeyCode 获取 + 键盘测试 + Android 按键码表"""
import re, os, html as htmlmod

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

# 1. 提取 keyboardtest 的键盘布局
ksrc = open(os.path.join(BASE, 'keyboardtest.html'), encoding='utf-8').read()
i0 = ksrc.find('<div id="anjian_test">')
i1 = ksrc.find('</div></div>', i0)  # anjian_test 结束
layout = ksrc[i0:i1 + len('</div></div>')]
print('layout len:', len(layout))

# 2. keyboard.css
kcss = open(r'C:\project\wwwroot\toolbox\public\static\style\keyboard.css', encoding='utf-8').read()

# 3. Android 按键码表
asrc = open(os.path.join(BASE, 'androidkeycode.html'), encoding='utf-8').read()
rows = re.findall(r'<tr[^>]*>(.*?)</tr>', asrc, re.S)
adata = []
for r in rows:
    cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
    cells = [re.sub(r'<[^>]+>', '', c).strip() for c in cells]
    if len(cells) >= 2 and cells[0].startswith('KEYCODE_'):
        adata.append(cells)
print('android rows:', len(adata))

def esc(s):
    return htmlmod.escape(s, quote=True)

# 只展示有数字码的（前 120 个），避免页面过长
atable = []
for c in adata:
    if len(c) >= 3 and c[2].isdigit():
        atable.append(c)
    if len(atable) >= 120:
        break
a_rows = ''.join('<tr><td style="white-space:nowrap"><code>%s</code></td><td>%s</td><td>%s</td></tr>' % (esc(c[0]), esc(c[1]), esc(c[2])) for c in atable)
a_html = '<table class="table table-bordered table-striped" style="margin:0"><thead><tr><th>按键常量</th><th>说明</th><th>键值</th></tr></thead><tbody>' + a_rows + '</tbody></table>'

html = '''<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.keyboardcode.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.keyboardcode.keywords}" /><meta name="description" content="{$Think.config.web.keyboardcode.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<style>''' + kcss + '''</style>
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">⌨️</span>按键码 / 键盘测试 / Android 按键码</h2>
        <p class="tool-desc">在线获取键盘 KeyCode 键值、可视化测试键盘各按键是否完好，并附 Android 系统按键码（KEYCODE）对照表。</p>
        <ul class="t-tabs" id="kbTabs">
            <li><button type="button" class="t-tab active" data-panel="kbPanel1">KeyCode 获取</button></li>
            <li><button type="button" class="t-tab" data-panel="kbPanel2">键盘测试</button></li>
            <li><button type="button" class="t-tab" data-panel="kbPanel3">Android 按键码</button></li>
        </ul>
        <div id="kbPanel1" class="t-panel active">
            <label class="t-label" for="kbInput">点击下方输入框后按下任意按键</label>
            <div class="t-row" style="margin-bottom:10px">
                <div class="t-col" style="flex:1">
                    <input class="t-input" style="width:100%" type="text" id="kbInput" placeholder="请在此输入按键">
                </div>
            </div>
            <div class="t-result show">
                <div class="t-row">
                    <div class="t-col" style="flex:1"><span class="t-result-label">KeyCode 值：</span><b id="kbCode" style="font-size:20px;color:var(--brand)">-</b></div>
                    <div class="t-col" style="flex:1"><span class="t-result-label">按键名称：</span><b id="kbKey" style="font-size:20px;color:var(--brand)">-</b></div>
                </div>
            </div>
            <div class="t-error" id="kbError"></div>
        </div>
        <div id="kbPanel2" class="t-panel">
            <p class="t-desc" style="color:var(--text-2);font-size:13px">在下方键盘上依次按下每个按键，被按下的键会高亮；若某个键无反应则可能失灵。测试小键盘时请确保 Num Lock 开启。</p>
            ''' + layout + '''
            <div style="text-align:center;margin:10px 0 0">
                <button class="t-btn t-btn-ghost" type="button" onclick="keyboard_reset()">按键全部重置</button>
            </div>
        </div>
        <div id="kbPanel3" class="t-panel">
            <div style="overflow-x:auto">''' + a_html + '''</div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于按键码</h2>
        <p class="tool-desc">KeyCode 是浏览器键盘事件的按键数值（如 Enter=13、Space=32、A=65），用于前端开发中监听按键。Android 的 KeyEvent.KEYCODE 常量值（如 KEYCODE_BACK=4）用于安卓应用开发。</p>
    </div>
</div></div>
{include file="nav" /}
{include file="footer" /}
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/toolbox.js"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script src="/static/script/keyboard.js" type="text/javascript"></script>
<script>
(function () {
    var tabs = document.querySelectorAll('#kbTabs .t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });
    var input = document.getElementById('kbInput');
    input.addEventListener('keydown', function (e) {
        e.preventDefault();
        input.value = '';
        document.getElementById('kbCode').textContent = e.keyCode;
        document.getElementById('kbKey').textContent = e.key || '(无法识别)';
    });
})();
</script>
</body></html>'''

out = os.path.join(BASE, 'keyboardcode.html')
open(out, 'w', encoding='utf-8').write(html)
print('written:', out, len(html))
