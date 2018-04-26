<?php 
    define('chang',1990);   //防止非法调用
    @define('SCRIPT','article');   //分页函数的文件名会用到
    require 'includes/connin.inc.php';
    require 'includes/timeheader.php';
  //  require 'includes/func.inc.php';   //此处调用公共函数文件
    require 'includes/mysqlname.inc.php';   //为防止footer中_close函数报错二调用此文件
    global $_date;
    global $_system;
    session_start();
    header("Content-Type:text/html; charset=utf-8");
    
    //打印出文件名,为后面的封装调用分页函数做铺垫
    
    //判断是否登录
//     if(!isset($_COOKIE['username'])){
//         _alert_close('请先登录');
//     }
    
    //处理精华帖
    if(@$_GET['action'] == 'nice' && @isset($_GET['id']) && @isset($_GET['on'])){
        if(!!$_rows = @_fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
            //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
            _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
            
            //设置精华博客或者取消精华
            _query("update f_article set f_nice='{$_GET['on']}' where f_id='{$_GET['id']}'");
            if(_affected_rows() == 1){
                _close();
                _location('精华操作成功', 'article.php?id='.$_GET['id']);
            }else{
                _close();
                _alert_back('精华操作失败，请联系开发组');
            }
            
            
        }else{
            _alert_back('非法登录');
        }
    }
    
    
    //处理删除主题博客
    if(@$_GET['action'] == 'deletearticle'){
    
    
        if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
            //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
            _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
            
            _query("delete from f_article where f_id='{$_GET['id']}'");
            if(_affected_rows() == 1){
                _close();
                _location('删除主题博客成功', 'index.php');
            }else{
                _close();
                _alert_back('删除失败，请联系开发组');
            }
            
            }else{
                _alert_back('非法登录');
            }
        }
        
        
        
        //处理删除回帖
        if(@$_GET['action'] == 'deletetalk'){
        
        
            if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
                //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
                _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
        
                _query("delete from f_article where f_reid='{$_GET['id']}' and f_username='{$_COOKIE['username']}'");
                if(_affected_rows() == 0){
                    _alert_back('非法登录');
                    
                }else{
                   _close();
                    @_location('删除回复成功', 'article.php?id='.$_clean['reid']);
                }
        
            }else{
                _alert_back('非法登录');
            }
        }
    
    
    
    //处理回帖
    if(@$_GET['action'] == 'rearticle'){
        
        @_check_code($_POST['code'],$_SESSION['code']);
        
        if(!!$_rows = _fetch_array("select f_uniqid,f_article_time from f_user where f_username='{$_COOKIE['username']}' limit 1")){
            //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
            _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
            
            _timed(time(), @$_rows['f_article_time'], $_system['re']);
            
            include 'includes/check.func.php';
            //接收数据
            $_clean = array();
            $_clean['reid'] = $_POST['reid'];
            $_clean['type'] = $_POST['type'];
            $_clean['title'] = _check_post_title($_POST['title'],2,80);
            $_clean['content'] = _check_post_content($_POST['content'],1);
            $_clean['username'] = $_COOKIE['username'];
            $_clean = _mysql_string($_clean);
            //写入数据库
           _query("insert into f_article(f_reid,f_username,f_title,f_type,f_content,f_date) values('{$_clean['reid']}','{$_clean['username']}','{$_clean['title']}','{$_clean['type']}','{$_clean['content']}',NOW())");
                
                if(_affected_rows() == 1){
                    //setcookie('article_time',time());
                    $_clean['time'] = time();
                    _query("update f_user set f_article_time='{$_clean['time']}' where f_username='{$_COOKIE['username']}'");
                    _query("update f_article set f_commendcount=f_commendcount+1 where f_reid=0 and f_id='{$_clean['reid']}'");
                    //数据库关闭函数
                    _close();
                    //清空，不让服务器负担过重
                    //_session_destroy();
                    //跳转到首页
                    _location('回复博客成功', 'article.php?id='.$_clean['reid']);
                }else{
                    //数据库关闭函数
                    _close();
                    //清空，不让服务器负担过重
                    //_session_destroy();
                    //跳转到首页
                    _alert_back('回复博客失败');
                }
        }else{
            _alert_back('非法登录');
        }
    }
    
    //读出数据
    if(isset($_GET['id'])){
        if(!!$_rows = _fetch_array("select f_id,f_username,f_nice,f_title,f_type,f_content,f_readcount,f_commendcount,f_last_modify_date,f_date from f_article where f_reid=0 and f_id='{$_GET['id']}'")){
            //存在操作
            
            //累计阅读量
            _query("update f_article set f_readcount=f_readcount+1 where f_id='{$_GET['id']}'");
            
            
            $_html = array();
            $_html['reid'] = $_rows['f_id'];
            $_html['username_subject'] = $_rows['f_username'];
            $_html['title'] = $_rows['f_title'];
            $_html['type'] = $_rows['f_type'];
            $_html['content'] = $_rows['f_content'];
            $_html['readcount'] = $_rows['f_readcount'];
            $_html['nice'] = $_rows['f_nice'];
            $_html['commendcount'] = $_rows['f_commendcount'];
            $_html['last_modify_date'] = $_rows['f_last_modify_date'];
            $_html['date'] = $_rows['f_date'];
            
            //取出用户名来查找用户信息
            if(!!$_rows = _fetch_array("select f_id,f_sex,f_email,f_url,f_switch,f_autograph from f_user where f_username='{$_html['username_subject']}'")){
                
                //提取用户信息
                $_html['userid'] = $_rows['f_id'];
                $_html['sex'] = $_rows['f_sex'];
                $_html['email'] = $_rows['f_email'];
                $_html['url'] = $_rows['f_url'];
                $_html['switch'] = $_rows['f_switch'];
                $_html['autograph'] = $_rows['f_autograph'];
                
                $_html = _html($_html);
                
                
                //创建一个全局变量，做个带参的分页
                //因为在分页后，url栏会显示page=xx页数，而id会被冲掉，所以要求做一个全局的id在url和cookie(前面判断cookie值用来判断非法操作)里显示
                global $_id;
                $_id = 'id='.$_html['reid'].'&';
                
                //主题帖的修改,管理员和发布者
                if($_html['username_subject'] == @$_COOKIE['username'] || isset($_SESSION['admin'])){
                    $_html['subject_modify'] = '<a href="article_modify.php?id='.$_html['reid'].'"> 【修改】&nbsp&nbsp&nbsp </a>';
                }
                
         
                
                
                
                //对主题帖的删除,管理员和发布者
                if($_html['username_subject'] == @$_COOKIE['username'] || isset($_SESSION['admin'])){
                    $_html['subject_delete'] = '<a href="article.php?action=deletearticle&id='.$_html['reid'].'"> 【删除】&nbsp&nbsp&nbsp </a>';
                }
                
                

                //读取最后修改信息
                if($_html['last_modify_date'] != '0000-00-00 00:00:00'){
                    $_html['last_modify_date_string'] = '本博客由博主 【  '.$_html['username_subject'].' 】 于'.$_html['last_modify_date'].'修改';
                }
                
                //给楼主回复，必须要登录
               // if(@$_COOKIE['username']){
                //}
                
                //签名显示
                if($_html['switch'] == 1){
                    $_html['autograph_html'] = '<p class="autograph">'.$_html['autograph'].'</p>';
                }
                
                //读取回帖
                global $_pagesize,$_pagenum,$_page;
                _page("select f_id from f_article where f_reid='{$_html['reid']}'",10);    //第一个参数获取总条数，第二个参数指定每页多少条
                $_result = _query("select f_username,f_type,f_title,f_content,f_date from f_article where f_reid='{$_html['reid']}' order by f_date asc limit $_pagenum,$_pagesize");
                
                $_i = 2;
                //楼层
                if($_page == 1 && $_i == 2){
                    if(@$_html['username'] == $_html['username_subject']){
                    @$_html['username_html']     .= @$_html['username'].'[楼主]';
                    }else {
                        @$_html['username_html'] .= @$_html['username'].'[沙发]';
                    }
                }else{
                    @$_html['username_html']     .= @$_html['username'];
                }
                
            }else {
                //此用户已被删除的操作
            }
        }else{
            _alert_back('不存在此主题');
        }
    }else{
        _alert_back('非法操作');
    }
    
?>

<!DOCTYPE html>
<html>
<head>
<title>博客详情</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/article.css" />
<script type="text/javascript" src="JS/article.js"></script>
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<div id=article>
    <br>
    <h2>博客详情</h2>
    
    <?php
        //if($_page == 1){
    ?>
    
       <div id="subject">
           <h>
          
             <dl>
                <dd class=user id="用户">博主 : <?php echo $_html['username_subject']?>(<?php echo $_html['sex']?>)</dd>
                <dt><img src=pic/heng6.jpg alt="<?php echo $_html['sex']?>" width=150px /></dt>
                <dd><h name="friend"><a onclick="javascript:window.open('friend.php?id=<?php echo @$_html['id']?>','friend','width=400,height=300')" name=friend title="<?php echo @$_html['id']?>"><img src=pic/newuser/friend1.png width=18px height=20px />加为好友</a></h>&nbsp&nbsp&nbsp&nbsp<h name=message><a onclick="javascript:window.open('message.php?id=<?php echo @$_html['id']?>','message','width=400,height=300')" name=message title="<?php echo @$_html['id']?>"><img src=pic/newuser/message.jpg width=18px height=20px />发送消息</a></dd></h>
                <dd><img src=pic/newuser/guest.jpg width=18px height=20px />给他留言&nbsp&nbsp&nbsp&nbsp<h name="flower"><a onclick="javascript:window.open('flower.php?id=<?php echo @$_html['id']?>','flower','width=400,height=300')" name=flower title="<?php echo @$_html['id']?>"><img src=pic/newuser/zan2.jpg width=20px height=20px />为他点赞</a></dd>
                <dd style=width:170px;text-align:left;margin:0;text-indent:5px;>邮件 : <a href="mailto:<?php echo $_html['email']?>" target=_blank><?php echo $_html['email']?></a></dd>
                <dd style=width:170px;text-align:left;margin:0;text-indent:5px;>网址 : <a href="<?php echo $_html['url']?>" target=_blank><?php echo $_html['url']?></a></dd>
            </dl>
                </h>
    </div>
    
    <div id=content>
        <div class="user1">
            <h><span><?php echo @$_html['subject_modify']?><?php echo @$_html['subject_delete'];?>博 主</span><?php echo @$_html['username_subject']?> &nbsp&nbsp|&nbsp&nbsp 发表于 : <?php echo $_html['date']?><span><?php if(empty($_html['nice'])){?><?php if(!empty($_SESSION['admin'])){?><a href="article.php?action=nice&on=1&id=<?php echo $_html['reid']?>">【设置精华】</a><?php }?><?php }else{ echo '<a href="article.php?action=nice&on=0&id='.$_html['reid'].'">【取消精华】</a>';}?><a href="#ree" name="re" title="回复1楼的<?php echo @$_html['username']?>">【 回复 】</a></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php if($_html['readcount'] >= 200 || $_html['commendcount'] >= 20){//浏览量达到200且评论达到20位精品 ?><img src="pic/ubb/a1.jpg" title="精品" alt="精品" width=4% /><?php }?></h>
        </div>
    </div>
    
    <div id=article1>
    <h3>TITLE ：<?php echo $_html['title']?> <img alt="文章" src="pic/music/<?php echo $_html['type']?>.jpg" width=40px height=40px style=line-height:30px />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php if(!empty($_html['nice'])){?><img src=faceend/002.jpg width=40px height=40px style=line-height:30px /><?php }?></h3>
        <div class="detail">
          <?php echo _ubb($_html['content'])?>
          <?php echo @$_html['autograph_html']?>
          <div class="read">
          <br><br>
          <p><?php echo @$_html['last_modify_date_string']?></p>
                                        阅读：(<?php echo $_html['readcount']?>) &nbsp&nbsp&nbsp评论：(<?php echo $_html['commendcount']?>)
          </div>
        </div>
        <p class="line"></p>
        
                <?php //}?>
        
        <h3>评&nbsp&nbsp&nbsp 论 (<?php echo $_html['commendcount']?>)</h3>
                <?php 
                //原来$_i定义在此处，为避免沙发的未定义问题，转而将其定义在顶部
                    while(!!$_rows = _fetch_array_list($_result)){
                        $_html['username'] = $_rows['f_username'];
                        $_html['type'] = $_rows['f_type'];
                        $_html['retitle'] = $_rows['f_title'];  //为了防止下方value值的title出现重复循环，设置为retitle来定义主题
                        $_html['content'] = $_rows['f_content'];
                        $_html['date'] = $_rows['f_date'];
                        $_html = _html($_html);
                       
                        $_SESSION['date'] = $_html['date'];     //此处为做单条数据的修改
                       
               
        ?>
        <div class="ree">
        <?php                 
                //回复帖子的修改
                if(@$_html['username'] !== @$_COOKIE['username']){
               
        ?>
         <h><span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $_i + (($_page-1)*$_pagesize)?> L</span><?php echo $_html['username']?>&nbsp | &nbsp发表于 : <?php echo $_html['date']?> <?php if(@$_COOKIE['username']){?><span><a href="#ree" name="re" title="回复<?php echo $_i + (($_page-1) * $_pagesize)?>楼的<?php echo @$_html['username']?>">【 回复 】</a></span><?php }?></h>
         <?php }else{
            // echo $_html['subject_deletetalk'];
                ?>
                <h><span><?php //echo $_html['subject_last'].'&nbsp&nbsp&nbsp&nbsp'?><?php echo $_i + (($_page-1)*$_pagesize)?> L</span><?php echo $_html['username']?>&nbsp | &nbsp发表于 : <?php echo $_html['date']?></h>
         <?php }?>
          <?php 
                    //对回复的删除,管理员和发布者
                if($_html['username'] == @$_COOKIE['username'] || isset($_SESSION['admin'])){
                    $_html['subject_deletetalk'] = '<a href="article.php?action=deletetalk&id='.$_html['reid'].'"> 【删除】&nbsp&nbsp&nbsp </a>';
                echo $_html['subject_deletetalk'];
                }?>
         <h6 id=hate></h6>
        
           <table style=border-collapse:collapse; border="1">
              <tr>
              
                <th class="late"><img src=pic/newuser/friend1.png width=16px height=16px /><a name="friend" onclick="javascript:window.open('friend.php?id=<?php echo @$_html['id']?>','friend','width=400,height=300')" name=friend title="<?php echo @$_html['id']?>">加为好友</a></th>
                <th><img src=pic/newuser/message.jpg width=16px height=16px /><a name=message onclick="javascript:window.open('message.php?id=<?php echo @$_html['id']?>','message','width=400,height=300')" name=message title="<?php echo @$_html['id']?>">发送消息</a></h4></th>
                <th>主 题 :<?php echo $_html['retitle']?></th>
              </tr>
              <tr></tr>
              <tr>
                <th><a><img src=pic/newuser/guest.jpg width=16px height=16px />给他留言 </a></th>
                <th><a name="flower" onclick="javascript:window.open('flower.php?id=<?php echo @$_html['id']?>','flower','width=400,height=300')" name=flower title="<?php echo @$_html['id']?>"><img src=pic/newuser/zan2.jpg width=16px height=16px />为他点赞</a></th>
                <th class="latelast" style=font-weight:normal;>评 论 : <?php echo $_html['content']?></th>
              </tr>
        </table>

        <p class="autograph1">
            <?php
              $_html3 = array();
              if(!!$_rows3 = _fetch_array("select f_id,f_sex,f_email,f_url,f_switch,f_autograph from f_user where f_username='{$_html['username']}'")){
                  $_html3['switch'] = $_rows3['f_switch'];
                  $_html3['autograph'] = $_rows3['f_autograph'];
                  if($_html3['switch'] == 1){
                    echo 'Autograph : '._ubb($_html3['autograph']);
                  }
                     }
                     
                     ?> 
                     </p>
        </div>

                <?php 
                //注意这是在循环内部
                $_i ++; //每循环一次，累计一次
                
                    }
            _free_result($_result);
            _paging(2);
                    ?>
        
        <p class="line"></p>
        
        <?php if(isset($_COOKIE['username'])){  //此处判断登录用户才能有回复界面?>
        
          <a name="ree"></a>
        <form method="post" action="?action=rearticle">
          <input type="hidden" name="reid" value="<?php echo $_html['reid']?>" />
          <input type="hidden" name="type" value="<?php echo $_html['type']?>" />
          <dl>
            <br><br>
                <dd align=center;><h><h6>F o r ： <input type="text" name="title" class="text" value="TO : <?php echo $_html['title']?>" maxlength=80 size=40 />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp( 2 - 80 位 )</h6></h></dd>
            
            <dd>
            <?php
                include 'includes/ubb.inc.php'; //此处调用ubb界面
            ?>
            <textarea name="content" rows="28"></textarea>
            </dd>
            <?php if(!empty($_system['code'])){?>
            <dd style=text-indent:40px;>验证码：&nbsp&nbsp<input name=code type=text size=12 maxlength=14>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="code.php" id=code onclick="javascript:this.src='code.php?tm='+Math.random()" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</dd><br><br>	<!--此处使用了JS的随机-->
            <?php }?>
            <br><br>
            <dd>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type=submit value="发表" class=sub style="background:#323533;color:#ccc" /></dd><br><br><br><br><br>
                
          </dl>
        </form>
        
        <?php }?>
                                                     <div id=footer3>   
                                                            版权所有 翻版必究  未经Ferre授权不得转载本站内所有信息<br>
                                                    本站由<font color=blue>&copyFerre</font>提供技术支持，请勿在它处引用,否则将承担法律责任<br>
                                                   注册商标12006 &reg<br>
                                                    CopyRight &copy 2016-2030 All Rights Reserved
                                                    </div>
    </div>
</div>
</body>
</html>

