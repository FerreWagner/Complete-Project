<?php
namespace app\index\controller;
use app\index\model\Article;

class Imglist extends Common
{
    public function index()
    {
        $_artcle     = new Article();
        $_artres     = $_artcle->getAllArtcles(input('cateid'));    //查询数据的方法
        
        $_cateid     = input('cateid');
        $_cate       = new \app\index\model\Cate();
        $_cateinfo   = $_cate->getcateinfo($_cateid);        //获取相关栏目信息
        
        $this->assign(array(
            '_artres'  => $_artres,
            '_cateinfo'=> $_cateinfo,
        ));
        return view('imglist');
    }
}
