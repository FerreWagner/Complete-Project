<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule = [     //错误规则
        'name'     => 'unique:admin|require|max:25',
        'password' => 'require|min:2',
    ];
    
    protected $message = [
        'name.require'     => '管理员名称不能为空',
        'name.unique'      => '管理员名称不能重复',
        'name.max'         => '管理员名称不能大于25位',
        'password.require' => '管理员密码不得为空',
        'password.min'     => '密码不得少于两位',
    ];
    
    protected $scene = [    //场景有二,一个是添加,一个是编辑
        'add'  => ['name','password'],
        'edit' => ['name','password' => 'min:2'],
    ];
}
