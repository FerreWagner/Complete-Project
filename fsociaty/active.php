<?php 
    define('chang',1990);
    require("includes/timeheader.php");
    require('includes/mysqlname.inc.php');
    require("includes/connin.inc.php");
    //require("includes/func.inc.php");
    
    //开始激活处理
    if(isset($_GET['action']) && isset($_GET['active']) && $_GET['action'] == 'ok'){
        $_active = _mysql_string($_GET['active']);
       if(_fetch_array("select f_active from f_user where f_active='$_active' limit 1")){
           //将f_active设置为空
           _query("update f_user set f_active=null where f_active='$_active' limit 1");
           if(_affected_rows() == 1){
               _close();
               _location('账户激活成功', 'login.php');
           }else{
               _close();
               _location('账户激活失败', 'register.php');
           }
    }else{
        _alert_back('非法操作');
    }
    } 
?>

<!DOCTYPE html>
<html>
<head>
<title>激活账号</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<style type="text/css">
.rnew{position:absolute;
	top:120px;
	left:0px;
	width:1306px;
	height:60px;
	background:url("pic/images/tabrightC.gif");
	margin:0 0 15px 0;
	background-size:120%;
	border:1px solid silver;
}
.bomid{
	position:absolute;
	top:340px;
	height:400px;
	width:1306px;
	border:1px solid green;
}
</style>
</head>
<body style=background-color:#D2E9FF;margin:0;padding:0>
<iframe width=204px height=60px marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>



<div class=rnew align=center>
	<h3>用户激活</h3>
</div>
   
<div class=bomid align=center>
    <h3>点击此超链接，激活您的账户</h3>
    <p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"><?php echo'http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]?>active.php?action=ok&amp;active=<?php echo $_GET['active']?></a></p>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php 
        require 'includes/footer.inc.php';
    ?>
    
</div> 
   
  
    

</body>
</html>