<?php
  define('chang',1990);
  require 'includes/connin.inc.php';
  require 'includes/timeheader.php';
  require 'includes/mysqlname.inc.php';
//  require 'includes/func.inc.php';
  header("Content-Type:text/html; charset=utf-8");
  @define('SCRIPT', photo_detail);
  
  session_start();
  
  //评论
  if(@$_GET['action'] == 'rephoto'){
      _check_code($_POST['code'],$_SESSION['code']);
      
      if(!!$_rows = _fetch_array("select f_uniqid,f_article_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
          //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
          _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
        
          include 'includes/check.func.php';
        //接收数据
          $_clean = array();
          $_clean['sid'] = $_POST['sid'];
          $_clean['title'] = _check_post_title($_POST['title'],2,80);
          $_clean['content'] = _check_post_content($_POST['content'],1);
          $_clean['username'] = $_COOKIE['username'];
          $_clean = _mysql_string($_clean);
      
          //写入数据库
          _query("insert into f_photo_commend(f_sid,f_username,f_title,f_content,f_date) values('{$_clean['sid']}','{$_clean['username']}','{$_clean['title']}','{$_clean['content']}',NOW())");
          
          if(_affected_rows() == 1){
              _query("update f_photo set f_commendcount=f_commendcount+1 where f_id='{$_clean['sid']}'");
              _close();
              _location('评论相片成功', 'photo_detail.php?id='.$_clean['sid']);
              }else{
                  _close();
                  _alert_back('评论失败');
              }
          }else{
          _alert_back('非法登录');
      }
  }
  
  //取值
  if(@isset($_GET['id'])){
  if(!!$_rows = _fetch_array("select f_id,f_sid,f_name,f_url,f_username,f_readcount,f_commendcount,f_date,f_content from f_photo where f_id='{$_GET['id']}' limit 1")){
      
      //防止加密相册图片穿插访问
      //可以先取得图片的sid,也就是目录ID，然后再判断这个目录是否是加密的，若是加密的，再判断是否有对应的COOKIE存在，并且等于相应的值
      //管理员不受这个限制
      
      if(!isset($_SESSION['admin'])){
      if(!!$_dirs = _fetch_array("select f_id,f_name,f_type from f_dir where f_id={$_rows['f_sid']}")){
          if(!empty($_dirs['f_type']) && $_COOKIE['photo'.$_dirs['f_id']] != $_dirs['f_name']){
              _alert_back('非法操作');
          }
      }else{
          _alert_back('相册目录表出错，请联系开发组');
      }
      }
      
      //累计阅读量
      _query("update f_photo set f_readcount=f_readcount+1 where f_id='{$_GET['id']}'");
      $_html = array();
      
          
          $_html['id'] = $_rows['f_id'];
          $_html['name'] = $_rows['f_name'];
          $_html['url'] = $_rows['f_url'];
          $_html['username'] = $_rows['f_username'];
          $_html['readcount'] = $_rows['f_readcount'];
          $_html['commendcount'] = $_rows['f_commendcount'];
          $_html['date'] = $_rows['f_date'];
          $_html['content'] = $_rows['f_content'];
          $_html['sid'] = $_rows['f_sid'];
          
          $_dirhtml = _html($_html);
          
          
          $_id = 'id='.$_html['id'].'&';
          
          //读取评论
          global $_pagesize,$_pagenum,$_page,$_id;
          _page("select f_id from f_photo_commend where f_sid='{$_html['id']}'",6);    //第一个参数获取总条数，第二个参数指定每页多少条
          $_result = _query("select f_username,f_title,f_content,f_date from f_photo_commend where f_sid='{$_html['id']}' order by f_date asc limit $_pagenum,$_pagesize");
          
          //上一页，取得比自己大的ID，中最小的那个
          $_html['preid'] = _fetch_array("select min(f_id) as id from f_photo where f_sid='{$_html['sid']}' and f_id>'{$_html['id']}' limit 1");
          
          if(!empty($_html['preid']['id'])){
              $_html['pre'] = '<a class="photogai" href="photo_detail.php?id='.$_html['preid']['id'].'#pre">';
          }else{
              $_html['pre'] = '<span>这是最上方的图片</span>';
          }
          
          //下一页，取得比自己小的ID中，最大的哪一个
          $_html['nextid'] = _fetch_array("select max(f_id) as id from f_photo where f_sid='{$_html['sid']}' and f_id<'{$_html['id']}' limit 1");
          
          if(!empty($_html['nextid']['id'])){
              $_html['nextid'] = '<a class="photogai" href="photo_detail.php?id='.$_html['nextid']['id'].'#next">';
          }else{
              $_html['nextid'] = '<span>这是最下方的图片</span>';
          }
          
          
      }else{
          _alert_back('不存在此图片');
      }
  }else{
      _alert_back('非法操作');  //ID不存在
  }
  
//   if(!isset($_COOKIE['username'])){
//       _location('请登录查看', 'login.php');
//   }
      
  //select * from f_article left join f_user on f_user.f_username=f_article.f_username 
  
      //判断是否有$_rows数据，来防止假冒COOKIE

      $_auto = @_fetch_array("select f_autograph from f_user where f_username='{$_COOKIE['username']}'");
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
<h><span><?php echo @$_html['subject_modify']?>博 主</span><?php echo @$_html['username_subject']?> &nbsp&nbsp|&nbsp&nbsp 发表于 : <?php echo $_html['date']?><?php if(@$_COOKIE['username']){?><span><a href="#ree" name="re" title="回复1楼的<?php echo @$_html['username']?>">【 回复 】</a></span><?php }?></h>
</div>

<div id="middle" class="middle11">

<?php      
echo '<p style=text-align:center;><b> 【 '.$_html['name'].' 】</b></p>';
?>
<a name="pre"></a><a name="next"></a>
    <dl class="photogo11">
        <dd><?php echo $_html['pre']?>上一页</a><img src="<?php echo $_html['url']?>" alt="可以" /><?php echo $_html['nextid']?>下一页</a></dd>
        <dd>【<a href="myblog_photo_show.php?id=<?php echo $_html['sid']?>">返回列表</a>】 : </dd>
        <dd>访问 (<?php echo $_html['readcount']?>) 评论 (<?php echo $_html['commendcount']?>) </dd>
        <dd>上传者(<?php echo $_html['username']?>) </dd>
        <dd>发表于 : (<?php echo $_html['date']?>)</dd>
        <dd>简介 : (<?php echo $_html['content']?>)</dd>
    
    </dl>
    
    <?php 
    $_i = 1;
                //原来$_i定义在此处，为避免沙发的未定义问题，转而将其定义在顶部
                    while(!!$_rows = _fetch_array_list($_result)){
                        $_html['username'] = $_rows['f_username'];
                        $_html['retitle'] = $_rows['f_title'];  //为了防止下方value值的title出现重复循环，设置为retitle来定义主题
                        $_html['content'] = $_rows['f_content'];
                        $_html['date'] = $_rows['f_date'];
                        $_html = _html($_html);
                       
                       
                        if(!!$_rows = @_fetch_array("select f_id,f_sex,f_email,f_url,f_switch,f_autograph from f_user where f_username='{$_html['username_subject']}'")){
                        
                            //提取用户信息
                            $_html['userid'] = $_rows['f_id'];
                            $_html['sex'] = $_rows['f_sex'];
                            $_html['email'] = $_rows['f_email'];
                            $_html['url'] = $_rows['f_url'];
                            $_html['switch'] = $_rows['f_switch'];
                            $_html['autograph'] = $_rows['f_autograph'];
                        
                            $_html = _html($_html);
                            
                            }else {
                                //此用户已被删除的操作
                            }
               
        ?>
    
    
       <div id="subject">
           <h>
          
             <dl>
                <dd class=user id="用户">博主 : <?php echo @$_html['username']?>(<?php echo @$_html['sex']?>)</dd>
                <dt><img src=pic/heng6.jpg width=190px; height=160px; alt="<?php echo @$_html['sex']?>" width=150px /></dt>
                <dd><h name="friend"><a onclick="javascript:window.open('friend.php?id=<?php echo @$_html['id']?>','friend','width=400,height=300')" name=friend title="<?php echo @$_html['id']?>"><img src=pic/newuser/friend1.png width=18px height=20px />加为好友</a></h>&nbsp&nbsp&nbsp&nbsp<h name=message><a onclick="javascript:window.open('message.php?id=<?php echo @$_html['id']?>','message','width=400,height=300')" name=message title="<?php echo @$_html['id']?>"><img src=pic/newuser/message.jpg width=18px height=20px />发送消息</a></dd></h>
                <dd><img src=pic/newuser/guest.jpg width=18px height=20px />给他留言&nbsp&nbsp&nbsp&nbsp<h name="flower"><a onclick="javascript:window.open('flower.php?id=<?php echo @$_html['id']?>','flower','width=400,height=300')" name=flower title="<?php echo @$_html['id']?>"><img src=pic/newuser/zan2.jpg width=20px height=20px />为他点赞</a></dd>
                <dd style=width:170px;text-align:left;margin:0;text-indent:5px;>邮件 : <a href="mailto:<?php echo @$_html['email']?>" target=_blank><?php echo @$_html['email']?></a></dd>
                <dd style=width:170px;text-align:left;margin:0;text-indent:5px;>大图 : <a href="<?php echo @$_html['url']?>" target=_blank><?php echo @$_html['url']?></a></dd>
            </dl>
                </h>
    </div>
    
    <div id=content>
    </div>
    
    <div id=article1>
        <div class="detail">
          <?php echo @$_html['autograph_html']?>
          <div class="read">
          <br><br>
          <p><?php echo @$_html['last_modify_date_string']?></p>
          </div>
        </div>
    
   
    
    
            <h6 id=hate></h6>
            <h><span><?php //echo $_html['subject_last'].'&nbsp&nbsp&nbsp&nbsp'?></span><?php echo $_html['username']?>&nbsp | &nbsp发表于 : <?php echo $_html['date']?></h>
           <table style=border-collapse:collapse; border="1">
              <tr>
                <th class="late"><img src=pic/newuser/friend1.png width=16px height=16px /><a name="friend" onclick="javascript:window.open('friend.php?id=<?php echo @$_html['id']?>','friend','width=400,height=300')" name=friend title="<?php echo @$_html['id']?>">加为好友</a></th>
                <th><img src=pic/newuser/message.jpg width=16px height=16px /><a name=message onclick="javascript:window.open('message.php?id=<?php echo @$_html['id']?>','message','width=400,height=300')" name=message title="<?php echo @$_html['id']?>">发送消息</a></h4></th>
                <th>主 题 :<?php echo $_html['retitle']?></th>
              </tr>
              <tr></tr>
              <tr>
                <th><a><img src=pic/newuser/guest.jpg width=16px height=16px />给他留言</a></th>
                <th><a name="flower" onclick="javascript:window.open('flower.php?id=<?php echo @$_html['id']?>','flower','width=400,height=300')" name=flower title="<?php echo @$_html['id']?>"><img src=pic/newuser/zan2.jpg width=16px height=16px />为他点赞</a></th>
                <th class="latelast" style=font-weight:normal;>评 论 : <?php echo $_html['content']?></th>
              </tr>
        </table>
       
     <?php }?>
    
       <?php
        _free_result($_result);
        _paging(2);
     ?>
     <br>
     <br>
     <br>
       <dl class="rephoto">
       <?php if(!empty($_COOKIE['username'])){?>
          <form method="post" action="?action=rephoto">
          <input type="hidden" name="sid" value="<?php echo @$_html['id']?>" />
       
            <br><br>
                <dd align=center;>F o r ： <input type="text" name="title" class="text" value="TO : <?php echo @$_html['name']?>" maxlength=80 size=40 />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp( 2 - 80 位 )</dd>
            
            
            <br>
            <dd>
            <?php
                include_once 'includes/ubb.inc.php'; //此处调用ubb界面
            ?>
            <textarea name="content" rows="28"></textarea>
            </dd>
            <dd style=text-indent:40px;>验证码：&nbsp&nbsp<input name=code type=text size=12 maxlength=14>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="code.php" id=code onclick="javascript:this.src='code.php?tm='+Math.random()" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</dd><br><br>	<!--此处使用了JS的随机-->
            <br><br>
            <dd>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=submit value="发表" class=sub style="background:#323533;color:#ccc" /></dd><br><br><br><br><br>	<!--此处使用了JS的随机-->
     
            </form>
            <?php }?>
       </dl>

  
      <br><br><br><br>    

</div>


<br><br><br><br>
</body>
</html>


<?php 
    include_once 'includes/footer.inc.php';
?>
