<?php
namespace app\index\model;
use think\Model;

class Conf extends Model
{
    public function getAllConf(){   //获取所有配置项,getAllxxx,xxx为数据表名
        $_confres = $this::field('enname,cnname')->select();  //目的是想通过英文名称获得中文的值
        return $_confres;
    }
}
