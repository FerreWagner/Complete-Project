<?php 
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Common extends Controller{
    
    public function _initialize(){
        if(!session('id') || !session('name')){
            $this->error('您尚未登录',url('admin/login/index'));
        }
        
        $_auth = new Auth();
        $_request = Request::instance();        
        $_con     = $_request->controller();    //$_con为当前方法名
        $_action  = $_request->action();        //$_action为当前方法名称
        $_name    = $_con.'/'.$_action;         //拼凑出写入数据库的方法名
        $_not     = array('Index/index','Admin/lst','Admin/logout');   //这里的控制器首字母必须要大些才能进行验证
        if(session('id') !== 20){               //对ferre用户的特殊照顾
            if(!in_array($_name, $_not)){       //判断部分常规方法，如果在我们的$_not常规方法中，就可以访问
                if(!$_auth->check($_name, session('id'))){   //check()方法为auth类里别人写的验证方法,意为当没有验证到该方法名对应的session管理员时，该用户没有权限
                    $this->error('没有权限',url('index/index'));
                }
            }
            
        }
        
    }
}


?>