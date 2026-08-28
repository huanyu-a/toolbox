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
    /**
     * 友情链接列表（结构化存储于 friend_links 表，数据库管理）
     */
    public function link()
    {
        $this->checkLogin();
        friend_links_import_legacy(); // 表为空时把旧 KV 整段 HTML 解析入库（升级过渡）
        return $this->fetch('', [
            'list' => friend_links_all(false)
        ]);
    }

    /**
     * 编辑/新增友链：GET 渲染表单，POST 校验保存
     */
    public function linkEdit()
    {
        $this->checkLogin();
        $id = intval(input('param.id', 0));
        if (request()->isPost()) {
            $name   = trim(input('post.name', '', 'trim'));
            $url    = trim(input('post.url', '', 'trim'));
            $remark = trim(input('post.remark', '', 'trim'));
            $sort   = intval(input('post.sort', 100));
            $status = input('post.status', 0, 'intval') ? 1 : 0;
            $nof    = input('post.nofollow', 0, 'intval') ? 1 : 0;
            if (!preg_match('#^https?://#i', $url)) {
                $url = 'https://' . ltrim($url, '/');
            }
            if ($name === '' || !preg_match('#^https?://#i', $url)) {
                exit('<meta charset="utf-8"><script>alert("请填写网站名称与正确的 URL");history.back();</script>');
            }
            if ($id > 0) {
                $st = site_cfg_pdo()->prepare('UPDATE friend_links SET name=?, url=?, nofollow=?, sort=?, status=?, remark=? WHERE id=?');
                $st->execute(array($name, $url, $nof, $sort, $status, $remark, $id));
            } else {
                $st = site_cfg_pdo()->prepare('INSERT INTO friend_links (name, url, nofollow, sort, status, remark) VALUES (?, ?, ?, ?, ?, ?)');
                $st->execute(array($name, $url, $nof, $sort, $status, $remark));
            }
            header('Location: /' . config('admin.path') . '/web/link.html');
            exit;
        }
        $row = null;
        if ($id > 0) {
            $q = site_cfg_pdo()->prepare('SELECT * FROM friend_links WHERE id=?');
            $q->execute(array($id));
            $row = $q->fetch(\PDO::FETCH_ASSOC);
        }
        if (!$row || !$row['id']) {
            // 新增模式给默认值
            $row = array(
                'id' => 0, 'name' => '', 'url' => '', 'nofollow' => 1,
                'sort' => 100, 'status' => 1, 'remark' => '',
            );
        }
        return $this->fetch('', ['row' => $row]);
    }

    /**
     * 删除友链（POST + 前端 data-confirm 二次确认）
     */
    public function linkDel()
    {
        $this->checkLogin();
        if (request()->isPost()) {
            $id = intval(input('post.id', 0));
            if ($id > 0) {
                $st = site_cfg_pdo()->prepare('DELETE FROM friend_links WHERE id=?');
                $st->execute(array($id));
            }
        }
        header('Location: /' . config('admin.path') . '/web/link.html');
        exit;
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