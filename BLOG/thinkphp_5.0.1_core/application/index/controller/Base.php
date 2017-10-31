<?php
namespace app\index\controller;
use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        $this->nav();
    }
    
    public function nav(){
        $_navres = \think\Db::name('cate')->order('id asc')->select();
        $this->assign('_navres',$_navres);
    }
}
