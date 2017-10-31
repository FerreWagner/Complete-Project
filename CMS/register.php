<?php 
    require dirname(__FILE__).'/init.inc.php';
    global $_tpl;
    $_register = new RegisterAction($_tpl);
    $_register->_action();
    //载入tpl文件
    $_tpl->display('register.tpl');
?>