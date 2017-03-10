<?php
namespace app\admin\controller;

use think\Controller;

class Link extends Controller{
    public function lst(){
        $linkres = \think\Db::name('link')->paginate(2);
        $this->assign('linkres',$linkres);
        return $this->fetch();
    }
    
    public function add(){
        if(request() -> isPost()){
            $_data = [
                'title' => input('title'),
                'url'   => input('url'),
                'desc'  => input('desc')
            ];
    
            $validate = \think\Loader::validate('Link');
            //引入验证
            if($validate->check($_data)){
    
                $_db = \think\Db::name('link')->insert($_data);
                if($_db){
                    return redirect('lst');           //跳转到lst方法栏目列表页
                }else{
                    return $this->error('添加链接失败');
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
//             $_data = [
//                 'id'         => input('id'),
//                 'catename'   => input('catename'),
//                 'keywords'   => input('keywords'),
//                 'desc'       => input('desc'),
//                 'type'       => input('type'),
//             ];
            //引入验证
            $validate = \think\Loader::validate('link');
            if($validate->check(input('post.'))){       //input('post.')接收所有post发送的数据
                if(!!$db = \think\Db::name('link')->update(input('post.'))){
                    return redirect('lst');
                }else{
                    return $this->error('修改失败');
                }
            }else{
                return $this->error($validate->getError());
            }
            
            return; //如果接收到POST传送，执行以上修改后就返回
        }
        $_id    = input('id');
        $_links = db('link')->where('id',$_id)->find();          //查找对应id的唯一一条数据
        $this   ->assign('_links',$_links);                         //注入数据，以便于页面显示
        return  $this->fetch();
    }
    
    public function del(){
        $_id = input('id');
        if(db('link')->delete($_id)){
            return $this->redirect('lst');
        }else{
            return $this->error('友情链接删除失败');
        }
    }
    
}

