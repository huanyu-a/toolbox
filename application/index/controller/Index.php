<?php

namespace app\index\controller;

use Exception;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $data = array();
        $base = site_base();
        // 工具注册表（分类导航数据源，TP5.1 顶层配置需用尾点 pull 读取）
        $data['tools'] = config('tools.');
        // 统一改写为绝对地址（后台 web.site.url 可固定域名，留空自动检测）
        foreach ((array)$data['tools'] as $ci => $cat) {
            foreach ((array)$cat['items'] as $ii => $item) {
                if (isset($item['url']) && strpos($item['url'], 'http') !== 0) {
                    $data['tools'][$ci]['items'][$ii]['url'] = $base . $item['url'];
                }
            }
        }
        // 工具总数（改写后重新统计）
        $toolCount = 0;
        foreach ((array)$data['tools'] as $cat) {
            $toolCount += isset($cat['items']) ? count($cat['items']) : 0;
        }
        $data['homeCount'] = $toolCount;
        // 随机 20 个工具（底部"随机推荐"区块数据源）
        $allTools = array();
        foreach ((array)$data['tools'] as $cat) {
            foreach ((array)$cat['items'] as $item) {
                $item['cat'] = isset($cat['cat']) ? $cat['cat'] : '';
                $allTools[] = $item;
            }
        }
        shuffle($allTools);
        $data['randTools'] = array_slice($allTools, 0, 20);
        // 当前工具信息（面包屑 + 导航高亮 + SEO）
        $act = input('act', 'index');
        $data['act'] = $act;
        $data['current_act'] = $act;
        $data['current_cat'] = '';
        $data['current_tool_name'] = '';
        $data['current_url_rel'] = $act === 'index' ? '/' : '/' . trim($act, '/') . '/';
        $data['current_url'] = $base . $data['current_url_rel'];
        foreach ((array)$data['tools'] as $cat) {
            foreach ((array)$cat['items'] as $item) {
                if (rtrim($item['url'], '/') === rtrim($data['current_url'], '/')) {
                    $data['current_cat'] = $cat['cat'];
                    $data['current_tool_name'] = $item['name'];
                    break 2;
                }
            }
        }
        // 页面 SEO 元信息（来自 web 配置）
        $webCfg = config('web.');
        $pageCfg = (isset($webCfg[$act]) && is_array($webCfg[$act])) ? $webCfg[$act] : array();
        $siteName = isset($webCfg['site']['name']) ? $webCfg['site']['name'] : '在线工具箱';
        $data['page_title'] = isset($pageCfg['title']) ? $pageCfg['title'] : $siteName;
        $data['page_desc'] = isset($pageCfg['description']) ? $pageCfg['description'] : '';
        $data['page_keywords'] = isset($pageCfg['keywords']) ? $pageCfg['keywords'] : '';
        // JSON-LD 结构化数据（控制器拼接，避免模板解析 JSON 花括号冲突）
        $domain = site_base();
        if ($act === 'index') {
            $data['jsonld'] = json_encode(array(
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => $siteName,
                'description' => isset($webCfg['index']['description']) ? $webCfg['index']['description'] : '',
                'inLanguage' => 'zh-CN',
                'url' => $domain . '/',
                'potentialAction' => array(
                    '@type' => 'SearchAction',
                    'target' => $domain . '/?s={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ),
            ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            $breadcrumb = array(
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => array(
                    array('@type' => 'ListItem', 'position' => 1, 'name' => '首页', 'item' => $domain . '/'),
                    array('@type' => 'ListItem', 'position' => 2, 'name' => $data['current_cat'], 'item' => $domain . '/#cat-' . $data['current_cat']),
                    array('@type' => 'ListItem', 'position' => 3, 'name' => $data['current_tool_name'], 'item' => $data['current_url']),
                ),
            );
            $app = array(
                '@context' => 'https://schema.org',
                '@type' => 'WebApplication',
                'name' => $data['page_title'],
                'description' => $data['page_desc'],
                'url' => $data['current_url'],
                'applicationCategory' => 'UtilitiesApplication',
                'inLanguage' => 'zh-CN',
                'operatingSystem' => 'Any',
            );
            $data['jsonld'] = json_encode($breadcrumb, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                . "\n" . json_encode($app, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        switch ($act) {
            case 'uuid':
                $data['uuid_number'] = input('uuid_number', 1);
                $data['uuid_letter'] = input('uuid_letter', 2);
                $data['uuid'] = uuid($data['uuid_number'], $data['uuid_letter']);
                break;
            case 'caiji':
                $data['url'] = input('url', '');
                $data['content'] = $data['url'] ? Fcurl($data['url']) : '';
                break;
            case 'ip':
                if (request()->isPost()) {
                    $ip = input('post.ip');
                    return $this->redirect('/ip/' . $ip . '.html', 302);
                }
                $ips = new \Net\Ips(app()->getRootPath().'QQWry.dat');
                $ip = input('ip');
                if ($ip) {
                    $data['ym']['ip'] = $ip;
                    $data['ym']['domain'] = gethostbyname($ip);
                    $domain = preg_replace('/(\d+)..*/', '\\1', $data['ym']['domain']);
                    if ('1' <= $domain && $domain <= '126') {
                        $data['ym']['fw'] = '1.0.0.1 - 126.155.255.254';
                    } elseif ('128' <= $domain && $domain <= '191') {
                        $data['ym']['fw'] = '128.0.0.1 - 191.255.255.254';
                    } elseif ('192' <= $domain && $domain <= '223') {
                        $data['ym']['fw'] = '192.0.0.1 - 223.255.255.254';
                    }
                    $fwq = $ips->Getlocation($data['ym']['domain']);
                    $data['ym']['city'] = strToUTF8($fwq['country'] . ' ' . $fwq['area']);
                }
                $data['getip'] = getip();
                $data['getBrowserOs'] = getBrowserOs();
                $city = $ips->Getlocation($data['getip']);
                $data['city'] = strToUTF8($city['country'] . ' ' . $city['area']);
                break;
            case 'favicon':
                $data['upmsg'] = '';
                if (request()->isPost()) {
                    $upimage = input('file.upimage');
                    $getInfo = $upimage->getInfo();
                    if (isset($getInfo['tmp_name']) && $getInfo['tmp_name'] && is_uploaded_file($getInfo['tmp_name'])) {
                        if ($getInfo['type'] > 210000) {
                            $data['upmsg'] = "<font color=\"red\">你上传的文件体积超过了限制 最大不能超过200K</font>";
                        } else {
                            $fileext = array("image/pjpeg", "image/gif", "image/x-png", "image/png", "image/jpeg", "image/jpg");
                            if (!in_array($getInfo['type'], $fileext)) {
                                $data['upmsg'] = "<font color=\"red\">你上传的文件格式不正确 仅支持 jpg，gif，png</font>";
                            } else {
                                $type = substr(strrchr($getInfo['name'], '.'), 1);
                                switch ($type) {
                                    case 'pjpeg':
                                    case 'jpeg':
                                    case 'jpg':
                                        $im = imagecreatefromjpeg($getInfo['tmp_name']);
                                        break;
                                    case 'x-png':
                                    case 'png':
                                        $im = imagecreatefrompng($getInfo['tmp_name']);
                                        break;
                                    case 'gif':
                                        $im = imagecreatefromgif($getInfo['tmp_name']);
                                        break;
                                    default:
                                        $im = null;
                                }
                                if ($im) {
                                    $imginfo = getimagesize($getInfo['tmp_name']);
                                    if (!is_array($imginfo)) {
                                        $data['upmsg'] = "<font color=\"red\">图形格式错误！</font>";
                                    } else {
                                        switch (input('favicon_size')) {
                                            case 1;
                                                $resize_im = imagecreatetruecolor(16, 16);
                                                $size = 16;
                                                break;
                                            case 2;
                                                $resize_im = imagecreatetruecolor(32, 32);
                                                $size = 32;
                                                break;
                                            case 3;
                                                $resize_im = imagecreatetruecolor(48, 48);
                                                $size = 48;
                                                break;
                                            case 4;
                                                $resize_im = imagecreatetruecolor(64, 64);
                                                $size = 64;
                                                break;
                                            case 5;
                                                $resize_im = imagecreatetruecolor(128, 128);
                                                $size = 128;
                                                break;
                                            default;
                                                $resize_im = imagecreatetruecolor(32, 32);
                                                $size = 32;
                                                break;
                                        }
                                        imagecopyresampled($resize_im, $im, 0, 0, 0, 0, $size, $size, $imginfo[0], $imginfo[1]);
                                        $icon = new \Net\Ico();
                                        $gd_image_array = array($resize_im);
                                        $icon_data = $icon->GD2ICOstring($gd_image_array);
                                        header("Accept-Ranges: bytes");
                                        header("Accept-Length: " . strlen($icon_data));
                                        header("Content-type: application/octet-stream");
                                        header("Content-Disposition: attachment; filename=" . 'favicon.ico');
                                        return $icon_data;
                                    }
                                } else {
                                    $data['upmsg'] = "<font color=\"red\">生成错误请重试！</font>";
                                }
                            }
                        }
                    }
                }
                break;
            case 'refresh':
                $url = input('url');
                if ($url) {
                    $content = Fcurl($url);
                    return $content;
                }
                break;
            case 'lishishangdejintian':
                // 优先请求在线接口（数据实时更新），失败时前端自动回退本地内置数据
                $data['list'] = array();
                $lsjt = Fcurl('https://v2.xxapi.cn/api/history');
                if ($lsjt) {
                    $decoded = json_decode($lsjt, true);
                    if (is_array($decoded) && isset($decoded['code']) && $decoded['code'] == 200 && isset($decoded['data']) && is_array($decoded['data'])) {
                        foreach ($decoded['data'] as $item) {
                            if (!is_string($item) || $item === '') continue;
                            // 形如：1999年08月19日 事件描述
                            if (preg_match('/^(\d{4})年\d{2}月\d{2}日\s*(.*)$/u', trim($item), $m)) {
                                $data['list'][] = array('y' => $m[1], 't' => 1, 'd' => $m[2]);
                            } else {
                                $data['list'][] = array('y' => '', 't' => 1, 'd' => trim($item));
                            }
                        }
                    }
                }
                break;
        }
        return $this->fetch($act, $data);
    }

    // 站点地图
    public function sitemap()
    {
        $tools = config('tools.');
        $domain = site_base();
        $urls = array(array($domain . '/', '1.0', 'daily'));
        foreach ((array)$tools as $cat) {
            foreach ((array)$cat['items'] as $item) {
                $urls[] = array($domain . ltrim($item['url'], '/'), '0.8', 'weekly');
            }
        }
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n    <loc>{$u[0]}</loc>\n    <changefreq>{$u[2]}</changefreq>\n    <priority>{$u[1]}</priority>\n  </url>\n";
        }
        $xml .= '</urlset>';
        return response($xml, 200, array('Content-Type' => 'application/xml; charset=utf-8'));
    }

    // robots.txt
    public function robots()
    {
        $domain = site_base();
        $txt = "User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: {$domain}/sitemap.xml\n";
        return response($txt, 200, array('Content-Type' => 'text/plain; charset=utf-8'));
    }

    public function api()
    {
        // 创建桌面快捷方式
        $save_name = input('save_name');
        $save_url = input('save_url');
        if ($save_name && $save_url) {
            header("Content-Type: application/octet-stream");
            //$ua = $_SERVER["HTTP_USER_AGENT"];
            $filename = urldecode($save_name) . '.url';//生成的文件名
            $encoded_filename = urlencode($filename);
            $encoded_filename = str_replace("+", "%20", $encoded_filename);
            if (preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT'])) {
                header('Content-Disposition:  attachment; filename="' . $encoded_filename . '"');
            } elseif (preg_match("/Firefox/", $_SERVER['HTTP_USER_AGENT'])) {
                // header('Content-Disposition: attachment; filename*="utf8' .  $filename . '"');
                header('Content-Disposition: attachment; filename*="' . $filename . '"');
            } else {
                header('Content-Disposition: attachment; filename="' . $filename . '"');
            }
            return "
            [InternetShortcut]
            URL={$save_url}
            Prop3=19,2
            IconIndex=1
            ";
        }
        // 请求类型
        switch (input('type')) {
            case 'checkweixin':
                $txt_url = input('txt_url');
                if (!preg_match('/(http:\/\/)|(https:\/\/)/i', $txt_url)) {
                    $txt_url = 'http://' . $txt_url;
                }
                // 微信域名检测（uapis 免费接口）
                $code = 0;
                $msg = '检测失败，请稍后重试';
                $host = parse_url($txt_url, PHP_URL_HOST);
                if (!$host) $host = $txt_url;
                $api = Fcurl('https://uapis.cn/api/v1/network/wxdomain?domain=' . urlencode($host));
                if ($api) {
                    $arr = json_decode($api, true);
                    if (is_array($arr) && isset($arr['type'])) {
                        if ($arr['type'] === 'ok') {
                            $code = 0;
                            $msg = isset($arr['title']) ? $arr['title'] : '域名正常！';
                        } else {
                            $code = 1;
                            $msg = isset($arr['title']) ? $arr['title'] : '域名被拦截！';
                        }
                    }
                }
                return json(array(
                    'code' => $code,
                    'msg' => $msg,
                    'status' => 1
                ));
                break;
            case 'chaicp':
                $url = input('icp');
                if (!$url) {
                    return json(array('status' => 0, 'msg' => '请输入域名'));
                }
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    $url = parse_url($url)['host'];
                }
                if (substr($url, 0, 4) == 'www.') {
                    $url = substr($url, 4);
                }
                if (!checkdomain($url)) {
                    return json(array('status' => 0, 'code' => 400, 'msg' => '域名格式不正确'));
                }
                try {
                    $result = icp_query($url);
                    if ($result['total'] == 0) {
                        return json(array('status' => 0, 'code' => 502, 'msg' => '未查询到备案信息'));
                    }
                    return json(array('status' => 1, 'code' => 200, 'data' => array(
                        '网站域名' => $result['data'][0]['domain'],
                        'ICP备案号' => $result['data'][0]['webLicence'],
                        '主办单位名称' => $result['data'][0]['unitName'],
                        '主办单位性质' => $result['data'][0]['unitType'],
                        '审核日期' => $result['data'][0]['updateTime'],
                        '是否限制接入' => $result['data'][0]['limitAccess']
                    )));
                } catch (Exception $e) {
                    return json(array('status' => 0, 'code' => 501, 'msg' => $e->getMessage()));
                }
                break;
            case 'whois':
                $url = input('whois');
                $info = array();
                $raw = '';
                if ($url) {
                    if (filter_var($url, FILTER_VALIDATE_IP)) {
                        $type = 'ip';
                    } else {
                        $type = 'domain';
                        if (filter_var($url, FILTER_VALIDATE_URL)) {
                            $url = parse_url($url)['host'];
                        }
                        if (substr($url, 0, 4) == 'www.') {
                            $url = substr($url, 4);
                        }
                        if (!checkdomain($url)) {
                            return json(array('status' => 0, 'msg' => '域名格式不正确'));
                        }
                    }
                    $whois = whois_query($url);
                    if ($whois === false || $whois === '') {
                        return json(array('status' => 0, 'msg' => 'Whois 查询失败，请稍后重试'));
                    }
                    if (preg_match('/Registrar:\s+(.*)/', $whois, $m)) {
                        $info['注册商'] = $m['1'];
                    }
                    if (preg_match('/Registrant[:]?\s+(.*)/', $whois, $m)) {
                        $info['联系人'] = $m['1'];
                    }
                    if (preg_match('/(Registrar\s+Abuse|Registrant)\s+Contact\s+Email[:]?\s+(.*)/', $whois, $m)) {
                        $info['联系邮箱'] = $m['2'];
                    }
                    if (preg_match('/(Registrar\s+Abuse|Registrant)\s+Contact\s+Phone[:]?\s+(.*)/', $whois, $m)) {
                        $info['联系电话'] = $m['2'];
                    }
                    if (preg_match('/Updated\s+Date[:]?\s+(.*)/', $whois, $m)) {
                        $info['更新时间'] = $m['1'];
                    }
                    if (preg_match('/(Registration\s+Time|Creation\s+Date)[:]?\s+(.*)/', $whois, $m)) {
                        $info['创建时间'] = $m['2'];
                    }
                    if (preg_match('/(Expiration\s+Time|Registry\s+Expiry\s+Date)[:]?\s+(.*)/', $whois, $m)) {
                        $info['过期时间'] = $m['2'];
                    }
                    if (preg_match('/Registrar\s+WHOIS\s+Server[:]?\s+(.*)/', $whois, $m)) {
                        $info['域名服务器'] = $m['1'];
                    }
                    if (preg_match_all('/Name\s+Server?[:]\s+(.*)/', $whois, $m)) {
                        $info['DNS'] = $m['1'];
                    }
                    if (preg_match('/Domain\s+Status[:]?\s+(.*)/', $whois, $m)) {
                        $info['状态'] = $m['1'];
                    }
                    $raw = $whois;
                }
                return json(array('status' => 1, 'data' => $info, 'raw' => $raw));
                break;
            case 'gzip':
                $q = input('q');
                if (!$q) {
                    return json(array('status' => 0, 'msg' => '请输入网址'));
                }
                $q = str_replace(array('http://', 'https://'), '', $q);
                $info = is_url('http://' . $q) ? urlheader($q) : array();
                return json(array('status' => 1, 'data' => $info));
                break;
            case 'checkkeyword':
                $url = input('txt_url');
                $keyword = input('txt_keyword');
                if (!$url || !$keyword) {
                    return json(array('status' => 0, 'msg' => '请填写网址和关键词'));
                }
                $str = Fcurl($url);
                if (!$str) {
                    return json(array('status' => 0, 'msg' => '页面抓取失败，请检查网址'));
                }
                $str = htmlTotext($str);
                $html_strlen = mb_strlen($str, 'utf-8');
                $html_gjccd = mb_strlen($keyword, 'utf-8');
                $html_gjcsl = substr_count($str, $keyword);
                $html_gjczcd = $html_gjccd * $html_gjcsl;
                $html_mdjgjs = @round(($html_gjczcd / max($html_strlen, 1) * 100), 1);
                return json(array('status' => 1, 'data' => array(
                    'html_strlen' => $html_strlen,
                    'html_gjccd' => $html_gjccd,
                    'html_gjcsl' => $html_gjcsl,
                    'html_gjczcd' => $html_gjczcd,
                    'html_mdjgjs' => $html_mdjgjs
                )));
                break;
            case 'check_url':
                $page = input('page', 1);
                $url = input('url');
                $str = Fcurl($url);
                $count_str = '';
                $data = '';
                $list = array(array(), array(), 0);
                if ($str) {
                    preg_match_all('/<a .*?href="(.*?)".*?>/is', $str, $ahref);
                    $aLink = [];
                    $title = preg_replace("/.*<title>(.*?)<\/title>.*/is", '\\1', $str);
                    $url_p = 'http://' . preg_replace("/(http[s]?:)?(\/\/)?([\w.]+)[\w\/]*[\w.]*\??[\w=&\+\%]*/is", '\\3', $url);
                    $id = 1;
                    $aLink[] = array(
                        'url' => $url_p,
                        'title' => $title,
                        'id' => $id
                    );
                    $arr = array();
                    foreach ($ahref['1'] as $key => $vo) {
                        $qdiv = substr($vo, 0, 1) != '#' && $vo != '/' && substr($vo, 0, 11) != 'javascript:';
                        if ($qdiv && $vo != $url_p && !in_array($vo, $arr)) {
                            $arr[] = $vo;
                            if (substr($vo, 0, 2) == '//') {
                                ++$id;
                                $aLink[] = array(
                                    'url' => 'http:' . $vo,
                                    'title' => '',
                                    'id' => $id
                                );
                            } else
                                if (substr($vo, 0, 4) == 'http') {
                                    ++$id;
                                    $aLink[] = array(
                                        'url' => $vo,
                                        'title' => '',
                                        'id' => $id
                                    );
                                } else {
                                    if (substr($vo, 0, 1) == '/') {
                                        ++$id;
                                        $aLink[] = array(
                                            'url' => $url_p . $vo,
                                            'title' => '',
                                            'id' => $id
                                        );
                                    } else {
                                        ++$id;
                                        $aLink[] = array(
                                            'url' => $url_p . '/' . $vo,
                                            'title' => '',
                                            'id' => $id
                                        );
                                    }
                                }
                        }
                    }
                    $list = page($aLink, 20, $page);
                    for ($i = 1; $i <= $list['1']; $i++) {
                        $count_str .= '<li class="page-number "><a href="javascript:;" style="' . ($i == $page ? 'background:#ccc' : '') . '" onclick="get_data(' . $i . ')">' . $i . '</a></li>';
                    }
                    foreach ($list['0'] as $key => $vo) {
                        $data .= '<tr class=""><td class="order">' . $vo['id'] . '</td><td class="title" id="tr_title_' . $vo['id'] . '">' . ($vo['title'] ? $vo['title'] : ' - ') . '</td><td class="owner" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><a class="green" href="' . $vo['url'] . '" target="_blank">' . $vo['url'] . '</a></td><td class="title" id="tr_' . $vo['id'] . '"> - </td></tr>';
                    }
                }
                return json(array(
                    'status' => $str ? 1 : 0,
                    'data' => $data,
                    'obj' => $list['0'],
                    'total_count' => $list['2'],
                    'count_str' => $count_str
                ));
                break;
            case 'single_url':
                $url = input('url');
                $str = '';
                if ($url) {
                    $str = urltitlecode($url);
                }
                return json($str);
                break;
            case 'camelcase':
                $id = input('id');
                $text = input('text');
                if ($id == 2) {
                    $text = preg_replace_callback('/([^a-zA-Z][a-z])/', function ($m) {
                        $str = str_replace('_', '', $m[0]);
                        return strtoupper($str);
                    }, ucfirst($text));
                } else {
                    $text = preg_replace_callback('/(([A-Z]).*?([A-Z]))/', function ($m) {
                        $str = str_replace($m['3'], '_' . $m['3'], $m[0]);
                        return $str;
                    }, ucfirst($text));
                    $text = strtolower($text);
                }
                $data = array();
                $data['status'] = $text ? 1 : 0;
                $data['msg'] = $text;
                return json($data);
                break;
            default:
                /*$ifpost = 0;
                $datafields = '';
                $post = input('post.');
                if ($post) {
                    $ifpost = 1;
                    $datafields = http_build_query($post);
                }
                $url = 'http://www.pcjson.com' . $_SERVER['REQUEST_URI'];
                $str = Fcurl($url, $ifpost, $datafields);
                return json_decode($str, true);*/
                return json(array(
                    'status' => 1,
                    'msg' => null
                ));
        }
    }
}
