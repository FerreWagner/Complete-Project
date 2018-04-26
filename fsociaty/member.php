<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  
  session_start();
  
  //判断是否正常登陆
  if(isset($_COOKIE['username'])){
      //获取数据
      $_rows = _fetch_array("select f_username,f_sex,f_email,f_url,f_qq,f_level,f_reg_time from f_user where f_username = '{$_COOKIE['username']}' limit 1");
      //判断是否有$_rows数据，来防止假冒COOKIE
      if($_rows){
          $_html = array(); //此数组为专门显示在网页上的数组
          $_html['username'] = $_rows['f_username'];
          $_html['sex'] = $_rows['f_sex'];
          $_html['email'] = $_rows['f_email'];
          $_html['url'] = $_rows['f_url'];
          $_html['qq'] = $_rows['f_qq'];
          $_html['reg_time'] = $_rows['f_reg_time'];
          switch($_rows['f_level']){
              case 0:
                  $_html['level'] = 'User';
                  break;
              case 1:
                  $_html['level'] = 'Admin';
                  break;
              default:
                  $_html['level'] = 'Wrong';
          }
          $_html = _html($_html);        //以数组的方式来过滤
      }else{
          _alert_back('此用户不存在');
      }
  }else{
      _alert_back('非法登录');
  }
  
?>


<!DOCTYPE html>
<html>
<head>
<title>个人中心</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/member.css" />
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>
<p align=center>
<a href=member.php><h14><?php echo $_COOKIE['username']?>的个人中心</h14></a>
</p>
<div id="member">
    <?php 
        require 'includes/member.inc.php';
    ?>
    <div id="member_main">
        <h2>个人信息</h2>
        <dl>
            <dd>用 &nbsp户 &nbsp名：<?php echo $_html['username']?></dd>
            <dd>性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  别：<?php echo $_html['sex']?></dd>
            <dd>电子邮件：<?php echo $_html['email']?></dd>
            <dd>个人主页：<?php echo $_html['url']?></dd>
            <dd>Q&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Q：<?php echo $_html['qq']?></dd>
            <dd>注册时间：<?php echo $_html['reg_time']?></dd>
            <dd>身&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 份：<?php echo $_html['level']?></dd>
        </dl>
    </div>

</div>
</body>
</html>







<?php 
    require("includes/footer1.inc.php");

?>
