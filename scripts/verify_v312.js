// 统一 v3.1.2 系列加载测试
const fs = require('fs');
const vm = require('vm');
const BASE = 'C:/project/wwwroot/toolbox/public/static/script/';

const files = [
  'encrypt/pcjson-aes.js',    // AES (v3.1.2)
  'encrypt/tripledes.js',     // DES + TripleDES
  'encrypt/rabbit.js',        // Rabbit
  'encrypt/rc4.js',           // RC4
  'encrypt/pcjson-md5.js', 'encrypt/pcjson-sha1.js', 'encrypt/pcjson-sha224.js',
  'encrypt/pcjson-sha256.js', 'encrypt/pcjson-sha384.js', 'encrypt/pcjson-sha512.js',
  'encrypt/pcjson-ripemd160.js', 'encrypt/pcjson-sha3.js',
];

const sandbox = { console, window: {}, document: {}, localStorage: { getItem: () => null, setItem: () => {} } };
sandbox.window = sandbox;
sandbox.globalThis = sandbox;
const ctx = vm.createContext(sandbox);
for (const f of files) {
  const code = fs.readFileSync(BASE + f, 'utf8');
  try {
    vm.runInContext(code, ctx, { filename: f });
  } catch (e) {
    console.log('⚠️', f, '→', e.message.slice(0, 100));
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
  'HmacSHA1': typeof C.HmacSHA1 === 'function',
  'HmacSHA256': typeof C.HmacSHA256 === 'function',
  'HmacSHA512': typeof C.HmacSHA512 === 'function',
};
let ok = true;
for (const [k, v] of Object.entries(checks)) {
  if (!v) { ok = false; console.log('❌', k); }
}
console.log(ok ? '✅ 17 项算法全部可用' : '❌ 有缺失');

// 功能测试
const enc = C.AES.encrypt('hello world', 'secret').toString();
console.log('AES 往返:', C.AES.decrypt(enc, 'secret').toString(C.enc.Utf8) === 'hello world' ? 'OK' : 'FAIL');
const enc2 = C.TripleDES.encrypt('hello world', 'secret').toString();
console.log('TripleDES 往返:', C.TripleDES.decrypt(enc2, 'secret').toString(C.enc.Utf8) === 'hello world' ? 'OK' : 'FAIL');
const enc3 = C.Rabbit.encrypt('hello', 'k').toString();
console.log('Rabbit 往返:', C.Rabbit.decrypt(enc3, 'k').toString(C.enc.Utf8) === 'hello' ? 'OK' : 'FAIL');
const enc4 = C.RC4.encrypt('hello', 'k').toString();
console.log('RC4 往返:', C.RC4.decrypt(enc4, 'k').toString(C.enc.Utf8) === 'hello' ? 'OK' : 'FAIL');
const enc5 = C.DES.encrypt('hello', 'k').toString();
console.log('DES 往返:', C.DES.decrypt(enc5, 'k').toString(C.enc.Utf8) === 'hello' ? 'OK' : 'FAIL');
console.log('MD5(hello):', C.MD5('hello').toString() === '5d41402abc4b2a76b9719d911017c592' ? 'OK(标准值)' : 'FAIL');
console.log('SHA3(hello):', C.SHA3('hello', { outputLength: 256 }).toString().slice(0, 16));
console.log('HmacSHA256(hello,k):', C.HmacSHA256('hello', 'k').toString().slice(0, 16));
