<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/14
 * Time: 14:21
 */
require 'fun_con_db.php';
if($_POST) {
    $token = $_GET['token'];
    $userID = $_POST['userID'];
    $department = $_POST['department'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $con = db_con();
    $user = mysqli_fetch_row(mysqli_query($con, "select role,userID from user where token='{$token}'"));
    if ($user[0] == "admin") {
        if (mysqli_query($con, "insert into user values ('{$userID}','{$name}','{$password}','{$department}','user','{$user[1]}',null )")) {
            echo json_encode(array("message" => "create success"));
        } else {
            echo json_encode(array("message" => "create failed"));
        }
    } else {
        header("HTTP/1.1 401");
        echo json_encode(array("message" => "unauthorized token"));
    }
}