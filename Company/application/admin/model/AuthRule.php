<?php
namespace app\admin\model;
use think\Model;

class AuthRule extends Model
{
    public function authruletree(){      //model层的数据处理
        $_authruleres = $this->order('sort asc')->select();    //按照sort值降序排列
        return $this->sort($_authruleres);
    }
    
    public function sort($_data,$_pid = 0){ //数据的排序;pid即上级栏目的id;level即栏目级别，一级栏目级别为0，二级栏目级别为1...为了输出而设置的level
        static $_arr = array();
        foreach ($_data as $_key => $_value){
            //数据的重新排序
            if($_value['pid']    == $_pid){        //为了找出数据表中第一个顶级栏目,按照顺序排列出来
                $_value['dataid'] = $this->getparentid($_value['id']);
                $_arr[]          = $_value;
                $this->sort($_data,$_value['id']);  //即谁的$_pid=我的id，那么就是我的分类，且level要+1;我的分类继续执行这个方法,直到执行到没有该子分类，那么继续执行
            }
        }
        return $_arr;
    }
    
    
    public function getchildrenid($_authruleid){       //为了得到删除栏目的子id的方法
        $_authruleres = $this->select();
        return $this->_getchildrenid($_authruleres,$_authruleid);
    }
    public function _getchildrenid($_authruleres,$_authruleid){ //为了得到删除栏目的子id的方法
        static $_arr = array();
        foreach ($_authruleres as $_key => $_value){
            if($_value['pid']       == $_authruleid){       //有存在pid等于我的id,即是我的子栏目
                $_arr[]             = $_value['id'];    //找到我儿子栏目的id,因为要删除了他
                $this->_getchildrenid($_authruleres, $_value['id']);    //以此类推，做一个递归,找到所有的子栏目
            }
        }
        return $_arr;   //返回所有找到的子栏目及孙子栏目...的id
    }
    
    
    public function getparentid($_authruleid){
        $_authruleres = $this->select();
        return $this->_getparentid($_authruleres,$_authruleid,true);
    }
    public function _getparentid($_authruleres,$_authruleid,$_clear = false){ 
        static $_arr = array();
        if($_clear){    //如果是真，即传过来的数组还没进行循环，需要查找和排序，需要被清空从第一次开始执行;如果是假，那么说明已经执行过至少一次，需要继续排序
            $_arr = array();
        }
        foreach ($_authruleres as $_key => $_value){
            if($_value['id']       == $_authruleid){       
                $_arr[]             = $_value['id'];    
                $this->_getparentid($_authruleres, $_value['pid'],false);    
            }
        }
        asort($_arr);   //升序排序
        $_arrstr = implode('-', $_arr);
        return $_arrstr;   //返回所有找到的子栏目及孙子栏目...的id
    }
}
