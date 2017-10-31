<?php
namespace app\admin\model;
use think\Model;

class Admin extends Model
{
    public function addadmin($_data) {          //进入controller数据的添加；
        //判断数据是否为空
        if(empty($_data) || !is_array($_data)){ //因为传过来的是数组的形式；所以如果为空或不是数组，那么就返回false
            return false;
        }
        //数据加密
        if($_data['password']){     //判断密码不为空，存在数据，才好加密
            $_data['password'] = md5($_data['password']);
        }
        $_admindata = array();      //这里添加的数据需要跨越两个表，因此首先创建一个存放admin表的数组，来存放数据
        $_admindata['name'] = $_data['name'];
        $_admindata['password'] = $_data['password'];
        if($this->save($_admindata)){    //执行添加数据,成功就返回true，失败就返回false
            $_groupaccess['uid'] = $this->id;
            $_groupaccess['group_id'] = $_data['group_id'];
            db('auth_group_access')->insert($_groupaccess);
            return true;
        }else{
            return false;
        }
    }
    
    public function getadmin(){    //进入controller数据显示
        return $this::paginate(6); //这个$this代表调用当前方法的$_admin对象,也可以使用$this->指针的形式
    }
    
    public function saveadmin($_data,$_admins){          //管理员数据的修改
        if(!$_data['name']){                             //因为用户名在H5已经判断过了，如果还未空，那么就是非法操作（程序员暗箱操作）
            return 2;                                    //随便返回一个值2,代表管理员用户名为空
        }
        if(!$_data['password']){                         //如果密码不填写，则为原密码
            $_data['password'] = $_admins['password'];
        }else{
            $_data['password'] = md5($_data['password']);//如果存在，就md5加密写入
        }
        db('auth_group_access')->where(array('uid' => $_data['id']))->update(['group_id' => $_data['group_id']]);                //将group_id改为输入修改的input('post')里的id,就是这里传过来的$_data['id']
        return $this->update(['name'=>$_data['name'],'password'=>$_data['password']],['id'=>$_data['id']]);             //更新经过input()过来再改变的$_data数据
        //这里使用return表示：如果没有修改，就返回false，返回0表明修改了password，返回1则表明至少修改了name
    }
    
    public function deladmin($id) {
        if($this->where('id','=',$id)->delete()){    //删除成功返回1，失败返回2
            //也可以直接使用destroy方法删除：$this::destroy($id)
            return 1;
        }else{
            return 2;
        }
    }
    
    public function login($_data) {
        $_admin = Admin::getByName($_data['name']); //获取用户数据
        if($_admin){    //判断输入用户是否存在
            if($_admin['password'] == md5($_data['password'])){    //判断密码是否正确
                session('id',$_admin['id']);
                session('name',$_admin['name']);
                return 2;   //登录信息正确的情况
            }else{
                return 3;   //密码错误的情况
            }
        }else{
            return 1;   //用户不存在的情况
        }
    }
}
