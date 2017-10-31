<?php 
namespace app\admin\model;

use think\Model;

class Link extends Model{
    public function add2(){
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
}


?>