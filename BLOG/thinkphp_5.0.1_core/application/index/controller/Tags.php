<?php
namespace app\index\controller;

class Tags extends Base
{
    public function index()
    {
        $_tags                 = input('tags');
        $map['a.keywords']     = ['like','%'.$_tags.'%'];
        $_artres               = \think\Db::name('article')->alias('a')->join('cate c','c.id = a.cateid','LEFT')->field('a.id,a.title,a.pic,a.time,a.desc,a.click,a.keywords,c.catename')->order('a.id desc')->where($map)->paginate(2);
        $this->assign('_artres',$_artres);
        return $this->fetch('tags');
    }
}
