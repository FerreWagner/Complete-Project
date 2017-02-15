<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;

class Login extends Controller{
    
    public function fate($name = '张三'){
        print_r($this->request->param());
    }
    
    public function index(){
        if(request()->isPost()){
            $this->check(input('code'));   //验证码验证函数check()
            
            $_admin = new Admin();
            $_num = $_admin->login(input('post.')); //model里的login方法返回的是一个数值
            if($_num == 1){
                $this->error('用户不存在'); 
            }
            if($_num == 2){
                $this->redirect('admin/index/index');
            }
            if($_num == 3){
                $this->error('用户或密码错误');    //实际上是密码错误，这里是为了迷惑用户
            }
            return;
        }
        return view();
    }
    
    public function check($_code){    //验证码检测
        if(!captcha_check($_code)){   //验证验证码
            $this->error('验证码错误');
        }else{
            return true;
        }
    }
    
}

?>