<?php 
    define('chang',1990);   //防止非法调用
    @define('SCRIPT',newuser);   //分页函数的文件名会用到
    require 'includes/connin.inc.php';
    require 'includes/timeheader.php';
   // require 'includes/func.inc.php';   //此处调用公共函数文件
    require 'includes/mysqlname.inc.php';   //为防止footer中_close函数报错二调用此文件
    
    header("Content-Type:text/html; charset=utf-8");
    
    //打印出文件名,为后面的封装调用分页函数做铺垫
    
    //判断是否登录
    if(!isset($_COOKIE['username'])){
        _alert_close('请先登录');
    }
    
    global $_pagesize,$_pagenum,$_system;
    //分页模块函数的调用,此函数为分页函数的参数函数
    _page("select f_id from f_user",10);    //第一个参数获取总条数，第二个参数指定每页多少条
    //从数据库里提取数据获取结果集
    //必须是没词重新读取结果集，而不是重新执行SQL语句，会造成死循环，只有第一条数据
    $_result = _query("select f_id,f_username,f_sex from f_user order by f_reg_time desc limit $_pagenum,$_pagesize");
    
?>

<!DOCTYPE html>
<html>
<head>
<title>博客列表</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/newuser.css" />
<!--<script type="text/javascript" src="JS/newuser.js"></script>-->
</head>
<body style=margin:0;>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<div id=newuser>
    <h2>博客会员</h2>
    <?php 
            $_html = array();
        while(!!$_rows = _fetch_array_list($_result)){
            //此处过滤用户名和性别信息
            $_html['id'] = $_rows['f_id'];
            $_html['username'] = $_rows['f_username'];
            $_html['sex'] = $_rows['f_sex'];
            $_html = _html($_html);
    ?>
    <dl>
        <dd class=user><?php echo $_html['username']?>(<?php echo $_html['sex']?>)</dd>
        <dt><img src=pic/heng6.jpg alt="pic" width=150px /></dt>
        <dd><h name="friend"><a onclick="javascript:window.open('friend.php?id=<?php echo $_html['id']?>','friend','width=400,height=300')" name=friend title="<?php echo $_html['id']?>"><img src=pic/newuser/friend1.png width=18px height=20px />加为好友</a></h>&nbsp&nbsp&nbsp&nbsp<h name=message><a onclick="javascript:window.open('message.php?id=<?php echo $_html['id']?>','message','width=400,height=300')" name=message title="<?php echo $_html['id']?>"><img src=pic/newuser/message.jpg width=18px height=20px />发送消息</a></dd></h>
        <dd><img src=pic/newuser/guest.jpg width=18px height=20px />给他留言&nbsp&nbsp&nbsp&nbsp<h name="flower"><a onclick="javascript:window.open('flower.php?id=<?php echo $_html['id']?>','flower','width=400,height=300')" name=flower title="<?php echo $_html['id']?>"><img src=pic/newuser/zan2.jpg width=20px height=20px />为他点赞</a></dd>
    </dl>
   <?php }
        //此处为销毁结果集
        _free_result($_result);
        _paging(2); //此函数为分页函数，1为数字分页；2为文本分页
   ?>
    

</div>





</body>
</html>


<?php 
    //引用公共文件
    @define('PATH',substr(dirname(__FILE__),0,16));
    require PATH.'/includes/footer1.inc.php';
?>
