-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost:3306
-- 生成日期: 2018 年 04 月 26 日 03:44
-- 服务器版本: 5.0.83-community-nt
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ferre666`
--

-- --------------------------------------------------------

--
-- 表的结构 `f_photo_commend`
--

CREATE TABLE IF NOT EXISTS `f_photo_commend` (
  `f_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `f_title` varchar(20) NOT NULL COMMENT '//评论标题',
  `f_content` text NOT NULL COMMENT '//评论内容',
  `f_sid` mediumint(8) unsigned NOT NULL COMMENT '//图片ID',
  `f_username` varchar(20) NOT NULL COMMENT '//评论者',
  `f_date` datetime NOT NULL COMMENT '//评论时间',
  PRIMARY KEY  (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `f_photo_commend`
--

INSERT INTO `f_photo_commend` (`f_id`, `f_title`, `f_content`, `f_sid`, `f_username`, `f_date`) VALUES
(1, 'TO : 可以', '你好呀', 10, '李梦阳', '2016-09-09 23:51:48'),
(2, 'TO : 可以', '你好呀', 10, '李梦阳', '2016-09-09 23:53:09'),
(3, 'TO : 可以', '我不好', 10, '李梦阳', '2016-09-09 23:53:58'),
(4, 'TO : 可以', '啊？', 10, '李梦阳', '2016-09-09 23:55:16'),
(5, 'TO : 111', '11', 8, '李梦阳', '2016-09-09 23:55:44'),
(6, 'TO : 111', '11', 8, '李梦阳', '2016-09-09 23:56:05'),
(7, 'TO : 呀1', '可以，很强势', 11, '李梦阳', '2016-09-09 23:58:03'),
(8, 'TO : 111', '强势', 8, '李梦阳', '2016-09-10 00:25:28'),
(9, 'TO : 111', '啊啊啊啊啊', 8, '李梦阳', '2016-09-10 00:29:19'),
(10, 'TO : 111', '不错的呀', 8, '过分了', '2016-09-10 00:43:02'),
(11, 'TO : 55', '111', 20, '李梦阳', '2016-09-10 16:22:49'),
(12, 'TO : 可以的', '111', 12, '过分了', '2016-09-10 19:50:30'),
(13, 'TO : 21213', 'Admin', 28, '过分了', '2016-09-10 22:26:32');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845464 bytes) in <b>Unknown</b> on line <b>0</b><br />
