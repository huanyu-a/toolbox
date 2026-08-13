// 模拟合并加载：deencrypt(5) + allencrypt(8) + htpasswd(4)
const fs = require('fs');
const path = require('path');
const vm = require('vm');

const BASE = 'C:/project/wwwroot/toolbox/public/static/script/';
const sandbox = { console, window: {}, document: {}, localStorage: { getItem: () => null, setItem: () => {} } };
sandbox.window = sandbox;
sandbox.globalThis = sandbox;
const ctx = vm.createContext(sandbox);

const files = [
  'pcjs/crypto-js.js', 'pcjs/aes.js', 'pcjs/rabbit.js', 'pcjs/rc4.js', 'pcjs/tripledes.js',
  'encrypt/pcjson-md5.js', 'encrypt/pcjson-sha1.js', 'encrypt/pcjson-sha224.js',
  'encrypt/pcjson-sha256.js', 'encrypt/pcjson-sha384.js', 'encrypt/pcjson-sha512.js',
  'encrypt/pcjson-ripemd160.js', 'encrypt/pcjson-sha3.js',
  'pcjs/htpasswd/htpsha1.js', 'pcjs/htpasswd/htpasswd.js', 'pcjs/htpasswd/jsnote.js', 'pcjs/htpasswd/htpmd5.js',
];

for (const f of files) {
  const code = fs.readFileSync(path.join(BASE, f), 'utf8');
  try {
    vm.runInContext(code, ctx, { filename: f });
  } catch (e) {
    console.log('⚠️', f, '→', e.message.slice(0, 80));
  }
}

const C = ctx.CryptoJS;
const checks = {
  'AES.encrypt': typeof C.AES?.encrypt === 'function',
  'DES.encrypt': typeof C.DES?.encrypt === 'function',
  'RC4.encrypt': typeof C.RC4?.encrypt === 'function',
  'Rabbit.encrypt': typeof C.Rabbit?.encrypt === 'function',
  'TripleDES.encrypt': typeof C.TripleDES?.encrypt === 'function',
  'MD5': typeof C.MD5 === 'function',
  'SHA1': typeof C.SHA1 === 'function',
  'SHA224': typeof C.SHA224 === 'function',
  'SHA256': typeof C.SHA256 === 'function',
  'SHA384': typeof C.SHA384 === 'function',
  'SHA512': typeof C.SHA512 === 'function',
  'RIPEMD160': typeof C.RIPEMD160 === 'function',
  'SHA3': typeof C.SHA3 === 'function',
  'HmacMD5': typeof C.HmacMD5 === 'function',
  'HmacSHA256': typeof C.HmacSHA256 === 'function',
};
let ok = true;
for (const [k, v] of Object.entries(checks)) {
  if (!v) { ok = false; console.log('❌', k); }
}
console.log(ok ? '✅ 所有算法可用' : '❌ 有缺失');
console.log('htpasswd 函数:', typeof ctx.htpasswd);

// 功能冒烟测试
const enc = C.AES.encrypt('hello world', 'secret').toString();
const dec = C.AES.decrypt(enc, 'secret').toString(C.enc.Utf8);
console.log('AES 往返:', dec === 'hello world' ? 'OK' : 'FAIL');
console.log('MD5(hello):', C.MD5('hello').toString());
console.log('SHA3(hello):', C.SHA3('hello', { outputLength: 256 }).toString().slice(0, 16) + '…');
console.log('HmacSHA256(hello,k):', C.HmacSHA256('hello', 'k').toString().slice(0, 16) + '…');
