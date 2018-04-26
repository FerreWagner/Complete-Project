<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<style type="text/css">
#footer{
		background:url(../pic/night5.jpg);
	background-size:100% 100%; 
	background-attachment: fixed;
}

</style>
<?php 
    if(!defined('chang')){
        exit('非法调用');
    }
    
    if(empty($_conn)){
         //判断是否存在$_conn资源，再关闭数据库
    }else{
        _close();   //数据库关闭函数
    }
?>
<div id=footer align=center> 
<p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p><p>
                                <?php 
    $t2=explode(' ',microtime());
    echo '<pre>'.'打开页面耗时：'.($t2[1]-$t1[1]).'秒'.round(($t2[0]-$t1[0]),6).'微秒';  //运算耗时
    ?>  
  版权所有 翻版必究  未经Ferre授权不得转载本站内所有信息
  本站由<font color=blue>&copyFerre</font>提供技术支持，请勿在它处引用,否则将承担法律责任
   注册商标12006 &reg
CopyRight &copy 2016-2030 All Rights Reserved
									
</pre>
<p><p><p><p><p>
</div>
