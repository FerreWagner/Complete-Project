<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
//  require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', myblog_photo);
  
  session_start();
  
  //删除目录
  if(@$_GET['action'] == 'delete' && isset($_GET['id'])){
      if(!!$_rows = _fetch_array("select f_uniqid,f_article_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
        
          //删除目录
          if(!!$_rows = _fetch_array("select f_dir from f_dir where f_id='{$_GET['id']}' limit 1")){
              $_html = array();
              
              $_html['dir'] = $_rows['f_dir'];
              $_html = _html($_html);
              
              //3、删除磁盘的目录
              if(file_exists($_html['dir'])){
                  if(_removedir($_html['dir'])){
                      //1、删除目录里的数据库图片
                      _query("delete from f_photo where f_sid='{$_GET['id']}'");
                      //2、删除目录的数据库
                      _query("delete from f_dir where f_id='{$_GET['id']}'");
                      _close();
                      _location('目录删除成功','myblog_photo.php');
                  }else{
                      _close();
                      _alert_back('目录删除失败');
                  }
              }
              
          }else{
              _alert_back('不存在此目录');
          
              }
         
          
      }else{
          _alert_back('非法登录');
      }
  }
  
  
  
  if(!isset($_COOKIE['username'])){
      _location('请登录查看', 'login.php');
  }
      
   // _manage_login();  
    
    //读取数据
    
  
  //判断是否正常登陆
  global $_pagesize,$_pagenum,$_page;
  _page("select f_id from f_dir",4);
  $_result = _query("select f_id,f_name,f_face,f_type from f_dir order by f_date desc limit $_pagenum,$_pagesize");
  
  
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
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<?php include_once 'includes/myblog_inc.php';?>

<div class="user1">
<h><span><a href="myblog_photo_add_dir.php">【 添加目录 】&nbsp&nbsp&nbsp</a> 相 册 </span><?php echo @$_COOKIE['username']?> &nbsp&nbsp|&nbsp&nbsp <?php echo $_htmlauto['auto']?></h>
</div>

<div id="middle">

<?php      
echo '<p style=text-align:center;><a href="myblog_photo_add_dir.php">【 添 加 目 录 】</a></p>';
    //$_html1 = _query("select f_id from f_article where f_username='{$_COOKIE['username']}'");
?>
<?php 
            $_html = array();
        while(!!$_rows = _fetch_array_list($_result)){
            //此处过滤用户名和性别信息
            $_html['id'] = $_rows['f_id'];
            $_html['name'] = $_rows['f_name'];
            $_html['type'] = $_rows['f_type'];
            $_html['face'] = $_rows['f_face'];
            $_html = _html($_html);
            if(empty($_html['type'])){
                $_html['type_html'] = '(公开)';
            }else{
                $_html['type_html'] = '(私密)';
            }
            
            if(empty($_html['face'])){
                $_html['face_html'] = '';
            }else{
                $_html['face_html'] = '<img src="'.$_html['face'].'" alt="'.@$_html['name'].'">';
            }
            
            //统计相册里的照片数量
            $_html['photo'] = _fetch_array("select count(*) as count from f_photo where f_sid='{$_html['id']}'");
            
    ?>
    
    <dl class="photogo">
    
        <dt><a href="myblog_photo_show.php?id=<?php echo $_html['id']?>"><?php echo $_html['face_html']?></a></dt>
        <dd><a href="myblog_photo_show.php?id=<?php echo $_html['id']?>"><?php echo $_html['name']?> <?php echo '('.$_html['photo']['count'].')'?><?php echo $_html['type_html'];?></a></dd>
        <dd class="photosun">【<a href="myblog_photo_modify_dir.php?id=<?php echo $_html['id']?>">修改</a>】 【<a href="myblog_photo.php?action=delete&id=<?php echo $_html['id']?>">删除</a>】</dd>
    </dl>
    <?php }?>
     <?php _paging(2);?>
      <br><br><br><br>    

</div>


<br><br><br><br>
</body>
</html>


<?php 
    include_once 'includes/footer.inc.php';
?>
