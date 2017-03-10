<?php
namespace app\admin\model;
use think\Model;

class Article extends Model
{
    protected static function init(){
        Article::event('before_insert', function($_data){   //作用是在执行前可以运行
            if($_FILES['thumb']['tmp_name']){
                $_file = request()->file('thumb');
                $_info = $_file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($_info){    //如果上传成功
//                     $_path = $_SERVER['SERVER_NAME'];
                    $_thumb = '/ZEND/Company/public/uploads'.'/'.$_info->getSaveName();
                    $_data['thumb'] = $_thumb;
                }
            }
        });
        
        Article::event('before_update', function($_data){
        if($_FILES['thumb']['tmp_name']){
                $_arts = Article::find($_data->id); //按照id找到待修改图片的id值，为了进一步的修改图片位置
                $_thumbpath = $_SERVER['DOCUMENT_ROOT'].$_arts['thumb'];
                if(file_exists($_thumbpath)){
                    @unlink($_thumbpath);
                }
                
                $_file = request()->file('thumb');
                $_info = $_file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($_info){    //如果上传成功
                    $_thumb = '/ZEND/Company/public/uploads'.'/'.$_info->getSaveName();
                    $_data['thumb'] = $_thumb;
                }
            }
        });
        
        Article::event('before_delete', function($_data){
                
                $_arts = Article::find($_data->id); //按照id找到待修改图片的id值，为了进一步的修改图片位置
                $_thumbpath = $_SERVER['DOCUMENT_ROOT'].$_arts['thumb'];
                if(file_exists($_thumbpath)){
                    @unlink($_thumbpath);
                }
                
        });
        
    }
}
