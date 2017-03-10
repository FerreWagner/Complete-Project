<?php 
    //Cate验证类
    namespace app\admin\validate;
    
    use think\Validate;
    
    class Admin extends Validate{
        protected $rule = [
            'username' => 'require|max:25|unique:admin',   //验证重复,cate是表名,且不能再|前后有空格
            'password' => 'require|min:5',
        ];
        protected $message = [
            'username.require'  => '用户名不能为空',
            'username.unique'   => '用户名不能重复',
            'username.max'      => '用户名不能大于10位',
            'password.require'  => '密码不能为空',
            'password.min'      => '密码不能小于5位',
//             'password.number'   => '密码必须是数字类型',
        ];
        protected $scene = [
            'edit'  => ['username'],    //edit状态下只验证username
        ];
    }


?>