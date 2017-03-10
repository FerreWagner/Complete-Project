<?php 
    require dirname(__FILE__).'/init.inc.php';
    global $_tpl;
    //声明一个变量
//     $_name = 'Ferre';
//     $_content = '是一个老师';
//     $_array = array(1,2,3,4,5,6,7);
//     //注入一个变量
//     $_tpl->assign('name', $_name);      //第一个name和tpl模板里的name相同传值,第二个$_name和上方的$_name一样传值
//     $_tpl->assign('content', $_content);
//     $_tpl->assign('a', 5>4);
//     $_tpl->assign('array', $_array);
    $_register = new IndexAction($_tpl);
    $_register->_action();
    //载入tpl文件
    $_tpl->display('index.tpl');
?>