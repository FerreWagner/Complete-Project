<?php
namespace app\index\controller;

class Page extends Common
{
    public function index()
    {
        $_cates = db('cate')->find(input('cateid'));
        
        $_cateid     = input('cateid');
        $_cate       = new \app\index\model\Cate();
        $_cateinfo   = $_cate->getcateinfo($_cateid);        //获取相关栏目信息
        
        $this->assign(array(
            '_cates'    => $_cates,
            '_cateinfo' => $_cateinfo,
        ));
        
        return view('page');
    }
}
