<?php

namespace app\admin\model;

use think\Model;
use think\model\Collection;

class Category extends Model
{
    //

    /**
     * @param int $pid 当前类父ID
     * @param array $result 引用返回值
     * @param int $blank 设置分类间的显示提示
     */
    public static function getCate($pid = 0, &$result = [], $blank = 0)
    {
        //1、分类表的查询
        $res = self::all(['pid' => $pid]);

        //2、自定义分类名称前面的提示信息
        $blank += 2;

        //3、便利分类表
        foreach ($res as $key => $value){
            //1、自定义名称的显示格式
            $cate_name = '--'.$value->cate_name;
            //2、根据层级显示相应空格
            $value->cate_name = str_repeat('&nbsp', $blank).$cate_name;

            //讲查询到的结果保存到相应的数组中
            $result[] = $value;

            //将当前id作为下一级分类的父id,$pid,继续调用递归方法
            self::getCate($value->id, $result, $blank);
        }

        //4、返回查询结果,返回为对象数组，因此处理
        return Collection::make($result)->toArray();
    }
}
