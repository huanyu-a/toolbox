<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function Fcurl($url, $ifpost = 0, $datafields = '', $cookiefile = '', $v = false)
{
    $ip_long = array(
        array('607649792', '608174079'), //36.56.0.0-36.63.255.255
        array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
        array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
        array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
        array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
        array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
        array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
        array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
        array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
        array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
    );
    $rand_key = mt_rand(0, 9);
    $ip = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
    $header = array(
        "Connection: Keep-Alive",
        "Accept: text/html, application/xhtml+xml, */*",
        "Pragma: no-cache",
        "Accept-Language: zh-Hans-CN,zh-Hans;q=0.8,en-US;q=0.5,en;q=0.3",
        "User-Agent: Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/6.0)",
        'CLIENT-IP:' . $ip,
        'X-FORWARDED-FOR:' . $ip,
        'REMOTE_ADDR:' . $ip
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, $v);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $ifpost && curl_setopt($ch, CURLOPT_POST, $ifpost);
    $ifpost && curl_setopt($ch, CURLOPT_POSTFIELDS, $datafields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $cookiefile && curl_setopt($ch, CURLOPT_COOKIE, $cookiefile);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); //允许执行的最长秒数
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    $ok = curl_exec($ch);
    curl_close($ch);
    unset($ch);
    $ok = strToUTF8($ok);
    return $ok;
}

/**
 * 删除当前目录及其目录下的所有目录和文件
 * @param string $path 待删除的目录
 * @note  $path路径结尾不要有斜杠/(例如:正确[$path='./static/image'],错误[$path='./static/image/'])
 */
function deleteDir($path)
{
    if (is_dir($path)) {
        //扫描一个目录内的所有目录和文件并返回数组
        $dirs = scandir($path);
        foreach ($dirs as $dir) {
            //排除目录中的当前目录(.)和上一级目录(..)
            if ($dir != '.' && $dir != '..') {
                //如果是目录则递归子目录，继续操作
                $sonDir = $path . '/' . $dir;
                if (is_dir($sonDir)) {
                    //递归删除
                    deleteDir($sonDir);
                    //目录内的子目录和文件删除后删除空目录
                    @rmdir($sonDir);
                } else {
                    //如果是文件直接删除
                    @unlink($sonDir);
                }
            }
        }
        @rmdir($path);
    }
}

/**
 * 站点绝对地址前缀（无尾斜杠）。
 * 优先取后台配置 web.site.url，留空则自动检测当前请求域名。
 */
function site_base()
{
    $cfg = trim((string)config('web.site.url'));
    if ($cfg !== '') {
        $cfg = rtrim($cfg, '/');
        if (strpos($cfg, 'http') !== 0) { $cfg = 'https://' . ltrim($cfg, '/'); }
        return $cfg;
    }
    return request()->domain();
}

function pageapi($key)
{
    $page = array(
        'index' => '首页',
        'header' => '全局<head>插件',
        'title' => '页面标题',
        'canonical' => '权威URL',
        'keywords' => '页面关键词',
        'description' => '页面描述',
        'url' => '站点域名',
    );
    return isset($page[$key]) ? $page[$key] : $key;
}

/*生成唯一标志
*标准的UUID格式为：xxxxxxxx-xxxx-xxxx-xxxxxx-xxxxxxxxxx(8-4-4-4-12)
*/

function uuid($num = 1, $dx = 2)
{
    $array = array();
    for ($i = 0; $num > $i; $i++) {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr($chars, 0, 8) . '-'
            . substr($chars, 8, 4) . '-'
            . substr($chars, 12, 4) . '-'
            . substr($chars, 16, 4) . '-'
            . substr($chars, 20, 12);
        if (!in_array($uuid, $array)) {
            $array[] = ($dx == 1) ? strtoupper($uuid) : strtolower($uuid);
        } else {
            $i--;
        }
    }
    return $array;
}

/**
 * 生成GUID
 */
function create_guid()
{
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


function getBrowserOs()
{
    $flag = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/Windows[\d\. \w]*/', $flag, $match)) {
        $sys = $match[0];
    } else {
        $sys = 'Unknown';
    }
    // 检查操作系统
    if (preg_match('/Chrome\/[\d\.\w]*/', $flag, $match)) {
        // 检查Chrome
        $browser = $match[0];
    } elseif (preg_match('/Safari\/[\d\.\w]*/', $flag, $match)) {
        // 检查Safari
        $browser = $match[0];
    } elseif (preg_match('/MSIE [\d\.\w]*/', $flag, $match)) {
        // IE
        $browser = $match[0];
    } elseif (preg_match('/Opera\/[\d\.\w]*/', $flag, $match)) {
        // opera
        $browser = $match[0];
    } elseif (preg_match('/Firefox\/[\d\.\w]*/', $flag, $match)) {
        // Firefox
        $browser = $match[0];
    } elseif (preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $flag, $match)) {
        //OmniWeb
        $browser = $match[2];
    } elseif (preg_match('/Netscape([\d]*)\/([^\s]+)/i', $flag, $match)) {
        //Netscape
        $browser = $match[2];
    } elseif (preg_match('/Lynx\/([^\s]+)/i', $flag, $match)) {
        //Lynx
        $browser = $match[1];
    } elseif (preg_match('/360SE/i', $flag, $match)) {
        //360SE
        $browser = '360安全浏览器';
    } elseif (preg_match('/SE 2.x/i', $flag, $match)) {
        //搜狗
        $browser = '搜狗浏览器';
    } else {
        $browser = 'unkown';
    }
    return [$sys, $browser];
}

function getip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
// IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

function strToUTF8($strText)
{
    $encode = mb_detect_encoding($strText, array('UTF-8', 'GB2312', 'GBK', 'EUC-CN'));
    // mb_detect_encoding 可能返回 EUC-CN（GB2312 别名），但 iconv 不认识，需映射为 GB2312
    if ($encode == 'EUC-CN') {
        $encode = 'GB2312';
    }
    if ($encode != "UTF-8") {
        return @iconv($encode, 'UTF-8', $strText);
    } else {
        return $strText;
    }
}

function urlheader($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_HEADER, 1);  //输出header信息
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  //不显示网页内容
    curl_setopt($curl, CURLOPT_ENCODING, ''); //允许执行gzip
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_TIMEOUT, 8);
    $data = curl_exec($curl);
    $pHeader = array();
    if (!curl_errno($curl)) {
        $info = curl_getinfo($curl);
        $httpHeaderSize = $info['header_size'];  //header字符串体积
        $Header = substr($data, 0, $httpHeaderSize); //获得header字符串
        preg_match_all("/([A-Za-z_\-]*?): (.*?)\r/iU", $Header, $pat_array);
        $headers = array();
        foreach ($pat_array['1'] as $key => $vo) {
            $headers[$vo] = $pat_array['2'][$key];
        }
        $pHeader['head'] = $headers;
        $data = substr($data, $httpHeaderSize);
        $ysize = strlen($data);
        $pHeader['jc'] = array(
            'ystype' => isset($headers['Content-Encoding']) ? $headers['Content-Encoding'] : '-',
            'ysize' => $ysize,
            'yssize' => $info['size_download'],
            'ysl' => @round((100 - ($info['size_download'] / $ysize * 100)), 3),
        );
    }
    curl_close($curl);
    return $pHeader;
}

function urltitlecode($url)
{
    $url = htmlspecialchars_decode($url);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  //不显示网页内容
    curl_setopt($curl, CURLOPT_ENCODING, ''); //允许执行gzip
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_TIMEOUT, 8);
    $data = curl_exec($curl);
    $code = '404';
    $title = '页面不见啦！';
    if (!curl_errno($curl)) {
        $data = strToUTF8($data);
        $info = curl_getinfo($curl);
        $data = htmlspecialchars_decode($data);
        preg_match("/.*<title>(.*?)<\/title>.*/is", $data, $match);
        $title = isset($match['1']) ? $match['1'] : ' - ';
        $code = $info['http_code'];
    }
    curl_close($curl);
    return array(
        'code' => $code,
        'title' => $title
    );
}

function is_url($url)
{
    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
        return true;
    } else {
        return false;
    }
}

function page($array, $pagesize, $current)
{
    $_return = array();
    $count = Count($array);
    $total = ceil($count / $pagesize);//求总页数
    $current = ($current > ($total) ? ($total) : $current);//当前页如果大于总页数，当前页为最后一页
    $start = ($current - 1) * $pagesize;//分页显示时，应该从多少条信息开始读取
    $page = ($start + $pagesize);
    $page = $count < $page ? $count : $page;
    for ($i = $start; $i < $page; $i++) {
        if (isset($array[$i])) array_push($_return, $array[$i]);//将该显示的信息放入数组 $_return 中
    }
    return array(
        $_return,
        $total,
        $count
    );
}

function htmlTotext($str)
{
    $str = str_replace(array("\n", "\r", "\t", ' ', '&nbsp;'), '', $str);
    $str = preg_replace("/<style.*?>.*?<\/style.*?>/is", "", $str);
    $str = preg_replace("/<script.*?>.*?<\/script.*?>/is", "", $str);
    $str = strip_tags($str);
    return $str;
}

function webstatus($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_HEADER, 1);  //输出header信息
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  //不显示网页内容
    curl_setopt($curl, CURLOPT_ENCODING, ''); //允许执行gzip
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_TIMEOUT, 8);
    $data = curl_exec($curl);
    $Header = '';
    $code = '';
    $ip = '';
    if (!curl_errno($curl) && $data) {
        $info = curl_getinfo($curl);
        $httpHeaderSize = $info['header_size'];  //header字符串体积
        $Header = substr($data, 0, $httpHeaderSize); //获得header字符串
        $code = $info['http_code'];
        $ip = $info['primary_ip'];
    }
    curl_close($curl);
    return array(
        'head' => str_replace(array("\r", "\n"), array("<br/>", ""), $Header),
        'code' => $code,
        'ip' => $ip
    );
}

function get_curl($url, $post=0, $referer=0, $cookie=0, $header=0, $ua=0, $nobody=0, $addheader=0)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$httpheader[] = "Accept: */*";
	$httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
	$httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
	$httpheader[] = "Connection: close";
	if($addheader){
		$httpheader = array_merge($httpheader, $addheader);
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	if ($post) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if ($header) {
		curl_setopt($ch, CURLOPT_HEADER, true);
	}
	if ($cookie) {
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}
	if($referer){
		curl_setopt($ch, CURLOPT_REFERER, $referer);
	}
	if ($ua) {
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	}
	else {
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36");
	}
	if ($nobody) {
		curl_setopt($ch, CURLOPT_NOBODY, 1);
	}
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}

//域名whois查询（uapis 免费接口，返回标准文本 whois）
function whois_query($domain)
{
    $url = 'https://uapis.cn/api/v1/network/whois?domain=' . urlencode($domain) . '&format=text';
    $data = get_curl($url, 0, 'https://uapis.cn/');
    if(!$data) return false;
    $arr = json_decode($data, true);
    if (!is_array($arr) || !isset($arr['whois'])) return false;
    return $arr['whois'];
}


//ICP备案查询
function icp_query($domain){
    // 优先：uapis.cn 免费接口（稳定、无需 key）
    $uapis = get_curl('https://uapis.cn/api/v1/network/icp?domain=' . urlencode($domain), 0, 'https://uapis.cn/');
    if ($uapis) {
        $arr = json_decode($uapis, true);
        if (is_array($arr) && isset($arr['code']) && $arr['code'] == '200') {
            // uapis 对无备案域名返回 code:200 但字段为"查询失败"
            if (isset($arr['serviceLicence']) && $arr['serviceLicence'] === '查询失败') {
                return ['code'=>0, 'total'=>0, 'data'=>[]];
            }
            return ['code'=>0, 'total'=>1, 'data'=>[[
                'domain'=>$domain,
                'mainLicence'=>isset($arr['mainLicence']) ? $arr['mainLicence'] : '',
                'webLicence'=>isset($arr['serviceLicence']) ? $arr['serviceLicence'] : '',
                'unitName'=>isset($arr['unitName']) ? $arr['unitName'] : '',
                'unitType'=>isset($arr['natureName']) ? $arr['natureName'] : '',
                'updateTime'=>isset($arr['updateTime']) ? $arr['updateTime'] : '',
                'limitAccess'=>isset($arr['limitAccess']) ? $arr['limitAccess'] : '',
                'contentTypeName'=>isset($arr['contentTypeName']) ? $arr['contentTypeName'] : ''
            ]]];
        }
        if (is_array($arr) && isset($arr['code']) && in_array($arr['code'], array('404', 'NOT_FOUND'), true)) {
            return ['code'=>0, 'total'=>0, 'data'=>[]];
        }
    }
    // 兜底：工信部官方接口
    $timeStamp = time();
    $authKey = md5("testtest" . $timeStamp);
    $referer = 'https://beian.miit.gov.cn/';
    $headers = ['Origin: https://beian.miit.gov.cn'];
    $url = 'https://hlwicpfwc.miit.gov.cn/icpproject_query/api/auth';
    $post = 'authKey='.$authKey.'&timeStamp='.$timeStamp;
    $response = get_curl($url, $post, $referer, 0, 0, 0, 0, $headers);
    $arr = json_decode($response, true);
    if(isset($arr['code']) && $arr['code']==200){
        $token=$arr['params']['bussiness'];

        $url = 'https://hlwicpfwc.miit.gov.cn/icpproject_query/api/icpAbbreviateInfo/queryByCondition';
        $post = json_encode(['pageNum'=>'','pageSize'=>'','unitName'=>$domain,'serviceType'=>1]);
        $headers[] = 'Content-Type: application/json; charset=UTF-8';
        $headers[] = 'token:'.$token;
        $response = get_curl($url, $post, $referer, 0, 0, 0, 0, $headers);
        $arr = json_decode($response, true);
        if(isset($arr['code']) && $arr['code']==200){
            $list = [];
            foreach($arr['params']['list'] as $row){
                $list[] = ['domain'=>$row['domain'], 'mainLicence'=>$row['mainLicence'], 'webLicence'=>$row['serviceLicence'], 'unitName'=>$row['unitName'], 'unitType'=>$row['natureName'], 'updateTime'=>$row['updateRecordTime'], 'limitAccess'=>$row['limitAccess'], 'contentTypeName'=>$row['contentTypeName']];
            }
            return ['code'=>0, 'total'=>$arr['params']['total'], 'data'=>$list];
        }elseif(isset($arr['msg'])){
            throw new Exception($arr['msg']);
        }else{
            throw new Exception('查询接口(query)请求失败');
        }

    }elseif(isset($arr['msg'])){
        throw new Exception($arr['msg']);
    }else{
        throw new Exception('查询接口(auth)请求失败');
    }
}

function checkdomain($domain){
	if(empty($domain))return false;
	if (!preg_match('/^[a-zA-Z0-9:\_\.\-]{2,512}$/i', $domain) || strpos($domain, '.') === false || substr($domain, -1) == '.' || substr($domain, 0 ,1) == '.' || strpos($domain, '*') !== false) {
		return false;
	}
	return true;
}
/**
 * 百度统计混淆防爬代码
 * 将 hm.baidu.com 域名以分段数组 + String.fromCharCode 形式组装，避免整段明文出现在页面，
 * 降低被广告拦截器 / 爬虫关键词规则直接识别的概率；用户只需提供百度统计 ID，程序自动生成。
 * @param string $id 百度统计站点 ID
 * @return string 生成的 <script> 统计代码；未启用或 ID 非法时返回空
 */
function build_tongji_code($id = '')
{
    $id = trim((string)$id);
    if ($id === '' || !preg_match('/^[a-zA-Z0-9]+$/', $id)) return '';
    $js = "(function(){var _hmt=_hmt||[];(function(){var hm=document.createElement(\"script\");"
        . "hm.src=\"https://\"+[\"hm\",\"baidu\",\"com\"].join(String.fromCharCode(46))"
        . "+\"/hm.js?\"+\"$id\";"
        . "var s=document.getElementsByTagName(\"script\")[0];s.parentNode.insertBefore(hm,s)})();})();";
    return '<script type="text/javascript">' . "\n" . $js . "\n" . '</script>';
}

/**
 * 根据配置输出百度统计混淆代码到页面
 * 配置来源：SQLite 库（runtime/site_config.db，挂载卷，重建镜像不丢失）；
 * 库中从未配置过时回退旧版 config/tongji.php（兼容迁移）。
 * @return string 启用的统计代码；未启用 / 未配置返回空字符串
 */
function tongji_config_code()
{
    $enabled  = site_cfg_get('tongji_enabled');
    $baidu_id = site_cfg_get('tongji_baidu_id');
    if ($enabled === null && $baidu_id === null) {
        // 数据库从未写入：读旧版文件配置（升级过渡，写一次库后不再走这里）
        $cfg = config('tongji.');
        if (!empty($cfg['enabled']) && !empty($cfg['baidu_id'])) {
            return build_tongji_code($cfg['baidu_id']);
        }
        return '';
    }
    if ($enabled === '1' && preg_match('/^[a-zA-Z0-9]+$/', (string)$baidu_id)) {
        return build_tongji_code((string)$baidu_id);
    }
    return '';
}

/* ============================================================
 * 站点配置 KV 存储（SQLite）
 * 友情链接、百度统计等易被镜像覆盖的运行数据统一入库；
 * 库文件固定在 runtime 目录（Docker 挂载卷），重建/更新不丢。
 * ============================================================ */

/**
 * 获取站点配置；键不存在时返回 $default
 * @param string $key
 * @param mixed  $default 缺省用 null 表示"从未设置"，调用方据此做兼容分支
 */
function site_cfg_get($key, $default = null)
{
    try {
        $st = site_cfg_pdo()->prepare('SELECT v FROM config_kv WHERE k = ? LIMIT 1');
        $st->execute(array((string)$key));
        $v = $st->fetchColumn();
        return ($v === false || $v === null) ? $default : (string)$v;
    } catch (\Exception $e) {
        return $default;
    }
}

/** 写入站点配置（存在即覆盖） */
function site_cfg_set($key, $value)
{
    try {
        $st = site_cfg_pdo()->prepare('REPLACE INTO config_kv (k, v) VALUES (?, ?)');
        return (bool)$st->execute(array((string)$key, (string)$value));
    } catch (\Exception $e) {
        return false;
    }
}

/**
 * SQLite 连接（懒加载 + 自动建表），进程内复用
 */
function site_cfg_pdo()
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }
    $dir = defined('RUNTIME_PATH') ? RUNTIME_PATH : (sys_get_temp_dir() . DIRECTORY_SEPARATOR);
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
    $path = rtrim($dir, '/\\') . DIRECTORY_SEPARATOR . 'site_config.db';
    $pdo = new PDO('sqlite:' . $path);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_TIMEOUT, 5); // 并发写等锁，避免 busy 报错
    try { $pdo->exec('PRAGMA journal_mode=WAL'); } catch (\Exception $e) { /* 只读环境忽略 */ }
    $pdo->exec("CREATE TABLE IF NOT EXISTS config_kv (k TEXT PRIMARY KEY, v TEXT NOT NULL DEFAULT '')");
    $pdo->exec("CREATE TABLE IF NOT EXISTS friend_links (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL DEFAULT '',
        url TEXT NOT NULL DEFAULT '',
        nofollow INTEGER NOT NULL DEFAULT 1,
        sort INTEGER NOT NULL DEFAULT 100,
        status INTEGER NOT NULL DEFAULT 1,
        remark TEXT NOT NULL DEFAULT '',
        created_at TEXT NOT NULL DEFAULT (datetime('now','localtime'))
    )");
    return $pdo;
}

/**
 * 友情链接列表（结构化存储于 friend_links 表）
 * @param bool $onlyActive true 仅返回启用行（前台用）
 */
function friend_links_all($onlyActive = false)
{
    try {
        $sql = 'SELECT * FROM friend_links' . ($onlyActive ? ' WHERE status = 1' : '') . ' ORDER BY sort ASC, id ASC';
        return site_cfg_pdo()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        return array();
    }
}

/**
 * 旧数据一次性迁移：friend_links 表为空时，把旧 KV（friend_links_html 整段 HTML，
 * 其次内置默认串）里的 <a> 标签逐条解析入库。返回导入条数；已有数据直接返回 0。
 */
function friend_links_import_legacy()
{
    static $checked = false;
    if ($checked) {
        return 0; // 单次请求内只查一次
    }
    $checked = true;
    try {
        $cnt = (int)site_cfg_pdo()->query('SELECT COUNT(*) FROM friend_links')->fetchColumn();
    } catch (\Exception $e) {
        return 0;
    }
    if ($cnt > 0) {
        return 0;
    }
    $html = trim((string)site_cfg_get('friend_links_html', ''));
    if ($html === '') {
        $html = site_friend_links_default();
    }
    $n = 0;
    if (!preg_match_all('/<a\s[^>]*href=["\']([^"\']+)["\'][^>]*>(.*?)<\/a>/is', $html, $m, PREG_SET_ORDER)) {
        return 0;
    }
    $st = site_cfg_pdo()->prepare('INSERT INTO friend_links (name, url, nofollow, sort, status) VALUES (?, ?, ?, ?, 1)');
    foreach ($m as $a) {
        $url  = trim($a[1]);
        $name = trim(strip_tags($a[2]));
        if ($url === '' || $name === '' || !preg_match('#^https?://#i', $url)) {
            continue;
        }
        $st->execute(array(
            $name,
            $url,
            stripos($a[0], 'nofollow') !== false ? 1 : 0, // 继承原链接的 nofollow 标记
            ($n + 1) * 10,                                // 保持原显示顺序
        ));
        $n++;
    }
    return $n;
}

/**
 * 友情链接默认内容（与线上最后一次编辑一致，兜底防空白）
 */
function site_friend_links_default()
{
    return <<<'HTML'
<div class="friend-link-row">
    友情链接：
    <a href="https://beian.miit.gov.cn/" target="_blank">京ICP备2023017689号</a>
    <span class="fl-sep">|</span>
    <a href="https://www.bx9y.com.cn/" target="_blank">知识分享萌</a>
    <span class="fl-sep">|</span>
    <a href="https://hao.bx9y.com.cn/" target="_blank">寰宇的导航站</a>
</div>
HTML;
}

/**
 * 输出友情链接 HTML（前台 footer 的 view/link.html 调用）
 * 数据来源 friend_links 表（增删改在后台管理）；表空时先尝试旧数据一次性迁移。
 */
function site_render_friend_links()
{
    friend_links_import_legacy();
    $rows = friend_links_all(true);
    if (!$rows) {
        return '';
    }
    $items = array();
    foreach ($rows as $r) {
        $url = trim((string)$r['url']);
        if (!preg_match('#^https?://#i', $url)) {
            continue; // 只输出 http/https，防 javascript: 伪协议
        }
        $rel = !empty($r['nofollow']) ? ' rel="nofollow noopener"' : '';
        $items[] = '<a href="' . htmlspecialchars($url, ENT_QUOTES) . '" target="_blank"' . $rel . '>'
                 . htmlspecialchars((string)$r['name'], ENT_QUOTES) . '</a>';
    }
    if (!$items) {
        return '';
    }
    return '<div class="friend-link-row">友情链接：' . implode('<span class="fl-sep">|</span>', $items) . '</div>';
}
