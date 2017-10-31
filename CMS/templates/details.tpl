<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{webname}--></title>
<link rel="stylesheet" type="text/css" href="style/basic.css">
<link rel="stylesheet" type="text/css" href="style/details.css">
<script type="text/javascript" src="config/static.php?id={$id}&type=details"></script>
</head>
<body>

error_reporting(E_ALL & ~E_NOTICE)
    {include file='header.tpl'}
    <div id="details">
        <h2>当前位置&gt;{$nav}</h2>
        <h4>{$titlec}</h4>
        <div class="d1">发布时间： {$date} 来源： {$source} 作者： {$author} 点击量：{$count}次  </div>
        <div class="d2">{$info}</div>
        <div class="d3">{$content}</div>
        <div class="d4">TAB标签,{$tag}</div>
        <div class="d5">
	<form method="post" action="feedback.php" target="_blank">
		<p>你对本文的态度：<input type="radio" name="state" value="1" checked="checked" /> 支持
									<input type="radio" name="state" value="0" /> 中立
									<input type="radio" name="state" value="-1" /> 反对
		</p>
		<p class="red">请遵守互联网规则，不要发表关于政治、反动、色情之类的评论。</p>
		<p><textarea name="content"></textarea></p>
		<p style="position:relative;top:-5px;">
			 验证码：<input type="text" class="text" name="code" />
			 <img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /> 
			 <input type="submit" class="submit" name="send" value="提交评论" />
		</p>
	</form>
        </div>
    </div>
    
    <div id="sidebar">
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