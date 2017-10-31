<?php 
require substr(dirname(__FILE__),0,-7).'/init.inc.php'; //因为这里是从config目录里出来,所以config是6位加一个/共7位。方法和其他长度截取一致
if(isset($_POST['send'])){  //防止恶意调用
    $_fileupload = new FileUpload('pic',$_POST['MAX_FILE_SIZE']);
    $_path = $_fileupload->getPath();   //执行返回路径方法
    $_img = new Image($_path);          //执行构造函数里初始化的方法
    $_img->thumb(190,120);   //1-100之间
    $_img->out();
    Tool::alertOpenerClose('缩略图上传成功', $_path);
}else{
    Tool::alertBack('文件过大或者其他未知错误,导致浏览器崩溃');
}

?>