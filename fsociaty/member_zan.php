<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
 // require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', member_flower);
  
  //判断是否登录了
  if(!isset($_COOKIE['username'])){
      _alert_back('请先登录');
  }
  
  
  //批删除赞
  if(@$_GET['action'] == 'delete' && @$_POST['ids']){
      $_clean = array();
      $_clean['ids'] = _mysql_string(implode(',', $_POST['ids']));
      //危险操作时.为了防止cookie伪造,还要比对一下唯一标识符uniqid()
      if(!!$_row2 = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          _uniqid($_row2['f_uniqid'], $_COOKIE['uniqid']);
          _query("delete from f_flower where f_id in ({$_clean['ids']})");
              if(_affected_rows()){ //如果有数据被删除
                  //数据库关闭函数
                  _close();
                  //_session_destroy();
                  //跳转到首页
                  _location('赞信息删除成功', 'member_flower.php');
              }else{
                  _close();
                 // _session_destroy();
                  _alert_back('赞信息删除失败');
              }
      }else{
          _alert_back('非法登录');
      }
  }
  
  global $_pagesize,$_pagenum;
  //分页模块函数的调用,此函数为分页函数的参数函数
  _page("select f_id from f_flower where f_touser = '{$_COOKIE['username']}'",8);    //第一个参数获取总条数，第二个参数指定每页多少条
  //从数据库里提取数据获取结果集
  //必须是没词重新读取结果集，而不是重新执行SQL语句，会造成死循环，只有第一条数据
  $_result = _query("select f_id,f_flower,f_fromuser,f_content,f_date from f_flower where f_touser = '{$_COOKIE['username']}' order by f_date desc limit $_pagenum,$_pagesize");
  
?>


<!DOCTYPE html>
<html>
<head>
<title>点赞列表</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/member_message.css" />
<script type="text/javascript" src="JS/member_message.js"></script>
</head>
<body style=margin:0;background-color:#291414;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<p align=center>
<a href=member.php><h14><?php echo $_COOKIE['username']?>的个人中心</h14></a>
</p>
<div id="member">
    <?php 
        require 'includes/member.inc.php';
    ?>
    <div id="member_main">
        <h2>点赞管理</h2>
        <form method="post" action="?action=delete">
        <table cellspacing="2">
            <tr height=60px><th width=120px>点 赞 人</th><th width=140px>点 赞 数 量</th><th width=150px>点 赞 时 间</th><th width=260px>附 带 内 容</th><th width=40px>操作</th></tr>
            <?php 
            
                      $_html = array();
                while(!!$_rows = _fetch_array_list($_result)){
                      //此处过滤用户名和性别信息
                      $_html['id'] = $_rows['f_id'];
           
                      $_html['fromuser'] = $_rows['f_fromuser'];
                      $_html['content'] = $_rows['f_content'];
                      $_html['flower'] = $_rows['f_flower'];
                      $_html['date'] = $_rows['f_date'];
                      $_html = _html($_html);
                      @$_html['count'] += $_html['flower'];
            ?>
            <tr height=50px><td><?php echo $_html['fromuser']?></td><td><img src=pic/newuser/zan2.jpg width=34px height=34px alt="赞" title="赞" /><?php echo $_html['flower']?>&nbsp&nbsp赞</td><td><?php echo $_html['date']?></td><td title="<?php echo $_html['content']?>"><?php echo _title($_html['content'],16)?></td><td><input name="ids[]" type="checkbox" value="<?php echo $_html['id']?>" /></td></tr>            
            
            <?php
                }
                _free_result($_result);
            ?>
            <tr><td colspan="5"><b>共收到<?php echo @$_html['count']?>个赞</b></td></tr>
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