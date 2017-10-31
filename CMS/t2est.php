<?php 
//     生成一个文件, 123.php   这个文件里有12341231这些东西
//     file_put_contents('123.php', '123456789');
//     读取一个文件里的内容
//     echo file_get_contents('123.php');

//查找
 //   $_str = 'yc463.com@gmail.com';
//     if(preg_match('/@/', $_str)){
//         echo '存在';
//     }else{
//         echo '没有';
//     }

        //$_str = preg_replace('/@/', "%", $_str);
        //echo $_str;
   
    
    
//     系统变量相关    
//     $_config = array();
//     $_sxe = simplexml_load_file('config/profile.xml');
    
//     $_tagLib = $_sxe->xpath('/root/taglib');
    
//    foreach ($_tagLib as $_tag){
//        $_config["$_tag->name"] = $_tag->value;
//    }
   
//    print_r($_config);




//缓存技术    
//     ob_start(); //开启缓冲区
    
//     //echo '<div>我向浏览器输出，并且将输出的数据存放在了缓冲区</div>';
//     if(5>4){
//         //echo '给爹';
//     }
//     $a = ob_get_contents();  //获取输出至缓冲区的内容
    
//     //清除缓冲区
//     ob_end_clean(); 
    
//     echo $a;
    
    
//     $_a = array(1,2,3,4,5);
//     $_b = array('a','b','c','d');
    
//     $_html = array();
    
//     //把三次数组赋值都保存下来
//     //只要在数组赋值前面加上中括号,就可以赋值成二维数组
//     $_html[] = $_a;
//     $_html[] = $_b;
//     $_html[] = $_a;
    
//     print_r($_html);

    //测试验证码相关
//     require dirname(__FILE__).'/init.inc.php';
//     $_vc = new Validatecode();
//     echo $_vc->createCode().'<br>';
//     print_r($_vc->createCode());
    //  TIPS：在php里,字符串其实也是数组
//     echo $_vc->doimg(); 

//     $_a = '我是<b>粗体</a>';
//     echo htmlspecialchars($_a);
//     echo htmlspecialchars_decode($_a);


//     function htmlstring($_date) {
//         $_string = htmlspecialchars($_date);
//     }


    //php引擎自动转义
//     $_c = @$_GET['c'];
//     echo $_c;
//     echo get_magic_quotes_gpc($_c);    //判断php引擎是否自动转义的函数


foreach (range(0, 12) as $number) {
    echo $number;
}
?>

<form>
   <textarea name="c"></textarea>
   <input type="submit" /> 
</form>