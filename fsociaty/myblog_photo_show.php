<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
//  require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', myblog_photo_show);
  
  session_start();
  
  //删除相片
  if(@$_GET['action'] == 'delete' && isset($_GET['id'])){
      if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
          
          //取得这张图片的发布者
              if(!!$_rows = _fetch_array("select f_username,f_url,f_id,f_sid from f_photo where f_id='{$_GET['id']}' limit 1")){
                  $_html = array();
                  $_html['username'] = $_rows['f_username'];
                  $_html['url'] = $_rows['f_url'];
                  $_html['id'] = $_rows['f_id'];
                  $_html['sid'] = $_rows['f_sid'];
                  
                  $_html = _html($_html);
                  
                  //判断删除图片的身份是否合法
                  if(($_html['username'] == $_COOKIE['username']) || isset($_SESSION['admin'])){
                      
                      //首先删除图片的数据库信息
                      _query("delete from f_photo where f_id='{$_html['id']}'");
                              if(_affected_rows() == 1){
                                      //删除图片及其物理地址
                                      if(file_exists($_html['url'])){
                                          //执行删除操作
                                          unlink($_html['url']);
                                      }else{
                                          _alert_back('磁盘已不存在此图片');
                                      }
                                  _close();
                                  _location('删除成功', 'myblog_photo_show.php?id='.$_html['sid']);
                              }else{
                                  //数据库关闭函数
                                  _close();
                                  _alert_back('删除失败');
                              }
              }else{
                  _alert_back('不存在此图片');
              }
          }else{
              _alert_back('非法操作');
          }
      }else{
          _alert_back('非法登录');
      }
  }
  
  
  
  
//   //修改相片
//   if(@$_GET['action'] == 'modify' && isset($_GET['id'])){
//       if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
//           //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
//           _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
//           include_once 'includes/check.func.php';
//           //取得这张图片的发布者
//               $_clean = array();
//               $_clean['url'] = $_POST['f_url'];
//               $_clean['name'] = $_POST['f_name'];
//               $_clean['content'] = $_POST['f_content'];
  
//               $_clean = _mysql_string($_clean);
  
//               //判断删除图片的身份是否合法
//               if(($_html['username'] == $_COOKIE['username']) || isset($_SESSION['admin'])){
  
//                   //首先删除图片的数据库信息
//                   _query("update f_photo set f_name='{$_clean['name']}',f_url='{$_clean['url']}',f_content='{$_clean['content']}' where f_id='{$_html['id']}'");
//                if(_affected_rows() == 1){
//               _close();
//               _location('相片修改成功', 'myblog_photo.php');
//           }else{
//               _close();
//               _alert_back('相片修改失败');
//           }
//               }else{
//                   _alert_back('不存在此图片');
//               }
//           }else{
//               _alert_back('非法操作');
//           }
//       }else{
//           _alert_back('非法登录');
//   }
  
  
  
  
  //取值
  if(@isset($_GET['id'])){
      if(!!$_rows = _fetch_array("select f_id,f_name,f_type from f_dir where f_id='{$_GET['id']}' limit 1")){
          $_dirhtml = array();
          $_dirhtml['id'] = $_rows['f_id'];
          $_dirhtml['name'] = $_rows['f_name'];
          $_dirhtml['type'] = $_rows['f_type'];
          
          $_dirhtml = _html($_dirhtml);
          
          //对比加密相册的验证信息
          if(@$_POST['password']){
              if(!!$_rows = _fetch_array("select f_id from f_dir where f_password='".sha1($_POST['password'])."' limit 1")){
                  //验证铜通过
                  setcookie('photo'.$_dirhtml['id'],$_dirhtml['name']);
                  //生成cookie后重定向,因为cookie会慢一拍,让其再跳转一次
                  _location(null, 'myblog_photo_show.php?id='.$_dirhtml['id']);
                  
              }else {
                  _alert_back('相册密码不正确');
              }
          }
          
      }else{
          _alert_back('不存在此相册目录');
      }
  }else{
      _alert_back('非法操作');  //ID不存在
  }
  
  if(!isset($_COOKIE['username'])){
      _location('请登录查看', 'login.php');
  }
      
   // _manage_login();  
    
    //读取数据
    
  

  
  
  //判断是否正常登陆
  global $_pagesize,$_pagenum,$_page,$_id;
  $_id = 'id='.$_dirhtml['id'].'&';    //此处借鉴article页面的做法，由于此处的page会冲掉id的值，因此间$_html['id']的值加上一个连接符，可以连续有效的传输id和page值
  
  _page("select f_id from f_photo where f_sid='{$_dirhtml['id']}'",10);
  $_result = _query("select f_id,f_username,f_url,f_name,f_readcount,f_commendcount from f_photo where f_sid='{$_dirhtml['id']}' order by f_date desc limit $_pagenum,$_pagesize");
  
  
  //select * from f_article left join f_user on f_user.f_username=f_article.f_username 
  
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
<script type="text/javascript" src="JS/article.js"></script>
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<?php include_once 'includes/myblog_inc.php';?>

<div class="user1">
<h><span><a href="myblog_photo_add_img.php?id=<?php echo $_dirhtml['id']?>">【 上传图片 】&nbsp&nbsp&nbsp</a> 【 相 册 展 示 】 </span><?php echo @$_COOKIE['username']?> &nbsp&nbsp|&nbsp&nbsp <?php echo $_htmlauto['auto']?></h>
</div>

<div id="middle">

<?php      
echo '<p style=text-align:center;>【 '.$_dirhtml['name'].' 】<a href="myblog_photo_add_img.php?id='.$_dirhtml['id'].'">【 上 传 图 片 】</a></p>';
    //$_html1 = _query("select f_id from f_article where f_username='{$_COOKIE['username']}'");
?>

<?php 
    if(empty($_dirhtml['type']) || @$_COOKIE['photo'.$_dirhtml['id']] == $_dirhtml['name'] || @isset($_SESSION['admin'])){

        
?>

<?php     $_html = array();
        while(!!$_rows = _fetch_array_list($_result)){
            //此处过滤用户名和性别信息
            $_html['id'] = $_rows['f_id'];
            $_html['username'] = $_rows['f_username'];
            $_html['name'] = $_rows['f_name'];
            $_html['url'] = $_rows['f_url'];
            $_html['readcount'] = $_rows['f_readcount'];
            $_html['commendcount'] = $_rows['f_commendcount'];
            
            $_html = _html($_html);
            
?>
    <dl class="photogo1">
        <dt><a href="photo_detail.php?id=<?php echo $_html['id']?>"><img src="<?php echo $_html['url']?>" alt="未处理" /></a></dt>
        <dd><a href="photo_detail.php?id=<?php echo $_html['id']?>"><?php echo $_html['name']?></a></dd>
        <dd> 阅读(<?php echo $_html['readcount']?>) 评论(<?php echo $_html['commendcount']?>)  </dd>
        <dd class="sun"> 上传者 :<?php echo $_html['username']?> </dd>
        <dd><?php if(($_html['username'] == $_COOKIE['username']) || isset($_SESSION['admin'])){?> 【<a href="myblog_photo_show.php?action=modify&id=<?php echo $_html['id']?>"></a>】 【<a href="myblog_photo_show.php?action=delete&id=<?php echo $_html['id']?>">删 除</a>】 <?php }?></dd>
    </dl>
<?php }?>
    
     <?php
        _free_result($_result);
        _paging(2);
     ?>
     
     
     <?php }else{
         echo '<br><br><br><br><br><br>';
                        echo '<form method="post" action="myblog_photo_show.php?id='.$_dirhtml['id'].'">';
                        echo '<p style=text-align:center;>请输入密码 : <input type="password" name="password" /> <input type="submit" value="确定" /></p>';
                        echo '</form>';
     
     
     }?>
      <br><br><br><br>    

</div>


<br><br><br><br>
</body>
</html>


<?php 
    include_once 'includes/footer.inc.php';
?>
