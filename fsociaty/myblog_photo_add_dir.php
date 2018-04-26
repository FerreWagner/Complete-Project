<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
  include_once 'includes/check.func.php';
//  require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', myblog_photo_add_dir);
  
  session_start();
  
  
  if(!isset($_COOKIE['username'])){
      _location('请登录查看', 'login.php');
  }
  
  //管理员才能添加
  _manage_login();
  
  //判断是否正常登陆
  global $_pagesize,$_pagenum,$_page;
  _page("select f_reid from f_article where f_reid!=0 and f_username='{$_COOKIE['username']}'",8);
  

      $_auto = _fetch_array("select f_autograph from f_user where f_username='{$_COOKIE['username']}'");
      $_htmlauto['auto'] = $_auto['f_autograph'];

      
      
      //添加目录
      if(@$_GET['action'] == 'adddir'){

              if(!!$_rows = _fetch_array("select f_uniqid,f_post_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
                  //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
                  _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
                
                //接收数据
                $_clean = array();
                $_clean['name'] = _check_dir_name($_POST['name'],1,20);
                $_clean['type'] = $_POST['type'];
                if(!empty($_clean['type'])){
                    $_clean['password'] = _check_dir_password(sha1($_POST['password']),2);
                }
                
                
                $_clean['content'] = $_POST['content'];
                $_clean['dir'] = time();
                $_clean = _mysql_string($_clean);
                
                //先检查一下主目录是否存在
                if(!is_dir('photo')){
                    @mkdir('photo',0777);   //最高权限创建目录
                }
                //再在这个主目录里创建你定义的相册目录
                if(!is_dir('photo/'.$_clean['dir'])){
                    @mkdir('photo/'.$_clean['dir']);
                }
                
                //把当前的目录信息写入数据库即可
                if(empty($_clean['type'])){
                    _query("insert into f_dir(f_name,f_type,f_content,f_dir,f_date) values('{$_clean['name']}','{$_clean['type']}','{$_clean['content']}','photo/{$_clean['dir']}',NOW())");
                }else{
                    _query("insert into f_dir(f_name,f_type,f_content,f_dir,f_date,f_password) values('{$_clean['name']}','{$_clean['type']}','{$_clean['content']}','photo/{$_clean['dir']}',NOW(),'{$_clean['password']}')");
                }
                
                //目录添加成功
                if(_affected_rows() == 1){
                    //数据库关闭函数
                    _close();
                    //跳转到首页
                    _location('目录添加成功', 'myblog_photo.php');
                }else{
                    //数据库关闭函数
                    _close();
                    //跳转到首页
                    _alert_back('目录添加失败');
                }
                
              }else{
                  _alert_back('非法登录');
              }
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
<h><span> 添 加 </span><?php echo @$_COOKIE['username']?> &nbsp&nbsp|&nbsp&nbsp <?php echo $_htmlauto['auto']?></h>
</div>

<div id="middle">
<form method="post" action="?action=adddir">
<dl>
    <dd>相册名称&nbsp&nbsp : &nbsp<input type="text" name="name" class="text" /></dd>
    <dd>相册类型&nbsp&nbsp :&nbsp <input type="radio" name="type" value="0" checked="checked" />&nbsp 公开 &nbsp&nbsp&nbsp&nbsp<input type="radio" name="type" value="1" />&nbsp 私密 </dd>
    <dd id="pass">相册密码&nbsp&nbsp :&nbsp <input type="password" name="password" class="text" /></dd>
    <dd>相册描述&nbsp&nbsp : <pre>
    </pre><textarea name="content"></textarea></dd>
    <dd><input type="submit" value="添加目录" class="submit" /></dd>
</dl>
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
