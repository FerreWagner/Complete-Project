<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use think\Loader;

class Cate extends Common
{
    protected $beforeActionList = [
        'delsoncate' => ['only' => 'del'],  //只有当执行的方法为del时,才会在此之前执行delsoncate方法;
    ];

    public function lst()   //显示
    {   $_cate      = new CateModel();
        if(request()->isPost()){
            $_sorts = input('post.');   //这里的post得到的值是以数据库id为下标,以sort值为value的数组
            foreach ($_sorts as $_key => $_value){
                $_cate->update(['id' => $_key,'sort' => $_value]);
            }
            $this->redirect('lst');
            return;
        }
        $_cateres  = $_cate->catetree();    //执行模型层的数据处理
        $this->assign('_cateres',$_cateres);
        return view();
    }
    
    public function add(){  //添加
        $_cate = new CateModel();
        if(request()->isPost()){
            $_data = input('post.');
            $validate = Loader::validate('Cate');
            if(!$validate->scene('add')->check($_data)){
                $this->error($validate->getError());
            }
            
            $_cate->data($_data);
            $_add = $_cate->save();
            if($_add){
                $this->redirect('lst');
            }else{
                $this->error('添加栏目失败');
            }
        }
        $_cateres  = $_cate->catetree();    //执行模型层的数据处理
        $this->assign('_cateres',$_cateres);
        return view();
    }
    
    public function edit(){ //编辑
        $_cate = new CateModel();
        if(request()->isPost()){
            $_data = input('post.');
            $validate = Loader::validate('Cate');
            if(!$validate->scene('edit')->check($_data)){
                $this->error($validate->getError());
            }
            
            $_save = $_cate->save($_data,['id' => $_data['id']]);
            if($_save !== false){
                $this->redirect('lst');
            }else{
                $this->error('修改栏目失败');
            }
            return;
        }
        $_cates = $_cate->find(input('id'));  //拿到该条id所对应的数据
        $_cateres  = $_cate->catetree();    //执行模型层的数据处理
        $this->assign(array(
            '_cateres' => $_cateres,
            '_cates'   => $_cates,
        )); //数组分配变量的方式,节省代码量
        
        return view();
    }
    
    public function del(){  //删除
        $_del = db('cate')->delete(input('id'));
        if($_del){  //如果返回值有值(为真)
            $this->redirect('lst');
        }else{
            $this->error('删除栏目失败');
        }
    }
    
    public function delsoncate(){   //能在前置方法里接收到数据
        $_cateid = input('id');     //要删除的当前栏目id
        $_cate   = new CateModel();
        $_sonids = $_cate->getchildrenid($_cateid);
        
        //找到主栏目id和对应子、孙子栏目id,下面就直接批量删除
        if($_sonids){
            db('cate')->delete($_sonids);
        }
        
    }
    
}
