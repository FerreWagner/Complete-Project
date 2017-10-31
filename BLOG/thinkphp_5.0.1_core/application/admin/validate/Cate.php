<?php 
    //Cate验证类
    namespace app\admin\validate;
    
    use think\Validate;
    
    class Cate extends Validate{
        protected $rule = [
            'catename' => 'require|max:25|unique:cate',   //验证重复,cate是表名,且不能再|前后有空格
            'keywords' => 'require',
        ];
        protected $message = [
            'catename.require'  => '栏目不能为空',
            'catename.unique'   => '栏目名称不能重复',
            'catename.max'      => '栏目名称不能大于10位',
            'keywords.require' => '关键字不能为空',
        ];
        protected $scene = [
            'edit'  => ['catename'],
        ];
    }


?>