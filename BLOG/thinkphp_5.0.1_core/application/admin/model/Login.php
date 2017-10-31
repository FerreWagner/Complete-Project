<?php 
namespace app\admin\model;

use think\Model;

class Login extends Model{
    //登录方法
    public function login($_username,$_password){
        $_admin = \think\Db::name('admin')->where('username','=',$_username)->find();
        if($_admin){    //为真，即查找到用户
            if($_admin['password'] == md5($_password)){  //即密码也正确
                \think\Session::set('id',$_admin['id']);
                \think\Session::set('username',$_admin['username']);
//                 \think\Session::set('id',$_admin['id']);
                return 1;
            }else{      //即密码错误
                return 2;
            }
            
        }else{          //否则，没有这个用户，返回3
            return 3;
        }
    }
}

?>