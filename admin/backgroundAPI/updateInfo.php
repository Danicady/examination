<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/8
 * Time: 9:50
 */
require 'fun_con_db.php';
if ($_POST) {
    $userID = $_POST['userID'];
    $id=$_POST['id'];
    $cname=$_POST['cname'];
    $classname=$_POST['classname'];
    $token = $_GET['token'];
    $con = db_con();
    $role = mysqli_fetch_row(mysqli_query($con, "select role from user where token='{$token}'"));
    if ($role[0] == "admin") {
        $resCourse=mysqli_fetch_row(mysqli_query($con,"select courseID from course where cname='{$cname}'"));
        $resClass=mysqli_fetch_row(mysqli_query($con,"select classID from class where classname='{$classname}'"));
        if(mysqli_query($con,"update relationship set courseID='{$resCourse[0]}',classID='{$resClass[0]}' where id='{$id}'")){
             echo json_encode(array("message" => "update success"));
        }else{
            echo json_encode(array("message"=>"update failed"));
        }
    }else{
        header("HTTP/1.1 401");
        echo json_encode(array("message"=>"unauthorized token"));
    }
}