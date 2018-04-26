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
  
  
  if(@$_GET['action'] == 'set'){
      if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
          $_clean = array();
          $_clean['webname'] = $_POST['webname'];   //此处为input的name传值处理
          $_clean['article'] = $_POST['article'];
          $_clean['blog'] = $_POST['blog'];
          $_clean['photo'] = $_POST['photo'];
          $_clean['skin'] = $_POST['skin'];
          $_clean['string'] = $_POST['string'];
          $_clean['post'] = $_POST['post'];
          $_clean['re'] = $_POST['re'];
          $_clean['code'] = $_POST['code'];
          $_clean['register'] = $_POST['register'];
          $_clean = _mysql_string($_clean);
          
          //写入数据库
          _query("update f_system set f_webname='{$_clean['webname']}',f_article='{$_clean['article']}',f_blog='{$_clean['blog']}',f_photo='{$_clean['photo']}',f_skin='{$_clean['skin']}',f_string='{$_clean['string']}',f_post='{$_clean['post']}',f_re='{$_clean['re']}',f_code='{$_clean['code']}',f_register='{$_clean['register']}'where f_id=1 limit 1");;
         
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
  
  //读取系统表
  if(!!$_rows = _fetch_array("select f_webname,f_article,f_blog,f_photo,f_skin,f_string,f_post,f_re,f_code,f_register from f_system where f_id=1 limit 1")){
      $_html = array();
      $_html['webname'] = $_rows['f_webname'];
      $_html['article'] = $_rows['f_article'];
      $_html['blog'] = $_rows['f_blog'];
      $_html['photo'] = $_rows['f_photo'];
      $_html['string'] = $_rows['f_string'];
      $_html['skin'] = $_rows['f_skin'];
      $_html['post'] = $_rows['f_post'];
      $_html['re'] = $_rows['f_re'];
      $_html['code'] = $_rows['f_code'];
      $_html['register'] = $_rows['f_register'];
      
      $_html = _html($_html);
      //文章
      
              if($_html['article'] == 10){
                  $_html['article_html'] = '<select name="article"><option value="10" selected="selected">每页10篇文章</option><option value="15">每页15篇文章</option></select>';
              }elseif($_html['article'] == 15) {
                  $_html['article_html'] = '<select name="article"><option value="10">每页10篇文章</option><option value="15" selected="selected">每页15篇文章</option></select>';
              }
              
       //博友

              
              if($_html['blog'] == 15){
                  $_html['blog_html'] = '<select name="blog"><option value="15" selected="selected">每 页 15 人</option><option value="20">每 页 20 人</option></select>';
              }elseif($_html['blog'] == 20) {
                  $_html['blog_html'] = '<select name="blog"><option value="15">每 页 15 人</option><option value="20" selected="selected">每 页 20 人</option></select>';
              }
              
        //相册

      if($_html['photo'] == 8){
           $_html['photo_html'] = '<select name="photo"><option value="8" selected="selected">每 页 8 张</option><option value="12">每 页 12 张</option></select>';
         }elseif($_html['photo'] == 12) {
           $_html['photo_html'] = '<select name="photo"><option value="8">每 页 8 张</option><option value="12" selected="selected">每 页 12 张</option></select>';
         }
           
         
         //站点默认皮肤
         
         if($_html['skin'] == 1){
             $_html['skin_html'] = '<select name="skin"><option value="1" selected="selected">1 号 皮 肤</option><option value="2">2 号 皮 肤</option><option value="3">3 号 皮 肤</option></select>';
         }elseif($_html['skin'] == 2) {
             $_html['skin_html'] = '<select name="skin"><option value="1">1 号 皮 肤</option><option value="2" selected="selected">2 号 皮 肤</option><option value="3">3 号 皮 肤</option></select>';
         }elseif($_html['skin'] == 3) {
             $_html['skin_html'] = '<select name="skin"><option value="1">1 号 皮 肤</option><option value="2">2 号 皮 肤</option><option value="3" selected="selected">3 号 皮 肤</option></select>';
         }
         
         //每次发帖限制
         if($_html['post'] == 16){
             $_html['post_html'] = '<input type="radio" name="post" value="16" checked="checked" /> 15s <input type="radio" name="post" value="31" /> 30s <input type="radio" name="post" value="61" /> 1min <input type="radio" name="post" value="181" /> 3min ';
         }elseif($_html['post'] == 31){
             $_html['post_html'] = '<input type="radio" name="post" value="16" /> 15s <input type="radio" name="post" value="31" checked="checked" /> 30s <input type="radio" name="post" value="61" /> 1min <input type="radio" name="post" value="181" /> 3min ';
         }elseif ($_html['post'] == 61){
             $_html['post_html'] = '<input type="radio" name="post" value="16" /> 15s <input type="radio" name="post" value="31" /> 30s <input type="radio" name="post" value="61"  checked="checked" /> 1min <input type="radio" name="post" value="181" /> 3min ';
         }elseif ($_html['post'] == 181){
             $_html['post_html'] = '<input type="radio" name="post" value="16" /> 15s <input type="radio" name="post" value="31" /> 30s <input type="radio" name="post" value="61" /> 1min <input type="radio" name="post" value="181"  checked="checked" /> 3min ';
         }
         
         //回帖
         if($_html['re'] == 16){
             $_html['re_html'] = '<input type="radio" name="re" value="16" checked="checked" /> 15s <input type="radio" name="re" value="31" /> 30s <input type="radio" name="re" value="41" /> 40s ';
         }elseif($_html['re'] == 31){
             $_html['re_html'] = '<input type="radio" name="re" value="16" /> 15s <input type="radio" name="re" value="31" checked="checked" /> 30s <input type="radio" name="re" value="41" /> 40s ';
         }elseif ($_html['re'] == 41){
             $_html['re_html'] = '<input type="radio" name="re" value="16" /> 15s <input type="radio" name="re" value="31" /> 30s <input type="radio" name="re" value="41"  checked="checked" /> 40s ';
         }
         
         //是否启用验证码
         if($_html['code'] == 1){
             $_html['code_html'] = '<input type="radio" name="code" value="1" checked="checked" /> 启 用 <input type="radio" name="code" value="0" /> 禁用 ';
         }else{
             $_html['code_html'] = '<input type="radio" name="code" value="1" /> 启 用 <input type="radio" name="code" value="0" checked="checked" /> 禁用 ';
         }
         
         //是否允许开放注册
         if($_html['register'] == 1){
             $_html['register_html'] = '<input type="radio" name="register" value="1" checked="checked" /> 启 用 <input type="radio" name="register" value="0" /> 禁用 ';
         }else{
             $_html['register_html'] = '<input type="radio" name="register" value="1" /> 启 用 <input type="radio" name="register" value="0" checked="checked" /> 禁用 ';
         }
         
              
  }else {
      _alert_back('系统表异常，请与我们联系');
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
<a href=member.php><h14><?php echo $_COOKIE['username']?> 后台管理</h14></a>
</p>
<div id="member">
    <?php 
        require 'includes/manage.inc.php';
    ?>
    <div id="member_main">
        <h2>后台管理中心</h2>
        <form action="?action=set" method="post">
        <dl>
            <dd> • 网 站 名 称 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <input type="text" class="text" name="webname" value="<?php echo $_html['webname']?>"> </dd>
            <dd> • 文 章 每 页 列 表 数 : <?php echo $_html['article_html']?></dd>
            <dd> • 博 客 每 页 列 表 数 : <?php echo $_html['blog_html']?></dd>
            <dd> • 相 册 每 页 列 表 数 : <?php echo $_html['photo_html']?></dd>
            <dd> • 站 点 默 认 皮 肤 &nbsp&nbsp&nbsp&nbsp: <?php echo $_html['skin_html']?></dd>
            <dd> • 非 法 字 符 过 滤 : &nbsp&nbsp&nbsp&nbsp<input type="text" name="string" class="text" value=" <?php echo $_html['string']?>"> ( * 请 用 | 隔 开 ) </dd>
            <dd> • 发 帖 时 间 限 制 : <?php echo $_html['post_html']?></dd>
            <dd> • 回 帖 时 间 限 制 : <?php echo $_html['re_html']?></dd>
            <dd> • 开 启 验 证 码 选 项 : <?php echo $_html['code_html']?></dd>
            <dd> • 开 启 用 户 注 册 选 项 : <?php echo $_html['register_html']?></dd>
            <dd> • <input type="submit" value="修改设置" class="submit" /></dd>
        </dl>
        </form>
    </div>

</div>
</body>
</html>







<?php 
    require("includes/footer1.inc.php");

?>
