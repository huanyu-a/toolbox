// 隔离测试：allencrypt 8 文件单独加载
const fs = require('fs');
const vm = require('vm');
const BASE = 'C:/project/wwwroot/toolbox/public/static/script/';

function loadAll(files, label) {
  const sandbox = { console, window: {}, document: {}, localStorage: { getItem: () => null, setItem: () => {} } };
  sandbox.window = sandbox;
  sandbox.globalThis = sandbox;
  const ctx = vm.createContext(sandbox);
  for (const f of files) {
    const code = fs.readFileSync(BASE + f, 'utf8');
    try {
      vm.runInContext(code, ctx, { filename: f });
    } catch (e) {
      console.log(`⚠️ [${label}]`, f, '→', e.message.slice(0, 100));
    }
  }
  return ctx;
}

// 测试 1: allencrypt 8 文件
const hashFiles = ['encrypt/pcjson-md5.js', 'encrypt/pcjson-sha1.js', 'encrypt/pcjson-sha224.js',
  'encrypt/pcjson-sha256.js', 'encrypt/pcjson-sha384.js', 'encrypt/pcjson-sha512.js',
  'encrypt/pcjson-ripemd160.js', 'encrypt/pcjson-sha3.js'];
const c1 = loadAll(hashFiles, 'hash');
console.log('--- allencrypt 单独 ---');
console.log('MD5 函数:', typeof c1.CryptoJS?.MD5);
console.log('SHA3 函数:', typeof c1.CryptoJS?.SHA3);
if (typeof c1.CryptoJS?.MD5 === 'function') {
  console.log('MD5(hello):', c1.CryptoJS.MD5('hello').toString());
  console.log('SHA3(hello):', c1.CryptoJS.SHA3('hello', { outputLength: 256 }).toString().slice(0, 20));
  console.log('HmacSHA256:', c1.CryptoJS.HmacSHA256('hello', 'k').toString().slice(0, 20));
}

// 测试 2: deencrypt 5 文件 + hash 8 文件（模拟合并）
const c2 = loadAll(['pcjs/crypto-js.js', 'pcjs/aes.js', 'pcjs/rabbit.js', 'pcjs/rc4.js', 'pcjs/tripledes.js', ...hashFiles], 'merged');
console.log('--- 合并加载 ---');
console.log('AES:', typeof c2.CryptoJS?.AES?.encrypt);
console.log('MD5:', typeof c2.CryptoJS?.MD5);
console.log('SHA3:', typeof c2.CryptoJS?.SHA3);
if (typeof c2.CryptoJS?.MD5 === 'function') {
  console.log('MD5(hello):', c2.CryptoJS.MD5('hello').toString());
  console.log('SHA3(hello):', c2.CryptoJS.SHA3('hello', { outputLength: 256 }).toString().slice(0, 20));
}
const enc = c2.CryptoJS.AES.encrypt('hi', 'k').toString();
console.log('AES 往返:', c2.CryptoJS.AES.decrypt(enc, 'k').toString(c2.CryptoJS.enc.Utf8));
