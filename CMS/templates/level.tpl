<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css">
<script type="text/javascript" src=../js/admin_level.js></script>
</head>
<body id="main">
<div class="map">
    管理首页 &gt;&gt;等级管理    &gt;&gt;<b id="title">{$title}</b>
</div>
    error_reporting(E_ALL & ~E_NOTICE)
    
    <ol>
        <li><a href="level.php?action=show" class="selected">等级列表</a></li>
        <li><a href="level.php?action=add">新增等级</a></li>
            {if $update}
                <li><a href="level.php?action=update&id={$id}">修改等级</a></li>
            {/if}
    </ol>
    
    
    {if $show}
        <table cellspacing=0>
            <tr><th>编号</th><th>等级名称</th><th>描述</th><th>操作</th></tr>
                {if $AllLevel}
                {foreach $AllLevel(key,value)}
            <tr><td><script type="text/javascript" >document.write({@key+1}+{$num});</script></td><td>{@value->level_name}</td><td>{@value->level_info}</td><td><a href="level.php?action=update&id={@value->id}">修改 </a> | <a href="level.php?action=delete&id={@value->id}" onclick="return confirm('确定删除?') ? true : false"> 删除</a></td></tr>
                {/foreach}
                {else}
                <tr><td colspan="4">抱歉,没有任何数据</td></tr>
                {/if}
        </table>
        <div id="page">{$page}</div>
    {/if}
    
    {if $add}
        <form method="post" name="add" class="left">
            <table cellspacing=0>
                <tr><td>等级名称：<input type="text" name="level_name" class="text" />(* 等级名称不得小于两位、大于20位)</td></tr>
                <tr><td><textarea name="level_info"></textarea>(* 描述不得大于200位)</td></tr>
                <tr><td><input type="submit" name="send" value="新增等级" onclick="return checkAddForm" class="submit level" />【 <a href="{$prev_url}">返回列表</a> 】</td></tr>
            </table>
        </form>
    {/if}
    
    <div id="left">
    {if $update}
        <form method="post" name="update" class="left">
        <input type="hidden" value="{$id}" name="id" />
        <input type="hidden" value="{$prev_url}" name="prev_url" />
            <table cellspacing=0>
                <tr><td>等级名称：<input type="text" name="level_name" value="{$level_name}" class="text" /></td></tr>
                <tr><td><textarea name="level_info">{$level_info}</textarea></td></tr>
                <tr><td><input type="submit" name="send" value="修改等级" class="submit level" />【 <a href="{$prev_url}">返回列表</a> 】</td></tr>
            </table>
        </form>
    {/if}
    
  
    
    </div>

</body>
</html>