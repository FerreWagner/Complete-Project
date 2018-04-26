<?php
  define('chang',1990);
//   require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
  //require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  
  session_start();
  
  //必须是管理才能登陆的判断
  _manage_login();
  
  
  if(@$_GET['action'] == 'news'){
      if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
          $_clean = array();
          $_clean['title']    = $_POST['title'];
          $_clean['content']  = $_POST['content'];
          $_clean['sort']     = $_POST['sort'];
          $_clean['user']     = $_COOKIE['username'];
          
          //图片处理
          $file = $_FILES['img'];
          //得到文件名称
          $name = $file['name'];
          $type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
          $allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
          //判断文件类型是否被允许上传
          if(!in_array($type, $allow_type)){
              //如果不被允许，则直接停止程序运行
              return ;
          }
          //判断是否是通过HTTP POST上传的
          if(!is_uploaded_file($file['tmp_name'])){
              //如果不是通过HTTP POST上传的
              return ;
          }
          $upload_path = "new_img/"; //上传文件的存放路径
          //开始移动文件到相应的文件夹
          if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
              $_clean['img'] = $upload_path.$file['name'];
//               echo $_clean['img'];
          }else{
              exit('Failed!');
          }
          
          $_clean = _mysql_string($_clean);
          //写入数据库
          _query("insert into f_news(user,title,content,time,img) values('{$_clean['user']}','{$_clean['title']}','{$_clean['content']}',NOW(),'{$_clean['img']}')");
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
        <form action="?action=news" method="post" enctype="multipart/form-data">
        <dl>
            <dd>新闻标题：<input required="" type="text" name="title"></dd>
            <dd>新闻内容：<textarea rows="30" required="" name="content" cols="80"></textarea></dd>
            <dd>新闻排序：<input required="" type="text" name="sort" value="<?php echo '10'?>"></dd>
            <dd>新闻图片：<input required="" type="file" name="img" accept="image/gif, image/jpeg, image/jpg, image/png"></dd>
            <dd><input type="submit" name="upload" value="上传新闻" /></dd>
        </dl>
        </form>
    </div>

</div>
</body>
</html>







<?php 
    require("includes/footer1.inc.php");

?>
