<?php
namespace app\admin\controller;

class Index extends Common  //继承admin首页，即防止了不登录直进入admin模块；
{
    public function index()
    {
        return view();
    }
}
