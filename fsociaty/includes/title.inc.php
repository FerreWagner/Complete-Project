<?php
if(!defined('chang')){      //非法调用相关
    exit('非法调用');
}
    //下面报错由于includes文件里没有那两个CSS文件，而在调用后文件的同目录CSS文件夹里
//防止非HTML调用
if(!defined('SCRIPT')){
    exit('Script Error');   //可删去
}

?>

<link rel="stylesheet"type="text/css"href="css/<?php echo SCRIPT?>.css" />        
<link rel="stylesheet"type="text/css"href="../css/head.css" />
