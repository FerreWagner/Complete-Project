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
-- 表的结构 `f_system`
--

CREATE TABLE IF NOT EXISTS `f_system` (
  `f_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `f_webname` varchar(20) NOT NULL COMMENT '//网站名称',
  `f_article` tinyint(2) unsigned NOT NULL default '0' COMMENT '//文章分页数',
  `f_blog` tinyint(2) unsigned NOT NULL default '0' COMMENT '//博友分页数',
  `f_photo` tinyint(2) unsigned NOT NULL default '0' COMMENT '//相册分页数',
  `f_skin` tinyint(1) unsigned NOT NULL default '0' COMMENT '//网站皮肤',
  `f_string` varchar(200) NOT NULL COMMENT '//网站敏感字符',
  `f_post` int(8) unsigned NOT NULL default '0' COMMENT '//发帖限制',
  `f_re` int(8) unsigned NOT NULL default '0' COMMENT '//回帖限制',
  `f_code` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否启用验证码',
  `f_register` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否开放会员注册',
  PRIMARY KEY  (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `f_system`
--

INSERT INTO `f_system` (`f_id`, `f_webname`, `f_article`, `f_blog`, `f_photo`, `f_skin`, `f_string`, `f_post`, `f_re`, `f_code`, `f_register`) VALUES
(1, 'F-SOCIATY111', 15, 15, 12, 2, '  珏', 31, 16, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845464 bytes) in <b>Unknown</b> on line <b>0</b><br />
