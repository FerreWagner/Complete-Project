-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost:3306
-- 生成日期: 2018 年 04 月 26 日 03:30
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
-- 表的结构 `loveyobbo`
--

CREATE TABLE IF NOT EXISTS `loveyobbo` (
  `id` int(11) NOT NULL auto_increment,
  `userid` varchar(225) default '0',
  `message` text,
  `timer` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `loveyobbo`
--

INSERT INTO `loveyobbo` (`id`, `userid`, `message`, `timer`) VALUES
(1, '0', '123', '2017-08-30 16:00:00'),
(2, '0', 'gh', '2017-08-14 10:41:21'),
(3, '0', '数据交互完成', '2017-08-14 10:41:41'),
(4, '0', '第二次测试', '2017-08-14 10:44:41'),
(5, '0', '1', '2017-08-16 09:41:44'),
(6, '0', '测试', '2017-08-16 09:41:53'),
(7, '0', '测试返回', '2017-08-16 09:43:53'),
(8, '0', '速度测试', '2017-08-16 09:44:09'),
(9, '0', '<xml>\r\n        <ToUserName><![CDATA[oorTs1TuG5cYbs6-5KTc9NUZYIYE]]></ToUserName>\r\n        <FromUserName><![CDATA[gh_6e3a7c2a0bb5]]></FromUserName>\r\n        <CreateTime>1502877770</CreateTime>\r\n        <MsgType><![CDATA[text]]></MsgType>\r\n        <Content><![CDATA[暂未收录该关键词哦。\n2017-08-16 18:02:50]]></Content>\r\n        </xml>', '2017-08-16 10:02:50'),
(10, '0', '', '2017-08-16 10:38:20'),
(11, '0', 'gh_6e3a7c2a0bb5', '2017-08-16 10:39:09'),
(12, '0', 'gh_6e3a7c2a0bb5', '2017-08-17 08:43:07'),
(13, '0', 'gh_6e3a7c2a0bb5', '2017-08-17 08:43:20'),
(14, '0', 'gh_6e3a7c2a0bb5', '2017-08-17 09:08:05'),
(15, 'gh_6e3a7c2a0bb5', '暂未收录该关键词哦。\n2017-08-17 17:32:41', '2017-08-17 09:32:41'),
(16, 'gh_6e3a7c2a0bb5', '<xml>\r\n        <ToUserName><![CDATA[oorTs1TuG5cYbs6-5KTc9NUZYIYE]]></ToUserName>\r\n        <FromUserName><![CDATA[gh_6e3a7c2a0bb5]]></FromUserName>\r\n        <CreateTime>1502962465</CreateTime>\r\n        <MsgType><![CDATA[text]]></MsgType>\r\n        <Content><![CDATA[暂未收录该关键词哦。\n2017-08-17 17:34:25]]></Content>\r\n        </xml>', '2017-08-17 09:34:25'),
(17, 'gh_6e3a7c2a0bb5', '测试3', '2017-08-17 09:36:09'),
(18, 'gh_6e3a7c2a0bb5', '小可爱', '2017-08-28 09:19:55'),
(19, 'gh_6e3a7c2a0bb5', '1', '2017-09-26 08:23:05'),
(20, 'gh_6e3a7c2a0bb5', '你好', '2017-10-11 15:45:50'),
(21, 'gh_6e3a7c2a0bb5', '了', '2017-10-12 09:37:45'),
(22, 'gh_6e3a7c2a0bb5', '1', '2017-11-21 14:50:31'),
(23, 'gh_6e3a7c2a0bb5', 'wizard的2001和2003的无损重传一下呗', '2017-12-07 12:07:58'),
(24, 'gh_6e3a7c2a0bb5', '噶咯', '2018-01-03 11:07:51'),
(25, 'gh_6e3a7c2a0bb5', '1', '2018-04-02 06:37:27'),
(26, 'gh_6e3a7c2a0bb5', '1', '2018-04-02 06:37:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845722 bytes) in <b>Unknown</b> on line <b>0</b><br />
