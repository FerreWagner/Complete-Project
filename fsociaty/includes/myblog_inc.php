<div id="head">
<h2>我的博客</h2>
</div>

<div id="shang" align=center>
<ul>
    <li><a href="myblog.php">我的文章</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp|</li>    
    <li><a href=>收藏文章</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp |</li>    
    <li><a href="myblog_talk.php">我的评论</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp |</li>    
    <?php 
        $_add_dir = $_SERVER['PHP_SELF'];
        $_add_dir = substr($_add_dir, -24);
        if($_add_dir == 'myblog_photo_add_dir.php'){
            echo '<li><a href="myblog_photo_add_dir.php">添加相册</a></li>';
        }else{
            echo '<li><a href="myblog_photo.php">我的相册</a></li>';
        }
    ?>
    
</ul>
    </div>