<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  
  $_skinurl = $_SERVER["HTTP_REFERER"];
  
  //必须从上一页点过来，而且必须有ID
  if(empty($_skinurl) || !isset($_GET['id'])){
      _alert_back('非法操作');
  }else{
      
      //最好判断一下id必须是1、2、3中的一个
      //生成一个COOKIE用来保存皮肤的种类
      setcookie('skin',$_GET['id']);
      _location(null, $_skinurl);
  }  
  
  
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


</body>
</html>
