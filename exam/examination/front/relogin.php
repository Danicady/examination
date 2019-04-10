<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/22
 * Time: 14:12
 */
require_once 'include.php';
$userID=$_POST['userID'];
$password=$_POST['password'];
//$userID='1';
//$password='123456';
$sql = "select token from user WHERE userID='{$userID}' AND password='{$password}'";
$res = fetchOne($sql);
echo $res['token'];