<?php 
    define('chang',1990);
    require 'includes/connin.inc.php';
    require 'includes/timeheader.php';
    require 'includes/mysqlname.inc.php';
  //  require 'includes/func.inc.php';
    
    session_start();
    //登录状态的判断函数
    _login_state();
    
    if(@$_POST['action'] == 'login'){
        //防止恶意注册和跨站攻击
        //验证码的验证
        @_check_code($_POST['code'],$_SESSION['code']);
        //引入验证文件
        include 'includes/login.func.php';
        //接收数据
        $_clean = array();
        $_clean['username'] = _check_username($_POST['username'], 2,20);
        $_clean['password'] = _check_password($_POST['password'],6);
        $_clean['time'] = _check_time($_POST['time']);
        //到数据库去验证
        if(!!$_rows = _fetch_array("select f_username,f_uniqid,f_level from f_user where f_username='{$_clean['username']}' and f_password='{$_clean['password']}' and f_active='' limit 1")){
            echo '登陆成功'.$_rows['f_username'].$_rows['f_uniqid'];
            //登陆成功后记录登录信息
            _query("update f_user set
                                        f_last_time=NOW(),
                                        f_last_ip='{$_SERVER["REMOTE_ADDR"]}',
                                        f_login_count=f_login_count+1
                                where 
                                        f_username='{$_rows['f_username']}'        
                                        ");
            
            
            //_session_destroy();
            _setcookies($_rows['f_username'], $_rows['f_uniqid'],$_clean['time']);
            if($_rows['f_level'] == 1){
                $_SESSION['admin'] = $_rows['f_username'];
            }
            _close();
            _location(null, 'member.php');
            }else{
                _close();
             //   _session_destroy();
                _location('用户名密码不正确或该账户未被激活','login.php');  //JS的方法,要弹窗
            }
        
    }
    
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/create.css" />
<style type=text/css>
body{margin:0px;
	padding:0px;
	color:silver;
}
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

</style>
<script type="text/javascript" src="JS/login.js"></script>
</head>
<body>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<div class=rnew align=center>
	<h3><a href=login.php>用户登录</a></h3>
</div>

<div class=rdi1>
<h>Welcome To F-sociaty</h><br><br><br><br><br><br><br>
<form action="login.php" method=post>
<input type=hidden name=action value=login />
<fieldset>
  <legend><h3>Login</h3></legend><br><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp用&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp户&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：&nbsp&nbsp<input name=username type=text size=20 maxlength=18>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h2><br><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp密&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp码：&nbsp&nbsp<input name=password type=password size=20 maxlength=16>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h2><br><br>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp保&nbsp&nbsp&nbsp&nbsp留&nbsp&nbsp&nbsp&nbsp时&nbsp&nbsp&nbsp&nbsp间:&nbsp&nbsp<input name=time type=radio value=0 checked="checked" />不保留 &nbsp&nbsp&nbsp<input name=time type=radio value=1 />保留两日&nbsp&nbsp&nbsp <input name=time type=radio value=2 />保留十日&nbsp&nbsp&nbsp <input name=time type=radio value=3 />保留一月</h2><br>
<?php 
global $_system;
if(!empty($_system['code'])){?>
<h2>&nbsp&nbsp&nbsp&nbsp&nbsp验&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp证&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp码：&nbsp&nbsp<input name=code type=text size=12 maxlength=14>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="code.php" id=code onclick="javascript:this.src='code.php?tm='+Math.random()" /></h2><br><br>
<?php }?>
<br><br><br> 
</fieldset>
 
 <br>
 <br>
 <input type=submit value=登录 class=sub />
 <br>
 <br>
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