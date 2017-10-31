<?php 
    require substr(dirname(__FILE__),0,-6).'/init.inc.php';
    global $_tpl;
    Validate::checkSession();   //该方法：如果session不存在，就不能访问admin.php页面
    $_tpl->display('admin.tpl');
?>