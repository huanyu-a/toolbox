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

// 后台入口：真实路径由 config('admin.path') 决定（默认 portal，服务器可用 ADMIN_PATH 环境变量覆盖为隐蔽路径）
$adminPath = config('admin.path');
$adminPath = $adminPath ?: 'portal';
Route::rule($adminPath . '/:c/:a', 'admin/:c/:a');
Route::rule($adminPath, function () use ($adminPath) {
    return redirect(url($adminPath . '/index/index'));
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
