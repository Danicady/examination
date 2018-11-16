<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/8
 * Time: 16:17
 */
require 'fun_con_db.php';
if ($_GET) {
    $userID = $_GET['userID'];
    $con = db_con();
    $user=mysqli_fetch_assoc(mysqli_query($con,"select userID ,password ,name,superior from user where userID='{$userID}'"));
    $sql="select r.id, r.userID,class.classID,class.classname,class.number,class.department,class.tname,c.courseID,c.cname,c.nature from relationship r join course c on r.courseID=c.courseID
join class on class.classID=r.classID where userID='{$userID}'";
    $classRes=mysqli_query($con,$sql);
    $data=[];
    $data['user']=$user;
    $i=0;
    while ($row=mysqli_fetch_assoc($classRes)){
        $data['class'][$i]['classname'] = $row['classname'];
        $data['class'][$i]['number'] = $row['number'];
        $data['class'][$i]['tname'] = $row['tname'];
        $data['class'][$i]['department'] = $row['department'];
        $data['class'][$i]['nature'] = $row['nature'];
        $data['class'][$i]['cname'] = $row['cname'];
        $data['class'][$i]['id'] = $row['id'];
        $i++;
    }
    echo json_encode($data);
}