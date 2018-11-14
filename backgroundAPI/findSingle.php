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
    $sql="select  e.department, e.userID, name,superior, classname,number,tname, cname,nature from
(select  r.userID,class.classID,class.classname,class.number,class.department,class.tname,c.courseID,c.cname,c.nature from relationship r join course c on r.courseID=c.courseID
join class on class.classID=r.classID) e join (select userID,name,superior from user where userID='{$userID}') u on e.userID=u.userID";
    if($res=mysqli_query($con,$sql)){
        $data=[];
        while ($row=mysqli_fetch_assoc($res))
            $data[]=$row;
        echo json_encode($data);
    }
}