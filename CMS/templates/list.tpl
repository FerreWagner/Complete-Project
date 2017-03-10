<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="style/basic.css">
<link rel="stylesheet" type="text/css" href="style/list.css">

</head>
<body>
error_reporting(E_ALL & ~E_NOTICE)
    {include file='header.tpl'}
    <div id="list">
        <h2>当前位置&gt;{$nav}</h2>
        {if $AllListContent}
        {foreach $AllListContent(key,value)}
        <script type="text/javascript" src="config/static.php?type=list&id={@value->id}"></script>
        <dl>
            <dt><a href="details.php?id={@value->id}" target="_blank"><img alt="news" src="{@value->thumbnail}" width=190px; height=120px></a></dt>
            <dd>[<b>{@value->nav_name}</b>]<a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></dd>
            <dd>日期：{@value->date} 点击率：{@value->count} 好评：0</dd>
            <dd>内容简介：{@value->info}</dd>
        </dl>
        {/foreach}
        {else}
        <p class="none">没有任何数据</p>
        {/if}
        <div id="page">{$page}</div>
    </div>
    
    
    <div id="sidebar">
        <div class="nav">
            <h2><a href="">子栏目列表</a></h2>
            {if $childnav}
            {foreach $childnav(key,value)}
            <b><a href="list.php?id={@value->id}">{@value->nav_name}</a></b>
            {/foreach}
            {else}
            <span>该栏目没有子类</span>
            {/if}
        </div>
            <div class="right">
            <h2>本类推荐</h2>
            <ul>
                <li><a href=""><em>16-08</em>【时评】维护主权完整，这很重要！ </a></li>
                <li><a href=""><em>15-12</em>【时评】“垃圾短信”，别动不动就</a></li>
                <li><a href=""><em>16-02</em>【时评】通信“实名时代”，用行动告慰</a></li>
                <li><a href=""><em>16-01</em>【时评】如此网络直播，是到了该整治的</a></li>
                <li><a href=""><em>16-07</em>【时评】整治黑导游得下点真功夫</a></li>
                <li><a href=""><em>16-02</em>【时评】网络的恶俗炒作之根源...</a></li>
                <li><a href=""><em>16-09</em>【时评】“全民挖玉”造就不了富翁</a></li>
                <li><a href=""><em>15-09</em>【时评】持证上岗的网络直播还会低俗吗</a></li>
                <li><a href=""><em>16-01</em>【杂谈】红军长征的胜利是信仰的胜利！</a></li>
            </ul>
            </div>
            <div class="right">
            <h2>本类热点</h2>
            <ul>
                <li><a href=""><em>16-08</em>【时评】维护主权完整，这很重要！ </a></li>
                <li><a href=""><em>15-12</em>【时评】“垃圾短信”，别动不动就</a></li>
                <li><a href=""><em>16-02</em>【时评】通信“实名时代”，用行动告慰</a></li>
                <li><a href=""><em>16-01</em>【时评】如此网络直播，是到了该整治的</a></li>
                <li><a href=""><em>16-07</em>【时评】整治黑导游得下点真功夫</a></li>
                <li><a href=""><em>16-02</em>【时评】网络的恶俗炒作之根源...</a></li>
                <li><a href=""><em>16-09</em>【时评】“全民挖玉”造就不了富翁</a></li>
                <li><a href=""><em>15-09</em>【时评】持证上岗的网络直播还会低俗吗</a></li>
                <li><a href=""><em>16-01</em>【杂谈】红军长征的胜利是信仰的胜利！</a></li>
            </ul>
            </div>
            <div class="right">
            <h2>本类图文</h2>
            <ul>
                <li><a href=""><em>16-08</em>【时评】维护主权完整，这很重要！ </a></li>
                <li><a href=""><em>15-12</em>【时评】“垃圾短信”，别动不动就</a></li>
                <li><a href=""><em>16-02</em>【时评】通信“实名时代”，用行动告慰</a></li>
                <li><a href=""><em>16-01</em>【时评】如此网络直播，是到了该整治的</a></li>
                <li><a href=""><em>16-07</em>【时评】整治黑导游得下点真功夫</a></li>
                <li><a href=""><em>16-02</em>【时评】网络的恶俗炒作之根源...</a></li>
                <li><a href=""><em>16-09</em>【时评】“全民挖玉”造就不了富翁</a></li>
                <li><a href=""><em>15-09</em>【时评】持证上岗的网络直播还会低俗吗</a></li>
                <li><a href=""><em>16-01</em>【杂谈】红军长征的胜利是信仰的胜利！</a></li>
            </ul>
            </div>
    </div>
    {include file="footer.tpl"}
    
</body>
</html>