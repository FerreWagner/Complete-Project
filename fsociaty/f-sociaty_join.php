<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  
 
  
  //将帖子写入数据库
  if(@$_GET['action'] == 'join'){
      
      if(!isset($_COOKIE['username'])){
          _location('请先登录', 'login.php');
      }
      
      if(!!$_rows = _fetch_array("select f_uniqid,f_post_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
  
  
          include 'includes/check.func.php';
          //接收帖子内容
          $_clean = array();
          $_clean['username'] = $_COOKIE['username'];
          $_clean['join'] = @$_POST['join'];
          
          $_clean = _mysql_string($_clean);
          //写入数据库
          _query("insert into
              f_other(f_username,f_join,f_date)
              values
              ('{$_clean['username']}',
              '{$_clean['join']}',
              NOW())");
          if(_affected_rows() == 1){
  
              //数据库关闭函数
              _close();
              //清空，不让服务器负担过重
              //_session_destroy();
              //跳转到首页
              _location('提交成功', 'index.php');
          }else{
              //数据库关闭函数
              _close();
              //清空，不让服务器负担过重
              // _session_destroy();
              //跳转到首页
              _alert_back('提交失败');
          }
      }
  }
  
  
  
  
  
?>
  
  
  
  
<!DOCTYPE html>
<html>
<head>
<title>F-sociaty</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/f-sociaty.css" />
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<h2>Join Us_开发组人员 : Ferre</h2>
<h3>请发送邮件至1573646491@qq.com或在此留言 : </h3>




<div class="here1">
&nbsp&nbsp&nbsp&nbsp  <form action="?action=join" method="post">
                <textarea name="join" rows="20" cols="120"></textarea>
                <p>
                <input type="submit" name="sub" value="提交" />
            </form>
</div>



</body>
</html>