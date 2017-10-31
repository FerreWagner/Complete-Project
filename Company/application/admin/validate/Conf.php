<?php
namespace app\admin\validate;
use think\Validate;

class Conf extends Validate
{
    protected $rule = [     //错误规则
        'cnname' => 'unique:conf|require|max:60',
        'enname' => 'unique:conf|require|max:60',
        'type'   => 'require',
    ];
    
    protected $message = [
        'cnname.require' => '中文名称不得为空',
        'cnname.unique'  => '中文名称不得重复',
        'enname.require' => '英文名称不得为空',
        'enname.unique'  => '英文名称不得重复',
        'cnname.max'     => '中文名称不得超过60位',
        'enname.max'     => '英文名称不得超过60位',
        'type.require'   => '类型不得为空',
    ];
    //因为edit和add要求相同，所以不需要场景验证
    protected $scene = [
        'edit' => ['cnname','enname'],
    ];
}
