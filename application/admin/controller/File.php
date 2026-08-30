<?php

namespace app\admin\controller;

class File extends Base
{
    public function index()
    {
        $this->checkLogin();
        $path = $this->rootPath() . 'application/index/view/index/';
        $filename = scandir($path);
        $filelist = array();
        foreach ($filename as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filesize=filesize($path . '/' . $file)/pow(1024, 1);
            $modif = date('Y-m-d H:i:s', filemtime($path . '/' . $file));
            $filelist[]=[
                $file,
                $filesize,
                $modif
            ];
        }
        return $this->fetch('', [
            'filelist' => $filelist
        ]);
    }
    public function html()
    {
        $this->checkLogin();
        // 只允许本目录下的 .html 文件名，杜绝 ../ 路径穿越读写任意文件
        $file = basename(trim((string)input('file', '')));
        if (!preg_match('/^[a-zA-Z0-9_\-]+\.html$/', $file)) {
            exit('<meta charset="utf-8"><script>alert("非法文件名");history.back();</script>');
        }
        $dir = $this->rootPath() . 'application/index/view/index/' . $file;
        if (!is_file($dir)) {
            exit('<meta charset="utf-8"><script>alert("文件不存在");history.back();</script>');
        }
        if(request()->isPost()){
            $Xcode = input('Xcode');
            file_put_contents($dir, $Xcode);
        }
        $link = file_get_contents($dir);
        return $this->fetch('', [
            'name'=>$file,
            'content'=>$link
        ]);
    }
}
