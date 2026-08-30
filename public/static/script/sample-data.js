/* ============================================================
 * 在线工具箱 · 示例数据统一注入 (sample-data.js)
 * 在 .tool-actions 前插入「✨ 示例数据」按钮，
 * 点击后按页面配置填入示例数据并自动执行。
 * 兼容新式(内联$('id'))与旧式(jQuery/onclick)工具页。
 * ============================================================ */
(function () {
    'use strict';

    /* ---------- 示例数据配置表（按当前路径匹配） ----------
     * fill : { 输入框id或选择器: 值 }，textarea/input 填 value，
     *         select 用 fillSelect 字段 { id: 选中值 }
     * run  : 执行方式数组，按序执行：
     *         {click: '按钮id'}           点击按钮
     *         {fn: '函数名'}              调用全局函数
     *         {input: '输入框id'}         触发 input/change 事件（自动换算类）
     *         {tab: '面板id或data值'}     切换到 tab
     *         {delay: 毫秒}               延迟
     * msg  : 完成提示文字
     * ------------------------------------------------------ */
    var SAMPLES = {
        /* 以下页面已自带示例按钮，跳过自动注入 */
        '/editor/': { skip: true },
        '/encode/': { skip: true },
        '/textconvert/': { skip: true },
        '/websocket/': { skip: true },
        '/xpath/': { skip: true },
        '/httpheader/': { skip: true },
        '/calculator/': { skip: true },
        '/nianlvli/': { skip: true },
        '/favicon/': { skip: true },
        '/tuya/': { skip: true },
        '/dns/': { skip: true },
        '/chaodai/': { skip: true },
        '/tesufuhao/': { skip: true },
        '/lishishangdejintian/': { skip: true },
        '/keyboardcode/': { skip: true },
        '/androidmanifest/': { skip: true },
        '/bootstrapicon/': { skip: true },
        '/browserinfo/': { skip: true },
        '/ports/': { skip: true },
        '/linuxcmd/': { skip: true },
        '/useragent/': { skip: true },
        '/contenttype/': { skip: true },
        '/caiji/': { skip: true },
        '/currency/': { skip: true },
        '/areacode/': { skip: true },
        '/jieri/': { skip: true },
        '/shaoshuminzu/': { skip: true },

        '/json/': {
            fill: { '#json-in': '{\n  "name": "在线工具箱",\n  "url": "https://tool.example.com",\n  "free": true,\n  "tools": 47,\n  "tags": ["json", "format", "encode"]\n}' },
            run: [{ click: 'runBtn' }],
            msg: '已填入 JSON 示例并格式化'
        },
        '/format/': {
            fill: { '.t-area': 'function hello(name) {\n  var msg = "Hello, " + name + "!";\n  console.log(msg);\n  return msg;\n}\nhello("World");\n' },
            run: [{ click: 'btn-format' }],
            msg: '已填入代码示例并格式化'
        },
        '/html2js/': {
            fill: { '#h2j-in': '<div class="box" id="main">\n  <h2>Hello World</h2>\n  <p>这是一段示例 HTML，用于测试转换。</p>\n  <a href="https://example.com">链接</a>\n</div>' },
            run: [{ click: 'jsToJs' }],
            msg: '已填入 HTML 示例并转换'
        },
        '/regex/': {
            fill: { '#rgText': 'Hello 138-1234-5678\n联系邮箱：user@example.com\n电话 010-87654321，邮编 100000\n日期 2026-08-17，金额 ¥12,345.67' },
            run: [{ click: 'rgRun' }],
            msg: '已填入测试文本并执行匹配'
        },
        '/jsencrypt/': {
            fill: { '#jsInput': 'var secret = "HelloToolbox";\nfunction greet(name) {\n  return "Hi, " + name;\n}\nconsole.log(greet(secret));' },
            run: [{ click: 'btnEncode' }],
            msg: '已填入 JS 示例并加密'
        },
        '/encrypt/': {
            fill: { '#deInput': 'Hello, 在线工具箱! 这是一段用于加密测试的示例文本。' },
            run: [{ click: 'deEncrypt' }],
            msg: '已填入示例文本并加密'
        },
        '/runjs/': {
            fill: { '#content': '<!DOCTYPE html>\n<html>\n<head><meta charset="utf-8"><title>示例</title></head>\n<body>\n  <h3>在线运行示例</h3>\n  <button onclick="alert(\'Hello Toolbox!\')">点我</button>\n  <script>\n    document.write("<p>JS 正常执行: " + (1 + 2) + "</p>");\n  <\/script>\n</body>\n</html>' },
            run: [{ fn: 'webdebug' }],
            msg: '已填入 HTML 示例，点击调试预览可查看'
        },
        '/barcode/': {
            fill: { '#content': '6901234567892' },
            run: [{ click: 'btnresult' }],
            msg: '已填入条形码示例并生成'
        },
        '/autoformat/': {
            fill: { '#srcText': '　　这是一段用于文章排版测试的示例文本，包含多余空格和空行。\n\n　　自动排版功能可以整理段落、统一标点、清理空白，非常适合从网页复制过来的文章。\n\n　　第二段内容，测试首行缩进与段间距处理效果。' },
            run: [{ click: 'btnFormat' }],
            msg: '已填入示例文章并排版'
        },
        '/texttool/': {
            fill: { '#uqInput': 'apple\nbanana\napple\ncherry\nbanana\ndate\n' },
            run: [{ click: 'uqGo' }],
            msg: '已填入示例文本并去重'
        },
        '/calc/': {
            fill: { '.u-in': '100' },
            run: [{ input: '.u-in' }],
            msg: '已填入 100 触发单位换算'
        },
        '/subnetmask/': {
            fill: { 'input[name=ip_1]': '192', 'input[name=ip_2]': '168', 'input[name=ip_3]': '1', 'input[name=ip_4]': '0', 'input[name=bits]': '24' },
            run: [{ fn: 'calNBFL' }],
            msg: '已填入 192.168.1.0/24 并计算'
        },
        '/random/': {
            fill: { '#rndMin': '1', '#rndMax': '100', '#rndCount': '10' },
            run: [{ click: 'rndRun' }],
            msg: '已填入范围并生成随机数'
        },
        '/convert/': {
            fill: { '#utTsInput': '1786953600' },
            run: [{ click: 'utTs2Date' }],
            msg: '已填入时间戳示例并转换'
        },
        '/webcheck/': {
            fill: { '#wcIcpInput': 'https://www.baidu.com' },
            run: [{ click: 'wcIcpBtn' }],
            msg: '已填入网址并检测'
        },
        '/ip/': {
            fill: { '#ip_address': '8.8.8.8' },
            run: [{ click: 'ipQueryBtn' }],
            msg: '已填入 8.8.8.8 并查询归属地'
        },
        '/refresh/': {
            fill: { '#url': 'https://www.baidu.com', '#frequency': '5', '#times': '3' },
            run: [],
            msg: '已填入刷新示例参数'
        },
        '/htaccess2nginx/': {
            fill: { '#content': 'RewriteEngine On\nRewriteRule ^index\\.html$ /index.php [L]\nRewriteRule ^article-(\\d+)\\.html$ /index.php?id=$1 [L]' },
            run: [{ fn: 'htaccess2nginx' }],
            msg: '已填入 htaccess 示例并转换'
        },
        '/createmeta/': {
            fill: { '#cmTitle': '在线工具箱 - 免费好用的在线工具大全', '#cmKeyword': '在线工具,工具箱,JSON格式化', '#cmDesc': '汇集数十款免费在线工具，打开即用。', '#cmAuthor': '在线工具箱' },
            run: [{ click: 'cmRun' }],
            msg: '已填入 Meta 示例并生成'
        },
        '/shortcut/': {
            fill: { '#name': '在线工具箱', '#url': 'https://tool.example.com' },
            run: [{ fn: 'check' }],
            msg: '已填入快捷方式示例'
        },
        '/uuid/': {
            fill: {},
            run: [{ click: 'uuidRun' }],
            msg: '已生成 UUID 示例'
        },

        /* ===== 命令速查页：演示搜索过滤 ===== */
        '/claudecodecmd/': {
            fill: { '#linuxSearch': '会话' },
            msg: '已演示搜索「会话」，清空输入框即可查看全部'
        },
        '/codexcmd/': {
            fill: { '#linuxSearch': 'exec' },
            msg: '已演示搜索「exec」，清空输入框即可查看全部'
        },
        '/deepseekharnesscmd/': {
            fill: { '#linuxSearch': 'harness' },
            msg: '已演示搜索「harness」，清空输入框即可查看全部'
        },
        '/hermescmd/': {
            fill: { '#linuxSearch': 'gateway' },
            msg: '已演示搜索「gateway」，清空输入框即可查看全部'
        },
        '/openclawcmd/': {
            fill: { '#linuxSearch': 'openclaw' },
            msg: '已演示搜索「openclaw」，清空输入框即可查看全部'
        },
        '/opencmd/': {
            fill: { '#linuxSearch': 'open-code' },
            msg: '已演示搜索「open-code」，清空输入框即可查看全部'
        },
        '/picmd/': {
            fill: { '#linuxSearch': 'history' },
            msg: '已演示搜索「history」，清空输入框即可查看全部'
        },
    };

    function $(sel) {
        return document.querySelector(sel);
    }

    function setVal(sel, val) {
        var el = $(sel);
        if (!el) return false;
        if (el.tagName === 'TEXTAREA' || el.tagName === 'INPUT') {
            el.value = val;
            el.dispatchEvent(new Event('input', { bubbles: true }));
            el.dispatchEvent(new Event('change', { bubbles: true }));
            return true;
        }
        return false;
    }

    function doRun(step) {
        if (!step) return;
        if (step.click) {
            var sel = step.click.indexOf('#') === 0 ? step.click : '#' + step.click;
            var btn = $(sel);
            if (btn) { btn.click(); return true; }
            return false;
        }
        if (step.fn) {
            var fn = window[step.fn];
            if (typeof fn === 'function') {
                try { fn(step.arg); return true; } catch (e) { return false; }
            }
            return false;
        }
        if (step.input) {
            var el = $(step.input);
            if (el) {
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('change', { bubbles: true }));
                return true;
            }
            return false;
        }
        if (step.tab) {
            var tab = $(step.tab);
            if (tab) { tab.click(); return true; }
            return false;
        }
        return false;
    }

    function showMsg(text) {
        var d = document.createElement('div');
        d.textContent = text;
        d.style.cssText = 'position:fixed;left:50%;bottom:80px;transform:translateX(-50%);background:#2d2a24;color:#fff;padding:10px 18px;border-radius:8px;font-size:13px;z-index:99999;box-shadow:0 4px 16px rgba(0,0,0,.2);opacity:0;transition:opacity .25s';
        document.body.appendChild(d);
        requestAnimationFrame(function () { d.style.opacity = '1'; });
        setTimeout(function () {
            d.style.opacity = '0';
            setTimeout(function () { d.remove(); }, 300);
        }, 2200);
    }

    function init() {
        var path = location.pathname.replace(/\/+$/, '') + '/';
        var cfg = SAMPLES[path];
        if (!cfg || cfg.skip) return;

        // 找到合适的插入位置：.tool-actions 前，或 .form-group 前，或 tool-card 尾部
        var host = $('.tool-actions') || $('.tool-card');
        if (!host) return;

        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 't-btn t-btn-ghost sample-btn';
        btn.textContent = '✨ 示例数据';
        btn.style.cssText = 'margin-right:8px;';
        btn.addEventListener('click', function () {
            var filled = false;
            if (cfg.fill) {
                Object.keys(cfg.fill).forEach(function (sel) {
                    if (setVal(sel, cfg.fill[sel])) filled = true;
                });
            }
            var ran = false;
            if (cfg.run && cfg.run.length) {
                cfg.run.forEach(function (step) {
                    if (step.delay) {
                        setTimeout(function () { doRun(step); }, step.delay);
                    } else if (doRun(step)) {
                        ran = true;
                    }
                });
            }
            showMsg(cfg.msg || '已填入示例数据' + (filled ? '' : ''));
        });

        // 插入位置优先级：.tool-actions 最前面 > 第一个 .t-row 之后 > .tool-card 尾部
        var actions = $('.tool-actions');
        if (actions) {
            actions.insertBefore(btn, actions.firstChild);
        } else {
            // 找到第一个 .t-row（输入行），插到它后面
            var firstRow = $('.tool-card .t-row');
            if (firstRow && firstRow.parentNode) {
                firstRow.parentNode.insertBefore(btn, firstRow.nextSibling);
            } else {
                // 兜底：插到 tool-card 尾部
                host.appendChild(btn);
            }
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
