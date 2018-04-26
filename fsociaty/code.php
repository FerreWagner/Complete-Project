<?php
$_yzm='';

session_start();

//随机码的个数
$_rnd_code=4;

//创建随机码
for($i=0;$i<$_rnd_code;$i++){
    $_yzm .=dechex(mt_rand(0,15));
}

//保存在SESSION

$_SESSION['code']=$_yzm;

//创建一张图像
$_width=105;
$_height=25;
$_img = imagecreatetruecolor($_width, $_height);

//白色
$_white = imagecolorallocate($_img,255,255,255);

//填充到背景上

imagefill($_img,0,0,$_white);

//黑色边框

$_black = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));   //此处为随机色
imagerectangle($_img,0,0,$_width,$_height,$_black);

//随机画出六个线条
for($i=0;$i<6;$i++){
    $_rnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
}

//随机雪花

for($i=0;$i<100;$i++){
    $_rnd_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
    imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);
}

//输出验证码
$_bla = imagecolorallocate($_img,100,0,150);
for($i=0;$i<strlen($_SESSION['code']);$i++){
    imagestring($_img,5,$i*$_width/$_rnd_code+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_bla);
}

//输出图像

header('Content-Type:image/png');
imagepng($_img);

//销毁

imagedestroy($_img);