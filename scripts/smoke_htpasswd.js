// htpasswd 功能冒烟：模拟页面加载顺序
const fs = require('fs');
const vm = require('vm');
const BASE = 'C:/project/wwwroot/toolbox/public/static/script/';

const sandbox = { console, window: {}, document: {}, localStorage: { getItem: () => null, setItem: () => {} } };
sandbox.window = sandbox;
sandbox.globalThis = sandbox;
const ctx = vm.createContext(sandbox);

for (const f of ['pcjs/htpasswd/htpsha1.js', 'pcjs/htpasswd/htpasswd.js', 'pcjs/htpasswd/jsnote.js', 'pcjs/htpasswd/htpmd5.js']) {
  vm.runInContext(fs.readFileSync(BASE + f, 'utf8'), ctx, { filename: f });
}

try {
  const r2 = ctx.htpasswd('admin', 'secret', 2); // MD5 (Apache)
  console.log('htpasswd MD5:', r2);
  console.log('格式含 $apr1$:', String(r2).includes('$apr1$') ? '✅' : '⚠️ 需人工确认');
  const r3 = ctx.htpasswd('admin', 'secret', 3); // SHA-1
  console.log('htpasswd SHA1:', r3);
  const r0 = ctx.htpasswd('admin', 'secret', 0); // plain
  console.log('htpasswd plain:', r0);
} catch (e) {
  console.log('❌ htpasswd 调用失败:', e.message);
}
