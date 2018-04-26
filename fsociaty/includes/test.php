<?php 
    $_mysqli = new mysqli('localhost', 'root', '', 'demo');
    $_mysqli->set_charset('utf8');
    $_result = $_mysqli->query("select *from think_data");
    while (!!$_rows = $_result->fetch()){
        print_r($_rows);
    }

?>