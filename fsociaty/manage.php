<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  
  session_start();
  
  //必须是管理才能登陆的判断
  _manage_login();
  
?>


<!DOCTYPE html>
<html>
<head>
<title>后台管理中心</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/member.css" />
</head>
<body style=margin:0;background-color:#180c0c;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>
<p align=center>
<a href=manage.php><h14><?php echo $_COOKIE['username']?> 后台管理</h14></a>
</p>
<div id="member">
    <?php 
        require 'includes/manage.inc.php';
    ?>
    <div id="member_main">
        <h2>后台管理中心</h2>
        <dl>
            <dd> • 服 务 器 主 机 名 称  : <?php echo $_SERVER["SERVER_NAME"];?></dd>
            <dd> • 服 务 器 版 本  : <?php var_dump($_ENV)?></dd>
            <dd> • 通 信 协 议 名 称 / 版 本 : <?php echo $_SERVER["SERVER_PROTOCOL"]?></dd>
            <dd> • 服 务 器 I P : <?php echo $_SERVER["SERVER_ADDR"]?></dd>
            <dd> • 客 户 端 I P : <?php echo $_SERVER["REMOTE_ADDR"]?></dd>
            <dd> • 服 务 器 端 口 : <?php echo $_SERVER["SERVER_PORT"]?></dd>
            <dd> • 客 户 端 端 口 : <?php echo $_SERVER["REMOTE_PORT"]?></dd>
            <dd> • 管 理 员 邮 箱 : <?php echo $_SERVER["SERVER_ADMIN"]?></dd>
            <dd> • Host 头 部 的 内 容 : <?php echo $_SERVER["HTTP_HOST"]?></dd>
            <dd> • 服 务 器 主 目 录 : <?php echo $_SERVER["DOCUMENT_ROOT"]?></dd>
            <dd> • 服 务 器 系 统 盘 : <?php echo @$_ENV["SystemRoot"]?></dd>
            <dd> • 脚 本 执 行 的 绝 对 路 径 : <?php echo $_SERVER["SCRIPT_FILENAME"]?></dd>
            <dd> • Apache 及 PHP 版 本 : <?php echo $_SERVER["SERVER_SOFTWARE"]?></dd>
            
        </dl>
    </div>

</div>
</body>
</html>







<?php 
    require("includes/footer1.inc.php");

?>
