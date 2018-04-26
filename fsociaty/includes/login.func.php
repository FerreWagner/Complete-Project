<?php
if(!defined('chang')){
    exit('非法调用');
}

if(!function_exists('_alert_back')){
    exit('_alert_back()函数不存在,请检查');
}

if(!function_exists('_mysql_string')){
    exit('_mysql_string()函数不存在,请检查');
}

function _check_username($_string,$_min_num,$_max_num){

    /**
     * _check_username表示检测并过滤用户名
     * @access public
     * @param string $_string
     * @param int $_min_num 最小位数
     * @param int $_max_num 最大位数
     * @return string 过滤后的用户名
     *
     */



    //去掉字符两边的空格
    $_string = trim($_string);

    //限制其长度，大于2小于20
    if(mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num){
        _alert_back('用户名长度不能小于'.$_min_num.'位或超过'.$_max_num.'位');
    }
     
    //将用户名转义输入

    return _mysql_string($_string);

}

function _check_password($_string,$_min_num){
     
    /**
     * @access public
     * @param unknown $_string
     * @param unknown $_min_num
     * @return string $_first_pass 返回一个加密后密码
     */

    //判断密码
    if(strlen($_string) < strlen($_min_num)){
        _alert_back('密码不得小于六位');
    }

    //将密码返回
    return _mysql_string(sha1($_string));
}

function _check_time($_string){
    $_time = array('0','1','2','3');
    if(!in_array($_string, $_time)){
        _alert_back('保留方式出错');
    }
    
    return _mysql_string($_string);
}

function _setcookies($_username,$_uniqid,$_time){
    
    //生成登录cookie

    switch($_time){
        case 0:
            setcookie('username',$_username);
            setcookie('uniqid',$_uniqid);
            break;
        case 1:
            setcookie('username',$_username,time()+172800);     //分别为2,10,30天的cookie储存秒数
            setcookie('uniqid',$_uniqid);
            break;
        case 2:
            setcookie('username',$_username,time()+864000);
            setcookie('uniqid',$_uniqid);
            break;
        case 3:
            setcookie('username',$_username,time()+2592000);
            setcookie('uniqid',$_uniqid);
            break;
    }
}