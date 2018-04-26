<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', manage_member);
  
  //此处验证短信是否合法
  if(@$_GET['action'] == 'del' && isset($_GET['id'])){
      if(!!$_rows = _fetch_array("select f_id from f_message where f_id = '{$_GET['id']}' limit 1")){
           
          //当你进行危险操作时，需要对唯一标识符进行验证
          //危险操作时.为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          if(!!$_row2 = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
              _uniqid($_row2['f_uniqid'], $_COOKIE['uniqid']);
              //单个删除短信
              _query("delete from f_user where f_id='{$_GET['id']}' limit 1");
              if(_affected_rows() == 1){
                  //数据库关闭函数
                  _close();
                  //跳转到首页
                  _location('用户删除成功', 'manage_member.php');
              }else{
                  _close();
                  _alert_back('用户删除失败');
              }
          }else{
              _alert_back('非法登录');
          }
      }else{
          _alert_back('此用户不存在,无法删除');
      }
  }
  //_manage_login();
  
  global $_pagesize,$_pagenum;
  _page("select f_id from f_user",10);
  $_result = _query("select f_id,f_username,f_reg_time,f_email from f_user order by f_reg_time desc limit $_pagenum,$_pagesize");
  
  
?>


<!DOCTYPE html>
<html>
<head>
<title>博主列表</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/member_message.css" />
<script type="text/javascript" src="JS/member_message.js"></script>
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<p align=center>
<a href=manage_member.php><h14><?php echo $_COOKIE['username']?>的管理中心</h14></a>
</p>
<div id="member">
    <?php 
        require 'includes/manage.inc.php';
    ?>
    <div id="member_main">
        <h2>博主列表中心</h2>
        <form method="post" action="?action=delete1">
        <table cellspacing="2">
            
            <tr height=60px><th width=80px> I D </th><th width=220px> 博 主 </th><th width=150px> 邮 件 </th><th width=140px> 激 活 状 态 </th><th width=60px> 操 作 </th></tr>
            
            <?php 
                    $_html = array();
                    while(!!$_rows = _fetch_array_list($_result)){
                        //此处过滤用户名和性别信息
                        $_html['id'] = $_rows['f_id'];
                        $_html['username'] = $_rows['f_username'];
                        $_html['email'] = $_rows['f_email'];
                        $_html['reg_time'] = $_rows['f_reg_time'];
                        $_html = _html($_html);
            ?>
            
            
            <tr height=50px><td><?php echo $_html['id']?></td><td><?php echo $_html['username']?></td><td><?php echo $_html['email']?></td><td><?php echo $_html['reg_time']?></td><td><a href="?action=del&id=<?php echo $_html['id']?>"> 删 除 </a></td></tr>            
            
                        <?php 
                    }
                    
            ?>
            
        </table>
        </form>
        
        <?php _free_result($_result);
                _paging(2);
        ?>
            
        
    </div>
</div>


</body>
</html>

<?php 
    require("includes/footer1.inc.php");
?>