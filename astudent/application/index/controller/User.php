<?php
namespace app\index\controller;

use app\index\controller\Base;
use think\Request;
use app\index\model\User as UserModel;
use think\Session;
class User extends Base
{
    public function login()
    {
        $this->alreadyLogin();  //防止用户重复登录
        return $this->view->fetch();
    }
    
    public function checkLogin(Request $request)
    {
        //初始化返回数据
        $status = 0;
        $result = '';
        $data = $request->param();
        //错误规则
        $rule = [
            'name|用户名'    => 'require',
            'password|密码' => 'require',
            'verify|验证码'  => 'require|captcha',
            
        ];
        //自定义错误信息
        $msg = [
            'name'     => ['require' => '尼酱，用户名不能为空哟'],
            'password' => ['require' => '尼酱，要密码的哟'],
            'verify'   => [
                'require' => '尼酱，必填验证码哟',
                'captcha' => '尼酱,验证码错误哟',
            ],
        ];
        
        $result = $this->validate($data, $rule, $msg);
        if ($result === true){
            //验证登录信息
            $map = [
                'name'     => $data['name'],
                'password' => md5($data['password']),
            ];
            
            $user = UserModel::get($map);   //从表里取数据
            if ($user == null) {
                $result = '没有找到该用户';
            }else {
                $status = 1;
                $result = '验证通过,尼酱';
                //设置用户session
                Session::set('user_id', $user->id); //获取用户id
                Session::set('user_info', $user->getData());    //获取用户的所有信息
            }
        }
        
        
        return ['status' => $status, 'message' => $result, 'data' => $data];
    }
    
    public function logout()
    {
        Session::delete('user_id');
        Session::delete('user_info');
        $this->success('登录注销，正在返回', 'user/login');
    }
    
}
