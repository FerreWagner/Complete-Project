<?php 
    define('chang',1990);   //防止非法调用
    @define('SCRIPT','article');   //分页函数的文件名会用到
    require 'includes/connin.inc.php';
    require 'includes/timeheader.php';
 //   require 'includes/func.inc.php';   //此处调用公共函数文件
    require 'includes/mysqlname.inc.php';   //为防止footer中_close函数报错二调用此文件
    session_start();
    header("Content-Type:text/html; charset=utf-8");
    //print_r($_SESSION['date']);此处做测试session的修改date数据
    
    //打印出文件名,为后面的封装调用分页函数做铺垫
    
    //判断是否登录
    if(!isset($_COOKIE['username'])){
        _alert_close('请先登录');
    }
    
    //修改数据
    if(@$_GET['action'] == 'xiu'){
        if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
            //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
            _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
            include 'includes/check.func.php';
            //接收数据
            
            $_clean = array();
            $_clean['id'] = $_POST['id'];
            $_clean['title'] = _check_post_title($_POST['title'],1,80);
            $_clean['content'] = _check_post_content($_POST['content'],1);
            $_clean['username'] = $_COOKIE['username'];
            $_clean = _mysql_string($_clean);
            
             _query("update f_article set f_title='{$_clean['title']}',f_content='{$_clean['content']}' where f_reid='{$_clean['id']}' and f_username='{$_COOKIE['username']}' and f_date='{$_SESSION['date']}'");
            
                if(_affected_rows() !== 0){
                    //数据库关闭函数
                    _close();
                    //清空，不让服务器负担过重
                    _session_destroy();
                    //跳转到首页
                    _location('博客回复成功', 'article.php?id='.$_clean['id']);
                }else{
                    //数据库关闭函数
                    _close();
                    //清空，不让服务器负担过重
                    _session_destroy();
                    //跳转到首页
                    _alert_back('博客回复失败');
                }
        }else{
            _alert_back('非法登录');
        }
    }
    
    //读出数据
    if(isset($_GET['id'])){
        if(!!$_rows = _fetch_array("select f_id,f_reid,f_date,f_username,f_title,f_type,f_content from f_article where f_reid='{$_GET['id']}' and f_username='{$_COOKIE['username']}'")){
            //存在操作
            $_html = array();
            $_html['reid'] = $_rows['f_reid'];
            $_html['id'] = $_GET['id'];
            $_html['username'] = $_rows['f_username'];
            $_html['date'] = $_rows['f_date'];
            $_html['title'] = $_rows['f_title'];
            $_html['type'] = $_rows['f_type'];
            $_html['content'] = $_rows['f_content'];
            $_html = _html($_html);   
         //判断权限，能否修改,不是自己写的帖子就不能修改
            if($_COOKIE['username'] !== $_html['username']){
                _alert_back('没有权限修改');
            }
        }
        else{
            _alert_back('不存在此回复');
        }
    }else{
        _alert_back('非法操作');
    }
    
?>

<!DOCTYPE html>
<html>
<head>
<title>修改回复</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/article.css" />
<script type="text/javascript" src="JS/article.js"></script>
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<div id=article>
    <br>
    <h2>博客详情</h2>
    

  
    <div id=content>
        <div class="user1">
<h><span><?php echo @$_html['subject_modify']?>&nbsp&nbsp 回 复</span><?php echo @$_html['username']?> &nbsp&nbsp|&nbsp&nbsp 回复于 : <?php echo $_html['date']?></h>
        </div>
    </div>
    
    <div id=article1>
    <h3>TITLE ：<?php echo @$_html['title']?> </h3>
        <div class="detail">
          <?php echo @_ubb($_html['content'])?>
          <div class="read">
          <br><br><br><br>
          
                         
          </div>
        </div>
   <form method="post" name="post" action="?action=xiu">     
        <div class="ree">

<input type="hidden" value="<?php echo @$_html['id']?>" name="id" />

        </div>
        <p class="line"></p>
          <dl>
            <br><br>
                <dd align=center;><h><h6>F o r ： <input type="text" name="title" class="text" value="TO : <?php echo @$_html['title']?>" maxlength=80 size=40 />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp( 2 - 80 位 )</h6></h></dd>
            
            <dd>
            <?php
                include 'includes/ubb.inc.php'; //此处调用ubb界面
            ?>
            <textarea name="content" rows="28"><?php echo $_html['content']?></textarea>
            </dd>
            
            <br><br>
            <dd>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=submit value="发表" class=sub style="background:#323533;color:#ccc" /></dd><br><br><br><br><br>	
                
          </dl>
</form>
        

                                                     <div id=footer3>   
                                                            版权所有 翻版必究  未经Ferre授权不得转载本站内所有信息<br>
                                                    本站由<font color=blue>&copyFerre</font>提供技术支持，请勿在它处引用,否则将承担法律责任<br>
                                                   注册商标12006 &reg<br>
                                                    CopyRight &copy 2016-2030 All Rights Reserved
                                                    </div>
    </div>
</div>
</body>
</html>

