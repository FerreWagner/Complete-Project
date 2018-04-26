<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<?php 
    if(!defined('chang')){      //非法调用相关
    exit('非法调用');
 }
 ?>

<html>
<head>
<style type="text/css">
.read{
	background:url(../pic/email/email1.jpg) no-repeat left center;
}
</style>
</head>
<body>

</body>
</html>

<?php

require('mysql.func.php'); //引入数据库操作

//数据库连接
define('DB_HOST','localhost');   //my1734946.xincache1.cn
define('DB_USER','ferre666');        //my1734946
define('DB_PWD', '9E15A0167Ba573');            //F1S8p7p4
define('DB_NAME','ferre666');           //my1734946
$_conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD,'3306');
//选择一款数据库
mysql_select_db(DB_NAME) or die('指定数据库不存在'.mysql_error());

//选择字符集
mysql_query('SET NAMES UTF8') or die('字符集错误'.mysql_error());


//初始化数据库
_connect();     //连接mysql数据库
_select_db();   //选择指定数据库
_set_names();   //设置字符集

//短信提醒
$_message = @_fetch_array("select count(f_id) as count from f_message where f_state=0 and f_touser = '{$_COOKIE['username']}'");
$_articlemessage = @_fetch_array("select count(f_id) as count1 from f_article where f_username='{$_COOKIE['username']}' and f_reid=0");
$_message['count'] = $_message['count'] + $_articlemessage['count1'];
if(empty($_message['count'])){
    $_message_html = '<strong class="noread">'.(0).'</strong>';
}else {
    $_message_html = '<strong class="read">'.'未读'.($_message['count']).'</strong>';
}

    require 'includes/func.inc.php';    //此处作为头部引用公共函数库，很重要
    
    global $_system;

	if(!!$_rowshe = _fetch_array("select f_webname,f_article,f_blog,f_photo,f_skin,f_string,f_post,f_re,f_code,f_register from f_system where f_id=1 limit 1")){
	    $_system = array();
	    $_system['webname'] = $_rowshe['f_webname'];
	    $_system['article'] = $_rowshe['f_article'];
	    $_system['blog'] = $_rowshe['f_blog'];
	    $_system['photo'] = $_rowshe['f_photo'];
	    @$_system['skin'] = @$_rowshe['f_skin'];
	    $_system['post'] = $_rowshe['f_post'];
	    $_system['re'] = $_rowshe['f_re'];
	    $_system['code'] = $_rowshe['f_code'];
	    $_system['register'] = $_rowshe['f_register'];
	    $_system['string'] = $_rowshe['f_string'];
	    
	    $_system = _html($_system);
	    
	    //如果有skin的cookie那么久替代系统数据库的皮肤
	    if(@$_COOKIE['skin']){
	        @$_system['skin'] = @$_COOKIE['skin'];
	    }
	    
	    
	}else{
	    echo '未执行';
	}