<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;
use think\Loader;

class Article extends Common
{
    public function lst(){
        $_artres = db('article')->field('a.*,b.catename')->alias('a')->join('cp_cate b','a.cateid=b.id')->order('a.id desc')->paginate(6);
        $this->assign('_artres',$_artres);
        return view();
    }
    
    public function add(){
        if(request()->isPost()){
            $_data = input('post.');
            $_data['time'] = time();    //写入时间戳
            $validate = Loader::validate('Article');
            if(!$validate->scene('add')->check($_data)){
                $this->error($validate->getError());
            }
            $_article = new ArticleModel;
//             if($_FILES['thumb']['tmp_name']){
//                 $_file = request()->file('thumb');
// //                 print_r($_file);die;
//                 $_info = $_file->move(ROOT_PATH . 'public' . DS . 'uploads');
//                 if ($_info){    //如果上传成功
//                     $_thumb = ROOT_PATH . 'public' .DS . 'uploads/'.$_info->getSaveName();
//                     $_data['thumb'] = $_thumb;
//                 }
//             }
            if($_article->save($_data)){
                $this->redirect('lst');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        
        $_cate = new CateModel();
        $_cateres  = $_cate->catetree();    //执行模型层的数据处理
        $this->assign('_cateres',$_cateres);
        return view();
    }
    
    public function edit(){
        if(request()->isPost()){    //判断提交表单，然后执行修改操作
            $_data = input('post.');
            $validate = Loader::validate('Article');
            if(!$validate->scene('edit')->check($_data)){
                $this->error($validate->getError());
            }
            $_article = new ArticleModel();
            $_save = $_article->update(input('post.'));   //save虽然是添加操作，但是字段中有主键，肯定就是修改操作
            if($_save !== false){
                $this->redirect('lst');
            }else{
                $this->error('修改失败');
            }
        }
        
        $_cate     = new CateModel();
        $_cateres  = $_cate->catetree();    //执行模型层的数据处理
        $_arts     = db('article')->find(input('id'));
        $this->assign(array(
            '_cateres' => $_cateres,
            '_arts'    => $_arts,
        ));
        return view();
    }
    
    public function del(){
        if(ArticleModel::destroy(input('id'))){ //直接使用model的静态方法
            $this->redirect('lst');
        }else{
            $this->error('删除失败');
        }
    }
}
