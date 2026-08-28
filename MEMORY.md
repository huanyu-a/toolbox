# 项目记忆 — 寰宇的工具箱（toolbox）

> 来源：汇总自 OpenSquilla 全部历史会话记录（main 主会话 21 个 + 子智能体会话 24 个，
> 时间跨度 2026-08-03 ~ 2026-08-25）+ git 历史 + 当前代码状态。
> 最后凝练时间：2026-08-28（UTC+8）。

## 1. 项目基本盘

- **项目**：寰宇的工具箱 —— 免费在线工具箱站，无需安装、打开即用
- **线上地址**：https://tool.bx9y.com.cn
- **来源**：基于 https://github.com/Shadownc/toolbox 二次开发（README 已标注来源）
- **本地路径**：`C:\project\wwwroot\toolbox`（Windows 11，用户 WIN11）
- **技术栈**：ThinkPHP 5.1（PHP ≥ 5.6）+ Bootstrap 3 + jQuery + 原生 JS（无构建步骤）；**无 MySQL** — 站点配置/友链存 SQLite（`runtime/site_config.db`，common.php 的 site_cfg_* 函数族）；QQWry.dat 纯真 IP 库（约 10MB，运行时依赖，勿删）；验证码 cccyun/think-captcha；FA 自托管
- **部署**：Docker 生产镜像（docker/ 目录，Nginx + php-fpm），compose 挂载两个 volume：`toolbox-config` → /var/www/html/config、`toolbox-runtime` → /var/www/html/runtime；镜像内置 HEALTHCHECK（30s 探测首页）
- **本地开发**：`docker build -f docker/dev.Dockerfile -t toolbox-dev .` 后挂载目录运行，端口 **18080**，`php -S` + public/router.php 热更新（用户也用过 18081）
- **后台**：公开仓库默认入口 `/portal/`（`ADMIN_PATH` 环境变量可覆盖），**生产真实入口为隐蔽路径（凭据不入库，写在 `.zcode/` 下的本地备忘，git 忽略）**；账号密码同理见本地备忘；后台功能：网站配置（TDK/名称/域名/导航/页脚）、友链管理（SQLite friend_links 表）、账号、缓存、文件管理、**百度统计**（配置存 SQLite，旧 config/tongji.php 仅含真实数据时一次性迁移）
- **仓库**：GitHub 公开仓库，origin/main；服务器同步走 **SSH（本机已配好 ssh config，2026-08-25 起可直接用）**，部署前先备份本地化数据

## 2. 功能演进时间线（按会话日期）

| 日期 | 阶段 | 关键内容 |
| --- | --- | --- |
| 08-03 ~ 08-06 | 环境搭建 | 安装 OpenSquilla、测试模型路由（deepseek/glm/qwen 多档）、MCP 连通测试、logo+ico 设计（该次样式事故已回滚） |
| 08-12 | **前端重构 I** | 全站工具页统一"新皮肤"（tool-card 骨架）；8 个样板页（utf8.md5 等）确立标准形态；编辑器迭代（vditor，支持 HTML + Markdown + 互转 + 复制TXT + 纯文本复制，修复 ** 粘贴转义问题）；移动端导航改右下角悬浮按钮（分类/搜索/主题切换同款模式） |
| 08-12 晚 ~ 08-13 | **批量原生化 + 工具合并** | 并行子智能体把 150+ 工具页从"新皮肤+旧交互"升级为"新皮肤+原生JS"；随后同类工具合并成 tab 页（json、format、regex、html2js 全家桶等）；导航分类重组；删除全部 301 重定向与 mergeMap 拦截逻辑（未上线，不存在 URL 不做多余处理）；linuxcmd 改 t-tabs + 搜索；subnetmask 旧骨架页重做（保留全部 input id） |
| 08-17 ~ 08-18 | **首页 UI 重构** | 多次推翻重做（用户否决了初版"AI 风格"）；最终参考 tool.zgws.net / tool.lu / iamwawa.cn / tool.browser.qq.com 布局 + Anthropic 配色；工具页配色同步；**每个工具加"示例数据"按钮**并逐站校验；TDK 全站重写（突出"在线"特性，尽量用模板变量）；百度统计混淆防爬功能（只填 ID 自动注入）；货币工具接实时汇率；修复 floatCatNav、editor 双示例按钮、currency 按钮位置等问题；README 优化 + 来源标注 |
| 08-19 ~ 08-20 | 修补与上线 | webcheck 修接口（/api/ 目录冲突 403 → 改 **/doapi/** 路由）；webcheck 删与 Gzip 检测重复的 HTTP 状态码面板（wcCode），精简为 5 tab；ICP 查询识别 uapis"查询失败"占位；ip 加"当前 IP"；lishishangdejintian 换在线接口；tesufuhao 分 tab + emoji 乱码修复 + hover 显示名称；linuxcmd 恢复点击复制；xpath 修复；首页改纯项目介绍（不放工具列表）；顶部导航分类 hover 展开工具名（去掉点击跳转）；移动端分类导航修复；工具页顶栏/页脚与首页统一；版权年份更新 |
| 08-25 | **Agent 分类新工具** | 参考 hermes 命令速查（hermescmd）新增 6 个 AI Agent 命令速查工具：Claude Code、Codex、OpenClaw、OpenCode、Pi、DeepSeek Harness（含 TDK）；部署到远程服务器（SSH） |
| 08-26 | 会话清理 | 删除 toolbox 项目下其余全部会话（41 个：21 主会话 + 20 子智能体，含 7 个孤儿目录），仅保留当前会话；备份在 `backup/sessions-backup-2026-08-26/`（sessions.db.bak + 48 个 turn 目录 + delete_keys.json） |
| 08-27 | 视觉与配置 | FAB/回顶按钮统一 40px 圆、FA 图标化；足迹边距、下拉不裁切；后台新增「站点域名」字段 + 前端绝对 URL（site_base()）；深色模式全覆盖 |
| 08-28 | 当前 | 54 个注册工具（7 分类）+ 56 个视图页（caiji 未注册）；README 全面更新；MEMORY.md 移出 git 跟踪并脱敏 |

## 3. 核心工程规范（子智能体任务书中反复出现的约束，必须遵守）

### 工具页标准形态（样板：utf8.html / md5.html；tab 页样板：calc.html / json.html）
- head 块（title `{$Think.config.web.<页名>.title}`、SEO、meta、favicon、site.min.css、IE 条件注释、`{:$Think.config.web.header}`、`{include file="seo" /}`）**逐字保留**
- 结构：`container > tool-wrap > tool-card`，组件：`tool-title`（emoji 图标 t-ico）/ `tool-desc` / `t-label` / `t-area` / `t-input` / `t-options` / `t-row` / `t-grid`+`t-col` / `tool-actions`（`t-btn`、`t-btn-ok`、`t-btn-ghost`）/ `t-result`（`t-copy data-copy="#id"`）/ `t-error`
- tab 页用 `ul.t-tabs` + `t-panel`
- 结尾顺序：`{include file="nav" /}` → `{include file="footer" /}` → jquery-1.11.3.min.js → bootstrap.min.js → toolbox.js → app.js → 页面内联 `<script>` IIFE
- **禁止**：`onclick=` 属性、tool.js / hightout.js / pcjs/*.js / setJS(、form-horizontal / form-group / col-sm-* / btn 旧类、data-clipboard-target、`{include file="link" /}`
- 交互：内联原生 JS（IIFE + addEventListener）；结果用 `textContent`，**禁止 innerHTML 拼用户输入**；算法等价照抄原 pcjs，优先现代 API；Base64 中文按 UTF-8 字节（与旧 GBK 有差异但站内自洽）
- 自检：grep 无旧模式残留 + 提取内联 JS 跑 `node --check`
- 纯前端优先：能浏览器本地算的绝不调后端接口（camelcase 原走 /md5/ 接口已改纯前端）

### 其他约定
- TDK 规则：突出"在线"特性 + 产品功能，能用模板变量就不用硬编码（减少维护成本）
- 未上线阶段：旧 URL 不做 301 / 兼容映射
- 数据行数类需求严格保量（如 linuxcmd 27 表 374 行 tr，改造前后必须一致）
- subnetmask 这类计算逻辑全在外部 pcjs 的页：不得改任何 input id / form 结构

## 4. 关键决策与事实

- **配置存储**：运营数据（百度统计/友链/站点信息）统一入 SQLite `runtime/site_config.db`（site_cfg_* KV + friend_links 表，WAL 模式），随 runtime 卷持久化；`config/web.php` 仍是 TDK 主存储（后台保存时重写）
- **品牌**：网站名称"寰宇的工具箱"，字段化 —— 前台标题/导航/页脚/SEO/全部工具页标题均读自后台「网站配置 → 网站信息 → 网站名称」
- **首页定位**：项目介绍页（不展示工具列表）；工具页底部有"常用工具推荐"随机 20 个
- **导航分类**：7 组（开发编程 12 / 文本处理 4 / 计算换算 7 / 网络运维 9 / 站长辅助 7 / 生活趣味 8 / Agent 7），注册表 `config/tools.php` 共 54 条；首页工具数由控制器动态统计（$homeCount），无硬编码
- **分类交互**：顶部导航分类 **hover 展开工具名（不点击跳转）**，移动端点击分类只展开不跳转
- **webcheck** 接口走 `/doapi/`（避免与 public/api/ 目录冲突导致 nginx 403）；子功能用 uapis 免费接口
- **货币工具**：实时汇率接口，默认 USD/CNY，动态展示 rateFrom↔rateTo 当前汇率行
- **百度统计**：后台填 ID → 自动生成混淆防爬代码（域名字符数组 + String.fromCharCode 拼接，绕过 AdBlock）
- **已知遗留**（截至 08-13 批次说明）：subnetmask 早期无 SEO 标签（后已重做）；formatfilter 依赖 jquery-1.7.1 老插件（合并时已用"功能并入 HTML 格式化"提示替代）
- 子智能体曾发现的坑：PowerShell `StartsWith([char]0xFEFF)` 判 BOM 会误报，需用原始字节确认

## 5. 部署/运维流程（用户要求的方式）

1. 本地 Docker（18080）启动自测，**修改完必须自己先验证**（用户明确批评过"不管用呀，修改完你自己测试一下呀"）
2. 用"示例数据"按钮逐一校验工具可用性
3. 检查垃圾文件并清理 → git commit + push
4. 备份本地化数据（config/ 目录）→ 拉服务器数据校验一致性
5. 打包部署到线上 tool.bx9y.com.cn（SSH 已配置）
6. 服务器与仓库后台地址不同（ADMIN_PATH 隔离）

## 6. 用户偏好与协作风格

- 称呼/署名：**寰宇**（项目品牌即其署名）
- 语言：中文；回复用中文
- 风格：**"直接按照你的想法来，我只要结果"** / **"不要找我确认"** —— 批量任务自主推进，少问多做
- 批量任务**并行子智能体**是标准打法（任务书模板固定：只读白名单文件 → write_file 重写 → 自检 node --check → 中文汇报）
- 视觉要求：拒绝 AI 味、拒绝 emoji 图标（工具页内功能图标除外）、要现代设计感、兼顾普通用户（不只开发者）
- 对 UI 质量要求高，会反复否决重做（首页前后 3+ 轮）；提供参考站截图/XPath 定位元素
- 用 XPath（如 `//html/body/div[5]/...`）精确指定位元素
- 重视 SEO（TDK、结构化数据 JSON-LD、Open Graph、sitemap）与数据不泄露（本地运算卖点）

## 7. 会话记录位置（供后续查阅原始记录）

- 转录（按会话/日期分文件）：`C:\Users\WIN11\AppData\Roaming\@opensquilla\desktop-electron\opensquilla\state\agents\main\turns\agent-main-*\YYYY-MM-DD.md`（另有 `agent-coder-*` 一个 coder 角色会话）
- 会话元数据：同目录上级 `state\sessions.db`（SQLite）
- 注意：turn capture 只含 User 消息，**不含助手回复**；细节以 git 提交信息 + 代码现状为准
