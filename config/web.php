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
    'title' => '免费好用的在线工具箱,无需安装打开即用',
    'keywords' => '在线工具箱,在线工具,免费在线工具,在线工具大全,工具箱,开发工具,运维工具,编程工具,格式转换,编码转换,加密解密,单位换算,无需安装,打开即用',
    'description' => '寰宇工具箱汇集 JSON 格式化、代码格式化、编码转换、加密解密、单位换算、IP 查询、DNS 大全、正则测试、在线计算器等数十款免费在线工具，无需安装打开即用，大部分工具在浏览器本地完成运算，数据安全不泄露，是开发、运维、站长日常工作的在线效率工具箱。',
  ),

  'json' => array (
    'title' => 'JSON在线格式化,JSON压缩,JSON校验与转换工具',
    'keywords' => 'JSON在线格式化,JSON在线解析,JSON压缩,JSON校验,JSON转XML,JSON转Go,JSON转Java,JSON转C#,JSON转YAML,JSON转Excel,在线工具',
    'description' => 'JSON 在线格式化与解析工具：支持 JSON 在线格式化、压缩、校验、转义、高亮视图，以及 JSON 与 XML、YAML、URL、Excel/Csv 在线互转，一键生成 Go、Java、C# 实体类，自动校验 JSON 格式并定位错误，免安装打开即用，数据全程在浏览器本地处理，安全不泄露。',
  ),

  'httpheader' => array (
    'title' => 'HTTP请求头在线对照表,HTTP Header大全查询工具',
    'keywords' => 'HTTP请求头在线查询,HTTP响应头,HTTP Header,API接口Header,HTTP协议,请求头对照表,在线工具',
    'description' => 'HTTP 请求头在线对照表：收录常用 HTTP 请求头与响应头字段，在线说明每个 Header 的含义、语法与典型应用场景，编写采集器、API 接口、模拟登录、抓包分析时在线快速查阅，支持在线搜索，免安装打开即用。',
  ),

  'keyboardcode' => array (
    'title' => '键盘按键KeyCode在线获取,KeyCode实时查看工具',
    'keywords' => 'KeyCode在线获取,键盘按键码,KeyCode对照表,KeyAscii码,键盘事件,按键测试,在线工具',
    'description' => '键盘按键 KeyCode 在线获取工具：按下键盘即可在线实时显示对应按键码，附完整 KeyCode 对照表，支持 keydown/keyup/keypress 事件，前端开发在线调试工具，免安装打开即用。',
  ),

  'calculator' => array (
    'title' => '在线科学计算器,多功能计算器,进制与角度计算',
    'keywords' => '在线科学计算器,在线计算器,进制转换,角度弧度,双曲函数,计算器在线使用',
    'description' => '在线科学计算器：支持十进制、十六进制、二进制、八进制切换，角度制与弧度制换算，三角函数、双曲函数、上档功能等高级在线运算，界面简洁、免安装打开即用。',
  ),

  'useragent' => array (
    'title' => '浏览器User-Agent在线查询,UA大全生成与复制',
    'keywords' => 'User-Agent在线查询,浏览器UA,UA大全,PC端User-Agent,手机浏览器UA,UA伪装,在线工具',
    'description' => '浏览器 User-Agent 在线查询大全：收录 PC 端与手机端主流浏览器（Chrome、Firefox、IE、Safari、Android、iOS 等）的 UA 字符串，在线点击即可复制，方便开发调试、爬虫采集与 UA 伪装，免安装打开即用。',
  ),

  'ports' => array (
    'title' => 'TCP/UDP端口在线查询,常用端口号对照表',
    'keywords' => '端口在线查询,常用端口,端口对照表,TCP端口,UDP端口,端口号查询,在线工具',
    'description' => 'TCP/UDP 常用端口在线对照表：收录 HTTP、HTTPS、FTP、SSH、SMTP、MySQL、Redis 等常用服务端口号及用途，支持在线搜索，运维与开发人员在线快速查阅，免安装打开即用。',
  ),

  'websocket' => array (
    'title' => 'WebSocket在线测试工具,ws连接与调试工具',
    'keywords' => 'WebSocket在线测试,WebSocket在线调试,WebSocket模拟请求,ws连接测试,实时通信,在线工具',
    'description' => 'WebSocket 在线测试工具：支持在线连接 ws:// 与 wss:// 服务端，发送与接收消息，实时查看连接状态，在线测试服务端 WebSocket 功能是否可用，支持内网与公网地址，前后端联调在线好帮手，免安装打开即用。',
  ),

  'shaoshuminzu' => array (
    'title' => '中国少数民族分布在线查询,全国少数民族分布表',
    'keywords' => '少数民族分布在线查询,全国少数民族,民族分布表,中国少数民族,少数民族地区,在线查询',
    'description' => '全国少数民族分布在线查询：免安装在线查看中国 56 个民族的主要分布地区一览表，支持按民族或地区关键词在线搜索，快速了解各民族聚居地分布情况。',
  ),

  'webcheck' => array (
    'title' => '在线网站检测工具,ICP备案,Whois,微信拦截检测',
    'keywords' => '在线网站检测,ICP备案在线查询,Whois在线查询,微信域名检测,微信拦截检测,Gzip检测,关键词密度,HTTP状态码',
    'description' => '网站在线检测工具箱：提供 ICP 备案在线查询、域名 Whois 在线查询、微信域名拦截检测、Gzip 压缩检测、网页关键词密度检测、HTTP 状态码查询与对照，站长与开发者在线一站式检测，免安装打开即用。',
  ),

  'ip' => array (
    'title' => '在线IP查询,IP归属地查询,域名解析查IP',
    'keywords' => 'IP在线查询,IP归属地,IP地址查询,域名查IP,本机IP,IP地理位置,在线工具',
    'description' => 'IP 地址在线查询工具：输入 IP 即可在线查询对应地理位置归属地，输入域名可在线解析真实 IP 及服务器位置，同时支持在线查看本机 IP，网络排查与服务器定位在线工具，免安装打开即用。',
  ),

  'linuxcmd' => array (
    'title' => 'Linux常用命令在线查询,Linux命令大全',
    'keywords' => 'Linux命令在线查询,Linux常用命令,shell命令,Linux命令大全,运维命令,在线工具',
    'description' => 'Linux 常用命令在线大全：覆盖文件操作、目录管理、权限、进程、网络、系统管理与监控等常用命令及参数，支持在线搜索，运维与开发人员在线快速查阅，免安装打开即用。',
  ),

  'shortcut' => array (
    'title' => '网址桌面快捷方式在线生成,网页快捷方式生成工具',
    'keywords' => '网址快捷方式在线生成,桌面快捷方式,创建网站快捷方式,在线生成快捷方式,在线工具',
    'description' => '网址桌面快捷方式在线生成器：输入网址与名称，在线一键生成 Windows 桌面快捷方式，双击即可直达目标网站，方便高频访问站点快速入口，免安装打开即用。',
  ),

  'xpath' => array (
    'title' => 'XPath在线测试工具,提取HTML元素的在线工具',
    'keywords' => 'XPath在线测试,XPath提取,XPath定位,网页抓取,XPath表达式,在线工具',
    'description' => 'XPath 在线测试工具：在线输入 HTML 与 XPath 表达式，实时提取匹配的图片、链接、文本等元素，在线即时验证表达式正确性，网页抓取与前端调试在线工具，免安装打开即用。',
  ),

  'regex' => array (
    'title' => '正则在线测试工具,正则匹配与校验工具',
    'keywords' => '正则在线测试,正则校验,正则匹配,正则工具,Regex,在线工具',
    'description' => '正则表达式在线测试工具：在线输入正则与测试文本，实时高亮匹配结果，支持 JavaScript、Java 等常用语法，内置常用正则示例，在线快速验证与调试，免安装打开即用。',
  ),

  'favicon' => array (
    'title' => 'favicon图标在线制作,ico在线生成与转换工具',
    'keywords' => 'favicon在线,ico图标在线制作,在线生成图标,png转ico,jpg转ico,网站图标,在线工具',
    'description' => 'favicon 图标在线制作工具：将 png、jpg、gif 等图片在线转换为 ico 格式，一键生成网站 favicon.ico 图标并下载，支持自定义尺寸，网页图标在线制作更简单，免安装打开即用。',
  ),

  'createmeta' => array (
    'title' => 'Meta标签在线生成,HTML5网页元信息生成工具',
    'keywords' => 'Meta标签在线生成,Keywords在线生成,Description生成,HTML5 Meta,网页SEO标签,在线工具',
    'description' => 'Meta 标签在线生成器：在线填写标题、关键词、描述等信息，自动生成 HTML5 移动端与 PC 端兼容的 meta 标签代码，支持一键复制，网页 SEO 优化在线工具，免安装打开即用。',
  ),

  'htaccess2nginx' => array (
    'title' => 'htaccess转nginx在线工具,伪静态转换工具',
    'keywords' => 'htaccess转nginx,apache转nginx,伪静态转换,RewriteRule,nginx规则,在线转换工具',
    'description' => 'htaccess 转 nginx 在线工具：将 Apache 伪静态规则一键在线转换为 Nginx rewrite 规则，支持 RewriteRule 常用指令转换，服务器迁移与伪静态配置在线工具，免安装打开即用。',
  ),

  'contenttype' => array (
    'title' => 'HTTP Content-Type在线查询,MIME类型与扩展名表',
    'keywords' => 'Content-Type在线查询,MIME类型,文件扩展名,HTTP头,响应头类型,在线工具',
    'description' => 'HTTP Content-Type 在线对照表：收录常用文件扩展名对应的 MIME 类型，在线搜索查询，接口开发、文件下载响应头配置、爬虫解析时在线快速查阅，免安装打开即用。',
  ),

  'jieri' => array (
    'title' => '世界节日在线查询,节日大全与中国农历节日',
    'keywords' => '世界节日在线查询,节日大全,农历节日,阳历节日,节日查询,在线工具',
    'description' => '世界节日在线查询工具：收录世界主要节日、中国传统农历节日与公历节日，支持按节日名称或日期在线搜索，快速查询节日时间与由来，免安装打开即用。',
  ),

  'runjs' => array (
    'title' => 'HTML/CSS/JS在线运行,前端代码在线预览工具',
    'keywords' => '在线运行JS,HTML前端在线预览,前端调试,代码编辑器,网页调试,在线工具',
    'description' => 'HTML/CSS/JS 在线运行工具：在线粘贴前端代码即可运行预览，支持 jQuery，实时在线调试网页效果，无需搭建本地环境，前端学习与代码验证在线利器，免安装打开即用。',
  ),

  'androidmanifest' => array (
    'title' => 'Android权限在线查询,Manifest权限大全',
    'keywords' => 'Android权限在线查询,Manifest权限,安卓权限,权限描述,Android开发,在线查询',
    'description' => 'Android 权限在线查询工具：收录安卓常用权限及权限说明，在线搜索快速了解每个权限用途与保护级别，Android 开发在线参考工具，免安装打开即用。',
  ),

  'random' => array (
    'title' => '随机数在线生成器,在线随机数字生成工具',
    'keywords' => '随机数在线生成,随机数字,在线随机数,数字生成器,抽奖随机,在线工具',
    'description' => '随机数在线生成器：自定义最小值、最大值、生成个数与是否唯一，在线快速生成随机数，可用于抽奖、测试数据、模拟场景，免安装打开即用。',
  ),

  'browserinfo' => array (
    'title' => '浏览器信息在线检测,客户端系统信息检测工具',
    'keywords' => '浏览器信息在线检测,客户端信息,操作系统检测,浏览器版本,UserAgent查看,在线工具',
    'description' => '浏览器信息在线检测：在线一键查看当前浏览器名称与版本、操作系统、屏幕分辨率、网络状态、插件数量等客户端信息，网站兼容性在线测试工具，免安装打开即用。',
  ),

  'nianlvli' => array (
    'title' => '年利率在线计算器,利息与收益计算工具',
    'keywords' => '年利率在线计算,利息计算器,年化收益率,存款利息,理财计算,在线工具',
    'description' => '年利率在线计算器：输入本金、年利率与存款天数，在线计算利息收益与年化收益率，支持反向推算，理财与存款收益对比更直观，免安装打开即用。',
  ),

  'tuya' => array (
    'title' => '在线涂鸦画板,在线画画工具,手绘涂鸦',
    'keywords' => '在线涂鸦,画板,在线画画,涂鸦工具,手绘板,在线绘画工具',
    'description' => '在线涂鸦画板：自由选择画笔颜色与粗细，在画布上随手涂鸦创作，画完一键保存到本地，无需安装，随时随地发挥创意，打开即用。',
  ),

  'currency' => array (
    'title' => '世界货币在线查询,汇率在线实时换算工具',
    'keywords' => '世界货币在线查询,货币名称,货币符号,货币查询,货币进位制,汇率在线换算,实时汇率,在线汇率转换,美元,欧元,日元,英镑,港币,人民币',
    'description' => '世界货币查询与实时汇率在线换算：提供全球各国及地区货币名称、符号表示与进位制信息，在线支持美元、欧元、日元、英镑、港币、人民币等主流货币实时汇率换算，外贸、旅游、金融从业者在线快速查阅，免安装打开即用。',
  ),

  'encode' => array (
    'title' => '编码在线转换,Base64/URL/Unicode在线转换工具',
    'keywords' => '编码在线转换,编码转换工具,Base64在线,URL编码,Unicode,UTF-8,ASCII,摩尔斯电码,图片转Base64',
    'description' => '编码在线转换工具大全：Base64 编码解码、URL 编码解码、Escape、Unicode、UTF-8、ASCII、摩尔斯电码、HTML 转义字符、迅雷快车旋风链接加密、图片转 Base64 等常用编码在线互转，一站式在线解决编码问题，免安装打开即用。',
  ),

  'bootstrapicon' => array (
    'title' => 'Bootstrap字体图标在线大全,Glyphicons图标查询',
    'keywords' => 'Bootstrap图标,Glyphicons,字体图标,图标大全,前端图标,在线查询',
    'description' => 'Bootstrap 字体图标在线大全：Glyphicons 图标库对照表，收录 250 多个图标，点击即可在线复制 class 引用，前端开发在线快速查找图标，免安装打开即用。',
  ),

  'refresh' => array (
    'title' => '网页定时自动刷新在线,在线定时刷新URL',
    'keywords' => '网页定时自动刷新,定时刷新URL,网页自动刷新,在线刷新,定时器,在线工具',
    'description' => '网页定时自动刷新在线工具：自定义刷新间隔时间，在线定时自动刷新指定网页或 URL，可用于页面监控、功能测试、演示循环等场景，免安装打开即用。',
  ),

  'tesufuhao' => array (
    'title' => '特殊符号在线大全,符号一键复制工具',
    'keywords' => '特殊符号大全,特殊符号在线,爱心符号,表情符号,网名符号,符号一键复制,在线工具',
    'description' => '特殊符号在线大全：收集爱心、表情、星座、数学、货币、箭头等各类特殊符号，分类展示一键在线复制，网名、昵称、排版装饰好工具，免安装打开即用。',
  ),

  'editor' => array (
    'title' => '在线Markdown编辑器,HTML在线编辑器,Markdown转HTML',
    'keywords' => '在线Markdown编辑器,Markdown在线编辑器,Html在线编辑器,富文本在线编辑器,Markdown转Html,Html转Markdown,Markdown与Html互转,在线文章编辑器',
    'description' => '在线 Markdown 编辑器与 Html 富文本编辑器，基于 Vditor 引擎，支持所见即所得、即时渲染、分屏预览在线编辑，可视化编辑与 HTML 源码切换，实现 Markdown 与 Html 在线互转；内置代码高亮、自动保存草稿、一键复制，下载 html/md、全屏与字数统计，在线写作、排版与程序员笔记工具，免安装打开即用。',
  ),

  'areacode' => array (
    'title' => '世界各国区号在线查询,国际电话区号与时差',
    'keywords' => '国际区号在线查询,世界各国区号,电话区号,时差查询,域名后缀,在线查询',
    'description' => '世界各国区号在线查询：在线提供全球各国国际电话区号、时差与域名后缀信息，支持在线搜索，外贸沟通、国际业务、电话拨打在线必备参考，免安装打开即用。',
  ),

  'chaodai' => array (
    'title' => '中国历史朝代在线年表,朝代时间与都城查询',
    'keywords' => '历史朝代在线查询,朝代年表,朝代时间,朝代都城,中国历史,在线工具',
    'description' => '中国历史朝代在线年表：历代朝代起止时间、历经年限、都城位置及现今对应地名，历史学习与查阅在线参考，免安装打开即用。',
  ),

  'barcode' => array (
    'title' => '条形码在线生成器,支持多种条形码格式',
    'keywords' => '条形码在线生成,条形码生成器,ean13,code128,code39,在线条形码,在线工具',
    'description' => '条形码在线生成器：支持 EAN8、EAN13、CODE128、CODE39、CODABAR 等 13 种条形码格式，输入内容即时在线生成条形码图片，商品标识与测试在线工具，免安装打开即用。',
  ),

  'uuid' => array (
    'title' => 'UUID/GUID在线生成器,批量生成唯一标识符',
    'keywords' => 'UUID在线生成,GUID生成,唯一标识符,批量生成UUID,在线UUID,在线工具',
    'description' => 'UUID/GUID 在线生成器：支持在线批量生成全局唯一标识符，可自定义生成数量与格式，开发测试、数据库主键、分布式系统标识在线生成，免安装打开即用。',
  ),

  'autoformat' => array (
    'title' => '文章在线自动排版工具,一键排版与格式化',
    'keywords' => '文章自动排版在线,一键排版,文章排版,论文排版,文本格式化,在线工具',
    'description' => '文章在线自动排版工具：一键在线排版杂乱文本，自动分段、首行缩进、去除多余空行空格，支持小说、论文等纯文本排版，让文章更整洁易读，免安装打开即用。',
  ),

  'dns' => array (
    'title' => '公共DNS在线大全,阿里DNS/Google DNS/114DNS',
    'keywords' => '公共DNS在线,DNS服务器,阿里DNS,百度DNS,Google DNS,114DNS,DNS设置,在线查询',
    'description' => '免费公共 DNS 在线大全：收录阿里、百度、Google、114、OpenDNS 等国内外公共 DNS 服务器地址，在线一键复制，网络加速与 DNS 配置在线参考，免安装打开即用。',
  ),

  'subnetmask' => array (
    'title' => '子网掩码在线计算器,IP子网划分工具',
    'keywords' => '子网掩码在线计算,子网计算,IP计算,子网划分,掩码换算,在线工具',
    'description' => '子网掩码在线计算器：在线计算子网掩码与 IP 地址换算，支持子网划分、掩码各进制表示换算、IP 进制转换，局域网规划与网络管理在线工具，免安装打开即用。',
  ),

  'lishishangdejintian' => array (
    'title' => '历史上的今天在线查询,今日历史大事',
    'keywords' => '历史上的今天,历史大事,今日历史,历史事件,在线查询',
    'description' => '历史上的今天在线查询：每日更新今日历史上的重大事件、人物纪念与诞辰等记录，一键在线查看历史上今天发生的大事，每天增长历史知识，免费打开即用。',
  ),

  'html2js' => array (
    'title' => 'HTML转JS在线工具,Html拼接JS代码转换',
    'keywords' => 'HTML转JS,JS转HTML,Html拼接JS,JS脚本转换,前端工具,在线转换',
    'description' => 'HTML 与 JS 在线互转工具：HTML 代码在线拼接为 JS 字符串、JS 字符串转回 HTML，自动处理转义，前端动态拼接页面代码在线效率更高，免安装打开即用。',
  ),

  'calc' => array (
    'title' => '单位在线换算器,长度面积体积温度换算',
    'keywords' => '单位在线换算,长度换算,面积换算,体积换算,温度换算,时间换算,速度换算,压力换算',
    'description' => '在线单位换算器：长度、面积、体积、温度、时间、速度、压力、功率、角度、大小、力、热量、密度等 13 类单位在线互转，输入数值自动在线换算，浏览器本地处理，免安装打开即用。',
  ),

  'format' => array (
    'title' => '代码在线格式化,14种语言美化与排版',
    'keywords' => '代码在线格式化,代码美化,JS在线格式化,SQL格式化,JSON格式化,CSS格式化,HTML格式化,PHP格式化',
    'description' => '在线代码格式化工具：支持 C/C++/C#/Java/PHP/Python/Ruby/Perl/VBScript/SQL/XML/CSS/JS/HTML 共 14 种语言在线格式化与美化排版，JS/CSS/HTML 支持压缩输出，全程浏览器在线本地处理，免安装打开即用。',
  ),

  'encrypt' => array (
    'title' => '加密解密在线工具,AES/DES/MD5/SHA在线加密',
    'keywords' => '在线加密解密,加密解密工具,AES在线加密,DES加密,RC4加密,Rabbit加密,TripleDES,MD5加密,SHA加密,htpasswd',
    'description' => '在线加密解密工具大全：提供 AES、DES、RC4、Rabbit、TripleDES 对称加密解密，MD5、SHA1、SHA256 等哈希加密，HMAC 及 htpasswd 密码文件生成，全程浏览器在线本地运算，数据不离开，免安装打开即用。',
  ),

  'textconvert' => array (
    'title' => '文本在线转换工具,汉字转拼音,火星文与人民币大写',
    'keywords' => '文本在线转换,汉字转拼音,火星文转换,文字竖排,文字翻转,人民币大写,驼峰下划线,在线工具',
    'description' => '文本在线转换工具合集：汉字转拼音及读音、火星文转换、文字竖排、文字翻转、全角半角互转、英文大小写转换、驼峰与下划线命名转换、人民币大写金额转换，全部在线浏览器本地完成，免安装打开即用。',
  ),

  'texttool' => array (
    'title' => '文本在线工具,内容去重,字符串压缩与文本对比',
    'keywords' => '文本在线工具,内容去重,去重复行,字符串压缩,去空格,文本对比',
    'description' => '文本在线工具合集：提供按行内容去重、字符串压缩（去空格换行）、文本内容差异对比等功能，全部在线浏览器本地完成，文本在线处理效率高，免安装打开即用。',
  ),

  'convert' => array (
    'title' => '数值在线转换工具,时间戳,进制,颜色与rem转换',
    'keywords' => '时间戳在线转换,Unix时间戳,进制转换,颜色在线转换,HEX RGB,调色板,rem,px转换,在线工具',
    'description' => '数值与单位在线转换工具合集：Unix 时间戳与日期在线互转、世界主要城市实时时间、在线时钟、二进制/八进制/十进制/十六进制互转、HEX 与 RGB 在线转换及调色板、rem/px 在线转换，全部浏览器本地完成，免安装打开即用。',
  ),

  'jsencrypt' => array (
    'title' => 'JS加密解密在线工具,JS混淆与加解密',
    'keywords' => 'JS在线加密,JS解密,JS混淆,JS代码加密,JavaScript加密,在线工具',
    'description' => 'JS 加密解密在线工具：提供 Packer 式 JS 代码加密与解密、JS 代码混合加密（变量名混淆），全部在浏览器本地完成，支持在线加密、解密与混淆，免安装打开即用。',
  ),

);
?>