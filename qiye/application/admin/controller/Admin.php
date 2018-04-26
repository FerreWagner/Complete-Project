<?php

namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Admin as AdminModel;

class Admin extends Base
{
    /**
     * 显示管理员首页
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $admin = AdminModel::get(['username' => 'admin']);
        $this->view->assign('admin', $admin);
        
        return $this->view->fetch('admin_list');
        
    }

    /**
     * 渲染编辑模板页.
     *
     * @return \think\Response
     */
    public function edit(Request $request)
    {
        $admin = AdminModel::get($request->param('id'));
        $this->view->assign('admin', $admin);
        
        return $this->view->fetch('admin_edit');
    }

    //执行更新操作
    public function update(Request $request)
    {
        if ($request -> isAjax(true)){

            //获取提交的数据,自动过滤一下空值
            $data = array_filter($request->param());

            //设置更新条件
            $map = ['is_update' => $data['is_update']];

            //更新用户表
            $res = AdminModel::update($data, $map);

            //更新成功的提示信息
            $status  = 1;
            $message = '更新成功';

            //如果更新失败
            if (is_null($res)) {
                $status  = 0;
                $message = '更新失败';
            }
        }
        return ['status'=>$status, 'message'=>$message];
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
