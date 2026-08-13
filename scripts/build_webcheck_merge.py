# -*- coding: utf-8 -*-
"""将 pagecode 的「状态码查询 + 状态码对照表」并入 webcheck.html"""
import re

BASE = r"C:\project\wwwroot\toolbox\application\index\view\index"
wc_path = BASE + r"\webcheck.html"
pc_path = BASE + r"\pagecode.html"

pc = open(pc_path, encoding="utf-8").read()
wc = open(wc_path, encoding="utf-8").read()

# 1. 提取 pcPanel1 对照表内部 HTML（overflow-x div）
m = re.search(r'<div id="pcPanel1" class="t-panel active">(.*?)</div>\s*<div id="pcPanel2"', pc, re.S)
if not m:
    raise SystemExit("pcPanel1 not found")
code_table = m.group(1).strip()

# 2. 提取 pcPanel2 查询区逻辑参考（手动重建，改 ID 前缀 wcCode）

# 3. 更新描述
old_desc = '网站检测工具箱：ICP 备案查询、域名 Whois 信息、网站死链检测、微信域名检测、Gzip 压缩检测、关键词密度检测，输入网址一键检测。'
new_desc = '网站检测工具箱：ICP 备案查询、域名 Whois 信息、网站死链检测、微信域名检测、Gzip 压缩检测、关键词密度检测、HTTP 状态码查询与对照表，输入网址一键检测。'
if old_desc not in wc:
    raise SystemExit("desc not found")
wc = wc.replace(old_desc, new_desc)

# 4. tabs 增加「状态码」
old_tabs = '<li><button type="button" class="t-tab" data-panel="wcKw">关键词密度</button></li>\n        </ul>'
new_tabs = '<li><button type="button" class="t-tab" data-panel="wcKw">关键词密度</button></li>\n            <li><button type="button" class="t-tab" data-panel="wcCode">状态码</button></li>\n        </ul>'
if old_tabs not in wc:
    raise SystemExit("tabs not found")
wc = wc.replace(old_tabs, new_tabs)

# 5. 新面板 HTML（查询区 + 对照表）
new_panel = '''        <!-- HTTP 状态码 -->
        <div id="wcCode" class="t-panel wc-panel">
            <label class="t-label" for="wcCodeUrl">输入网址查询 HTTP 状态</label>
            <div class="t-row">
                <input class="t-input t-flex1" id="wcCodeUrl" placeholder="如：http://example.com" />
                <button class="t-btn t-btn-ok" type="button" id="wcCodeQuery">查询 HTTP 状态</button>
            </div>
            <div class="t-error" id="wcCodeError"></div>
            <div class="t-result" id="wcCodeResult">
                <p class="t-result-label" id="wcCodeResultLabel"></p>
                <p id="wcCodeResultText" style="margin:8px 0;color:var(--text-2,#666);line-height:1.8"></p>
                <table class="table table-bordered table-striped" style="margin:0">
                    <tbody id="wcCodeResultBody"></tbody>
                </table>
                <div class="tool-actions" style="margin-top:12px">
                    <button class="t-btn t-btn-ghost" type="button" data-copy="#wcCodeResultText">复制结果</button>
                </div>
            </div>
            <div style="overflow-x:auto;margin-top:18px;border-top:1px solid var(--line,#eee);padding-top:6px">%s</div>
        </div>
    </div>
</div></div>''' % code_table

# 在 wcKw 面板结束后插入（原文件结尾结构：wcKw 面板 </div> 后跟 </div></div></div>）
old_end = '''            <div class="t-result" id="wcKwResult" style="display:none"></div>
        </div>
    </div>
</div></div>'''
if old_end not in wc:
    raise SystemExit("panel end not found")
wc = wc.replace(old_end, '''            <div class="t-result" id="wcKwResult" style="display:none"></div>
        </div>
''' + new_panel)

# 6. 状态码查询 JS（独立 IIFE，插在 </script> 前）
code_js = '''
(function () {
    'use strict';
    var STATUS = {
        100: '继续', 101: '切换协议', 102: '处理中',
        200: '请求成功', 201: '已创建', 202: '已接受', 203: '非权威信息', 204: '无内容', 205: '重置内容', 206: '部分内容', 207: '多状态',
        300: '多种选择', 301: '永久移动', 302: '临时移动', 303: '查看其它位置', 304: '未修改', 305: '使用代理', 306: '已弃用', 307: '临时重定向', 308: '永久重定向',
        400: '请求错误', 401: '未授权', 402: '需要付费', 403: '禁止访问', 404: '页面不存在', 405: '方法不允许', 406: '不可接受', 407: '需要代理认证', 408: '请求超时', 409: '冲突', 410: '已删除', 411: '需要长度', 412: '前置条件失败', 413: '请求体过大', 414: 'URI 过长', 415: '不支持的媒体类型', 416: '范围不满足', 417: '期望失败', 421: '错误指向的请求', 422: '无法处理的实体', 423: '已锁定', 424: '依赖失败', 425: '请求过早', 426: '需要升级', 428: '需要前置条件', 429: '请求过多', 431: '请求头过大', 449: '请重试', 451: '法律原因不可用',
        500: '服务器内部错误', 501: '未实现', 502: '网关错误', 503: '服务不可用', 504: '网关超时', 505: 'HTTP 版本不支持', 506: '变体协商', 507: '存储不足', 508: '检测到循环', 509: '带宽超限', 510: '未扩展', 511: '需要网络认证'
    };
    var err = document.getElementById('wcCodeError');
    var result = document.getElementById('wcCodeResult');
    var btn = document.getElementById('wcCodeQuery');
    if (!btn) return;
    function esc(s) {
        return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
    function query() {
        err.classList.remove('show');
        result.classList.remove('show');
        var u = document.getElementById('wcCodeUrl').value.trim();
        if (!u) { err.textContent = '请输入网址'; err.classList.add('show'); return; }
        var url = /^https?:\\/\\//i.test(u) ? u : 'http://' + u;
        btn.disabled = true;
        var originText = btn.textContent;
        btn.textContent = '检测中…';
        fetch(url, { method: 'GET', redirect: 'follow', cache: 'no-store' })
            .then(function (res) {
                var code = res.status;
                var statusText = res.statusText || '';
                var desc = STATUS[code] || ('未知状态码' + (statusText ? '（' + statusText + '）' : ''));
                var heads = [];
                res.headers.forEach(function (v, k) { heads.push(k + ': ' + v); });
                var headHtml = heads.length ? heads.join('<br>') : '（跨域限制下响应头不可见）';
                document.getElementById('wcCodeResultLabel').textContent = '页面 ' + url + ' 检测结果';
                document.getElementById('wcCodeResultBody').innerHTML =
                    '<tr><td style="width:150px">检测地址</td><td style="word-break:break-all">' + esc(url) + '</td></tr>' +
                    '<tr><td style="width:150px">返回状态码</td><td style="font-weight:600;color:var(--brand)">' + code + ' ' + esc(statusText) + '</td></tr>' +
                    '<tr><td style="width:150px">状态说明</td><td>' + esc(desc) + '</td></tr>' +
                    '<tr><td style="width:150px">响应头</td><td style="word-break:break-all">' + headHtml + '</td></tr>';
                document.getElementById('wcCodeResultText').textContent = '页面 ' + url + ' 返回状态码 ' + code + ' ' + statusText + '，' + desc + (heads.length ? '。\\n' + heads.join('\\n') : '。');
                result.classList.add('show');
            })
            .catch(function (e) {
                err.textContent = '检测失败：浏览器跨域限制或目标网站无法访问（' + (e && e.message ? e.message : '网络错误') + '）。跨域站点无法直接检测，请直接在浏览器中打开 ' + url + ' 查看实际状态码。';
                err.classList.add('show');
            })
            .then(function () {
                btn.disabled = false;
                btn.textContent = originText;
            });
    }
    btn.addEventListener('click', query);
    document.getElementById('wcCodeUrl').addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) { e.preventDefault(); query(); }
    });
})();
'''
old_js_end = '})();\n</script>'
if old_js_end not in wc:
    raise SystemExit("js end not found")
wc = wc.replace(old_js_end, '})();\n' + code_js + '</script>')

open(wc_path, "w", encoding="utf-8").write(wc)
print("webcheck.html 更新完成，新大小:", len(wc))
