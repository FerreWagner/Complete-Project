<?php 
    session_start();
    define('chang',1990);
    require 'includes/connin.inc.php';
    require 'includes/timeheader.php';
    require 'includes/mysqlname.inc.php';
 //   require 'includes/func.inc.php';
    global $_system;
    header("Content-Type:text/html; charset=utf-8");
    
    //登录后才可以发帖
    if(!isset($_COOKIE['username'])){
        _location('发帖需要登录', 'login.php');
    }
    
    //将帖子写入数据库
    if(@$_GET['action'] == 'post'){
        //验证码函数判断
        @_check_code($_POST['code'],$_SESSION['code']);
        if(!!$_rows = _fetch_array("select f_uniqid,f_post_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
            //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
            _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
            
            //验证是否在规定时间外发帖；从第二次开始判断
            _timed(time(), @$_rows['f_post_time'], $_system['post']);
            
            include 'includes/check.func.php';
            //接收帖子内容
            $_clean = array();
            $_clean['username'] = $_COOKIE['username'];
            $_clean['type'] = $_POST['type'];
            $_clean['title'] = _check_post_title($_POST['title'],2,100);
            $_clean['content'] = _check_post_content($_POST['content'],4);
            $_clean = _mysql_string($_clean);
            //写入数据库
            _query("insert into 
                                            f_article(f_username,f_title,f_type,f_content,f_date) 
                                            values
                                            ('{$_clean['username']}',
                                             '{$_clean['title']}',
                                             '{$_clean['type']}',
                                             '{$_clean['content']}',
                                              NOW())");
            if(_affected_rows() == 1){
                //获取刚刚新增的ID
                $_clean['id'] = _insert_id();
                
                //此处设定规定时间发帖的cookie值
               // setcookie('post_time',time());
               $_clean['time'] = time();
                _query("update f_user set f_post_time='{$_clean['time']}' where f_username='{$_COOKIE['username']}'");
                
                //数据库关闭函数
                _close();
                //清空，不让服务器负担过重
                //_session_destroy();
                //跳转到首页
                _location('博客发表成功', 'article.php?id='.$_clean['id']);
            }else{
                //数据库关闭函数
                _close();
                //清空，不让服务器负担过重
               // _session_destroy();
                //跳转到首页
               _alert_back('博客发表失败');
            }
        }
    }
    
    ?>
    
<!DOCTYPE html>
<html>
<head>
<title>写文章</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/create.css" />
<script type="text/javascript" src="JS/post1.js"></script>
<style type=text/css>
body{margin:0px;
	padding:0px;
	background:#252525;
	color:#9acdcd;
}
h2{
	font-size:28px;
	font-family:微软雅黑;
	color:#acacac;
}
</style>
<script type="text/javascript" src="JS/post.js"></script>
</head>
<body>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>
<div id="post">
<h2 align=center>发表文章</h2>
<form method="post" name="post" action="?action=post">
    <h><dl>
        <dl align=center><h>请填写以下内容</h></dl>
        <br><br>
        <dd style=text-indent:200px;>类 型:
        <?php 
            foreach (range(1, 6) as $_num){
                if($_num == 1){
                    echo '<label for="type'.$_num.'"><input type="radio" name="type" id="type'.$_num.'" value="'.$_num.'" checked="checked" />';
                }else{
                    echo '<label for="type'.$_num.'"><input type="radio" name="type" id="type'.$_num.'" value="'.$_num.'" />';
                }
                echo '<img src="pic/music/'.$_num.'.jpg" alt="类型" width=30px height=30px /></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                if($_num == 8){
                    echo '<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                }
            }
           
        ?>
       <br>
       &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
       &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(乐评)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(CD)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(交流)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(演奏)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(交易)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(其他)
       </dd>
       <br />
       <dd style=text-indent:200px;>风 格:      
        <?php
         foreach (range(7, 17) as $_num){
                if($_num == 7){
                    echo '<label for="type'.$_num.'"><input type="radio" name="type" id="type'.$_num.'" value="'.$_num.'" />';
                }else{
                    echo '<label for="type'.$_num.'"><input type="radio" name="type" id="type'.$_num.'" value="'.$_num.'" />';
                }
                echo '<img src="pic/music/'.$_num.'.jpg" alt="类型" width=30px height=30px /></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                if($_num == 17){
                    echo '<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                }
            }
            ?>
            <br>
       &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
       &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(吉他)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(小提琴)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(古典)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(爵士)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(金属)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(摇滚)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(人声)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(电子)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(合成器)&nbsp&nbsp&nbsp&nbsp&nbsp(轻音乐)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(其他)
        </dd>
        <br><br><br>
        <dd align=center><h>标 &nbsp&nbsp题 ： <input type="text" name="title" class="text" maxlength=80 size=40 />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp( 2 - 100 位 标 题 )</h></dd><br><br>
        <dd align=center id="q">图片:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="javascript:'">上传</a></dd>
        <br>
        <br>
        <dd>
            
            <?php
                include 'includes/ubb.inc.php'; //此处调用ubb界面
            ?>
           
            <textarea name="content" rows="28"></textarea>
        </dd>
        <br><br>
        <dd style=text-indent:150px;>验证码：&nbsp&nbsp<input name=code type=text size=12 maxlength=14>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="code.php" id=code onclick="javascript:this.src='code.php?tm='+Math.random()" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=submit value="发表" class=sub style="background:#323533;color:#ccc" /></dd><br><br><br><br><br>	<!--此处使用了JS的随机-->
    </dl></h>
</form>
</div>
</body>
</html>

<?php 
    //引用公共文件
    @define('PATH',substr(dirname(__FILE__),0,16));
    require("includes/footer1.inc.php");
?>
