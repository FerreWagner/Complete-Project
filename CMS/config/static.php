<?php 
require substr(dirname(__FILE__),0,-7).'/init.inc.php'; //本来是很大一段，后来直接引用init文件
global $_cache;
$_cache->_action(); //指向执行方法

?>