<?php
namespace app\index\model;
use think\Model;
use app\index\model\Cate;

class Article extends Model
{
    public function getAllArtcles($_cateid) //相关栏目文章数据查询
    {
        $_cate = new Cate();
        $_allcateid = $_cate->getchildrenid($_cateid);  //使用cate里的查找数据的方法
        $_artres = db('article')->where("cateid IN($_allcateid)")->order('id desc')->paginate(6); //查询符合要求的文章
        return $_artres;
    }
    
    public function gethotres($_cateid)     //热门文章数据查询
    {
        $_cate = new Cate();
        $_allcateid = $_cate->getchildrenid($_cateid);  //使用cate里的查找数据的方法
        $_artres = db('article')->where("cateid IN($_allcateid)")->order('click desc')->limit(6)->select(); //查询符合要求的文章
        return $_artres;
    }
    
    public function getserhot(){            //搜索页面全站的热点文章
        $_artres = $this->field('id,desc,keywords,title,thumb')->order('click desc')->limit(6)->select();
        return $_artres;
    }
    
    public function getsitehot(){       //获取全站的热点文章
        $_sitehotres = $this->field('id,desc,keywords,title,thumb')->order('click desc')->limit(6)->select();
        return $_sitehotres;
    }
    
    public function getnewarticle(){    //获取新的文章
        $_newarticleres = db('article')->field('a.id,a.title,a.desc,a.click,a.thumb,a.zan,a.time,a.author,c.catename')->alias('a')->join('cp_cate c','a.cateid=c.id')->order('a.id desc')->limit(10)->select();
        return $_newarticleres;
    }
    
    public function getrecart(){        //获取所有被推荐的文章
        $_recart = $this->where('rec','=',1)->field('id,title,thumb')->order('id desc')->limit(4)->select();
        return $_recart;
    }
    
    
    public function getfirst(){         //index页面的大图链接
        $_firstart = $this->field('id,desc,keywords,desc,thumb,title')->order('id desc')->find();
        return $_firstart;
    }
    
}
