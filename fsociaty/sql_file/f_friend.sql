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
-- 表的结构 `f_friend`
--

CREATE TABLE IF NOT EXISTS `f_friend` (
  `f_id` mediumint(8) NOT NULL auto_increment COMMENT '//主键',
  `f_touser` varchar(20) NOT NULL COMMENT '//被添加的好友',
  `f_fromuser` varchar(20) NOT NULL COMMENT '//添加的人',
  `f_content` varchar(200) NOT NULL COMMENT '//请求验证信息',
  `f_state` varchar(1) NOT NULL default '0' COMMENT '//验证',
  `f_date` datetime NOT NULL COMMENT '//添加时间',
  PRIMARY KEY  (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `f_friend`
--

INSERT INTO `f_friend` (`f_id`, `f_touser`, `f_fromuser`, `f_content`, `f_state`, `f_date`) VALUES
(1, '过分了', '过分了', '你好啊，交个朋友吧', '1', '2016-08-23 16:54:04'),
(2, '雷克萨', '过分了', '你好啊，交个朋友吧', '1', '2016-08-23 16:54:16'),
(3, '111', '过分了', '你好啊，交个朋友吧', '0', '2016-08-23 17:02:30'),
(6, '你好', '过分了', '你好啊，交个朋友吧', '0', '2016-08-23 20:13:08'),
(7, '过分了', 'ROOT1', '你好，父亲', '1', '2016-08-23 20:15:33'),
(8, '戴泽', '过分了', '你好啊，交个朋友吧', '1', '2016-08-27 18:00:36'),
(9, 'Samaritan', '过分了', '你好啊，交个朋友吧', '0', '2016-08-29 16:46:42'),
(10, '你好呀啊', 'Admin', 'hello', '0', '2016-11-03 14:16:41');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845334 bytes) in <b>Unknown</b> on line <b>0</b><br />
