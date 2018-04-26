<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<title>f music face chance</title>
<link rel="stylesheet"type="text/css"href="css/face.css" />
<?php 
    @define('SCRIPT',index); //此处常量为了调用CSS文件的文件名而使用
    define('chang',1990);
    require'/includes/title.inc.php';   //此处调用CSS文件
    require("includes/connin.inc.php");
    require_once 'includes/mysqlname.inc.php';
    
    if(!$_COOKIE['username']){
        _alert_back('非法登录');
    }
    
    //执行上传图片功能
    if(@$_GET['action'] == 'up'){
        if(!!$_rows = _fetch_array("select f_uniqid from f_user where f_username='{$_COOKIE['username']}' limit 1")){
            //为了防止cookie伪造,还要比对一下唯一标识符uniqid()
            _uniqid($_rows['f_uniqid'], $_COOKIE['uniqid']);
            //1、开始上传图片
            $_files = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif','image/jpg','image/bmp');
            //2、判断上传类型
            if(is_array($_files)){
                if(!in_array($_FILES['userfile']['type'], $_files)){    //如果在FILES全局变量上传的里找不到这几种，执行以下
                    echo "<script>alert('本站只允许jpg/gif/png/bmp格式图片');history.back();</script>";
                }
            }
            if($_FILES['userfile']['error'] > 0){
                switch ($_FILES['userfile']['error']){
                    case 1:echo _alert_back('上传文件超过约定值1');
                    break;
                    case 2:echo _alert_back('上传文件超过约定值2');
                    break;
                    case 3:echo _alert_back('部分被上传');
                    break;
                    case 4:echo _alert_back('没有任何文件被上传');
                    break;
                }
                exit;
            }
            //3、判断配置大小
            if($_FILES['userfile']['size'] > 5000000){
                echo _alert_back('上传文件不得超过5M');
            }
            
            //获取文件的扩展名,如1.jpg的jpg
            $_n = explode('.', $_FILES['userfile']['name']);
            $_name = $_POST['dir'].'/'.time().'.'.$_n[1];
            
            //4、移动文件，应该是到服务器上，保存图片数据，以便以后调用使用
            if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
                if(!@move_uploaded_file($_FILES['userfile']['tmp_name'], $_name)){
                    _alert_back('移动失败');
                }else{
                   // _alert_close('上传成功');
                   echo "<script>alert('上传成功');window.opener.document.getElementById('url').value='$_name';window.close();</script>";
                    exit();
                }
            }else{
                _alert_back('上传的临时文件不存在');
            }
            
        }else{
            _alert_back('非法登录');
        }
    }
    
    //接收dir
    if(!isset($_GET['dir'])){
        _alert_back('非法操作');
    }
    
?>
<script type="text/javascript" src="JS/opener.js"></script>
<style type="text/css">
#upimg{
	position:absolute;
	top:340px;
	text-align:center;
	font-family:微软雅黑;
}
.sub{
	color:silver;
	background:#333;
	border:1px solid black;
	padding:2px 4px 2px 4px;
}
</style>
</head>
<body>

<div id=header>
    <iframe width=204px height=60px marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>
</div>


<div id="upimg" style=padding:20px;>

<form enctype="multipart/form-data" action="upimg.php?action=up" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
    <input type="hidden" name="dir" value="<?php echo $_GET['dir']?>" />
            选择图片: <input type="file" name="userfile" />
    <input type="submit" name="send" class="sub" value="上传" />
</form>

</div>
<?php 
   // require("includes/footer1.inc.php");
?>


</body>
</html>