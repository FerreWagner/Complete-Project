<?php 
    //Cate验证类
    namespace app\admin\validate;
    
    use think\Validate;
    
    class Link extends Validate{
        protected $rule = [
            'title' => 'require|max:25|unique:link',   //验证重复,cate是表名,且不能再|前后有空格
            'url' => 'require',
        ];
        protected $message = [
            'title.require'  => '链接标题不能为空',
            'title.unique'   => '链接标题不能重复',
            'title.max'      => '链接标题不能大于10位',
            'url.require' => '链接地址不能为空',
        ];
     
    }


?>