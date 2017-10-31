-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-03-10 08:08:51
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youme`
--

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `name` varchar(225) NOT NULL,
  `passowrd` varchar(225) NOT NULL,
  `desc` text,
  `time` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`name`, `passowrd`, `desc`, `time`) VALUES
('ferre', 'wh1234', 'adsf', NULL),
('ferre', 'wh1234', 'adsf', NULL),
('1aaa', 'e8b12775df408172e97f472fa6918d607359d631', '123', '1488898141'),
('1aaa', 'e8b12775df408172e97f472fa6918d607359d631', '123', '1488898172'),
('bruce', 'e8b12775df408172e97f472fa6918d607359d631', 'faith', '1488898188'),
('bruce', 'e8b12775df408172e97f472fa6918d607359d631', 'faith', '1488898230'),
('你的', '4e8b4e9bf9b36969e6f312dcdb759ec462d77ff0', '安德森股份', '2017-03-07 22:51:30'),
('如果', '8e8c5ec37f5e13b87ab30d4342d59192030c5f43', '你还有我', '2017-03-07 22:56:39');

-- --------------------------------------------------------

--
-- 表的结构 `ym_admin`
--

CREATE TABLE `ym_admin` (
  `id` mediumint(9) NOT NULL COMMENT 'ID',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ym_admin`
--

INSERT INTO `ym_admin` (`id`, `username`, `password`) VALUES
(1, 'Admin', '96041bda933a4250dddd7e4550d60c40'),
(2, 'Ferre', '96041bda933a4250dddd7e4550d60c40'),
(6, '测试管理员密码', 'c4ca4238a0b923820dcc509a6f75849b'),
(5, 'Ferre1', '96041bda933a4250dddd7e4550d60c40');

-- --------------------------------------------------------

--
-- 表的结构 `ym_article`
--

CREATE TABLE `ym_article` (
  `id` mediumint(9) NOT NULL COMMENT 'ID',
  `title` varchar(40) NOT NULL COMMENT '标题',
  `keywords` varchar(150) NOT NULL COMMENT '关键字',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `pic` varchar(150) DEFAULT '0' COMMENT '缩略图目录',
  `content` text NOT NULL COMMENT '内容',
  `click` mediumint(9) NOT NULL DEFAULT '145' COMMENT '点击量',
  `cateid` mediumint(9) NOT NULL,
  `author` varchar(50) NOT NULL DEFAULT 'Ferre' COMMENT '作者',
  `time` int(10) NOT NULL COMMENT '发布时间戳'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ym_article`
--

INSERT INTO `ym_article` (`id`, `title`, `keywords`, `desc`, `pic`, `content`, `click`, `cateid`, `author`, `time`) VALUES
(13, '阿斯顿马丁', 'qita', '萨芬', NULL, '																																		', 232, 1, 'Ferre', 1484795936),
(12, '德国古典哲学', '暂无', '暂无', '/static/uploads/20170107/dd64731cccac2ed9fa6353a1941a8fb0.png', '', 133, 2, 'Ferre', 1483797893),
(16, '唯心主义', '唯心,黑格尔', '黑格尔历史哲学。', '/static/uploads/20170117/2b7ece402bf263048cb017ec67940146.jpg', '<p>black</p>', 121, 2, 'Ferre', 1484655510),
(14, 'Gothic', 'null,three days,life,death', '', '/static/uploads/20170117/23bd76744c533350a737c59ac5405f1e.jpg', '																	', 231, 1, 'Ferre', 1484649448),
(15, '测试文章', 'no keywords,other', '该文章不存在', '/static/uploads/20170117/9e5fa1361b75a38264cab71a263d636e.jpg', '<p>									</p><p>原标题：华北东北等地出现轻雾或霾 河北山西等地有重污染</p><p>　　中新网1月16日电&nbsp; 据中央气象台网站消息，今晨，华北、东北地区中南部及陕西等地出现轻雾或霾天气；并伴有轻到中度污染，河北中南部、山西、陕西中部等地有重度污染。北京城区空气质量为良或有轻度污染。</p><p style="border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 26px 0px 0px; color: rgb(0, 0, 0);">　　<strong style="border: 0px; margin: 0px; padding: 0px;">华北黄淮等地有霾天气过程</strong></p><p style="border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 26px 0px 0px; color: rgb(0, 0, 0);">　　16日至17日，华北中南部、黄淮、陕西关中等地空气污染扩散气象条件较差，霾天气逐渐发展，有轻至中度霾，河北中南部、河南北部、陕西关中等地有重度霾，最强时段出现在16日夜间至17日，部分地区伴有大雾，局地能见度不足200米；17日夜间起，霾自北向南逐渐减弱或消散，19日上述地区霾天气过程结束。</p><p style="border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 26px 0px 0px; color: rgb(0, 0, 0);">　　<strong style="border: 0px; margin: 0px; padding: 0px;">华北北部东北地区南部有弱降雪</strong></p><p style="border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 26px 0px 0px; color: rgb(0, 0, 0);">　　16至18日，先后受两次高空槽东移影响，内蒙古中部、华北北部、东北地区南部等地有小雪或零星小雪，局地中雪天气。</p><p><img src="/ueditor/php/upload/image/20170116/1484569249309484.jpeg" alt="全国降水量预报图(1月16日08时-17日08时)" width="481" height="379" align="middle" border="1" class="flag_bigP" style="border: 0px; margin: 0px; padding: 0px; font-size: 0px; color: transparent;"/></p><p>2</p><p><span style="border: 0px; margin: 0px; padding: 0px; font-size: 12px;">全国降水量预报图(1月16日08时-17日08时)</span></p><p style="border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 26px 0px 0px; color: rgb(0, 0, 0);">　　<strong style="border: 0px; margin: 0px; padding: 0px;">未来三天具体预报</strong></p><p style="border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 26px 0px 0px; color: rgb(0, 0, 0);">　　16日08时至17日08时，西藏西南部、青海东南部、河北东北部、内蒙古东南部等地有小雪或阵雪，西藏西南部局地中到大雪；西南地区东部、华南等地有小雨或阵雨(见图1)。台湾海峡、南海东北部和中东部将有6～8级、阵风9级的东北风。</p><p style="border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 26px 0px 0px; color: rgb(0, 0, 0);">　　17日08时至18日08时，河北东北部、辽宁、吉林南部、西藏西部、陕西南部、甘肃南部等地的部分地区有小雪或雨夹雪，局地中雪；西南地区东部、江淮南部、江南、华南等地有小雨，局地中雨。内蒙古中西部有4～6级风。台湾海峡、巴士海峡、南海东北部、南海中东部偏北、南海东南部局部海域将有6～7级、阵风8级的偏东或东北风。</p><p style="border: 0px; margin-top: 0px; margin-bottom: 0px; padding: 26px 0px 0px; color: rgb(0, 0, 0);">　　18日08时至19日08时，西藏西部、内蒙古中部、华北东北部等地的部分地区小雪，局地中雪；西南地区东部、江淮、江南、华南等地有小雨，局地中雨(见图3)。内蒙古中西部、华北西部等地部分地区有4～6级风。巴士海峡、南海东北部部分海域、南海东南部部分海域将有6～7级、阵风8级的偏东风。</p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p>								</p>', 185, 1, 'Ferre', 1484654630),
(17, '唯物主义的道路', '唯物,主义', '形而上学的末路', '/static/uploads/20170117/6ffbb143cc6eabb4f43fe59aeb0d1047.jpg', '<p>唯物</p>', 196, 3, 'Ferre', 1484655555),
(18, '测试文章1', 'other,no keywords', '暂时未添加', NULL, '<p>									</p><p>睫毛弯弯眼睛眨呀眨</p><p>								</p>', 135, 1, 'Ferre', 1484795511),
(19, '留言板的建设', '留言板,其他,other', 'null', NULL, '<p>无形的翅膀；</p>', 108, 6, 'Ferre', 1485251908),
(20, 'ABC\'s fate', 'other', 'other', NULL, '<p>not exist content.</p>', 10, 6, 'Ferre', 1485253210),
(21, 'admin管理员', '1', '2', NULL, '<p>不存在</p>', 1, 6, 'Ferre', 1485257692),
(22, 'Title About Admin', 'other', 'desc not exsit', NULL, '<p>Bravo.</p>', 8, 6, 'Admin', 1485263286);

-- --------------------------------------------------------

--
-- 表的结构 `ym_cate`
--

CREATE TABLE `ym_cate` (
  `id` mediumint(9) NOT NULL COMMENT 'ID',
  `catename` varchar(30) NOT NULL COMMENT '栏目名',
  `keywords` varchar(150) NOT NULL COMMENT '关键词',
  `desc` text NOT NULL COMMENT '栏目描述',
  `type` tinyint(1) DEFAULT '0' COMMENT '栏目类型；0列表；1留言'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ym_cate`
--

INSERT INTO `ym_cate` (`id`, `catename`, `keywords`, `desc`, `type`) VALUES
(1, '后现代主义', '阿达', '<p>啊啊啊啊</p>', 0),
(2, '唯心主义', '', '<p>存在</p>', 0),
(3, '唯物主义', '关键字不能为空测试', '', 0),
(6, '经验主义', '英国', '<p>三大经验主义</p>', 1),
(5, '解构主义', '解构 后现代', '<p>解构主义是后现代主义的分支</p>', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ym_link`
--

CREATE TABLE `ym_link` (
  `id` mediumint(9) NOT NULL,
  `title` varchar(30) NOT NULL COMMENT '链接标题',
  `desc` varchar(255) NOT NULL COMMENT '链接描述',
  `url` varchar(60) NOT NULL COMMENT '链接地址'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ym_link`
--

INSERT INTO `ym_link` (`id`, `title`, `desc`, `url`) VALUES
(1, '维基百科', '维基百科友情链接。', 'https://en.wikipedia.org/wiki/Wikipedia'),
(2, '百度', '百度一下，你就知道。', 'https://www.baidu.com/'),
(3, 'PPAP', '洒', '奥斯丁'),
(4, '萨达是', '', '是'),
(5, '测试修改链接', '测试链接1', 'null'),
(7, '新浪微博', '暂无。', 'http://weibo.com/u/3877828291/home?wvr=5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ym_admin`
--
ALTER TABLE `ym_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ym_article`
--
ALTER TABLE `ym_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ym_cate`
--
ALTER TABLE `ym_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ym_link`
--
ALTER TABLE `ym_link`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ym_admin`
--
ALTER TABLE `ym_admin`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `ym_article`
--
ALTER TABLE `ym_article`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=23;
--
-- 使用表AUTO_INCREMENT `ym_cate`
--
ALTER TABLE `ym_cate`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `ym_link`
--
ALTER TABLE `ym_link`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
