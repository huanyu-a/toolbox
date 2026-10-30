#!/bin/sh
# title: 在线工具箱容器入口
# desc: 容器启动时按 USERNAME/PASSWORD 环境变量初始化后台账号（未设置时用镜像内置配置）。

# 说明：仅当显式设置了 USERNAME 或 PASSWORD 时才覆盖配置；
#       未设置时使用镜像内置配置（后台修改的密码在重启后保留）。
set -e

if [ -n "$USERNAME" ] || [ -n "$PASSWORD" ]; then
    USERNAME="${USERNAME:-admin}"
    PASSWORD="${PASSWORD:-admin}"
    cat > /var/www/html/config/admin.php <<EOF
<?php
return array (
  'username' => '$USERNAME',
  'password' => '$PASSWORD',
);
EOF
    echo "[toolbox] 已按环境变量初始化后台账号 username=$USERNAME"
fi

exec "$@"