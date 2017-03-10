<?php
namespace app\admin\controller;

use think\Controller;
use think\Loader;

class Cate extends Base{
    public function lst(){
        $cateres = \think\Db::name('cate')->order('id asc')->select();
        $this->assign('cateres',$cateres);
        return $this->fetch();
    }
    
    public function add(){
        if(request() -> isPost()){
            $_data = [
                'catename'   => input('catename'),
                'keywords'   => input('keywords'),
                'desc'      => input('desc'),
                'type'      => input('type') ? input('type') : 0
            ];
            
            $validate = \think\Loader::validate('Cate');
            //引入验证
            if($validate->check($_data)){
            
                $_db = \think\Db::name('cate')->insert($_data);
                if($_db){
                    return $this->success('添加栏目成功','lst');  //跳转到lst方法栏目列表页
                }else{
                    return $this->error('添加栏目失败');
                }
                
            }else{
                return $this->error($validate->getError());
            }
            return;
        }
        
        return $this->fetch();
    }
    
    public function edit(){
        if(request()->isPost()){
            $_data = [
                'id' => input('id'),
                'catename'   => input('catename'),
                'keywords'   => input('keywords'),
                'desc'       => input('desc'),
                'type'       => input('type'),
            ];
            //引入验证
            $validate = \think\Loader::validate('cate');
            if($validate->scene('edit')->check($_data)){
                if(!!$db = \think\Db::name('cate')->update($_data)){
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
        $_cateres = db('cate')->where('id',$_id)->find();   //查找对应id的唯一一条数据
        $this->assign('_cateres',$_cateres);                         //注入数据，以便于页面显示
        return $this->fetch();
    }
    
    public function del(){
        $_id = input('id');
        if(db('cate')->delete($_id)){
            return $this->success('栏目删除成功','lst');
        }else{
            return $this->error('删除栏目失败');
        }
    }
    
}

