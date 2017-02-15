<?php
namespace app\index\controller;
use app\index\model\Article;

class Artlist extends Common
{
    public function index()
    {
        $_artcle     = new Article();
        $_cateid     = input('cateid');                      //获取对应栏目数据
        $_artres     = $_artcle->getAllArtcles($_cateid);    //查询相关栏目文章数据的方法
        $_hotres     = $_artcle->gethotres($_cateid);        //热门文章数据查询
        
        $_cate       = new \app\index\model\Cate();
        $_cateinfo   = $_cate->getcateinfo($_cateid);        //获取相关栏目信息
        
        $this->assign(array(
            '_artres'  => $_artres,
            '_hotres'  => $_hotres,
            '_cateinfo'=> $_cateinfo,
        ));
        return view('artlist');
    }
    
}
