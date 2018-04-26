<?php 
    session_start();
    define('chang',1990);
    require 'includes/connin.inc.php';
    require 'includes/timeheader.php';
    require 'includes/mysqlname.inc.php';
   // require 'includes/func.inc.php';
    header("Content-Type:text/html; charset=utf-8");
    
    //登录后才可以发帖
    if(!isset($_COOKIE['username'])){
        _location('修改需要登录', 'login.php');
    }

    //修改数据
    if(@$_GET['action'] == 'modify'){
        //验证码函数判断
        @_check_code($_POST['code'],$_SESSION['code']);
        if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
            //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
            _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
            //开始修改
            include 'includes/check.func.php';
            //接收帖子内容
            $_clean = array();
            $_clean['id'] = $_POST['id'];
            $_clean['type'] = $_POST['type'];
            $_clean['title'] = _check_post_title($_POST['title'],2,100);
            $_clean['content'] = _check_post_content($_POST['content'],1);
            $_clean['username'] = $_COOKIE['username'];
            $_clean = _mysql_string($_clean);
            
            //执行SQL
            _query("update f_article set f_type='{$_clean['type']}',f_title='{$_clean['title']}',f_content='{$_clean['content']}',f_last_modify_date=NOW() where f_id='{$_clean['id']}'");
            
            if(_affected_rows() == 1){
                //数据库关闭函数
                _close();
                //清空，不让服务器负担过重
                //_session_destroy();
                //跳转到首页
                _location('博客修改成功', 'article.php?id='.$_clean['id']);
            }else{
                //数据库关闭函数
                _close();
                //清空，不让服务器负担过重
                //_session_destroy();
                //跳转到首页
                _alert_back('博客修改失败');
            }
    }else{
        _alert_back('非法登录');
    }
    }
    
    //读取数据
    
    if(isset($_GET['id'])){
        if(!!$_rows = _fetch_array("select f_username,f_title,f_type,f_content from f_article where f_reid=0 and f_id='{$_GET['id']}'")){
            $_html = array();
            $_html['id'] = $_GET['id'];
            $_html['username'] = $_rows['f_username'];
            $_html['title'] = $_rows['f_title'];
            $_html['type'] = $_rows['f_type'];
            $_html['content'] = $_rows['f_content'];
            $_html = _html($_html);
            
            //判断权限，能否修改,不是自己写的帖子就不能修改
            if(!isset($_SESSION['admin'])){
            if($_COOKIE['username'] !== $_html['username']){
                _alert_back('没有权限修改');
            }
            }
        }
        else{
            _alert_back('不存在此博客');
        }
    }else{
        _alert_back('非法操作');
    }
    
?>
    
<!DOCTYPE html>
<html>
<head>
<title>修改博客</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/create.css" />
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
<h2 align=center>修改文章</h2>
<form method="post" name="post" action="?action=modify">
<input type="hidden" value="<?php echo $_html['id']?>" name="id" />
    <h><dl>
        <dl align=center><h>请填写</h></dl>
        <br><br>
        <dd style=text-indent:200px;>类 型:
        <?php 
            foreach (range(1, 6) as $_num){
                if($_num == $_html['type']){    //判断type的复选是否选中原来的type
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
        <dd align=center><h>标 &nbsp&nbsp题 ： <input type="text" name="title" value="<?php echo $_html['title']?>" class="text" maxlength=80 size=40 />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp( 2 - 100 位 标 题 )</h></dd><br><br>
        <dd align=center id="q">图片:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="javascript:'">图片集:</a><a href="javascript:'">图片集:</a></dd>
        <br>
        <br>
        <dd>
            
            <?php
                include 'includes/ubb.inc.php'; //此处调用ubb界面
            ?>
           
            <textarea name="content" rows="28"><?php echo $_html['content']?></textarea>
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
