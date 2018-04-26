<?php

function _removedir($dirName){
    if(!is_dir($dirName)){
        return false;
    }
    $handle = @opendir($dirName);
    while (($file = @readdir($handle)) !== false) {
        if($file != '.' && $file != '..'){
            $dir = $dirName . '/' . $file;
            is_dir($dir) ? _removedir($dir) : @unlink($dir);
        }
    }
    closedir($handle);
    return  rmdir($dirName);
}



function _manage_login(){
    if((!isset($_COOKIE['username'])) || (!isset($_SESSION['admin']))){
        _alert_back('非法登录');
    }
}

function _timed($_now_time,$_pretime,$_second){
    if($_now_time - $_pretime < $_second){
        _alert_back('发文过于频繁，请于'.($_second - 1).'秒后重试');
    }
}


function _alert_back($_info){
    
    /**
     * _alert_back()表示JS弹窗
     * @access public
     * @param $_info
     * @return void 弹窗
     */
    
    echo "<script type='text/javascript'>alert('".$_info."');history.back();</script>";
    exit();
}

function _set_xml($_xmlfile,$_clean){
    $_fp = @fopen('new.xml', 'w');
    if(!_fp){
        exit('系统错误，文件不存在');
    }
    flock($_fp, LOCK_EX);
    
    $_string = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
    fwrite($_fp,$_string,strlen($_string));
    $_string = "<vip>\r\n";
    fwrite($_fp,$_string,strlen($_string));
    $_string = "\t<id>{$_clean['id']}</id>\r\n";
    fwrite($_fp,$_string,strlen($_string));
    $_string = "\t<username>{$_clean['username']}</username>\r\n";
    fwrite($_fp,$_string,strlen($_string));
    $_string = "\t<sex>{$_clean['sex']}</sex>\r\n";
    fwrite($_fp,$_string,strlen($_string));
    @$_string = "\t<face>pic/heng6.jpg</face>\r\n";
    fwrite($_fp,$_string,strlen($_string));
    $_string = "\t<email>{$_clean['email']}</email>\r\n";
    fwrite($_fp,$_string,strlen($_string));
    $_string = "\t<url>{$_clean['url']}</url>\r\n";
    fwrite($_fp,$_string,strlen($_string));
    $_string = "</vip>";
    fwrite($_fp, $_string,strlen($_string));
    
    flock($_fp, LOCK_UN);
    fclose($_fp);
}

function _get_xml($_xmlfile){
    //读取XML文件
    $_html = array();
    if(file_exists($_xmlfile)){
        $_xml = file_get_contents($_xmlfile);
        preg_match_all('/<vip>(.*)<\/vip>/s', $_xml,$_dom);
        foreach ($_dom[1] as $_value){
            preg_match_all('/<id>(.*)<\/id>/s', $_value,$_id);
            preg_match_all('/<username>(.*)<\/username>/s', $_value,$_username);
            preg_match_all('/<sex>(.*)<\/sex>/s', $_value,$_sex);
            preg_match_all('/<face>(.*)<\/face>/s', $_value,$_face);
            preg_match_all('/<email>(.*)<\/email>/s', $_value,$_email);
            preg_match_all('/<url>(.*)<\/url>/s', $_value,$_url);
            $_html['id'] = $_id[1][0];
            $_html['username'] = $_username[1][0];
            $_html['sex'] = $_sex[1][0];
            $_html['face'] = $_face[1][0];
            $_html['email'] = $_email[1][0];
            $_html['url'] = $_url[1][0];
        }
    }else {
        echo '文件不存在';
    }
    return $_html;
}

function _alert_close($_info){
    echo "<script type='text/javascript'>alert('".$_info."');window.close();</script>";
    exit();
}


function _location($_info,$_url){
    if(!empty($_info)){
    echo "<script type='text/javascript'>alert('".$_info."');location.href='$_url';</script>";
    exit();
    }else{
        header('Location:'.$_url);   //php的方法，直接跳转不需要弹窗
    }
}

define('GPC',get_magic_quotes_gpc());       //创建一个自动转义的常量

function _mysql_string($_string){
    
    /**
     *
     * @param unknown $_string
     * @return string|unknown
     */
    
    //如果get_magic_quotes_gpc函数处于开启状态,就不需要转义
    if(!GPC){
        if(is_array($_string)){
            foreach ($_string as $_key => $_value){
                $_string[$_key] = _mysql_string($_value);
            }
        }else{
            $_string = mysql_real_escape_string($_string);
         }
        }
        return $_string;
}



function _check_code($_first_code,$_end_code){
    //作用：验证码判定
    /**
     *
     * @param unknown $_first_code
     * @param unknown $_end_code
     */
   $_level_num_name = array();
   $_level_num = @_fetch_array("select f_level from f_user where f_username='{$_COOKIE['username']}'");
   $_level_num_name['level'] = $_level_num['f_level'];
   if($_level_num_name['level'] == 1){
       
   }elseif($_first_code != $_end_code){
       _alert_back('验证码错误');
   }
}

function _sha1_uniqid(){
    return _mysql_string(sha1(uniqid(rand(),true)));
}

function _session_destroy(){
    //删除session
    if(@session_start()){
        session_destroy();
    }
}

function _unsetcookies(){
    //删除cookies
    
    setcookie('username','',time()-1);
    setcookie('uniqid','',time()-1);
    _session_destroy();
    _location(null, 'index.php');
}

function _login_state(){
    //防止登陆之后又能登录和注册,登录状态的判断
    
    if(isset($_COOKIE['username'])){
        _alert_back('登录状态无法进行本操作');
    }
}


function _paging($_type){
    
    /**
     * _paging()分页函数
     * @param unknown $_type
     * return 返回分页
     */
    
    global $_page,$_pageabsoute,$_num,$_id;
    if($_type == 1){
       echo '<div id=page_num>';
        //此处为分页制作
        echo '<ul>';
        for($i=0;$i<$_pageabsoute;$i++){
            if($_page == ($i+1)){
                echo '<li style="list-style-type:none;"><a href="'.SCRIPT.'.php?'.$_id.'page='.($i+1).'" class="selected">'.($i+1).'</a></li>';
            }else{
                echo '<li style="list-style-type:none;"><a href="'.SCRIPT.'.php?'.$_id.'page='.($i+1).'">'.($i+1).'</a></li>';
            }
        }
            echo '</ul>';
            echo '</div>';
     }elseif($_type == 2){
         echo '<div id="page_text">';
         echo '<ul>';
         echo '<li>'.$_page.'/'.$_pageabsoute.'页 &nbsp|</li>';    
         echo '<li> 共<strong>'.$_num.'</strong>条数据 &nbsp|</li>'; 
                if($_page == 1){
                    echo '<li> 首页&nbsp |</li>';
                    echo '<li> 上一页&nbsp | </li>';
                }else{
                    echo '<li><a href="'.SCRIPT.'.php">首页</a>&nbsp |</li>';
                    echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($_page-1).'"> 上一页</a> &nbsp|</li>';
                }
                if($_page == $_pageabsoute){
                    echo '<li>下一页&nbsp | </li>';
                    echo '<li>尾页&nbsp</li>';
                }else{
                    echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($_page+1).'">下一页</a> &nbsp| </li>';
                    echo '<li><a href="'.SCRIPT.'.php?'.$_id.'page='.($_pageabsoute).'">尾页</a></li>';
                }
            
           
        echo '</ul>';
        echo '</div>';
    }else{
        _paging(2); //不是1或2就调用自己的第二个类型
    }
}

function _page($_sql,$_size){
    //分页模块
    //此处为页码数字及其判断
    global $_page,$_pagesize,$_pagenum,$_pageabsoute,$_num;
    if(isset($_GET['page'])){
        $_page = $_GET['page'];
        if(empty($_page) || $_page<=0 || !is_numeric($_page)){
            $_page = 1;
        }else{
            $_page = intval($_page);
        }
    }else{
        $_page = 1;
    }
    $_pagesize = $_size;
    $_num = _num_rows(_query($_sql));
    
    //首先要得到所有的数据总和
    //数据库清零的问题：若没有数据，则返回第一页的数据，否则返回最后一页的数据
    if($_num == 0){
        $_pageabsoute = 1;
    }else{
        $_pageabsoute = ceil($_num/$_pagesize);
    }
    if($_page > $_pageabsoute){
        $_page = $_pageabsoute;
    }
    $_pagenum = ($_page-1)*$_pagesize;
}

function _ubb($_string){
    $_string = nl2br($_string);
    $_string = preg_replace('/\[size=(.*)\](.*)\[\/size\]/U', '<span style="font-size:\1px">\2</span>', $_string);
    $_string = preg_replace('/\[b\](.*)\[\/b\]/U', '<strong>\1</strong>', $_string);    //U为禁止贪婪
    $_string = preg_replace('/\[i\](.*)\[\/i\]/U', '<em>\1</em>', $_string);
    $_string = preg_replace('/\[u\](.*)\[\/u\]/U', '<span style="text-decoration:underline">\1</span>', $_string);
    $_string = preg_replace('/\[s\](.*)\[\/s\]/U', '<span style="text-decoration:line-through">\1</span>', $_string);
    $_string = preg_replace('/\[color=(.*)\](.*)\[\/color\]/U', '<span style="color:\1">\2</span>', $_string);
    $_string = preg_replace('/\[url\](.*)\[\/url\]/U', '<a href="\1" target=_blank>\1</a>', $_string);
    $_string = preg_replace('/\[email\](.*)\[\/email\]/U', '<a href="mailto:\1">\1</a>', $_string);
    $_string = preg_replace('/\[img\](.*)\[\/img\]/U', '<img src="\1" alt="图片" height=400px width=400px />', $_string);
    $_string = preg_replace('/\[flash\](.*)\[\/flash\]/U', '<embed style="width:880px;height:600px;" src="\1" />', $_string);
    return $_string;
}



function _title($_string,$_strlen){
    //标题截取函数
    if(mb_strlen($_string,'utf-8') > $_strlen){
        $_string = mb_substr($_string, 0,$_strlen,'utf-8').'...';
    }
    return $_string;
}


function _html($_string){
    
    /**
     *
     * @param unknown $_string
     * @return string
     */
    
    //此函数为禁止非法字符输入
    //此处为以数组遍历或者单个字符串的方法来过滤,此处为递归的方法,先为数组，后判断拆分为字符串
    if(is_array($_string)){
        foreach ($_string as $_key => $_value){
            $_string[$_key] = _html($_value);
        }
    }else{
        $_string = htmlspecialchars($_string);
    }
    return $_string;
}


function _uniqid($_mysql_uniqid,$_cookie_uniqid){
    //判断唯一标识符是否异常
    
    if($_mysql_uniqid != $_cookie_uniqid){
        _alert_back('唯一标识符异常');
    }
     
}




function _paging1($_type1){
    

    global $_page1,$_pageabsoute1,$_num1,$_id1;
    if($_type1 == 1){
       echo '<div id=page_num1>';
        //此处为分页制作
        echo '<ul>';
        for($i=0;$i<$_pageabsoute1;$i++){
            if($_page1 == ($i+1)){
                echo '<li style="list-style-type:none;"><a href="'.SCRIPT.'.php?'.$_id1.'page1='.($i+1).'" class="selected">'.($i+1).'</a></li>';
            }else{
                echo '<li style="list-style-type:none;"><a href="'.SCRIPT.'.php?'.$_id1.'page1='.($i+1).'">'.($i+1).'</a></li>';
            }
        }
            echo '</ul>';
            echo '</div>';
     }elseif($_type1 == 2){
         echo '<div id="page1_text">';
         echo '<ul>';
         echo '<li>'.$_page1.'/'.$_pageabsoute1.'页 &nbsp|</li>';    
         echo '<li> 共<strong>'.$_num1.'</strong>条数据 &nbsp|</li>'; 
                if($_page1 == 1){
                    echo '<li> 首页&nbsp |</li>';
                    echo '<li> 上一页&nbsp | </li>';
                }else{
                    echo '<li><a href="'.SCRIPT.'.php">首页</a>&nbsp |</li>';
                    echo '<li><a href="'.SCRIPT.'.php?'.$_id1.'page1='.($_page1-1).'"> 上一页</a> &nbsp|</li>';
                }
                if($_page1 == $_pageabsoute1){
                    echo '<li>下一页&nbsp | </li>';
                    echo '<li>尾页&nbsp</li>';
                }else{
                    echo '<li><a href="'.SCRIPT.'.php?'.$_id1.'page1='.($_page1+1).'">下一页</a> &nbsp| </li>';
                    echo '<li><a href="'.SCRIPT.'.php?'.$_id1.'page1='.($_pageabsoute1).'">尾页</a></li>';
                }
            
           
        echo '</ul>';
        echo '</div>';
    }else{
        _paging1(2); //不是1或2就调用自己的第二个类型
    }
}

function _page1($_sql1,$_size1){
    //分页模块
    //此处为页码数字及其判断
    global $_page1,$_pagesize1,$_pagenum1,$_pageabsoute1,$_num1;
    if(isset($_GET['page1'])){
        $_page = $_GET['page1'];
        if(empty($_page1) || $_page1<=0 || !is_numeric($_page1)){
            $_page1 = 1;
        }else{
            $_page1 = intval($_page1);
        }
    }else{
        $_page1 = 1;
    }
    $_pagesize1 = $_size1;
    $_num1 = _num_rows(_query($_sql1));
    
    //首先要得到所有的数据总和
    //数据库清零的问题：若没有数据，则返回第一页的数据，否则返回最后一页的数据
    if($_num1 == 0){
        $_pageabsoute1 = 1;
    }else{
        $_pageabsoute1 = ceil($_num1/$_pagesize1);
    }
    if($_page1 > $_pageabsoute1){
        $_page1 = $_pageabsoute1;
    }
    $_pagenum1 = ($_page1-1)*$_pagesize1;
}