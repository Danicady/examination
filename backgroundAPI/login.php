<?php
/**
 * Created by PhpStorm.
 * User: DY
 * Date: 2018/11/7
 * Time: 9:43
 */
require 'fun_con_db.php';
if($_POST){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $token=md5($username);
    $con=db_con();
    if ( mysqli_query($con,"update user set token='{$token}' where userID='{$username}' and password='{$password}'")){
        $data=[];
        $i=0;
        $res=mysqli_query($con,"select * from user where superior='{$username}'");
        while($row=mysqli_fetch_assoc($res)){
            $data[$i]['userID']=$row['userID'];
            $data[$i]['name']=$row['name'];
            $data[$i]['department']=$row['department'];
            $i++;
        }
        $user=[];
        $res=mysqli_query($con,"select name,department from user where token='{$token}'");
        $user[0]=mysqli_fetch_assoc($res);
        $user[0]['token']=$token;
        echo json_encode(array('user'=>$user,'teacher'=>$data));
    }
    else{
        header('HTTP/1.1 401');
        echo json_encode(array("message"=>"Invalid login"));
    }
}

