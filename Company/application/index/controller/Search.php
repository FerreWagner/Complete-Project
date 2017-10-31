<?php
namespace app\index\controller;

class Search extends Common
{
    public function index()
    {
        $_keywords = input('keywords');
        $_serres = db('article')->order('time desc')->where('title','like','%'.$_keywords.'%')->paginate(6,false,$config = ['query' => array('keywords' => $_keywords)]);   //按照文章标题搜索
        //获取全站的热点文章方法
        $_hot    = new \app\index\model\Article();
        $_serhot = $_hot->getserhot();
        
        $this->assign(array(
            '_serres'   => $_serres,
            '_keywords' => $_keywords,
            '_serhot'   => $_serhot,
        ));
        return view('search');
    }
}
