<?php
namespace app\admin\controller;
use app\admin\model\Conf as ConfModel;
use think\Loader;
// use think\Loader;

class Conf extends Common
{
    public function lst(){
        if(request()->isPost()){
            $_sorts = input('post.');
            $_conf = new ConfModel();
            foreach ($_sorts as $_key => $_value){
                $_conf->update(['id' => $_key,'sort' => $_value]);
            }
            $this->redirect('lst');
            return;
        }
        $_confres = ConfModel::order('sort asc')->paginate(6);
        $this->assign('_confres',$_confres);
        return view();
    }
    
    public function add(){
        if(request()->isPost()){
            $_data = input('post.');
            
            $validate = Loader::validate('Conf');
            if(!$validate->check($_data)){
                $this->error($validate->getError());
            }
            if($_data['values']){
                $_data['values'] = str_replace('，', ',', $_data['values']); //用英文的逗号替换中文的逗号,用于过滤
            }
            $_conf = new ConfModel();   //使用model的方式进行添加
            if($_conf->save($_data)){
                $this->redirect('lst');
            }else{
                $this->error('添加失败');
            }
        }
        return view();
    }
    
    public function edit(){
        if(request()->isPost()){
            $_data = input('post.');
            
            $validate = Loader::validate('Conf');
            if(!$validate->scene('edit')->check($_data)){
                $this->error($validate->getError());
            }
            if($_data['values']){
                $_data['values'] = str_replace('，', ',', $_data['values']); //还是数据的逗号过滤
            }
            $_conf = new ConfModel();
            $_save = $_conf->save($_data,['id' => $_data['id']]);
            if($_save !== false){
                $this->redirect('lst');
            }else{
                $this->error('修改失败');
            }
        }
        $_confs = ConfModel::findOrFail(input('id'));
        $this->assign('_confs',$_confs);
        return view();
    }
    
    public function del(){
        $_del = ConfModel::destroy(input('id'));
//         if($_del == 1){
//             echo 1;
//         }elseif ($_del == 0){
//             echo 0;
//         }elseif ($_del == false){
//             echo '错误';
//         }
        if($_del){
            $this->redirect('lst');
        }else{
            $this->error('删除失败');
        }
    }
    
    public function conf(){ //展示出所有的配置项
        if(request()->isPost()){
            $_data = input('post.');
            $_dataform = array();   //用来装取post过来的数组，然后提取出enname
            foreach ($_data as $_key => $_value){   //得到数据表里post过来的enname数组
                $_dataform[] = $_key;
            }
            
            $_confarr = db('conf')->field('enname')->select();   //这里要做的功能是，判断复选框是否选中，因为不选中就不会有相关字段传过来，而且我们这里是由enname作为name，因此找enname
            $_arr = array();
            foreach ($_confarr as $_key => $_value){    //因为取到的是二维数组，所以直接做成一维数组取数据更方便
                $_arr[] = $_value['enname'];
            }
            foreach ($_arr as $_key => $_value){        //遍历数据库的所有enname值，看是否有在表单post过来的值，如果不存在这个值，就把这个值单独拿出来
                if(!in_array($_value, $_dataform)){
                    $_checkbox_arr[] = $_value;
                }
            }
            if(@$_checkbox_arr){    //如果存在有值没有返回，那么就说明复选框有没有选中的，所以直接设置为否即可
                foreach ($_checkbox_arr as $_k => $_v){
                    db('conf')->where('enname',$_v)->update(['value' => '否']);
                }
            }
 
//             if(@$_checkbox_arr){
//                 $_data = [
//                     ''
//                 ];
//                 dump($_check);die;
//             }
            if($_data){     //如果存在数据，才进行处理
                foreach ($_data as $_key => $_value){   //这个$_key是enname,$_value是传递过来的值
                    ConfModel::where('enname',$_key)->update(['value' => $_value]);
                }
                $this->redirect('conf');
            }
            
            return;
        }
        $_confres = ConfModel::order('sort asc')->select();
        $this->assign('_confres',$_confres);
        return view();
    }
    
}
