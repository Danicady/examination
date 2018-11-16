<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/8
 * Time: 14:24
 */
require 'fun_con_db.php';
if($_POST){
    $token=$_GET['token'];
    $userID=$_POST['userID'];
    $cname=$_POST['cname'];
    $classname=$_POST['classname'];
    $con = db_con();
    $user = mysqli_fetch_row(mysqli_query($con, "select role from user where token='{$token}'"));
    if ($user[0] == "admin") {
        $classID=mysqli_fetch_row(mysqli_query($con,"select classID from class where classname='{$classname}'"));
        $courseID=mysqli_fetch_row(mysqli_query($con,"select courseID from course where cname='{$cname}'"));
        if (mysqli_query($con,"insert into relationship values (null ,'{$userID}','{$courseID[0]}','{$classID[0]}')")){
          echo json_encode(array("message" => "create success"));
        }else{
            echo json_encode(array("message"=>"create failed"));
        }
    }else{
        header("HTTP/1.1 401");
        echo json_encode(array("message"=>"unauthorized token"));
    }

}