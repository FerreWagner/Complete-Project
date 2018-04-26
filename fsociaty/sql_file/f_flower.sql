-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost:3306
-- 生成日期: 2018 年 04 月 26 日 03:43
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
-- 表的结构 `f_flower`
--

CREATE TABLE IF NOT EXISTS `f_flower` (
  `f_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `f_touser` varchar(20) NOT NULL COMMENT '//收到赞的人',
  `f_fromuser` varchar(20) NOT NULL COMMENT '//点赞的人',
  `f_flower` mediumint(8) unsigned NOT NULL COMMENT '//点赞个数',
  `f_content` varchar(200) NOT NULL COMMENT '//感言',
  `f_date` datetime NOT NULL COMMENT '//点赞时间',
  PRIMARY KEY  (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `f_flower`
--

INSERT INTO `f_flower` (`f_id`, `f_touser`, `f_fromuser`, `f_flower`, `f_content`, `f_date`) VALUES
(5, '过分了', '雷克萨', 7, '赞同您的言论', '2016-08-24 18:03:07'),
(6, 'Samaritan', 'Admin', 10, '赞同您的言论', '2016-11-03 14:17:49'),
(7, '戴泽', 'Admin', 9, '赞同您的言论', '2017-04-29 21:14:32');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845334 bytes) in <b>Unknown</b> on line <b>0</b><br />
