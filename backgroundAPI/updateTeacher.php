<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/15
 * Time: 9:09
 */
require "fun_con_db.php";
if($_POST){
    $userID=$_POST['userID'];
    $password=$_POST['password'];
    $name=$_POST['name'];
    $token=$_GET['token'];
    $con=db_con();
    $role=mysqli_fetch_row(mysqli_query($con,"select role from user where token='{$token}'"));
    if ($role[0]=='admin'){
       if(mysqli_query($con,"update user set name='{$name}',password='{$password}' where userID='{$userID}'")){
           echo json_encode(array("message"=>"update success"));
       }else{
           echo json_encode(array("message"=>"update failed"));
       }
    }else{
        header('HTTP/1.1 401');
        echo json_encode(array("message"=>"unauthorized token"));
    }
}