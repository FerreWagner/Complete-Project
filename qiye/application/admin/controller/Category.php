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

        $cate_list = CategoryModel::paginate(6);
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
    public function create(Request $request)
    {
        //
        $status = 1;
        $message = '添加成功';

        //添加数据
        $res = CategoryModel::create([
            'cate_name' => $request->param('cate_name'),
            'pid'       => $request->param('pid'),
        ]);

        //添加失败处理
        if (is_null($res)){
            $status = 0;
            $message = '添加失败';
        }
        return ['status' => $status, 'message' => $message, 'res' => $res->toJson()];
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
