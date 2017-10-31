-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-03-10 08:08:28
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- 表的结构 `cp_admin`
--

CREATE TABLE `cp_admin` (
  `id` mediumint(9) NOT NULL COMMENT '管理员ID',
  `name` varchar(30) NOT NULL COMMENT '管理员用户名',
  `password` char(32) NOT NULL COMMENT '管理员密码'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cp_admin`
--

INSERT INTO `cp_admin` (`id`, `name`, `password`) VALUES
(19, 'Faith', '96041bda933a4250dddd7e4550d60c40'),
(21, 'Bruce', '96041bda933a4250dddd7e4550d60c40'),
(18, 'Ferre666', '96041bda933a4250dddd7e4550d60c40'),
(20, 'Ferre', '96041bda933a4250dddd7e4550d60c40');

-- --------------------------------------------------------

--
-- 表的结构 `cp_article`
--

CREATE TABLE `cp_article` (
  `id` mediumint(9) NOT NULL COMMENT '文章ID',
  `title` varchar(60) DEFAULT NULL COMMENT '文章标题',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键词',
  `desc` varchar(255) DEFAULT NULL COMMENT '描述',
  `author` varchar(30) DEFAULT NULL COMMENT '作者',
  `thumb` varchar(160) DEFAULT NULL COMMENT '缩略图地址',
  `content` text COMMENT '内容',
  `click` mediumint(9) DEFAULT '1' COMMENT '点击数',
  `zan` mediumint(9) DEFAULT '0' COMMENT '点赞数',
  `rec` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0代表不推荐1代表推荐',
  `time` int(10) DEFAULT NULL COMMENT '发布时间',
  `cateid` mediumint(9) DEFAULT NULL COMMENT '所属栏目'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cp_article`
--

INSERT INTO `cp_article` (`id`, `title`, `keywords`, `desc`, `author`, `thumb`, `content`, `click`, `zan`, `rec`, `time`, `cateid`) VALUES
(7, 'test', 'other', 'null', 'Ferre', '/ZEND/Company/public/uploads/20170222\\2487ded7872e64da9ca67d9fc3f80d88.png', '<p>2321</p>', 30, 0, 0, NULL, 3),
(8, 'TO : power metal', 'other,no keywords', 'desca', 'Author', '/ZEND/Company/public/uploads/20170222\\5c9a3e144eb7dd612b818bff19d62414.PNG', '<p>132321</p>', 34, 0, 0, NULL, 3),
(9, '你好', '你好', '我不好', '我不好', '/ZEND/Company/public/uploads/20170222\\7e78907a4389f63cd58fa585aa605ff7.png', '<p>321</p>', 32, 0, 0, NULL, 1),
(10, 'pink', 'keywordss', 'null', 'pink', '/ZEND/Company/public/uploads/20170222\\0f2b74f3093d121d5a30708427116300.png', '<p>111</p>', 30, 0, 0, NULL, 14),
(11, 'floyd', 'pink', 'pink', 'pink', '/ZEND/Company/public/uploads/20170222\\af00f81f2fb9452fc0f1c08f6534648b.png', '<p>321</p>', 35, 0, 0, NULL, 8),
(12, 'POST', '后现代', '后现代', 'Ferre', '/ZEND/Company/public/uploads/20170222\\b93cb4425ecceebbcc5554c5b3dc89f3.png', '<p>奥斯丁</p>', 30, 0, 1, NULL, 3),
(13, '你微微笑', 'ther', 'null', '百度不到', '/ZEND/Company/public/uploads/20170222\\cb24b08ea66d3dca814e5eab894cb644.png', '<p style="margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; margin-top: 0px !important; background-color: rgb(255, 255, 255);">我们往往需要对模板输出变量使用函数，可以使用：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">{$data.name|md5}</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">编译后的结果是：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">&lt;?php&nbsp;echo&nbsp;(md5($data[&#39;name&#39;]));&nbsp;?&gt;</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">如果函数有多个参数需要调用，则使用：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">{$create_time|date=&quot;y-m-d&quot;,###}</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">表示date函数传入两个参数，每个参数用逗号分割，这里第一个参数是<code style="font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; display: inline-block; border-radius: 4px; padding: 0px 0.4em; word-break: break-all; white-space: pre; line-height: 1.3; background-color: rgb(247, 247, 247);">y-m-d</code>，第二个参数是前面要输出的<code style="font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; display: inline-block; border-radius: 4px; padding: 0px 0.4em; word-break: break-all; white-space: pre; line-height: 1.3; background-color: rgb(247, 247, 247);">create_time</code>变量，因为该变量是第二个参数，因此需要用###标识变量位置，编译后的结果是：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">&lt;?php&nbsp;echo&nbsp;(date(&quot;y-m-d&quot;,$create_time));&nbsp;?&gt;</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">如果前面输出的变量在后面定义的函数的第一个参数，则可以直接使用：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">{$data.name|substr=0,3}</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">表示输出</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">&lt;?php&nbsp;echo&nbsp;(substr($data[&#39;name&#39;],0,3));&nbsp;?&gt;</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">虽然也可以使用：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">{$data.name|substr=###,0,3}</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">但完全没用这个必要。</p><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">还可以支持多个函数过滤，多个函数之间用“|”分割即可，例如：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">{$name|md5|strtoupper|substr=0,3}</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">编译后的结果是：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">&lt;?php&nbsp;echo&nbsp;(substr(strtoupper(md5($name)),0,3));&nbsp;?&gt;</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">函数会按照从左到右的顺序依次调用。</p><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">如果你觉得这样写起来比较麻烦，也可以直接这样写：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">{:substr(strtoupper(md5($name)),0,3)}</pre><blockquote class="default" style="margin: 8px 0px; padding: 8px 16px; -webkit-tap-highlight-color: transparent; color: rgb(3, 130, 173); border-left-width: 5px; border-left-style: solid; border-left-color: rgb(208, 227, 240); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(249, 249, 249);"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; -webkit-tap-highlight-color: transparent;">变量输出使用的函数可以支持内置的PHP函数或者用户自定义函数，甚至是静态方法。</p></blockquote><p><br/></p>', 38, 0, 0, 1487745935, 3),
(14, '结构调整', '结构', '模板文件定义\r\n\r\n每个模块的模板文件是独立的，为了对模板文件更加有效的管理，ThinkPHP对模板文件进行目录划分，默认的模板文件定义规则是：', 'Author', NULL, '<h2 id="u6A21u677Fu6587u4EF6u5B9Au4E49" style="margin-right: 0px; margin-bottom: 14px; margin-left: 0px; padding: 0px 0px 0.3em; -webkit-tap-highlight-color: transparent; font-size: 1.75em; font-weight: 200; line-height: 1.225; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238); color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; white-space: normal; margin-top: 0px !important; background-color: rgb(255, 255, 255);">模板文件定义</h2><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">每个模块的模板文件是独立的，为了对模板文件更加有效的管理，ThinkPHP对模板文件进行目录划分，默认的模板文件定义规则是：</p><blockquote class="info" style="margin: 0px 0px 14px; padding: 5px 5px 5px 15px; -webkit-tap-highlight-color: transparent; color: rgb(91, 192, 222); border-left-width: 4px; border-left-style: solid; border-left-color: rgb(91, 192, 222); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(244, 248, 250);"><h3 id="-" style="margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; font-size: 1.5em; font-weight: 200; line-height: 1.43;">视图目录/控制器名（小写）/操作名（小写）+模板后缀</h3></blockquote><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">默认的视图目录是<strong>模块的view目录</strong>，框架的默认视图文件后缀是<code style="font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; display: inline-block; border-radius: 4px; padding: 0px 0.4em; word-break: break-all; white-space: pre; line-height: 1.3; background-color: rgb(247, 247, 247);">.html</code>。</p><h2 id="u6A21u677Fu6E32u67D3u89C4u5219" style="margin: 0px 0px 14px; padding: 0px 0px 0.3em; -webkit-tap-highlight-color: transparent; font-size: 1.75em; font-weight: 200; line-height: 1.225; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238); color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);">模板渲染规则</h2><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">模板渲染使用<code style="font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; display: inline-block; border-radius: 4px; padding: 0px 0.4em; word-break: break-all; white-space: pre; line-height: 1.3; background-color: rgb(247, 247, 247);">\\think\\View</code>类的<code style="font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; display: inline-block; border-radius: 4px; padding: 0px 0.4em; word-break: break-all; white-space: pre; line-height: 1.3; background-color: rgb(247, 247, 247);">fetch</code>方法，渲染规则为：</p><blockquote class="info" style="margin: 0px 0px 14px; padding: 5px 5px 5px 15px; -webkit-tap-highlight-color: transparent; color: rgb(91, 192, 222); border-left-width: 4px; border-left-style: solid; border-left-color: rgb(91, 192, 222); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(244, 248, 250);"><h3 id="--1" style="margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; font-size: 1.5em; font-weight: 200; line-height: 1.43;">模块@控制器/操作</h3></blockquote><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">模板文件目录默认位于模块的view目录下面，视图类的fetch方法中的模板文件的定位规则如下：</p><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">如果调用没有任何参数的fetch方法：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">return&nbsp;$view-&gt;fetch();</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">则按照系统的默认规则定位模板文件到：</p><blockquote class="info" style="margin: 0px 0px 14px; padding: 5px 5px 5px 15px; -webkit-tap-highlight-color: transparent; color: rgb(91, 192, 222); border-left-width: 4px; border-left-style: solid; border-left-color: rgb(91, 192, 222); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(244, 248, 250);"><h4 id="-html" style="margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; font-size: 1.25em; font-weight: 200;">[模板文件目录]/当前控制器名（小写+下划线）/当前操作名（小写）.html</h4></blockquote><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">如果（指定操作）调用：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">return&nbsp;$view-&gt;fetch(&#39;add&#39;);</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">则定位模板文件为：</p><blockquote class="info" style="margin: 0px 0px 14px; padding: 5px 5px 5px 15px; -webkit-tap-highlight-color: transparent; color: rgb(91, 192, 222); border-left-width: 4px; border-left-style: solid; border-left-color: rgb(91, 192, 222); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(244, 248, 250);"><h4 id="-add-html" style="margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; font-size: 1.25em; font-weight: 200;">[模板文件目录]/当前控制器名（小写+下划线）/add.html</h4></blockquote><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">如果调用控制器的某个模板文件使用：</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">return&nbsp;$view-&gt;fetch(&#39;user/add&#39;);</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">则定位模板文件为：</p><blockquote class="info" style="margin: 0px 0px 14px; padding: 5px 5px 5px 15px; -webkit-tap-highlight-color: transparent; color: rgb(91, 192, 222); border-left-width: 4px; border-left-style: solid; border-left-color: rgb(91, 192, 222); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(244, 248, 250);"><h4 id="-user-add-html" style="margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; font-size: 1.25em; font-weight: 200;">[模板文件目录]/user/add.html</h4></blockquote><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">跨模块调用模板</p><pre style="margin-top: 0px; margin-bottom: 14px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); background-color: rgb(247, 247, 247);">return&nbsp;$view-&gt;fetch(&#39;admin@user/add&#39;);</pre><p style="margin-top: 0px; margin-bottom: 14px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, &#39;Helvetica Neue&#39;, Helvetica, Arial, sans-serif; line-height: 27.2px; white-space: normal; background-color: rgb(255, 255, 255);">全路径模板调用：</p><pre style="margin-top: 0px; padding: 16px; -webkit-tap-highlight-color: transparent; overflow: auto; font-size: 13.6px; line-height: 1.45; border: 1px solid silver; border-radius: 3px; font-family: Consolas, &#39;Liberation Mono&#39;, Menlo, Courier, monospace; color: rgb(34, 34, 34); margin-bottom: 0px !important; background-color: rgb(247, 247, 247);">return&nbsp;$view-&gt;fetch(APP_PATH.request()-&gt;module().&#39;/view/public/header.html&#39;);</pre><p><br/></p>', 30, 0, 0, 1487746450, 3),
(15, '列表页文章', 'null', '关于blackweed的小程序', 'author', '/ZEND/Company/public/uploads/20170222\\c0e2325b3dbca7697f1ad146bc7bfe99.png', '<p>2</p>', 37, 0, 0, 1487748641, 15),
(16, '你的睫毛，弯了嘴角', 'fade', '歌手：周杰伦 专辑：叶惠美 \r\n作词:周杰伦 \r\n作曲:周杰伦 ', '哈特', '/ZEND/Company/public/uploads/20170222\\f7ed0b6ad78f92a80c871dee4243c17c.png', '<pre id="best-content-189787122" accuse="aContent" class="best-text mb-10" style="margin-top: 10px; margin-bottom: 10px; padding: 0px; font-family: &#39;PingFang SC&#39;, &#39;Lantinghei SC&#39;, &#39;Microsoft YaHei&#39;, arial, 宋体, sans-serif, tahoma; white-space: pre-wrap; word-wrap: break-word; line-height: 29px; color: rgb(51, 51, 51); min-height: 55px; background-color: rgb(255, 255, 255);">故事的小黄花&nbsp;\r\n从出生那年就飘着&nbsp;\r\n童年的荡秋千&nbsp;\r\n随记忆一直晃到现在&nbsp;\r\nrui&nbsp;sou&nbsp;sou&nbsp;xi&nbsp;dou&nbsp;xi&nbsp;la&nbsp;\r\nsou&nbsp;la&nbsp;xi&nbsp;xi&nbsp;xi&nbsp;xi&nbsp;la&nbsp;xi&nbsp;la&nbsp;sou&nbsp;\r\n吹着前奏望着天空&nbsp;\r\n我想起花瓣试着掉落&nbsp;\r\n为你翘课的那一天&nbsp;\r\n花落的那一天&nbsp;\r\n教室的那一间&nbsp;\r\n我怎么看不见&nbsp;\r\n消失的下雨天&nbsp;\r\n我好想再淋一遍&nbsp;\r\n没想到失去的勇气我还留着&nbsp;\r\n好想再问一遍&nbsp;\r\n你会等待还是离开&nbsp;\r\n\r\n刮风这天我试过握着你手&nbsp;\r\n但偏偏雨渐渐大到我看你不见&nbsp;\r\n还要多久我才能在你身边&nbsp;\r\n还要多久我才能够在你身边&nbsp;\r\n等到放晴的那天也许我会比较好一点&nbsp;\r\n等到放晴那天也许我会比较好一点&nbsp;\r\n从前从前有个人爱你很久&nbsp;\r\n但偏偏风渐渐把距离吹得好远&nbsp;\r\n偏偏风渐渐把距离吹得好远&nbsp;\r\n但偏偏雨渐渐把距离吹得好远&nbsp;\r\n好不容易又能再多爱一天&nbsp;\r\n但故事的最后你好像还是说了拜拜&nbsp;\r\n但故事的最后你好像还是说了</pre><p><br/></p>', 59, 0, 0, 1487749281, 4),
(17, 'TIPS1', 'other', 'faith', 'ferre', '/ZEND/Company/public/uploads/20170222\\a1c7d87b546496b8d82372397c1344b2.jpg', '<p>暂无</p>', 30, 0, 0, 1487767620, 17),
(18, 'TPS2', 'OTHER', 'NULL', 'FERRE', '/ZEND/Company/public/uploads/20170222\\8384da9a550ba81a885ddbce83b04f43.png', '<p>NULL</p>', 30, 0, 0, 1487767657, 17),
(19, 'TIPS3', 'BO', 'BULL', 'FERRE', '/ZEND/Company/public/uploads/20170222\\da32b5b506636b8450258736cda3c95d.jpg', '<p>NULL</p>', 95, 0, 0, 1487767680, 17),
(20, 'TIPS4', '321', '123', 'FERRE', '/ZEND/Company/public/uploads/20170222\\b23cf680773d5bebe3b47dda8f214f15.jpg', '<p>NULL</p>', 31, 0, 0, 1487767710, 17),
(21, 'faith_bian', 'faith', 'faith', 'faith', '/ZEND/Company/public/uploads/20170222\\825ff15b87ca2d9108c68cc2ff6d2e4d.png', '<p>1</p>', 30, 0, 0, 1487769303, 17),
(22, 'fa', 'qa', 'qa', 'qa', '/ZEND/Company/public/uploads/20170222\\3e515447d6005dd84b39b8078f67cad6.jpg', '<p>fda</p>', 30, 0, 0, 1487769329, 17),
(23, 'sdf', 'as', 'as', 'as', '/ZEND/Company/public/uploads/20170222\\a445dd5a2a25342bb1439740632fb14b.jpg', '<p>da</p>', 31, 0, 0, 1487769351, 17),
(24, 'qqq', 'q', 'q', 'q', '/ZEND/Company/public/uploads/20170222\\a4b8e2e59bf6026156de244afce5e2cf.jpg', '<p>321</p>', 32, 0, 0, 1487769369, 17),
(25, 'asdas', 'a', 'a', 'A', '/ZEND/Company/public/uploads/20170222\\f9159d14af4cbbfb0b8602d83ab03e88.jpg', '<p>321</p>', 31, 0, 0, 1487769416, 17),
(28, '阿斯蒂芬', '1', '1', '1', '/ZEND/Company/public/uploads/20170222\\92982337387ba58bd244932f200d19e3.jpg', '<p>321</p>', 134, 0, 0, 1487773715, 4),
(29, 'faded', 'null', '《Faded》是挪威电子音乐制作人Alan walker(艾伦·沃克)制作的歌曲，为艾伦·沃克2014年纯电音作品《Fade》的改编版。词曲由杰斯珀·伯根、艾伦·沃克、Gunnar Greve Pettersen以及Anders Froen创作完成。歌曲于2015年11月25日以单曲形式发行。2016年2月11日，艾伦·沃克推出了歌曲的弦乐版本。', 'ferre', NULL, '<p>艾伦·沃克表示，《Faded》是一首在其2014年长达一小时的伴奏作品《<a target="_blank" href="http://baike.baidu.com/subview/1804336/20641904.htm" data-lemmaid="19926004" style="color: rgb(19, 110, 194); text-decoration: none;">Fade</a>》的基础上加上<a target="_blank" href="http://baike.baidu.com/item/%E8%89%BE%E6%96%AF%E7%90%B3%C2%B7%E7%B4%A2%E5%B0%94%E6%B5%B7%E5%A7%86" style="color: rgb(19, 110, 194); text-decoration: none;">艾斯琳·索尔海姆</a>的声音的歌曲，而在创作前他并未有在这首伴奏上添加人声的想法<span style="font-size: 13.3333px; line-height: 0; position: relative; vertical-align: baseline; top: -0.5em; margin-left: 2px; color: rgb(51, 102, 204); cursor: default; padding: 0px 2px;">[5-6]</span><a style="color: rgb(19, 110, 194); position: relative; top: -50px; font-size: 0px; line-height: 0;" name="ref_[5-6]_19618177"></a>&nbsp;&nbsp;。他认为这个伴奏能够浓缩为一首三分半钟的流行乐，也有在伴奏上添加歌词的想法，因而创作了这首歌曲<span style="font-size: 13.3333px; line-height: 0; position: relative; vertical-align: baseline; top: -0.5em; margin-left: 2px; color: rgb(51, 102, 204); cursor: default; padding: 0px 2px;">[7]</span><a style="color: rgb(19, 110, 194); position: relative; top: -50px; font-size: 0px; line-height: 0;" name="ref_[7]_19618177"></a>&nbsp;&nbsp;。</p><p>而对于歌曲弦乐版的录制，他表示，他想去制作一个突出歌曲某些方面的版本，并能够被那些喜欢艾斯琳·索尔海姆的声音和歌曲旋律的、但不能接受电子乐部分的听众所欣赏。他深受<a target="_blank" href="http://baike.baidu.com/view/1038706.htm" style="color: rgb(19, 110, 194); text-decoration: none;">汉斯·季默</a>等电影原声制作人的启发，而正因如此他才有去创造歌曲的管弦乐版本的想法<span style="font-size: 13.3333px; line-height: 0; position: relative; vertical-align: baseline; top: -0.5em; margin-left: 2px; color: rgb(51, 102, 204); cursor: default; padding: 0px 2px;">[3]</span><a style="color: rgb(19, 110, 194); position: relative; top: -50px; font-size: 0px; line-height: 0;" name="ref_[3]_19618177"></a>&nbsp;&nbsp;。</p><p><br/></p>', 60, 0, 0, 1487833122, 15),
(30, '1', '1', '1', '1', '/ZEND/Company/public/uploads/20170223\\8c5ff55cb381dc03558734878538b8bc.png', '<p>1</p>', 30, 0, 1, 1487840557, 14),
(31, '11', '1', '1', '1', NULL, '<p>1</p>', 33, 0, 0, 1487840600, 4),
(32, 'this is my last day.but there are something that i miss...', 'machine', 'machine', 'father ,i lose it......', '/ZEND/Company/public/uploads/20170223\\e6342ecd585e12bed326c396379f5dd6.jpg', '<p><span id="w_1044" high-light-id="w_1030,w_1044" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">Hand&nbsp;</span><span id="w_1045" high-light-id="w_1031,w_1045" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">tools&nbsp;</span><span id="w_1046" high-light-id="w_1032,w_1046" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">are&nbsp;</span><span id="w_1047" high-light-id="w_1035,w_1047" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">relics&nbsp;</span><span id="w_1048" high-light-id="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">of&nbsp;</span><span id="w_1049" high-light-id="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">the&nbsp;</span><span id="w_1050" high-light-id="w_1033,w_1050" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">past&nbsp;</span><span id="w_1051" high-light-id="w_1036,w_1051" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">that&nbsp;</span><span id="w_1052" high-light-id="w_1037,w_1052,w_1053" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">have&nbsp;</span><span id="w_1053" high-light-id="w_1037,w_1052,w_1053" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">now&nbsp;</span><span id="w_1054" high-light-id="w_1038,w_1054" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">been&nbsp;</span><span id="w_1055" high-light-id="w_1041,w_1042,w_1055" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">superseded&nbsp;</span><span id="w_1056" high-light-id="w_1039,w_1055,w_1056" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">by&nbsp;</span><span id="w_1057" high-light-id="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">the&nbsp;</span><span id="w_1058" high-light-id="w_1040,w_1058" class="high-light-bg" style="color: rgb(255, 255, 255); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background: rgb(67, 149, 255);">machine</span><span id="w_1059" high-light-id="w_1043,w_1059" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">.</span></p>', 34, 0, 1, 1487840978, 17),
(33, 'superseded', 'machine.', 'machine.', 'machine.', '/ZEND/Company/public/uploads/20170223\\95c492347745ae62649b2251f1703eb9.jpg', '<p><span id="w_1044" high-light-id="w_1030,w_1044" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">Hand&nbsp;</span><span id="w_1045" high-light-id="w_1031,w_1045" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">tools&nbsp;</span><span id="w_1046" high-light-id="w_1032,w_1046" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">are&nbsp;</span><span id="w_1047" high-light-id="w_1035,w_1047" class="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">relics&nbsp;</span><span id="w_1048" high-light-id="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">of&nbsp;</span><span id="w_1049" high-light-id="" style="color: rgb(51, 51, 51); font-family: Arial, STHeiti, 宋体, &#39;WenQuanYi Micro Hei&#39;, sans-serif; font-size: 14px; line-height: 22px; background-color: rgb(249, 249, 249);">t</span></p>', 33, 0, 1, 1487841171, 17),
(35, 'machine...', 'machine.', 'machine.', 'machine.', '/ZEND/Company/public/uploads/20170223\\e16b126e4d034c9cb1b9a46d06721aa7.png', '<p>machine.</p>', 36, 0, 1, 1487841304, 13),
(36, '12333', '3211', '1', '', NULL, '<p>3</p>', 30, 0, 0, 1487841356, 14),
(37, '历史虚无主义的弊端', '虚无主义', 'faded', 'Ferre', '/ZEND/Company/public/uploads/20170223\\a6b4584d41055e3b3a1468bdc808254e.jpg', '<p>faded</p>', 36, 0, 0, 1487842316, 14),
(38, 'NEW MACHINE', 'null', '秋季赛的第一日比赛结束后，有内部消息传出Sylar与国土发生争执，两人甚至大大出手，而教练71对于两人的表现相当不满，EHOME战队一时间陷入了舆论的风口浪尖。', 'Ferre', '/ZEND/Company/public/uploads/20170223\\aa37451caef879e3f3918e6438f50631.jpg', '<p style="box-sizing: border-box; margin-top: 0px; padding: 0px; text-indent: 30px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, sans-serif; line-height: 26px; white-space: normal; background-color: rgb(255, 255, 255);">2016年EHOME战队先后经历过7个C位，cty 国土 老11 h2o fan 伞兵 塞拉 这七个人中除了国土与老11继续留队外其他选手目前的发展状况都不好，水友戏言在EHOME打C的人都是没有前途的。而本次71与sylar的撕逼直接爆料了职业圈最为不能容忍的****事件，若EHOME战队真的有这种不良习惯，而又被曝光的话，极有可能遭受V社的制裁，这对于目前成绩不稳定的Ehome来说无疑是雪上加霜！</p><p class="footnote" style="box-sizing: border-box; margin-top: 0px; padding: 0px; text-indent: 30px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, &#39;Hiragino Sans GB&#39;, &#39;Microsoft YaHei&#39;, sans-serif; line-height: 26px; white-space: normal; background-color: rgb(255, 255, 255);">本文为头条号作者发布，不代表今日头条立场。</p><p><br/></p>', 5, 0, 0, 1487861359, 14);

-- --------------------------------------------------------

--
-- 表的结构 `cp_auth_group`
--

CREATE TABLE `cp_auth_group` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cp_auth_group`
--

INSERT INTO `cp_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '1995', 1, '2,14,20,21,22,23,19,3,4,5,24,32,6,30,15,16,31,25,26,27,28,29'),
(5, '测试用户组', 1, '2,14'),
(9, '栏目管理员', 1, '6,30,15,16,31'),
(13, '超级管理员', 1, '2,14,20,21,22,23,19,3,4,5,24,32,6,30,15,16,31,25,26,27,28,29'),
(14, '配置管理员', 1, '2,14,20,21,22,23,19'),
(12, '链接专员', 1, '3,4,5,24,32');

-- --------------------------------------------------------

--
-- 表的结构 `cp_auth_group_access`
--

CREATE TABLE `cp_auth_group_access` (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cp_auth_group_access`
--

INSERT INTO `cp_auth_group_access` (`uid`, `group_id`) VALUES
(18, 12),
(19, 9),
(20, 1),
(21, 13);

-- --------------------------------------------------------

--
-- 表的结构 `cp_auth_rule`
--

CREATE TABLE `cp_auth_rule` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '无限级权限；顶级权限的值为0，我们这里设置默认值为0；',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `sort` mediumint(9) DEFAULT '20'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cp_auth_rule`
--

INSERT INTO `cp_auth_rule` (`id`, `name`, `title`, `type`, `status`, `condition`, `pid`, `level`, `sort`) VALUES
(21, 'conf/add', '添加配置', 1, 1, '', 20, 2, 20),
(2, 'sys', '系统设置', 1, 1, '', 0, 0, 0),
(3, 'link', '友情链接', 1, 1, '', 0, 0, 0),
(4, 'link/lst', '链接列表', 1, 1, '', 3, 1, 2),
(5, 'link/add', '添加链接', 1, 1, '', 4, 2, 3),
(6, 'cate', '栏目管理', 1, 1, '', 0, 0, 0),
(15, 'cate/add', '添加栏目', 1, 1, '', 30, 2, 20),
(14, '222222', '其他系统', 1, 1, '', 2, 1, 1),
(16, 'cate/edit', '栏目修改', 1, 1, '', 30, 2, 20),
(20, 'conf/lst', '配置列表', 1, 1, '', 2, 1, 20),
(19, 'conf/conf', '配置项', 1, 1, '', 2, 1, 20),
(22, 'conf/del', '配置删除', 1, 1, '', 20, 2, 20),
(23, 'conf/edit', '配置编辑', 1, 1, '', 20, 2, 20),
(24, 'lst/del', '删除链接', 1, 1, '', 4, 2, 20),
(25, 'admin', '管理员', 1, 1, '', 0, 0, 20),
(26, 'admin/lst', '管理员列表', 1, 1, '', 25, 1, 20),
(27, 'admin/add', '管理员添加', 1, 1, '', 26, 2, 20),
(28, 'admin/del', '管理员删除', 1, 1, '', 26, 2, 20),
(29, 'admin/edit', '管理员编辑', 1, 1, '', 26, 2, 20),
(30, 'cate/lst', '栏目列表', 1, 1, '', 6, 1, 20),
(31, 'cate/del', '栏目删除', 1, 1, '', 30, 2, 20),
(32, 'link/edit', '修改链接', 1, 1, '', 4, 2, 20);

-- --------------------------------------------------------

--
-- 表的结构 `cp_cate`
--

CREATE TABLE `cp_cate` (
  `id` mediumint(9) NOT NULL COMMENT '栏目id',
  `catename` varchar(30) NOT NULL COMMENT '栏目名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '栏目类型；1代表列表栏目，2代表单页栏目，3代表图片列表',
  `keywords` varchar(255) DEFAULT NULL COMMENT '栏目关键词',
  `desc` varchar(255) DEFAULT NULL COMMENT '栏目描述',
  `content` text COMMENT '栏目内容',
  `rec_index` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示不推荐；1代表推荐',
  `rec_bottom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0代表不推荐；1代表推荐',
  `pid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '上级栏目id',
  `sort` mediumint(9) NOT NULL DEFAULT '50' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cp_cate`
--

INSERT INTO `cp_cate` (`id`, `catename`, `type`, `keywords`, `desc`, `content`, `rec_index`, `rec_bottom`, `pid`, `sort`) VALUES
(1, '经验主义', 1, '', '', '', 1, 0, 0, 10),
(3, '后现代主义', 1, '后现代主义', '逻各斯中心主义的极致', '', 0, 1, 0, 30),
(4, '批判', 1, '', '', '', 0, 0, 3, 1),
(8, '唯心经验主义', 1, '', '', '', 1, 0, 1, 30),
(13, '后现代主义的反省', 1, '', '', '', 0, 0, 3, 9),
(14, '虚无主义', 2, 'pictures', '暂无', '<h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">文化虚无主义</h3><p>当我们要瞥向文化现象的时候，首先必须划定它的界限。文化一词在它的使用中具有多种意义。“概而言之，可以分为三类。第一，物质活动层面。文化作为人的现象，是人向人的不断生成过程。因此‘文化’就是‘人化’。如果将人化理解为一个现实的事实，那么它就是人的物质生产活动。第二，精神活动层面。文化不能直接等同于人心理、情感和思想，而是它们的表现，因此文化指人们对于宗教、艺术和哲学的建构，以及各种风俗、习惯和制度的设立。第三，文字符号层面。因为文字符号是人的精神活动的聚集，所以它是文化最集中的显现。于是人们毫不奇怪将学文化等同与学文字，把文化哲学也命名为符号哲学”。 在我们的日常语言的使用中，这三种文化的意义可以说是同时使用的。其中也许第二种语义的使用最为广泛，如人们熟知的联合国的教育、科学、文化和卫生组织中的文化就是第二种语义的文化。</p><p>虽然文化现象一直伴随着人类的历史，但它只是在当代世界成为了一个突出性的问题。为什么？人类漫长的历史主要是物质生产活动的历史，而不是精神活动的历史。在从事物质生产活动的时候，人基本上是依靠自己的身体，凭借自己的双手。只是在工业革命之后，人才逐渐地不断从繁重的体力劳动从获得自由。如果说第一次工业革命作为机械技术是人的身体的解放的话，那么第二次工业革命作为信息技术则是人的大脑的解放。当代世界的文化问题实际上是信息技术时代的产物。信息技术使人在从事物质生产的同时具有更多的可能去从事文化生产和消费。不仅如此，它还使文化生产和消费本身开拓了前所未有的前景。在这样的意义上，当代世界的文化在根本上是一种信息文化，或媒介文化，如书刊、电影、电视、互联网、移动电话等成为了当代文化的主要载体。</p><p>中国当然是一个文化的古国和大国。与西方以基督教为主体的文化不同，中国形成了儒家、道家和禅宗的文化，它们影响了中国人的精神世界和日常生活。但十九世纪以来，中国传统文化和中华民族一样都面临着生存的危机。一方面，基督教及其相关的西方文化借助于帝国主义更进一步侵入中国，给与中国文化致命的一击；另一方面，中国文化自身由于其衰败也导致中国人自身对于其根基发生了怀疑。文化的危机固然是中国近现代历史的一个严重问题，但比它更严重的是整个中华民族的生存的危机。因此政治问题压倒了文化问题。这表现为：首先是中华民族反抗外来民族的斗争，其次是被压迫者反对压迫者的阶级斗争，最后是以经济建设为中心的现代化建设，这里的经济被理解为最大的政治。只是当经济建设发展到一定阶段的时候，文化问题才迫切地突显出来。</p><p>这在于文化的发展和整个社会整体的其它方面如经济和政治等的发展失去了平衡并发生了矛盾。它表现为：物质文明的建设相对向前，而精神文明的建设相对落后。这导致了整个社会的许多问题，不仅生活缺少多样性和丰富性，而且出现了心理和精神的病态。但这种种问题促使了一种时代意识的觉醒：不仅要建设小康社会，而且要全面建设小康社会。小康社会的全面性就意味着不只是物质文明的建设，而也是政治文明和精神文明的建设。所谓的精神文明就其主体而言就是文化的建设。与全面建设小康社会的同时，是和谐社会的建设。和谐社会的建设的使命在根本上是克服社会的种种矛盾。但一种真正的和谐社会的建设包括了三个根本的方面。首先是社会和谐，是人与社会的公平正义；其次是生态和谐，即人与自然的友好相处；最后是精神和谐，即真善美成为人的精神支柱。和谐社会中的精神和谐方面实际上给当代中国的文化建设提出了更高的要求。</p><p>中国的现代化建设除了设定文化建设的理念之外，还给它提出了一种制度转型的要求。长期以来，受计划经济的影响，中国的文化机构和设施是属于政府并为政府所管理的，因此毫不奇怪它要服从行政干预并为行政服务。但改革开放以来，中国的整个社会已经完成了从计划经济到市场经济的根本转变。与此不同，文化机构及其设施仍然固守于计划经济的限制之中，依然是远离市场经济的。为了适应整个社会的发展变化，文化建设必须考虑新的出路。它就是人们所提出的文化产业的问题。这无非表明，尽管文化自身有其社会性和公益性的意义，但它也必须将自身看成是一种产业，如同工业、农业和服务业一样。于是文化就必须将自身作为一个商品，置于市场之中，遵守市场的游戏规则，去生产，去交换，并去被消费。如果事情是这样的话，那么文化就不仅会成为文化产业，而且可能会产业化。</p><p>文化建设变成文化产业的建设势不可挡。事实上，这不过是开端而已，远不是终结。虽然一些文化产业已经取得了非常好的效益，但整体而言依然具有许多困难。对此姑且不论，就文化产业在整个国民生产总值的比例来看，中国和西方如美国相比还存在非常大的距离。但关键不是人们是否要坚持走文化产业的道路，而是人们如何走文化产业的道路。</p><p>当前的文化产业建设必须面对当前中国文化现状的种种的问题。这主要表现为文化在不同方面的非均衡性发展。</p><p>首先是精英和大众文化的差异。中国的文化精英在文化的消费方面无疑具有优越性。他们是大学教授、文学家、艺术家和其他文化专业人士，除了阅读哲学、宗教和艺术等方面的书籍之外，还在各种不同的时间出入美术馆、画廊、剧院等。与此不同，一般大众也许主要是消磨在电视机前，为各种节目特别是流行的电视剧所吸引，当然也有可能到歌舞厅去唱歌和跳舞。精英和大众文化的差异无疑是显著的，正如传统所说的是阳春白雪和下里巴人的差别。但如今的问题是，精英文化缺 少对于大众文化的引导，相反，大众文化往往借助于流行文化构成了对于精英文化的冲击。</p><p>其次是城市和乡村文化的距离。因为中国的城乡二元结构的特征异常突出，所以在文化方面的差距特别触目惊心。城市的发展日益趋向现代化，但乡村的建设比较而言是落后的，甚至是停滞不前的。当城里人借助各种现代的技术如有线电视、互联网和各种先进的文化设施享受各种文化产品的时候，乡下人只能收看电视中的几个节目。也许乡土文化更多的是各种传统的节庆，婚丧嫁娶，还有麻将和赌博等。一个典型的城市和乡村文化的距离的范例是超级女声的比赛。当城市为此狂欢和痴迷的时候，乡村对此却极其冷淡和毫无兴趣。</p><p>最后是中国和西方文化的矛盾。当代的中国已经不再是一个对世界封闭的国家，而是面向世界，以主动的姿态卷入了全球化的浪潮。这也导致中国当代的文化不仅保持了中华民族自身的，而且包容了世界的，其中主要是西方的。于是我们看到两种情形，一方面是儒家文化的复兴，如读经、尊孔和办国学院，另一方面则是基督教文化和现代西方文化的引进，如最突出的是在青年大学生中基督教神学的介绍和西方生活方式的接受。在一定范围内，西方文化比中国文化具有一定的强势。一个极其具有代表性的例子是，面对西方情人节的玫瑰、烛光、美酒和咖啡，中国富有浪漫、想象和诗意的七夕却被人遗忘，而且即使被冠以中国情人节的美名，也激起不了那些痴男爱女的向望。</p><p>除上述所说的问题之外，当代中国的文化建设还有许许多多的问题。它们都是在文化产业的发展过程中不可回避的和必须解决的。但这种文化产业的非均衡性或者是非和谐的发展还不是当代文化建设的根本性问题。最根本性的问题在于文化本性受到了伤害。必须承认，文化的产业化从行政控制中解放出来，甚至从某种狭隘的政策、政治、意识形态中解放出来，是一个历史性的进步。但文化产业的发展自身却具有一个致命的危险，即文化在产业化、商业化和市场化的时候，逐渐丧失文化自身的本性。在市场经济的游戏中，对于当代中国文化构成威胁的因素有三个：虚无主义、技术主义和享乐主义。它们实际上已经形成了三种文化。</p><p>第一，虚无主义的文化。虚无主义主要否认人生和世界意义，也就是基础、目的和价值等。在当代中国文化中，传统的价值也就是儒家所主张的价值已经不再具有规定性，它至多只是一个文化遗产和遗迹。如传统的春节不仅是家人的团圆，而且也是对于天地的膜拜和对于祖宗的追思，但如今的春节却完全改变了其本性。在饥饿的岁月里，它是饱餐的时机，但在温饱的年代里，它几乎只是一个例行公式。人们不敬畏天地，但未必就崇拜上帝。如在西方的圣诞节，人们到教堂去赞美上帝，在家里和亲人相聚。但在中国的圣诞节，人们往往和朋友们狂欢。既不是天地，也不是上帝，而是各种体育和娱乐明星成为了我们时代的偶像。他们并不代表某种最高的原则，而是因为他们在某个领域里第一，是名人。但最具时代特征的是各种类型的造星运动，它将一个非英雄变成英雄，如芙蓉姐姐。这些人物几乎没有任何意义，甚至可以说，他们就是虚无主义的明星。</p><p>第二、技术主义的文化。当代的各种文化只要它试图进入市场的话，那么它们都必须借助于技术，最主要是传媒技术、信息技术。例如广告就是极端情形。一种文化产品已经被技术处理过了，而广告对于这样一个技术化的文化产品还要进行再度技术处理。就技术方面而言，当代文化不同于传统文化最突出的特征是它的虚拟化。一个虚拟的文化产品所呈现的特性为：假的如同真的。因此人们生活在虚拟的世界里如同生活在现实世界里一样。但这容易混淆现实和虚拟的界限，如今已经成为一个严重的社会问题的网络依赖症就是如此。正如人们依赖酒精和毒品所制造的麻醉和幻觉一样，网络依赖症就是对于虚拟世界的依赖。它无非表明，人被技术化了，人被技术所制造的虚拟世界所控制了。</p><p>第三，享乐主义的文化。当文化成为产品的时候，它就要提供给人消费。所谓消费就是满足人的欲望。人有各种欲望，有身体的，有社会的，还有精神的。但身体感官欲望的满足，亦即享乐，成为了消费最直接的形态。因此一些文化产品便直接或间接地将享乐主义作为自己的原则。于是不仅所谓的娱乐文化，而且一般的文化也奉行这样的口号：娱乐至上，娱乐至死。更有甚者，有的文化产品为了刺激人们的欲望，诲淫诲盗，宣传色情和暴力。这种文化就不是一般的享乐主义了，而是假丑恶，是走向犯罪。</p><p><br/></p>', 0, 0, 0, 50),
(15, '理想后现代', 1, '', '', '', 0, 0, 3, 50),
(16, '现代虚无主义', 2, '虚无主义', '虚无主义-作为哲学意义认为世界，特别是人类的存在没有意义、目的以及可理解的真相及最本质价值。与其说它是一个人公开表示的立场，不如说它是提出的一种针锋相对的意见。许多评论者认为达达主义（Dada），解构主义（Deconstructionism）, 朋克（Punk）这些运动都是虚无主义性质的，虚无主义也被定义为某些时代的特征。如：鲍德里亚（Baudrillard）称后现代是虚无主义时代。虚无主义者被称为nihiliste。', '<p><img src="/ueditor/php/upload/image/20170222/1487770623135158.jpg" title="1487770623135158.jpg" alt="geek.jpg" width="256" height="143" style="width: 256px; height: 143px;"/></p><p>“虚无主义与马克思：一个再思考”，作者：<a target="_blank" href="http://baike.baidu.com/view/1442789.htm" style="color: rgb(19, 110, 194); text-decoration: none;">刘森林</a>，发表于《马克思主义与现实》2010年第3期。文章认为，“虚无主义”有主要三个语境，四个含义：1.<a target="_blank" href="http://baike.baidu.com/view/41568.htm" style="color: rgb(19, 110, 194); text-decoration: none;">施特劳斯</a>所谓<a class="lemma-album layout-right nslog:10000206" title="警惕和反对虚无主义" href="http://baike.baidu.com/pic/%E8%99%9A%E6%97%A0%E4%B8%BB%E4%B9%89/504188/425813/9319cf09cb3885ead0581beb?fr=lemma&ct=cover" target="_blank" nslog-type="10000206" style="color: rgb(19, 110, 194); text-decoration: none; display: block; width: 164px; border-bottom-width: 0px; margin: 10px 0px; position: relative; float: right; clear: right;"></a></p><p><a class="lemma-album layout-right nslog:10000206" title="警惕和反对虚无主义" href="http://baike.baidu.com/pic/%E8%99%9A%E6%97%A0%E4%B8%BB%E4%B9%89/504188/425813/9319cf09cb3885ead0581beb?fr=lemma&ct=cover" target="_blank" nslog-type="10000206" style="color: rgb(19, 110, 194); text-decoration: none; display: block; width: 164px; border-bottom-width: 0px; margin: 10px 0px; position: relative; float: right; clear: right;"><img class="picture" alt="警惕和反对虚无主义" src="https://imgsa.baidu.com/baike/s%3D220/sign=4dccdf341038534388cf8023a312b01f/9c16fdfaaf51f3decc69953c94eef01f3b29798a.jpg" style="border: 0px; width: 162px; height: 220px; position: absolute; display: block;"/></a></p><p><a class="lemma-album layout-right nslog:10000206" title="警惕和反对虚无主义" href="http://baike.baidu.com/pic/%E8%99%9A%E6%97%A0%E4%B8%BB%E4%B9%89/504188/425813/9319cf09cb3885ead0581beb?fr=lemma&ct=cover" target="_blank" nslog-type="10000206" style="color: rgb(19, 110, 194); text-decoration: none; display: block; width: 164px; border-bottom-width: 0px; margin: 10px 0px; position: relative; float: right; clear: right;">警惕和反对虚无主义<span class="number" style="display: inline; color: gray;">(2张)</span></a></p><p>&nbsp;特殊的德国现象，它认定现代文明在道德价值层面逐渐陷入“猪的城邦”；2.<a target="_blank" href="http://baike.baidu.com/view/6322.htm" style="color: rgb(19, 110, 194); text-decoration: none;">尼采</a>所谓<a target="_blank" href="http://baike.baidu.com/view/303808.htm" style="color: rgb(19, 110, 194); text-decoration: none;">柏拉图主义</a>，它一直把超感性世界认定为真实存在，同时把感性生成世界贬低为非真实的虚幻世界；3.认定现实世界是完全堕落和虚无的<a target="_blank" href="http://baike.baidu.com/view/4698937.htm" style="color: rgb(19, 110, 194); text-decoration: none;">诺斯替主义</a>；4.挣脱了柏拉图主义、历经新价值创造后最终仍否认一切（新创造的）存在之真实意义的彻底虚无主义，作为尼采虚无主义的隐微论解释，构成第四种虚无主义。</p><p><br/></p><p>虽然<a target="_blank" href="http://baike.baidu.com/view/26943.htm" style="color: rgb(19, 110, 194); text-decoration: none;">屠格涅夫</a>使虚无主义这个词被大家所知道，它是由弗里德里希·海因里希·雅各比（Friedrich Heinrich Jacobi，1743年-1819年）首先引入哲学领域。雅各比想用这个词展现出理性主义特色，特别是康德的批判哲学。他认为所有的理性主义都可以减到虚无，这样我们应该试图去避免它，回归到某些信仰。</p><p>尼采晚期的作品主要是关于虚无主义的。权力意志的一卷由尼采1883年到1888年的笔记精选组成。他将之命名为“欧洲虚无主义”并认为这是19世纪的主要问题。尼采将虚无主义定义为使世界，特别是人类生存没有意义，目标，可以理解的真相和本质价值。</p><p>虽然<a target="_blank" href="http://baike.baidu.com/view/847.htm" style="color: rgb(19, 110, 194); text-decoration: none;">后现代主义</a>被一些人取笑为虚无主义，但就虚无主义者倾向于失败主义来说它并不符合上述虚无主义的公式。后现代主义哲学家试图去寻找庆祝他所探索的形形色色独特的人类关系的力量和原因。虚无主义和怀疑论由于都拒绝知识和真相经常被放在一起比较。但怀疑论不必对道德概念的现实做出任何结论，他们也不用在没有可知事实的情况下讨论有关存在意义的问题。</p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="具体领域中的虚无主义"></a></p><h2 class="title-text" style="margin: 0px; padding: 0px 8px 0px 18px; font-size: 22px; color: rgb(0, 0, 0); float: left; font-weight: 400; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">具体领域中的虚无主义</h2><p><a class="edit-icon j-edit-link" data-edit-dl="4" style="color: rgb(136, 136, 136); display: block; float: right; height: 22px; line-height: 22px; padding-left: 24px; font-size: 12px; font-family: SimSun; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;"><span class="cmn-icon wiki-lemma-icons wiki-lemma-icons_edit-lemma" style="font-family: baikeFont_layout; -webkit-font-smoothing: antialiased; speak: none; line-height: 1; outline: 0px; margin: 0px 3px 0px 0px; vertical-align: text-bottom; color: rgb(170, 170, 170);"></span>编辑</a></p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4_1"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4_1"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="历史虚无主义"></a></p><h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">历史虚无主义</h3><p><a target="_blank" href="http://baike.baidu.com/view/479617.htm" style="color: rgb(19, 110, 194); text-decoration: none;">历史虚无主义</a>否认历史的规律性，承认支流而否定主流，透过个别现象而否认本质，孤立的分析历史中的阶段错误而否定整体过程，其一个明显的代表就是中国全盘西化的造势者，通过对我国一些阶段性错误发展的分析，而想全面抹杀我们先辈的革命，抹杀我们民族独立斗争的历史。专家学者对历史虚无主义的定义是：其根本就是历史唯心主义。</p><p>历史虚无主义认为：地理、气候、文化传统等环境性因素决定历史走向。个人在历史的“必然”潮流中，无可选择，也无可作为；即便在“可否作为”问题上凭着直觉得到肯定性答案，但却无法指出“如何作为”。这两个问题是历史虚无主义的标签。</p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4_2"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4_2"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="民族虚无主义"></a></p><h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">民族虚无主义</h3><p>虚无主义在民族问题上的表现。虚无主义一词系德文Nihilismus的意译﹐源出拉丁文nihil(虚无)。德国唯心主义哲学家F.H.雅各比在《给费希特的信》中首先使用。德国唯心主义哲学家F.尼采把否定历史传统和道德原则的现象称之为虚无主义。<a target="_blank" href="http://baike.baidu.com/view/354740.htm" style="color: rgb(19, 110, 194); text-decoration: none;">民族虚无主义</a>无视民族特点﹐抹煞民族差别﹐否定民族文化传统和历史遗产﹐甚至认为“民族”是虚构的概念﹐根本否认民族的存在﹐实质上是大民族主义和大国<a target="_blank" href="http://baike.baidu.com/view/26676.htm" style="color: rgb(19, 110, 194); text-decoration: none;">沙文主义</a>(见沙文主义)的一种表现。大民族主义是<a target="_blank" href="http://baike.baidu.com/view/635493.htm" style="color: rgb(19, 110, 194); text-decoration: none;">资产阶级民族主义</a>的一种。是强大民族的地主、资产阶级在与其他民族的关系上表现出来的民族主义。大民族的统治阶级打着维护“民族利益”的旗号，把本民族利益（实际上是统治阶级的利益）看得高于一切，宣扬“本民族优越论”，实行民族利己主义。他们在国内推行民族压迫政策，压迫、剥削、歧视少数民族，谋求和维护民族特权，挑拨民族关系，制造民族隔阂、民族纠纷，镇压各少数民族人民反抗民族压迫的斗争；在国外，推行民族扩张主义，征服和奴役其他民族，镇压被压迫民族的民族解放运动。 当然，不只资本主义国家存在着大国沙文主义，强大的社会主义国家，如苏联，也可能存在这种思想。苏联在冷战时期对东欧诸国施行的措施便是大国沙文主义的表现。</p><p>历史上一些封建专制国家的反动统治阶级矢口否认其他民族的存在。K.马克思曾嘲笑19世纪法国蒲鲁东主义者宣布“民族性为无稽之谈”﹑“一切民族特征和民族本身都是陈腐偏见”的论点。在帝国主义时代﹐资产阶级认为民族和民族主权的概念已经过时﹐把被压迫民族争取民族独立的斗争看作是“地方极权主义”﹐鼓吹“个性的自由”应当建立在超民族的﹑世界主义的基础之上﹐欺骗和诱使殖民地﹑半殖民地人民脱离民族民主革命的道路﹐同帝国主义实行政治﹑经济“合作”。资产阶级还常常利用民族虚无主义来为压迫本国民族和侵略他国民族服务。</p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4_3"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4_3"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="文化虚无主义"></a></p><h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">文化虚无主义</h3><p>当我们要瞥向文化现象的时候，首先必须划定它的界限。文化一词在它的使用中具有多种意义。“概而言之，可以分为三类。第一，物质活动层面。文化作为人的现象，是人向人的不断生成过程。因此‘文化’就是‘人化’。如果将人化理解为一个现实的事实，那么它就是人的物质生产活动。第二，精神活动层面。文化不能直接等同于人心理、情感和思想，而是它们的表现，因此文化指人们对于宗教、艺术和哲学的建构，以及各种风俗、习惯和制度的设立。第三，文字符号层面。因为文字符号是人的精神活动的聚集，所以它是文化最集中的显现。于是人们毫不奇怪将学文化等同与学文字，把文化哲学也命名为符号哲学”。 在我们的日常语言的使用中，这三种文化的意义可以说是同时使用的。其中也许第二种语义的使用最为广泛，如人们熟知的联合国的教育、科学、文化和卫生组织中的文化就是第二种语义的文化。</p><p>虽然文化现象一直伴随着人类的历史，但它只是在当代世界成为了一个突出性的问题。为什么？人类漫长的历史主要是物质生产活动的历史，而不是精神活动的历史。在从事物质生产活动的时候，人基本上是依靠自己的身体，凭借自己的双手。只是在工业革命之后，人才逐渐地不断从繁重的体力劳动从获得自由。如果说第一次工业革命作为机械技术是人的身体的解放的话，那么第二次工业革命作为信息技术则是人的大脑的解放。当代世界的文化问题实际上是信息技术时代的产物。信息技术使人在从事物质生产的同时具有更多的可能去从事文化生产和消费。不仅如此，它还使文化生产和消费本身开拓了前所未有的前景。在这样的意义上，当代世界的文化在根本上是一种信息文化，或媒介文化，如书刊、电影、电视、互联网、移动电话等成为了当代文化的主要载体。</p><p>中国当然是一个文化的古国和大国。与西方以基督教为主体的文化不同，中国形成了儒家、道家和禅宗的文化，它们影响了中国人的精神世界和日常生活。但十九世纪以来，中国传统文化和中华民族一样都面临着生存的危机。一方面，基督教及其相关的西方文化借助于帝国主义更进一步侵入中国，给与中国文化致命的一击；另一方面，中国文化自身由于其衰败也导致中国人自身对于其根基发生了怀疑。文化的危机固然是中国近现代历史的一个严重问题，但比它更严重的是整个中华民族的生存的危机。因此政治问题压倒了文化问题。这表现为：首先是中华民族反抗外来民族的斗争，其次是被压迫者反对压迫者的阶级斗争，最后是以经济建设为中心的现代化建设，这里的经济被理解为最大的政治。只是当经济建设发展到一定阶段的时候，文化问题才迫切地突显出来。</p><p>这在于文化的发展和整个社会整体的其它方面如经济和政治等的发展失去了平衡并发生了矛盾。它表现为：物质文明的建设相对向前，而精神文明的建设相对落后。这导致了整个社会的许多问题，不仅生活缺少多样性和丰富性，而且出现了心理和精神的病态。但这种种问题促使了一种时代意识的觉醒：不仅要建设小康社会，而且要全面建设小康社会。小康社会的全面性就意味着不只是物质文明的建设，而也是政治文明和精神文明的建设。所谓的精神文明就其主体而言就是文化的建设。与全面建设小康社会的同时，是和谐社会的建设。和谐社会的建设的使命在根本上是克服社会的种种矛盾。但一种真正的和谐社会的建设包括了三个根本的方面。首先是社会和谐，是人与社会的公平正义；其次是生态和谐，即人与自然的友好相处；最后是精神和谐，即真善美成为人的精神支柱。和谐社会中的精神和谐方面实际上给当代中国的文化建设提出了更高的要求。</p><p>中国的现代化建设除了设定文化建设的理念之外，还给它提出了一种制度转型的要求。长期以来，受计划经济的影响，中国的文化机构和设施是属于政府并为政府所管理的，因此毫不奇怪它要服从行政干预并为行政服务。但改革开放以来，中国的整个社会已经完成了从计划经济到市场经济的根本转变。与此不同，文化机构及其设施仍然固守于计划经济的限制之中，依然是远离市场经济的。为了适应整个社会的发展变化，文化建设必须考虑新的出路。它就是人们所提出的文化产业的问题。这无非表明，尽管文化自身有其社会性和公益性的意义，但它也必须将自身看成是一种产业，如同工业、农业和服务业一样。于是文化就必须将自身作为一个商品，置于市场之中，遵守市场的游戏规则，去生产，去交换，并去被消费。如果事情是这样的话，那么文化就不仅会成为文化产业，而且可能会产业化。</p><p>文化建设变成文化产业的建设势不可挡。事实上，这不过是开端而已，远不是终结。虽然一些文化产业已经取得了非常好的效益，但整体而言依然具有许多困难。对此姑且不论，就文化产业在整个国民生产总值的比例来看，中国和西方如美国相比还存在非常大的距离。但关键不是人们是否要坚持走文化产业的道路，而是人们如何走文化产业的道路。</p><p>当前的文化产业建设必须面对当前中国文化现状的种种的问题。这主要表现为文化在不同方面的非均衡性发展。</p><p>首先是精英和大众文化的差异。中国的文化精英在文化的消费方面无疑具有优越性。他们是大学教授、文学家、艺术家和其他文化专业人士，除了阅读哲学、宗教和艺术等方面的书籍之外，还在各种不同的时间出入美术馆、画廊、剧院等。与此不同，一般大众也许主要是消磨在电视机前，为各种节目特别是流行的电视剧所吸引，当然也有可能到歌舞厅去唱歌和跳舞。精英和大众文化的差异无疑是显著的，正如传统所说的是阳春白雪和下里巴人的差别。但如今的问题是，精英文化缺 少对于大众文化的引导，相反，大众文化往往借助于流行文化构成了对于精英文化的冲击。</p><p>其次是城市和乡村文化的距离。因为中国的城乡二元结构的特征异常突出，所以在文化方面的差距特别触目惊心。城市的发展日益趋向现代化，但乡村的建设比较而言是落后的，甚至是停滞不前的。当城里人借助各种现代的技术如有线电视、互联网和各种先进的文化设施享受各种文化产品的时候，乡下人只能收看电视中的几个节目。也许乡土文化更多的是各种传统的节庆，婚丧嫁娶，还有麻将和赌博等。一个典型的城市和乡村文化的距离的范例是超级女声的比赛。当城市为此狂欢和痴迷的时候，乡村对此却极其冷淡和毫无兴趣。</p><p>最后是中国和西方文化的矛盾。当代的中国已经不再是一个对世界封闭的国家，而是面向世界，以主动的姿态卷入了全球化的浪潮。这也导致中国当代的文化不仅保持了中华民族自身的，而且包容了世界的，其中主要是西方的。于是我们看到两种情形，一方面是儒家文化的复兴，如读经、尊孔和办国学院，另一方面则是基督教文化和现代西方文化的引进，如最突出的是在青年大学生中基督教神学的介绍和西方生活方式的接受。在一定范围内，西方文化比中国文化具有一定的强势。一个极其具有代表性的例子是，面对西方情人节的玫瑰、烛光、美酒和咖啡，中国富有浪漫、想象和诗意的七夕却被人遗忘，而且即使被冠以中国情人节的美名，也激起不了那些痴男爱女的向望。</p><p>除上述所说的问题之外，当代中国的文化建设还有许许多多的问题。它们都是在文化产业的发展过程中不可回避的和必须解决的。但这种文化产业的非均衡性或者是非和谐的发展还不是当代文化建设的根本性问题。最根本性的问题在于文化本性受到了伤害。必须承认，文化的产业化从行政控制中解放出来，甚至从某种狭隘的政策、政治、意识形态中解放出来，是一个历史性的进步。但文化产业的发展自身却具有一个致命的危险，即文化在产业化、商业化和市场化的时候，逐渐丧失文化自身的本性。在市场经济的游戏中，对于当代中国文化构成威胁的因素有三个：虚无主义、技术主义和享乐主义。它们实际上已经形成了三种文化。</p><p>第一，虚无主义的文化。虚无主义主要否认人生和世界意义，也就是基础、目的和价值等。在当代中国文化中，传统的价值也就是儒家所主张的价值已经不再具有规定性，它至多只是一个文化遗产和遗迹。如传统的春节不仅是家人的团圆，而且也是对于天地的膜拜和对于祖宗的追思，但如今的春节却完全改变了其本性。在饥饿的岁月里，它是饱餐的时机，但在温饱的年代里，它几乎只是一个例行公式。人们不敬畏天地，但未必就崇拜上帝。如在西方的圣诞节，人们到教堂去赞美上帝，在家里和亲人相聚。但在中国的圣诞节，人们往往和朋友们狂欢。既不是天地，也不是上帝，而是各种体育和娱乐明星成为了我们时代的偶像。他们并不代表某种最高的原则，而是因为他们在某个领域里第一，是名人。但最具时代特征的是各种类型的造星运动，它将一个非英雄变成英雄，如芙蓉姐姐。这些人物几乎没有任何意义，甚至可以说，他们就是虚无主义的明星。</p><p>第二、技术主义的文化。当代的各种文化只要它试图进入市场的话，那么它们都必须借助于技术，最主要是传媒技术、信息技术。例如广告就是极端情形。一种文化产品已经被技术处理过了，而广告对于这样一个技术化的文化产品还要进行再度技术处理。就技术方面而言，当代文化不同于传统文化最突出的特征是它的虚拟化。一个虚拟的文化产品所呈现的特性为：假的如同真的。因此人们生活在虚拟的世界里如同生活在现实世界里一样。但这容易混淆现实和虚拟的界限，如今已经成为一个严重的社会问题的网络依赖症就是如此。正如人们依赖酒精和毒品所制造的麻醉和幻觉一样，网络依赖症就是对于虚拟世界的依赖。它无非表明，人被技术化了，人被技术所制造的虚拟世界所控制了。</p><p>第三，享乐主义的文化。当文化成为产品的时候，它就要提供给人消费。所谓消费就是满足人的欲望。人有各种欲望，有身体的，有社会的，还有精神的。但身体感官欲望的满足，亦即享乐，成为了消费最直接的形态。因此一些文化产品便直接或间接地将享乐主义作为自己的原则。于是不仅所谓的娱乐文化，而且一般的文化也奉行这样的口号：娱乐至上，娱乐至死。更有甚者，有的文化产品为了刺激人们的欲望，诲淫诲盗，宣传色情和暴力。这种文化就不是一般的享乐主义了，而是假丑恶，是走向犯罪。</p><p>当代中国文化的建设必须针对上述三种倾向，开辟新的道路。反对虚无主义，让古今中外的智慧照亮我们的生活世界；反对技术主义，让技术不要控制万物和人；反对享乐主义，让欲望不要越过其当代历史所确定的边界。惟有如此，我们才能建设一个中国的现代的文化。它是中国的，因此是民族的；同时也是现代的，因此是与时俱进的。这种中国的现代的文化便实现了文化自身的本性：陶冶和塑造人性，让人得到全面自由的发展。</p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4_4"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4_4"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="伦理道德上的虚无主义"></a></p><h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">伦理道德上的虚无主义</h3><p>在伦理中，“虚无主义者”或“虚无主义”是用来指彻底拒绝一切权威，道德，社会习惯的行为，或声言要这样做的人。或是通过拒绝一切既定的的信仰,或是通过极端的相对主义或<a target="_blank" href="http://baike.baidu.com/view/588200.htm" style="color: rgb(19, 110, 194); text-decoration: none;">怀疑主义</a>，虚无主义者认为那些对于权力的掌控都是无效的并应被对抗。在虚无主义者看来，道德价值的最终来源不是文化或理性的基础而是个体。</p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4_5"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4_5"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="法律虚无主义"></a></p><h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">法律虚无主义</h3><p><a target="_blank" href="http://baike.baidu.com/view/4967861.htm" style="color: rgb(19, 110, 194); text-decoration: none;">法律虚无主义</a>，是指否认法律在阶级统治和维护社会秩序中的作用，主张由人治或“天治”来代替之。在文革时期法律虚无主义一度盛行，给国家和人民带来巨大灾难。</p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4_6"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4_6"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="后现代主义"></a></p><h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">后现代主义</h3><p><a target="_blank" href="http://baike.baidu.com/view/847.htm" style="color: rgb(19, 110, 194); text-decoration: none;">后现代主义</a>思想将认识论及伦理体系推至极端的相对主义。这在让·弗朗索瓦·利奥塔（Jean-Fran&amp;ccedil;ois Lyotard）及德里达（Jacques Derrida）的作品中尤其明显。这些哲学家试图否认西方文明真理、意义、历史进程、<a target="_blank" href="http://baike.baidu.com/view/6542.htm" style="color: rgb(19, 110, 194); text-decoration: none;">人文主义</a>理想以及启蒙运动所建立的基础。虽然原则上后现代主义被认为是虚无主义哲学，值得注意的是，虚无主义接受后现代主义的非难。虚无主义是对宇宙真理的宣称，这正是后现代主义所拒绝的。</p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4_7"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4_7"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="以达达主义为代表的现代艺术"></a></p><h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">以达达主义为代表的现代艺术</h3><p>有许多艺术运动如超现实主义、立体主义都被人们批评说有虚无主义嫌疑。另一些艺术运动如达达主义则公开将之奉为信条。广泛地说，现代艺术被认为是虚无主义的。正像在纳粹党的堕落艺术展上的作品一样，现代艺术通常有一种非表现性的本质。.</p><p><a target="_blank" href="http://baike.baidu.com/subview/65573/5119351.htm" data-lemmaid="3766" style="color: rgb(19, 110, 194); text-decoration: none;">达达主义</a>在第一次世界大战期间首先被使用，这酝酿了后来从1916年持续到1923年的运动。达达主义者声称达达运动不是艺术运动而是反艺术运动。有时他们从别的作品中拿出部分将之拼接起来，很像是重拼诗（found poetry），这样他们削弱了艺术的含义与定义。其它时候,达达主义者关注审美趋向以求避免它，试图使他们的作品没有意义及审美价值。这种对于艺术贬值的倾向使很多人认为达达主义事实上是虚无主义运动，因为它们只是破坏而没有建造。</p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4_8"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4_8"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="朋克摇滚"></a></p><h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">朋克摇滚</h3><p><a target="_blank" href="http://baike.baidu.com/view/1397675.htm" style="color: rgb(19, 110, 194); text-decoration: none;">朋克摇滚</a>经常被认为对世界持有虚无主义和无政府主义看法。</p><p><br/></p>', 1, 1, 14, 50),
(17, '存在主义', 3, '存在主义', '存在主义（Existentialism），当代西方哲学主要流派之一。这一名词最早由法国天主教哲学家加布里埃尔马塞尔提出。存在主义是一个很广泛的哲学流派，主要包括有神论的存在主义、无神论的存在主义和人道主义的存在主义三大类，它可以指任何以孤立个人的非理性意识活动当作最真实存在的人本主义学说。存在主义以人为中心、尊重人的个性和自由。人是在无意义的宇宙中生活，人的存在本身也没有意义，但人可以在原有存在的基础上自我造就，活得精彩。', '<p><span style="color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; background-color: rgb(255, 255, 255);">存在主义的思想渊源主要来自于索伦·克尔凯郭尔的</span><a target="_blank" href="http://baike.baidu.com/view/185257.htm" style="color: rgb(19, 110, 194); text-decoration: none; font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);">神秘主义</a><span style="color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; background-color: rgb(255, 255, 255);">、</span><a target="_blank" href="http://baike.baidu.com/view/6322.htm" style="color: rgb(19, 110, 194); text-decoration: none; font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);">尼采</a><span style="color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; background-color: rgb(255, 255, 255);">的唯意志主义、</span><a target="_blank" href="http://baike.baidu.com/view/9197.htm" style="color: rgb(19, 110, 194); text-decoration: none; font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);">胡塞尔</a><span style="color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; background-color: rgb(255, 255, 255);">的现象学等。存在主义的主要创始人是</span><a target="_blank" href="http://baike.baidu.com/view/6197.htm" style="color: rgb(19, 110, 194); text-decoration: none; font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);">海德格尔</a><span style="color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; background-color: rgb(255, 255, 255);">，将存在主义发扬光大的是</span><a target="_blank" href="http://baike.baidu.com/view/17033.htm" style="color: rgb(19, 110, 194); text-decoration: none; font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);">萨特</a><span style="color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; background-color: rgb(255, 255, 255);">。</span></p>', 1, 1, 0, 50),
(18, '完全形态的虚无主义', 2, '虚无主义', '虚无主义', '<h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">后现代主义</h3><p><a target="_blank" href="http://baike.baidu.com/view/847.htm" style="color: rgb(19, 110, 194); text-decoration: none;">后现代主义</a>思想将认识论及伦理体系推至极端的相对主义。这在让·弗朗索瓦·利奥塔（Jean-Fran&amp;ccedil;ois Lyotard）及德里达（Jacques Derrida）的作品中尤其明显。这些哲学家试图否认西方文明真理、意义、历史进程、<a target="_blank" href="http://baike.baidu.com/view/6542.htm" style="color: rgb(19, 110, 194); text-decoration: none;">人文主义</a>理想以及启蒙运动所建立的基础。虽然原则上后现代主义被认为是虚无主义哲学，值得注意的是，虚无主义接受后现代主义的非难。虚无主义是对宇宙真理的宣称，这正是后现代主义所拒绝的。</p><p><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="4_7"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="sub26705_4_7"></a><a style="color: rgb(19, 110, 194); position: absolute; top: -50px;" name="以达达主义为代表的现代艺术"></a></p><h3 class="title-text" style="margin: 0px; padding: 0px; font-size: 18px; font-weight: 400;">以达达主义为代表的现代艺术</h3><p>有许多艺术运动如超现实主义、立体主义都被人们批评说有虚无主义嫌疑。另一些艺术运动如达达主义则公开将之奉为信条。广泛地说，现代艺术被认为是虚无主义的。正像在纳粹党的堕落艺术展上的作品一样，现代艺术通常有一种非表现性的本质。.</p><p><a target="_blank" href="http://baike.baidu.com/subview/65573/5119351.htm" data-lemmaid="3766" style="color: rgb(19, 110, 194); text-decoration: none;">达达主义</a>在第一次世界大战期间首先被使用，这酝酿了后来从1916年持续到1923年的运动。达达主义者声称达达运动不是艺术运动而是反艺术运动。有时他们从别的作品中拿出部分将之拼接起来，很像是重拼诗（found poetry），这样他们削弱了艺术的含义与定义。其它时候,达达主义者关注审美趋向以求避免它，试图使他们的作品没有意义及审美价值。这种对于艺术贬值的倾向使很多人认为达达主义事实上是虚无主义运动，因为它们只是破坏而没有建造。</p><p><br/></p>', 0, 0, 14, 50);

-- --------------------------------------------------------

--
-- 表的结构 `cp_conf`
--

CREATE TABLE `cp_conf` (
  `id` mediumint(9) NOT NULL COMMENT '配置项id',
  `cnname` varchar(50) NOT NULL COMMENT '配置中文名称',
  `enname` varchar(50) NOT NULL COMMENT '配置英文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '配置类型；1代表单行文本框，2代表多行文本，3代表单选按钮，4代表复选框，5代表下拉菜单',
  `value` varchar(255) DEFAULT NULL COMMENT '配置值',
  `values` varchar(255) DEFAULT NULL COMMENT '配置可选值',
  `sort` smallint(6) DEFAULT '50' COMMENT '配置项排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cp_conf`
--

INSERT INTO `cp_conf` (`id`, `cnname`, `enname`, `type`, `value`, `values`, `sort`) VALUES
(25, '启用验证码', 'code', 4, '是', '是', 2),
(24, '江疏影DOTA2', 'DT1', 2, 'AS', '中文的逗号,英文的都好,,,,,,', 2),
(26, '多久清空缓存', 'cache', 5, '3个小时', '1个小时,2个小时,3个小时', 1),
(36, '允许评论', 'talk', 4, '是', '是', 1),
(37, '1213', 'a', 2, '', 'a', 1222),
(31, '是否关闭网站', 'closewebsite', 3, '否', '是,否', 0),
(32, 'Wayne', 'webname', 1, 'fate', 'Bruce Wayne,Fate', 0),
(33, '站点关键词', 'keywords', 1, 'fate', 'fate,human', 0),
(34, '站点描述', 'webdesc', 2, '暂无啊', '暂时没有站点描述', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cp_link`
--

CREATE TABLE `cp_link` (
  `id` mediumint(9) NOT NULL,
  `title` varchar(100) NOT NULL,
  `desc` text,
  `url` varchar(255) NOT NULL,
  `sort` mediumint(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cp_link`
--

INSERT INTO `cp_link` (`id`, `title`, `desc`, `url`, `sort`) VALUES
(1, '百度', '百度一下，你就知道', 'http://www.baidu.com', 20),
(3, '京东', '京东购物', 'http://jd.com', 10),
(8, '奇虎360', '奇虎', 'http://360.com', 1),
(4, 'F-society', 'Fsociaty', 'http://fsociaty.abpcd.com/', 22),
(5, 'I-MOOC', '慕课网', 'http://www.imooc.com/', 3),
(6, '51cto', '51-MOOC', 'http://www.51cto.com/', 4),
(7, 'Metal-Archives', 'MA', 'http://www.metal-archives.com/', 0),
(16, '社会化分享按钮', 'http://www.jiathis.com/', 'www.jiathis.com/', 20),
(9, '腾讯主页', '腾讯', 'http://qq.com', 2),
(14, '百度一下', '1', 'http://www.baidu.com1', 11),
(13, '腾讯', '1', 'http://qq.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cp_admin`
--
ALTER TABLE `cp_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_article`
--
ALTER TABLE `cp_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_auth_group`
--
ALTER TABLE `cp_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_auth_group_access`
--
ALTER TABLE `cp_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `cp_auth_rule`
--
ALTER TABLE `cp_auth_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cp_cate`
--
ALTER TABLE `cp_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_conf`
--
ALTER TABLE `cp_conf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_link`
--
ALTER TABLE `cp_link`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cp_admin`
--
ALTER TABLE `cp_admin`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '管理员ID', AUTO_INCREMENT=22;
--
-- 使用表AUTO_INCREMENT `cp_article`
--
ALTER TABLE `cp_article`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '文章ID', AUTO_INCREMENT=39;
--
-- 使用表AUTO_INCREMENT `cp_auth_group`
--
ALTER TABLE `cp_auth_group`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `cp_auth_rule`
--
ALTER TABLE `cp_auth_rule`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- 使用表AUTO_INCREMENT `cp_cate`
--
ALTER TABLE `cp_cate`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '栏目id', AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `cp_conf`
--
ALTER TABLE `cp_conf`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '配置项id', AUTO_INCREMENT=40;
--
-- 使用表AUTO_INCREMENT `cp_link`
--
ALTER TABLE `cp_link`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
