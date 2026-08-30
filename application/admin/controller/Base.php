<?php

namespace app\admin\controller;
use think\Controller;

class Base extends Controller
{
    protected function isLogin()
    {
        $session = session('admin');
        if($session && $session === $this->getSession()) { 
            return true;
        }
        return false;
    }

    protected function getSession()
    {
        $config = config('admin.');
        return md5($config['username'].md5($config['password']));
    }

    protected function checkLogin()
    {
        if(!$this->isLogin()){
            exit($this->redirect(url(config('admin.path') . '/index/login'), 302));
        }
        $this->checkSameOrigin();
    }

    /**
     * CSRF 防护：后台写操作（POST）要求 Origin/Referer 与当前 Host 同源（头存在才校验）。
     * 配合隐蔽后台路径，挡掉跨站伪造写请求（文件编辑/配置覆盖等）。
     */
    protected function checkSameOrigin()
    {
        if (!request()->isPost()) {
            return;
        }
        $host = strtolower(parse_url('http://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'x'), PHP_URL_HOST) ?: '');
        $candidates = array();
        if (!empty($_SERVER['HTTP_ORIGIN'])) {
            $candidates[] = $_SERVER['HTTP_ORIGIN'];
        }
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $candidates[] = $_SERVER['HTTP_REFERER'];
        }
        foreach ($candidates as $u) {
            $p = parse_url($u);
            if (empty($p['host']) || strtolower($p['host']) !== $host) {
                exit('非法请求来源');
            }
        }
    }

    /**
     * 项目根目录（绝对路径，兼容容器/CLI 等不同工作目录）
     * 控制器位于 application/admin/controller/，向上三级即项目根
     */
    protected function rootPath()
    {
        return dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR;
    }
}