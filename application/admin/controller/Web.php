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
        $dir = $this->rootPath() . 'application/index/view/link.html';
        if(request()->isPost()){
            $Xcode = input('Xcode');
            file_put_contents($dir, $Xcode);
        }
        $link = file_get_contents($dir);
        return $this->fetch('', [
            'content'=>$link
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
     * 只需填写百度统计站点 ID 与启用开关，保存后自动写入 config/tongji.php，
     * 前台页面通过 tongji_config_code() 自动注入混淆统计代码。
     */
    public function tongji()
    {
        $this->checkLogin();
        $dir = $this->rootPath() . 'config/tongji.php';
        $cfg = is_file($dir) ? include $dir : array();
        $cfg = is_array($cfg) ? $cfg : array();
        if(request()->isPost()){
            $enabled = input('post.enabled', 0, 'intval') ? true : false;
            $baidu_id = trim(input('post.baidu_id', '', 'trim'));
            $cfg['enabled'] = $enabled;
            $cfg['baidu_id'] = preg_match('/^[a-zA-Z0-9]+$/', $baidu_id) ? $baidu_id : '';
            $php = "<?php\nreturn " . var_export($cfg, true) . ";\n";
            file_put_contents($dir, $php);
        }
        $generated = (!empty($cfg['enabled']) && !empty($cfg['baidu_id'])) ? build_tongji_code($cfg['baidu_id']) : '';
        return $this->fetch('', [
            'cfg'      => $cfg,
            'generated' => $generated
        ]);
    }
}