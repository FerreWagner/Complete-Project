<?php
namespace app\admin\controller;
use app\admin\model\AuthRule as AuthRuleModel;
use think\Loader;

class AuthRule extends Common
{
    public function lst(){
        $_authrule = new AuthRuleModel();
        if(request()->isPost()){
            //排序
            $_sort = input('post.');
            foreach ($_sort as $_k => $_v){
                $_authrule->update(['id' => $_k,'sort' => $_v]);
            }
            $this->redirect('lst');
            return;
        }
        
        $_authruleres = $_authrule->authruletree();
        $this->assign('_authruleres',$_authruleres);
        return view();
    }
    
    public function add(){
        if(request()->isPost()){
            $_data = input('post.');
            
            //验证
            $_validate = Loader::validate('auth_rule');
            if(!$_validate->scene('add')->check($_data)){
                $this->error($_validate->getError());
            }
            
            $_plevel = db('auth_rule')->where('id',$_data['pid'])->field('level')->find();
            if($_plevel){   //如果存在数据(即不是添加的顶级权限，那么level+1),做这个判断的目的在于如果添加的是顶级权限，level会返回null，level还是会加1，为了避免错误;
                $_data['level'] = $_plevel['level'] + 1;
            }else{          //如果是顶级权限，那么level赋值为0
                $_data['level'] = 0;
            }
            
            $_add = db('auth_rule')->insert($_data);
            if($_add){
                $this->redirect('lst');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        $_authrule = new AuthRuleModel();
        $_authruleres = $_authrule->authruletree();
        $this->assign('_authruleres',$_authruleres);
        return view();
    }
    
    public function edit(){
        if(request()->isPost()){
            $_data = input('post.');
            
            //验证
            $_validate = Loader::validate('auth_rule');
            if(!$_validate->scene('edit')->check($_data)){
                $this->error($_validate->getError());
            }
            
            $_plevel = db('auth_rule')->where('id',$_data['pid'])->field('level')->find();
            if($_plevel){   //如果存在数据(即不是添加的顶级权限，那么level+1),做这个判断的目的在于如果添加的是顶级权限，level会返回null，level还是会加1，为了避免错误;
                $_data['level'] = $_plevel['level'] + 1;
            }else{          //如果是顶级权限，那么level赋值为0
                $_data['level'] = 0;
            }
            
            $_save = db('auth_rule')->update($_data);
            if($_save !== false){
                $this->redirect('lst');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        
        $_authrule = new AuthRuleModel();
        $_authruleres = $_authrule->authruletree();
        $_authrules = $_authrule->find(input('id'));
        
        $this->assign(array(
            '_authruleres' => $_authruleres,
            '_authrules'   => $_authrules,
        ));
        return view();
    }
    
    public function del(){
        $_authrule = new AuthRuleModel();
        $_authrule->getparentid(input('id'));
        
        $_authruleids = $_authrule->getchildrenid(input('id'));
        //这一次不是用前值函数，而是直接找到本栏目和旗下所有子栏目，然后进行批量删除
        $_authruleids[] = input('id');
        $_del = AuthRuleModel::destroy($_authruleids);
        if($_del){
            $this->redirect('lst');
        }else{
            $this->error('删除权限失败');
        }
        return view();
    }
}
