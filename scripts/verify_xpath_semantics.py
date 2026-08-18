# -*- coding: utf-8 -*-
"""独立验证 xpath.js 的 XPath 语义（用 lxml 复现 document.evaluate 行为）"""
import lxml.html

SAMPLE = '''<html>
<body>
  <div id="list">
    <a href="https://a.com/1">链接一</a>
    <a href="https://a.com/2">链接二</a>
    <img src="https://a.com/1.png">
    <img src="https://a.com/2.png">
  </div>
</body>
</html>'''

doc = lxml.html.fromstring(SAMPLE)

def evaluate(expr):
    """模拟 document.evaluate：节点集 -> 文本列表；number/string/bool -> 标量"""
    res = doc.xpath(expr)
    if isinstance(res, list):
        out = []
        for node in res:
            if isinstance(node, str):
                out.append(node)  # 属性值 / 文本
            elif hasattr(node, 'tag') and not isinstance(node.tag, str) and node.tag is lxml.etree.Comment:
                out.append(node.text or '')
            else:
                # 元素 -> outerHTML 等价（序列化）
                out.append(lxml.html.tostring(node, encoding='unicode').strip())
        return out
    return [str(res)]

cases = {
    '//img/@src': ['https://a.com/1.png', 'https://a.com/2.png'],
    '//a/@href': ['https://a.com/1', 'https://a.com/2'],
    '//a': None,  # 元素，验证能返回 2 个
    'count(//a)': ['2'],
    '//div[@id="list"]/a/text()': ['链接一', '链接二'],
}

ok = True
for expr, expect in cases.items():
    got = evaluate(expr)
    print(f"[{expr}] => {got}")
    if expect is not None and got != expect:
        ok = False
        print(f"  ^^ 期望 {expect}")
    if expr == '//a' and len(got) != 2:
        ok = False
        print("  ^^ //a 应返回 2 个元素")

print("ALL_OK" if ok else "HAS_FAILURES")
