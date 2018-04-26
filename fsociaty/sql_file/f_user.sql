-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost:3306
-- 生成日期: 2018 年 04 月 26 日 03:45
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
-- 表的结构 `f_user`
--

CREATE TABLE IF NOT EXISTS `f_user` (
  `f_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//用户自动编号',
  `f_uniqid` char(40) NOT NULL COMMENT '//验证身份的唯一标识符',
  `f_active` char(40) NOT NULL COMMENT '//激活登录用户',
  `f_username` varchar(20) NOT NULL COMMENT '//用户名',
  `f_password` char(40) NOT NULL COMMENT '//密码',
  `f_question` varchar(20) NOT NULL COMMENT '//密码提示',
  `f_answer` char(40) NOT NULL COMMENT '//密码回答',
  `f_email` varchar(40) default NULL COMMENT '//邮件',
  `f_qq` varchar(11) NOT NULL COMMENT '//qq',
  `f_url` varchar(100) default NULL COMMENT '//网址',
  `f_sex` char(1) NOT NULL COMMENT '//性别',
  `f_switch` tinyint(1) unsigned NOT NULL default '0' COMMENT '//个性签名的开关',
  `f_autograph` varchar(200) default NULL COMMENT '//签名内容',
  `f_level` tinyint(1) unsigned NOT NULL default '0' COMMENT '//会员等级',
  `f_post_time` varchar(20) NOT NULL default '0' COMMENT '//发帖的时间戳',
  `f_article_time` varchar(20) NOT NULL default '0' COMMENT '//回帖的时间戳',
  `f_reg_time` datetime NOT NULL COMMENT '//注册时间',
  `f_last_time` datetime NOT NULL COMMENT '//最后登录的时间',
  `f_last_ip` varchar(24) NOT NULL COMMENT '//最后登陆的IP',
  `f_login_count` int(10) unsigned NOT NULL default '0' COMMENT '//登陆次数',
  PRIMARY KEY  (`f_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- 转存表中的数据 `f_user`
--

INSERT INTO `f_user` (`f_id`, `f_uniqid`, `f_active`, `f_username`, `f_password`, `f_question`, `f_answer`, `f_email`, `f_qq`, `f_url`, `f_sex`, `f_switch`, `f_autograph`, `f_level`, `f_post_time`, `f_article_time`, `f_reg_time`, `f_last_time`, `f_last_ip`, `f_login_count`) VALUES
(3, '', '', 'FG', '', '', '', NULL, '', NULL, '', 0, NULL, 0, '0', '0', '0000-00-00 00:00:00', '2016-08-14 20:02:26', '::1', 1),
(4, '', '', 'word', '', '', '', NULL, '', NULL, '', 0, NULL, 0, '0', '0', '0000-00-00 00:00:00', '2016-08-14 20:02:26', '::1', 1),
(5, 'ad12d759ffeb6730f3c19481c2a03adddc05ad69', 'd5c237422e0987b0d1feda6b6c18be08a2dde2a7', '苏美尔', '7c4a8d09ca3762af61e59520943dc26494f8941b', '你好啊啊', 'f915d5197cc9c780ba6774a3ec520bfd3f4bec39', '52345@qq.com', '3253311', 'http://baidu.com', '男', 0, NULL, 0, '0', '0', '2016-08-03 18:11:42', '2016-08-14 20:02:26', '::1', 1),
(6, 'fbae1f93d138f59c1bdac6d06768bc4e79d47d52', '9dadeb20bdf05730c31e7a435f369a8db4d236df', '老铁', '7c4a8d09ca3762af61e59520943dc26494f8941b', '公司人士给发的是', 'b4697dd7096832234f912e922edb45df4139a877', '14324@qq.com', '4353322', '', '男', 0, NULL, 0, '0', '0', '2016-08-03 18:35:01', '2016-08-14 20:02:26', '::1', 1),
(7, 'c5d1773eb2bbe023f76b1da391044bd10386d9f9', '71a78dda53c8adfdde1b6abf5b19c0cc6341336f', '景天宇', '23b4790964b9e8c17ea4b1a2640ed315465cda13', '是梵蒂冈地方是是是', '774ce48b993ffc8fa721704a604d9b21f6734508', '', '243132413', '', '女', 0, NULL, 0, '0', '0', '2016-08-03 19:39:18', '2016-08-14 20:02:26', '::1', 1),
(8, '27044d37d8f986ba65ed7493579f65409775ba8a', 'c4d96f07ef73421a81c6f2908c6ecef65a98154d', '撒发放', '7c4a8d09ca3762af61e59520943dc26494f8941b', '阿嘎多舒服', 'ae5cef403e67afbc2eb9ac0e5da6ba1308559576', '', '1422312', '', '女', 0, NULL, 0, '0', '0', '2016-08-03 20:02:13', '2016-08-14 20:02:26', '::1', 1),
(10, '0c034161db1a3e4466bfc2d0798196889e351131', '4cde055792808d1decd43df2ebfa7cc779e4578a', '塞拉', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'YOURSOULIS', 'e8099d1424b6325d79ffefbf957fdcd624a62574', '', '312342', '', '女', 0, NULL, 0, '0', '0', '2016-08-03 22:06:30', '2016-08-14 20:02:26', '::1', 1),
(11, 'e8d55a76bb706a8b4560234ae55b20627ab04709', '02c4923992b60b5ad787a9b3e4304080e91add25', '的嘎达的方式', '7c4a8d09ca3762af61e59520943dc26494f8941b', '莎夫人艾弗森', '3574f94d4ea3cf5e0b5ba4069bce73939089ec74', '', '3241343', '', '女', 0, NULL, 0, '0', '0', '2016-08-06 19:42:28', '2016-08-14 20:02:26', '::1', 1),
(12, 'a143ef76ff52be16f13e1a77fb2356cebbe716d8', '5fd7b20a386793d1e92f54814160330f19d2f874', '法萨芬说得对', '7c4a8d09ca3762af61e59520943dc26494f8941b', '适当放水电费水电费', 'a692d837d58d302ce1650771ad4009cced4a3e43', '', '13321324', '', '男', 0, NULL, 0, '0', '0', '2016-08-06 19:55:19', '2016-08-14 20:02:26', '::1', 1),
(13, '5d66241b3dce5192d3b9fa65b8c5bbacbf81801d', '14efda54fba45a6bebb03489a98c2d9b90f98558', '阿凡达', '7c4a8d09ca3762af61e59520943dc26494f8941b', '是否都三点多', '63c21faf9a7f131645cd75a7dafff49867299b69', '', '112322', '', '男', 0, NULL, 0, '0', '0', '2016-08-06 20:27:30', '2016-08-14 20:02:26', '::1', 1),
(14, '270cd2578ca46c1b233b74e15717083879863e60', '9188c55dac194b38d37465222ecaaf400bdd1fc0', '你好呀', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'here', '490528f36debf7c15cea5e9a9d1ea024cf6b2921', '', '192939', '', '男', 0, NULL, 0, '0', '0', '2016-08-07 10:04:23', '2016-08-14 20:02:26', '::1', 1),
(15, 'c2d3a56dc2b997bce96298434bf11e73e4a91667', '50be25dd353656a7afee2d2069594ee6722211d5', '你好呀啊', '7c4a8d09ca3762af61e59520943dc26494f8941b', '撒啊啊啊', '4aa391625d31eba4a7117f722cd07abf1b0745f5', '', '1234344', '', '女', 0, NULL, 0, '0', '0', '2016-08-07 11:20:19', '2016-08-14 20:02:26', '::1', 1),
(16, '8022302abbe1bb815a595cc64a468f47535f0c36', 'da5235fb8415be12fe0b3bf25adf260bae7f651f', '你好啊啊啊啊', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', '', '11111', '', '男', 0, NULL, 0, '0', '0', '2016-08-07 14:13:36', '2016-08-14 20:02:26', '::1', 1),
(17, 'dd6ac17c1aef17dbce5619344648d23720963457', '', '你好', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', '', '22222', '', '男', 0, NULL, 0, '0', '0', '2016-08-07 14:15:49', '2016-08-14 20:02:26', '::1', 1),
(18, 'eefbcb3e4e13af8c2d4558eb4da94b628ebbdae4', '', '擦擦擦', 'cb89c0b02495e9bbd1d2f99f1abe1b6c01b2e38b', '11111', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', '', '111122', '', '男', 0, NULL, 0, '0', '0', '2016-08-07 14:24:06', '2016-08-14 20:02:26', '::1', 1),
(19, '3ec577b14d7b3af1a51f152211088d61758a840c', '', '过分了', '7c4a8d09ca3762af61e59520943dc26494f8941b', '啊啊啊啊', 'e5a0cfbe45ed8aa2e951e03e2d7348fadee326ef', '1522112211@qq.com', '111111', '', '女', 1, '[img]pic/1.jpg[/img]', 1, '1473846637', '1473775028', '2016-08-07 14:24:47', '2016-10-27 20:36:57', '125.71.5.151', 280),
(20, 'a309540f9d5504a0550249c1179247062ba55b26', '', '111', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'dd5fef9c1c1da1394d6d34b248c51be2ad740840', '', '123456', '', '男', 0, NULL, 0, '0', '0', '2016-08-07 14:33:24', '2016-08-22 17:59:46', '::1', 2),
(21, 'bd4289c6949ec01359cd209ad20ee203c4a92f1e', '', '你不好', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '803d734da37173b09d39012fb384533cd122f9ca', '', '123456', '', '女', 0, NULL, 0, '0', '0', '2016-08-10 17:35:48', '2016-08-23 15:29:11', '::1', 2),
(22, 'a52636edd5fbdcb352502b43fa4abffba406dc10', '', '雷克萨', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1122', 'e6402ee50e78b6141db94c840ca7903762665732', '', '112211', '', '女', 0, NULL, 0, '0', '0', '2016-08-20 21:00:39', '2016-09-05 18:41:48', '127.0.0.1', 29),
(23, '37b36e326c11cb3dd446aa07562b2eed349e31fe', '', '12121', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'd5f12e53a182c062b6bf30c1445153faff12269a', '', '1212111', '', '男', 0, NULL, 0, '0', '0', '2016-08-23 18:19:00', '2016-08-23 18:19:00', '::1', 0),
(24, 'c4518c9487ed3bd4fbf353704f3d58caf675dee0', '', 'root', 'cb89c0b02495e9bbd1d2f99f1abe1b6c01b2e38b', '1234', 'd5f12e53a182c062b6bf30c1445153faff12269a', '', '121111', '', '男', 0, NULL, 1, '0', '1492065725', '2016-08-23 18:20:27', '2017-04-13 15:22:03', '127.0.0.1', 2),
(25, '0d19ec30b8a18d3c79e37e10273b0da94a164854', '', 'HEER', 'd58377d7633ad43941aea8c030a508f9e178fc2f', 'wh1234567890', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '', '11121121', '', '男', 0, NULL, 0, '0', '0', '2016-08-23 18:24:18', '2016-08-23 18:24:18', '::1', 0),
(26, '37f6e783552c2a5ee2354ac3a3af48e2e6ddb0b7', '', 'ROOT1', '34cb96dca3155fb8b1fdc3e16bfb8c184f0d8b65', '11111', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', '', '11111', '', '男', 0, NULL, 0, '0', '0', '2016-08-23 18:25:37', '2016-08-23 20:15:08', '::1', 1),
(37, 'c349d4378ab4693921314a66e5a52bb11b60a9b9', '', '池田依来沙', '7b52009b64fd0a2a49e6d8a939753077792b0554', '1111', 'fea7f657f56a2a448da7d4b535ee5e279caf3d9a', '', '111111', '', '男', 1, 'For The Glory!', 0, '1473505663', '1473609056', '2016-09-07 16:20:37', '2016-09-18 19:34:13', '118.114.51.137', 33),
(28, '6b86b79698641ee2bdd1ded2a8bca1e98423b4ea', '', 'ROOT3', '47bb51ecddb20dfa644d477ecaf1126b4829bc50', '12112', 'af5e04702825017510b0f7007d4725b0862c0a98', '', '1212121', '', '男', 0, NULL, 0, '0', '0', '2016-08-23 18:27:37', '2016-08-23 18:27:37', '::1', 0),
(29, 'b7ef9f0e4745d6c8d4f88472216d0b9b8d0e4faa', '', 'ROOT4', 'cf8f248441c20c22805f132a8af49ed00cbbd01e', '11111', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', '', '11111', '', '男', 0, NULL, 0, '0', '0', '2016-08-23 18:30:58', '2016-08-23 18:32:03', '::1', 2),
(30, 'ebbe0c66683d7f74c9deedda6b41c9237b2ddba5', '', '朵朵', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1111', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', '', '1122111', '', '男', 0, NULL, 0, '0', '0', '2016-08-24 21:27:06', '2016-08-24 21:27:06', '::1', 0),
(31, '10e28c4921bf6be4d293a6d90ce5859130cd1552', '0fe5f2d0d2f707c4e446f29cee575d211294ea93', '朵朵桑', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', '', '222222', '', '女', 0, NULL, 0, '0', '0', '2016-08-24 21:29:37', '2016-08-24 21:29:37', '::1', 0),
(38, '3508f8059ab37919ee316187e8e0b1384ca1f75a', '', 'Admin', '556ccfe009da2950b5fadd5affc1928f47b48525', 'hengqiangshi', '5d2a4e6718d855d3a977eec4d782e4d935cf9727', '', '22334455', '', '女', 0, NULL, 1, '1479714173', '1521019928', '2016-09-08 09:54:59', '2018-03-14 17:31:28', '171.221.45.10', 49),
(33, '5696701d8f998f283bc2285daaa1ee416977f27c', '', '戴泽', '7c4a8d09ca3762af61e59520943dc26494f8941b', '111111', '273a0c7bd3c679ba9a6f5d99078e36e85d02b952', '', '111111', '', '男', 0, NULL, 1, '1474709040', '0', '2016-08-24 21:31:32', '2016-09-24 17:12:41', '125.71.5.212', 20),
(34, 'c777e0e7c9168d5773eb02d990b1cd72b6de73c6', '', 'Samaritan', 'cb89c0b02495e9bbd1d2f99f1abe1b6c01b2e38b', 'Samaritan', '0654a028e5aea48c8fbb09871b8f397a186c883b', '1379134882@qq.com', '2211221', 'http://www.baidu.com', '男', 0, NULL, 0, '0', '0', '2016-08-27 18:23:01', '2016-09-03 23:53:27', '192.168.1.101', 4),
(39, '38a13d1b3339d9097175bd0e550e5ac53b64187a', '', 'F111', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', '', '11111', '', '男', 0, NULL, 0, '0', '0', '2016-09-09 15:42:17', '2016-09-09 15:43:18', '::1', 1),
(40, '487a0100ef37d2f0c1aedf231510b0eae6b79237', '', 'Lux', 'cb89c0b02495e9bbd1d2f99f1abe1b6c01b2e38b', '1111', 'fea7f657f56a2a448da7d4b535ee5e279caf3d9a', '', '22221111', '', '女', 0, NULL, 0, '1473646143', '1473647646', '2016-09-11 23:30:42', '2016-09-24 18:46:12', '125.71.5.212', 12),
(41, 'd360945fa1026c757ad2a35f62df85084cc5d547', '', 'HATE', 'cb89c0b02495e9bbd1d2f99f1abe1b6c01b2e38b', '1111', 'fea7f657f56a2a448da7d4b535ee5e279caf3d9a', '', '3213123131', '', '女', 0, NULL, 0, '0', '0', '2016-09-25 18:02:56', '2016-10-14 12:11:45', '125.71.199.25', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 8845206 bytes) in <b>Unknown</b> on line <b>0</b><br />
