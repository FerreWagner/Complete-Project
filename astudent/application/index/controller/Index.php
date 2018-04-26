<?php
namespace app\index\controller;

use app\index\controller\Base;
use think\Model;
class Index extends Base
{
    public function index()
    {
        $this->isLogin();   //判断用户是否登录
        
        $this->view->assign('title', 'Ferre is Dark');
        return $this->view->fetch();
    }
}
