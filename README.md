# 在线工具箱

免费好用的在线工具大全：JSON 格式化、代码格式化、编码转换、加密解密、单位换算、IP 查询、DNS 大全、正则测试、HTTP 请求头对照、Linux 命令查询等 40+ 款工具，无需安装、打开即用。大部分工具在浏览器本地完成运算，数据安全不泄露。

## 功能特性

- 40+ 款常用开发 / 运维 / 站长工具，按分类导航
- 纯前端计算的工具本地运行，不上传数据
- 支持工具搜索与快捷筛选
- 后台管理：网站配置（TDK、网站名称、顶部导航、页脚、友情链接）、账号管理、缓存清理、在线文件管理
- SEO 友好：动态站点地图、结构化数据、可配置 TDK

## 技术栈

- ThinkPHP 5.1（PHP >= 5.6）
- Bootstrap 3 + jQuery（前端）
- 无数据库依赖（配置存文件，IP 库使用 QQWry.dat）
- 后台验证码：cccyun/think-captcha

## 目录结构

```
toolbox/
├── application/          # 应用代码（index 前台 / admin 后台）
├── config/               # 配置（admin 账号、web 全站 TDK、tools 工具导航）
├── docker/               # Docker 部署文件（生产 Dockerfile / compose / 开发镜像）
├── extend/               # 扩展库（IP 查询等）
├── public/               # Web 根目录（入口 index.php、静态资源）
├── route/                # 路由配置
├── runtime/              # 运行缓存与日志（可写）
├── QQWry.dat             # 纯真 IP 数据库（运行时依赖，勿删）
└── vendor/               # Composer 依赖
```

## Docker 部署

### 方式一：docker run（直接运行）

```bash
# 进入项目根目录
cd toolbox

# 构建镜像
docker build -f docker/Dockerfile -t toolbox:latest .

# 运行（8080 端口映射到容器 80）
docker run -d --name toolbox \
    --restart unless-stopped \
    -p 8080:80 \
    -e USERNAME=admin \
    -e PASSWORD=你的密码 \
    toolbox:latest
```

### 方式二：docker compose（推荐）

```bash
cd toolbox/docker

# 构建并启动
docker compose up -d

# 查看状态与日志
docker compose ps
docker compose logs -f

# 停止
docker compose down
```

启动后访问：

- 前台首页：`http://<服务器IP>:8080`
- 后台管理：`http://<服务器IP>:8080/admin`

### 环境变量

| 变量 | 说明 | 默认值 |
| --- | --- | --- |
| `USERNAME` | 后台登录用户名（仅首次启动写入） | `admin` |
| `PASSWORD` | 后台登录密码（仅首次启动写入） | `admin` |
| `TZ` | 容器时区 | `Asia/Shanghai` |

> 说明：仅当显式设置了 `USERNAME` / `PASSWORD` 时才写入 `config/admin.php`。未设置时使用镜像内置配置；后台修改的密码在容器重启后保留（除非重新设置环境变量）。

### 数据持久化

compose 部署默认挂载两个 volume，重启 / 重建容器不丢失数据：

- `toolbox-config` → `/var/www/html/config`（后台网站配置、账号配置）
- `toolbox-runtime` → `/var/www/html/runtime`（运行缓存与日志）

如需备份，直接备份 `config/` 目录即可。

### 健康检查

镜像内置 HEALTHCHECK，每 30 秒请求首页探测，失败 3 次标记 unhealthy。可用 `docker inspect --format '{{.State.Health.Status}}' toolbox` 查看。

## 本地开发

### 方式一：Docker 开发容器（推荐）

```bash
# 构建开发镜像
docker build -f docker/dev.Dockerfile -t toolbox-dev .

# 运行（挂载当前目录，代码热更新）
docker run -d --name toolbox-dev \
    -p 18080:80 \
    -v $(pwd):/app \
    toolbox-dev

# 访问 http://localhost:18080
```

开发镜像内置 `php -S` 服务器，配合 `public/router.php` 实现 URL 重写，修改代码即时生效。

### 方式二：宿主机直接运行

```bash
# 要求 PHP >= 5.6（建议 7.x）且已安装 GD 扩展
php -S 0.0.0.0:8080 -t public public/router.php
```

## 后台管理

- 地址：`/admin`（登录页 `http://<host>:<port>/admin/index/login.html`）
- 默认账号：`admin` / `admin`（通过环境变量或后台"修改密码"调整）
- 功能：网站配置（网站名称、页面 TDK、顶部导航、页脚、友情链接）、清除缓存、文件管理、修改密码

> 网站名称已字段化：前台标题、导航、页脚、SEO 标签、全部工具页标题均从后台"网站配置 → 网站信息 → 网站名称"读取，修改后全站生效。

## 注意事项

- `QQWry.dat` 为 IP 归属地数据库（约 10MB），为运行时依赖，请勿删除
- `runtime/` 目录需保持可写（容器内已自动授权 www-data）
- 后台"网站配置"保存后会重写 `config/web.php`，请确保该文件可写
- 生产环境建议开启 HTTPS（反向代理或云负载均衡终结 SSL）
