<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
  //require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', member_message_detall);
  
  
  if(!isset($_COOKIE['username'])){
      _alert_back('请先登录');
  }
  
  //删除短信模块
  //此处验证短信是否合法
  if(@$_GET['action'] == 'delete' && isset($_GET['id'])){
       if(!!$_rows = _fetch_array("select f_id from f_message where f_id = '{$_GET['id']}' limit 1")){
           
           //当你进行危险操作时，需要对唯一标识符进行验证
           //危险操作时.为了防止cookie伪造,还要比对一下唯一标识符uniqid()
           if(!!$_row2 = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
               _uniqid($_row2['f_uniqid'], $_COOKIE['uniqid']);
               //单个删除短信
               _query("delete from f_message where f_id='{$_GET['id']}' limit 1");
               if(_affected_rows() == 1){
                    //数据库关闭函数
                    _close();
                    //跳转到首页
                    _location('信息删除成功', 'member_message.php');
           }else{
                    _close();
                    _alert_back('信息删除失败');
           }
           }else{
               _alert_back('非法登录');
           }
       }else{
           _alert_back('此信息不存在,无法删除');
       }
  }
  
  //处理ID 
  if(isset($_GET['id'])){
      $_rows = _fetch_array("select f_fromuser,f_state,f_content,f_date,f_id from f_message where f_id = '{$_GET['id']}' limit 1");
      if($_rows){
          //将他的state设置为1即可
          if(empty($_rows['f_state'])){
              _query("update f_message set f_state=1 where f_id='{$_GET['id']}' limit 1");
              if(!_affected_rows()){
                  _alert_back('异常');
              }
          }
          $_html = array(); //此数组为专门显示在网页上的数组
          $_html['id'] = $_rows['f_id'];
          $_html['fromuser'] = $_rows['f_fromuser'];
          $_html['content'] = $_rows['f_content'];
          $_html['date'] = $_rows['f_date'];
          $_html = _html($_html);
      }else{
          _alert_back('此信息不存在');
      }
  
  }else{
      _alert_back('非法登录');
  }

?>



<!DOCTYPE html>
<html>
<head>
<title>信息列表</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/member_message.css" />
<link rel="stylesheet"type="text/css"href="css/member_message_detall.css" />
<script type="text/javascript" src="JS/member_message_detail.js"></script>
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<p align=center>
<a href=member.php><h14><?php echo $_COOKIE['username']?>的个人中心</h14></a>
</p>
<div id="member">
    <?php 
        require 'includes/member.inc.php';
    ?>
    <div id="member_main">
        <h2>信息详情管理</h2>
        <br><br>
        <dl>
           <h3> <dd>发&nbsp 件 &nbsp人：<?php echo $_html['fromuser']?></dd>
            <dd>&nbsp&nbsp内&nbsp&nbsp&nbsp&nbsp 容：<?php echo $_html['content']?></dd>
            <dd>发送时间：<?php echo $_html['date']?></dd>
            <dd><input type="button" value="返回列表" id="return" onclick="javascript:history.back();" /></dd>       <!-- onclick="javascript:history.back();" -->
            <dd><input type="button" value="删除信息" id="delete" name="<?php echo $_html['id']?>" /></dd>
        </h3>
        </dl>
</div>
</div>
        
        
</body>
</html>

<?php 
    require("includes/footer1.inc.php");
?>