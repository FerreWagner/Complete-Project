<?php 
    //Cate验证类
    namespace app\admin\validate;
    
    use think\Validate;
    
    class Article extends Validate{
        protected $rule = [
            'title'     => 'require|max:25|unique:article',   //验证重复,article是表名,且不能在|前后有空格
            'keywords'  => 'require',
            'cateid'    => 'require',
        ];
        protected $message = [
            'title.require'     => '文章目不能为空',
            'title.unique'      => '文章名称不能重复',
            'title.max'         => '文章名称不能大于10位',
            'keywords.require'  => '关键字不能为空',
            'cateid.require'    => '不能为空'
        ];
    }


?>