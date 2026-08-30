# 在线工具箱 生产镜像
# 基于 php:7.2-apache（Debian buster），内置 Apache + URL 重写 + GD 扩展
FROM php:7.2-apache

# buster 已进入 Debian 归档，切换 apt 源到 archive.debian.org
RUN set -eux; \
    printf 'deb http://archive.debian.org/debian buster main\ndeb http://archive.debian.org/debian-security buster/updates main\n' > /etc/apt/sources.list; \
    apt-get -o Acquire::Check-Valid-Until=false update \
    && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        curl \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# 时区（默认 Asia/Shanghai，可用 TZ 环境变量覆盖）
ENV TZ=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# 站点代码
WORKDIR /var/www/html
COPY . /var/www/html/

# Apache：DocumentRoot 指向 public（ThinkPHP 入口），启用 .htaccess 重写与静态缓存
RUN printf '<VirtualHost *:80>\n  DocumentRoot /var/www/html/public\n  <Directory /var/www/html/public/>\n    Options -Indexes +FollowSymLinks\n    AllowOverride All\n    Require all granted\n  </Directory>\n</VirtualHost>\n' > /etc/apache2/sites-available/000-default.conf \
    && mkdir -p runtime/cache runtime/temp runtime/log \
    && chown -R www-data:www-data /var/www/html/runtime \
    && chown www-data:www-data /var/www/html/config

# 入口脚本：支持 USERNAME/PASSWORD 环境变量初始化后台账号
COPY docker/entrypoint.sh /usr/local/bin/docker-entrypoint-custom.sh
RUN chmod +x /usr/local/bin/docker-entrypoint-custom.sh

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=15s --retries=3 \
    CMD curl -fsS http://127.0.0.1/ > /dev/null || exit 1

ENTRYPOINT ["/usr/local/bin/docker-entrypoint-custom.sh"]
CMD ["apache2-foreground"]
