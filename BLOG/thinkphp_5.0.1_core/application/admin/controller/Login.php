<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Login as Log;
// use think\Loader;

class Login extends Controller{
    public function index(){
//         return view('login');

        if(request()->isPost()){
            $_login     = new Log;      //实例化模型的对象
            $_status    = $_login->login(input('username'),input('password'));
            //根据不同的值返回不同的错误信息，三种情况都是在模型里得到
            if($_status == 1){
                return $this->success('登陆成功,正在跳转','Index/index');
            }elseif ($_status == 2){
                return $this->error('账号或者密码不正确');
            }else{
                return $this->error('用户不存在');
            }
        }
        return $this->fetch('login');
    }
    
    public function logout(){
        session(null);  //清空session
        $this->success('退出成功',url('index'));    //退出后跳转到当前index方法
    }
    
}