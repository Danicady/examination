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
    $userID=mysqli_fetch_row(mysqli_query($con,"select userID from user where token='{$token}'"));
    $data=[];
    $i=0;
    $res=mysqli_query($con,"select userID,name,department from user where superior='{$userID[0]}'");
    while($row=mysqli_fetch_assoc($res)){
        $data[$i]['userID']=$row['userID'];
        $data[$i]['name']=$row['name'];
        $data[$i]['department']=$row['department'];
        $i++;
    }
    $user=[];
    $res=mysqli_query($con,"select userID,name,department from user where token='{$token}'");
    $user[0]=mysqli_fetch_assoc($res);
    $user[0]['token']=$token;
    echo json_encode(array('user'=>$user,'teacher'=>$data));
}