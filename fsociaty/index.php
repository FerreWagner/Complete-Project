<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    
    define('chang',1990);   //防止非法调用
    
    if(PHP_VERSION < '4.1.0'){      //拒绝PHP过低版本访问
        exit('PHP version is low,please update,Thanks!');
    }
    session_start();
?>


<!DOCTYPE html>
<html>
<head>

<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<meta name="keywords"content="F-sociaty,sociaty,f社区,音乐,bbs,社交"> 
<meta name="baidu-site-verification" content="3m84pqW6h6" />
<link rel="stylesheet"type="text/css"href="css/newuser.css" />
<link rel="shortcat icon" href="/pic/f2.jpg">
<title>F-sociaty</title>
<?php 
    @define('SCRIPT',index);                //此处常量为了调用CSS文件的文件名而使用
    require'/includes/title.inc.php';       //此处调用CSS文件
   // require '/includes/func.inc.php';     //此处调用公共函数文件
    require 'includes/mysqlname.inc.php';   //为防止footer中_close函数报错而调用此文件

    //读取出数据
    $_html = _html(_get_xml('new.xml'));
    
    //读取帖子列表
    global $_pagesize,$_pagenum,$_pagesize1,$_pagenum1,$_system;
    _page("select f_id from f_article where f_reid=0", $_system['article']);
    $_result = _query("select f_id,f_date,f_title,f_content,f_type,f_readcount,f_commendcount from f_article where f_reid=0 order by f_date desc limit $_pagenum,$_pagesize");
    
    //最新的乐评图片,时间最新的哪一张,并且是非公开的，管理员操作
    $_photo = _fetch_array("select f_id as id,f_name as name,f_url as url from f_photo where f_sid in (select f_id from f_dir where f_type=0) order by f_date desc limit 1");
    
?>
<script type="text/javascript" src="JS/skin.js"></script>
</head>
<body>

<div id=header style=height:70px>
    <iframe width=204px height=70px marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>
</div>

<?php 
    require("includes/connin.inc.php");
?>


	<div class=dim></div>
	<div class=dim1><a href=post.php target=_blank><acronym title="write"><img src=pic/write.png width=40px height=40px alt=wirte></acronym></a></div>
	<div class=dim2><a href=post.php target=_blank><acronym title="write"><h13>写文章</h13></acronym></a></div>
	<div class=dim3><a href=myblog.php target=_blank><acronym title="个人博客"><img src=pic/tou.png width=46px height=46px alt=homne></acronym></acronym></a></div>
	<div class=dim4><a href=myblog.php target=_blank><acronym title="个人博客"><h13>个人博客</h13></acronym></a></div>
	<div class=dim5><a href=#><acronym title="退出"><img src=pic/fix.png width=34px height=34px alt=设置></acronym></a>'
</div>

<?php
   //引用公共文件,此处为页面上方文件
    define('PATH',substr(dirname(__FILE__),0,16));
    require '/includes/header.inc.php';
    require '/includes/timeheader.php';
    
    
    
    //此处对流量数据的更新
    if($_SERVER["REMOTE_ADDR"] !== "125.71.5.2121"){
        if(!isset($_SESSION['admin'])){
            
            _query("update f_read set f_read=f_read+1");
            _query("insert into f_read(f_date,f_ip) values(NOW(),'{$_SERVER["REMOTE_ADDR"]}')");
        }
    }
    
?>
<div id=le class=box>
<br>
    <h6><a id=其他 style=color:#d1e0df;>新 闻 && 导 航 </a></h6>
   <hr style="height:1px;width:90%;border:none;align:right;border-top:3px ridge #fffff0;"/><br>
       <h12>NEWS</h12><br><br>
    <h6>
    <dl>
        <!--<dd>&nbsp&nbsp页面皮肤</dd>
        <dd id="skin" onmouseover='inskin()' onmouseout='outskin'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="skin.php?id=1">Default</a></dd>
        <dd id="skin2" onmouseover='inskin()' onmouseout='outskin'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="skin.php?id=2">Twilight</a></dd>
        <dd id="skin3" onmouseover='inskin()' onmouseout='outskin'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="skin.php?id=3">Morningtide</a></dd>-->
        <dd id="dd1">Tips : <a href="f-sociaty.php">F-sociaty导航&帮助</a></dd>
        <dd id="dd1">Tips : <a href="f-sociaty_value.php">部分功能未完善问题</a></dd>
        <dd>New : <a href="f-sociaty_sug.php">对我们的意见</a></dd>
        <dd id="dd2">New : <a href="f-sociaty_join.php">加入开发组</a></dd>
        <dd id="dd3">New : <a href="f-sociaty_bug.php">关于BUG的反馈</a></dd>
        <dd id="dd4">New : <a href="f-sociaty_other.php">其他</a></dd>
    </dl>
    </h6> 
    
    </dl>
    </h>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <hr style="height:1px; width:90%;align:right;border-top:1px solid #fffff0;"/><br>
<h12><a href=newuser.php target=_blank>User</a></h12>
    
    <h>
    <dl>
    <?php 
    
        for($i=0;$i<4;$i++){
            $_result1 = _fetch_array("select f_username from f_user order by f_reg_time desc limit $i,1",MYSQL_ASSOC);
            echo '<dd class=xiafang>Welcome:'.'<a href="#用户"'.$i.'>'.$_result1['f_username'].'</a></dd>';
        }
            
        echo '<br>';
    ?>
    
</div>



<div id=mid class=box>
    <h6><a id=乐评>乐 评</a></h6>
    <hr style="height:1px;width:98%;border:none;align:right;border-top:4px ridge #8c8c8c;"/>
    <a href="photo_detail.php?id=<?php echo $_photo['id']?>"><img src="<?php echo $_photo['url']?>" width=30% alt="<?php echo $_photo['name']?>" /></a>
    <ul class="music">
    <?php 

        $_music = array();
        for($uu = 0;$uu < 4;$uu ++){
        $_music = _fetch_array("select f_id,f_date,f_title,f_content,f_type,f_readcount,f_commendcount from f_article where f_reid=0 and f_type=1 order by f_date desc limit $uu,6");
        $_music['f_date'] = substr($_music['f_date'],2);
        $_music['f_date'] = substr($_music['f_date'],0,8); //日期截取相关
        echo '<li class="picrig'.$_music['f_type'].'"><em><h>阅('.$_music['f_readcount'].') 评('.$_music['f_commendcount'].') &nbsp'.$_music['f_date'].'</h></em><a href="article.php?id='.$_music['f_id'].'"><h1 title="'._title($_music['f_content'],20).'">'._title($_music['f_title'],14).'</h1></a></li>';
        }
     
        ?>

    </ul>
</div>


<div id=rig class=box>
    <hr style="height:1px;width:100%;border:none;align:right;border-top:20px ridge #787981;"/>
    <h6 id=h7 ><a id=主页><p style="text-align:center;">
    <?php 
        if(isset($_COOKIE['username'])){
        echo '<a href="myblog.php" class="post" target=_blank style=color:silver>'.$_COOKIE['username'].' 个 人 主 页 </a>';
        echo "\n";
        }else{
            echo '个&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp人&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp主&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 页';
        }
     ?>
     </p></a></h6>
     <ul class="article">
     <h>
     <?php 
        $_htmllist = array();
        while(!!$_rows = _fetch_array_list($_result)){
            $_htmllist['id'] = $_rows['f_id'];
            $_htmllist['type'] = $_rows['f_type'];
            $_htmllist['datemethod'] = $_rows['f_date'];
            $_htmllist['content'] = $_rows['f_content'];
            $_htmllist['readcount'] = $_rows['f_readcount'];
            $_htmllist['commendcount'] = $_rows['f_commendcount'];
            $_htmllist['title'] = $_rows['f_title'];
                @$_htmllist['datemethod'] = date('Y-m-d',strtotime($_htmllist['datemethod']));
                $_htmllist['datego'] = substr($_htmllist['datemethod'],2);
            $_htmllist = _html($_htmllist);
            echo '<li class="picrig'.$_htmllist['type'].'"><em><h>阅读('.$_htmllist['readcount'].') 评论('.$_htmllist['commendcount'].') &nbsp'.$_htmllist['datego'].'</h></em><a href="article.php?id='.$_htmllist['id'].'"><h1 title="'._title($_htmllist['content'],40).'">'._title($_htmllist['title'],30).'</h1></a></li>';

        }
        _free_result($_result);
     ?>
     </h>
     </ul>
     <?php _paging(2)?>
</div>

<div id=mid1 class=box>

    <h6><a id=CD>C D</a></h6>
    <hr style="height:1px;width:98%;border:none;align:right;border-top:4px ridge #87888f;"/>
    <ul class="music1">
     <?php 

        $_music = array();
        for($uu = 0;$uu < 7;$uu ++){
        $_music = _fetch_array("select f_id,f_date,f_title,f_content,f_type,f_readcount,f_commendcount from f_article where f_reid=0 and f_type=2 order by f_date desc limit $uu,6");
        $_music['f_date'] = substr($_music['f_date'],2);
        $_music['f_date'] = substr($_music['f_date'],0,8); //日期截取相关
        echo '<li class="picrig'.@$_music['f_type'].'"><em><h>阅('.@$_music['f_readcount'].') 评('.@$_music['f_commendcount'].') &nbsp'.@$_music['f_date'].'</h></em><a href="article.php?id='.@$_music['f_id'].'"><h1 title="'._title(@$_music['f_content'],20).'">'._title(@$_music['f_title'],12).'</h1></a></li>';
        }
     
        ?>
        </ul>
        
</div>

<div id=mid2 class=box>
    <h6><a id=交流>交  流</a></h6>
    <hr style="height:1px;width:98%;border:none;align:right;border-top:4px ridge #87888f;"/>
     <ul class="music2">
     <?php 

        $_music = array();
        for($uu = 0;$uu < 7;$uu ++){
        $_music = _fetch_array("select f_id,f_date,f_title,f_content,f_type,f_readcount,f_commendcount from f_article where f_reid=0 and f_type=3 order by f_date desc limit $uu,6");
        $_music['f_date'] = substr($_music['f_date'],2);
        $_music['f_date'] = substr($_music['f_date'],0,8); //日期截取相关
        echo '<li class="picrig'.@$_music['f_type'].'"><em><h>阅('.@$_music['f_readcount'].') 评('.@$_music['f_commendcount'].') &nbsp'.@$_music['f_date'].'</h></em><a href="article.php?id='.@$_music['f_id'].'"><h1 title="'._title(@$_music['f_content'],20).'">'._title(@$_music['f_title'],12).'</h1></a></li>';
        }
     
        ?>
        </ul>
</div>

<div id=rig1 class=box>
    <h6><a id=Player>Player</a></h6>
    <hr style="height:1px;width:98%;border:none;align:right;border-top:4px ridge #87888f;"/>
    
     <ul class="music3">
     <?php 

        $_music = array();
        for($uu = 0;$uu < 7;$uu ++){
        $_music = _fetch_array("select f_id,f_date,f_title,f_content,f_type,f_readcount,f_commendcount from f_article where f_reid=0 and f_type=4 order by f_date desc limit $uu,6");
        $_music['f_date'] = substr($_music['f_date'],2);
        $_music['f_date'] = substr($_music['f_date'],0,8); //日期截取相关
        echo '<li class="picrig'.@$_music['f_type'].'"><em><h>阅('.@$_music['f_readcount'].') 评('.@$_music['f_commendcount'].') &nbsp'.@$_music['f_date'].'</h></em><a href="article.php?id='.@$_music['f_id'].'"><h1 title="'._title(@$_music['f_content'],20).'">'._title(@$_music['f_title'],10).'</h1></a></li>';
        }
     
        ?>
        </ul>
</div>

<div id=rig2 class=box>
   <h6><a id=交易>交  易</a></h6>
   <hr style="height:1px;width:98%;border:none;align:right;border-top:4px ridge #87888f;"/>
   
    <ul class="music3">
     <?php 

        $_music = array();
        for($uu = 0;$uu < 7;$uu ++){
        $_music = _fetch_array("select f_id,f_date,f_title,f_content,f_type,f_readcount,f_commendcount from f_article where f_reid=0 and f_type=5 order by f_date desc limit $uu,6");
        $_music['f_date'] = substr($_music['f_date'],2);
        $_music['f_date'] = substr($_music['f_date'],0,8); //日期截取相关
        echo '<li class="picrig'.@$_music['f_type'].'"><em><h>阅('.@$_music['f_readcount'].') 评('.@$_music['f_commendcount'].') &nbsp'.@$_music['f_date'].'</h></em><a href="article.php?id='.@$_music['f_id'].'"><h1 title="'._title(@$_music['f_content'],20).'">'._title(@$_music['f_title'],10).'</h1></a></li>';
        }
     
        ?>
        </ul>
</div>

<div id=lef class=vague>
<br>
    <h style=color:#d1e0df;><a id=Navigation>Navigation</a></h>
    <pre><br></pre>
    <hr style="height:1px;width:90%;border:none;border-top:1px solid #fffff0;" />
   <ul>
       <br><br>
      <br>  <li><a>优秀文章</a></li>
      <br>  <li><a>加入我们</a></li>
       <br> <li><a>您的意见和建议</a></li>
      <br>  <li><a>关于我们</a></li>
      <br>  <li><a>关于其他</a></li>
    </ul>
   
</div>

<div id=ad class=box>
   <h5>AD</h5>
</div>

<div id=ad1 class=box>
    <h5>AD</h5>
</div>

<div id=userl class=box>
   <h6 style=color:#d2d2ff;>新用户</h6>

   <hr style="height:1px;width:95%;border:none;align:right;border-top:10px ridge #87888f;"/><br>
    <?php 
         for($uu=0;$uu<4;$uu++){
             $_result1 = _fetch_array("select f_username,f_sex,f_email,f_url from f_user order by f_reg_time desc limit $uu,1",MYSQL_ASSOC);
    ?>
      <dl>
        <dd class=user id="用户"<?php echo $uu?>><?php echo $_result1['f_username']?>(<?php echo $_result1['f_sex']?>)</dd>
        <dt><img src=pic/heng6.jpg alt="<?php echo @$_html['sex']?>" width=150px /></dt>
        <dd><h name="friend"><a onclick="javascript:window.open('friend.php?id=<?php echo @$_html['id']?>','friend','width=400,height=300')" name=friend title="<?php echo @$_html['id']?>"><img src=pic/newuser/friend1.png width=18px height=20px />加为好友</a></h><h name=message><a onclick="javascript:window.open('message.php?id=<?php echo @$_html['id']?>','message','width=400,height=300')" name=message title="<?php echo @$_html['id']?>"><img src=pic/newuser/message.jpg width=18px height=20px />发送消息</a></dd></h>
        <dd><img src=pic/newuser/guest.jpg width=18px height=20px />给他留言<h name="flower"><a onclick="javascript:window.open('flower.php?id=<?php echo @$_html['id']?>','flower','width=400,height=300')" name=flower title="<?php echo @$_html['id']?>"><img src=pic/newuser/zan2.jpg width=20px height=20px />为他点赞</a></dd>
        <dd style=width:170px;text-align:left;margin:0;text-indent:5px;>邮件:<a href="mailto:<?php echo $_result1['f_email']?>" target=_blank><?php echo $_result1['f_email']?></a></dd>
        <dd style=width:170px;text-align:left;margin:0;text-indent:5px;>网址:<a href="<?php echo $_result1['f_url']?>" target=_blank><?php echo $_result1['f_url']?></a></dd>
    </dl>
    <?php 
        }
    ?>

</div>
<div id=userr>
    <h6><a id="新闻">新 闻 </a></h6>
    <hr style="height:1px;width:98%;border:none;align:right;border-top:10px ridge #87888f;"/>
        <dt>NEWS</dt>
        <?php 
            $_newdata = _query("select *from f_news order by sort desc limit 4");
            while (!!$_row_new = mysql_fetch_array($_newdata)){
            ?>
            <dl class="userr1">
                <dd><a href="f-sociaty_id=2196.php"><img src="<?php echo $_row_new['img']?>" width=200px alt="fsociaty" /><h4 style=text-align:center;><?php echo $_row_new['title']?></h4></a></dd>
           </dl>
           <?php
           }
           ?>
        
</div>


<?php 
    //引用公共文件
    @define('PATH',substr(dirname(__FILE__),0,16));
    require '/includes/footer.inc.php';
?>

<!-- <embed src="1.mp3" hidden="true" autostart="true" loop="1"> -->
</body>
</html>