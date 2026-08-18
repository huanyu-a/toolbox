/* ============================================================
 * XPath 工具 (xpath.js)
 * 真正的 XPath 解析：DOMParser 解析 HTML + document.evaluate 执行表达式
 * - find(1)：解析图片（提取所有 img 的 src）
 * - find(2)：按输入框中的 XPath 表达式匹配
 * - find(3)：解析链接（提取所有 a 的 href）
 * 结果以纯文本展示（textContent，杜绝 HTML 注入），不依赖 hightout.js / hljs
 * ============================================================ */
(function (global) {
    'use strict';

    function getContent() {
        var el = document.getElementById('content');
        return el ? el.value : '';
    }

    function getXPath() {
        var el = document.getElementById('xpath');
        return el ? el.value.trim() : '';
    }

    function getResultNode() {
        return document.getElementById('result');
    }

    /* 用 DOMParser 把输入解析为完整文档，供 document.evaluate 使用 */
    function parseHTML(html) {
        var doc = new DOMParser().parseFromString(html, 'text/html');
        return doc;
    }

    /* 单个节点 -> 展示文本 */
    function nodeToText(node) {
        if (!node) return '';
        // 属性节点（如 //a/@href、//img/@src）
        if (node.nodeType === 2) return node.nodeValue || '';
        // 文本 / CDATA 节点
        if (node.nodeType === 3 || node.nodeType === 4) return node.nodeValue || '';
        // 元素节点：输出其源码
        if (node.nodeType === 1) return node.outerHTML;
        // 兜底
        return (node.textContent !== undefined ? node.textContent : String(node)) || '';
    }

    /* 执行 XPath，返回字符串结果数组 */
    function runXPath(html, expr) {
        var doc = parseHTML(html);
        var results = [];
        var res = doc.evaluate(expr, doc, null, XPathResult.ANY_TYPE, null);

        switch (res.resultType) {
            case XPathResult.NUMBER_TYPE:
                results.push(String(res.numberValue));
                break;
            case XPathResult.STRING_TYPE:
                results.push(res.stringValue);
                break;
            case XPathResult.BOOLEAN_TYPE:
                results.push(String(res.booleanValue));
                break;
            default: {
                // 节点集（iterator 类型）
                var node;
                while ((node = res.iterateNext())) {
                    var t = nodeToText(node);
                    if (t !== '') results.push(t);
                }
                break;
            }
        }
        return results;
    }

    function showResult(lines) {
        var result = getResultNode();
        if (!result) return;
        var pre = result.closest ? result.closest('pre') : null;
        if (pre) pre.style.display = 'block';
        result.textContent = lines.length ? lines.join('\n') : '没有匹配到数据';
    }

    /* 统一入口：find(1)=图片 find(2)=自定义XPath find(3)=链接 */
    global.find = function (t) {
        var html = getContent();
        if (!html.trim()) {
            showResult(['请输入要 XPath 测试的内容']);
            return;
        }
        var expr = '';
        if (t === 1) {
            expr = '//img/@src';
        } else if (t === 3) {
            expr = '//a/@href';
        } else {
            expr = getXPath();
            if (!expr) {
                showResult(['请输入 XPath 表达式']);
                return;
            }
        }
        try {
            var results = runXPath(html, expr);
            showResult(results);
        } catch (e) {
            showResult(['XPath 表达式无效：' + (e && e.message ? e.message : e)]);
        }
    };

    global.demo = function () {
        var c = document.getElementById('content');
        if (c) {
            c.value = '<html>\n<body>\n  <div id="list">\n    <a href="https://a.com/1">链接一</a>\n    <a href="https://a.com/2">链接二</a>\n    <img src="https://a.com/1.png">\n    <img src="https://a.com/2.png">\n  </div>\n</body>\n</html>';
        }
        var x = document.getElementById('xpath');
        if (x) x.value = '//a/@href';
        showResult(['已填入示例数据，点击「xpath匹配」查看结果']);
    };

    global.ClearAll = function () {
        var c = document.getElementById('content');
        if (c) c.value = '';
        var x = document.getElementById('xpath');
        if (x) x.value = '';
        var result = getResultNode();
        if (result) result.textContent = '';
    };
})(window);
