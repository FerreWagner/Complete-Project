<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT','f-sociaty');   //分页函数的文件名会用到
 
  
?>
  
  
  
  
<!DOCTYPE html>
<html>
<head>
<title>F-sociaty</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/f-sociaty.css" />
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<h2>导 航 && 帮 助</h2>
<h3>导航 : F-sociaty为Ferre开发的功能型音乐类BBS，旨在提供有质量的乐评和内容性质的讨论 .</h3>

<?php 
    if($_COOKIE['username'] !== 'Admin'){
?>
<div class="here">

   功能性 : 1、游客可阅读F-sociaty所有博客及评论内容;<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp2、 注册F-sociaty的用户可自由发表文章或乐评 （注册用户可评论博客、与博友交流等）;<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp3、注册用户可拥有加好友、验证、点赞等功能;<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp4、注册用户可修改应用自己的资料 ( 资料版块 );<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp5、注册用户可在各类型版面发表博客并回复，且博主可删除自己的主题博客 ( 文章板块 );<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp6、非博主用户评论自由，且可删除评论;<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp7、F-sociaty建有公有相册，用户可根据文章内容上传图片和配图 (用户私人相册正在完善中、请稍后);<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp8、公有相册的图片设有评论区;<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp9、注册用户可收到来自其他用户的消息及博客回复提醒;用户可在个人博客或个人主页版块查看自己发表的文章及评论、和收藏文章+相册等等。<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp10、管理员及其功能; ( 对用户违法操作限制等 )<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp......<p>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFerre : F-sociaty期待您的加入;<p>
</div>

<?php }?>
<div class="here1">
<?php 
    
    if($_COOKIE['username'] == 'Admin'){
        global $_pagesize,$_pagenum;
        //分页模块函数的调用,此函数为分页函数的参数函数
        _page("select * from f_read",10);    //第一个参数获取总条数，第二个参数指定每页多少条
        $_result = _query("select * from f_read order by f_date desc limit $_pagenum,$_pagesize");
        echo '<table border="1"; style=color:"blue">';
        echo '<tr>';
        echo '<th width=300px>访问量</th>';
        echo '<th width=600px>访问IP</th>';
        echo '<th width=300px>访问日期</th>';
        echo '</tr>';
        while(!!$_rows = _fetch_array_list($_result)){
                
                //提取用户信息
                $_html['date'] = $_rows['f_date'];
                $_html['read'] = $_rows['f_read'];
                $_html['ip'] = $_rows['f_ip'];
                
                $_html = _html($_html);
                
                echo '<tr>';
                echo '<th>'.$_html['read'].'</th>';
                echo '<th>'.$_html['ip'].'</th>';
                echo '<th>'.$_html['date'].'</th>';
                echo '</tr>';
                
        }
        echo '</table>';
        _free_result($_result);
        _paging(2);
        
       
    }
    
?>

</div>



</body>
</html>