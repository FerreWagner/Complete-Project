<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', message_article);
  
  //判断是否登录了
  if(!isset($_COOKIE['username'])){
      _alert_back('请先登录');
  }
  
  
  //批删除短信
  if(@$_GET['action'] == 'delete' && @$_POST['ids']){
      $_clean = array();
      $_clean['ids'] = _mysql_string(implode(',', $_POST['ids']));
      //危险操作时.为了防止cookie伪造,还要比对一下唯一标识符uniqid()
      if(!!$_row2 = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          _uniqid($_row2['f_uniqid'], $_COOKIE['uniqid']);
          _query("delete from f_message where f_id in ({$_clean['ids']})");
              if(_affected_rows()){ //如果有数据被删除
                  //数据库关闭函数
                  _close();
                  //跳转到首页
                  _location('信息删除成功', 'member_message.php');
              }else{
                  _close();
                 // _session_destroy();
                  _alert_back('信息删除失败');
              }
      }else{
          _alert_back('非法登录');
      }
  }
  
  global $_pagesize,$_pagenum;
  //分页模块函数的调用,此函数为分页函数的参数函数
  _page("select f_reid from f_article where f_reid=0 and f_username='{$_COOKIE['username']}'",8);    //第一个参数获取总条数，第二个参数指定每页多少条
  //从数据库里提取数据获取结果集
  //必须是没词重新读取结果集，而不是重新执行SQL语句，会造成死循环，只有第一条数据
  $_result = _query("select * from f_article where f_reid=0 and f_username='{$_COOKIE['username']}' limit $_pagenum,$_pagesize");
  //上面拿到主题帖的id，下面将主题帖的id和回帖的reid做相等操作，得到了回帖的信息数据
  
  
?>


<!DOCTYPE html>
<html>
<head>
<title>信息列表</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/member_message.css" />
<script type="text/javascript" src="JS/member_message.js"></script>
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
        <h2>博客消息</h2>
        <form method="post" action="?action=delete">
        <table cellspacing="2">
            <tr height=60px><th width=150px>发 件 人</th><th width=200px> 主 题 内 容 </th><th width=200px>时 间</th><th width=120px>状 态</th><th width=80px>操作</th></tr>
            <?php 
                      $_html = array();
                while(!!$_rows = _fetch_array_list($_result)){
                      //此处过滤用户名和性别信息
                      $_html['id'] = $_rows['f_id'];
                      $_html['reid'] = $_rows['f_reid'];
                      $_html['username'] = $_rows['f_username'];
                      $_html['title'] = $_rows['f_title'];
                      $_html['content'] = $_rows['f_content'];
                      $_html['date'] = $_rows['f_date'];
                      $_html['state'] = $_rows['f_state'];
                      
                      $_html = _html($_html);
                      
                      if(empty($_rows['f_state'])){
                          $_html['state'] = '<img src="pic/email/email11g.png" alt="未读" title="未读" height=40px width=30px />';
                          $_html['content_html'] = '<strong>'._title($_html['content'],16).'<strong>';
                      }else{
                          $_html['state'] = '<img src="pic/email/email2.png" alt="已读" title="已读" height=30px width=30px />';
                          $_html['content_html'] = _title($_html['content'],16);
                      }
            ?>
            <tr height=50px><td><?php echo $_html['username']?></td><td><a href="article.php?id=<?php echo $_html['id']?>" title="<?php echo $_html['content']?>"><?php echo $_html['content_html']?></a></td><td><?php echo $_html['date']?></td><td><?php echo $_html['state']?></td><td><input name="ids[]" type="checkbox" value="<?php echo $_html['id']?>" /></td></tr>            
            
            <?php
                }
                _free_result($_result);
            ?>
            
             <!--<tr><td colspan="5"><label for="all">全选<input type="checkbox" name="chkall" id="all" value="<?php echo @$_html['id']?>" /></label></td></tr>
           <tr><td colspan="5"><input type="submit" value="批量删除" class="subb" /></td></tr>-->
            
        </table>
        </form>
            
            <?php  _paging(2); //此函数为分页函数，1为数字分页；2为文本分页?>
        
    </div>
</div>


</body>
</html>

<?php 
    require("includes/footer1.inc.php");
?>