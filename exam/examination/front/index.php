<?php
/**
 * Created by PhpStorm.
 * User: 19473
 * Date: 2018/11/7
 * Time: 17:19
 */
require_once 'include.php';
//的名字 token值 老师教的课程，以及该课程教了几班

$token = $_GET['token'];


//$token ='c4ca4238a0b923820dcc509a6f75849b';
$sql = "select * from user WHERE token = '{$token}'";
$row = fetchOne($sql);
$res = array();
if($row)
{
    $message=array();
    $sql = "select * from relationship WHERE  userID= '{$row['userID']}'";
    $rows = fetchAll($sql);

    foreach ($rows as $row)
    {
        $courseSql = "select cname,unitnum from course WHERE courseID = '{$row['courseID']}'";
        $course = fetchOne($courseSql);
        $classNameSql = "select classname from class WHERE classID = '{$row['classID']}'";
        $className = fetchOne($classNameSql);
        $message[$course['cname']][]= array('course'=>$course['cname'],'class'=>$className['classname'],'unitnum'=>$course['unitnum'],
            'userID'=>$row['userID'],'token'=>md5($row['userID']));
    }
    foreach ($message as $key=>$val)
    {
        $res[]=$val;
    }
    echo json_encode($res);
}





