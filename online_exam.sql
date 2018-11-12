create database exam;
use exam;


create table user(
userID int(15) primary key,
name varchar(20),
password varchar(20),
department enum('��Ϣ���������ϵ','�������ѧ�빤��ϵ','�������ϵ','��������ϵ','��Ϣ����ϵ','Ӧ������ϵ','������ѧ��','˼���������ۿν�ѧ��'),
role enum('admin','user'),
superior int(15),
token varchar(50)
)charset=utf8;

CREATE TABLE IF NOT EXISTS `course` (
  `courseID` int(8) NOT NULL,
  `cname` varchar(20) DEFAULT NULL,
  `major` varchar(20) DEFAULT NULL,
  `nature` enum('ѡ�޿�','���޿�') DEFAULT NULL,
  `credit` int(4) DEFAULT NULL,
  `department` enum('��Ϣ���������ϵ','�������ѧ�빤��ϵ','�������ϵ','��������ϵ','��Ϣ����ϵ','Ӧ������ϵ') DEFAULT NULL,
  `unitnum` int(4) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`courseID`)
)charset=utf8;


CREATE TABLE IF NOT EXISTS `class` (
  `classID` int(254) NOT NULL AUTO_INCREMENT,
  `classname` varchar(20) DEFAULT NULL,
  `department` enum('��Ϣ���������ϵ','�������ѧ�빤��ϵ','�������ϵ','��������ϵ','��Ϣ����ϵ','Ӧ������ϵ') DEFAULT NULL,
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
type enum('ѡ����','�����','�ж���','Ӧ����','����','����','����','��ƪ�Ķ�','��ϸ�Ķ�','ѡ�����'),
answer text,
sdate timestamp,
unit int(4),
courseID int(8),
difficulty enum('��','��','��')
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
(1, '�������1��', '��Ϣ���������ϵ', 29, '���'),
(2, '�������1��', '�������ϵ', 30, '���'),
(3, '����3��', '��������ϵ', 25, '���');

INSERT INTO `course` (`courseID`, `cname`, `major`, `nature`, `credit`, `department`, `unitnum`, `type`) VALUES
(1, 'Ӣ��', '�������', '���޿�', 4, '��Ϣ���������ϵ', 4, 'д�� ���� ѡ����� ��ƪ�Ķ� ��ϸ�Ķ� ����'),
(2, '����һ', '�������', '���޿�', 4, '��Ϣ���������ϵ', 8, 'ѡ���� ����� Ӧ����'),
(3, '����', '����Ӣ��', '���޿�', 4, '�������ϵ', 4, '����֪ʶ �Ķ� ����');