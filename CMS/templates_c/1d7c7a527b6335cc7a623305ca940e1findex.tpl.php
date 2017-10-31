<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_config['webname'];?></title>
<link rel="stylesheet" type="text/css" href="style/index.css">
<link rel="stylesheet" type="text/css" href="style/basic.css">
<script type="text/javascript" src="js/reg.js"></script>
<script type="text/javascript" src="config/static.php?type=index"></script>
</head>
<body>
    <?php $_tpl->create('header.tpl')?>
    
<div id="user">
	<?php if($this->_vars['cache']){?>
		<?php echo $this->_vars['member'];?>
	<?php }else{?>
		<?php if(@$this->_vars['login']){?>
		<h2>会员登录</h2>
		<form method="post" name="login" action="register.php?action=login">
			<label>用户名：<input type="text" name="user" class="text" /></label>
			<label>密　码：<input type="password" name="pass" class="text" /></label>
			<label class="yzm">验证码：<input type="text" name="code" class="text code" /> <img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /></label>
			<p><input type="submit" name="send" value="登录" onclick="return checkLogin();" class="submit" /> <a href="register.php?action=reg">注册会员</a> <a href="###">忘记密码?</a></p>
		</form>
		<?php }else{?>
		<h2>会员信息</h2>
		<div class="a">您好，<strong><?php echo $this->_vars['user'];?></strong> 欢迎光临</div>
		<div class="b">
			<img src="images/<?php echo $this->_vars['face'];?>" width=110px;height=80px; alt="<?php echo $this->_vars['user'];?>" />
			<a href="###">个人中心</a>
			<a href="###">我的评论</a>
			<a href="register.php?action=logout">退出登录</a>
		</div>
		<?php }?>
	<?php }?>
        
        
        <h3>最 近 登 录 用 户 <span>———————————————</span></h3>
        <?php if($this->_vars['AllLaterUser']){?>
        <?php foreach ($this->_vars['AllLaterUser'] as $key=>$value) { ?>
        <dl>
            <dt><img src="images/<?php echo $value->face?>" alt="<?php echo $value->user?>" /></dt>
            <dd><?php echo $value->user?></dd>
        </dl>
        <?php }?>
        <?php }?>
        
    </div>
    <div id="news">
        <h3><a href="">联合利华因散布不法信息被罚</a></h3>
        <p>联合利华集团是由荷兰Margarine Unie人造奶油公司和英国Lever Brothers香皂公司于 1929年合并而成。总部设于荷兰鹿特丹和英国伦敦，分别负责食品及洗涤用品事业的经营...<a href="">【查看全文】</a></p>
        <p class="link">
            <a href="">优酷土豆联合投放系统 全面提升媒介代理效率</a>
            <a href="">优酷土豆和阿里妈妈还分别发布了基于大数据的精准营销方案“星战计划”和开放数据管理平台“达摩盘”(Alimama DMP)。 </a>
            <a href="">作为整合的重要策略之一，优酷土豆已完成统一广告投放系统，彻底解决两个网站投放当中的重合及浪费问题。</a>
            <a href="">5月20日,由视全十美与优酷自频道联合举办的优质原创视频项目路演在上海成功落幕,优酷自频道与视全十美的相关负责人出席了本次路演。</a>
        </p>
        <ul>
            <li><em>16-08</em><a href="">天安门升旗仪式后 游客自发捡垃圾(图)</a></li>
            <li><em>16-02</em><a href="">民族天赋！三沙永兴岛开始种菜了，月产万余斤(组图)</a></li>
            <li><em>16-03</em><a href="">甲午战争英雄舰“致远”纪念舰正式下水(图)</a></li>
            <li><em>16-01</em><a href="">李开复:让95后接触敢冒险的创新创业思维</a></li>
            <li><em>15-06</em><a href="">11月起国家旅游局将定期公布“厕所黑榜”</a></li>
            <li><em>16-01</em><a href="">徐玉玉被电信诈骗致死案7名嫌犯被批捕</a></li>
            <li><em>15-02</em><a href="">四成受访者认为取消三本会淡化学校歧视</a></li>
            <li><em>16-03</em><a href="">七种方式帮助你在未来轻松拜访宇宙邻居</a></li>
            <li><em>16-04</em><a href="">国庆期间京严查房地产市场 规范销售行为</a></li>
        </ul>
    </div>
    <div id="pic">
        <img src="images/ad.jpg" alt="新闻图片" width=300px height=240px />妈咪宝贝
    </div>
    <div id="rec">
        <h2>特别推荐</h2>
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
    <div id="sidebar-right">
        <div class="adver">
            <img src="images/ad2.jpg" width=358px height=200px alt="广告"></div>
            <div class="hot">
                <h2>本月热点</h2>
                <ul>
                    <li><a href=""><em>16-08</em>【时评】维护主权完整，这很重要！ </a></li>
                    <li><a href=""><em>15-12</em>【时评】“垃圾短信”，别动不动就</a></li>
                    <li><a href=""><em>16-02</em>【时评】通信“实名时代”，用行动告慰</a></li>
                    <li><a href=""><em>16-01</em>【时评】如此网络直播，是到了该整治的</a></li>
                    <li><a href=""><em>16-07</em>【时评】整治黑导游得下点真功夫</a></li>
                    <li><a href=""><em>16-02</em>【时评】网络的恶俗炒作之根源...</a></li>
                    <li><a href=""><em>16-09</em>【时评】“全民挖玉”造就不了富翁</a></li>
                    <li><a href=""><em>15-09</em>【时评】持证上岗的网络直播还会低俗吗</a></li>
        </ul>
            </div>
            <div class="comm">
                <h2>本月评论</h2>
                <ul>
                    <li><a href=""><em>16-08</em>【时评】维护主权完整，这很重要！ </a></li>
                    <li><a href=""><em>15-12</em>【时评】“垃圾短信”，别动不动就</a></li>
                    <li><a href=""><em>16-02</em>【时评】通信“实名时代”，用行动告慰</a></li>
                    <li><a href=""><em>16-01</em>【时评】如此网络直播，是到了该整治的</a></li>
                    <li><a href=""><em>16-07</em>【时评】整治黑导游得下点真功夫</a></li>
                    <li><a href=""><em>16-02</em>【时评】网络的恶俗炒作之根源...</a></li>
                    <li><a href=""><em>16-09</em>【时评】“全民挖玉”造就不了富翁</a></li>
                    <li><a href=""><em>15-09</em>【时评】持证上岗的网络直播还会低俗吗</a></li>
        </ul>
            </div>
            <div class="vote">
                <h2>调查投票</h2>
                <h3>请问您是怎么知道本站的</h3>
                <form>
                    <label><input type="radio" name="vote" checked="checked" />通过谷歌、百度等搜索引擎知道</label>
                    <label><input type="radio" name="vote" />通过门户网站的友情链接</label>
                    <label><input type="radio" name="vote" />通过广告</label>
                    <label><input type="radio" name="vote" />通过朋友介绍或者其他人的推广</label>
                    <p><input type="submit" value="投票" name="send" /><input type="button" value="查看" /></p>
                </form>
            </div>
    </div>
    <div id="picnews">
        <h2>图文资讯</h2>
        <dl>
            <dt><a href=""><img src="images/wo.jpg" width=190px height=130px alt="标题" /></a></dt>
            <dd><a href="">艾尚</a></dd>
        </dl>
        <dl>
            <dt><a href=""><img src="images/wo1.jpg" width=190px height=130px alt="标题" /></a></dt>
            <dd><a href="">妇炎洁</a></dd>
        </dl>
        <dl>
            <dt><a href=""><img src="images/wo2.jpg" width=190px height=130px alt="标题" /></a></dt>
            <dd><a href="">女性指引</a></dd>
        </dl>
        <dl>
            <dt><a href=""><img src="images/wo3.jpg" width=190px height=130px alt="标题" /></a></dt>
            <dd><a href="">关于唇彩的秘密</a></dd>
        </dl>
    </div>
    <div id="newslist">
        <div class="list bottom">
            <h2><a href="">更多</a>新闻动态</h2>
                <ul>
                    <li><em>16-08</em><a href="">天安门升旗仪式后 游客自发捡垃圾(图)</a></li>
                    <li><em>16-02</em><a href="">民族天赋！三沙永兴岛开始种菜了，月产万余斤(组图)</a></li>
                    <li><em>16-03</em><a href="">甲午战争英雄舰“致远”纪念舰正式下水(图)</a></li>
                    <li><em>16-01</em><a href="">李开复:让95后接触敢冒险的创新创业思维</a></li>
                    <li><em>15-06</em><a href="">11月起国家旅游局将定期公布“厕所黑榜”</a></li>
                    <li><em>16-01</em><a href="">徐玉玉被电信诈骗致死案7名嫌犯被批捕</a></li>
                    <li><em>15-02</em><a href="">四成受访者认为取消三本会淡化学校歧视</a></li>
                    <li><em>16-03</em><a href="">七种方式帮助你在未来轻松拜访宇宙邻居</a></li>
                    <li><em>16-04</em><a href="">国庆期间京严查房地产市场 规范销售行为</a></li>
                    <li><em>15-06</em><a href="">11月起国家旅游局将定期公布“厕所黑榜”</a></li>
            </ul>
        </div>
        <div class="list right bottom">
            <h2><a href="">更多</a>八卦娱乐</h2>
            <ul>
                    <li><em>16-08</em><a href="">天安门升旗仪式后 游客自发捡垃圾(图)</a></li>
                    <li><em>16-02</em><a href="">民族天赋！三沙永兴岛开始种菜了，月产万余斤(组图)</a></li>
                    <li><em>16-03</em><a href="">甲午战争英雄舰“致远”纪念舰正式下水(图)</a></li>
                    <li><em>16-01</em><a href="">李开复:让95后接触敢冒险的创新创业思维</a></li>
                    <li><em>15-06</em><a href="">11月起国家旅游局将定期公布“厕所黑榜”</a></li>
                    <li><em>16-01</em><a href="">徐玉玉被电信诈骗致死案7名嫌犯被批捕</a></li>
                    <li><em>15-02</em><a href="">四成受访者认为取消三本会淡化学校歧视</a></li>
                    <li><em>16-03</em><a href="">七种方式帮助你在未来轻松拜访宇宙邻居</a></li>
                    <li><em>16-04</em><a href="">国庆期间京严查房地产市场 规范销售行为</a></li>
                    <li><em>15-06</em><a href="">11月起国家旅游局将定期公布“厕所黑榜”</a></li>
            </ul>
        </div>
        <div class="list">
            <h2><a href="">更多</a>时尚女人</h2>
            <ul>
                    <li><em>16-08</em><a href="">天安门升旗仪式后 游客自发捡垃圾(图)</a></li>
                    <li><em>16-02</em><a href="">民族天赋！三沙永兴岛开始种菜了，月产万余斤(组图)</a></li>
                    <li><em>16-03</em><a href="">甲午战争英雄舰“致远”纪念舰正式下水(图)</a></li>
                    <li><em>16-01</em><a href="">李开复:让95后接触敢冒险的创新创业思维</a></li>
                    <li><em>15-06</em><a href="">11月起国家旅游局将定期公布“厕所黑榜”</a></li>
                    <li><em>16-01</em><a href="">徐玉玉被电信诈骗致死案7名嫌犯被批捕</a></li>
                    <li><em>15-02</em><a href="">四成受访者认为取消三本会淡化学校歧视</a></li>
                    <li><em>16-03</em><a href="">七种方式帮助你在未来轻松拜访宇宙邻居</a></li>
                    <li><em>16-04</em><a href="">国庆期间京严查房地产市场 规范销售行为</a></li>
                    <li><em>15-06</em><a href="">11月起国家旅游局将定期公布“厕所黑榜”</a></li>
            </ul>
        </div>
        <div class="list right">
            <h2><a href="">更多</a>科技频道</h2>
            <ul>
                    <li><em>16-08</em><a href="">天安门升旗仪式后 游客自发捡垃圾(图)</a></li>
                    <li><em>16-02</em><a href="">民族天赋！三沙永兴岛开始种菜了，月产万余斤(组图)</a></li>
                    <li><em>16-03</em><a href="">甲午战争英雄舰“致远”纪念舰正式下水(图)</a></li>
                    <li><em>16-01</em><a href="">李开复:让95后接触敢冒险的创新创业思维</a></li>
                    <li><em>15-06</em><a href="">11月起国家旅游局将定期公布“厕所黑榜”</a></li>
                    <li><em>16-01</em><a href="">徐玉玉被电信诈骗致死案7名嫌犯被批捕</a></li>
                    <li><em>15-02</em><a href="">四成受访者认为取消三本会淡化学校歧视</a></li>
                    <li><em>16-03</em><a href="">七种方式帮助你在未来轻松拜访宇宙邻居</a></li>
                    <li><em>16-04</em><a href="">国庆期间京严查房地产市场 规范销售行为</a></li>
                    <li><em>15-06</em><a href="">11月起国家旅游局将定期公布“厕所黑榜”</a></li>
            </ul>
        </div>
    </div>
    <?php $_tpl->create('footer.tpl')?>
    
</body>
</html>