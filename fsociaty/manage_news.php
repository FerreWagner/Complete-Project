<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
  //require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  
  session_start();
  
  //必须是管理才能登陆的判断
  _manage_login();
  
  
  if(@$_GET['action'] == 'delete'){
      if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
          $_clean = array();
//           $_clean['webname'] = $_POST['webname'];   //此处为input的name传值处理
//           $_clean['article'] = $_POST['article'];
          _query("delete from f_news where id='{$_GET['id']}'");
//           $_clean = _mysql_string($_clean);
          
          //判断是否修改成功
          if(_affected_rows() == 1){     //被影响的行数为1
              //数据库关闭函数
              _close();
              //清空，不让服务器负担过重
              // _session_destroy();
              //跳转到首页
              _location('资料修改成功', 'manage_set.php');
          }else{                         //被影响的行数为0，即没有修改资料
              //数据库关闭函数
              _close();
              //清空，不让服务器负担过重
              //_session_destroy();
              //跳转到首页
              _location('没有任何数据被修改', 'manage_set.php');
          }
           
      }else{
          _alert_back('异常,用户不存在');
      }
  }
  


  
?>


<!DOCTYPE html>
<html>
<head>
<title>后台管理中心</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/member.css" />
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>
<p align=center>
<a href=member.php><h14><?php echo $_COOKIE['username']?> 新闻管理</h14></a>
</p>
<div id="member">
    <?php 
        require 'includes/manage.inc.php';
    ?>
    <div id="member_main">
        <h2><a href="manage_set_insert.php">添加新闻</a></h2>
        <form action="?action=news" method="post">
        <table width="100%" border=1>
        <tr>
        <th>id</th>
        <th>user</th>
        <th>sort</th>
        <th>title</th>
        <th>content</th>
        <th>time</th>
        <th>img</th>
        </tr>
        <?php
            $_data = mysql_query("select *from f_news");
            while (!!$_rowss = mysql_fetch_array($_data)){
        ?>
        <tr>
            <td><?php echo $_rowss['id']?></td>
            <td><?php echo $_rowss['user']?></td>
            <td><?php echo $_rowss['sort']?></td>
            <td><?php echo $_rowss['title']?></td>
            <td><?php echo substr($_rowss['content'],0,10)?></td>
            <td><?php echo $_rowss['time']?></td>
            <td><?php echo $_rowss['img']?></td>
            <td><a href='manage_set_update.php?id=<?php echo $_rowss['id']?>'>修改</a> | <a href="manage_news?action=delete&id=<?php echo $_rowss['id']?>">删除</a></td>
            
        </tr>
        <?php 
            }
        ?>
        </table>
        </form>
    </div>

</div>
</body>
</html>







<?php 
    require("includes/footer1.inc.php");

?>
