<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/7
 * Time: 14:59
 */
require_once 'include.php';
$userId= $_POST['userID'];
$password = $_POST['password'];
$autoFlag =$_POST['autoFlag'];
//$userId = '1';
//$password ='123456';
//$autoFlag ='';
$pattren = '/\S/';
$res = preg_match($pattren,$userId);
$res1 = preg_match($pattren,$password);
$ans ="登录无效！请确认信息";
if($res ===0||$res1 ===0){
    echo $ans;
}

$sql ="select * from user where userId ='{$userId}' AND password = '{$password}'";
$row = fetchOne($sql);

$arry = array();//用来存放返回给前台的数据

if($row)
{
    $arry['role']='user';
    $arry['token']=md5($userId);
//    echo json_encode($arry);

    //自动登录
    if($autoFlag)
    {
        setcookie("userID",$row['userID'],time()+7*24*3600);
        setcookie("paw",$row['password'],time()+7*24*3600);
    }

    $mes = update('user',$arry,$userId);//更新用户数据库，告诉数据库用户角色，以及token值
    //如果更新成功就返回给前台该用户的这一列的信息
    if($mes)
    {

        $sql ="select * from user where userId ='{$userId}' AND password = '{$password}'";
        $row = fetchOne($sql);
        header("HTTP/1.1 200");
        echo $row['token'];

    }
    else{
        header("HTTP/1.1 401");
        echo "已登录！";
    }
}

else{
    header("HTTP/1.1 400");
    echo $ans;
}
