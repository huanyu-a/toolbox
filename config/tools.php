<?php
// 工具注册表（导航数据源，按功能/使用场景划分为 7 个分类）
// 结构: [ ['cat'=>分类名, 'items'=>[['url'=>..., 'name'=>..., 'accent'=>...], ...]], ... ]
return [
    [
        'cat' => '开发编程',
        'items' => [
            ['url' => '/json/', 'name' => 'JSON 工具箱', 'accent' => '', 'desc' => '格式化、校验、转义与互转'],
            ['url' => '/format/', 'name' => '代码格式化', 'accent' => '', 'desc' => '美化 HTML/CSS/JS 代码缩进'],
            ['url' => '/html2js/', 'name' => 'HTML 转 JS', 'accent' => '', 'desc' => 'HTML 片段转 JavaScript 字符串'],
            ['url' => '/regex/', 'name' => '正则表达式', 'accent' => '', 'desc' => '编写并测试正则匹配结果'],
            ['url' => '/jsencrypt/', 'name' => 'JS 加密混淆', 'accent' => '', 'desc' => '混淆压缩 JavaScript 源码'],
            ['url' => '/encrypt/', 'name' => '加密解密', 'accent' => '', 'desc' => 'MD5/SHA/AES/RSA 等加解密'],
            ['url' => '/encode/', 'name' => '编码转换', 'accent' => '', 'desc' => 'Base64/URL/Hex 等编解码'],
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
            ['url' => '/editor/', 'name' => '在线编辑器', 'accent' => '', 'desc' => '富文本在线编辑器'],
            ['url' => '/autoformat/', 'name' => '文章排版', 'accent' => '', 'desc' => '自动排版与清理格式'],
            ['url' => '/textconvert/', 'name' => '文本转换', 'accent' => '', 'desc' => '全角半角与大小写转换'],
            ['url' => '/texttool/', 'name' => '文本工具', 'accent' => '', 'desc' => '去重/排序/提取文本'],
        ],
    ],
    [
        'cat' => '计算换算',
        'items' => [
            ['url' => '/calculator/', 'name' => '科学计算器', 'accent' => '', 'desc' => '支持函数运算的科学计算器'],
            ['url' => '/calc/', 'name' => '单位换算', 'accent' => '', 'desc' => '长度/重量/温度等互转'],
            ['url' => '/nianlvli/', 'name' => '利率计算器', 'accent' => '', 'desc' => '计算存款贷款利息收益'],
            ['url' => '/subnetmask/', 'name' => '子网掩码计算', 'accent' => '', 'desc' => '划分 IP 子网与地址范围'],
            ['url' => '/random/', 'name' => '随机数/密码', 'accent' => '', 'desc' => '生成随机数与安全密码'],
            ['url' => '/convert/', 'name' => '数值转换', 'accent' => '', 'desc' => '二进制/十进制/十六进制互转'],
            ['url' => '/currency/', 'name' => '世界货币查询', 'accent' => '', 'desc' => '实时汇率换算各币种'],
        ],
    ],
    [
        'cat' => '网络运维',
        'items' => [
                        ['url' => '/webcheck/', 'name' => '网站检测', 'accent' => '', 'desc' => '检测网站可用性与响应'],
['url' => '/ip/', 'name' => 'IP 查询', 'accent' => '', 'desc' => '查询 IP 归属地信息'],
            ['url' => '/dns/', 'name' => 'DNS 大全', 'accent' => '', 'desc' => '查询域名 DNS 记录'],
            ['url' => '/websocket/', 'name' => 'WebSocket 测试', 'accent' => '', 'desc' => '测试 WebSocket 连接通信'],
            ['url' => '/browserinfo/', 'name' => '浏览器信息', 'accent' => '', 'desc' => '查看浏览器 UA 与环境'],
            ['url' => '/refresh/', 'name' => '定时刷新', 'accent' => '', 'desc' => '定时自动刷新网页'],
            ['url' => '/ports/', 'name' => '常见端口大全', 'accent' => '', 'desc' => '查询端口与服务对照'],
            ['url' => '/linuxcmd/', 'name' => 'Linux 命令大全', 'accent' => '', 'desc' => '检索 Linux 命令用法'],
            ['url' => '/htaccess2nginx/', 'name' => 'htaccess 转 nginx', 'accent' => '', 'desc' => '转换 Apache 规则为 Nginx'],
        ],
    ],
    [
        'cat' => '站长辅助',
        'items' => [
            ['url' => '/createmeta/', 'name' => 'Meta 标签', 'accent' => '', 'desc' => '生成网页 Meta 标签'],
            ['url' => '/shortcut/', 'name' => '桌面快捷方式', 'accent' => '', 'desc' => '生成桌面网址快捷方式'],
            ['url' => '/favicon/', 'name' => 'ico 图标制作', 'accent' => '', 'desc' => '在线生成网站 favicon'],
            ['url' => '/useragent/', 'name' => 'User-Agent 大全', 'accent' => '', 'desc' => '查询各浏览器 UA 标识'],
            ['url' => '/contenttype/', 'name' => 'Content-Type 对照表', 'accent' => '', 'desc' => '查文件扩展名对应的 MIME'],
            ['url' => '/httpheader/', 'name' => 'HTTP 请求头', 'accent' => '', 'desc' => '查阅 HTTP 头字段说明'],
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
            ['url' => '/keyboardcode/', 'name' => '按键码/键盘测试', 'accent' => '', 'desc' => '测试键盘按键与KeyCode'],
        ],
    ],
    [
        'cat' => 'Agent',
        'items' => [
            ['url' => '/hermescmd/', 'name' => '在线Hermes命令速查', 'accent' => '', 'desc' => '速查 Hermes 命令用法'],
            ['url' => '/claudecodecmd/', 'name' => 'Claude Code命令速查', 'accent' => '', 'desc' => '速查 Claude Code CLI 命令'],
            ['url' => '/codexcmd/', 'name' => 'OpenAI Codex命令速查', 'accent' => '', 'desc' => '速查 OpenAI Codex CLI 命令'],
            ['url' => '/openclawcmd/', 'name' => 'OpenClaw命令速查', 'accent' => '', 'desc' => '速查 OpenClaw CLI 命令'],
            ['url' => '/opencmd/', 'name' => 'Open Code命令速查', 'accent' => '', 'desc' => '速查 Open Code CLI 命令'],
            ['url' => '/picmd/', 'name' => 'Pi命令速查', 'accent' => '', 'desc' => '速查 Pi CLI 命令'],
            ['url' => '/deepseekharnesscmd/', 'name' => 'DeepSeek Harness命令速查', 'accent' => '', 'desc' => '速查 DeepSeek Harness CLI 命令'],
        ],
    ],
];
