<?php
namespace app\index\controller;

class Article extends Common
{
    public function index()
    {
        $_artid = input('artid');       //这个artid是我们在artlist的view里给id自定义添加的array关联，数据表里并没有这个字段
        db('article')->where(array('id' => $_artid))->setInc('click');  //setInc自增1
        $_articles = db('article')->find($_artid);  //根据id来找到对应的单条文章数据
        $_article  = new \app\index\model\Article();
        $_hotres   = $_article->gethotres($_articles['cateid']); //cateid为文章所属栏目，拿到文章的所属栏目数据
        $this->assign(array(
            '_articles' => $_articles,
            '_hotres'   => $_hotres,
        ));
        return view('article');
    }
}
