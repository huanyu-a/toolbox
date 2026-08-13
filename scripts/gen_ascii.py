# -*- coding: utf-8 -*-
"""生成 ascii.html：ASCII 转换 + 对照表（0-127 完整）"""
import os

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

# ASCII 0-127 字符数据
CTRL = {0:'NUL',1:'SOH',2:'STX',3:'ETX',4:'EOT',5:'ENQ',6:'ACK',7:'BEL',8:'BS',9:'TAB',10:'LF',11:'VT',
        12:'FF',13:'CR',14:'SO',15:'SI',16:'DLE',17:'DC1',18:'DC2',19:'DC3',20:'DC4',21:'NAK',22:'SYN',
        23:'ETB',24:'CAN',25:'EM',26:'SUB',27:'ESC',28:'FS',29:'GS',30:'RS',31:'US',127:'DEL'}
def disp(c):
    if c in CTRL: return CTRL[c]
    ch = chr(c)
    return ch if ch not in ('"','&','<','>') else {'"':'&quot;','&':'&amp;','<':'&lt;','>':'&gt;'}[ch]

rows = []
for i in range(0, 128, 4):
    cells = []
    for j in range(4):
        c = i + j
        cells.append((c, disp(c)))
    rows.append(cells)

def tab_cells(r):
    out = ''
    for c, ch in r:
        out += '<td>%d</td><td>%s</td>' % (c, ch)
    return out

table_html = '<table class="table table-bordered table-striped" style="margin:0"><thead><tr><th>ASCII</th><th>字符</th><th>ASCII</th><th>字符</th><th>ASCII</th><th>字符</th><th>ASCII</th><th>字符</th></tr></thead><tbody>'
for r in rows:
    table_html += '<tr>' + tab_cells(r) + '</tr>'
table_html += '</tbody></table>'

html = '''<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.ascii.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.ascii.keywords}" /><meta name="description" content="{$Think.config.web.ascii.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">🔠</span>ASCII 转换 / 对照表</h2>
        <p class="tool-desc">字符与 ASCII 十进制 / 十六进制编码互转，支持批量转换整段文本，并附完整 ASCII 对照表。</p>
        <ul class="t-tabs" id="ascTabs">
            <li><button type="button" class="t-tab active" data-panel="ascPanel1">ASCII 转换</button></li>
            <li><button type="button" class="t-tab" data-panel="ascPanel2">ASCII 对照表</button></li>
        </ul>
        <div id="ascPanel1" class="t-panel active">
            <label class="t-label" for="ascInput">输入文本</label>
            <textarea class="t-area" id="ascInput" rows="6" placeholder="输入要转换的字符或文本"></textarea>
            <div class="t-options" style="margin-top:10px">
                <label><input type="radio" name="ascMode" value="dec" checked> 转十进制</label>
                <label><input type="radio" name="ascMode" value="hex"> 转十六进制</label>
                <label><input type="radio" name="ascMode" value="revert"> 编码还原</label>
                <label><input type="checkbox" id="ascSpace"> 编码间加空格</label>
            </div>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="ascRun">转换</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#ascOutput">复制结果</button>
                <button class="t-btn t-btn-ghost" type="button" id="ascClear">清空</button>
            </div>
            <div class="t-result" id="ascResult"><textarea class="t-area t-area-readonly" id="ascOutput" rows="6" readonly></textarea></div>
            <div class="t-error" id="ascError"></div>
        </div>
        <div id="ascPanel2" class="t-panel">
            <div style="overflow-x:auto">''' + table_html + '''</div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于 ASCII</h2>
        <p class="tool-desc">ASCII（American Standard Code for Information Interchange）用 7 位二进制表示 128 个字符：0~31 为控制字符，32~126 为可打印字符（含数字、大小写字母与标点），127 为 DEL。扩展 ASCII（128~255）在不同编码中含义不同，未在本表列出。</p>
    </div>
</div></div>
{include file="nav" /}
{include file="footer" /}
<script src="/static/script/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/static/script/bootstrap.min.js" type="text/javascript"></script>
<script src="/static/script/toolbox.js"></script>
<script src="/static/script/app.js" type="text/javascript"></script>
<script>
(function () {
    var tabs = document.querySelectorAll('#ascTabs .t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });
    var err = document.getElementById('ascError');
    document.getElementById('ascRun').addEventListener('click', function () {
        err.classList.remove('show');
        var raw = document.getElementById('ascInput').value;
        if (!raw) { err.textContent = '请输入内容'; err.classList.add('show'); return; }
        var mode = document.querySelector('input[name="ascMode"]:checked').value;
        var space = document.getElementById('ascSpace').checked ? ' ' : '';
        var out;
        if (mode === 'revert') {
            out = raw.replace(/(?:\\x)?([0-9A-Fa-f]{2})/g, function (m, h) { return String.fromCharCode(parseInt(h, 16)); });
        } else {
            var parts = [];
            for (var i = 0; i < raw.length; i++) {
                var c = raw.charCodeAt(i);
                parts.push(mode === 'hex' ? c.toString(16).toUpperCase() : c.toString(10));
            }
            out = parts.join(space);
        }
        document.getElementById('ascOutput').value = out;
        document.getElementById('ascResult').classList.add('show');
    });
    document.getElementById('ascClear').addEventListener('click', function () {
        document.getElementById('ascInput').value = '';
        document.getElementById('ascOutput').value = '';
        document.getElementById('ascResult').classList.remove('show');
        err.classList.remove('show');
        document.getElementById('ascInput').focus();
    });
})();
</script>
</body></html>'''

out = os.path.join(BASE, 'ascii.html')
open(out, 'w', encoding='utf-8').write(html)
print('written:', out, len(html))
