<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css">
<script type="text/javascript" src=../js/admin_content.js></script>
<script type="text/javascript" src="../style/ckeditor/ckeditor.js"></script>
</head>
<body id="main">
<div class="map">
   内容管理 &gt;&gt;查看文档列表    &gt;&gt;<b id="title"><?php echo $this->_vars['title'];?></b>
</div>
    <?php error_reporting(E_ALL & ~E_NOTICE)?>
    
    <ol>
        <li><a href="content.php?action=show" class="selected">文档列表</a></li>
        <li><a href="content.php?action=add">新增文档</a></li>
            <?php if($this->_vars['update']){?>
                <li><a href="content.php?action=update&id=<?php echo $this->_vars['id'];?>">修改文档</a></li>
            <?php }?>
    </ol>
    
    <?php if($this->_vars['show']){?>
        <table cellspacing=0>
            <tr><th>编号</th><th>标题</th><th>属性</th><th>文档类别</th><th>浏览次数</th><th>文档发布时间</th><th>操作</th></tr>
                <?php if($this->_vars['SearchContent']){?>
                <?php foreach ($this->_vars['SearchContent'] as $key=>$value) { ?>
            <tr><td><script type="text/javascript" >document.write(<?php echo $key+1?>+<?php echo $this->_vars['num'];?>);</script></td><td><a href="../details.php?id=<?php echo $value->id?>" title="<?php echo $value->t?>" target="_blank"><?php echo $value->title?></a></td><td><?php echo $value->attr?></td><td><a href="?action=show&nav=<?php echo $value->nav?>"><?php echo $value->nav_name?></a></td><td><?php echo $value->count?></td><td><?php echo $value->date?></td><td><a href="content.php?action=update&id=<?php echo $value->id?>">修改 </a> | <a href="content.php?action=delete&id=<?php echo $value->id?>" onclick="return confirm('确定删除?') ? true : false"> 删除</a></td></tr>
                <?php }?>
                <?php }else{?>
                <tr><td colspan="7">抱歉,没有任何数据</td></tr>
                <?php }?>
        </table>
        <form action="?" method="get">
        <div id="page">
            <?php echo $this->_vars['page'];?>
            <input type="hidden" name="action" value="show" />
            <select name="nav" class="select">
                <option value="0">默认全部</option>
                <?php echo $this->_vars['nav'];?>
            </select>
            <input value="查询" type="submit" />
        </div>
        </form>
    <?php }?>
    
    <?php if($this->_vars['add']){?>
    <form name="content" method="post" action="?action=add">
    <table cellspacing=0 class="content">
            <tr><th><b>发布一条新文档</b></th></tr>
            <tr><td>文档标题：<input type="text" name="title" class="text" /><span class="blue"> 【必填】</span> (* 标题2-50字符)</td></tr>
            <tr><td>&nbsp栏 目 ： <select name="nav"><option value="" style="padding:0">请选择一个栏目类别</option><?php echo $this->_vars['nav'];?></select><span class="blue"> 【必选】</span></td></tr>
            <tr><td>定义属性：<input type="checkbox" name="attr[]" value="头条" />头条
                            <input type="checkbox" name="attr[]" value="推荐" />推荐
                            <input type="checkbox" name="attr[]" value="加粗" />加粗
                            <input type="checkbox" name="attr[]" value="跳转" />跳转
            </td></tr>
            <tr><td>TAG标签： <input type="text" name="tag" class="text" /> (* 每个标签用','隔开,总长度30)</td></tr>
            <tr><td>关键字 ： <input type="text" name="keyword" class="text" /> (* 每个关键字用','隔开,总长度30)</td></tr>
            <tr><td>缩略图 ： <input type="text" name="thumbnail" class="text" readonly="readonly" />
                          <input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','600','400')" />
                          <img name="pic" style="display:none;" /> (* 缩略图2M内,格式:JPG GIF PNG)
            </td></tr>
            <tr><td>文章来源：<input type="text" name="source" class="text" /> (* 文章来源20位之内)</td></tr>
            <tr><td>&nbsp作 者 ： <input type="text" name="author" value="<?php echo $this->_vars['author'];?>" class="text" /> (* 作者名10位内)</td></tr>
            <tr><td><span class="middle">内容摘要：</span><textarea name="info"></textarea> <span class="middle">(* 内容摘要200内)</span></td></tr>
            <tr class="ckeditor"><td><textarea id="TextArea1" name="content" class="ckeditor"></textarea></td></tr>
            <tr><td>评论选项：<input type="radio" name="commend" value="1" checked="checked" />允许评论
                           <input type="radio" name="commend" value="0" />禁止评论
            &nbsp&nbsp&nbsp&nbsp 浏览次数：<input type="text" name="count" value="100" class="text small" />
            <tr><td>文档排序：<select name="sort">
                                <option value="0">默认排序</option>
                                <option value="1">置顶一天</option>
                                <option value="2">置顶一周</option>
                                <option value="3">置顶一月</option>
                                <option value="4">置顶一年</option>
                           </select>
            &nbsp&nbsp&nbsp&nbsp 消费金币：<input type="text" name="gold" value="0" class="text small" />
            <tr><td>阅读权限：<select name="readlimit">
                                <option value="0">开放浏览</option>
                                <option value="1">初级会员</option>
                                <option value="2">中级会员</option>
                                <option value="3">高级会员</option>
                                <option value="4">VIP会员</option>
                           </select>
            &nbsp&nbsp&nbsp&nbsp标题颜色： <select name="color">
                                <option value="">默认颜色</option>
                                <option value="red" style="color: red">红色</option>
                                <option value="blue" style="color: blue">蓝色</option>
                                <option value="orange" style="color: orange">橙色</option>
                           </select>
            </td></tr>
            <tr><td><input type="submit" name="send" onclick="return checkAddContent();" value="发布文档" /><input type="reset" value="重置" /></td></tr>
            <tr><td></td></tr>
        </table>
        </form>
    <?php }?>
    
    <?php if($this->_vars['update']){?>
    <form name="content" method="post" action="?action=update">
    <input type="hidden" name="id" value="<?php echo $this->_vars['id'];?>" />
    <input type="hidden" name="prev_url" value="<?php echo $this->_vars['prev_url'];?>" />
    <table cellspacing=0 class="content">
            <tr><th><b>发布一条新文档</b></th></tr>
            <tr><td>文档标题：<input type="text" name="title" value="<?php echo $this->_vars['titlec'];?>" class="text" /><span class="blue"> 【必填】</span> (* 标题2-50字符)</td></tr>
            <tr><td>&nbsp栏 目 ： <select name="nav"><option value="" style="padding:0">请选择一个栏目类别</option><?php echo $this->_vars['nav'];?></select><span class="blue"> 【必选】</span></td></tr>
            <tr><td>定义属性：<?php echo $this->_vars['attr'];?>
            </td></tr>
            <tr><td>TAG标签： <input type="text" name="tag" value="<?php echo $this->_vars['tag'];?>" class="text" /> (* 每个标签用','隔开,总长度30)</td></tr>
            <tr><td>关键字 ： <input type="text" name="keyword" value="<?php echo $this->_vars['keyword'];?>" class="text" /> (* 每个关键字用','隔开,总长度30)</td></tr>
            <tr><td>缩略图 ： <input type="text" name="thumbnail" class="text" value="<?php echo $this->_vars['thumbnail'];?>" readonly="readonly" />
                          <input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','600','400')" />
                          <img name="pic" src="<?php echo $this->_vars['thumbnail'];?>" style="display:block;" /> (* 缩略图2M内,格式:JPG GIF PNG)
            </td></tr>
            <tr><td>文章来源：<input type="text" name="source" value="<?php echo $this->_vars['source'];?>" class="text" /> (* 文章来源20位之内)</td></tr>
            <tr><td>&nbsp作 者 ： <input type="text" name="author" value="<?php echo $this->_vars['author'];?>" class="text" /> (* 作者名10位内)</td></tr>
            <tr><td><span class="middle">内容摘要：</span><textarea name="info"><?php echo $this->_vars['info'];?></textarea> <span class="middle">(* 内容摘要200内)</span></td></tr>
            <tr class="ckeditor"><td><textarea id="TextArea1" name="content" class="ckeditor"><?php echo $this->_vars['content'];?></textarea></td></tr>
            <tr><td>评论选项：<?php echo $this->_vars['commend'];?>
            &nbsp&nbsp&nbsp&nbsp 浏览次数：<input type="text" name="count" value="<?php echo $this->_vars['count'];?>" class="text small" />
            <tr><td>文档排序：<select name="sort">
                                <?php echo $this->_vars['sort'];?>
                           </select>
            &nbsp&nbsp&nbsp&nbsp 消费金币：<input type="text" name="gold" value="<?php echo $this->_vars['gold'];?>" class="text small" />
            <tr><td>阅读权限：<select name="readlimit">
                                <?php echo $this->_vars['readlimit'];?>
                           </select>
            &nbsp&nbsp&nbsp&nbsp标题颜色： <select name="color">
                                <?php echo $this->_vars['color'];?>
                           </select>
            </td></tr>
            <tr><td><input type="submit" name="send" onclick="return checkAddContent();" value="修改文档" /><input type="reset" value="重置" /></td></tr>
            <tr><td></td></tr>
        </table>
        </form>
    
    <?php }?>
    
    
</body>
</html>