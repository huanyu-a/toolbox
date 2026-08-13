// 验证 html2js 拆分后的标签拼接等价性（模拟修改后的 JS 逻辑）
function toJsp(s) {
    if (s === '') return '<' + '%\n%' + '>';
    var out = 'out.println("';
    for (var c = 0; c < s.length; c++) {
        if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
            out += '");';
            if (c !== s.length - 1) out += '\nout.println("';
            c++;
        } else if (s.charAt(c) === '"') {
            out += '\\"';
        } else if (s.charAt(c) === '\\') {
            out += '\\\\';
        } else {
            out += s.charAt(c);
            if (c === s.length - 1) out += '");';
        }
    }
    return '<' + '%\n' + out + '\n%' + '>';
}
function toPhp(s) {
    if (s === '') return '<' + '?php\n?' + '>';
    var out = 'echo "';
    for (var c = 0; c < s.length; c++) {
        if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
            out += '\\n";';
            if (c !== s.length - 1) out += '\necho "';
            c++;
        } else if (s.charAt(c) === '"') {
            out += '\\"';
        } else if (s.charAt(c) === '\\') {
            out += '\\\\';
        } else {
            out += s.charAt(c);
            if (c === s.length - 1) out += '\\n";';
        }
    }
    return '<' + '?php\n' + out + '\n?' + '>';
}
function toAsp(s) {
    if (s === '') return '<' + '%\n%' + '>';
    var out = 'Response.Write "';
    for (var c = 0; c < s.length; c++) {
        if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
            out += '"';
            if (c !== s.length - 1) out += '\nResponse.Write "';
            c++;
        } else if (s.charAt(c) === '"') {
            out += '""';
        } else if (s.charAt(c) === '\\') {
            out += '\\\\';
        } else {
            out += s.charAt(c);
            if (c === s.length - 1) out += '"';
        }
    }
    return '<' + '%\n' + out + '\n%' + '>';
}
function toVbnet(s) {
    if (s === '') return '<' + '%\n%' + '>';
    var out = 'Response.Write ("';
    for (var c = 0; c < s.length; c++) {
        if (s.charAt(c) === '\n' || s.charAt(c) === '\r') {
            out += '");';
            if (c !== s.length - 1) out += '\nResponse.Write ("';
            c++;
        } else if (s.charAt(c) === '"') {
            out += '""';
        } else if (s.charAt(c) === '\\') {
            out += '\\\\';
        } else {
            out += s.charAt(c);
            if (c === s.length - 1) out += '");';
        }
    }
    return '<' + '%\n' + out + '\n%' + '>';
}

var input = '<div class="box">你好</div>';
console.log('--- toJsp ---');
console.log(toJsp(input));
console.log('--- toPhp ---');
console.log(toPhp(input));
console.log('--- toAsp ---');
console.log(toAsp(input));
console.log('--- toVbnet ---');
console.log(toVbnet(input));
console.log('--- 空输入 ---');
console.log(JSON.stringify(toJsp('')), JSON.stringify(toPhp('')), JSON.stringify(toAsp('')), JSON.stringify(toVbnet('')));
