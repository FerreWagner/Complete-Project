<?php
namespace app\index\controller;

class Guest extends Base
{
    public function index()
    {
        //连表查询查到guest的数据
        $_arts = \think\Db::name('article')->order('id desc')->where('cateid','=',input('cateid'))->paginate(2);
        
        $this->assign('_arts',$_arts);
        
        return $this->fetch('guest');
    }
}
