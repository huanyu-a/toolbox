#!/bin/sh
# 鍦ㄧ嚎宸ュ叿绠?瀹瑰櫒鍏ュ彛鑴氭湰
# 鍔熻兘锛氭寜鐜鍙橀噺鍒濆鍖栧悗鍙拌处鍙凤紙config/admin.php锛?
#   - USERNAME锛氬悗鍙扮敤鎴峰悕锛堥粯璁?admin锛?
#   - PASSWORD锛氬悗鍙板瘑鐮侊紙榛樿 admin锛?
# 璇存槑锛氫粎褰撴樉寮忚缃簡 USERNAME 鎴?PASSWORD 鏃舵墠瑕嗙洊閰嶇疆锛?
#       鏈缃椂浣跨敤闀滃儚鍐呯疆閰嶇疆锛堝悗鍙颁慨鏀圭殑瀵嗙爜鍦ㄩ噸鍚悗淇濈暀锛夈€?
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
    echo "[toolbox] 宸叉寜鐜鍙橀噺鍒濆鍖栧悗鍙拌处鍙? username=$USERNAME"
fi

exec "$@"
