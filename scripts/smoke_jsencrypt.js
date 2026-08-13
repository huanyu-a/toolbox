// jsencrypt 冒烟：CLASS_CONFUSION 混淆
const fs = require('fs');
const vm = require('vm');
const ctx = { window: {}, document: { forms: [] }, console };
ctx.window = ctx; ctx.global = ctx;
const fakeJQ = function () { return fakeJQ; };
fakeJQ.click = fakeJQ; fakeJQ.val = function () { return ''; };
fakeJQ.html = fakeJQ; fakeJQ.prop = function () { return false; };
ctx.$ = fakeJQ;
vm.createContext(ctx);
vm.runInContext(fs.readFileSync('public/static/script/jsformat/jsendecode.js', 'utf8'), ctx);
const code = 'function hello(name){ return "hi " + name; }';
const xx = new ctx.CLASS_CONFUSION(code);
const out = xx.confusion();
console.log('混淆输出长度:', out.length);
console.log('输出片段:', out.slice(0, 200));
console.log('混淆 OK:', out.length > 0 && out !== code);
