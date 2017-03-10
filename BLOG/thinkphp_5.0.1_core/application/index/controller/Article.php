<?php
namespace app\index\controller;

class Article extends Base
{
    public function index()
    {
        $_id     = input('artid');
        
        //自增浏览量
        db('article')->where('id',$_id)->setInc('click');
        $_arts   = \think\Db::name('article')->alias('a')->join('cate c','c.id = a.cateid','LEFT')->field('a.title,a.content,a.time,a.click,a.id,a.cateid,c.catename,a.keywords')->find($_id);
        
        $_prev   = \think\Db::name('article')->where('id','<',$_id)->where('cateid','=',$_arts['cateid'])->order('id desc')->limit(1)->value('id');   //上一页
        $_next   = \think\Db::name('article')->where('id','>',$_id)->where('cateid','=',$_arts['cateid'])->order('id asc')->limit(1)->value('id');    //下一页
        
        $_relateres = $this->relate($_arts['keywords']);    //拿到文章的keywords
//         print_r($_relateres);die();

        
        $this->assign('_arts',$_arts);
        $this->assign('_prev',$_prev);
        $this->assign('_next',$_next);
        $this->assign('_relateres',$_relateres);
        
        return $this->fetch('article');
    }
    
    
    public function relate($_keywords){
        //相关文章方法
        $_arr = explode(',', $_keywords);  //将其分割到数组里
//         var_dump($_arr);die();

        static $_relateres = array();       //接收数据的数组
        foreach ($_arr as $_k => $_v){
            $map['keywords']     = ['like','%'.$_v.'%'];  //根据keywords等于$_v的相关文章
            $_artres             = \think\Db::name('article')->where($map)->field('id ,title ,time')->limit(10)->select();  //包含某关键字的，最多显示十条相关文章
            $_relateres          = array_merge($_relateres,$_artres);
            //由于多个关键词可能对应一个文章，因此可能出现重复文章
            //去除重复文章
//             $_relateres          = array_unique($_relateres);    不能这样去除数组重复
            $_relateres          = arr_unique($_relateres);
        }
        return $_relateres;
        
    }
    
    
}
