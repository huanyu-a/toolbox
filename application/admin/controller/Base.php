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
            exit($this->redirect(url('portal/index/login'), 302));
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