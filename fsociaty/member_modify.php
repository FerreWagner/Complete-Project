<?php
  session_start();      //需要验证码时需要开启session
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  
  //在获取数据前修改资料
  if(@$_GET['action'] == 'modify'){
     _check_code($_POST['code'], $_SESSION['code']);
   if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
        //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
       _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
     include 'includes/check.func.php';
     $_clean = array();
     $_clean['password'] = _check_modify_password($_POST['password'], 6);
     $_clean['sex'] = _check_sex($_POST['sex']);
     $_clean['email'] = _check_email($_POST['email'],6,40);
     $_clean['QQ'] = _check_qq($_POST['QQ']);
     $_clean['url'] = _check_url($_POST['url'],100);
     $_clean['switch'] = $_POST['switch'];
     $_clean['autograph'] = _check_autograph_content($_POST['autograph'],200);
     
     //修改资料
     //判断密码是否为空的情况
     if(empty($_clean['password'])){
         _query("update f_user set
             f_sex='{$_clean['sex']}',
             f_email='{$_clean['email']}',
             f_qq='{$_clean['QQ']}',
             f_url='{$_clean['url']}',
             f_switch='{$_clean['switch']}',
             f_autograph='{$_clean['autograph']}'
             where
             f_username='{$_COOKIE['username']}'
             ");
     }else{
         _query("update f_user set 
                                    f_password='{$_clean['password']}',
                                    f_sex='{$_clean['sex']}',
                                    f_email='{$_clean['email']}',
                                    f_qq='{$_clean['qq']}',
                                    f_url='{$_clean['url']}',
                                    f_switch='{$_clean['switch']}',
                                    f_autograph='{$_clean['autograph']}'
                                where
                                    f_username='{$_COOKIE['username']}'
                                    ");
     }
 }
     //判断是否修改成功
     if(_affected_rows() == 1){     //被影响的行数为1
         //数据库关闭函数
         _close();
         //清空，不让服务器负担过重
        // _session_destroy();
         //跳转到首页
         _location('资料修改成功', 'member.php');
     }else{                         //被影响的行数为0，即没有修改资料
         //数据库关闭函数
         _close();
         //清空，不让服务器负担过重
         //_session_destroy();
         //跳转到首页
         _location('没有任何数据被修改', 'member_modify.php');
     }
     
  }
  
  //判断是否正常登陆
  if(isset($_COOKIE['username'])){
      //获取数据
      $_rows = _fetch_array("select f_switch,f_autograph,f_username,f_sex,f_email,f_url,f_qq from f_user where f_username = '{$_COOKIE['username']}'");
      //判断是否有$_rows数据，来防止假冒COOKIE
      if($_rows){
          $_html = array(); //此数组为专门显示在网页上的数组
          $_html['username'] = $_rows['f_username'];
          $_html['sex'] = $_rows['f_sex'];
          $_html['email'] = $_rows['f_email'];
          $_html['url'] = $_rows['f_url'];
          $_html['QQ'] = $_rows['f_qq'];
          $_html['switch'] = $_rows['f_switch'];
          $_html['autograph'] = $_rows['f_autograph'];
          $_html = _html($_html);        //以数组的方式来过滤
          
          //性别选择
          if($_html['sex'] =='男'){
              $_html['sex_html'] = '<input type="radio" name="sex" value="男" checked="checked" />男<input type="radio" name="sex" value="女" />女';
          }elseif($_html['sex'] =='女'){
              $_html['sex_html'] = '<input type="radio" name="sex" value="男" />男<input type="radio" name="sex" value="女" checked="checked" />女';
          }
          
          //签名开关
          if($_html['switch'] == 1){
              $_html['switch_html'] = '<input type="radio" name="switch" value="1" checked="checked" /> 启用 <input type="radio" name="switch" value="0" /> 禁用';
          }elseif($_html['switch'] == 0){
              $_html['switch_html'] = '<input type="radio" name="switch" value="1" /> 启用 <input type="radio" name="switch" value="0" checked="checked" /> 禁用';
          }
          
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

<script type="text/javascript" src="JS/member_modify.js"></script>

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
        <h2>修改资料</h2>
        <form name="modify" method="post" action="?action=modify">
        <dl>
            <dd>用 &nbsp户 &nbsp名：<?php echo $_html['username']?></dd>
            <dd>密&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  码：<input type="password" name="password" /> &nbsp&nbsp&nbsp&nbsp(不填写则不修改)</dd>
            <dd>性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  别：<?php echo $_html['sex_html']?></dd>
            <dd>电子邮件：<input type="text" name="email" value="<?php echo $_html['email']?>" /></dd>
            <dd>个人主页：<input type="text" name="url" value="<?php echo $_html['url']?>" /></dd>
            <dd>Q&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Q：<input type="text" name="QQ" value="<?php echo $_html['QQ']?>" /></dd>
            <dd>个性签名：<?php echo $_html['switch_html']?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(TIP : 可使用UBB代码添加图片或视频作为签名)
            <p><textarea name="autograph"><?php echo $_html['autograph']?></textarea></p></dd>
            <dd>验&nbsp 证&nbsp码：<input name=code type=text size=20 maxlength=14> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="code.php" id=code onclick="javascript:this.src='code.php?tm='+Math.random()" /></dd>  <!--此处使用了JS的随机-->
            <dd><input type="submit" class="submit" value="修改资料" /></dd>
        </dl>
        </form>
    </div>

</div>
</body>
</html>


<?php 
    require("includes/footer1.inc.php");
?>
