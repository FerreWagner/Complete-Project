<?php
namespace app\admin\controller;
use think\Controller;

class Base extends Controller{
    public function _initialize(){
        //相当于一个构造方法,一个预先执行的方法
        if(!session('id')){
            $this->error('请先登录系统');                //友情提示
            $this->redirect(url('Login/index'));     //跳转到Login控制器的index方法
        }else{
            //拿到当前管理员的数据
        }
    }
}