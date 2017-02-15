<?php
namespace app\admin\validate;
use think\Validate;

class AuthRule extends Validate
{
    protected $rule = [     //错误规则
        'name'     => 'unique:auth_rule|require|max:80',    //此处的unique必须跟表明(如link),才能生效
        'title'    => 'unique:auth_rule|require|max:20',
    ];
    
    protected $message = [
        'title.require'   => '权限名称不得为空',
        'title.max'       => '输入限制为80个字符',
        'title.unique'    => '权限名称不得重复',
        'name.require'    => '方法名不得为空',
        'name.max'        => '输入限制为20个字符',
        'name.unique'     => '方法名不得重复',
    ];
    
    protected $scene = [    //场景有二,一个是添加,一个是编辑
        'add' => ['title'],
        'edit'=> ['title'],
    ];
}
