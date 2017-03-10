<?php
namespace app\index\controller;
use think\Controller;

class Search extends Base
{
    public function index()
    {
        //接受发送过来的数据，存在关键字
        $_keywords = input('keywords');
        if($_keywords){
            $_map['title'] = ['like','%'.$_keywords.'%'];
            $_search       = \think\Db::name('article')->where($_map)->order('id desc')->paginate(2);
            $this->assign('_search',$_search);
            $this->assign('_keywords',$_keywords);
        }else{
            //没有关键字，进行处理
            $this->assign('_keywords','没有关键词');
            $this->assign('_search',null);
        }
        
        return $this->fetch('search');
    }
}
