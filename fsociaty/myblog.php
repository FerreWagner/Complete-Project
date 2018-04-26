<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
//  require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', myblog);
  
  session_start();
  
  
  if(!isset($_COOKIE['username'])){
      _location('请登录查看', 'login.php');
  }
  //判断是否正常登陆
  global $_pagesize,$_pagenum,$_page;
  _page("select f_reid from f_article where f_reid=0 and f_username='{$_COOKIE['username']}'",8);
  
  //select * from f_article left join f_user on f_user.f_username=f_article.f_username 
  
      $_result = _query("select * from f_article where f_username = '{$_COOKIE['username']}' and f_reid=0 order by f_date desc limit $_pagenum,$_pagesize");
      //判断是否有$_rows数据，来防止假冒COOKIE

      
      $_auto = _fetch_array("select f_autograph from f_user where f_username='{$_COOKIE['username']}'");
      $_htmlauto['auto'] = $_auto['f_autograph'];
?>


<!DOCTYPE html>
<html>
<head>
<title>个人博客</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/myblog.css" />
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<?php include_once 'includes/myblog_inc.php';?>

<div class="user1">
<h><span>博 主</span><?php echo @$_COOKIE['username']?> &nbsp&nbsp|&nbsp&nbsp <?php echo $_htmlauto['auto']?></h>
</div>

<div id="middle">

<?php      
    //$_html1 = _query("select f_id from f_article where f_username='{$_COOKIE['username']}'");
while(!!$_rows = _fetch_array_list($_result)){
          $_html = array(); //此数组为专门显示在网页上的数组
          $_html['username'] = $_rows['f_username'];
          $_html['type'] = $_rows['f_type'];
          $_html['reid'] = $_rows['f_reid'];
          $_html['id'] = $_rows['f_id'];
          $_html['title'] = $_rows['f_title'];
          $_html['content'] = $_rows['f_content'];
          $_html['readcount'] = $_rows['f_readcount'];
          $_html['commendcount'] = $_rows['f_commendcount'];
          $_html['last_modify_date'] = $_rows['f_last_modify_date'];
          $_html['date'] = $_rows['f_date'];
          $_html = _html($_html);
          
          if(!empty($_html['title']) && ($_html['reid'] == 0)){
              echo '<ul>';
          
            echo '<li class="tou">'.$_html['username'].' &nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp Autograph : '.$_htmlauto['auto'].'<span>发表时间 : '.$_html['date'].'</span></li>';
            echo '<li class="title">Title : <a href="article.php?id='.$_html['id'].'">'.$_html['title'].'</a><span>';
            if($_html['last_modify_date'] !== '0000-00-00 00:00:00'){
            echo '最后修改 : '.$_html['last_modify_date'].'</span></li>';
            }
            echo '<li class="content" title="'._title($_html['content'],60).'">'._title($_html['content'],460).'</li><br><br><br>';
            echo '<li class="read">(阅读) : '.$_html['readcount'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(评论) : '.$_html['commendcount'].'&nbsp</li>';
            echo '</ul> ';
           
          }
          
          
      }
      _free_result($_result);
      
?>   
     <?php _paging(2);?>
      <br><br><br><br>    

</div>





<br><br><br><br>
</body>
</html>


<?php 
    include_once 'includes/footer.inc.php';
?>
