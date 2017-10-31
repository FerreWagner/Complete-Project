<script type="text/javascript" src="config/static.php/?type=header"></script>
<div id="top">
        {$header}
        <a href="###" class="adv">这里可以放置文字广告一</a>
        <a href="###" class="adv">这里可以放置文字广告一</a>
    </div>
    <div id="header">
        <h1><a href=#>F-sociaty</a></h1>
        <div class="adver"><a href=#><img src="images/nav2.jpg" alt="广告图" width=690px; height=100px /></a></div>
    </div>
    <div id="nav">
        <ul>
            <li><a href="./">首页</a></li>
            {if $FrontNav}
            {foreach $FrontNav(key,value)}
            <li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
            {/foreach}
            {/if}
        </ul>
    </div>
    <div id="search">
        <form>
            <select name="search">
                <option selected="selected">按标题</option>
                <option>按关键字</option>
                <option>按全局</option>
            </select>
            <input type="text" name="keyword" class="text" />
            <input type="submit" name="send" value="搜索" class="submit" />
        </form>
        <strong>TAG标签:</strong>
        <ul>
            <li><a href="">基金(3)</a></li>
            <li><a href="">白兰地(1)</a></li>
            <li><a href="">音乐(6)</a></li>
            <li><a href="">体育(1)</a></li>
            <li><a href="">直播(1)</a></li>
            <li><a href="">会晤(1)</a></li>
            <li><a href="">韩日(1)</a></li>
            <li><a href="">要闻(1)</a></li>
            <li><a href="">城市(2)</a></li>
        </ul>
    </div>