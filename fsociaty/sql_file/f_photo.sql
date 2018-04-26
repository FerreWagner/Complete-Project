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
-- 表的结构 `f_photo`
--

CREATE TABLE IF NOT EXISTS `f_photo` (
  `f_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//ID',
  `f_name` varchar(20) NOT NULL COMMENT '//图片名',
  `f_url` varchar(400) NOT NULL COMMENT '//图片路径',
  `f_content` varchar(200) default NULL COMMENT '//图片简介',
  `f_sid` mediumint(8) unsigned NOT NULL COMMENT '//图片所在目录',
  `f_username` varchar(20) NOT NULL COMMENT '//上传者',
  `f_readcount` smallint(5) NOT NULL default '0' COMMENT '//浏览量',
  `f_commendcount` smallint(5) NOT NULL default '0' COMMENT '//评论量',
  `f_date` datetime NOT NULL COMMENT '//图片保存时间',
  PRIMARY KEY  (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `f_photo`
--

INSERT INTO `f_photo` (`f_id`, `f_name`, `f_url`, `f_content`, `f_sid`, `f_username`, `f_readcount`, `f_commendcount`, `f_date`) VALUES
(8, '111', 'photo/1473406801/1473412605.png', '111', 16, '过分了', 191, 5, '2016-09-09 17:16:48'),
(11, '呀1', 'photo/1473416394/1473436649.jpg', '11', 17, '李梦阳', 68, 1, '2016-09-09 23:57:40'),
(12, '可以的', 'photo/1473416394/1473469672.jpg', '11', 17, '李梦阳', 23, 112, '2016-09-10 09:08:02'),
(13, '111', 'photo/1473416394/1473469709.jpg', '111', 17, '李梦阳', 13, 0, '2016-09-10 09:08:33'),
(15, '11', 'photo/1473489201/1473489223.jpg', '11', 21, '过分了', 11, 0, '2016-09-10 14:33:47'),
(25, '111', 'photo/1473489201/1473508520.jpg', '222', 21, '过分了', 9, 0, '2016-09-10 19:55:26'),
(26, '222', 'photo/1473489201/1473508539.jpg', '', 21, '过分了', 13, 0, '2016-09-10 19:55:42'),
(27, 'Admin', 'photo/1473489201/1473517485.jpg', '', 21, '过分了', 9, 0, '2016-09-10 22:24:48'),
(28, '21213', 'photo/1473489201/1473517515.jpg', '', 21, '过分了', 43, 1, '2016-09-10 22:25:17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8844006 bytes) in <b>Unknown</b> on line <b>0</b><br />
