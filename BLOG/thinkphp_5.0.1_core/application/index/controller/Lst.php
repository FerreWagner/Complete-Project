<?php
namespace app\index\controller;

class Lst extends Base
{
    public function index()
    {
        $_cates     = \think\Db::name('cate')->field('catename')->find(input('cateid'));  //根据主键进行查找
        $_catesname = $_cates['catename'];
        //lst显示
        $_artres    = \think\Db::name('article')->order('id desc')->where('cateid','=',input('cateid'))->paginate(2);
        $this->assign('_artres',$_artres);
        $this->assign('_catesname',$_catesname);
        
        return $this->fetch('lst');
    }
}
