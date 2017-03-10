<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_config['webname'];?></title>
<link rel="stylesheet" type="text/css" href="style/basic.css">
<link rel="stylesheet" type="text/css" href="style/reg.css">
<script type="text/javascript" src="js/reg.js"></script>

</head>
<body>
<?php error_reporting(E_ALL & ~E_NOTICE)?>
    <?php $_tpl->create('header.tpl')?>
    <?php if($this->_vars['reg']){?>
    <div id="reg">
        <h2>会员注册</h2>
        <form method="post" name="reg" action="?action=reg">
		<dl>
			<dd>用 户 名：<input type="text" class="text" name="user" /> <span class="red">[必填]</span> ( *用户名在2到20位之间 )</dd>
			<dd>密　　码：<input type="password" class="text" name="pass" /> <span class="red">[必填]</span> ( *密码不得小于6位 )</dd>
			<dd>密码确认：<input type="password" class="text" name="notpass" /> <span class="red">[必填]</span> ( *密码确认和密码一致 )</dd>
			<dd>电子邮件：<input type="text" class="text" name="email" /> <span class="red">[必填]</span> ( *每个电子邮件只能注册一个ID )</dd>
			<dd>选择头像：<select name="face" onchange="sface();">
			             <?php foreach ($this->_vars['OptionFaceOne'] as $key=>$value) { ?>
			             <option value="tou<?php echo $value?>.jpg"><?php echo $value?>.jpg</option>
			             <?php }?>
			             <?php foreach ($this->_vars['OptionFaceTwo'] as $key=>$value) { ?>
			             <option value="zhan<?php echo $value?>.jpg"><?php echo $value?>.jpg</option>
			             <?php }?>
			</select></dd>
			<dd><img alt="pic" name="faceimg" class="face" src="images/ad.jpg"></dd>
			<dd>安全问题：<select name="question">
										<option value="">没有任何安全问题</option>
										<option value="您最喜欢做的事情？">您最喜欢做的事情？</option>
										<option value="您的宗教看法？">您的宗教看法？</option>
										<option value="您最欣赏的人？">您最欣赏的人？</option>
									</select>
			</dd>
			<dd>问题答案：<input type="text" class="text" name="answer" /></dd>
			<dd>验 证 码：<input type="text" class="text" name="code" /> <span class="red">[必填]</span></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /></dd>
			<dd><input type="submit" class="submit" onclick="return checkReg();" name="send" value="注册会员" /></dd>
		</dl>
	</form>
    </div>
    <?php }?>
    
    <?php if($this->_vars['login']){?>
    <div id="reg">
    <h2>会员登录</h2>
        <form method="post" name="login" action="?action=login">
		<dl>
			<dd>用 户 名：<input type="text" class="text" name="user" /> <span class="red">[必填]</span> ( *用户名在2到20位之间 )</dd>
			<dd>密　　码：<input type="password" class="text" name="pass" /> <span class="red">[必填]</span> ( *密码不得小于6位 )</dd>
		    <dd>登陆保留：<input type="radio" name="time" checked="checked" value="0" />不保留
		              <input type="radio" name="time" value="86400" />一天
		              <input type="radio" name="time" value="604800" />一周
		              <input type="radio" name="time" value="2592000" />一月
		    </dd>
		    <dd>验 证 码：<input type="text" class="text" name="code" /> <span class="red">[必填]</span></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /></dd>
			<dd><input type="submit" class="submit" onclick="return checkLogin();" name="send" value="登录" /></dd>
		</dl>
		</form>
	</div>
    <?php }?>
    <?php $_tpl->create('footer.tpl')?>
    
</body>
</html>