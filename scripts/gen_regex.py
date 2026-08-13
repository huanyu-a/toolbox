# -*- coding: utf-8 -*-
"""生成 regex.html：正则测试 + 生成代码 + 常用表 + 语法速查"""
import re, os, html as htmlmod

BASE = r'C:\project\wwwroot\toolbox\application\index\view\index'

def extract(name):
    src = open(os.path.join(BASE, name + '.html'), encoding='utf-8').read()
    rows = re.findall(r'<tr[^>]*>(.*?)</tr>', src, re.S)
    out = []
    for r in rows:
        cells = re.findall(r'<t[dh][^>]*>(.*?)</t[dh]>', r, re.S)
        cells = [re.sub(r'<[^>]+>', '', c).strip() for c in cells]
        if len(cells) >= 2:
            out.append(cells)
    return out

common = extract('regexdso')
syntax = extract('regexsucha')
print('common:', len(common), 'syntax:', len(syntax))

def esc(s):
    return htmlmod.escape(s, quote=True)

# 常用正则表：HTML 用 data-re 存表达式，JS 绑定复制
c_rows = []
for r in common[1:]:
    if len(r) < 2:
        continue
    name = esc(r[0])
    expr = r[1]
    expr_esc = esc(expr)
    expr_attr = expr.replace('"', '&quot;')
    c_rows.append('<tr><td>%s</td><td><code>%s</code></td><td><button class="t-btn t-btn-sm t-btn-ghost" type="button" data-re="%s">复制</button></td></tr>' % (name, expr_esc, expr_attr))
common_html = '<table class="table table-bordered table-striped" style="margin:0"><thead><tr><th>说明</th><th>正则表达式</th><th style="width:70px">操作</th></tr></thead><tbody>' + ''.join(c_rows) + '</tbody></table>'

s_rows = ''.join('<tr><td style="white-space:nowrap"><code>%s</code></td><td>%s</td></tr>' % (esc(r[0]), esc(r[1])) for r in syntax[1:])
syntax_html = '<table class="table table-bordered table-striped" style="margin:0"><thead><tr><th style="width:120px">正则字符</th><th>描述</th></tr></thead><tbody>' + s_rows + '</tbody></table>'

html = '''<!DOCTYPE html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /><title>{$Think.config.web.regex.title}</title><meta name="applicable-device" content="pc,mobile" /><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" /><meta name="keywords" content="{$Think.config.web.regex.keywords}" /><meta name="description" content="{$Think.config.web.regex.description}" /><meta name="renderer" content="webkit" /><meta name="apple-mobile-web-app-capable" content="yes" /><link rel="icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon" /><link href="/static/style/site.min.css" rel="stylesheet" type="text/css"/><!--[if lt IE 9]><script src="//apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script><script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->{:$Think.config.web.header}{include file="seo" /}</head><body>{include file="header" /}
<div class="container"><div class="tool-wrap">
    <div class="tool-card">
        <h2 class="tool-title"><span class="t-ico">🔍</span>正则表达式工具</h2>
        <p class="tool-desc">正则测试（匹配 / 分组 / 替换）、一键生成多语言正则代码、常用正则表达式表与语法速查。</p>
        <ul class="t-tabs" id="rgTabs">
            <li><button type="button" class="t-tab active" data-panel="rgPanel1">正则测试</button></li>
            <li><button type="button" class="t-tab" data-panel="rgPanel2">生成代码</button></li>
            <li><button type="button" class="t-tab" data-panel="rgPanel3">常用正则表</button></li>
            <li><button type="button" class="t-tab" data-panel="rgPanel4">语法速查</button></li>
        </ul>
        <div id="rgPanel1" class="t-panel active">
            <div class="t-grid">
                <div class="t-col" style="flex:2">
                    <label class="t-label" for="rgExpr">正则表达式</label>
                    <input class="t-input" style="width:100%" type="text" id="rgExpr" placeholder="例如：\\d{4}-\\d{2}-\\d{2}">
                </div>
                <div class="t-col" style="flex:1">
                    <label class="t-label" for="rgFlags">修饰符</label>
                    <input class="t-input" style="width:100%" type="text" id="rgFlags" value="g" placeholder="g 全局 / i 忽略大小写 / m 多行 / s 点匹配换行">
                </div>
            </div>
            <label class="t-label" for="rgText" style="margin-top:12px">测试文本</label>
            <textarea class="t-area" id="rgText" rows="6" placeholder="在此粘贴要匹配的文本"></textarea>
            <div class="t-options" style="margin-top:10px">
                <label><input type="checkbox" id="rgReplaceMode"> 替换模式</label>
                <span id="rgReplaceWrap" style="display:none"><label class="t-label" style="display:inline">替换为：<input class="t-input" type="text" id="rgReplace" style="width:180px" placeholder="$1"></label></span>
            </div>
            <div class="tool-actions">
                <button class="t-btn" type="button" id="rgRun">测试匹配</button>
                <button class="t-btn t-btn-ghost" type="button" id="rgClear">清空</button>
            </div>
            <div class="t-result" id="rgResult"></div>
            <div class="t-error" id="rgError"></div>
        </div>
        <div id="rgPanel2" class="t-panel">
            <label class="t-label" for="rgCodeIn">正则表达式</label>
            <input class="t-input" style="width:100%" type="text" id="rgCodeIn" placeholder="例如：^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$">
            <label class="t-label" for="rgCodeLang" style="margin-top:12px">目标语言</label>
            <select class="t-input" style="width:100%" id="rgCodeLang">
                <option value="js">JavaScript</option>
                <option value="php">PHP</option>
                <option value="py">Python</option>
                <option value="java">Java</option>
            </select>
            <div class="tool-actions" style="margin-top:12px">
                <button class="t-btn" type="button" id="rgCodeRun">生成代码</button>
                <button class="t-btn t-btn-ghost" type="button" data-copy="#rgCodeOut">复制代码</button>
            </div>
            <div class="t-result" id="rgCodeResult"><textarea class="t-area t-area-readonly" id="rgCodeOut" rows="10" readonly></textarea></div>
            <div class="t-error" id="rgCodeError"></div>
        </div>
        <div id="rgPanel3" class="t-panel">
            <div style="overflow-x:auto">''' + common_html + '''</div>
        </div>
        <div id="rgPanel4" class="t-panel">
            <div style="overflow-x:auto">''' + syntax_html + '''</div>
        </div>
    </div>
    <div class="tool-card">
        <h2 class="tool-title">📖 关于正则表达式</h2>
        <p class="tool-desc">正则表达式（Regular Expression）是用特殊字符描述字符串匹配模式的表达式。JS 中可用 new RegExp(expr, flags) 或字面量 /expr/flags 创建；生成代码功能会自动转义表达式中的特殊字符，保证各语言代码可直接运行。</p>
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
    var tabs = document.querySelectorAll('#rgTabs .t-tab');
    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            document.querySelectorAll('.tool-card .t-panel').forEach(function (p) { p.classList.remove('active'); });
            var panel = document.getElementById(btn.getAttribute('data-panel'));
            if (panel) panel.classList.add('active');
            btn.classList.add('active');
        });
    });
    // 常用正则表复制
    document.querySelectorAll('[data-re]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var v = btn.getAttribute('data-re');
            var ta = document.createElement('textarea');
            ta.value = v;
            document.body.appendChild(ta);
            ta.select();
            try { document.execCommand('copy'); } catch (e) {}
            document.body.removeChild(ta);
            var old = btn.textContent;
            btn.textContent = '已复制';
            setTimeout(function () { btn.textContent = old; }, 1200);
        });
    });
    // 面板1：正则测试
    var err1 = document.getElementById('rgError');
    document.getElementById('rgReplaceMode').addEventListener('change', function () {
        document.getElementById('rgReplaceWrap').style.display = this.checked ? '' : 'none';
    });
    document.getElementById('rgRun').addEventListener('click', function () {
        err1.classList.remove('show');
        var expr = document.getElementById('rgExpr').value;
        var flags = document.getElementById('rgFlags').value;
        var text = document.getElementById('rgText').value;
        if (!expr) { err1.textContent = '请输入正则表达式'; err1.classList.add('show'); return; }
        var re;
        try { re = new RegExp(expr, flags); } catch (e) { err1.textContent = '表达式错误：' + e.message; err1.classList.add('show'); return; }
        var out = document.getElementById('rgResult');
        var replaceMode = document.getElementById('rgReplaceMode').checked;
        if (replaceMode) {
            var rep = document.getElementById('rgReplace').value;
            var result;
            try { result = text.replace(re, rep); } catch (e) { err1.textContent = '替换出错：' + e.message; err1.classList.add('show'); return; }
            out.innerHTML = '<p class="t-result-label">替换结果（' + result.length + ' 字符）</p><pre class="t-pre" style="white-space:pre-wrap;word-break:break-all;background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:10px;max-height:260px;overflow:auto">' + escapeHtml(result) + '</pre>';
        } else {
            if (!re.global) { re = new RegExp(expr, flags + 'g'); }
            var matches = text.match(re) || [];
            var groups = [];
            var m2, re2 = new RegExp(expr, flags.indexOf('g') >= 0 ? flags : flags + 'g');
            var count = 0;
            while ((m2 = re2.exec(text)) !== null && count < 200) {
                var line = '第 ' + (count + 1) + ' 个匹配';
                var arr = [];
                for (var i = 0; i < m2.length; i++) arr.push(m2[i]);
                line += '：' + (m2.length > 1 ? JSON.stringify(arr) : '"' + m2[0] + '"');
                groups.push('<tr><td>' + (count + 1) + '</td><td style="word-break:break-all">' + escapeHtml(line) + '</td></tr>');
                count++;
                if (m2[0] === '') re2.lastIndex++;
            }
            out.innerHTML = '<p class="t-result-label">共匹配 ' + matches.length + ' 处（展示前 200 个）</p><div style="overflow-x:auto"><table class="table table-bordered table-striped" style="margin:0"><thead><tr><th style="width:60px">#</th><th>匹配内容（含分组）</th></tr></thead><tbody>' + (groups.join('') || '<tr><td colspan="2">无匹配结果</td></tr>') + '</tbody></table></div>';
        }
        out.classList.add('show');
    });
    function escapeHtml(s) { return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;'); }
    document.getElementById('rgClear').addEventListener('click', function () {
        document.getElementById('rgExpr').value = '';
        document.getElementById('rgText').value = '';
        document.getElementById('rgResult').innerHTML = '';
        document.getElementById('rgResult').classList.remove('show');
        err1.classList.remove('show');
    });
    // 面板2：生成代码
    var codeErr = document.getElementById('rgCodeError');
    document.getElementById('rgCodeRun').addEventListener('click', function () {
        codeErr.classList.remove('show');
        var expr = document.getElementById('rgCodeIn').value;
        if (!expr) { codeErr.textContent = '请输入正则表达式'; codeErr.classList.add('show'); return; }
        var lang = document.getElementById('rgCodeLang').value;
        var escJs = expr.replace(/\\/g, '\\\\').replace(/"/g, '\\"').replace(/\n/g, '\\n');
        var escPhp = expr.replace(/\\/g, '\\\\').replace(/'/g, "\\'");
        var escPy = expr.replace(/\\/g, '\\\\').replace(/'/g, "\\'");
        var escJava = expr.replace(/\\/g, '\\\\').replace(/"/g, '\\"');
        var code = '';
        if (lang === 'js') {
            code = '// JavaScript 正则匹配示例\nconst regex = /' + escJs + '/g;\nconst text = "待匹配文本";\nconst matches = text.match(regex);\nconsole.log(matches);';
        } else if (lang === 'php') {
            code = '<?php\n// PHP 正则匹配示例\n$pattern = \'/' + escPhp + '/\';\n$text = "待匹配文本";\nif (preg_match_all($pattern, $text, $matches)) {\n    print_r($matches);\n}';
        } else if (lang === 'py') {
            code = '# Python 正则匹配示例\nimport re\npattern = r\'' + escPy + '\'\ntext = "待匹配文本"\nmatches = re.findall(pattern, text)\nprint(matches)';
        } else {
            code = '// Java 正则匹配示例\nimport java.util.regex.*;\n\nString pattern = "' + escJava + '";\nString text = "待匹配文本";\nPattern p = Pattern.compile(pattern);\nMatcher m = p.matcher(text);\nwhile (m.find()) {\n    System.out.println(m.group());\n}';
        }
        document.getElementById('rgCodeOut').value = code;
        document.getElementById('rgCodeResult').classList.add('show');
    });
})();
</script>
</body></html>'''

out = os.path.join(BASE, 'regex.html')
open(out, 'w', encoding='utf-8').write(html)
print('written:', out, len(html))
