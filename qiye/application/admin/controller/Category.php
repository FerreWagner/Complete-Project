<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use app\admin\model\Category as CategoryModel;

class Category extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //1、获取分类信息
        $cate = CategoryModel::getCate();

        $cate_list = CategoryModel::paginate(2);
        $count     = CategoryModel::count();
        //2、模板赋值
        $this->view->assign(['cate' => $cate, 'cate_list' => $cate_list, 'count' => $count]);

        //3、渲染
        return $this->view->fetch('category_list');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
