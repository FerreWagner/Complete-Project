<?php
    define('chang',1990);
  //  require('includes/func.inc.php');
    require('includes/mysqlname.inc.php');
    
    global $_system;
    
    session_start();
    
    //登录状态的判断
    _login_state();
    
    if(@$_POST['action'] == 'register'){
      //防止恶意调用和跨站攻击
      if(empty($_system['register'])){
          echo '<br><br><br><br>';
          echo '<h3 style=text-align:center>程序员哥哥正在测试中，本站暂时关闭注册功能，敬请谅解~</h3>';
      }
      
          if(function_exists('_alert_back')){
           
          }else{
                exit('_alert_back函数不存在，请检查');
            }
    
    //验证码函数判断
    @_check_code($_POST['code'],$_SESSION['code']);
                                                               //    接收username,$_POST['username']是受污染数据(即外部不可信数据)
                                                               //    $_username = @$_POST['username'];
                                                               //    echo $_username;
    //引入验证文件
    include 'includes/check.func.php';
    
    //创建一个空数组，用来存放提交过来的合法数据
    $_clean = array();
    //1、可以通过唯一标识符来防止恶意注册和跨站攻击
    //2、存放入数据库的唯一标识符第二个用途：登陆的cookie验证
    $_clean['uniqid'] = _check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
    //active也是一个唯一标识符，用来刚注册的用户进行激活处理，方可登录
    $_clean['active'] = _sha1_uniqid();
    $_clean['username'] = _check_username($_POST['username'],2,12);
    $_clean['password'] = _check_password($_POST['password'],$_POST['notpassword'],2);
    $_clean['question'] = _check_question($_POST['question'],4,20);
    $_clean['answer'] = _check_answer($_POST['question'], $_POST['answer'],4,20);
    $_clean['sex'] = _check_sex($_POST['sex']);
    $_clean['email'] = _check_email($_POST['email'],6,40);
    $_clean['QQ'] = _check_qq($_POST['QQ']);
    $_clean['url'] = _check_url($_POST['url'],100);
    
    //在新增前，要判断用户名是否重复,已经被包在mysql.func.php函数库中
    //表示找到一条重复的就不允许
    _is_repeat(
        "select f_username from f_user where f_username = '{$_clean['username']}' limit 1",
        '此用户已被注册');
    
    
    //新增用户
    //双引号里可以直接放变量，如：$_username;数组变量的话，必须加上大括号，如：{$_clean['username']};
    _query(
                "insert into f_user(
                f_uniqid,
                f_active,
                f_username,
                f_password,
                f_question,
                f_answer,
                f_email,
                f_qq,
                f_url,
                f_sex,
                f_reg_time,
                f_last_time,
                f_last_ip
                ) 
                values(
                '{$_clean['uniqid']}',
                '{$_clean['active']}',
                '{$_clean['username']}',
                '{$_clean['password']}',
                '{$_clean['question']}',
                '{$_clean['answer']}',
                '{$_clean['email']}',
                '{$_clean['QQ']}',
                '{$_clean['url']}',
                '{$_clean['sex']}',
                NOW(),
                NOW(),
                '{$_SERVER['REMOTE_ADDR']}'
                )") or die('数据库执行失败'.mysql_error());
    
    if(_affected_rows() == 1){
        //获取刚刚新增的ID
        $_clean['id'] = _insert_id();
        //数据库关闭函数
        _close();
        //清空，不让服务器负担过重
        _session_destroy();
        //生成XML
        @_set_xml('new.xml', $_clean);
        //跳转到首页
        _location('您已经注册成功', 'active.php?active='.$_clean['active']);
    }else{
        //数据库关闭函数
        _close();
        //清空，不让服务器负担过重
        _session_destroy();
        //跳转到首页
        _location('注册失败', 'register.php');
    }
   }else{
        
    //sha1(uniqid(rand(),true))是唯一标识符，因时间原因，每台计算机都不会产生相同的唯一标识符
    $_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();     //用在服务器上的SESSION来保存这个值
    }    
?>

<!DOCTYPE html>
<html>
<head>
<title>注册</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/create.css" />
<style type=text/css>
.rnew{position:absolute;
	top:120px;
	left:0px;
	width:1324px;
	height:60px;
	background:url("pic/images/tabrightH.gif");
	margin:0 0 15px 0;
	background-size:120%;
	padding:10px 0 0 0;
}

.sub{
	background:#303030; /* 输入框背景颜色*/
	background-size:100%;
	height: 24px; /*输入框高度*/
	width: 60px; /*输入框宽度*/
	padding-top: 4px; /*输入框里的文字和输入框上边之间的距离（因为输入框比较高，输入的字不是居中的，所以设定此样式）*/
	font-family: 微软雅黑; /*输入框文字类型*/
	font-size: 4px; /*输入框内文字大小*/
	padding-left: 2px; /*输入框里的文字和输入框左边之间的距离*/
	cursor:pointer;
}

</style>
</head>


<body style=background-color:#D2E9FF>
<script type="text/javascript" src="JS/register.js"></script>

<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<?php 
	require("includes/connin.inc.php");
	require("includes/timeheader.php");	
	
	
?>

<div class=rnew align=center>
	<h3><a href=register.php>用户注册</a></h3>
	<?php if(!empty($_system['register'])){?>
</div>

<div class=rdi1>
<h>Welcome To F-sociaty</h><br><br>
<h1>&nbsp&nbsp注册F-sociaty不会涉及您的隐私信息(如：邮箱、地址).</h1><br><br><br>
<form action="register.php" method=post>
<input type=hidden name=action value=register />
<input type=hidden name=uniqid value="<?php echo @$_uniqid;?>">

<fieldset>
  <legend><h3>Register</h3></legend><br><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp用&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp户&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：&nbsp&nbsp<input name=username type=text size=20 maxlength=18>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(两位字符以上)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h2><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp密&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp码：&nbsp&nbsp<input name=password type=password size=20 maxlength=16>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(请使用大于2位或小于8位密码)</h2><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp再次输入密码&nbsp&nbsp：&nbsp&nbsp<input name=notpassword type=password size=20 maxlength=8>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(再次输入密码)</h2>		<pre>                                                           </pre>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp密&nbsp&nbsp&nbsp&nbsp码&nbsp&nbsp&nbsp&nbsp提&nbsp&nbsp&nbsp&nbsp示:&nbsp&nbsp<input name=question type=text size=20 maxlength=30></h2><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp密&nbsp&nbsp&nbsp&nbsp码&nbsp&nbsp&nbsp&nbsp回&nbsp&nbsp&nbsp&nbsp答:&nbsp&nbsp<input name=answer type=text size=20 maxlength=30></h2><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp电&nbsp&nbsp&nbsp&nbsp子&nbsp&nbsp&nbsp&nbsp邮&nbsp&nbsp&nbsp&nbsp件:&nbsp&nbsp<input name=email type=text size=20 maxlength=30>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(您 的 邮 箱)</h2><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspQ&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspQ：&nbsp&nbsp&nbsp<input name=QQ type=text size=20 maxlength=16>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h2><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp个&nbsp&nbsp&nbsp&nbsp人&nbsp&nbsp&nbsp&nbsp主&nbsp&nbsp&nbsp&nbsp页:&nbsp&nbsp<input name=url type=text size=20 maxlength=30></h2><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp别：&nbsp&nbsp<input type=radio name=sex value="男" checked="checked" />男<input type=radio name=sex value="女" />女</h2><br>
<!--<h2>&nbsp&nbsp&nbsp&nbsp&nbsp选&nbsp&nbsp&nbsp&nbsp择&nbsp&nbsp&nbsp&nbsp头&nbsp&nbsp&nbsp&nbsp像:&nbsp&nbsp<p>&nbsp&nbsp<img src=pic/heng6.jpg alt="头像选择" width=240px class=face height=140px /></h2><br>-->
<!--<h2>&nbsp&nbsp&nbsp&nbsp&nbsp选&nbsp&nbsp&nbsp&nbsp择&nbsp&nbsp&nbsp&nbsp头&nbsp&nbsp&nbsp&nbsp像:&nbsp&nbsp<p>&nbsp&nbsp<img src=pic/heng6.jpg alt="头像选择" width=240px class=face height=140px /></h2><br>-->
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp验&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp证&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp码：&nbsp&nbsp<input name=code type=text size=12 maxlength=14>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="code.php" id=code onclick="javascript:this.src='code.php?tm='+Math.random()" /></h2><br><br>		<!--此处使用了JS的随机-->

 </fieldset>
 
 <br>
 <br>
 <input type=submit value=确认 class=sub />
 <br>
 <br>
 <?php }else{
     echo '<br><br><br><br>';
    echo '<h3 style=text-align:center>程序员哥哥正在测试中，本站暂时关闭注册功能，敬请谅解~</h3>';
 }?>
 </form>

</div>

<div class=rend>

<?php 
    //引用公共文件
    @define('PATH',substr(dirname(__FILE__),0,16));
    require("includes/footer1.inc.php");
?>

</div>

</body>
</html>