<?php
namespace app\admin\common;

use think\Controller;
use think\Session;
use app\admin\model\System;
use think\Request;
class Base extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        
        //判断用户是否已登录,做相应跳转
        define('USER_ID', Session::get('user_id'));
        
        //获取网站配置信息
        $config = $this->getSystem();
        
        //获取当前url的请求对象
        $request = Request::instance();
        //查询网站的开关状态
        $this->getStatus($request, $config);
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
    
    //获取配置信息
    public function getSystem()
    {
        return System::get(1);
    }
    
    //判断当前网站的开启状态($request请求对象,$config当前配置信息)
    public function getStatus($request, $config)
    {
        //关闭前台，即不是admin模块
        if ($request->module() !== 'admin'){
            
            //根据配置表中的is_close进行判断，0开启1关闭
            if ($config->is_close == 1){
                $this->error('网站已关闭');
                exit;
            }
        }
    }
}
