<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//后台（对外路径已改为 /portal/，隐藏原 /admin/ 入口）
Route::rule('portal/:c/:a', 'admin/:c/:a');
Route::rule('portal', function(){
    return redirect('portal/index/index');
});

Route::rule('/', 'index');
Route::rule('404', 'index/e404');
//接口
Route::rule('doapi', 'index/api');
Route::rule('api', 'index/api');
//静态页面
Route::rule('sitemap.xml', 'index/sitemap');
Route::rule('robots.txt', 'index/robots');
Route::rule('ip/:ip', 'index/index?act=ip')->pattern(['ip' => '.*']);
Route::rule(':act','index/index');
