create database exam;
use exam;


create table user(
userID int(15) primary key,
name varchar(20),
password varchar(20),
department enum('��Ϣ���������ϵ','�������ѧ�빤��ϵ','�������ϵ','��������ϵ','��Ϣ����ϵ','Ӧ������ϵ'),
role enum('admin','user'),
superior int(15)
)charset=utf8;


create table course(
courseID int(8) primary key,
cname varchar(20),
major varchar(20)��
nature enum('ѡ�޿�','���޿�'),
credit int(4),
department enum('��Ϣ���������ϵ','�������ѧ�빤��ϵ','�������ϵ','��������ϵ','��Ϣ����ϵ','Ӧ������ϵ')
)charset=utf8;


create table class(
classID int(8) primary key,
classname varchar(20),
department enum('��Ϣ���������ϵ','�������ѧ�빤��ϵ','�������ϵ','��������ϵ','��Ϣ����ϵ','Ӧ������ϵ'),
number int(4),
tname varchar(20)
)charset=utf8;

create table relationship(
id int(15) primary key,
userID int(15),
courseID int(8),
classID int(8) 
)charset=utf8;


create table subject(
sid int(15) primary key auto_increment,
question text,
userID int(15),
score int(4),
type enum('ѡ����','�����','�ж���','Ӧ����','����','����','����ƥ��'),
answer text,
sdate date default current_date,
unit int(4),
courseID int(8),
difficulty enum('��','��','��')
)charset=utf8;


create table paper(
pid int(15) primary key auto_increment,
num varchar(100),
pdate  date default current_date,
userID int(15),
classID int(8),
courseID int(8),
time int(4),
semester varchar(50),
pnature varchar(50)
)charset=utf8;
