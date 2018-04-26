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
-- 表的结构 `f_news`
--

CREATE TABLE IF NOT EXISTS `f_news` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '文章ID',
  `user` varchar(20) NOT NULL COMMENT '用户',
  `title` varchar(100) NOT NULL COMMENT '新闻标题',
  `content` text NOT NULL COMMENT '新闻内容',
  `time` text NOT NULL COMMENT '发布时间',
  `img` varchar(255) NOT NULL COMMENT '发布图片',
  `sort` int(10) unsigned NOT NULL default '10',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `f_news`
--

INSERT INTO `f_news` (`id`, `user`, `title`, `content`, `time`, `img`, `sort`) VALUES
(9, 'root', '12', '321', '2017-04-13 18:12:35', 'new_img/2929b74543a9822614e97f738882b9014b90ebac.jpg', 10),
(11, 'root', '123', '3421', '2017-04-13 18:18:54', 'new_img/822f98f4e421abe3b8d28506974dd5e6.png', 10),
(12, 'root', '123', '321', '2017-04-13 18:21:13', 'new_img/c1d65bb5c9ea15ceba3cdf44b7003af33887b29e.jpg', 10),
(13, 'root', '1', '2', '2017-04-13 18:21:24', 'new_img/psb (1).jpg', 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845594 bytes) in <b>Unknown</b> on line <b>0</b><br />
