<?php

namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\System as SystemModel;

class System extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //获取配置信息
        
        $this->view->assign('system', $this->getSystem());
        
        return $this->view->fetch('system_set');
        
    }


    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        if ($request->isAjax(true)){
            
            $data = $request->param();
            //设置更新条件
            $map = ['is_update' => $data['is_update']];
            $res = SystemModel::update($data, $map);
            
            //返回信息
            if (is_null($res)){
                $status = 0;
                $message = '更新失败，请检查';
            }else {
                $status = 1;
                $message = '更新成功啦';
            }
            
            return ['status' => $status, 'message' => $message];
            
        }
        
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
