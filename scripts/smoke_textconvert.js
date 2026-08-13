// 冒烟测试：jianfan / pinyin 库函数 + 页面包装参数
const fs = require('fs');
const vm = require('vm');

function loadLib(p, extra) {
    const code = fs.readFileSync(p, 'utf8');
    const ctx = Object.assign({ window: {}, document: {}, console }, extra || {});
    ctx.window = ctx;
    ctx.global = ctx;
    vm.createContext(ctx);
    vm.runInContext(code, ctx);
    return ctx;
}

// 1. jianfan.js
const jf = loadLib('public/static/script/pcjs/jianfan.js');
const simple = jf.simplized('简体字测试');
const trad = jf.traditionalized('繁体字測試');
const qq = jf.qqlized('火星文测试');
console.log('jianfan simplized:', simple);
console.log('jianfan traditionalized:', trad);
console.log('jianfan qqlized:', qq);
console.log('简繁互转 OK:', simple.length > 0 && trad.length > 0 && qq.length > 0);

// 2. pinyin.js（toPinyin 依赖 PinYin 数组 + arraySearch）
const fakeJQ = function () { return fakeJQ; };
fakeJQ.click = fakeJQ; fakeJQ.val = function () { return ''; };
fakeJQ.prop = function () { return false; }; fakeJQ.html = fakeJQ;
const py = loadLib('public/static/script/pcjs/pinyin.js', { document: { forms: [], getElementById: function () { return { value: '', checked: false }; } }, $: fakeJQ });
const r1 = py.toPinyin({ str: '中文', dz: '1', sym: false, sym1: true, sym2: true });
const r2 = py.toPinyin({ str: '编码转换', dz: '5', sym: true, sym1: true, sym2: true });
console.log('toPinyin dz=1:', r1);
console.log('toPinyin dz=5:', r2);
console.log('拼音 OK:', typeof r1 === 'string' && r1.indexOf('zhong') >= 0 || (r1 || '').length > 0);

// 3. pydic 读音（transs 核心）
console.log('pydic 含"中":', py.pydic.indexOf('中') >= 0);
