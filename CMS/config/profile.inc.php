<?php 
    
    //数据库配置文件
    define('DB_HOST','localhost');      //主机ip
    define('DB_USER','root');           //服务器账号
    define('DB_PASS','wh1234');         //密码
    define('DB_NAME','cms');            //数据库

    //系统配置文件
    define('GPC', get_magic_quotes_gpc());  //sql转义功能是否打开了
    define('PAGE_SIZE',10);             //后台每页多少条
    define('ARTICLE_SIZE', 8);          //文章每页显示条数
    define('PREV_URL', @$_SERVER["HTTP_REFERER"]);   //上一页地址
    define('NAV_SIZE', 10);             //主导航在前台显示的个数
    define('UPDIR', '/uploads/');       //上传主目录
    define('MARK',ROOT_PATH.'/images/pen.gif');    //水印图片
    
    //模板配置信息
    define('TPL_DIR',ROOT_PATH.'/templates/');  //模板文件目录
    define('TPL_C_DIR', ROOT_PATH.'/templates_c/'); //编译文件目录
    define('CACHE', ROOT_PATH.'/cache/');   //缓存目录
//     define('ADMIN_CACHE', false);           //后台缓存按钮,不得开启,开启后，后台功能有误
//     define('FRONT_CACHE', false);   //还有验证码问题        //前台缓存按钮,测试时关闭,运行时开启
    
?>