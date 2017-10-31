<?php 
    require substr(dirname(__FILE__),0,-6).'/init.inc.php';
    global $_tpl;
    $_login = new LoginAction($_tpl);
    $_login->_action();
    if(isset($_SESSION['admin'])) Tool::alertLocation(null, 'admin.php');   //如果session存在，则进不了admin_login.php页面
    
    $_tpl->display('admin_login.tpl');
?>