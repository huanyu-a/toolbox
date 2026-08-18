<?php
// 工具注册表（导航数据源，按功能/使用场景划分为 7 个分类）
// 结构: [ ['cat'=>分类名, 'items'=>[['url'=>..., 'name'=>..., 'accent'=>...], ...]], ... ]
return [
    [
        'cat' => '开发编程',
        'items' => [
            ['url' => '/json/', 'name' => 'JSON 工具箱', 'accent' => ''],
            ['url' => '/format/', 'name' => '代码格式化', 'accent' => ''],
            ['url' => '/html2js/', 'name' => 'HTML 转 JS', 'accent' => ''],
            ['url' => '/regex/', 'name' => '正则表达式', 'accent' => ''],
            ['url' => '/jsencrypt/', 'name' => 'JS 加密混淆', 'accent' => ''],
            ['url' => '/encrypt/', 'name' => '加密解密', 'accent' => ''],
            ['url' => '/encode/', 'name' => '编码转换', 'accent' => ''],
            ['url' => '/runjs/', 'name' => '在线运行 JS/HTML', 'accent' => ''],
            ['url' => '/xpath/', 'name' => 'XPath 工具', 'accent' => ''],
            ['url' => '/bootstrapicon/', 'name' => 'Bootstrap 图标', 'accent' => ''],
            ['url' => '/androidmanifest/', 'name' => 'Android 权限大全', 'accent' => ''],
            ['url' => '/barcode/', 'name' => '条形码生成', 'accent' => ''],
        ],
    ],
    [
        'cat' => '文本处理',
        'items' => [
            ['url' => '/editor/', 'name' => '在线编辑器', 'accent' => ''],
            ['url' => '/autoformat/', 'name' => '文章排版', 'accent' => ''],
            ['url' => '/textconvert/', 'name' => '文本转换', 'accent' => ''],
            ['url' => '/texttool/', 'name' => '文本工具', 'accent' => ''],
        ],
    ],
    [
        'cat' => '计算换算',
        'items' => [
            ['url' => '/calculator/', 'name' => '科学计算器', 'accent' => ''],
            ['url' => '/calc/', 'name' => '单位换算', 'accent' => ''],
            ['url' => '/nianlvli/', 'name' => '利率计算器', 'accent' => ''],
            ['url' => '/subnetmask/', 'name' => '子网掩码计算', 'accent' => ''],
            ['url' => '/random/', 'name' => '随机数/密码', 'accent' => ''],
            ['url' => '/convert/', 'name' => '数值转换', 'accent' => ''],
            ['url' => '/currency/', 'name' => '世界货币查询', 'accent' => ''],
        ],
    ],
    [
        'cat' => '网络运维',
        'items' => [
                        ['url' => '/webcheck/', 'name' => '网站检测', 'accent' => ''],
['url' => '/ip/', 'name' => 'IP 查询', 'accent' => ''],
            ['url' => '/dns/', 'name' => 'DNS 大全', 'accent' => ''],
            ['url' => '/websocket/', 'name' => 'WebSocket 测试', 'accent' => ''],
            ['url' => '/browserinfo/', 'name' => '浏览器信息', 'accent' => ''],
            ['url' => '/refresh/', 'name' => '定时刷新', 'accent' => ''],
            ['url' => '/ports/', 'name' => '常见端口大全', 'accent' => ''],
            ['url' => '/linuxcmd/', 'name' => 'Linux 命令大全', 'accent' => ''],
            ['url' => '/htaccess2nginx/', 'name' => 'htaccess 转 nginx', 'accent' => ''],
        ],
    ],
    [
        'cat' => '站长辅助',
        'items' => [
            ['url' => '/createmeta/', 'name' => 'Meta 标签', 'accent' => ''],
            ['url' => '/shortcut/', 'name' => '桌面快捷方式', 'accent' => ''],
            ['url' => '/favicon/', 'name' => 'ico 图标制作', 'accent' => ''],
            ['url' => '/useragent/', 'name' => 'User-Agent 大全', 'accent' => ''],
            ['url' => '/contenttype/', 'name' => 'Content-Type 对照表', 'accent' => ''],
            ['url' => '/httpheader/', 'name' => 'HTTP 请求头', 'accent' => ''],
            ['url' => '/uuid/', 'name' => 'UUID/GUID 生成', 'accent' => ''],
        ],
    ],
    [
        'cat' => '生活趣味',
        'items' => [
            ['url' => '/tuya/', 'name' => '在线涂鸦', 'accent' => ''],
            ['url' => '/areacode/', 'name' => '区号时差查询', 'accent' => ''],
            ['url' => '/jieri/', 'name' => '世界节日查询', 'accent' => ''],
            ['url' => '/chaodai/', 'name' => '历史朝代查询', 'accent' => ''],
            ['url' => '/shaoshuminzu/', 'name' => '少数民族分布', 'accent' => ''],
            ['url' => '/tesufuhao/', 'name' => '特殊符号大全', 'accent' => ''],
            ['url' => '/lishishangdejintian/', 'name' => '历史上的今天', 'accent' => ''],
            ['url' => '/keyboardcode/', 'name' => '按键码/键盘测试', 'accent' => ''],
        ],
    ],
];
