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
-- 表的结构 `f_dir`
--

CREATE TABLE IF NOT EXISTS `f_dir` (
  `f_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `f_name` varchar(20) NOT NULL COMMENT '//相册目录名',
  `f_type` tinyint(1) unsigned NOT NULL COMMENT '//相册类型',
  `f_password` char(40) default NULL COMMENT '//相册密码',
  `f_content` text COMMENT '//相册的描述',
  `f_face` varchar(200) default NULL COMMENT '//相册目录封面',
  `f_dir` varchar(600) NOT NULL COMMENT '//相册物理地址',
  `f_date` datetime NOT NULL COMMENT '//相册创建的时间',
  PRIMARY KEY  (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `f_dir`
--

INSERT INTO `f_dir` (`f_id`, `f_name`, `f_type`, `f_password`, `f_content`, `f_face`, `f_dir`, `f_date`) VALUES
(16, '第一个公开相册', 0, NULL, '目录', 'pic/newuser/friend3.jpg', 'photo/1473406801', '2016-09-09 15:40:01'),
(17, 'public', 0, NULL, 'public.\r\n', 'pic/newuser/friend3.jpg', 'photo/1473416394', '2016-09-09 18:19:54'),
(18, 'public 2', 0, NULL, 'public 2', 'pic/you.png', 'photo/1473473257', '2016-09-10 10:07:37'),
(19, '开发组选项', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '1', 'pic/newuser/friend3.jpg', 'photo/1473474554', '2016-09-10 10:29:14'),
(21, 'public 3', 0, NULL, 'test', 'pic/newuser/friend3.jpg', 'photo/1473489201', '2016-09-10 14:33:21'),
(22, 'Admin', 0, NULL, '奥斯丁', NULL, 'photo/1479391645', '2016-11-17 22:01:06');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845594 bytes) in <b>Unknown</b> on line <b>0</b><br />
