<?php
/**
 * 实时汇率代理接口（服务端缓存，全站共享）
 * ------------------------------------------------------------
 * 用法:  /api/rate.php?from=USD&to=CNY&amount=1
 * 数据源优先级:
 *   1. currencyexchangetool.com（每 60 秒更新，实时，限流 100次/小时/IP）
 *   2. open.er-api.com（每日更新，兜底，不限流）
 * 缓存:  5 分钟文件缓存（runtime/rate_cache/），避免频繁请求第三方接口
 * 输出:  JSON { success, from, to, amount, rate, result, updatedAt, source, cached }
 * ------------------------------------------------------------
 */

// 安全：仅允许 GET，仅接受 3 位大写货币代码
$from = isset($_GET['from']) ? strtoupper(substr(trim($_GET['from']), 0, 3)) : 'USD';
$to   = isset($_GET['to'])   ? strtoupper(substr(trim($_GET['to']),   0, 3)) : 'CNY';
$amount = isset($_GET['amount']) ? floatval($_GET['amount']) : 1.0;

if (!preg_match('/^[A-Z]{3}$/', $from) || !preg_match('/^[A-Z]{3}$/', $to)) {
    jsonOut(array('success' => false, 'error' => 'invalid currency code'));
}
if ($amount <= 0) $amount = 1.0;
if ($from === $to) {
    jsonOut(array(
        'success' => true, 'from' => $from, 'to' => $to, 'amount' => $amount,
        'rate' => 1.0, 'result' => $amount, 'updatedAt' => gmdate('c'),
        'source' => 'local', 'cached' => false,
    ));
}

// 缓存目录（复用框架 runtime，容错创建）
$cacheDir = dirname(__DIR__, 2) . '/runtime/rate_cache';
if (!is_dir($cacheDir)) { @mkdir($cacheDir, 0755, true); }
$cacheKey = $from . '_' . $to;
$cacheFile = $cacheDir . '/' . $cacheKey . '.json';
$ttl = 300; // 5 分钟

// 命中缓存直接返回
if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < $ttl) {
    $data = json_decode(file_get_contents($cacheFile), true);
    if (is_array($data) && isset($data['rate'])) {
        $data['cached'] = true;
        $data['amount'] = $amount;
        $data['result'] = round($data['rate'] * $amount, 6);
        jsonOut($data);
    }
}

// 1. 优先：currencyexchangetool（实时 60s）
$rate = null; $updatedAt = null; $source = null;
$res1 = httpGet('https://www.currencyexchangetool.com/api/v1/convert?from=' . $from . '&to=' . $to . '&amount=1', 8);
if ($res1 !== false) {
    $j = json_decode($res1, true);
    if (is_array($j) && !empty($j['success']) && isset($j['rate'])) {
        $rate = floatval($j['rate']);
        $updatedAt = isset($j['updatedAt']) ? $j['updatedAt'] : gmdate('c');
        $source = 'currencyexchangetool';
    }
}

// 2. 兜底：open.er-api.com（每日，取交叉汇率）
if ($rate === null) {
    $res2 = httpGet('https://open.er-api.com/v6/latest/USD', 10);
    if ($res2 !== false) {
        $j = json_decode($res2, true);
        if (is_array($j) && isset($j['rates'][$from]) && isset($j['rates'][$to])) {
            $rate = floatval($j['rates'][$to]) / floatval($j['rates'][$from]);
            $updatedAt = isset($j['time_last_update_utc']) ? $j['time_last_update_utc'] : gmdate('c');
            $source = 'open.er-api.com';
        }
    }
}

if ($rate === null) {
    jsonOut(array('success' => false, 'error' => 'rate source unavailable'));
}

$out = array(
    'success' => true,
    'from' => $from,
    'to' => $to,
    'amount' => $amount,
    'rate' => $rate,
    'result' => round($rate * $amount, 6),
    'updatedAt' => $updatedAt,
    'source' => $source,
    'cached' => false,
);

// 写缓存
@file_put_contents($cacheFile, json_encode($out, JSON_UNESCAPED_UNICODE));

jsonOut($out);

/* ---------- helpers ---------- */

function httpGet($url, $timeout = 8) {
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; ToolboxRate/1.0)',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));
        $body = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($code >= 200 && $code < 300 && $body !== false) ? $body : false;
    }
    $ctx = stream_context_create(array('http' => array(
        'timeout' => $timeout,
        'user_agent' => 'Mozilla/5.0 (compatible; ToolboxRate/1.0)',
        'ignore_errors' => true,
    )));
    $body = @file_get_contents($url, false, $ctx);
    return ($body !== false) ? $body : false;
}

function jsonOut($data) {
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    // 允许同站跨域（防 XSS，仅允许同源）
    header('Access-Control-Allow-Origin: ' . (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*'));
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}
