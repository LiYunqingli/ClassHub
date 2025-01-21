-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2025-01-21 15:52:07
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `classhub`
--

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE `admins` (
  `adminid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员id',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '登录密码',
  `role` int(11) NOT NULL COMMENT '管理员权限等级',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员的名字',
  `classid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '能够管理哪个班级，只有一个班',
  `create_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '谁创建的该用户，记录的值为用户id或者管理员id',
  `create_time` datetime NOT NULL COMMENT '创建管理员的时间',
  `img_logo_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户头像地址',
  `y_n` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否启用账户，注意api需要严格的权限解析'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `classes`
--

CREATE TABLE `classes` (
  `classid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '班级id',
  `pid` int(11) NOT NULL COMMENT '专业id',
  `create_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '谁创建的班级',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `y_n` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否启用班级',
  `deyufen_y_n` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否注册使用德育分系统'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户id',
  `typeid` int(11) NOT NULL COMMENT '数据类型(考勤还是纪律...)id',
  `score` int(11) NOT NULL COMMENT '分数变化',
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '记录的内容',
  `insert_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time` datetime NOT NULL COMMENT '记录内容的发生时间',
  `adminid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员id',
  `classid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '班级id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `pids`
--

CREATE TABLE `pids` (
  `pid` int(11) NOT NULL COMMENT '专业id，自增',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '专业的名字，例如：软件与信息服务',
  `create_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '谁创建的，只有权限等级为4的用户才能创建',
  `create_time` datetime NOT NULL COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE `roles` (
  `role` int(11) NOT NULL COMMENT '记录数字1-4，4的权限等级最高',
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名字：root:root , admin:admin , admin:user , user:user',
  `role_data` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限说明（解释）'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `softwares`
--

CREATE TABLE `softwares` (
  `id` int(11) NOT NULL COMMENT '软件id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '软件名字',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '公共的还是特定用户私有的',
  `accessID` int(11) NOT NULL COMMENT '允许访问的用户id列表，引用到另外一个表，表记录的值格式：[user:2210909] / [admin:root]',
  `y_n` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否启用软件',
  `classid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '班级id',
  `appID` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'app上架的授权码（每个app都不一样-自动生成）'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `types`
--

CREATE TABLE `types` (
  `typeid` int(11) NOT NULL COMMENT '类型id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名字',
  `create_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '创建人，只有权限为4的人才能创建',
  `create_time` datetime NOT NULL COMMENT '创建或者最后一次更新的时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `userid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户id',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '登陆密码',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `classid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '所属班级的id',
  `create_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '谁创建的',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱地址',
  `post` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '班上担任的职务',
  `role` int(11) NOT NULL COMMENT '用户权限，这张表里面默认为1',
  `img_logo_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户头像地址，应当设置默认值',
  `y_n` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否启用此账户（允许登录）'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转储表的索引
--

--
-- 表的索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminid`),
  ADD KEY `role` (`role`),
  ADD KEY `classid` (`classid`);

--
-- 表的索引 `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classid`),
  ADD KEY `pid` (`pid`);

--
-- 表的索引 `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `adminid` (`adminid`),
  ADD KEY `classid` (`classid`);

--
-- 表的索引 `pids`
--
ALTER TABLE `pids`
  ADD PRIMARY KEY (`pid`);

--
-- 表的索引 `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role`);

--
-- 表的索引 `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`typeid`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `classid` (`classid`),
  ADD KEY `role` (`role`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
