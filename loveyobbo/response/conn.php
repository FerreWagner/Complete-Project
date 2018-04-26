<?php 
require_once 'config.php';
$_mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_POST);
if($_mysqli->errno){
    die('Connect Error:'.$_mysqli->error);
}else{
    $_mysqli->set_charset('UTF8');
}



?>