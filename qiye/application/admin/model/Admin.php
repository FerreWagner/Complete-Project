<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    //获取器方法，用来实现时间的转换
    public function getLastTimeAttr($val)
    {
        return date('Y-m-d', $val);
    }
    
    //修改器，为了在更新密码前md5加密
    public function setPasswordAttr($val)
    {
        return md5($val);
    }
}
