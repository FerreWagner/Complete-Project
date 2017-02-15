<?php
namespace app\index\model;
use think\Model;

class Cate extends Model
{
    public function getchildrenid($_cateid){       //为了得到删除栏目的子id的方法
        $_cateres = $this->select();
        $_arr = $this->_getchildrenid($_cateres,$_cateid);
        $_arr[] = $_cateid;             //加入自己的id
        $_strid = implode(',', $_arr);  //转化成字符串
        return $_strid;
    }
    public function _getchildrenid($_cateres,$_cateid){ //为了得到删除栏目的子id的方法
        static $_arr = array();
        foreach ($_cateres as $_key => $_value){
            if($_value['pid']       == $_cateid){       //有存在pid等于我的id,即是我的子栏目
                $_arr[]             = $_value['id'];    //找到我儿子栏目的id,因为要删除了他
                $this->_getchildrenid($_cateres, $_value['id']);    //以此类推，做一个递归,找到所有的子栏目
            }
        }
        return $_arr;   //返回所有找到的子栏目及孙子栏目...的id
    }
    
    
    
    
    public function getparents($_cateid){       //为了得到删除栏目的父栏目数据
        $_cateres = $this->field('id,pid,catename')->select();  //查找所有栏目的id,pid,catename数据
        $_cates   = db('cate')->field('id,pid,catename')->find($_cateid);   //查找当前栏目下所有子栏目
        $_pid     = $_cates['pid'];             //找到栏目的pid
        if($_pid){                              //判断$_pid是否为0，即是否存在子分类，没有子分类就没有意义继续向下
            $_arr = $this->_getparents($_cateres,$_pid);
        }
        
        $_arr[]   = $_cates;             //加入子栏目自己的数据
        return $_arr;
    }
    public function _getparents($_cateres,$_pid){ //为了得到删除栏目的子id的方法
        static $_arr = array();
        foreach ($_cateres as $_key => $_value){
            if($_value['id']       == $_pid){       //有存在pid等于我的id,即是我的子栏目
                $_arr[]             = $_value;      //将整个分类的数据给arr
                $this->_getparents($_cateres, $_value['pid']);    //以此类推，做一个递归,找到所有的子栏目
            }
        }
        return $_arr;   //返回所有找到的子栏目及孙子栏目...的id
    }
    
    public function getrecindex(){      //获取在首页显示的被推荐的栏目
        $_recindex = $this->order('id desc')->where('rec_index','=',1)->select();
        return $_recindex;
    }
    
    public function getrecbottom(){     //获取在底部被推荐的栏目
        $_recbottom = $this->order('id desc')->where('rec_bottom','=',1)->select();
        return $_recbottom;
    }
    
    public function getcateinfo($_cateid){      //获取栏目的相关信息,用于在artlist处显示
        $_cateinfo = $this->field('catename,keywords,desc')->find($_cateid);
        return $_cateinfo;
    }
    
}
