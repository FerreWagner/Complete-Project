<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', manage_job);
  
  //添加管理员
  
  if(@$_GET['action'] == 'add'){
      //敏感操作相关
      if(!!$_rows = _fetch_array("select f_uniqid,f_article_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
            _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
          
            $_clean = array();
            $_clean['username'] = $_POST['manage'];
            $_clean = _mysql_string($_clean);
            //修改成为管理员
            _query("update f_user set f_level=1 where f_username='{$_clean['username']}'");
            
            if(_affected_rows() == 1){
                //数据库关闭函数
                _close();
                //清空，不让服务器负担过重
                //_session_destroy();
                //跳转到首页
                _location('管理员添加成功', 'index.php');
             }else{
                //数据库关闭函数
                _close();
                //清空，不让服务器负担过重
                //_session_destroy();
                //跳转到首页
                _alert_back("管理员添加失败或不存在此用户");
            }
      }else{
          _alert_back("非法登录");
      }
  } 
  //辞职相关
  if(@$_GET['action'] == 'job' && isset($_GET['id'])){
      if(@!!$_rows = _fetch_array("select f_uniqid,f_article_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
        
          //辞职
          _query("update f_user set f_level=0 where f_username='{$_COOKIE['username']}' and f_id='{$_GET['id']}'");
          
          if(_affected_rows() == 1){
              _close();
              _session_destroy();   //此处不是管理员了，必须要删除掉COOKIE
              _location('辞职成功', 'index.php');
          }else{
              _close();
              _alert_back("辞职失败");
          }
      }else{
          _alert_back('非法登录');
      }
  }
  
  global $_pagesize,$_pagenum;
  _page("select f_id from f_user",10);
  $_result = _query("select f_id,f_username,f_reg_time,f_email from f_user where f_level=1 order by f_reg_time desc limit $_pagenum,$_pagesize");
  
  
?>


<!DOCTYPE html>
<html>
<head>
<title>管理员列表</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/member_message.css" />
<script type="text/javascript" src="JS/member_message.js"></script>
<style type="text/css">
form{
	text-align:center;
	padding:10px;
}

</style>
</head>
<body style=margin:0;background-color:#180c0c;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<p align=center>
<a href=manage_job.php><h14><?php echo @$_COOKIE['username']?>的管理中心</h14></a>
</p>
<div id="member">
    <?php 
        require 'includes/manage.inc.php';
    ?>
    <div id="member_main">
        <h2>管理员列表中心</h2>
        
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
                        
                        if(@$_COOKIE['username'] == @$_html['username']){
                            $_html['job_html'] = '<a href="manage_job.php?action=job&id='.$_html['id'].'"> 辞 职 </a>';
                        }else{
                            $_html['job_html'] = '无权操作';
                        }
            ?>
            
            
            <tr height=50px><td><?php echo $_html['id']?></td><td><?php echo $_html['username']?></td><td><?php echo $_html['email']?></td><td><?php echo $_html['reg_time']?></td><td> <?php echo $_html['job_html']?> </td></tr>            
            
                        <?php 
                    }
                    
            ?>
            
        </table>
            <form method="post" action="?action=add">
                <input type="text" name="manage" class="text" /><input type="submit" value="添加管理员" />
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