<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
  include_once 'includes/check.func.php';
//  require 'includes/func.inc.php';
 // header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', thumb);
  
  session_start();
  
  
  if(!isset($_COOKIE['username'])){
      _location('请登录查看', 'login.php');
  }
  
  //缩略图
  //生成png表头文件
  header('Content-type: image/x-png');
    
  $_n = explode(',', 'photo/1473406801/1473412605.png');
  
  //获取文件的长和高
  list($_width,$_height) = getimagesize('photo/1473406801/1473412605.png');
  
  
  //生成微缩长度
  $_new_width = $_width * 0.3;
  $_new_height = $_height * 0.3;
  
  //创建一个以0.3百分比的新长度画布
  
  $_new_image = imagecreatetruecolor($_new_width, $_new_height);
  
  switch (($_n[1])){
      case 'jpg':$_image = imagecreatefromjpeg('photo/1473406801/1473412605.png');
      break;
      case 'png':$_image = imagecreatefrompng('photo/1473406801/1473412605.png');
      break;
      case 'gif':$_image = imagecreatefromgif('photo/1473406801/1473412605.png');
      break;
  }
  
  //按照已有的图片创建一个画布
  $_image = imagecreatefromjpeg('photo/1473406801/1473412605.png');
  
  //将原图采集后重新复制到新涂上，就缩略了;
  imagecopyresampled($_new_image, $_image, 0,0,0,0,$_new_width,$_new_height,$_width,$_height);
      
  imagejpeg($_new_image);
  
  //销毁新图和原图
  imagedestroy($_new_image);
  imagedestroy($_image);
  
?>


<!DOCTYPE html>
<html>
<head>
<title>个人博客</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/myblog.css" />

<script type="text/javascript" src="JS/myblog_photo_add_img.js"></script>

</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>







</body>
</html>


<?php 
    include_once 'includes/footer.inc.php';
?>
