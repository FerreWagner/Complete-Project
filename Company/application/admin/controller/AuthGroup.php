<?php
namespace app\admin\controller;
use app\admin\model\AuthGroup as AuthGroupModel;
use think\Loader;

class AuthGroup extends Common
{
    public function lst(){
        $_authgroupres = AuthGroupModel::paginate(6);
        $this->assign('_authgroupres',$_authgroupres);
        return view();
    }
    
    public function add(){
        if(request()->isPost()){
            $_data = input('post.');
            if(@$_data['rules']){   //将规则rules数组拆分成字符放进数据库
                $_data['rules'] = implode(',', $_data['rules']);
            }
            
            
            //验证
            $_validate = Loader::validate('auth_group');
            if(!$_validate->scene('add')->check($_data)){
                $this->error($_validate->getError());
            }
            
            //判断status的值
            if(@$_data['status']){
                $_data['status'] = 1;
            }
            if(!isset($_data['status'])){
                $_data['status'] = 0;   //如果没有接收到复选框传值(即没选中),那么设置其值为0
            }
            $_add = db('auth_group')->insert($_data);
            if($_add){
                $this->redirect('lst');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        //拿到authrule的数据
        $_authrule = new \app\admin\model\AuthRule();
        $_authruleres = $_authrule->authruletree();
        $this->assign('_authruleres',$_authruleres);
        return view();
    }
    
    public function edit(){
        if(request()->isPost()){
            $_data = input('post.');
            if(@$_data['rules']){   //将规则rules数组拆分成字符放进数据库
                $_data['rules'] = implode(',', $_data['rules']);
            }
            
            $_data_arr = array();
            foreach ($_data as $_k => $v){
                $_data_arr[] = $_k; //将$_k即字段名传给arr，来判断status是否存在于数据库中，从而修改
            }
            if(!in_array('status',$_data_arr)){ //如果status根本不存在于编辑的字段中，直接设置值为0
                $_data['status'] = 0;
            }
            //验证
            $_validate = Loader::validate('auth_group');
            if(!$_validate->scene('edit')->check($_data)){
                $this->error($_validate->getError());
            }
            $_save = db('auth_group')->update($_data);
            if($_save !== false){
                $this->redirect('lst');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        
        $_authgroups = db('auth_group')->find(input('id'));
        $this->assign('_authgroups',$_authgroups);
        
        //拿到authrule的数据
        $_authrule = new \app\admin\model\AuthRule();
        $_authruleres = $_authrule->authruletree();
        $this->assign('_authruleres',$_authruleres);
        return view();
    }
    
    public function del(){
        $_del = db('auth_group')->delete(input('id'));
        if($_del){
            $this->redirect('lst');
        }else{
            $this->error('删除用户组失败');
        }
    }
}
