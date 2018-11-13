<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/12
 * Time: 17:21
 */
require 'fun_con_db.php';
if ($_GET) {
    $name = $_GET['name'];
    $con = db_con();
    $sql="select  department, e.userID, name,superior, classname,number,tname, cname,nature from
(select  r.userID,class.classID,class.classname,class.number,class.tname,c.courseID,c.cname,c.nature from relationship r join course c on r.courseID=c.courseID
join class on class.classID=r.classID) e join (select department,userID,name,superior from user where name='{$name}') u on e.userID=u.userID";
    if($res=mysqli_query($con,$sql)){
        $data=[];
        while ($row=mysqli_fetch_assoc($res))
            $data[]=$row;
        echo json_encode($data);
    }else{
        header("HTTP/1.1 401");
        echo json_encode(array("message"=>"unauthorized token"));
    }
}