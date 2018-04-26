<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet"type="text/css"href="css/head.css" />
<link rel="stylesheet"type="text/css"href="../css/head.css" />
<link rel="shortcat icon" href="../pic/f2.jpg">
<link rel="shortcat icon" href="/pic/f2.jpg">
<style type="text/css">
.vague{
	box-shadow: 0px 0px 15px #004040;
}
a.manage{
	color:#b7b7ff;
}
</style>
</head>
<body>
<div class=di1>
	<div class=di13>
		<h11><a href=#Navigation><acronym title=导航>Navigation</acronym></a></h11>
		
	</div><br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <div class=di113>
    <iframe scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&color=%23FFFFFF&icon=1&py=chengdu&num=3"></iframe>
    </div>

	<div class=di11>
	<?php
	
	    global $_message_html,$_system;
        if(isset($_COOKIE['username']) && isset($_SESSION['admin'])){
            echo '<h><a href="manage.php" class="manage">管理 &nbsp&nbsp</a><a href=member.php target=_blank>'.$_COOKIE['username'].'</a>'.'&nbsp<a href=member_message.php>'.@$_message_html.'</a>';
        }
        elseif(isset($_COOKIE['username'])){
                echo '<h><a href=member.php target=_blank>'.$_COOKIE['username'].'</a>'.'&nbsp<a href=member_message.php>'.@$_message_html.'</a>';
                echo "\n";
        }else{
            echo '<h><acronym title=登录><a href=login.php target=_blank>Login</a></acronym></h>';
        }
        
     ?>
		
		
	
	</div>
	<div class=di12>
		<?php 
            if(isset($_COOKIE['username'])){
            echo '<h><a href=member.php target=_blank>'.'资料修改'.'</h></a>';
            echo "\n";
            }else{
		      echo '<h><acronym title=注册><a href="register.php" target=_blank>Register</a></acronym></h>';
            } 
	   ?>
	</div>
	<div class=di14>
	<?php 
	    $_logoutif = $_SERVER['PHP_SELF'];
	    $_keyi = preg_match("/index/",$_logoutif);
	    
        if(isset($_COOKIE['username'])){
            if($_keyi == 1){
            echo '<h><a href="logout.php">退出</h>';
            }
            else{
                echo '<h><a href=aboutus.php target=_blank>About Us</a></h>';
            }
        }else{
		        echo '<h><a href=aboutus.php target=_blank>About Us</a></h>';
        }
        
    ?>

	</div>
	
	<div class=di15>
	    <h>
	    <form action=131245@qq.com method=post name=name enctype=text/plain>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSearch:<input name=name type=text size=16 maxlength=50 value="请输入"><img src=pic/Finder.png alt=pic width=20px height=20px>
        </form>
        </h>
	</div>
	
	</div>
	
	
	<?php 
	
	//网站初始化,站名设置等等,已经放在mysqlname.inc.php,此处有bug,maybe......

	?>
	
	
</body>	
</html>