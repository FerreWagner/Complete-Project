<?php
namespace app\admin\common;

use think\Controller;
use think\Session;
class Base extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        
        //判断用户是否已登录,做相应跳转
        define('USER_ID', Session::get('user_id'));
    }
    
    /**
     * 判断用户是否登录,未登录
     */
    protected function isLogin()
    {
        if (is_null(USER_ID)){
            $this->error('未登录,清先进行登录', 'login/index');
        }
    }
    
    /**
     * 判断用户是否登录,已登录
     */
    protected function alreadyLogin()
    {
        if (!is_null(USER_ID)){
            $this->error('您已经登录,请不要重复登录', 'index/index');
        }
    }
}
