<?php 
//缓存是否开启
define('IS_CACHE', false);
//模板句柄
global $_tpl,$_cache;
if(IS_CACHE && !$_cache->noCache()){//判断是否开启缓冲区;当传过来的文件为我们不想让他缓存的数组文件时,跳过这个，再重新生成
    ob_start();
    //在执行php代码前就应该跳转到缓存文件
    $_tpl->cache(Tool::tplName().'.tpl');  //调用生成本文件文件名+tpl的方法
}
$_nav = new NavAction($_tpl);
$_nav->showfront(); //列出主导航

$_cookie = new Cookie('user');
if (IS_CACHE) {
	$_tpl->assign('header','<script type="text/javascript">getHeader();</script>');
} else {
	if ($_cookie->getCookie()) {
		$_tpl->assign('header',$_cookie->getCookie().'，您好！ <a href="register.php?action=logout">退出</a> ');
	} else {
		$_tpl->assign('header','	<a href="register.php?action=reg" class="user">注册</a> <a href="register.php?action=login" class="user">登录</a>');
	}
}



?>