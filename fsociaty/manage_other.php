<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', manage_other);
  
  session_start();
  
  //必须是管理才能登陆的判断
  _manage_login();
  
  
 global $_pagesize,$_pagenum;
  //分页模块函数的调用,此函数为分页函数的参数函数
  _page("select * from f_other",8);    //第一个参数获取总条数，第二个参数指定每页多少条
  //从数据库里提取数据获取结果集
  //必须是没词重新读取结果集，而不是重新执行SQL语句，会造成死循环，只有第一条数据
  $_result = _query("select * from f_other order by f_date desc limit $_pagenum,$_pagesize");
  
?>


<!DOCTYPE html>
<html>
<head>
<title>后台管理中心</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/member.css" />
</head>
<body style=margin:0;background-color:#180c0c;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>
<p align=center>
<a href=manage.php><h14><?php echo $_COOKIE['username']?> 后台管理</h14></a>
</p>
<div id="member">
    <?php 
        require 'includes/manage.inc.php';
    ?>
    <div id="member_main">
        <h2>后台管理中心</h2>
        <table border="1"; cellpadding="0"; cellspacing="0";>
            <tr id="qiangshi">
                <th width=110px>用户</th>
                <th width=180px>建议组</th>
                <th width=160px>加入组</th>
                <th width=170px>BUG组</th>
                <th width=170px>其他组</th>
                <th width=140px>时间</th>
            </tr>
            
            <?php 
                      $_html = array();
                while(!!$_rows = _fetch_array_list($_result)){
                      //此处过滤用户名和性别信息
                      $_html['username'] = $_rows['f_username'];
                      $_html['sug'] = $_rows['f_sug'];
                      $_html['join'] = $_rows['f_join'];
                      $_html['bug'] = $_rows['f_bug'];
                      $_html['other'] = $_rows['f_other'];
                      $_html['date'] = $_rows['f_date'];
                      $_html = _html($_html);
                      
 
            ?>
            
            
            <tr height=50px><td><?php echo @$_html['username']?></td><td> <?php echo @$_html['sug']?></td><td><?php echo @$_html['join']?></td><td><?php echo @$_html['bug']?></td><td><?php echo @$_html['other']?></td><td><?php echo $_html['date']?></td></tr>            
        
        <?php }; _free_result($_result);?>
        </table>
         <?php  _paging(2); //此函数为分页函数，1为数字分页；2为文本分页?>
    </div>

</div>
</body>
</html>







<?php 
    require("includes/footer1.inc.php");

?>
