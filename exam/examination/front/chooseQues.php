<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/8
 * Time: 16:13
 */
require 'include.php';
$course =$_POST['course'];
//echo $course;
//course find 对应 courseid
//再subject 通过course ID 搜索到 所有的题型
//$course = '英语';
$sql = "select type from course where cname ='{$course}'";
$res = fetchOne($sql);
$mes = array();
foreach ($res as $it)
{
    $mes = explode(' ',$it);
}
echo json_encode($mes);


