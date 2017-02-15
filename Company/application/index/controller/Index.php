<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
        //首页最新文章调用
        $_articlemodel  = new \app\index\model\Article();
        //使用全站热门文章的方法
        $_hot           = $_articlemodel->getsitehot();
        //轮播推荐文章的方法
        $_recart        = $_articlemodel->getrecart();
        //获取推荐栏目
        $_cate          = new \app\index\model\Cate();
        $_recindex      = $_cate->getrecindex();
        //获取友情链接数据
        $_links         = db('link')->order('sort asc')->select();
        $_newart        = $_articlemodel->getnewarticle();
        //首页大图链接
        $_first         = $_articlemodel->getfirst();
        $this->assign(array(
            '_newart'   => $_newart,
            '_hot'      => $_hot,
            '_links'    => $_links,
            '_recart'   => $_recart,
            '_recindex' => $_recindex,
            '_first'    => $_first,
        ));
        return view();
    }
}
