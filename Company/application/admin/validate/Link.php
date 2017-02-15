<?php
namespace app\admin\validate;
use think\Validate;

class Link extends Validate
{
    protected $rule = [     //错误规则
        'title' => 'unique:link|require|max:25',    //此处的unique必须跟表明(如link),才能生效
        'url'   => 'url|unique:link|require|max:100',
    ];
    
    protected $message = [
        'title.require' => '标题不得为空',
        'title.max'     => '输入限制为25个字符',
        'title.unique'  => '标题不得重复',
        'url.url'       => '链接地址格式不正确',
        'url.require'   => '链接不得为空',
        'url.max'       => '链接长度不得大于100字符',
        'url.unique'    => '链接地址不得重复',
    ];
    
    protected $scene = [    //场景有二,一个是添加,一个是编辑
        'add' => ['title','url' => 'unique:link|require'],   //这里的场景验证中，指定了url只需要检查是否唯一和是否为空，所以其他的url规则都不能生效，如果不写，则都按照原来定义的规则验证
        'edit'=> ['title','url' => 'require'],               //这里只是定义了url不能为空
    ];
}
