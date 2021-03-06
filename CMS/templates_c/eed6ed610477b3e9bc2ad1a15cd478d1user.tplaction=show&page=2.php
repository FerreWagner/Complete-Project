<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/reg.js"></script>
</head>
<body id="main">
<?php error_reporting(E_ALL & ~E_NOTICE)?>
<div class="map">
	管理首页 &gt;&gt; 会员管理 &gt;&gt; <strong id="title"><?php echo $this->_vars['title'];?></strong>
</div>

<ol>
	<li><a href="user.php?action=show" class="selected">会员列表</a></li>
	<li><a href="user.php?action=add">新增会员</a></li>
	<?php if($this->_vars['update']){?>
	<li><a href="user.php?action=update&id=<?php echo $this->_vars['id'];?>">修改会员</a></li>
	<?php }?>
</ol>

<?php if($this->_vars['show']){?>
<table cellspacing="0">
	<tr><th>编号</th><th>用户名</th><th>电子邮件</th><th>状态</th><th>操作</th></tr>
	<?php if($this->_vars['AllUser']){?>
	<?php foreach ($this->_vars['AllUser'] as $key=>$value) { ?>
	<tr>
		<td><script type="text/javascript">document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td>
		<td><?php echo $value->user?></td>
		<td><?php echo $value->email?></td>
		<td><?php echo $value->state?></td>
		<td><a href="user.php?action=update&id=<?php echo $value->id?>">修改</a> | <a href="user.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('你真的要删除这个会员吗？') ? true : false">删除</a></td>
	</tr>
	<?php }?>
	<?php }else{?>
	<tr><td colspan="5">对不起，没有任何数据</td></tr>
	<?php }?>
</table>
<div id="page"><?php echo $this->_vars['page'];?></div>
<?php }?>


<?php if($this->_vars['add']){?>
<form method="post" name="reg">
	<table cellspacing="0" class="user">
		<tr><td>用 户 名：<input type="text" class="text" name="user" /> <span class="red">[必填]</span> ( *用户名在2到20位之间 )</td></tr>
		<tr><td>密　　码：<input type="password" class="text" name="pass" /> <span class="red">[必填]</span> ( *密码不得小于6位 )</td></tr>
		<tr><td>密码确认：<input type="password" class="text" name="notpass" /> <span class="red">[必填]</span> ( *密码确认和密码一致 )</td></tr>
		<tr><td>电子邮件：<input type="text" class="text" name="email" /> <span class="red">[必填]</span> ( *每个电子邮件只能注册一个ID )</td></tr>
		<tr><td>选择头像：<select name="face" onchange="sfacee();">
									<?php foreach ($this->_vars['OptionFaceOne'] as $key=>$value) { ?>
									<option value="tou<?php echo $value?>.jpg"><?php echo $value?>.jpg</option>
									<?php }?>
									<?php foreach ($this->_vars['OptionFaceTwo'] as $key=>$value) { ?>
									<option value="zhan<?php echo $value?>.jpg"><?php echo $value?>.jpg</option>
									<?php }?>					
								</select>
		</td></tr>
		<tr><td><img name="faceimg" src="../images/tou1.jpg" class="face" alt="01.gif" /></td></tr>
		<tr><td>安全问题：<select name="question">
									<option value="">没有任何安全问题</option>
										<option value="您最喜欢做的事情？">您最喜欢做的事情？</option>
										<option value="您的宗教看法？">您的宗教看法？</option>
										<option value="您最欣赏的人？">您最欣赏的人？</option>
								</select>
		</td></tr>
		<tr><td>问题答案：<input type="text" class="text" name="answer" /></td></tr>
		<tr><td>设置权限：<input type="radio" name="state" value="0" /> 被封杀的会员
									<input type="radio" name="state" value="1" /> 待审核的会员
									<input type="radio" name="state" value="2" checked="checked" /> 初级会员
									<input type="radio" name="state" value="3" /> 中级会员
									<input type="radio" name="state" value="4" /> 高级会员
									<input type="radio" name="state" value="5" /> VIP会员
		</td></tr>
		<tr><td><input type="submit" class="submit" name="send" onclick="return checkReg();" value="注册会员" /></td></tr>
	</table>
</form>
<?php }?>

<?php if($this->_vars['update']){?>
<form method="post" name="add">
	<input type="hidden" value="<?php echo $this->_vars['id'];?>" name="id" />
	<input type="hidden" value="<?php echo $this->_vars['prev_url'];?>" name="prev_url" />
	<table cellspacing="0" class="left">
		<tr><td>等级名称：<input type="text" name="level_name" value="<?php echo $this->_vars['level_name'];?>" class="text" /></td></tr>
		<tr><td><textarea name="level_info"><?php echo $this->_vars['level_info'];?></textarea></td></tr>
		<tr><td><input type="submit" name="send" value="修改等级" onclick="return checkForm();" class="submit level" /> [ <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> ]</td></tr>
	</table>
</form>
<?php }?>



</body>
</html>