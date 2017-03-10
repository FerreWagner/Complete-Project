<?php 
    class Tool{
        
        //弹窗跳转
        static public function alertLocation($_info,$_url){
            if(!empty($_info)){
                echo "<script type='text/javascript'>alert('$_info');location.href='$_url'</script>";
                exit();
            }else{
                header('Location:'.$_url);
                exit();
            }
        }
        
        //弹窗返回
        static public function alertBack($_info){
            echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
            exit();
        }
        
        //弹窗赋值，关闭自己（上传专用）
        static public function alertOpenerClose($_info,$_path){
            echo "<script type='text/javascript'>alert('$_info')</script>";
            echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$_path';</script>";
            echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
            echo "<script type='text/javascript'>opener.document.content.pic.src='$_path';</script>";
            echo "<script type='text/javascript'>window.close()</script>";
            exit();
        }
        
        //将当前文件转换成.tpl文件名
        static public function tplName(){
            $_str = explode('/', $_SERVER["SCRIPT_NAME"]);  //将得到的路径用/分隔开得到
            $_str = explode('.', $_str[count($_str)-1]);    //得到数组的元素个数-1(即最后一个元素xxx.php的名称);再用.把xxx.php分成xxx和php
            return $_str[0]; //返回第一个元素(即xxx),配上.tpl,就是xxx.tpl
        }
        
        //将HTML字符串转换成HTML标签
        static public function unHtml($_str){
            return htmlspecialchars_decode($_str);  //将html标记的html转换成html语言
        }
        
        
        //将对象数组转换成字符串，并且去掉最后的逗号；
        static public function objArrOfStr($_object,$_field){
            if($_object){
                foreach ($_object as $_value){
                    @$_html .= $_value->$_field.',';  //用逗号隔开，再取出
                }
            }
            return substr(@$_html, 0,@strlen($_html)-1); //最后一个字符-1去掉最后一个逗号，得到前n-1个字符
        }
        
        //字符串截取
		static public function subStr($_object,$_field,$_length,$_encoding) {
			if ($_object) {
				if (is_array($_object)) {
					foreach ($_object as $_value) {
						if (mb_strlen($_value->$_field,$_encoding) > $_length) {
							$_value->$_field = mb_substr($_value->$_field,0,$_length,$_encoding).'...';
						}
					}
				} else {
					$_object = mb_substr($_object,0,$_length,$_encoding);
				}
			}
			return $_object;
		}
        
        
        //显示html过滤,用递归判断数组、对象的方式，遍历分离成字符串，再进行过滤
        static function htmlString($_date){
            if(is_array($_date)){
                foreach($_date as $_key=>$_value){
                    $_string[$_key] = Tool::htmlString($_value);  //递归
                }
            }elseif (is_object($_date)){
                foreach($_date as $_key=>$_value){
                    $_string->$_key = Tool::htmlString($_value);  //递归
                }
            }else{
                $_string = htmlspecialchars($_date);
            }
            return @$_string;
        }
        
        //数据库输入过滤
        static public function mysqlString($_date){
            return !GPC ? mysql_real_escape_string($_date) : $_date;
            
        }
        
        //清理session
        static public function unSession(){
            if(session_start()){
                session_destroy();
            }
        }
    }
?>