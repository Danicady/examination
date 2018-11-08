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
    $department=$_POST['department'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    $cname=$_POST['cname'];
    $cname_old=$_POST['cname_old'];
    $classname=$_POST['classname'];
    $classname_old=$_POST['classname_old'];
    $token = $_GET['token'];
    $con = db_con();
    $role = mysqli_fetch_row(mysqli_query($con, "select role from user where token='{$token}'"));
    if ($role[0] == "admin") {
        if(mysqli_query($con,"update user set department='{$department}',name='{$name}',password='{$password}' where userID='{$userID}'") &&
            $resCourse[0]=mysqli_fetch_row(mysqli_query($con,"select courseID from course where cname='{$cname}'"))&&
                $resCourse[1]=mysqli_fetch_row(mysqli_query($con,"select courseID from course where cname='{$cname_old}'"))&&
                    $resClass[0]=mysqli_fetch_row(mysqli_query($con,"select classID from class where classname='{$classname}'"))&&
                        $resClass[1]=mysqli_fetch_row(mysqli_query($con,"select classID from class where classname='{$classname_old}'"))&&
                    mysqli_query($con,"update relationship set courseID='{$resCourse[0][0]}',classID='{$resClass[0][0]}' where userID='{$userID}' and courseID='{$resCourse[1][0]}' and classID='{$resClass[1][0]}'")) {
            echo json_encode(array("message" => "update success"));
        }else{
            echo json_encode(array("message"=>"update failed"));
        }
    }else{
        header("HTTP/1.1 401");
        echo json_encode(array("message"=>"unauthorized token"));
    }
}