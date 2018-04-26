<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
  include_once 'includes/check.func.php';
//  require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', myblog_photo_add_img);
  
  session_start();
  
  
  if(!isset($_COOKIE['username'])){
      _location('请登录查看', 'login.php');
  }
  
  //保存图片信息入表
  if(@$_GET['action'] == 'addimg'){
      if(!!$_rows = _fetch_array("select f_uniqid,f_article_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
        
          include_once 'includes/check.func.php';
          //接收数据
          $_clean = array();
          $_clean['name'] = _check_dir_name($_POST['name'],2,20);
          $_clean['url'] = _check_photo_url($_POST['url']);
          $_clean['content'] = $_POST['content'];
          $_clean['sid'] = $_POST['sid'];
          
          $_clean = _mysql_string($_clean);
          
          //写入数据库
          _query("insert into f_photo(f_name,f_url,f_content,f_sid,f_username,f_date) values('{$_clean['name']}','{$_clean['url']}','{$_clean['content']}','{$_clean['sid']}','{$_COOKIE['username']}',NOW())");
          
              if(_affected_rows() == 1){
                  //数据库关闭函数
                  _close();
                  //清空，不让服务器负担过重
                  //_session_destroy();
                  //跳转到首页
                  _location('图片添加成功', 'myblog_photo_show.php?id='.$_clean['sid']);
              }else{
                  //数据库关闭函数
                  _close();
                  //清空，不让服务器负担过重
                  //_session_destroy();
                  //跳转到首页
                  _alert_back("图片添加失败");
              }
              
      }else{
          _alert_back('非法登录');
      }
  }
  
  //取值
  if(@isset($_GET['id'])){
      if(!!$_rows = _fetch_array("select f_id,f_dir from f_dir where f_id='{$_GET['id']}' limit 1")){
          $_html = array();
          $_html['id'] = $_rows['f_id'];
          $_html['dir'] = $_rows['f_dir'];
  
          $_html = _html($_html);
      }else{
          _alert_back('不存在此相册目录');
      }
  }else{
      _alert_back('非法操作');  //ID不存在
  }
  
  //管理员才能添加
  //_manage_login();
  
  //判断是否正常登陆
  global $_pagesize,$_pagenum,$_page;
  _page("select f_reid from f_article where f_reid!=0 and f_username='{$_COOKIE['username']}'",8);
  

      $_auto = _fetch_array("select f_autograph from f_user where f_username='{$_COOKIE['username']}'");
      $_htmlauto['auto'] = $_auto['f_autograph'];

      
      
    
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

<?php include_once 'includes/myblog_inc.php';?>

<div class="user1">
<h><span> 上 传 图 片 </span><?php echo @$_COOKIE['username']?> &nbsp&nbsp|&nbsp&nbsp <?php echo $_htmlauto['auto']?></h>
</div>

<div id="middle">
<form method="post" action="?action=addimg">
<input type="hidden" name="sid" value="<?php echo $_html['id']?>" />
<dl>
    <dd>图片名称:<input type="text" name="name" class="text" /></dd>
    <dd>图片地址:<input type="text" name="url" id="url" readonly="readonly" class="text" />
    <pre>
    </pre>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="javascript:;" title="<?php echo $_html['dir']?>" id="up">【上传】 </a></dd><br>
    <dd>图片描述:<pre>
    </pre><textarea name="content"></textarea></dd>
    <dd><input type="submit" value="添加图片" class="submit" /></dd>
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
