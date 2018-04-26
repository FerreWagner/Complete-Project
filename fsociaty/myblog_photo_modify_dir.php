<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
  include_once 'includes/check.func.php';
//  require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', myblog_photo_modify_dir);
  
  session_start();
  
  
  if(!isset($_COOKIE['username'])){
      _location('请登录查看', 'login.php');
  }
  
  //管理员才能添加
  _manage_login();
  
  //修改
  if(@$_GET['action'] == 'modify'){
      if(!!$_rows = _fetch_array("select f_uniqid,f_article_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
        
        //接收数据
        include_once 'includes/check.func.php';
        $_clean = array();
        $_clean['id'] = $_POST['id'];
                $_clean['name'] = _check_dir_name($_POST['name'],1,20);
                $_clean['type'] = $_POST['type'];
                if(!empty($_clean['type'])){
                    $_clean['password'] = _check_dir_password(sha1($_POST['password']),2);
                }
                
                $_clean['face'] = $_POST['face'];
                $_clean['content'] = $_POST['content'];
                $_clean = _mysql_string($_clean);
          //修改目录
          if(empty($_clean['type'])){
              _query("update f_dir set f_name='{$_clean['name']}',f_type='{$_clean['type']}',f_password=NULL,f_face='{$_clean['face']}',f_content='{$_clean['content']}' where f_id='{$_clean['id']}' limit 1");
            
          
          }else{
              _query("update f_dir set f_name='{$_clean['name']}',f_type='{$_clean['type']}',f_password='{$_clean['password']}',f_face='{$_clean['face']}',f_content='{$_clean['content']}' where f_id='{$_clean['id']}' limit 1");
          }
          //目录添加成功
          if(_affected_rows() == 1){
              //数据库关闭函数
              _close();
              //跳转到首页
              _location('目录修改成功', 'myblog_photo.php');
          }else{
              //数据库关闭函数
              _close();
              //跳转到首页
              _alert_back('目录修改失败');
          }
                
      }else{
          _alert_back('非法登录');
      }
  }
  
if(isset($_GET['id'])){
    if(!!$_rows = _fetch_array("select f_id,f_dir,f_name,f_type,f_face,f_content from f_dir where f_id='{$_GET['id']}' limit 1")){
        $_html = array();
        $_html['id'] = $_rows['f_id'];
        $_html['name'] = $_rows['f_name'];
        $_html['type'] = $_rows['f_type'];
        $_html['face'] = $_rows['f_face'];
        $_html['content'] = $_rows['f_content'];
        
    }else{
        _alert_back('不存在此相册');
    }
}else{
    _alert_back('非法操作');
}
?>


<!DOCTYPE html>
<html>
<head>
<title>个人博客</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/myblog.css" />

<script type="text/javascript" src="JS/photo_add_dir.js"></script>

</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<?php include_once 'includes/myblog_inc.php';?>

<div class="user1">
<h><span> 修 改 相 册 </span><?php echo @$_COOKIE['username']?> &nbsp&nbsp|&nbsp&nbsp <?php echo @$_htmlauto['auto']?></h>
</div>

<div id="middle">
<form method="post" action="?action=modify">

<dl>
    <dd>相册名称&nbsp&nbsp : &nbsp<input type="text" name="name" class="text" value="<?php echo $_html['name']?>" /></dd>
    <dd>相册类型&nbsp&nbsp :&nbsp <input type="radio" name="type" value="0" <?php if($_html['type'] == 0){echo 'checked="checked"';}?> />&nbsp 公开 &nbsp&nbsp&nbsp&nbsp<input type="radio" name="type" value="1" <?php if($_html['type'] == 1){echo 'checked="checked"';}?> />&nbsp 私密 </dd>
    <dd id="pass" <?php if($_html['type'] == 1){echo 'style="display:block"';}?>>相册密码&nbsp&nbsp :&nbsp <input type="password" name="password" class="text" /> (Tips : 不填写则为空 ) </dd>
    <dd>相册封面&nbsp&nbsp : &nbsp<input type="text" name="face" class="text" value="<?php echo @$_html['face']?>" /></dd>( Tips : *粘贴网络地址即可 )
    <dd>相册描述&nbsp&nbsp : <pre>
    </pre><textarea name="content"><?php echo $_html['content']?></textarea></dd>
    <dd><input type="submit" value="修改目录" class="submit" /></dd>
</dl>
<input type="hidden" value="<?php echo $_html['id']?>" name="id" />
</form>
     <?php _paging(2);?>
      <br><br><br><br>    

</div>





<br><br><br><br>
</body>
</html>


<?php 
    include_once 'includes/footer.inc.php';
?>
