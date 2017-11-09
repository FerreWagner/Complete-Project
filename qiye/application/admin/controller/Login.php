<?php

namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Admin;
use think\Session;

class Login extends Base
{
    /**
     * !CodeTemplates.overridecomment.nonjd!
     * 渲染登录界面
     * @see \app\admin\common\Base::index()
     */
    public function index()
    {
        //判断是否登录
        $this->alreadyLogin();
        
        return $this->view->fetch('login');
    }

    /**
     * 验证用户身份
     *
     * @return \think\Response
     */
    public function check(Request $request)
    {
        //设置初始json值
        $status = 0;
        
        //获取表单数据
        $data = $request->param();
        $user = $data['username'];
        $pass = md5($data['password']);
        
        //查询
        $map = ['username' => $user];
        $admin = Admin::get($map);
        
        //验证
        if (is_null($admin)){
            $message = '用户名错误';
        }elseif ($admin->password != $pass){
            $message = '用户名或密码错误';
        }else {
            $status  = 1;
            $message = '验证通过,请点击确定进入后台';
            
            //更新
            $admin->setInc('login_count');
            $admin->save(['last_time' => time()]);
            
            //存储session
            Session::set('user_id', $user);
            Session::set('user_info', $admin->toArray());
        }
        
        return ['status' => $status, 'message' => $message];
        
    }

    /**
     * 退出登录
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function logout()
    {
        Session::delete('user_id');
        Session::delete('user_info');
        
        $this->success('注销成功,正在返回', 'login/index');
    }

    
}
