# 🧰 寰宇的工具箱（Online Toolbox）

免费好用的**在线工具箱**，无需安装、打开即用。集成了 **54 款**常用开发 / 运维 / 站长 / AI Agent 工具，覆盖 JSON 格式化、代码格式化、编码转换、加密解密、单位换算、IP 查询、DNS 大全、正则测试、HTTP 请求头对照、Linux 命令查询、世界货币实时汇率、CLI 命令速查等。大部分工具在浏览器本地完成运算，**数据不离开你的设备**，安全不泄露。

> 在线体验：<https://tool.bx9y.com.cn>

> 📦 项目来源：[Shadownc/toolbox](https://github.com/Shadownc/toolbox)（二次开发：UI 重构、工具原生化合并、Agent 工具分类、SQLite 配置存储等）

---

## ✨ 功能特性

- 🧰 **54 款工具，7 大分类**：开发编程 12 / 文本处理 4 / 计算换算 7 / 网络运维 9 / 站长辅助 7 / 生活趣味 8 / Agent 命令速查 7
- 🔒 **本地运算**：纯前端工具在浏览器内计算，数据不上传服务器
- 🔍 **全站搜索面板**：首页 `Ctrl K` 呼出，工具名 / 描述模糊匹配、键盘导航、回车直达；顶部导航分类 hover 展开工具名
- ⭐ **收藏与足迹**：工具页一键星标收藏（首页展示常用收藏区块）、自动记录最近使用足迹、同分类相关推荐
- 🔄 **数据导出导入**：页脚「导出 / 导入数据」把收藏与足迹打包为 JSON 备份，导入自动合并去重（1MB 上限），换浏览器不丢数据
- 📴 **离线可用（PWA）**：Service Worker 缓存静态资源与已访问页面，断网也能打开；支持安装到主屏幕（manifest.json）
- 🎯 **一键示例数据**：每个工具页「示例数据」按钮自动填充演示内容并触发计算，全部工具页均已配置并逐一校验
- 💱 **实时汇率**：世界货币查询内置 60 秒级实时汇率接口
- 🛡️ **百度统计混淆防爬**：后台填 ID 即自动注入防广告拦截器识别的混淆统计代码
- 🔐 **安全加固**：全站安全响应头（X-Frame-Options / nosniff / Referrer-Policy / Permissions-Policy）、会话 Cookie HttpOnly / Secure / SameSite、出站请求 SSRF 防护、动态 robots.txt 不泄露真实后台路径
- ⚙️ **可视化后台**：网站配置（TDK / 名称 / 域名）、顶部导航、页脚、友情链接、账号、缓存、文件管理
- 🔎 **SEO 友好**：动态站点地图（sitemap.xml）、JSON-LD 结构化数据、全站可配置 TDK、自定义 404 页
- 🎨 **三态主题**：亮 / 暗 / 跟随系统，全站（含后台与速查页）适配深色模式

## 🗂 内置工具一览

| 分类 | 工具 |
| --- | --- |
| **开发编程** | JSON 工具箱、代码格式化、HTML 转 JS、正则表达式、JS 加密混淆、加密解密、编码转换、在线运行 JS/HTML、XPath、Bootstrap 图标、Android 权限、条形码生成 |
| **文本处理** | 在线编辑器、文章排版、文本转换、文本工具 |
| **计算换算** | 科学计算器、单位换算、利率计算器、子网掩码、随机数/密码、数值转换、世界货币查询 |
| **网络运维** | 网站检测、IP 查询、DNS 大全、WebSocket 测试、浏览器信息、定时刷新、端口大全、Linux 命令、htaccess 转 nginx |
| **站长辅助** | Meta 标签、桌面快捷方式、ico 制作、User-Agent、Content-Type、HTTP 请求头、UUID 生成 |
| **生活趣味** | 在线涂鸦、区号时差、世界节日、历史朝代、少数民族、特殊符号、历史上的今天、按键码测试 |
| **Agent** | Hermes、Claude Code、OpenAI Codex、OpenClaw、OpenCode、Pi、DeepSeek Harness 命令速查 |

工具注册表统一维护在 `config/tools.php`（分类、URL、名称、描述），新增工具只需加一条记录 + 对应视图页。

## 🧱 技术栈

- **后端**：ThinkPHP 5.1（PHP ≥ 5.6）
- **前端**：Bootstrap 3 + jQuery + 原生 JS（无构建步骤）
- **数据**：无需 MySQL — 站点配置 / 友情链接存 SQLite（`runtime/site_config.db`），IP 归属地使用 `QQWry.dat`
- **验证码**：cccyun/think-captcha
- **图标**：Font Awesome 自托管（含 brands）
- **离线 / 安装**：Service Worker（`public/service-worker.js`）+ PWA manifest
- **部署**：Docker（生产 + 开发双镜像，Nginx / php-fpm）

## 📁 目录结构

```
toolbox/
├── application/          # 应用代码（index 前台 / admin 后台）
├── config/               # 配置（admin 账号、web 全站 TDK、tools 工具导航、tongji 旧版统计）
├── docker/               # Docker 部署（生产 Dockerfile / compose / 开发镜像）
├── extend/               # 扩展库（IP 查询等）
├── public/               # Web 根目录（入口 index.php、静态资源、service-worker.js、manifest.json、404 页）
├── route/                # 路由配置
├── runtime/              # 运行缓存、日志与 site_config.db（SQLite 配置库，可写）
├── QQWry.dat             # 纯真 IP 数据库（运行时依赖，勿删）
└── vendor/               # Composer 依赖
```

---

## 🚀 Docker 部署

### 方式一：docker compose（推荐）

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

### 方式二：docker run（直接运行）

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
    -e PASSWORD=admin \
    toolbox:latest
```

### 启动后访问

- 前台首页：`http://<服务器IP>:8080`
- 后台管理：`http://<服务器IP>:8080/portal/`（或 `ADMIN_PATH` 指定的自定义路径）

### 环境变量

| 变量 | 说明 | 默认值 |
| --- | --- | --- |
| `USERNAME` | 后台登录用户名（仅显式设置时写入） | `admin` |
| `PASSWORD` | 后台登录密码（仅显式设置时写入） | `admin` |
| `ADMIN_PATH` | 后台入口路径（隐蔽性：设为自定义路径可隐藏后台入口） | `portal` |
| `TZ` | 容器时区 | `Asia/Shanghai` |

> 仅当显式设置 `USERNAME` / `PASSWORD` 时才写入 `config/admin.php`；未设置时使用镜像内置配置，后台修改会在容器重启后保留。**生产环境务必修改默认密码并通过 `ADMIN_PATH` 隐藏后台入口。**

### 数据持久化

compose 部署默认挂载两个 volume，重启 / 重建不丢失数据：

- `toolbox-config` → `/var/www/html/config`（后台账号等文件配置）
- `toolbox-runtime` → `/var/www/html/runtime`（运行缓存、日志、**SQLite 配置库 site_config.db**）

站点配置（网站名称 / TDK / 域名 / 百度统计 / 友情链接）存于 `runtime/site_config.db`，随 runtime 卷持久化，更新镜像不丢失。如需备份，备份 `config/` 与 `runtime/site_config.db` 即可。

### 健康检查

镜像内置 HEALTHCHECK，每 30 秒请求首页探测，失败 3 次标记 unhealthy：

```bash
docker inspect --format '{{.State.Health.Status}}' toolbox
```

---

## 🛠 本地开发

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

开发镜像内置 `php -S`，配合 `public/router.php` 实现 URL 重写，**修改代码即时生效**。

### 方式二：宿主机直接运行

```bash
# 要求 PHP >= 5.6（建议 7.x）且已安装 GD、PDO_SQLite 扩展
php -S 0.0.0.0:8080 -t public public/router.php
```

---

## 🔐 后台管理

- 入口：`/portal/`（可通过环境变量 `ADMIN_PATH` 改为任意隐蔽路径，如 `/mgr-xxxx/`）
- 默认账号：`admin` / `admin`（通过环境变量或后台「修改密码」调整）
- 功能：网站配置（网站名称、页面 TDK、站点域名、顶部导航、页脚）、**友情链接管理**（增删改查 / 排序 / nofollow）、账号管理、清除缓存、文件管理、**百度统计**

> 「网站名称」「站点域名」均已字段化：前台标题、导航、页脚、SEO 标签、绝对 URL 均从后台配置读取，修改后全站生效。友情链接存 SQLite `friend_links` 表，首次访问自动从旧版 HTML 配置迁移。

### 📊 百度统计（混淆防爬）

后台「百度统计」填入统计 ID 并启用，**程序自动生成混淆防爬代码**注入全站页面：

- 域名以字符数组 + `String.fromCharCode(46)` 动态拼接，页面源码不出现整段明文 `hm.baidu.com`
- 可绕过主流广告拦截器（AdBlock / uBlock 等）和爬虫的关键词识别
- 启用才注入，停用即无额外流量
- 配置存 SQLite；旧版 `config/tongji.php` 仅在库中从未配置且含真实数据时做一次性迁移

---

## 🎨 前端约定

### 静态资源缓存版本号

所有视图引用 CSS / JS 均带 `?v=` 查询参数（当前 `v=2026083026`）：

- **修改任何 CSS / JS 后必须同步提升对应引用的 `?v=`**，否则用户浏览器命中旧缓存看不到更新
- 批量更新：`grep -rl "旧版本号" application/index/view/ | xargs sed -i "s/旧版本号/新版本号/g"`

### Service Worker（离线缓存）

`public/service-worker.js` 采用双缓存策略：

- 静态资源（`/static/` 且带 `?v=`）：cache-first（immutable）
- 页面导航：network-first + LRU 上限 30 条，断网回退最近缓存
- ⚠️ **变更 SW 逻辑必须同时提升文件内的 `CACHE` 版本号**（如 `tb-static-v1` → `tb-static-v2`），否则旧缓存不淘汰

### 浏览器本地存储

收藏（`toolbox_pins`）、足迹（`toolbox_history`）、主题（`toolbox_theme`）均存 localStorage；前两者可从页脚导出为 JSON 备份文件并跨设备导入（合并去重）。

---

## 🔐 安全设计

- **安全响应头**（`application/common.php` 全局注入）：`X-Frame-Options: SAMEORIGIN`、`X-Content-Type-Options: nosniff`、`Referrer-Policy: strict-origin-when-cross-origin`、`Permissions-Policy`（禁用摄像头 / 麦克风 / 定位等）、移除 `X-Powered-By`
- **会话与 Cookie**：HttpOnly + SameSite=Lax，HTTPS 下自动启用 Secure 标志
- **SSRF 防护**：所有服务端出站请求（网站检测 / IP 查询等）统一经 `curl_safe_target()` 校验目标，禁止内网地址与非常规协议
- **后台隐蔽**：`ADMIN_PATH` 自定义入口路径；动态 `robots.txt` 只输出无害诱饵路径（如 `/admin`），**绝不输出真实后台路径**
- **登录保护**：验证码 + 登录限速，后台所有方法强制 `checkLogin` 校验
- **输出安全**：前端结果一律 `textContent` 注入，禁止 `innerHTML` 拼接用户输入

---

## ⚠️ 注意事项

- `QQWry.dat` 为 IP 归属地数据库（约 10MB），为运行时依赖，**请勿删除**
- `runtime/` 目录需保持可写（SQLite 配置库也在此，容器内已自动授权 `www-data`）；后台「清除缓存」**不会**删除 `site_config.db`（站点配置库，删了会丢后台数据）
- PHP 需启用 `pdo_sqlite` 扩展（镜像已内置；宿主机直跑需自行确认）
- 后台「网站配置」保存时会重写 `config/web.php`，请确保该文件可写
- 修改 CSS / JS 必须同步提升视图中的 `?v=` 版本号；修改 service-worker.js 必须同步提升其 `CACHE` 版本号（见上文「前端约定」）
- 生产环境建议开启 HTTPS（反向代理或云负载均衡终结 SSL），并在后台固定「站点域名」以保证 SEO URL 一致

## 📄 License

[MIT](./LICENSE) © 寰宇
