<?php
namespace app\admin\controller;

// use think\Controller;
// use think\Loader;
class Admin extends Base{
    public function lst(){
        $adminres = \think\Db::name('admin')->paginate(2);
        $this->assign('adminres',$adminres);
        return $this->fetch();
    }
    
    public function add(){
        if(request() -> isPost()){
            $_data = [
                'username'   => input('username'),
                'password'   => md5(input('password')),
            ];
            
            $validate = \think\Loader::validate('Admin');
            //引入验证
            if($validate->check($_data)){
            
                $_db = \think\Db::name('admin')->insert($_data);
                if($_db){
                    return $this->success('添加管理员成功','lst');  //跳转到lst方法栏目列表页
                }else{
                    return $this->error('添加管理员失败');
                }
                
            }else{
                return $this->error($validate->getError());
            }
            return;
        }
        
        return $this->fetch();
    }
    
    public function edit(){
        $_id = input('id');
        if(request()->isPost()){
            $_userinfo = \think\Db::name('admin')->find($_id);  //找到对应id的数据
            $_password = $_userinfo['password'];                //找到对应密码
            $_data = [
                'id' => input('id'),
                'username'   => input('username'),
                'password'   => input('password') ? md5(input('password')) : $_password,
            ];
            //引入验证
            $validate = \think\Loader::validate('Admin');
            if($validate->scene('edit')->check($_data)){
                if(!!$db = \think\Db::name('admin')->update($_data)){
                    return $this->success('修改成功','lst');
                }else{
                    return $this->error('修改失败');
                }
            }else{
                return $this->error($validate->getError());
            }
            
            return; //如果接收到POST传送，执行以上修改后就返回
        }
        $_id = input('id');
        $_admins = db('admin')->find($_id);   //查找对应id的唯一一条数据
        $this->assign('_admins',$_admins);                         //注入数据，以便于页面显示
        return $this->fetch();
    }
    
    public function del(){
        $_id = input('id');
        if($_id == 1){
            return $this->error('初始化管理员不允许删除');
        }
        if(db('admin')->delete($_id)){
            return $this->redirect('lst');
        }else{
            return $this->error('删除管理员失败');
        }
    }
    
}

