<?php
namespace app\admin\controller;
// use think\Controller; 因为common.php已经继承了controller，所以只需要继承common，间接继承controller
use app\admin\model\Admin as AdminModel;
use think\Loader;

class Admin extends Common
{

    public function lst()   //显示管理员
    {
        $_auth       = new Auth();  //从auth规则里拿数据
        
        $_admin      = new AdminModel();
        $_adminres   = $_admin->getadmin();     //执行getadmin()方法，得到分页数据
        
        foreach ($_adminres as $_k => $_v){     //这里是为了循环出用户对应的用户组，给予显示
            $_groupstitle = $_auth->getGroups($_v['id']);   //将所有管理员的id作为getgroup方法的id进行用户组查找
            $_groupstitle = $_groupstitle[0]['title'];      //查出来的是二维数组，将数组中的title(即用户组的组名)作为数据传给自己
            $_v['grouptitle'] = $_groupstitle;              //给$_v新添加一个下标，然后将数组给他,adminres就又拿到了用户组的数据
        }
        $this->assign('_adminres',$_adminres);
        return view();
    }
    
    public function add()
    {
        if(request()->isPost()){                    //判断是否提交了POST表单
//             $_data = input('post.');                //接收所有的POST数据（有安全过滤）
//             $_res  = db('admin')->insert($_data);    //插入数据,返回成功执行数据的条数
            
            $_data = input('post.');
            $validate = Loader::validate('Admin');
            if(!$validate->scene('add')->check($_data)){
                $this->error($validate->getError());
            }
            //以下为放在model里面处理数据的方式
            $_admin = new AdminModel();              //实例化数据处理类：AdminModel
            $_res   = $_admin->addadmin(input('post.'));
            if($_res){
                $this->redirect('lst');              //redirect这个方法必须要继承Controller才能使用
            }else{
                $this->error('添加失败');               //这个方法会自动返回上一页
            }
            return;
        }
        //用户组数据处理group表
        $_authgroupres = db('auth_group')->select();
        $this->assign('_authgroupres',$_authgroupres);
        
        return view();
    }
    
    public function edit($id)                                //这个id是接受来自lst模板的唯一对应参数id
    {   //修改管理员
        $_admins = db('admin')->find($id);                   //得到当前管理员的数据
        
        if(request()->isPost()){                             //判断为post传输，即修改数据
            $_data = input('post.');
            $validate = Loader::validate('Admin');
            if(!$validate->scene('edit')->check($_data)){
                $this->error($validate->getError());
            }
            $_admin   = new AdminModel();                    //创建对象，为了使用model里操作数据的方法，从而好进行业务逻辑的判断；
            $_savenum = $_admin->saveadmin($_data,$_admins);
            
            if($_savenum == '2'){                            //saveadmin(xx,xx)将必要的数据作为参数传给model里的方法;
                //这里的2是来自model传过来判断业务逻辑的参数
                $this->error('非法操作','lst');
            }
            if($_savenum !== false){                         //saveadmin(xx,xx)将必要的数据作为参数传给model里的方法；                             //当修改密码时，也算是修改，但是返回结果为0，所以不能单纯判断if(xxx)
                $this->redirect('lst');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        
        if(!$_admins){                                       //管理员数据不存在，则返回到列表页；防止url输入不存在的id号，安全;
            $this->error('管理员不存在','lst');
        }
        
        $_authgroupaccess = db('auth_group_access')->where(array('uid' => $id))->find();    //这个id是edit($id)传过来的id,这里拿到了用户id对应的用户组id,坐这里是为了让edit出去后select便于选中
        //用户组数据处理group表
        $_authgroupres = db('auth_group')->select();
        $this->assign('_authgroupres',$_authgroupres);      //注入用户组的数据
        
        $this->assign('_admins',$_admins);                   //注入进模板，为了显示
        $this->assign('_groupid',$_authgroupaccess['group_id']);
        return view();
    }
    
    public function del($id) {  //删除管理员
        $_admin  = new AdminModel();
        $_delnum = $_admin->deladmin($id);
        if($_delnum == '1'){
            $this->redirect('lst');
        }else{
            $this->error('删除失败','lst');
        }
    }
    
    public function logout(){
        //实际上就是清除session
        session(null);
        $this->success('退出系统成功','login/index');
    }
}
