<?php
namespace app\admin\controller;
use app\admin\model\Link as LinkModel;
use think\Loader;

class Link extends Common
{

    public function lst()   //显示
    {
        $_link = new LinkModel();
        if(request()->isPost()){
            $_sorts = input('post.');   //这里的post得到的值是以数据库id为下标,以sort值为value的数组
            foreach ($_sorts as $_key => $_value){
                $_link->update(['id' => $_key,'sort' => $_value]);
            }
            $this->redirect('lst');
            return;
        }
        $_linkres = LinkModel::order('sort asc')->paginate(6);  //排序和分页
        $this->assign('_linkres',$_linkres);
        return view();
    }
    
    public function add(){  //添加
        if(request()->isPost()){
            $_data = input('post.');
            $validate = Loader::validate('Link');
            if(!$validate->scene('add')->check($_data)){   //check()为我们自己定义的验证规则
                $this->error($validate->getError());       //getError()为我们定义的错误信息
            }
            $_add = LinkModel::create($_data);
            if($_add){
                $this->redirect('lst');
            }else{
                $this->error('添加失败');
            }
        }
        return view();
    }
    
    public function edit(){ //编辑
        if(request()->isPost()){
            $_data = input('post.');
            $_link = new LinkModel();
            $validate = Loader::validate('Link');
            if(!$validate->scene('edit')->check($_data)){
                $this->error($validate->getError());
            }
            $_save = $_link->save($_data,['id' => $_data['id']]);
            if($_save !== false){   //因为此处如果不修改,会返回一个0,所以判断只有为false的时候,才修改失败
                $this->redirect('lst');
            }else{
                $this->error('修改失败');
            }
            return;
        }
        $_links = LinkModel::find(input('id'));
        $this->assign('_links',$_links);
        return view();
    }
    
    public function del(){  //删除
        $_del = db('link')->delete(input('id'));    //这里直接适用于数据库删除，方便，懒得实例化model
        if($_del){
            $this->redirect('lst');
        }else{
            $this->error('删除失败');
        }
        return view();
    }
    

}
