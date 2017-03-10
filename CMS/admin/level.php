<?php 
    require substr(dirname(__FILE__),0,-6).'/init.inc.php';
    Validate::checkSession();
    global $_tpl;
    $_level = new LevelAction($_tpl);    //入口
    $_level->_action();   //访问action私有方法，再调用各个实体的方法，简化代码
    $_tpl->display('level.tpl');  //在level.php里拿到$_tpl,再从level.php引用的init文件里再引用到templates.class.php里引用display方法,注入level.tpl,让其可以形成模板文件
?>