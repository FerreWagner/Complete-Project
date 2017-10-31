<?php 
require substr(dirname(__FILE__),0,-7).'/init.inc.php'; //因为这里是从config目录里出来,所以config是6位加一个/共7位。方法和其他长度截取一致
$_vc = new Validatecode();
$_vc->doimg();
$_SESSION['code'] = $_vc->getCode(); 
?>