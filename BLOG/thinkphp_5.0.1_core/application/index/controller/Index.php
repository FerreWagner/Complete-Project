<?php
namespace app\index\controller;

class Index extends Base
{
    public function index()
    {
        $_artres = \think\Db::name('article')->alias('a')->join('cate c','c.id = a.cateid','LEFT')->field('a.id,a.title,a.pic,a.time,a.desc,a.click,a.keywords,c.catename')->order('a.id desc')->paginate(6);
        $this->assign('_artres',$_artres);
        return $this->fetch();
    }
}
