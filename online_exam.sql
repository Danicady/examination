create database exam;
use exam;


create table user(
userID int(15) primary key,
name varchar(20),
password varchar(20),
department enum('信息与软件工程系','计算机科学与工程系','商务管理系','数字艺术系','信息管理系','应用外语系','基础教学部','思想政治理论课教学部'),
role enum('admin','user'),
superior int(15),
token varchar(50)
)charset=utf8;

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
)charset=utf8;


CREATE TABLE IF NOT EXISTS `class` (
  `classID` int(254) NOT NULL AUTO_INCREMENT,
  `classname` varchar(20) DEFAULT NULL,
  `department` enum('信息与软件工程系','计算机科学与工程系','商务管理系','数字艺术系','信息管理系','应用外语系') DEFAULT NULL,
  `number` int(4) DEFAULT NULL,
  `tname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`classID`)
)charset=utf8;

create table relationship(
id int(15) primary key auto_increment,
userID int(15),
courseID int(8),
classID int(8) 
)charset=utf8;


create table subject(
sid int(15) primary key auto_increment,
question text,
userID int(15),
score int(4),
type enum('选择题','填空题','判断题','应用题','作文','翻译','听力','长篇阅读','仔细阅读','选词填空'),
answer text,
sdate timestamp,
unit int(4),
courseID int(8),
difficulty enum('难','中','易')
)charset=utf8;


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
)charset=utf8;

insert into user values (1,'admin','123456',null,'admin',null,md5('1'));
INSERT INTO `class` (`classID`, `classname`, `department`, `number`, `tname`) VALUES
(1, '软件工程1班', '信息与软件工程系', 29, '随便'),
(2, '商务管理1班', '商务管理系', 30, '随便'),
(3, '数艺3班', '数字艺术系', 25, '随便');

INSERT INTO `course` (`courseID`, `cname`, `major`, `nature`, `credit`, `department`, `unitnum`, `type`) VALUES
(1, '英语', '软件工程', '必修课', 4, '信息与软件工程系', 4, '写作 听力 选词填空 长篇阅读 仔细阅读 翻译'),
(2, '高数一', '软件工程', '必修课', 4, '信息与软件工程系', 8, '选择题 填空题 应用题'),
(3, '日语', '商务英语', '必修课', 4, '商务管理系', 4, '语言知识 阅读 听力');