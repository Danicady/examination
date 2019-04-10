<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/8
 * Time: 9:12
 */

require 'include.php';
$token = $_GET['token'];
//$token ='c4ca4238a0b923820dcc509a6f75849b';
$sql = "select * from user WHERE token = '{$token}'";
$row = fetchOne($sql);
if($row)
{
    $arry = array('token'=>null);
   $mes = update('user',$arry,$row['userID']);
   if($mes)
   {
       header("HTTP/1.1 200");
       echo "退出成功！";
   }else{
       header("HTTP/1.1 400");

       echo "注销失败！";
   }

}