-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-11-12 02:13:54
-- 服务器版本： 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- 表的结构 `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `classID` int(254) NOT NULL AUTO_INCREMENT,
  `classname` varchar(20) DEFAULT NULL,
  `department` enum('信息与软件工程系','计算机科学与工程系','商务管理系','数字艺术系','信息管理系','应用外语系') DEFAULT NULL,
  `number` int(4) DEFAULT NULL,
  `tname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`classID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `class`
--

INSERT INTO `class` (`classID`, `classname`, `department`, `number`, `tname`) VALUES
(1, '软件工程1班', '信息与软件工程系', 29, '随便'),
(2, '商务管理1班', '商务管理系', 30, '随便'),
(3, '数艺3班', '数字艺术系', 25, '随便');

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `courseID` int(8) NOT NULL,
  `cname` varchar(20) DEFAULT NULL,
  `major` varchar(20) DEFAULT NULL,
  `nature` enum('选修课','必修课') DEFAULT NULL,
  `credit` int(4) DEFAULT NULL,
  `department` enum('信息与软件工程系','计算机科学与工程系','商务管理系','数字艺术系','信息管理系','应用外语系') DEFAULT NULL,
  `unitnum` int(4) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`courseID`, `cname`, `major`, `nature`, `credit`, `department`, `unitnum`, `type`) VALUES
(1, '英语', '软件工程', '必修课', 4, '信息与软件工程系', 4, '写作 听力 选词填空 长篇阅读 仔细阅读 翻译'),
(2, '高数一', '软件工程', '必修课', 4, '信息与软件工程系', 8, '选择题 填空题 应用题'),
(3, '日语', '商务英语', '必修课', 4, '商务管理系', 4, '语言知识 阅读 听力');

-- --------------------------------------------------------

--
-- 表的结构 `paper`
--

DROP TABLE IF EXISTS `paper`;
CREATE TABLE IF NOT EXISTS `paper` (
  `pid` int(15) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) DEFAULT NULL,
  `pdate` timestamp NULL DEFAULT NULL,
  `userID` int(15) DEFAULT NULL,
  `classID` int(8) DEFAULT NULL,
  `courseID` int(8) DEFAULT NULL,
  `time` int(4) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `pnature` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `relationship`
--

DROP TABLE IF EXISTS `relationship`;
CREATE TABLE IF NOT EXISTS `relationship` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `userID` int(15) DEFAULT NULL,
  `courseID` int(8) DEFAULT NULL,
  `classID` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `relationship`
--

INSERT INTO `relationship` (`id`, `userID`, `courseID`, `classID`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 2, 2, 3),
(4, 1, 3, 3),
(5, 1, 3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `sid` int(15) NOT NULL AUTO_INCREMENT,
  `question` text,
  `userID` int(15) DEFAULT NULL,
  `score` int(4) DEFAULT NULL,
  `type` enum('阅读','语言知识','长篇阅读','仔细阅读','写作','选词填空','选择题','填空题','判断题','应用题','作文','翻译','段落匹配') DEFAULT NULL,
  `answer` text,
  `sdate` timestamp NULL DEFAULT NULL,
  `unit` int(4) DEFAULT NULL,
  `courseID` int(8) DEFAULT NULL,
  `difficulty` enum('难','中','易') DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `subject`
--

INSERT INTO `subject` (`sid`, `question`, `userID`, `score`, `type`, `answer`, `sdate`, `unit`, `courseID`, `difficulty`) VALUES
(23, 'Stop making so much noise ____ the neighbor will start complaining. \\n A、or else。 B、but still。 C、and then 。D、so that', 1, 10, '选择题', 'B', '2018-02-17 16:00:00', 1, 1, '易'),
(24, '近年来，中国有越来越多的城市开始建设地铁。发展地铁有助于减少城市的交通拥堵和空气污染。地铁具有安全、快捷和舒适的优点。越来越多的人选择地铁作为每天上班或上学的主要交通工具。如今，在中国乘坐地铁正变得越来越方便。在有些城市里，乘客只需用卡或手机就可以乘坐地铁。许多当地老年市民还可以免费乘坐地铁', 2, 10, '翻译', 'In recent years, more and more cities in China have begun to build subways. The development of subways can help reduce traffic congestion and air pollution in cities. The subway has the advantages of safety, speed and comfort. More and more people choose the subway as the main means of transportation to work or school every day. Nowadays, it is becoming more and more convenient to take the subway in China. In some cities, passengers can use a card or a mobile phone to take the subway. Many local elderly citizens can also take the subway for free.', '2017-05-11 16:00:00', 1, 1, '难'),
(25, '　Directions: For this part, you are allowed 30 minutes to write a short essay onhow to best handle the relationshop between teachers and students.\r\n\r\n　　You should write at least 120 words but no more than 180 words.', 1, 100, '写作', 'It is a truth universally acknowledged that the relationship between a parent and a child is the most significant ones in a person’s life. Positive parent-child bond is beneficial to family harmony and the growth of children. Therefore, people should learn to balance the relationship between parents and children.\r\n\r\n　　There are some conductive suggestions given to both parents and children. First and foremost, it is very important for parents to emphasize the significance of family time spent with their children, like eating meals together on weekends, going to sporting events, movies and the like. Besides, it would be beneficial if parents could pay attention to their children\'s academic performance, friendship and extracurricular activities. Additionally, it is necessary that child should boost their awareness of communicating with their parents, with relaxed and side-by-side conversations.\r\n\r\n　　As has been noted, parents and children should make joint efforts to create good relationship between parents and children.', '2018-09-03 16:00:00', 1, 1, '易'),
(26, 'Since the 1940s, southern California has had a reputation for smog. Things are not as bad as they once were but, according to the American Lung Association, Los Angeles is still the worst city in the United States for levels of   26  . Gazing down on the city from the Getty Center, an art museum in the Santa Monica Mountains, one would find the view of the Pacific Ocean blurred by the haze (霾). Nor is the state’s had air   27  to its south. Fresno, in the central valley, comes top of the list in America for year-round pollution. Residents’ hearts and lungs are affected as a   28  .\r\n\r\nAll of which, combined with California’s reputation as the home of technological   29  , makes the place ideal for developing and testing systems designed to monitor pollution in   30  . And that is just what Aclima, a new firm in San Francisco, has been doing over the past few months. It has been trying out monitoring that are   31  to yield minute-to-minute maps of   32  air pollution. Such stations will also be able to keep an eye on what is happening inside buildings, including offices.\r\n\r\nTo this end, Aclima has been   33  with Google’s Street View system. Davida Herzl, Aclima’s boss, says they have revealed pollution highs on days when San Francisco’s transit workers went on strike and the city’s   34  were forced to use their cars. Conversely, “cycle to work” days have done their job by   35  pollution lows.\\n\r\n\r\nA:assisted。\r\nB:collaborating。\r\nC:consequence。\r\nD:consumers。\r\nE:creating。\r\nF:detail。\r\nG:domestic。\r\nH:frequently。\r\nI:inhabitants。\r\nJ:innovation。\r\nK:intended。\r\nL:outdoor。\r\nM:pollutants。\r\nN:restricted。\r\nH:Sum。', 1, 65, '仔细阅读', '26M pollutants 。\r\n27N restricted 。\r\n28C consequence 。\r\n29J innovation 。\r\n 30F detail 。\r\n31 K intended 。\r\n32 outdoor 。\r\n33 B collaborating 。\r\n\r\n34 I inhabitants 。\r\n\r\n35 E creating。', '2018-09-03 16:00:00', 1, 1, '易');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(15) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `department` enum('信息与软件工程系','计算机科学与工程系','商务管理系','数字艺术系','信息管理系','应用外语系') DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  `superior` int(15) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`userID`, `name`, `password`, `department`, `role`, `superior`, `token`) VALUES
(1, 'user', '123456', NULL, 'user', NULL, 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 'roy', '123456', NULL, 'user', NULL, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
