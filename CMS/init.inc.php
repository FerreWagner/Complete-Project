<?php 
//开启SESSION
session_start();
//设置utf-8编码
header("Content-Type:text/html;charset=utf-8");
//网站根目录
define('ROOT_PATH',dirname(__FILE__));
//引入模板配置信息
require ROOT_PATH.'/config/profile.inc.php';

//设置中国时区
date_default_timezone_set('Asia/Shanghai');

//自动加载类,会自动提示加载顺序
function __autoload($_className){
    if(substr($_className, -6) == 'Action'){
        require ROOT_PATH.'/action/'.$_className.'.class.php';
    }elseif(substr($_className,-5) == 'Model'){
        require ROOT_PATH.'/model/'.$_className.'.class.php';
    }else{  //加载includes下的类
        require ROOT_PATH.'/includes/'.$_className.'.class.php';
    }
}

//设置不缓存,将不设置缓存的做成数组放进参数中，来执行
$_cache = new Cache(array('code','ckeup','static','upload','register')); //验证码、编辑器上传、静态类控制缓存、上传文档,做成一个不缓存的数组

//实例化模板类
$_tpl = new Templates();

//缓存机制,此处利用两个相同的文件名放在不同目录下引用,很巧妙的引用了缓存
//初始化
require 'common.inc.php';

?>