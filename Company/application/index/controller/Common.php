<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Conf;

class Common extends Controller    //此类存放公用数据
{
    public function _initialize(){
        //当前位置的数据查询
        if(input('cateid')){    //如果cateid存在，即是栏目列表
            $this->getpos(input('cateid'));
        }
        if(input('artid')){     //如果artid存在，即是文章,找到文章对应的栏目，然后通过getpos方法找到对应的所有父栏目
            $_articles  = db('article')->field('cateid')->find(input('artid'));
            $_cateid    = $_articles['cateid'];
            $this->getpos($_cateid);
        }
        
        $this->getconf();           //网站配置项
        $this->getNaCates();        //网站栏目导航
        
        $_cate          = new \app\index\model\Cate();
        $_recbottom= $_cate->getrecbottom();    //底部导航栏
        $this->assign('_recbottom',$_recbottom);
    }
    
    public function getNaCates(){   //获取前台导航栏
        $_cateres = db('cate')->where(array('pid' => 0))->select(); //顶级分类的pid=0
        foreach ($_cateres as $_k => $_v){
            $_child = db('cate')->where(array('pid' => $_v['id']))->select();   //在pid为0的情况下，查找pid(子)=id(父)的情况，即查找子栏目数据
            if($_child){    //如果存在子级栏目
                $_cateres[$_k]['child'] = $_child;
            }else{
                $_cateres[$_k]['child'] = 0;
            }
        }
        $this->assign('_cateres',$_cateres);
        
    }
    
    public function getconf(){  //配置公共数据,如网站标题等
        $_conf = new Conf();
        $_confres = $_conf->getAllConf();
        $_view = array();
        foreach ($_confres as $_key=>$_value){  //因为cnname是值，enname是表单中的name，所以用这种方式排列成name=>value的形式,数据更方便使用
            $_view[$_value['enname']] = $_value['cnname'];
        }
        $this->assign('_view',$_view);
    }
    
    public function getpos($_cateid){   //当前位置数据
        $_cate   = new \app\index\model\Cate();
        $_posarr = $_cate->getparents($_cateid);
        $this->assign('_posarr',$_posarr);
    }
}
