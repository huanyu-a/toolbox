<?php
// ============================================================
// 全站 TDK 配置（在线工具箱）
// 维护说明：
//  1. title 统一以品牌后缀结尾，修改品牌名只需改下方 $brand 一处；
//  2. 新增工具页：新增一个命名条目并引用 {$Think.config.web.xxx.title} 等变量；
//  3. keywords 建议 5~10 个精准关键词，description 兼顾功能描述与 SEO。
// ============================================================
$brand = '寰宇的工具箱';

return array (
  'site' => array (
    'name' => $brand,
  ),
  'header' => '<!---->',
  'index' => array (
    'title' => '免费好用的在线工具大全',
    'keywords' => '在线工具箱,在线工具,免费在线工具,开发工具,运维工具,编程工具,格式转换,编码转换,加密解密,单位换算',
    'description' => '在线工具箱汇集 JSON格式化、代码格式化、编码转换、加密解密、单位换算、IP查询、DNS大全、正则测试等数十款免费在线工具，无需安装打开即用，大部分工具在浏览器本地完成运算，数据安全不泄露，是开发、运维、站长日常工作的效率工具箱。',
  ),

  'json' => array (
    'title' => 'JSON在线解析,JSON格式化压缩,JSON转XML/Go/C#/Java',
    'keywords' => 'JSON格式化,JSON在线解析,JSON压缩,JSON校验,JSON转XML,JSON转Go,JSON转Java,JSON转C#,JSON转YAML,JSON转Excel',
    'description' => 'JSON在线解析格式化工具：支持 JSON 格式化、压缩、校验、转义、高亮视图，以及 JSON 与 XML、YAML、URL、Excel/Csv 互转，一键生成 Go、Java、C# 实体类，自动校验 JSON 格式并定位错误，全程浏览器本地处理，数据安全。',
  ),

  'httpheader' => array (
    'title' => 'HTTP请求头对照表,HTTP Header大全,API接口Header查询',
    'keywords' => 'HTTP请求头,HTTP响应头,HTTP Header,请求头对照表,API接口Header,HTTP协议',
    'description' => 'HTTP请求头对照表收录常用 HTTP 请求头与响应头字段，说明每个 Header 的含义、语法与典型应用场景，编写采集器、API 接口、模拟登录、抓包分析时快速查阅，支持关键词搜索。',
  ),

  'keyboardcode' => array (
    'title' => '键盘按键KeyCode码在线获取,KeyCode对照表',
    'keywords' => 'KeyCode,键盘按键码,KeyCode对照表,KeyAscii码,键盘事件,按键测试',
    'description' => '在线获取键盘按键 KeyCode 码与 KeyAscii 值：按下键盘即可实时显示对应按键码，附完整 KeyCode 对照表，支持 keydown/keyup/keypress 事件，前端开发调试必备工具。',
  ),

  'calculator' => array (
    'title' => '在线科学计算器,多功能计算器,进制角度计算',
    'keywords' => '科学计算器,在线计算器,进制转换,角度弧度,双曲函数,计算器在线使用',
    'description' => '在线科学计算器支持十进制、十六进制、二进制、八进制切换，角度制/弧度制换算，三角函数、双曲函数、上档功能等高级运算，界面简洁、打开即用，无需下载安装。',
  ),

  'useragent' => array (
    'title' => '浏览器User-Agent大全,PC/移动端UA查询复制',
    'keywords' => 'User-Agent,浏览器UA,UA大全,PC端User-Agent,手机浏览器UA,UA伪装',
    'description' => '常见浏览器 User-Agent 大全：收录 PC 端与手机端主流浏览器（Chrome、Firefox、IE、Safari、Android、iOS 等）的 UA 字符串，点击即可复制，方便开发调试、爬虫采集与 UA 伪装。',
  ),

  'ports' => array (
    'title' => 'TCP/UDP端口大全,常用端口号对照表查询',
    'keywords' => '端口大全,常用端口,端口对照表,TCP端口,UDP端口,端口号查询',
    'description' => 'TCP/UDP 常见端口大全：收录 HTTP、HTTPS、FTP、SSH、SMTP、MySQL、Redis 等常用服务的端口号及用途说明，支持关键词搜索，运维与开发人员快速查阅端口对应服务。',
  ),

  'websocket' => array (
    'title' => 'Websocket在线测试工具,Websocket模拟请求调试',
    'keywords' => 'Websocket测试,Websocket在线调试,WebSocket模拟请求,ws连接测试,实时通信',
    'description' => 'Websocket 在线测试工具：支持连接 ws:// 与 wss:// 服务端，发送与接收消息，实时查看连接状态，测试服务端 Websocket 功能是否可用，支持内网与公网地址，前后端联调好帮手。',
  ),

  'shaoshuminzu' => array (
    'title' => '全国少数民族分布表,中国少数民族分布查询',
    'keywords' => '少数民族分布,全国少数民族,民族分布查询,中国少数民族,少数民族地区',
    'description' => '全国少数民族分布查询：提供中国 56 个民族的主要分布地区一览表，支持按民族或地区关键词搜索，快速了解各民族聚居地分布情况。',
  ),

  'webcheck' => array (
    'title' => '网站检测工具,ICP备案查询,Whois,微信拦截检测',
    'keywords' => '网站检测,ICP备案查询,Whois查询,微信域名检测,微信拦截检测,Gzip检测,关键词密度,HTTP状态码',
    'description' => '网站检测工具箱：提供 ICP 备案查询、域名 Whois 信息查询、微信域名拦截检测、Gzip 压缩检测、网页关键词密度检测、HTTP 状态码查询与对照，站长与开发者常用检测工具一站搞定。',
  ),

  'ip' => array (
    'title' => 'IP地址查询,IP归属地查询,域名解析查IP',
    'keywords' => 'IP查询,IP归属地,IP地址查询,域名查IP,本机IP,IP地理位置',
    'description' => 'IP 地址查询工具：输入 IP 地址查询对应地理位置归属地，输入域名可解析出真实 IP 及服务器位置，同时支持查看本机 IP，网络排查与服务器定位必备。',
  ),

  'linuxcmd' => array (
    'title' => 'Linux常用命令大全,Linux命令查询手册',
    'keywords' => 'Linux命令,Linux常用命令,shell命令,Linux命令大全,运维命令',
    'description' => 'Linux 常用命令大全：覆盖文件操作、目录管理、权限设置、进程管理、网络配置、系统监控等常用命令及参数说明，支持关键词搜索，运维与开发人员快速查阅。',
  ),

  'shortcut' => array (
    'title' => '在线生成网址桌面快捷方式,一键创建网页快捷方式',
    'keywords' => '网址快捷方式,桌面快捷方式,创建网站快捷方式,在线生成快捷方式',
    'description' => '在线生成网址桌面快捷方式：输入网址与名称，一键生成 Windows 桌面快捷方式文件，双击即可直达目标网站，方便日常高频访问的站点快速入口。',
  ),

  'xpath' => array (
    'title' => 'XPath在线测试工具,XPath提取HTML元素',
    'keywords' => 'XPath,XPath测试,XPath提取,XPath定位,网页抓取,XPath表达式',
    'description' => 'XPath 在线测试工具：输入 HTML 内容与 XPath 表达式，实时提取匹配的图片、链接、文本等元素，即时验证表达式正确性，网页抓取与前端调试必备。',
  ),

  'regex' => array (
    'title' => '正则表达式在线测试工具,正则校验匹配',
    'keywords' => '正则表达式,正则测试,正则校验,正则匹配,正则工具,Regex',
    'description' => '正则表达式在线测试工具：输入正则与测试文本，实时高亮匹配结果，支持 JavaScript、Java 等常用语法，内置常用正则示例，快速验证与调试正则表达式。',
  ),

  'favicon' => array (
    'title' => 'ico图标在线制作,favicon图标生成转换',
    'keywords' => 'favicon,ico图标,在线制作图标,png转ico,jpg转ico,网站图标生成',
    'description' => 'ico 图标在线制作工具：将 png、jpg、gif 等图片在线转换为 ico 格式，一键生成网站 favicon.ico 图标并下载，支持自定义尺寸，网页图标制作更简单。',
  ),

  'createmeta' => array (
    'title' => 'Meta标签在线生成工具,HTML5网页元信息生成',
    'keywords' => 'Meta标签,Keywords生成,Description生成,HTML5 Meta,网页SEO标签',
    'description' => 'Meta 标签在线生成工具：填写标题、关键词、描述等信息，自动生成 HTML5 移动端与 PC 端兼容的 meta 标签代码，支持一键复制，网页 SEO 优化必备。',
  ),

  'htaccess2nginx' => array (
    'title' => 'htaccess转nginx,Apache伪静态转Nginx规则',
    'keywords' => 'htaccess转nginx,apache转nginx,伪静态转换,RewriteRule,nginx规则',
    'description' => 'htaccess 转 nginx 在线工具：将 Apache .htaccess 伪静态规则一键转换为 Nginx rewrite 规则，支持 RewriteRule 常用指令转换，服务器迁移与伪静态配置更省心。',
  ),

  'contenttype' => array (
    'title' => 'HTTP Content-Type对照表,MIME类型扩展名查询',
    'keywords' => 'Content-Type,MIME类型,文件扩展名,HTTP头,响应头类型',
    'description' => 'HTTP Content-Type 对照表：收录常用文件扩展名对应的 MIME 类型，支持搜索查询，接口开发、文件下载响应头配置、爬虫解析时快速查阅。',
  ),

  'jieri' => array (
    'title' => '世界节日查询,中国农历节日查询',
    'keywords' => '世界节日,节日查询,农历节日,阳历节日,节日大全',
    'description' => '世界节日查询工具：收录世界主要节日、中国传统农历节日与公历节日，支持按节日名称或日期搜索，快速查询节日时间与由来。',
  ),

  'runjs' => array (
    'title' => 'HTML/CSS/JS在线运行调试,前端代码在线预览',
    'keywords' => '在线运行JS,HTML在线预览,前端调试,代码编辑器,网页调试',
    'description' => 'HTML/CSS/JS 在线运行工具：粘贴前端代码即可运行预览，支持 jQuery，实时调试网页效果，无需搭建本地环境，前端学习与代码验证利器。',
  ),

  'androidmanifest' => array (
    'title' => 'Android权限大全,Manifest权限描述对照表',
    'keywords' => 'Android权限,Manifest权限,安卓权限,权限描述,Android开发',
    'description' => 'Android Manifest 权限描述对照表：收录安卓常用权限及权限说明大全，支持搜索查询，Android 开发时快速了解每个权限的用途与保护级别。',
  ),

  'random' => array (
    'title' => '随机数生成器,在线生成随机数字',
    'keywords' => '随机数生成,随机数字,在线随机数,数字生成器,抽奖随机',
    'description' => '随机数生成器：自定义最小值、最大值、生成个数与是否唯一，在线快速生成随机数，可用于抽奖、测试数据、模拟场景等。',
  ),

  'browserinfo' => array (
    'title' => '浏览器信息在线查看,客户端系统信息检测',
    'keywords' => '浏览器信息,客户端信息,操作系统检测,浏览器版本,UserAgent查看',
    'description' => '浏览器信息在线检测：一键查看当前浏览器名称与版本、操作系统、屏幕分辨率、网络状态、插件数量等客户端信息，网站兼容性测试好帮手。',
  ),

  'nianlvli' => array (
    'title' => '年利率计算器,利息收益计算器在线',
    'keywords' => '年利率计算,利息计算器,年化收益率,存款利息,理财计算',
    'description' => '年利率计算器在线：输入本金、年利率与存款天数，快速计算利息收益与年化收益率，支持反向推算，理财与存款收益对比更直观。',
  ),

  'tuya' => array (
    'title' => '在线涂鸦画板,在线画画工具,手绘涂鸦',
    'keywords' => '在线涂鸦,画板,在线画画,涂鸦工具,手绘板',
    'description' => '在线涂鸦画板：自由选择画笔颜色与粗细，在画布上随手涂鸦创作，画完可一键保存到本地，无需安装软件，随时随地发挥创意。',
  ),

  'currency' => array (
    'title' => '世界各国货币查询,货币名称符号大全',
    'keywords' => '世界货币,货币名称,货币符号,货币查询,货币进位制',
    'description' => '世界各国货币查询：提供全球各国及地区货币名称、符号表示与进位制信息，支持搜索，外贸、旅游、金融从业者快速查阅。',
  ),

  'encode' => array (
    'title' => '编码转换工具,Base64/URL/Unicode/UTF-8/摩尔斯在线转换',
    'keywords' => '编码转换,Base64编码解码,URL编码,Unicode转换,UTF-8,ASCII,摩尔斯电码,图片转Base64',
    'description' => '编码转换工具大全：Base64 编码解码、URL 编码解码、Escape、Unicode、UTF-8、ASCII、摩尔斯电码、HTML 转义字符、迅雷快车旋风链接加密、图片转 Base64 等常用编码互转，一站式解决编码问题。',
  ),

  'bootstrapicon' => array (
    'title' => 'Bootstrap字体图标大全,Glyphicons图标查询',
    'keywords' => 'Bootstrap图标,Glyphicons,字体图标,图标大全,前端图标',
    'description' => 'Bootstrap 字体图标大全：Glyphicons 图标库对照表，收录 250 多个图标，点击即可复制 class 引用，前端开发快速查找并使用 Bootstrap 图标。',
  ),

  'refresh' => array (
    'title' => '网页定时自动刷新工具,在线定时刷新URL',
    'keywords' => '定时刷新,自动刷新网页,定时刷新URL,网页自动刷新,在线刷新',
    'description' => '网页定时自动刷新工具：自定义刷新间隔时间，在线定时自动刷新指定网页或 URL，可用于页面监控、功能测试、演示循环等场景。',
  ),

  'tesufuhao' => array (
    'title' => '特殊符号大全,爱心符号,表情符号,网名符号',
    'keywords' => '特殊符号,爱心符号,表情符号,网名符号,特殊符号大全,符号复制',
    'description' => '特殊符号大全：收集爱心、表情、星座、数学、货币、箭头、希腊字母、俄语字母等各类特殊符号，分类展示一键复制，网名、昵称、排版装饰必备。',
  ),

  'editor' => array (
    'title' => '在线Markdown编辑器,Html在线编辑器,Markdown转Html工具',
    'keywords' => '在线Markdown编辑器,Markdown在线编辑器,Html在线编辑器,富文本编辑器,Markdown转Html,Html转Markdown,Markdown与Html互转,在线文章编辑器,所见即所得编辑器',
    'description' => '在线Markdown编辑器与Html富文本编辑器，基于Vditor引擎，支持所见即所得、即时渲染、分屏预览三种编辑模式，可视化编辑与HTML源码一键切换，实现Markdown与Html双向互转；内置代码块语法高亮、自动保存草稿、一键复制、下载html/md文件、全屏编辑与字数统计，适用于文章撰写、网站编辑、微信公众号排版、程序员笔记等场景在线使用',
  ),

  'areacode' => array (
    'title' => '世界各国区号查询,国际电话区号,时差查询',
    'keywords' => '国际区号,世界各国区号,电话区号,时差查询,域名后缀',
    'description' => '世界各国区号查询：提供全球各国国际电话区号、时差与域名后缀信息，支持搜索，外贸沟通、国际业务、电话拨打必备参考。',
  ),

  'chaodai' => array (
    'title' => '中国历史朝代时间表,朝代都城查询',
    'keywords' => '历史朝代,朝代时间,朝代都城,中国历史,朝代查询',
    'description' => '中国历史朝代查询：历代朝代起止时间、历经年限、都城位置及都城现今对应地名一览表，历史学习与查阅参考。',
  ),

  'barcode' => array (
    'title' => '条形码在线生成器,支持多种条形码格式',
    'keywords' => '条形码生成,条形码生成器,ean13,code128,code39,条形码在线',
    'description' => '条形码在线生成器：支持 EAN8、EAN13、CODE128、CODE39、CODABAR 等 13 种常见条形码格式，输入内容即时生成条形码图片，方便商品标识与测试使用。',
  ),

  'uuid' => array (
    'title' => 'UUID/GUID在线生成器,批量生成唯一标识',
    'keywords' => 'UUID生成,GUID生成,唯一标识符,批量生成UUID,在线UUID',
    'description' => 'UUID/GUID 在线生成器：支持批量生成全局唯一标识符，可自定义生成数量与格式，开发测试、数据库主键、分布式系统标识生成必备。',
  ),

  'autoformat' => array (
    'title' => '文章自动排版工具,一键排版,论文排版',
    'keywords' => '自动排版,一键排版,文章排版,论文排版,文本格式化',
    'description' => '文章自动排版工具：一键排版杂乱文本，自动分段、首行缩进、去除多余空行与空格，支持小说、论文等纯文本排版，让文章更整洁易读。',
  ),

  'dns' => array (
    'title' => '公共DNS服务器大全,阿里DNS/Google DNS/114DNS',
    'keywords' => '公共DNS,DNS服务器,阿里DNS,百度DNS,Google DNS,114DNS,DNS设置',
    'description' => '免费公共 DNS 大全：收录阿里 DNS、百度 DNS、Google DNS、114DNS、OpenDNS 等国内外公共 DNS 服务器地址，一键复制，网络加速与 DNS 配置参考。',
  ),

  'subnetmask' => array (
    'title' => '子网掩码计算器,IP子网划分工具',
    'keywords' => '子网掩码,子网计算,IP计算,子网划分,掩码换算',
    'description' => '子网掩码计算器：在线计算子网掩码与 IP 地址换算，支持子网划分、掩码各进制表示换算、IP 进制转换，局域网规划与网络管理必备。',
  ),

  'lishishangdejintian' => array (
    'title' => '历史上的今天,今天发生的历史大事查询',
    'keywords' => '历史上的今天,历史大事,今日历史,历史事件',
    'description' => '历史上的今天：每日更新今日历史上的重大事件、名人诞生与逝世等历史记录，一键查看历史上今天发生过的大事，每天增长一点历史知识。',
  ),

  'html2js' => array (
    'title' => 'HTML转JS,Html拼接JS代码,JS转HTML',
    'keywords' => 'HTML转JS,JS转HTML,Html拼接JS,JS脚本转换,前端工具',
    'description' => 'HTML 与 JS 在线互转：HTML 代码拼接为 JS 字符串、JS 字符串转回 HTML，自动处理转义，前端动态拼接页面代码效率更高。',
  ),

  'calc' => array (
    'title' => '单位换算器,长度面积体积温度时间速度换算',
    'keywords' => '单位换算,长度换算,面积换算,体积换算,温度换算,时间换算,速度换算,压力换算',
    'description' => '在线单位换算器：长度、面积、体积、温度、时间、速度、压力、功率、角度、数据大小、力、热量、密度等 13 类单位在线互转，输入数值自动换算全部单位，全程本地计算。',
  ),

  'format' => array (
    'title' => '代码格式化工具,14种语言在线美化排版',
    'keywords' => '代码格式化,代码美化,JS格式化,SQL格式化,JSON格式化,CSS格式化,HTML格式化,PHP格式化',
    'description' => '在线代码格式化工具：支持 C/C++/C#/Java/PHP/Python/Ruby/Perl/VBScript/SQL/XML/CSS/JS/HTML 共 14 种语言的格式化与美化排版，JS/CSS/HTML 支持压缩输出，全程本地处理。',
  ),

  'encrypt' => array (
    'title' => '加密解密工具大全,AES/DES/RC4/MD5/SHA在线加密',
    'keywords' => '加密解密,AES加密,DES加密,RC4加密,Rabbit加密,TripleDES,MD5加密,SHA加密,哈希,htpasswd',
    'description' => '在线加密解密工具大全：提供 AES、DES、RC4、Rabbit、TripleDES 对称加密解密，MD5、SHA1、SHA256、SHA512、SHA3 等哈希加密，HMAC 消息认证码，htpasswd 密码文件生成，全程浏览器本地运算，数据不离开浏览器。',
  ),

  'textconvert' => array (
    'title' => '文本转换工具,汉字转拼音/火星文/人民币大写',
    'keywords' => '文本转换,汉字转拼音,火星文转换,文字竖排,文字翻转,人民币大写,驼峰下划线',
    'description' => '文本转换在线工具合集：汉字转拼音及读音、火星文转换、文字竖排、文字翻转、彩色文字特效、全角半角互转、英文大小写转换、驼峰与下划线命名互转、人民币大写金额转换，全部在浏览器本地完成。',
  ),

  'texttool' => array (
    'title' => '文本工具,内容去重/字符串压缩/文本对比',
    'keywords' => '文本工具,内容去重,去重复行,字符串压缩,去空格,文本对比',
    'description' => '文本工具合集：提供按行内容去重、字符串压缩（去空格换行）、文本内容差异对比等功能，全部在浏览器本地完成，文本处理更高效安全。',
  ),

  'convert' => array (
    'title' => '数值转换工具,时间戳/进制/颜色/rem在线转换',
    'keywords' => '时间戳转换,Unix时间戳,进制转换,颜色转换,HEX RGB,调色板,rem px转换,世界时间',
    'description' => '数值与单位转换工具合集：Unix 时间戳与日期互转、世界主要城市实时时间、在线时钟、二进制/八进制/十进制/十六进制互转、HEX 与 RGB 颜色互转及调色板、rem/px 转换，全部在浏览器本地完成。',
  ),

  'jsencrypt' => array (
    'title' => 'JS加密解密工具,JS混淆加密解密在线',
    'keywords' => 'JS加密,JS解密,JS混淆,JS代码加密,JavaScript加密,js混合加密',
    'description' => 'JS 加密解密在线工具：提供 Packer 式 JS 代码加密与解密、JS 代码混合加密（变量名混淆）等功能，全部在浏览器本地完成，支持在线加密、在线解密、在线混淆。',
  ),

);
?>