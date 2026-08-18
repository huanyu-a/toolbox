# 在线工具箱 开发镜像
# 基于 php:7.2-cli，内置 PHP 开发服务器（-t public），配合 public/router.php 实现 URL 重写
# 用法（挂载当前目录到 /app）：
#   docker run -d --name toolbox-dev -p 18080:80 -v $(pwd):/app toolbox-dev
#   访问 http://localhost:18080
FROM php:7.2-cli

# buster 已进入 Debian 归档，切换 apt 源到 archive.debian.org
RUN set -eux; \
    printf 'deb http://archive.debian.org/debian buster main\ndeb http://archive.debian.org/debian-security buster/updates main\n' > /etc/apt/sources.list; \
    apt-get -o Acquire::Check-Valid-Until=false update \
    && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && rm -rf /var/lib/apt/lists/*

# 时区（默认 Asia/Shanghai，可用 TZ 环境变量覆盖）
ENV TZ=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /app
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "public", "public/router.php"]
