<?php
// 工具注册表（导航数据源，按功能/使用场景划分为 7 个分类）
// 结构: [ ['cat'=>分类名, 'items'=>[['url'=>..., 'name'=>..., 'accent'=>...], ...]], ... ]
return [
    [
        'cat' => '开发编程',
        'items' => [
            [
                'url' => '/json/', 'name' => 'JSON 工具箱', 'accent' => '', 'desc' => '格式化、校验、转义与互转',
                'subs' => [
                    ['url' => '/json/#fmt', 'name' => '格式化/压缩/校验', 'desc' => 'JSON 格式化、压缩与校验'],
                    ['url' => '/json/#esc', 'name' => '压缩转义', 'desc' => 'JSON 压缩转义'],
                    ['url' => '/json/#get', 'name' => 'GET 参数', 'desc' => 'JSON 与 GET 参数互转'],
                    ['url' => '/json/#xml', 'name' => 'JSON ↔ XML', 'desc' => 'JSON 与 XML 互转'],
                    ['url' => '/json/#yaml', 'name' => 'JSON ↔ YAML', 'desc' => 'JSON 与 YAML 互转'],
                    ['url' => '/json/#csv', 'name' => 'JSON ↔ CSV', 'desc' => 'JSON 与 CSV 互转'],
                    ['url' => '/json/#cs', 'name' => 'C# 实体类', 'desc' => 'JSON 生成 C# 实体类'],
                    ['url' => '/json/#java', 'name' => 'Java 实体类', 'desc' => 'JSON 生成 Java 实体类'],
                    ['url' => '/json/#go', 'name' => 'Go 结构体', 'desc' => 'JSON 生成 Go 结构体'],
                ],
            ],
            ['url' => '/format/', 'name' => '代码格式化', 'accent' => '', 'desc' => '美化 HTML/CSS/JS 代码缩进'],
            [
                'url' => '/html2js/', 'name' => 'HTML 转 JS', 'accent' => '', 'desc' => 'HTML 片段转 JavaScript 字符串',
                'subs' => [
                    ['url' => '/html2js/#js', 'name' => 'HTML↔JS', 'desc' => 'HTML 转 JavaScript 字符串'],
                    ['url' => '/html2js/#cj', 'name' => 'HTML↔C#/JSP', 'desc' => 'HTML 转 C#/JSP 字符串'],
                    ['url' => '/html2js/#php', 'name' => 'HTML↔PHP', 'desc' => 'HTML 转 PHP 字符串'],
                    ['url' => '/html2js/#asp', 'name' => 'ASP/VB/Perl', 'desc' => 'HTML 转 ASP/VB/Perl'],
                    ['url' => '/html2js/#ubb', 'name' => 'HTML↔UBB', 'desc' => 'HTML 与 UBB 代码互转'],
                    ['url' => '/html2js/#table', 'name' => '表格生成器', 'desc' => 'HTML 表格代码生成器'],
                    ['url' => '/html2js/#csv', 'name' => 'CSV转表格', 'desc' => 'CSV 转 HTML 表格'],
                ],
            ],
            [
                'url' => '/regex/', 'name' => '正则表达式', 'accent' => '', 'desc' => '编写并测试正则匹配结果',
                'subs' => [
                    ['url' => '/regex/#rgPanel1', 'name' => '在线测试', 'desc' => '正则在线匹配测试'],
                    ['url' => '/regex/#rgPanel2', 'name' => '生成代码', 'desc' => '正则生成多语言代码'],
                    ['url' => '/regex/#rgPanel3', 'name' => '常用正则表', 'desc' => '常用正则表达式大全'],
                    ['url' => '/regex/#rgPanel4', 'name' => '语法速查', 'desc' => '正则语法速查手册'],
                ],
            ],
            ['url' => '/jsencrypt/', 'name' => 'JS 加密混淆', 'accent' => '', 'desc' => '混淆压缩 JavaScript 源码'],
            [
                'url' => '/encrypt/', 'name' => '加密解密', 'accent' => '', 'desc' => 'MD5/SHA/AES/RSA 等加解密',
                'subs' => [
                    ['url' => '/encrypt/#dePanel', 'name' => '对称加密/解密', 'desc' => 'AES/DES 等对称加解密'],
                    ['url' => '/encrypt/#haPanel', 'name' => '哈希散列', 'desc' => 'MD5/SHA 等哈希散列计算'],
                    ['url' => '/encrypt/#hpPanel', 'name' => 'htpasswd', 'desc' => 'htpasswd 密码生成'],
                ],
            ],
            [
                'url' => '/encode/', 'name' => '编码转换', 'accent' => '', 'desc' => 'Base64/URL/Hex 等编解码',
                'subs' => [
                    ['url' => '/encode/#encB64', 'name' => 'Base64', 'desc' => 'Base64 编码/解码'],
                    ['url' => '/encode/#encUrl', 'name' => 'URL', 'desc' => 'URL 编码/解码'],
                    ['url' => '/encode/#encEsc', 'name' => 'Escape', 'desc' => 'Escape 编码/解码'],
                    ['url' => '/encode/#encUni', 'name' => 'Unicode', 'desc' => 'Unicode 编码转换'],
                    ['url' => '/encode/#encUtf', 'name' => 'UTF-8', 'desc' => 'UTF-8 编码转换'],
                    ['url' => '/encode/#encAsc', 'name' => 'ASCII', 'desc' => 'ASCII 码转换'],
                    ['url' => '/encode/#encMorse', 'name' => '摩尔斯', 'desc' => '摩尔斯电码互转'],
                    ['url' => '/encode/#encThunder', 'name' => '迅雷/旋风', 'desc' => '迅雷/旋风专链转换'],
                    ['url' => '/encode/#encImg', 'name' => '图片Base64', 'desc' => '图片转 Base64'],
                    ['url' => '/encode/#encHtml', 'name' => 'HTML转义', 'desc' => 'HTML 实体转义'],
                ],
            ],
            ['url' => '/runjs/', 'name' => '在线运行 JS/HTML', 'accent' => '', 'desc' => '浏览器内执行 JavaScript 代码'],
            ['url' => '/xpath/', 'name' => 'XPath 工具', 'accent' => '', 'desc' => '提取 XML/HTML 节点路径'],
            ['url' => '/bootstrapicon/', 'name' => 'Bootstrap 图标', 'accent' => '', 'desc' => '浏览复制 Bootstrap 图标'],
            ['url' => '/androidmanifest/', 'name' => 'Android 权限大全', 'accent' => '', 'desc' => '查询 Android 权限说明'],
            ['url' => '/barcode/', 'name' => '条形码生成', 'accent' => '', 'desc' => '生成各类条形码图片'],
        ],
    ],
    [
        'cat' => '文本处理',
        'items' => [
            [
                'url' => '/editor/', 'name' => '在线编辑器', 'accent' => '', 'desc' => '富文本在线编辑器',
                'subs' => [
                    ['url' => '/editor/#tui', 'name' => '可视化编辑', 'desc' => '富文本可视化编辑'],
                    ['url' => '/editor/#html', 'name' => 'HTML 源码', 'desc' => 'HTML 源码编辑模式'],
                ],
            ],
            ['url' => '/autoformat/', 'name' => '文章排版', 'accent' => '', 'desc' => '自动排版与清理格式'],
            [
                'url' => '/textconvert/', 'name' => '文本转换', 'accent' => '', 'desc' => '全角半角与大小写转换',
                'subs' => [
                    ['url' => '/textconvert/#tcPy', 'name' => '汉字拼音', 'desc' => '汉字转拼音'],
                    ['url' => '/textconvert/#tcHx', 'name' => '火星文', 'desc' => '汉字转火星文'],
                    ['url' => '/textconvert/#tcSp', 'name' => '文字竖排', 'desc' => '文字竖排排版'],
                    ['url' => '/textconvert/#tcFlip', 'name' => '文字翻转', 'desc' => '文字上下左右翻转'],
                    ['url' => '/textconvert/#tcFx', 'name' => '文字特效', 'desc' => '花式文字特效生成'],
                    ['url' => '/textconvert/#tcQb', 'name' => '全角半角', 'desc' => '全角半角互转'],
                    ['url' => '/textconvert/#tcCase', 'name' => '英文大小写', 'desc' => '英文大小写转换'],
                    ['url' => '/textconvert/#tcRmb', 'name' => '人民币大写', 'desc' => '人民币金额大写'],
                    ['url' => '/textconvert/#tcName', 'name' => '命名转换', 'desc' => '驼峰/下划线等命名风格转换'],
                ],
            ],
            [
                'url' => '/texttool/', 'name' => '文本工具', 'accent' => '', 'desc' => '去重/排序/提取文本',
                'subs' => [
                    ['url' => '/texttool/#ttUnique', 'name' => '内容去重', 'desc' => '文本内容去重'],
                    ['url' => '/texttool/#ttZip', 'name' => '字符串压缩', 'desc' => '字符串压缩与还原'],
                    ['url' => '/texttool/#ttDiff', 'name' => '文本对比', 'desc' => '两段文本差异对比'],
                ],
            ],
        ],
    ],
    [
        'cat' => '计算换算',
        'items' => [
            ['url' => '/calculator/', 'name' => '科学计算器', 'accent' => '', 'desc' => '支持函数运算的科学计算器'],
            [
                'url' => '/calc/', 'name' => '单位换算', 'accent' => '', 'desc' => '长度/重量/温度等互转',
                // 页内子工具（subs）：仅供前端搜索直达（url 带 #tab 锚点），导航/站点地图/首页计数不遍历这层数据
                'subs' => [
                    ['url' => '/calc/#panel-calclength', 'name' => '长度', 'desc' => '米/千米/英寸等长度单位互转'],
                    ['url' => '/calc/#panel-calcarea', 'name' => '面积', 'desc' => '平方米/亩/公顷等面积互转'],
                    ['url' => '/calc/#panel-calcvolume', 'name' => '体积', 'desc' => '升/立方米/加仑等体积互转'],
                    ['url' => '/calc/#panel-calctemperature', 'name' => '温度', 'desc' => '摄氏度/华氏度/开尔文互转'],
                    ['url' => '/calc/#panel-calctime', 'name' => '时间', 'desc' => '秒/分/时/天等时间单位互转'],
                    ['url' => '/calc/#panel-calcspeed', 'name' => '速度', 'desc' => 'km/h、m/s、节等速度互转'],
                    ['url' => '/calc/#panel-calcpressure', 'name' => '压力', 'desc' => '帕/巴/atm 等压力互转'],
                    ['url' => '/calc/#panel-calcpower', 'name' => '功率', 'desc' => '瓦/千瓦/马力等功率互转'],
                    ['url' => '/calc/#panel-calcangle', 'name' => '角度', 'desc' => '角度与弧度互转'],
                    ['url' => '/calc/#panel-calcforce', 'name' => '力', 'desc' => '牛顿/千克力等力的单位互转'],
                    ['url' => '/calc/#panel-calcheat', 'name' => '热量', 'desc' => '焦耳/卡路里等热量单位互转'],
                    ['url' => '/calc/#panel-calcthickness', 'name' => '密度', 'desc' => '密度单位换算'],
                    ['url' => '/calc/#panel-calcdata', 'name' => '数据大小', 'desc' => 'KB/MB/GB 等数据大小互转'],
                ],
            ],
            ['url' => '/nianlvli/', 'name' => '利率计算器', 'accent' => '', 'desc' => '计算存款贷款利息收益'],
            [
                'url' => '/subnetmask/', 'name' => '子网掩码计算', 'accent' => '', 'desc' => '划分 IP 子网与地址范围',
                'subs' => [
                    ['url' => '/subnetmask/#smNet', 'name' => '网络/IP 计算', 'desc' => 'IP 与网络地址计算'],
                    ['url' => '/subnetmask/#smSub', 'name' => '子网划分', 'desc' => '子网划分计算'],
                    ['url' => '/subnetmask/#smMask', 'name' => '掩码转换', 'desc' => '掩码位数与点分十进制互转'],
                    ['url' => '/subnetmask/#smHost', 'name' => '主机/地址量', 'desc' => '可用主机数与地址范围'],
                    ['url' => '/subnetmask/#smHex', 'name' => '进制转换', 'desc' => 'IP 进制转换'],
                ],
            ],
            [
                'url' => '/random/', 'name' => '随机数/密码', 'accent' => '', 'desc' => '生成随机数与安全密码',
                'subs' => [
                    ['url' => '/random/#rndPanel1', 'name' => '随机数 / 字符串', 'desc' => '随机数与随机字符串生成'],
                    ['url' => '/random/#rndPanel2', 'name' => '随机密码', 'desc' => '安全随机密码生成'],
                ],
            ],
            [
                'url' => '/convert/', 'name' => '数值转换', 'accent' => '', 'desc' => '二进制/十进制/十六进制互转',
                // 页内子工具（subs）：仅供前端搜索直达（url 带 #tab 锚点），导航/站点地图/首页计数不遍历这层数据
                'subs' => [
                    ['url' => '/convert/#cvTime', 'name' => '时间戳转换', 'desc' => '时间戳与日期互相转换'],
                    ['url' => '/convert/#cvWorld', 'name' => '世界时间', 'desc' => '全球主要城市实时时间'],
                    ['url' => '/convert/#cvClock', 'name' => '在线时钟', 'desc' => '浏览器本地实时时钟'],
                    ['url' => '/convert/#cvHex', 'name' => '进制转换', 'desc' => '二/八/十/十六进制互相转换'],
                    ['url' => '/convert/#cvColor', 'name' => '颜色转换', 'desc' => 'HEX 与 RGB 颜色互转'],
                    ['url' => '/convert/#cvPal', 'name' => '调色板', 'desc' => '屏幕取色器与常用色板'],
                    ['url' => '/convert/#cvRem', 'name' => 'rem/px 转换', 'desc' => 'CSS 单位 px 与 rem 互转'],
                ],
            ],
            ['url' => '/currency/', 'name' => '世界货币查询', 'accent' => '', 'desc' => '实时汇率换算各币种'],
        ],
    ],
    [
        'cat' => '网络运维',
        'items' => [
                        [
                            'url' => '/webcheck/', 'name' => '网站检测', 'accent' => '', 'desc' => '检测网站可用性与响应',
                            'subs' => [
                                ['url' => '/webcheck/#wcIcp', 'name' => 'ICP备案', 'desc' => '域名 ICP 备案查询'],
                                ['url' => '/webcheck/#wcWhois', 'name' => 'Whois', 'desc' => '域名 Whois 信息查询'],
                                ['url' => '/webcheck/#wcWx', 'name' => '微信检测', 'desc' => '域名微信拦截检测'],
                                ['url' => '/webcheck/#wcGzip', 'name' => 'Gzip检测', 'desc' => '网站 Gzip 压缩检测'],
                                ['url' => '/webcheck/#wcKw', 'name' => '关键词密度', 'desc' => '网页关键词密度检测'],
                            ],
                        ],
[
    'url' => '/ip/', 'name' => 'IP 查询', 'accent' => '', 'desc' => '查询 IP 归属地信息',
    'subs' => [
        ['url' => '/ip/#ipPanel1', 'name' => '归属地查询', 'desc' => 'IP 归属地与运营商查询'],
        ['url' => '/ip/#ipPanel2', 'name' => 'IP / 数字互转', 'desc' => 'IP 与整数地址互转'],
    ],
],
            [
                'url' => '/dns/', 'name' => 'DNS 大全', 'accent' => '', 'desc' => '查询域名 DNS 记录',
                'subs' => [
                    ['url' => '/dns/#panel-dns', 'name' => '公共DNS', 'desc' => '公共 DNS 服务器地址大全'],
                    ['url' => '/dns/#panel-alldns', 'name' => '各地区', 'desc' => '全国各地区 DNS 服务器'],
                    ['url' => '/dns/#panel-dnsdx', 'name' => '电信DNS', 'desc' => '电信 DNS 服务器地址'],
                    ['url' => '/dns/#panel-dnslt', 'name' => '联通DNS', 'desc' => '联通 DNS 服务器地址'],
                    ['url' => '/dns/#panel-dnsyd', 'name' => '移动DNS', 'desc' => '移动 DNS 服务器地址'],
                    ['url' => '/dns/#panel-dnstt', 'name' => '铁通DNS', 'desc' => '铁通 DNS 服务器地址'],
                    ['url' => '/dns/#panel-dnsedu', 'name' => '教育网', 'desc' => '教育网 DNS 服务器地址'],
                    ['url' => '/dns/#panel-dnsusa', 'name' => '美国DNS', 'desc' => '美国 DNS 服务器地址'],
                ],
            ],
            ['url' => '/websocket/', 'name' => 'WebSocket 测试', 'accent' => '', 'desc' => '测试 WebSocket 连接通信'],
            ['url' => '/browserinfo/', 'name' => '浏览器信息', 'accent' => '', 'desc' => '查看浏览器 UA 与环境'],
            ['url' => '/refresh/', 'name' => '定时刷新', 'accent' => '', 'desc' => '定时自动刷新网页'],
            ['url' => '/ports/', 'name' => '常见端口大全', 'accent' => '', 'desc' => '查询端口与服务对照'],
            [
                'url' => '/linuxcmd/', 'name' => 'Linux 命令大全', 'accent' => '', 'desc' => '检索 Linux 命令用法',
                'subs' => [
                    ['url' => '/linuxcmd/#p-sys', 'name' => '系统信息', 'desc' => 'Linux 系统信息命令速查'],
                    ['url' => '/linuxcmd/#p-mgr', 'name' => '系统管理', 'desc' => 'Linux 系统管理命令速查'],
                    ['url' => '/linuxcmd/#p-file', 'name' => '文件和目录', 'desc' => 'Linux 文件与目录命令速查'],
                    ['url' => '/linuxcmd/#p-text', 'name' => '文本处理', 'desc' => 'Linux 文本处理命令速查'],
                    ['url' => '/linuxcmd/#p-user', 'name' => '用户和群组', 'desc' => 'Linux 用户与群组命令速查'],
                    ['url' => '/linuxcmd/#p-disk', 'name' => '磁盘挂载', 'desc' => 'Linux 磁盘与挂载命令速查'],
                    ['url' => '/linuxcmd/#p-net', 'name' => '网络与通信', 'desc' => 'Linux 网络与通信命令速查'],
                    ['url' => '/linuxcmd/#p-pkg', 'name' => '软件包管理', 'desc' => 'Linux 软件包管理命令速查'],
                    ['url' => '/linuxcmd/#p-zip', 'name' => '打包压缩', 'desc' => 'Linux 打包压缩命令速查'],
                    ['url' => '/linuxcmd/#p-dbg', 'name' => '监视与调试', 'desc' => 'Linux 监视与调试命令速查'],
                ],
            ],
            ['url' => '/htaccess2nginx/', 'name' => 'htaccess 转 nginx', 'accent' => '', 'desc' => '转换 Apache 规则为 Nginx'],
        ],
    ],
    [
        'cat' => '站长辅助',
        'items' => [
            [
                'url' => '/createmeta/', 'name' => 'Meta 标签', 'accent' => '', 'desc' => '生成网页 Meta 标签',
                'subs' => [
                    ['url' => '/createmeta/#cmPanel1', 'name' => 'Meta 生成器', 'desc' => '网页 Meta 标签在线生成'],
                    ['url' => '/createmeta/#cmPanel2', 'name' => 'Meta 分析', 'desc' => '网页 Meta 标签分析'],
                ],
            ],
            ['url' => '/shortcut/', 'name' => '桌面快捷方式', 'accent' => '', 'desc' => '生成桌面网址快捷方式'],
            ['url' => '/favicon/', 'name' => 'ico 图标制作', 'accent' => '', 'desc' => '在线生成网站 favicon'],
            ['url' => '/useragent/', 'name' => 'User-Agent 大全', 'accent' => '', 'desc' => '查询各浏览器 UA 标识'],
            ['url' => '/contenttype/', 'name' => 'Content-Type 对照表', 'accent' => '', 'desc' => '查文件扩展名对应的 MIME'],
            [
                'url' => '/httpheader/', 'name' => 'HTTP 请求头', 'accent' => '', 'desc' => '查阅 HTTP 头字段说明',
                'subs' => [
                    ['url' => '/httpheader/#hhPanel1', 'name' => '请求头大全', 'desc' => 'HTTP 请求头字段大全'],
                    ['url' => '/httpheader/#hhPanel2', 'name' => '请求方法大全', 'desc' => 'HTTP 请求方法大全'],
                ],
            ],
            ['url' => '/uuid/', 'name' => 'UUID/GUID 生成', 'accent' => '', 'desc' => '批量生成唯一标识符'],
        ],
    ],
    [
        'cat' => '生活趣味',
        'items' => [
            ['url' => '/tuya/', 'name' => '在线涂鸦', 'accent' => '', 'desc' => '画板涂鸦与保存图片'],
            ['url' => '/areacode/', 'name' => '区号时差查询', 'accent' => '', 'desc' => '查国际区号与时差'],
            ['url' => '/jieri/', 'name' => '世界节日查询', 'accent' => '', 'desc' => '查各国节日日期信息'],
            ['url' => '/chaodai/', 'name' => '历史朝代查询', 'accent' => '', 'desc' => '查中国历史朝代纪年'],
            ['url' => '/shaoshuminzu/', 'name' => '少数民族分布', 'accent' => '', 'desc' => '查少数民族分布概况'],
            ['url' => '/tesufuhao/', 'name' => '特殊符号大全', 'accent' => '', 'desc' => '复制特殊符号与字符'],
            ['url' => '/lishishangdejintian/', 'name' => '历史上的今天', 'accent' => '', 'desc' => '查看今日历史事件'],
            [
                'url' => '/keyboardcode/', 'name' => '按键码/键盘测试', 'accent' => '', 'desc' => '测试键盘按键与KeyCode',
                'subs' => [
                    ['url' => '/keyboardcode/#kbPanel1', 'name' => 'KeyCode 获取', 'desc' => '键盘按键 KeyCode 获取'],
                    ['url' => '/keyboardcode/#kbPanel2', 'name' => '键盘测试', 'desc' => '键盘按键在线测试'],
                    ['url' => '/keyboardcode/#kbPanel3', 'name' => 'Android 按键码', 'desc' => 'Android Keycode 对照表'],
                ],
            ],
        ],
    ],
    [
        'cat' => 'Agent',
        'items' => [
            [
                'url' => '/hermescmd/', 'name' => '在线Hermes命令速查', 'accent' => '', 'desc' => '速查 Hermes 命令用法',
                'subs' => [
                    ['url' => '/hermescmd/#p-gw', 'name' => '默认网关', 'desc' => 'Hermes 默认网关配置'],
                    ['url' => '/hermescmd/#p-gw2', 'name' => 'dingtalk2 网关', 'desc' => 'Hermes dingtalk2 网关配置'],
                    ['url' => '/hermescmd/#p-dashboard', 'name' => 'Dashboard', 'desc' => 'Hermes Dashboard 面板'],
                    ['url' => '/hermescmd/#p-cron', 'name' => 'Cron 定时任务', 'desc' => 'Hermes 定时任务管理'],
                    ['url' => '/hermescmd/#p-clean', 'name' => '进程清理', 'desc' => 'Hermes 进程清理命令'],
                    ['url' => '/hermescmd/#p-boot', 'name' => '防开机自启', 'desc' => 'Hermes 防开机自启设置'],
                    ['url' => '/hermescmd/#p-trouble', 'name' => '故障排查', 'desc' => 'Hermes 故障排查命令'],
                ],
            ],
            [
                'url' => '/claudecodecmd/', 'name' => 'Claude Code命令速查', 'accent' => '', 'desc' => '速查 Claude Code CLI 命令',
                'subs' => [
                    ['url' => '/claudecodecmd/#p-basic', 'name' => '基础命令', 'desc' => 'Claude Code 基础命令用法'],
                    ['url' => '/claudecodecmd/#p-file', 'name' => '文件操作', 'desc' => 'Claude Code 文件操作命令'],
                    ['url' => '/claudecodecmd/#p-git', 'name' => 'Git 集成', 'desc' => 'Claude Code Git 集成命令'],
                    ['url' => '/claudecodecmd/#p-mcp', 'name' => 'MCP 工具', 'desc' => 'Claude Code MCP 工具命令'],
                    ['url' => '/claudecodecmd/#p-config', 'name' => '配置管理', 'desc' => 'Claude Code 配置管理命令'],
                    ['url' => '/claudecodecmd/#p-trouble', 'name' => '故障排查', 'desc' => 'Claude Code 故障排查命令'],
                ],
            ],
            [
                'url' => '/codexcmd/', 'name' => 'OpenAI Codex命令速查', 'accent' => '', 'desc' => '速查 OpenAI Codex CLI 命令',
                'subs' => [
                    ['url' => '/codexcmd/#p-basic', 'name' => '基础命令', 'desc' => 'Codex 基础命令用法'],
                    ['url' => '/codexcmd/#p-code', 'name' => '代码生成', 'desc' => 'Codex 代码生成命令'],
                    ['url' => '/codexcmd/#p-review', 'name' => '代码审查', 'desc' => 'Codex 代码审查命令'],
                    ['url' => '/codexcmd/#p-test', 'name' => '测试生成', 'desc' => 'Codex 测试生成命令'],
                    ['url' => '/codexcmd/#p-config', 'name' => '配置管理', 'desc' => 'Codex 配置管理命令'],
                    ['url' => '/codexcmd/#p-trouble', 'name' => '故障排查', 'desc' => 'Codex 故障排查命令'],
                ],
            ],
            [
                'url' => '/openclawcmd/', 'name' => 'OpenClaw命令速查', 'accent' => '', 'desc' => '速查 OpenClaw CLI 命令',
                'subs' => [
                    ['url' => '/openclawcmd/#p-basic', 'name' => '基础命令', 'desc' => 'OpenClaw 基础命令用法'],
                    ['url' => '/openclawcmd/#p-skill', 'name' => '技能管理', 'desc' => 'OpenClaw 技能管理命令'],
                    ['url' => '/openclawcmd/#p-agent', 'name' => 'Agent 部署', 'desc' => 'OpenClaw Agent 部署命令'],
                    ['url' => '/openclawcmd/#p-mcp', 'name' => 'MCP 集成', 'desc' => 'OpenClaw MCP 集成命令'],
                    ['url' => '/openclawcmd/#p-config', 'name' => '配置管理', 'desc' => 'OpenClaw 配置管理命令'],
                    ['url' => '/openclawcmd/#p-trouble', 'name' => '故障排查', 'desc' => 'OpenClaw 故障排查命令'],
                ],
            ],
            [
                'url' => '/opencmd/', 'name' => 'Open Code命令速查', 'accent' => '', 'desc' => '速查 Open Code CLI 命令',
                'subs' => [
                    ['url' => '/opencmd/#p-basic', 'name' => '基础命令', 'desc' => 'Open Code 基础命令用法'],
                    ['url' => '/opencmd/#p-model', 'name' => '模型管理', 'desc' => 'Open Code 模型管理命令'],
                    ['url' => '/opencmd/#p-plugin', 'name' => '插件系统', 'desc' => 'Open Code 插件管理命令'],
                    ['url' => '/opencmd/#p-config', 'name' => '配置管理', 'desc' => 'Open Code 配置管理命令'],
                    ['url' => '/opencmd/#p-trouble', 'name' => '故障排查', 'desc' => 'Open Code 故障排查命令'],
                ],
            ],
            [
                'url' => '/picmd/', 'name' => 'Pi命令速查', 'accent' => '', 'desc' => '速查 Pi CLI 命令',
                'subs' => [
                    ['url' => '/picmd/#p-basic', 'name' => '基础命令', 'desc' => 'Pi 基础命令用法'],
                    ['url' => '/picmd/#p-chat', 'name' => '对话管理', 'desc' => 'Pi 对话管理命令'],
                    ['url' => '/picmd/#p-memory', 'name' => '记忆系统', 'desc' => 'Pi 记忆系统命令'],
                    ['url' => '/picmd/#p-persona', 'name' => '个性化配置', 'desc' => 'Pi 个性化配置命令'],
                    ['url' => '/picmd/#p-config', 'name' => '配置管理', 'desc' => 'Pi 配置管理命令'],
                    ['url' => '/picmd/#p-trouble', 'name' => '故障排查', 'desc' => 'Pi 故障排查命令'],
                ],
            ],
            [
                'url' => '/deepseekharnesscmd/', 'name' => 'DeepSeek Harness命令速查', 'accent' => '', 'desc' => '速查 DeepSeek Harness CLI 命令',
                'subs' => [
                    ['url' => '/deepseekharnesscmd/#p-basic', 'name' => '基础命令', 'desc' => 'DeepSeek Harness 基础命令用法'],
                    ['url' => '/deepseekharnesscmd/#p-model', 'name' => '模型管理', 'desc' => 'DeepSeek Harness 模型管理命令'],
                    ['url' => '/deepseekharnesscmd/#p-inference', 'name' => '推理优化', 'desc' => 'DeepSeek Harness 推理优化'],
                    ['url' => '/deepseekharnesscmd/#p-train', 'name' => '训练管理', 'desc' => 'DeepSeek Harness 训练管理'],
                    ['url' => '/deepseekharnesscmd/#p-gateway', 'name' => 'API 网关', 'desc' => 'DeepSeek Harness API 网关配置'],
                    ['url' => '/deepseekharnesscmd/#p-trouble', 'name' => '故障排查', 'desc' => 'DeepSeek Harness 故障排查命令'],
                ],
            ],
        ],
    ],
];
