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
-- 表的结构 `f_other`
--

CREATE TABLE IF NOT EXISTS `f_other` (
  `f_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID值',
  `f_username` varchar(20) NOT NULL COMMENT '//用户名',
  `f_sug` text COMMENT '//用户建议',
  `f_join` text COMMENT '//用户联系方式',
  `f_bug` text COMMENT '//网站BUG',
  `f_other` text COMMENT '//其他意见',
  `f_date` datetime NOT NULL COMMENT '//发表时间',
  PRIMARY KEY  (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `f_other`
--

INSERT INTO `f_other` (`f_id`, `f_username`, `f_sug`, `f_join`, `f_bug`, `f_other`, `f_date`) VALUES
(1, '过分了', '', NULL, NULL, NULL, '2016-09-12 17:23:38'),
(2, '过分了', '', NULL, NULL, NULL, '2016-09-12 17:23:53'),
(3, '过分了', '提交', NULL, NULL, NULL, '2016-09-12 17:28:13'),
(4, '过分了', '我的意见', NULL, NULL, NULL, '2016-09-12 17:29:30'),
(5, '过分了', NULL, '', NULL, NULL, '2016-09-12 17:34:51'),
(6, '过分了', NULL, '', NULL, NULL, '2016-09-12 17:36:27'),
(7, '过分了', NULL, '', NULL, NULL, '2016-09-12 17:36:54'),
(8, '过分了', NULL, '。。。', NULL, NULL, '2016-09-12 17:37:19'),
(10, '过分了', NULL, NULL, '开发组牛逼呀', NULL, '2016-09-12 17:41:19'),
(11, '过分了', NULL, NULL, NULL, '没啥了', '2016-09-12 17:45:59'),
(12, '过分了', NULL, NULL, '', NULL, '2016-09-14 20:58:56'),
(13, 'Admin', NULL, NULL, '没有反馈', NULL, '2016-10-14 12:10:47'),
(14, 'HATE', '没有意见', NULL, NULL, NULL, '2016-10-14 12:12:13'),
(15, 'Admin', NULL, '阿德斯犯规好久不见\r\n', NULL, NULL, '2017-01-30 16:20:18'),
(16, 'root', 'asda ', NULL, NULL, NULL, '2017-04-13 14:28:39'),
(17, 'root', NULL, 'da', NULL, NULL, '2017-04-13 14:34:39');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845464 bytes) in <b>Unknown</b> on line <b>0</b><br />
