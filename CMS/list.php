<?php 
    require dirname(__FILE__).'/init.inc.php';
    global $_tpl;
    $_list = new ListAction($_tpl);
    $_list->_action();
    //载入tpl文件
    $_tpl->display('list.tpl');
?>