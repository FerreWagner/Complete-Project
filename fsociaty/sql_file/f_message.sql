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
-- 表的结构 `f_message`
--

CREATE TABLE IF NOT EXISTS `f_message` (
  `f_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `f_touser` varchar(20) NOT NULL COMMENT '//收件人',
  `f_fromuser` varchar(20) NOT NULL COMMENT '//发件人',
  `f_content` varchar(800) NOT NULL COMMENT '//发件内容',
  `f_state` tinyint(1) NOT NULL default '0' COMMENT '//信息状态',
  `f_date` datetime NOT NULL COMMENT '//发送时间',
  PRIMARY KEY  (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `f_message`
--

INSERT INTO `f_message` (`f_id`, `f_touser`, `f_fromuser`, `f_content`, `f_state`, `f_date`) VALUES
(1, '过分了', '', '啊啊啊', 1, '2016-08-20 14:26:58'),
(2, '过分了', '', '男生女生\r\n', 1, '2016-08-20 14:27:18'),
(9, '111', '雷克萨', '11111', 1, '2016-08-21 19:21:23'),
(22, '你好呀啊', '过分了', '今天天气不错，是f-sociaty交流的第三天测试，希望你一切安好。\r\n                         -_your father', 1, '2016-08-22 13:19:29'),
(23, '111', '过分了', 'f_sociaty第四天的测试___your father', 1, '2016-08-22 15:03:39'),
(24, '雷克萨', '过分了', '你好', 1, '2016-08-22 15:29:06'),
(26, '过分了', '雷克萨', '12122', 1, '2016-08-22 17:48:21'),
(27, '过分了', '雷克萨', '阿萨', 0, '2016-08-22 17:49:15'),
(28, '过分了', '雷克萨', '12', 0, '2016-08-22 17:49:23'),
(29, '过分了', '雷克萨', '测试1\r\n', 1, '2016-08-22 17:49:36'),
(30, '过分了', '雷克萨', '测试2', 1, '2016-08-22 17:49:46'),
(32, '过分了', '111', '12111', 1, '2016-08-22 18:00:23'),
(34, '111', '过分了', '。。。', 0, '2016-08-23 16:31:14'),
(35, '朵朵桑1', '雷克萨', '11111', 0, '2016-08-31 19:03:28'),
(36, 'Samaritan', '过分了', '1111', 0, '2016-09-02 10:31:09'),
(37, 'Samaritan', '过分了', 'hello', 0, '2016-09-06 22:12:52'),
(38, '撒发放', '李梦阳', '1111', 0, '2016-09-10 00:24:00'),
(39, '撒发放', 'Admin', '是不是过分了', 0, '2016-09-25 11:51:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845206 bytes) in <b>Unknown</b> on line <b>0</b><br />
