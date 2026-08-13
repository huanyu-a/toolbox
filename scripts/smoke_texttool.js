// texttool 冒烟：difflib/diffview 可用性
const fs = require('fs');
const vm = require('vm');
const ctx = { window: {}, document: {}, console };
ctx.window = ctx; ctx.global = ctx;
vm.createContext(ctx);
vm.runInContext(fs.readFileSync('public/static/script/pcjs/txtdifflib.js', 'utf8'), ctx);
vm.runInContext(fs.readFileSync('public/static/script/pcjs/txtdiffview.js', 'utf8'), ctx);
const base = ctx.difflib.stringAsLines('hello world\nline2');
const newtxt = ctx.difflib.stringAsLines('hello toolbox\nline2');
const sm = new ctx.difflib.SequenceMatcher(base, newtxt);
const opcodes = sm.get_opcodes();
const view = ctx.diffview.buildView({
    baseTextLines: base, newTextLines: newtxt, opcodes: opcodes,
    baseTextName: '基础文本', newTextName: '对比文本', contextSize: '', viewType: 0
});
console.log('difflib OK:', typeof ctx.difflib.stringAsLines === 'function');
console.log('SequenceMatcher opcodes:', JSON.stringify(opcodes));
console.log('diffview 输出长度:', view.length);
console.log('含增删标记:', view.indexOf('ins') >= 0 || view.indexOf('del') >= 0);
