<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/7
 * Time: 14:31
 */
require 'fun_con_db.php';
if ($_GET){
    $token=$_GET['token'];
    $con=db_con();
    if ($user=mysqli_fetch_row(mysqli_query($con,"select userID from user where token='{$token}'"))){
        $sql="select  department, e.userID, name,superior, classname,number,tname, cname,nature from
(select  r.userID,class.classID,class.classname,class.number,class.tname,c.courseID,c.cname,c.nature from relationship r join course c on r.courseID=c.courseID
join class on class.classID=r.classID) e join (select department,userID,name,superior from user where superior='{$user[0]}') u on e.userID=u.userID";
        $res=mysqli_query($con,$sql);
        $data=[];
        while ($row=mysqli_fetch_assoc($res))
            $data[]=$row;
        echo json_encode($data);
    }else{
        header("HTTP/1.1 401");
        echo json_encode(array("message"=>"unauthorized token"));
    }
}