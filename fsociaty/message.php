<?php 
    define('chang',1990);   //防止非法调用
    require 'includes/connin.inc.php';
    require 'includes/timeheader.php';
 //   require '/includes/func.inc.php';   //此处调用公共函数文件
    require 'includes/mysqlname.inc.php';   //为防止footer中_close函数报错二调用此文件
    
    //打印出文件名,为后面的封装调用分页函数做铺垫
    
    header("Content-Type:text/html; charset=utf-8");
    session_start();
    
    //判断是否登录
    if(!isset($_COOKIE['username'])){
        _alert_close('请先登录');
    }
    
    if(@$_GET['action'] == 'write'){
        //验证码函数
        @_check_code($_POST['code'],$_SESSION['code']);
        //验证数据库里的唯一标识符
        if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
            //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
            _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
           include 'includes/check.func.php';
            $_clean = array();
           $_clean['touser'] = $_POST['touser'];
           $_clean['fromuser'] = $_COOKIE['username'];
           $_clean['content'] = _check_content($_POST['content']);
           $_clean = _mysql_string($_clean);   //转义数组
           //写入数据库
           _query("insert into f_message(
                              f_touser,
                              f_fromuser,
                              f_content,
                              f_date
                              )
                        values(
                              '{$_clean['touser']}',
                              '{$_clean['fromuser']}',
                              '{$_clean['content']}',
                              NOW()
                              )
               ");
           //新增成功的函数
           if(_affected_rows() == 1){
               //数据库关闭函数
               _close();
               //清空，不让服务器负担过重
              // _session_destroy();
               //跳转到首页
               _alert_close('消息发送成功');
           }else{
               //数据库关闭函数
               _close();
               //清空，不让服务器负担过重
              // _session_destroy();
               //跳转到首页
               _alert_back('消息发送失败');
           }
        }else{
            _alert_close('非法登录');   //即唯一标识符异常
        }
    }
    
    //获取数据:名字
    if(isset($_GET['id'])){
        if(!!$_rows = _fetch_array("select f_username from f_user where f_id = '{$_GET['id']}' limit 1")){
            $_html = array();
            $_html['touser'] = $_rows['f_username'];
            $_html = _html($_html);
        }else{
            _alert_close('不存在此用户'); //ID在数据库中搜索不到
        }
        }else{
            _alert_back('非法操作');
    }
    
?>

<!DOCTYPE html>
<html>
<head>
<title>写消息</title>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<link rel="stylesheet"type="text/css"href="css/message.css" />
<script type="text/javascript" src="JS/message.js"></script>
</head>
<body style=margin:0;background-color:#999>
<iframe marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>

<div id=message>
    <h3>写消息</h3>
    <br><br><br>
    <hr />
    <br><br><br><br><br><br>
    <form method="post" action="?action=write">
    <input type="hidden" name="touser" value="<?php echo $_html['touser']?>" />
    <dl>
        <dd><input type="text" readonly="readonly" value="<?php echo 'TO:'.$_html['touser']?>" class="text" /></dd>
        <dd><textarea name="content"></textarea></dd>
        <dd><h4>验&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp证&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp码：&nbsp&nbsp<input name=code type=text size=12 maxlength=14>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="code.php" id=code onclick="javascript:this.src='code.php?tm='+Math.random()" /><br><input type="submit" class="submit" value="发送消息" /></h4></dd>
    </dl>
    </form>
</div>


</body>
</html>