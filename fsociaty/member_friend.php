<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
  //require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', member_friend);
  
  //判断是否登录了
  if(!isset($_COOKIE['username'])){
      _alert_back('请先登录');
  }
  
  //验证好友
  if(@$_GET['action'] == 'check' && isset($_GET['id'])){
      //危险操作时.为了防止cookie伪造,还要比对一下唯一标识符uniqid()
      if(!!$_row2 = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          
          //修改表里的state,从而通过验证
          _query("update f_friend set f_state=1 where f_id='{$_GET['id']}'");          
          if(_affected_rows() == 1){ //如果有数据被删除
              //数据库关闭函数
              _close();
              //_session_destroy();
              //跳转到首页
              _location('好友验证成功', 'member_friend.php');
          }else{
              _close();
             // _session_destroy();
              _alert_back('好友验证失败');
          }
      }else {
          _alert_back('非法登录');
      }
  }
  
  //批删除好友
  if(@$_GET['action'] == 'delete' && @$_POST['ids']){
      $_clean = array();
      $_clean['ids'] = _mysql_string(implode(',', $_POST['ids']));
      //危险操作时.为了防止cookie伪造,还要比对一下唯一标识符uniqid()
      if(!!$_row2 = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          _uniqid($_row2['f_uniqid'], $_COOKIE['uniqid']);
          _query("delete from f_friend where f_id in ({$_clean['ids']})");
          if(_affected_rows()){ //如果有数据被删除
              //数据库关闭函数
              _close();
              _session_destroy();
              //跳转到首页
              _location('信息删除成功', 'member_friend.php');
          }else{
              _close();
              _session_destroy();
              _alert_back('信息删除失败');
          }
      }else{
          _alert_back('非法登录');
      }
  }
  
  
  global $_pagesize,$_pagenum;
  //分页模块函数的调用,此函数为分页函数的参数函数
  _page("select f_id from f_friend where f_touser='{$_COOKIE['username']}' or f_fromuser='{$_COOKIE['username']}'",8);    //第一个参数获取总条数，第二个参数指定每页多少条
  //从数据库里提取数据获取结果集
  //必须是没词重新读取结果集，而不是重新执行SQL语句，会造成死循环，只有第一条数据
  $_result = _query("select f_id,f_state,f_touser,f_fromuser,f_content,f_date from f_friend where f_touser = '{$_COOKIE['username']}' or f_fromuser='{$_COOKIE['username']}' order by f_date desc limit $_pagenum,$_pagesize");
  
?>


<!DOCTYPE html>
<html>
<head>
<title>好友管理</title>
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
        <h2>好友列表</h2>
        <form method="post" action="?action=delete">
        <table cellspacing="2">
            <tr height=60px><th width=120px>好 友</th><th width=300px>请 求 内 容</th><th width=175px>时 间</th><th width=100px>状 态</th><th width=40px>操作</th></tr>
            <?php 
                      $_html = array();
                while(!!$_rows = _fetch_array_list($_result)){
                      //此处过滤用户名和性别信息
                      $_html['id'] = $_rows['f_id'];
                      $_html['touser'] = $_rows['f_touser'];
                      $_html['fromuser'] = $_rows['f_fromuser'];
                      $_html['content'] = $_rows['f_content'];
                      $_html['state'] = $_rows['f_state'];
                      $_html['date'] = $_rows['f_date'];
                      $_html = _html($_html);
                      if($_html['touser'] == $_COOKIE['username']){
                          $_html['friend'] = $_html['fromuser'];
                          if(empty($_html['state'])){
                              $_html['state_html'] = '<a href="?action=check&id='.$_html['id'].'">我未验证</a>';
                          }else {
                              $_html['state_html'] = '通过';
                          }
                      }elseif ($_html['fromuser'] == $_COOKIE['username']){
                          $_html['friend'] = $_html['touser'];
                          if(empty($_html['state'])){
                              $_html['state_html'] = '<span style="color:#eee">对方未验证</span>';
                          }else {
                              $_html['state_html'] = '通过';
                          }
                      }

            ?>
            <tr height=50px><td><?php echo $_html['friend']?></td><td title="<?php echo $_html['content']?>"><?php echo _title($_html['content'],16)?></td><td><?php echo $_html['date']?></td><td><?php echo $_html['state_html']?></td><td><input name="ids[]" type="checkbox" value="<?php echo $_html['id']?>" /></td></tr>            
            
            <?php
                }
                _free_result($_result);
            ?>
            
            <tr><td colspan="5"><label for="all">全选<input type="checkbox" name="chkall" id="all" value="<?php echo @$_html['id']?>" /></label></td></tr>
            <tr><td colspan="5"><input type="submit" value="批量删除" class="subb" /></td></tr>
            
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