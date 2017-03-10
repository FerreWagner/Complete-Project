<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css">
<script type="text/javascript" src=../js/admin_nav.js></script>
</head>
<body id="main">
<div class="map">
    内容管理 &gt;&gt;设置网站导航    &gt;&gt;<b id="title"><?php echo $this->_vars['title'];?></b>
</div>
    <?php error_reporting(E_ALL & ~E_NOTICE)?>
    
    <ol>
        <li><a href="nav.php?action=show" class="selected">导航列表</a></li>
        <li><a href="nav.php?action=add">新增导航</a></li>
            <?php if($this->_vars['update']){?>
                <li><a href="nav.php?action=update&id=<?php echo $this->_vars['id'];?>">修改导航</a></li>
            <?php }?>
            <?php if($this->_vars['addchild']){?>
                <li><a href="nav.php?action=addchild&id=<?php echo $this->_vars['id'];?>">新增子导航</a></li>
            <?php }?>
            <?php if($this->_vars['showchild']){?>
                <li><a href="nav.php?action=showchild&id=<?php echo $this->_vars['id'];?>">子导航列表</a></li>
            <?php }?>
    </ol>
    
    
    <?php if($this->_vars['show']){?>
    <form method="post" action="nav.php?action=sort" />
        <table cellspacing=0>
            <tr><th>编号</th><th>导航名称</th><th>描述</th><th>子类</th><th>操作</th><th>排序</th></tr>
                <?php if($this->_vars['AllNav']){?>
                <?php foreach ($this->_vars['AllNav'] as $key=>$value) { ?>
            <tr><td><script type="text/javascript" >document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td><td><?php echo $value->nav_name?></td><td><?php echo $value->nav_info?></td><td><a href="nav.php?action=showchild&id=<?php echo $value->id?>">查看</a> | <a href="nav.php?action=addchild&id=<?php echo $value->id?>">增加子类</a></td><td><a href="nav.php?action=update&id=<?php echo $value->id?>">修改 </a> | <a href="nav.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('确定删除?') ? true : false"> 删除</a></td><td><input type="text" name="sort[<?php echo $value->id?>]" value="<?php echo $value->sort?>" class="text sort" /></td></tr>
                <?php }?>
                <?php }else{?>
                <tr><td colspan="6">抱歉,没有任何数据</td></tr>
                <?php }?>
                <tr><td></td><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" name="send" value="排序 " style="cursor: pointer" /></td></tr>
        </table>
        </form>
        <div id="page"><?php echo $this->_vars['page'];?></div>
    <?php }?>
    
    <?php if($this->_vars['showchild']){?>
    <form method="post" action="nav.php?action=sort" />
        <table cellspacing=0>
            <tr><th>编号</th><th>导航名称</th><th>描述</th><th>操作</th><th>排序</th></tr>
                <?php if($this->_vars['AllChildNav']){?>
                <?php foreach ($this->_vars['AllChildNav'] as $key=>$value) { ?>
            <tr><td><script type="text/javascript" >document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td><td><?php echo $value->nav_name?></td><td><?php echo $value->nav_info?></td><td><a href="nav.php?action=update&id=<?php echo $value->id?>">修改 </a> | <a href="nav.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('确定删除?') ? true : false"> 删除</a></td><td><input type="text" name="sort[<?php echo $value->id?>]" value="<?php echo $value->sort?>" class="text sort" /></tr>
                <?php }?>
                <?php }else{?>
                <tr><td colspan="5">抱歉,没有任何数据</td></tr>
                <?php }?>
                <tr><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" name="send" value="排序 " style="cursor: pointer" /></td></tr>
                <tr><td colspan="5">本类隶属：<b><?php echo $this->_vars['prev_name'];?> </b> 【<a href="nav.php?action=addchild&id=<?php echo $this->_vars['id'];?>">增加本类</a>】 【<a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a>】</td></tr>
        </table>
        </form>
        <div id="page"><?php echo $this->_vars['page'];?></div>
    <?php }?>
    
    
    <?php if($this->_vars['add']){?>
        <form method="post" name="add" class="left">
        <input type="hidden" value="0" name="pid" />
            <table cellspacing=0>
                <tr><td>导航名称：<input type="text" name="nav_name" class="text" />(* 导航名称不得小于两位、大于20位)</td></tr>
                <tr><td><textarea name="nav_info"></textarea>(* 描述不得大于200位)</td></tr>
                <tr><td><input type="submit" name="send" value="新增导航" onclick="return checkAddForm" class="submit level" />【 <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> 】</td></tr>
            </table>
        </form>
    <?php }?>
    
    
    <?php if($this->_vars['addchild']){?>
        <form method="post" name="add" class="left">
            <input type="hidden" value="<?php echo $this->_vars['id'];?>" name="pid" />
            <table cellspacing=0>
                <tr><td>上级导航：<b><?php echo $this->_vars['prev_name'];?></b></td></tr>
                <tr><td>导航名称：<input type="text" name="nav_name" class="text" />(* 导航名称不得小于两位、大于20位)</td></tr>
                <tr><td><textarea name="nav_info"></textarea>(* 描述不得大于200位)</td></tr>
                <tr><td><input type="submit" name="send" value="新增子导航" onclick="return checkAddForm" class="submit level" />【 <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> 】</td></tr>
            </table>
        </form>
    <?php }?>
    
    
    <?php if($this->_vars['update']){?>
        <form method="post" name="update" class="left">
        <input type="hidden" value="<?php echo $this->_vars['prev_url'];?>" name="prev_url" />
        <input type="hidden" value="<?php echo $this->_vars['id'];?>" name="id"/>
            <table cellspacing=0>
                <tr><td>导航名称：<input type="text" name="nav_name" value=<?php echo $this->_vars['nav_name'];?> class="text" />(* 导航名称不得小于两位、大于20位)</td></tr>
                <tr><td><textarea name="nav_info"><?php echo $this->_vars['nav_info'];?></textarea>(* 描述不得大于200位)</td></tr>
                <tr><td><input type="submit" name="send" value="修改导航" onclick="return checkAddForm" class="submit level" />【 <a href="<?php echo $this->_vars['prev_url'];?>">返回列表</a> 】</td></tr>
            </table>
        </form>
    <?php }?>
    

</body>
</html>