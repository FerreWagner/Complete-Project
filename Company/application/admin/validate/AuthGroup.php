<?php
namespace app\admin\validate;
use think\Validate;

class AuthGroup extends Validate
{
    protected $rule = [     //错误规则
        'title'    => 'unique:auth_group|require|max:100',    //此处的unique必须跟表明(如link),才能生效
    ];
    
    protected $message = [
        'title.require'   => '用户组名称不得为空',
        'title.max'       => '输入限制为100个字符',
        'title.unique'    => '用户组名称不得重复',
    ];
    
    protected $scene = [    //场景有二,一个是添加,一个是编辑
        'add' => ['title'],
        'edit'=> ['title'],
    ];
}
