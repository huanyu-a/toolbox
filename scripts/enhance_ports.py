# -*- coding: utf-8 -*-
"""ports.html 加搜索过滤 + 去 accordion 外壳"""
import re

path = r"C:\project\wwwroot\toolbox\application\index\view\index\ports.html"
src = open(path, encoding="utf-8").read()

# 1. 去掉 accordion 外壳（保留 table）
src = src.replace(
    '<div class="accordion-heading"><a class="list-group-item list-group-item-success" data-toggle="collapse" href="#demo1">No1.最常用端口</a></div>\n            <div id="demo1" class="in collapse">',
    '<h3 class="t-label" style="font-size:15px;margin:0 0 10px;">No1. 最常用端口</h3>'
)
src = src.replace('</table></div></div>', '</table>')

# 2. desc 后加搜索框
search_html = '''<div class="t-row" style="margin-bottom:14px">
            <div class="t-col" style="flex:1;min-width:220px">
                <label class="t-label" for="portSearch">🔍 端口搜索</label>
                <input class="t-input" style="width:100%" type="search" id="portSearch" placeholder="输入端口号、服务名称或注释关键词过滤…">
            </div>
        </div>'''
src = src.replace('</p>', '</p>' + search_html, 1)

# 3. 加内联脚本（过滤表格行）
script = '''
<script>
(function () {
    var input = document.getElementById('portSearch');
    var table = document.querySelector('table');
    if (!input || !table) return;
    var rows = Array.prototype.slice.call(table.querySelectorAll('tbody tr'));
    var headRow = rows.shift(); // 表头行
    input.addEventListener('input', function () {
        var kw = input.value.trim().toLowerCase();
        rows.forEach(function (tr) {
            var match = !kw || tr.textContent.toLowerCase().indexOf(kw) !== -1;
            tr.style.display = match ? '' : 'none';
        });
    });
})();
</script>
'''
src = src.replace('</body>', script + '\n</body>')

open(path, "w", encoding="utf-8").write(src)
print("完成。含搜索:", "portSearch" in src, "| 含过滤脚本:", "filter" in src or "indexOf(kw)" in src)
print("table 数:", src.count("<table"), "| tr 数:", src.count("<tr"))
