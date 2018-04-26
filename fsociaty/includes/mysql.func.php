<meta http-equiv="content-type"content="text/html;charset=utf-8" />

<?php 
    if(!defined('chang')){      //非法调用相关
    exit('非法调用');
 }

 
function _connect(){
//创建数据库连接
//global表示全局变量的意思，意图是将此变量在外部也能访问
    global $_conn;
    if(!$_conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD)){
        exit('数据库链接失败');
}
}


function _select_db(){
    /**
     * 选择一款数据库
     */
    if(!mysql_select_db(DB_NAME)){
        exit('找不到指定数据库');
    }
}

function _set_names(){
    if(!mysql_query('set names UTF8')){
        exit('字符集错误');
    }
}

function _query($_sql){
    
    /**
     *
     * @param unknown $_sql
     */
    
    if(!$_result = mysql_query($_sql)){
        exit('SQL执行失败'.mysql_error());
    }
    return $_result;
}

function _fetch_array($_sql){
    
    /**
     *
     * @param unknown $_sql
     */
    
    return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}

function _affected_rows(){
    return mysql_affected_rows();
}

function _is_repeat($_sql,$_info){
    
    /**
     *
     * @param unknown $_sql
     * @param unknown $_info
     */
    
    if(_fetch_array($_sql)){
        _alert_back($_info);
    }
}

function _close(){
    //关闭数据库
    if(!mysql_close()){
        exit('数据库关闭异常');
    }
}

function _fetch_array_list($_result){
    //可以返回指定数据集的所有数据
    
    return @mysql_fetch_array($_result,MYSQL_ASSOC);
}

function _num_rows($_result){
    return mysql_num_rows($_result);
}

function _free_result($_result){
    //函数表示销毁结果集
    
    mysql_free_result($_result);
}

function _insert_id(){
    return mysql_insert_id();
}