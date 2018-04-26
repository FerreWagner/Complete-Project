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
      global $_system;
      
      
    //去掉字符两边的空格
    $_string = trim($_string);
    
    //限制其长度，大于2小于20
    if(mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num){
            _alert_back('用户名长度不能小于'.$_min_num.'位或超过'.$_max_num.'位');
    }
    
    //限制敏感字符
    $_char_pattern = '/[<>\'\"\ \ ]/';
    if(preg_match($_char_pattern,$_string)){
        _alert_back('用户名不得包含敏感字符');
    }
    
    //限制敏感用户名
    $_mg[0] = 'Ferre';
    $_mg[1] = 'Nemo';
    $_mg[2] = '王珏聪';
   // $_mg = explode('|', $_system['string']); //暂时不用这个
    
    //这里采用的绝对匹配
    if(in_array($_string,$_mg)){
        _alert_back('敏感用户名不得注册');
    }
   
    //将用户名转义输入
    
    return _mysql_string($_string);
    
}
   
  function _check_password($_first_pass,$_end_pass,$_min_num){
     
    /**
     * @access public
     * @param unknown $_first_pass
     * @param unknown $_end_pass
     * @param unknown $_min_num
     * @return string $_first_pass 返回一个加密后密码
     */

    //判断密码
    if(strlen($_first_pass) < strlen($_min_num)){
        _alert_back('密码不得小于六位');
    }

    //密码和密码确认必须一致
    if($_first_pass != $_end_pass){
        _alert_back('密码确认不一致');
    }
    

    //将密码返回
    return _mysql_string(sha1($_first_pass));
}

  function _check_question($_string,$_min_num,$_max_num){

    /**
     *
     * @param unknown $_string
     * @param unknown $_min_num
     * @param unknown $_max_num
     * @return string
     */

    $_string = trim($_string);
    //长度小于四位大于20位不允许
    if(mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num){
        _alert_back('密码提示长度不能小于'.$_min_num.'位或超过'.$_max_num.'位');
    }

    //限制敏感字符
//     $_char_pattern = '/[<>\'\"\ \ ]/';
//     if(preg_match($_char_pattern,$_string)){
//         _alert_back('密码提示不得包含敏感字符');
//     }

    //返回密码提示
    return _mysql_string($_string);

}

  function _check_answer($_ques,$_answ,$_min_num,$_max_num){
     
     /**
      *
      * @param unknown $_ques
      * @param unknown $_answ
      * @param unknown $_min_num
      * @param unknown $_max_num
      * @return string
      */
     
      $_answ = trim($_answ);
     
      //长度小于四位大于20位不允许
      if(mb_strlen($_answ,'utf-8') < $_min_num || mb_strlen($_answ,'utf-8') > $_max_num){
          _alert_back('密码回答长度不能小于'.$_min_num.'位或超过'.$_max_num.'位');
      }
      
      //密码提示与回答不得一致
      if($_ques == $_answ){
          _alert_back('密码提示与回答不得一致');
      }
      
      //加密返回
      return sha1($_answ);
      
      //限制敏感字符
      $_string = trim($_string);
      $_char_pattern = '/[<>\'\"\ \ ]/';
      if(preg_match($_char_pattern,$_string)){
          _alert_back('密码回答不得包含敏感字符');
      }
  }

  function _check_sex($_string){
      
      /**
       *
       * @param unknown $_string
       * @return Ambigous <string, unknown>
       */
      
      return _mysql_string($_string);
  }
  
  function _check_email($_string,$_min_num,$_max_num){
    
      /**
       *
       * @param unknown $_string
       * @return NULL|unknown
       */
      
      
      //参考bnbbs@163.com邮箱进行验证
      //[a-zA-Z0-9] => \w
      //[\w\-\.] 16.3
      //\.[\w+].com.com.net.cn...
      
     if(empty($_string)){
         return null;
     }else{
      if(!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$_string)){
          _alert_back('邮箱格式错误');
      }
      if(strlen($_string) < $_min_num || strlen($_string) > $_max_num){
          _alert_back('邮件长度不合法');
      }
      }
  
      return _mysql_string($_string);
  }
  
  function _check_qq($_string){
      
      /**
       *
       * @param unknown $_string
       * @return NULL|unknown
       */
      
     
          if(!preg_match('/^[1-9]{1}[0-9]{4,9}$/',$_string)){
              _alert_back('QQ格式不正确');
          }
      
      return _mysql_string($_string);
  }
 
  function _check_url($_string,$_max_num){
      
      /**
       *
       * @param unknown $_string
       * @return NULL|unknown
       */
      
      if(empty($_string) || ($_string == 'http://')){
          return null; 
      }else{
          //?表示0次或者1次
          if(!preg_match('/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/',$_string)){
              _alert_back('网址不正确');
          }
          if(strlen($_string) > $_max_num){
              _alert_back('网址太长');
          }
      }
      return _mysql_string($_string);
  }
  
  function _check_uniqid($_first_uniqid,$_end_uniqid){
     
      /**
       *
       * @param unknown $_first_uniqid
       * @param unknown $_end_uniqid
       * @return Ambigous <string, unknown>
       */
      
      // _alert_back($_first_uniqid.'\n'.$_end_uniqid);,此句为判断两个参数的值
      
      if((strlen($_first_uniqid) != 40) || ($_first_uniqid != $_end_uniqid)){
          _alert_back('唯一标识符异常');
      }
      return _mysql_string($_first_uniqid);
  }
  
  
  function _check_modify_password($_string,$_min_num){
      //判断密码
      
      if(!empty($_string)){
      if(strlen($_string) < $_min_num){
          _alert_back('密码不得小于'.$_min_num.'位');
      }
    }else{
        return null;
    }
      return $_string;
  }
  
  
  function _check_content($_string){
      if(mb_strlen($_string,'utf-8') < 2 || mb_strlen($_string,'utf-8') > 800){
        _alert_back('信息内容不能小于2位大于800位');
  }
  return $_string;
  }
  
  
  function _check_post_title($_string,$_min,$_max){
      if(mb_strlen($_string,'utf-8') < $_min || mb_strlen($_string,'utf-8') > $_max){
          _alert_back('标题长度不能小于'.$_min.'位或大于'.$_max.'位');
      }
      return $_string;
  }
  
  
  function _check_post_content($_string,$_num){
      if(mb_strlen($_string,'utf-8') < $_num){
          _alert_back('发帖内容不能小于'.$_num.'位');
      }
      return $_string;
  }
  
  function _check_autograph_content($_string,$_num){
      if(mb_strlen($_string,'utf-8') > $_num){
          _alert_back('签名内容不能大于'.$_num.'位');
      }
      return $_string;
  }
  
  function _check_dir_name($_string,$_min,$_max){
      if(mb_strlen($_string,'utf-8') < $_min || mb_strlen($_string,'utf-8') > $_max){
          _alert_back('名称不能小于'.$_min.'或大于'.$_max.'位');
      }
      return $_string;
  }
  
  function _check_dir_password($_string,$_num){
      //判断密码
          if(strlen($_string) < $_num){
              _alert_back('密码不得小于'.$_num.'位');
          }
 
      return $_string;
  }
  
  function _check_photo_url($_string){
      if(empty($_string)){
          _alert_back('地址不能为空');
      }
      return $_string;
  }