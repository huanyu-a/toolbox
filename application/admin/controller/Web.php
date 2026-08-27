<?php

namespace app\admin\controller;

class Web extends Base
{
    public function index()
    {
        $this->checkLogin();
        $web = config('web.');
        if(request()->isPost()){
            $web = input('web/a');
            $webconfig = "<?php\n".'return ' . var_export($web, true) . ';'."\n";
            file_put_contents($this->rootPath() . 'config/web.php', $webconfig);
        }
        return $this->fetch('', [
            'web'=>$web,
            'content'=>$web['header']
        ]);
    }
    public function link()
    {
        $this->checkLogin();
        $legacyPath = $this->rootPath() . 'application/index/view/link.html';
        if(request()->isPost()){
            // 内容写入 SQLite（runtime 挂载卷），模板文件不再承载，重建镜像不丢失
            $Xcode = (string)input('Xcode');
            site_cfg_set('friend_links_html', $Xcode);
        }
        $content = (string)site_cfg_get('friend_links_html', '');
        if ($content === '') {
            // 升级过渡：从旧模板一次性迁移入库；无旧内容时给默认值便于编辑
            if (is_file($legacyPath)) {
                $c = (string)@file_get_contents($legacyPath);
                if (trim($c) !== '' && strpos($c, 'site_render_friend_links') === false && strpos($c, 'friend-link-row') !== false) {
                    site_cfg_set('friend_links_html', $c);
                    $content = $c;
                }
            }
            if ($content === '') {
                $content = site_friend_links_default();
            }
        }
        return $this->fetch('', [
            'content'=>$content
        ]);
    }
    public function nav()
    {
        $this->checkLogin();
        $dir = $this->rootPath() . 'application/index/view/nav.html';
        if(request()->isPost()){
            $Xcode = input('Xcode');
            file_put_contents($dir, $Xcode);
        }
        $link = file_get_contents($dir);
        return $this->fetch('', [
            'content'=>$link
        ]);
    }
    public function header()
    {
        $this->checkLogin();
        $dir = $this->rootPath() . 'application/index/view/header.html';
        if(request()->isPost()){
            $Xcode = input('Xcode');
            file_put_contents($dir, $Xcode);
        }
        $link = file_get_contents($dir);
        return $this->fetch('', [
            'content'=>$link
        ]);
    }
    public function footer()
    {
        $this->checkLogin();
        $dir = $this->rootPath() . 'application/index/view/footer.html';
        if(request()->isPost()){
            $Xcode = input('Xcode');
            file_put_contents($dir, $Xcode);
        }
        $link = file_get_contents($dir);
        return $this->fetch('', [
            'content'=>$link
        ]);
    }
    /**
     * 百度统计（自动混淆防爬）
     * 只需填写百度统计站点 ID 与启用开关，保存后写入 SQLite（runtime 挂载卷），
     * 重建镜像/容器不丢失；前台页面通过 tongji_config_code() 自动注入混淆统计代码。
     */
    public function tongji()
    {
        $this->checkLogin();
        $enabled  = site_cfg_get('tongji_enabled');   // null = 库中从未设置
        $baidu_id = site_cfg_get('tongji_baidu_id');
        if ($enabled === null && $baidu_id === null) {
            // 升级过渡：旧版 config/tongji.php 存在则迁移一次入库
            $legacyFile = $this->rootPath() . 'config/tongji.php';
            if (is_file($legacyFile)) {
                $old = @include $legacyFile;
                if (is_array($old)) {
                    $enabled  = !empty($old['enabled']) ? '1' : '0';
                    $baidu_id = isset($old['baidu_id']) ? (string)$old['baidu_id'] : '';
                    site_cfg_set('tongji_enabled', $enabled);
                    site_cfg_set('tongji_baidu_id', $baidu_id);
                }
            }
        }
        if(request()->isPost()){
            $enabled_v = input('post.enabled', 0, 'intval') ? '1' : '0';
            $id_v      = trim(input('post.baidu_id', '', 'trim'));
            $id_v      = preg_match('/^[a-zA-Z0-9]+$/', $id_v) ? $id_v : '';
            site_cfg_set('tongji_enabled', $enabled_v);
            site_cfg_set('tongji_baidu_id', $id_v);
            $enabled  = $enabled_v;
            $baidu_id = $id_v;
        }
        $cfg = array(
            'enabled'  => ($enabled === '1'),
            'baidu_id' => (string)$baidu_id,
        );
        $generated = (!empty($cfg['enabled']) && !empty($cfg['baidu_id'])) ? build_tongji_code($cfg['baidu_id']) : '';
        return $this->fetch('', [
            'cfg'      => $cfg,
            'generated' => $generated
        ]);
    }
}