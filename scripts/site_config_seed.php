<?php
/**
 * 站点配置导入工具（CLI 专用，一次性使用）
 *
 * 用法：
 *   php site_config_seed.php /path/to/seed.json
 *
 * seed.json 支持（均可选）：
 *   {
 *     "friend_links_html": "<div class=\"friend-link-row\">...</div>",
 *     "tongji_enabled": 1,
 *     "tongji_baidu_id": "xxxxxxxxxxxxxxxx"
 *   }
 *
 * 说明：数据写入 runtime/site_config.db（Docker 挂载卷），
 * 镜像重建/容器更新后依然生效。
 */
if (PHP_SAPI !== 'cli') {
    exit("CLI only\n");
}
$root = dirname(__DIR__);
if (!defined('RUNTIME_PATH')) {
    define('RUNTIME_PATH', rtrim($root, '/\\') . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR);
}
require $root . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'common.php';

if (!isset($argv[1]) || !is_file($argv[1])) {
    exit("Usage: php site_config_seed.php <seed.json>\n");
}
$data = json_decode((string)file_get_contents($argv[1]), true);
if (!is_array($data)) {
    exit("Invalid JSON\n");
}

if (array_key_exists('friend_links_html', $data)) {
    site_cfg_set('friend_links_html', (string)$data['friend_links_html']);
    echo "friend_links_html: seeded (" . strlen((string)$data['friend_links_html']) . " bytes)\n";
}
if (array_key_exists('tongji_enabled', $data)) {
    site_cfg_set('tongji_enabled', !empty($data['tongji_enabled']) ? '1' : '0');
    echo "tongji_enabled: " . (!empty($data['tongji_enabled']) ? '1' : '0') . "\n";
}
if (array_key_exists('tongji_baidu_id', $data)) {
    $id = trim((string)$data['tongji_baidu_id']);
    site_cfg_set('tongji_baidu_id', preg_match('/^[a-zA-Z0-9]+$/', $id) ? $id : '');
    echo "tongji_baidu_id: seeded\n";
}
echo "done.\n";
