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
    $department=$_POST['department'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    $cname=$_POST['cname'];
    $classname=['classname'];
    $con = db_con();
    $user = mysqli_fetch_row(mysqli_query($con, "select role,userID from user where token='{$token}'"));
    if ($user[0] == "admin") {
        if (mysqli_query($con,"insert into user values ('{$userID}','{$name}','{$password}','{$department}','user','{$user[1]}',null )")&&
            $resClass=mysqli_fetch_row(mysqli_query($con,"select classID from course where classname='{$classname}'"))&&
            $resCourse=mysqli_fetch_row(mysqli_query($con,"select courseID from course where cname='{$cname}'"))&&
                mysqli_query($con,"insert into relationship values (null,'{$userID}','{$resCourse[0]}','{$resClass[0]}')")){
          echo json_encode(array("message" => "create success"));
        }else{
            echo json_encode(array("message"=>"create failed"));
        }
    }else{
        header("HTTP/1.1 401");
        echo json_encode(array("message"=>"unauthorized token"));
    }

}