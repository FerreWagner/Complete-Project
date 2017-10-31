<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Article extends Base{
    public function lst(){
        $artres = Db::name('article')->alias('a')->join('cate c','c.id = a.cateid','LEFT')->field('a.id,a.title,a.pic,a.click,a.author,a.time,c.catename')->order('a.id asc')->paginate(2);
        $this->assign('artres',$artres);
        return $this->fetch();
    }
    
    public function add(){
        if(request()->isPost()){    //如果是POST传送，即有数据写入，那么跳转到此逻辑，执行增加
            //拿到作者的数据
            $_author = Db::name('admin')->where('id','=',session('id'))->find();
//             var_dump($_author);die();
            $_data = [
                'title'     => input('title'),
                'keywords'  => input('keywords'),
                'desc'      => input('desc'),
                'cateid'    => input('cateid'),
                'content'   => input('content'),
                'click'     => input('click'),
                'pic'       => input('pic'),
                'author'    => $_author['username'],
                'time'      => time()
            ];
            if($_FILES['pic']['tmp_name']){
                $_file = request()->file('pic');    //获取上传文件
                $_info = $_file->move(ROOT_PATH . 'public' . DS .'static/uploads');    //存储到public的uploads目录下，注意：这里一定要写DS
                if($_info){
                    $_data['pic'] = '/static/uploads/'.date('Ymd').'/'.$_info->getFilename();
//                     echo $_info->getExtension();    //成功上传后，获取上传信息；输出jpg
//                     echo $_info->getFilename();
                }else{
                    return $this->error();          //上传失败获取错误信息
                }
            }else{
//                 echo @$_file->getError();            //上传失败获取错误信息
//                 return $this->error($_file->getError());
            }
            $_validate = \think\Loader::validate('article');        //验证必须引入
            if($_validate->check($_data)){
                $_db = \think\Db::name('article')->insert($_data);  //写入数据
                if($_db){
                    return $this->success('添加文章成功','lst');
                }else{
                    return $this->error('添加文章失败');
                }
            }else{
                return $this->error($_validate->getError());
            }
            return;
        }
        $_cateres = db('cate')->select();
        $this->assign('_cateres',$_cateres);
        return $this->fetch();                  //否则直接显示
    }
    
    
    public function edit(){
        if(request()->isPost()){    //如果是POST传送，即有数据写入，那么跳转到此逻辑，执行增加
            $_data = [
                'id'        => input('id'),
                'title'     => input('title'),
                'keywords'  => input('keywords'),
                'desc'      => input('desc'),
                'cateid'    => input('cateid'),
                'content'   => input('content'),
                'click'     => input('click'),
                'pic'       => input('pic'),
                'time'      => time()
            ];
            if($_FILES['pic']['tmp_name']){
                $_file = request()->file('pic');    //获取上传文件
                $_info = $_file->move(ROOT_PATH . 'public' . DS .'static/uploads');    //存储到public的uploads目录下，注意：这里一定要写DS
                if($_info){
                    $_data['pic'] = '/static/uploads/'.date('Ymd').'/'.$_info->getFilename();
                    //                     echo $_info->getExtension();    //成功上传后，获取上传信息；输出jpg
                    //                     echo $_info->getFilename();
                }else{
                    return $this->error();          //上传失败获取错误信息
                }
            }else{
                //                 echo @$_file->getError();            //上传失败获取错误信息
                //                 return $this->error($_file->getError());
            }
            $_validate = \think\Loader::validate('article');        //验证必须引入
            if($_validate->check($_data)){
                $_db = \think\Db::name('article')->update($_data);  //写入数据
                if($_db){
                    return $this->redirect('lst');          //这里直接用redirect跳转
                }else{
                    return $this->error('修改文章失败');
                }
            }else{
                return $this->error($_validate->getError());
            }
            return;
        }
        $arts = Db::name('article')->where('id',input('id'))->find();
        $_cateres = db('cate')->select();
        $this->assign('_cateres',$_cateres);
        $this->assign('arts',$arts);
        return $this->fetch('edit');                  //否则直接显示
    }
    
    public function del(){
        $_id = input('id');
        if(db('article')->delete($_id)){
            return $this->success('删除文章成功','lst');
        }else{
            return $this->error('删除文章失败');
        }
    }
    
    
    
}


