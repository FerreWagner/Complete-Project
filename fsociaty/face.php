<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type"content="text/html;charset=utf-8" />
<title>f music face chance</title>
<link rel="stylesheet"type="text/css"href="css/face.css" />
<?php 
    @define('SCRIPT',index); //此处常量为了调用CSS文件的文件名而使用
    define('chang',1990);
    require'/includes/title.inc.php';   //此处调用CSS文件
?>
<script type="text/javascript" src="JS/opener.js"></script>
</head>
<body>

<div id=header>
    <iframe width=204px height=60px marginwidth=0 frameborder=0 scrolling=no align=center src=weblink.html></iframe>
</div>

<?php 
    require("includes/connin.inc.php");
?>

<div id=face>
<h3>头像选择</h3>


<dl>
<?php 
    foreach(range(1,8) as $num){
         
?>
<dd><img src="pic/heng<?php echo $num;?>.jpg" alt=pic<?php echo $num;?> width=300px height=300px /></dd>
<?php }?>
<?php 
    foreach(range(2,12) as $tableft){
        
?>

<dd><img src="pic/images/tableft<?php echo $tableft;?>.gif" alt=pic<?php echo $tableft;?> width=300px height=300px /></dd>
<?php }?>

</dl>

</div>
<?php 
    require("includes/footer1.inc.php");
?>


</body>
</html>