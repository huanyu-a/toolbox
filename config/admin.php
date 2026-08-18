<?php
// 后台入口与前缀（隐藏性：真实入口由环境变量 ADMIN_PATH 控制，默认 portal）
// 建议在服务器部署时通过 environment: ADMIN_PATH=自定义隐蔽路径 覆盖，
// 公开仓库/README 中的 /portal 仅作默认示例，不暴露真实入口。
$adminPath = trim((string)getenv('ADMIN_PATH'), '/');
if ($adminPath === '') {
    $adminPath = 'portal';
}

return array (
  'username' => 'toolbox',
  'password' => 'Toolbox@2026',
  'path' => $adminPath,
);
