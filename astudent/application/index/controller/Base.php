<?php
namespace app\index\controller;

use think\Controller;
use think\Session;
class Base extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();  //继承父类中的初始化操作
        define('USER_ID', Session::get('user_id'));
    }
    
    //判断用户是否登录，放在后台的入口
    protected function isLogin()
    {
        if (empty(USER_ID)){
            $this->error('尼酱还没有登录哟，请先登录', url('user/login'));
        }
    }
    
    //防止用户重复登录user/login
    protected function alreadyLogin()
    {
        if (!empty(USER_ID)){
            $this->error('尼酱已经登陆了哟，不要进入这个页面了嘛', url('index/index'));
        }
    }
    
}
